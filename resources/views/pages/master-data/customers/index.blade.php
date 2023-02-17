@extends('layouts.app')
{{-- page title --}}
@section('title','Customer')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">

<style>
  .DTFC_Cloned thead {
    background: white;
  }

  .DTFC_Cloned tbody {
    background: white;
  }
</style>
@endsection

@section('content')
<!-- Uid start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">


        <div class="table-responsive">
          <table class="table table-sm table-ssr nowrap">
            <tfoot style="display: table-row-group">
              <th>Id</th>
              <th>UP3</th>
              <th>ULP</th>
              <th>ID PEL</th>
              <th>Name</th>
              <th>No Telp</th>
              <th>Gardu</th>
              <th>Status</th>
              <th>Action</th>
            </tfoot>
            <thead>
              <tr>
                <th>Id</th>
                <th>UP3</th>
                <th>ULP</th>
                <th>ID PEL</th>
                <th>Name</th>
                <th>No Telp</th>
                <th>Gardu</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- Uid ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

@section('page-scripts')
<script>
  @if (Session::get('status') == 200)
    $(document).ready(function(){
      toastr.success('Data has been saved', 'Success', { "progressBar": true, "showDuration": 500, "closeButton": true })
    });
  @endif

  $(document).ready(function () {
    const params = {
      "url": "{{ url('/master-data/customers') }}",
      "columns": [
        { "data": "id", "visible": false },
        { "data": "up3__name" },
        { "data": "ulp__name" },
        { "data": "id_pel" },
        { "data": "name" },
        { "data": "phone_number" },
        { "data": "gardu" },
        { "data": "status" },
        { "data": "action", "searchable": false, "orderable": false }
      ]
    }

    dataTableServerSide(params)
  })

  // Confirmation Delete
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    
    const params = {
      "name": this.dataset.name,
      "url": "{{ url('/master-data/customers/') }}",
      "id": $(this).attr('data-id'),
      "tr": $(this).parent("td").parent('tr')
    }
    
    confirmDelete(params)
  })

</script>
@endsection