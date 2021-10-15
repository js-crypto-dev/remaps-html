
@extends('layouts/contentLayoutMaster')

@section('title', 'Input')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<section id="basic-input">
  <form action="{{ route('customers.store') }}" method="post">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add a new customer</h4>
          </div>
          <div class="card-body">
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="private">Customer Type</label>
                <select class="form-select" id="private" name="private">
                  <option value="0" @if($customer->private == 0) selected @endif>Private Customer</option>
                  <option value="1" @if($customer->private == 1) selected @endif>Business Customer</option>
                </select>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="tuning_credit_group_id">Tuning price type</label>
                <select class="select2 form-select" id="tuning_credit_group_id" name="tuning_credit_group_id">
                  <option value=""> </option>
                  @foreach ($tuningGroups as $id => $name)
                    <option value="{{ $id }}" @if($customer->tuning_credit_group_id == $id) selected @endif>{{ $name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="lang">Language</label>
                <select class="form-select" id="lang" name="lang">
                  @foreach ($langs as $abbr => $lang)
                    <option value="{{ $abbr }}" @if($customer->lang == $abbr) selected @endif>{{ $lang }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-2 col-md-6 col-12">
                <label class="form-label" for="title">Title</label>
                <select class="form-select" id="title" name="title">
                  <option value="Mr" @if($customer->title == "Mr") selected @endif>Mr</option>
                  <option value="Ms" @if($customer->title == "Ms") selected @endif>Ms</option>
                </select>
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label" for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" />
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label" for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}" />
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="business_name">Business Name</label>
                <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $customer->business_name }}" />
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}" />
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="address_line_1">Address Line 1</label>
                <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="{{ $customer->address_line_1 }}" />
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="address_line_2">Address Line 2</label>
                <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="{{ $customer->address_line_2 }}" />
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label" for="town">Town</label>
                <input type="text" class="form-control" id="town" name="town" value="{{ $customer->town }}" />
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label" for="county">County</label>
                <input type="text" class="form-control" id="county" name="county" value="{{ $customer->county }}" />
              </div>
              <div class="col-xl-2 col-md-6 col-12">
                  <label class="form-label" for="post_code">Postal Code</label>
                  <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $customer->post_code }}" />
                </div>
            </div>
            <div class="row mb-1">
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" />
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <label class="form-label" for="tools">Tools</label>
                <textarea
                  class="form-control"
                  id="tools"
                  rows="3"
                  name="tools"
                >{{ $customer->tools }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
  </form>
</section>

@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-tooltip-valid.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
