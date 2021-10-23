
@extends('layouts/contentLayoutMaster')

@section('title', 'File Services')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">File Services</h4>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th width="10%">Job No.</th>
              <th width="20%">Car</th>
              <th width="20%">License Plate</th>
              <th width="15%">Created At</th>
              <th width="20%">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($entries as $e)
              <tr>
                  <td>{{ $e->displayable_id }}</td>
                  <td>{{ $e->car }}</td>
                  <td>{{ $e->license_plate }}</td>
                  <td>{{ $e->created_at }}</td>
                  <td class="td-actions">
                    <a
                      class="btn btn-icon btn-success"
                      href="{{ $e->tickets
                        ? route('tickets.edit', ['ticket' => $e->tickets->id])
                        : route('fileservice.tickets.create', ['id' => $e->id]) }}">
                      <i data-feather="message-circle"></i>
                    </a>
                    <a class="btn btn-icon btn-primary" href="{{ route('fileservices.edit', ['fileservice' => $e->id]) }}">
                      <i data-feather="edit"></i>
                    </a>
                    <a class="btn btn-icon btn-danger" onclick="onDelete(this)" data-id="{{ $e->id }}"><i data-feather="trash-2"></i></a>
                    <form action="{{ route('fileservices.destroy', $e->id) }}" class="delete-form" method="POST" style="display:none">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ $entries->links() }}
  </div>
</div>
<!-- Basic Tables end -->
@endsection
@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
  async function onDelete(obj) {
    var delete_form = $(obj).closest('.td-actions').children('.delete-form')
    var swal_result = await Swal.fire({
      title: 'Warning!',
      text: 'Are you sure to delete?',
      icon: 'warning',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      showCancelButton: true,
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      buttonsStyling: false
    });
    if (swal_result.isConfirmed) {
      delete_form.submit();
    }
  }
</script>
@endsection
