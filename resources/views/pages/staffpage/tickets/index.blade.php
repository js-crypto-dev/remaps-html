
@extends('layouts/contentLayoutMaster')

@section('title', __('locale.menu_SupportTickets'))

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
        <h4 class="card-title">{{__('locale.menu_SupportTickets')}}</h4>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th width="20%">{{__('locale.tb_header_Client')}}</th>
              <th width="20%">{{__('locale.tb_header_FileService')}}</th>
              <th width="10%">{{__('locale.tb_header_TicketStatus')}}</th>
              <th width="20%">{{__('locale.tb_header_Assign')}}</th>
              <th width="15%">{{__('locale.tb_header_CreatedAt')}}</th>
              <th width="20%">{{__('locale.tb_header_Actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @if (count($entries) > 0)
              @foreach ($entries as $entry)
                <tr>
                  <td>{{ $entry->client }}</td>
                  <td>{{ $entry->file_service_name }}</td>
                  <td>{{ $entry->closed ? 'Closed' : 'Open' }}</td>
                  <td> @if ($entry->staff) {{ $entry->staff->fullname }} @endif </td>
                  <td>{{ $entry->created_at }}</td>
                  <td class="td-actions">
                    <a class="btn btn-icon btn-primary" href="{{ route('stafftk.edit', ['stafftk' => $entry->id]) }}" title="Edit">
                      <i data-feather="edit"></i>
                    </a>
                    <a class="btn btn-icon btn-danger" onclick="onDelete(this)" data-id="{{ $entry->id }}" title="Delete"><i data-feather="trash-2"></i></a>
                    <form action="{{ route('stafftk.destroy', $entry->id) }}" class="delete-form" method="POST" style="display:none">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6">No matching records found</td>
              </tr>
            @endif
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
