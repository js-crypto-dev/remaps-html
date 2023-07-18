<?php

namespace App\Http\Controllers\Remaps\Api;
use App\Http\Controllers\MasterController;
use App\Models\Api\ApiSubscription;

use Illuminate\Http\Request;

class ApiSubscriptionController extends MasterController
{
    public function index(Request $request) {
        $user_id = $request->input('user_id');
        $entries = ApiSubscription::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('pages.api.subscription.index', compact('entries'));
    }

    public function payments($id)
    {
        $subscription = ApiSubscription::find($id);
        $entries = $subscription->subscriptionPayments;
        return view('pages.api.subscription.payments', compact('entries'));
    }

    public function invoice($id)
    {
        $subscription_payment = ApiSubscriptionPayment::find($id);
        $pdf = new Dompdf;
        $invoiceName = 'invoice_'.$subscription_payment->id.'.pdf';
        $pdf->loadHtml(
            view('pdf.subscription_invoice')->with(['subscription_payment'=>$subscription_payment, 'company'=>$this->company, 'user'=>$this->user])->render()
        );
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream($invoiceName);
    }

    public function cancelSubscription($id){
        $subscription = ApiSubscription::find($id);

        try {
            $this->curlCancelSubscription($id);
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return redirect(route('shop.subscription.index'));
    }

    private function curlCancelSubscription($id) {
        $subscription = ApiSubscription::find($id);

        try {
            $url = "https://api.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/cancel";
            // $url = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/cancel";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                'Accept: application/json',
                'Authorization: '."Bearer ". $this->getAccessToken(),
                'Prefer: return=representation',
                'Content-Type: application/json',
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $data = [
                'reason' => 'Cancel the subscription'
            ];
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $resp = curl_exec($curl);
            curl_close($curl);

            $subscription->status = 'CANCELLED';
            if($subscription->save()){
                // \Alert::success(__('admin.company_cancelled_subscription'))->flash();
            }else{
                // \Alert::error(__('admin.opps'))->flash();
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function immediateCancelSubscription($id){
        $subscription = ApiSubscription::find($id);
        try {
            $url = "https://api.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/suspend";
            // $url = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/suspend";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                'Accept: application/json',
                'Authorization: '."Bearer ". $this->getAccessToken(),
                'Prefer: return=representation',
                'Content-Type: application/json',
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $data = [
                'reason' => 'Suspend the subscription'
            ];
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_exec($curl);
            curl_close($curl);

            $subscription->status = 'SUSPENDED';
            if($subscription->save()){
                // \Alert::success(__('admin.company_cancelled_subscription'))->flash();
            }else{
                // \Alert::error(__('admin.opps'))->flash();
            }
            // \Alert::success(__('admin.company_cancelled_subscription'))->flash();
        }catch(\Exception $e){
            // \Alert::error($e->getMessage())->flash();
        }
        return redirect(route('shop.subscription.index'));
    }

    public function reactiveSubscription($id){
        $subscription = ApiSubscription::find($id);
        try {
            $url = "https://api.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/suspend";
            // $url = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/{$subscription->pay_agreement_id}/activate";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                'Accept: application/json',
                'Authorization: '."Bearer ". $this->getAccessToken(),
                'Prefer: return=representation',
                'Content-Type: application/json',
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $data = [
                'reason' => 'Reactivating the subscription'
            ];
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_exec($curl);
            curl_close($curl);

            $subscription->status = 'ACTIVE';
            if($subscription->save()){
                // \Alert::success(__('admin.company_cancelled_subscription'))->flash();
            }else{
                // \Alert::error(__('admin.opps'))->flash();
            }
            // \Alert::success(__('admin.company_cancelled_subscription'))->flash();
        }catch(\Exception $e){
            // \Alert::error($e->getMessage())->flash();
        }
        return redirect(route('shop.subscription.index'));
    }
}
