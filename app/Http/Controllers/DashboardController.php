<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterController;
use App\Http\Requests\AccountInfoRequest;
use App\Http\Requests\AccountStaffRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\CustomerRating;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends MasterController
{
    // Dashboard - Ecommerce
    public function dashboardAdmin()
    {
        $user = $this->user;
        if ($user->is_admin) {
            $data['orders'] = \App\Models\Order::whereHas('user', function($query) use($user){
                $query->where('company_id', $user->company_id);
            })->orderBy('id', 'DESC')->take(5)->get();
            $data['fs_pending'] = \App\Models\FileService::whereHas('user', function($query) use($user){
                $query->where('company_id', $user->company_id);
            })->where('status', 'P')->count();
            $data['fs_open'] = \App\Models\FileService::whereHas('user', function($query) use($user){
                $query->where('company_id', $user->company_id);
            })->where('status', 'O')->count();
            $data['fs_waiting'] = \App\Models\FileService::whereHas('user', function($query) use($user){
                $query->where('company_id', $user->company_id);
            })->where('status', 'W')->count();
            $data['fs_completed'] = \App\Models\FileService::whereHas('user', function($query) use($user){
                $query->where('company_id', $user->company_id);
            })->where('status', 'C')->count();
            return view('pages.dashboard.admin', compact('data'));
        }
    }
    public function dashboardStaff()
    {
        $user = $this->user;
        $data['fileServices'] = \App\Models\FileService::whereHas('user', function($query) use($user){
            $query->where('company_id', $user->company_id);
        })->orderBy('id', 'DESC')->take(5)->get();
        $data['fs_pending'] = \App\Models\FileService::whereHas('user', function($query) use($user){
            $query->where('company_id', $user->company_id);
        })->where('status', 'P')->count();
        $data['fs_open'] = \App\Models\FileService::whereHas('user', function($query) use($user){
            $query->where('company_id', $user->company_id);
        })->where('status', 'O')->count();
        $data['fs_waiting'] = \App\Models\FileService::whereHas('user', function($query) use($user){
            $query->where('company_id', $user->company_id);
        })->where('status', 'W')->count();
        $data['fs_completed'] = \App\Models\FileService::whereHas('user', function($query) use($user){
            $query->where('company_id', $user->company_id);
        })->where('status', 'C')->count();
        return view('pages.dashboard.staff', compact('data'));
    }
    public function dashboardCustomer()
    {
        $customerRating = CustomerRating::where(['user_id'=>$this->user->id,'company_id'=>$this->user->company_id])->first();
        $data['customerRating']  = $customerRating;
        $data['fileServices'] = $this->user->fileServices()->orderBy('id', 'DESC')->take(5)->get();
        $data['fs_pending'] = $this->user->fileServices()->where('status', 'P')->count();
        $data['fs_open'] = $this->user->fileServices()->where('status', 'O')->count();
        $data['fs_waiting'] = $this->user->fileServices()->where('status', 'W')->count();
        $data['fs_completed'] = $this->user->fileServices()->where('status', 'C')->count();
        $data['resellerId'] = $this->user->reseller_id;

        $company = $this->user->company;
        $day = lcfirst(date('l'));
        $daymark_from = substr($day, 0, 3).'_from';
        $daymark_to = substr($day, 0, 3).'_to';
        $open_status = -1;
        if ($company->open_check) {
            if ($company->$daymark_from && str_replace(':', '', $company->$daymark_from) > date('Hi')
                || $company->$daymark_to && str_replace(':', '', $company->$daymark_to) < date('Hi')) {
                $open_status = $company->notify_check == 0 ? 1 : 2;
            }
        }
        $data['openStatus'] = $open_status;
        $data['evcCount'] = '';
        if ($this->company->reseller_id && $this->user->reseller_password) {
            $url = "https://evc.de/services/api_resellercredits.asp";
            $dataArray = array(
                'apiid'=>'j34sbc93hb90',
                'username'=> $this->user->company->reseller_id,
                'password'=> $this->user->company->reseller_password,
                'verb'=>'getcustomeraccount',
                'customer' => $this->user->reseller_id
            );
            $ch = curl_init();
            $params = http_build_query($dataArray);
            $getUrl = $url."?".$params;
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 500);

            $response = curl_exec($ch);
            if (strpos($response, 'ok') !== FALSE) {
                $data['evcCount'] = str_replace('ok: ', '', $response);
            }
        }
        return view('pages.dashboard.consumer', compact('data', 'customerRating'));
    }

    public function addRating(Request $request){
		if(isset($request->id) && !empty($request->id) ){
			$id = $request->id;
			$model = CustomerRating::where(['id' => $id])->first();
		}else{
			$model = new CustomerRating();
		}

		$model->rating = $request->rating;
		$model->user_id = $this->user->id;
		$model->company_id = $this->user->company_id;
		$model->save();

		$avgRating = CustomerRating::where('company_id', $model->company_id)->avg('rating');

		$company = Company::find($model->company_id);
		$company->rating = $avgRating;
		$company->save();
		return redirect(route('dashboard'))->with('message', 'Rating Added');
    }

    public function setReseller(Request $request) {
        if ($request->reseller_id) {
            $url = "https://evc.de/services/api_resellercredits.asp";
            $dataArray = array(
                'apiid'=>'j34sbc93hb90',
                'username'=> $this->user->company->reseller_id,
                'password'=> $this->user->company->reseller_password,
                'verb'=>'addcustomer',
                'customer' => $request->reseller_id
            );
            $ch = curl_init();
            $data = http_build_query($dataArray);
            $getUrl = $url."?".$data;
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 500);

            $response = curl_exec($ch);
            if (strpos($response, 'customer added') !== FALSE || strpos($response, 'customer already exists') !== FALSE) {
                $this->user->reseller_id = $request->reseller_id;
                $this->user->save();
            } else {
                session()->flash('error', __('admin.opps').'\r\n'.$response);
            }
        } else {
            $this->user->reseller_id = '';
            $this->user->save();
        }

        return redirect(route('dashboard'))->with('message', 'Reseller Set');
    }

    public function profile() {
        $post_link = route('admin.dashboard.profile.staff.post');
        if ($this->user->is_staff) {
            return view('pages.dashboard.profile_staff', compact('post_link'));
        } else {
            $post_link = $this->user->is_admin ? route('admin.dashboard.profile.post') : route('dashboard.profile.post');
            return view('pages.dashboard.profile', compact('post_link'));
        }
    }

    public function profile_post(AccountInfoRequest $request) {
        $this->user->update($request->all());
        if (Auth::guard('master')->check() || Auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard.profile'));
        }
        return redirect(route('dashboard.profile'));
    }

    public function profile_staff_post(AccountStaffRequest $request) {
        $this->user->update($request->all());
        if (Auth::guard('master')->check() || Auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard.profile'));
        }
        return redirect(route('dashboard.profile'));
    }

    public function edit_password() {
        $post_link = route('password.edit.post');
        if ($this->user->is_admin) {
            $post_link = route('admin.password.edit.post');
        }
        return view('pages.dashboard.edit_password', compact('post_link'));
    }

    public function edit_password_post(ChangePasswordRequest $request) {
        try{
            $user = $this->user;
            $user->password = Hash::make($request->new_password);
            if ($user->save()) {
                session()->flash('message', __('auth.password_changed'));
            } else {
                session()->flash('error', __('admin.opps'));
            }
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
