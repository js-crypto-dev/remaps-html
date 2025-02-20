
@extends('layouts/contentLayoutMaster')

@section('title', 'Edit')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<section id="basic-input">
  @if ($group_type == 'normal')
  {{ html()->form('PUT')->route('tuning-credits.update', ['tuning_credit' => $entry->id])->open() }}
  @else
  {{ html()->form('PUT')->route('evc-tuning-credits.update', ['tuning_credit' => $entry->id])->open() }}
  @endif
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit tuning credit group</h4>
          </div>
          <div class="card-body">
            <div class="row mb-1">
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label" for="name">Group Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $entry->name }}" />
              </div>
            </div>
            @foreach ($tires as $tire)
            @php
              $groupCreditTire = $tire->tuningCreditGroups()->where('tuning_credit_group_id', $entry->id)->withPivot('from_credit', 'for_credit')->first();
            @endphp
            <div class="row mb-1">
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label">{{ $tire->amount }} Credit From</label>
                <input type="text" class="form-control" name="credit_tires[{{ $tire->id }}][from_credit]" value="{{ @$groupCreditTire->pivot->from_credit }}" />
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <label class="form-label">{{ $tire->amount }} Credit For</label>
                <input type="text" class="form-control" name="credit_tires[{{ $tire->id }}][for_credit]" value="{{ @$groupCreditTire->pivot->for_credit }}" />
              </div>
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary me-1">Submit</button>
            <button type="button" class="btn btn-flat-secondary me-1" onclick="history.back(-1)">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  {{ html()->form()->close() }}
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
