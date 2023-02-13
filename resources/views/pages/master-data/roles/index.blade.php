@extends('layouts.app')
{{-- page title --}}
@section('title','Hak Akses')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection

@section('content')
<!-- Hak Akses start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">
        <div class="table-responsive">
          <table class="table table-sm table-ssr">
            <tfoot style="display: table-row-group">
              <th>Id</th>
              <th>Nama</th>
              <th>Action</th>
            </tfoot>
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama</th>
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
<!-- Hak Akses ends -->
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
      "url": "{{ url('/master-data/roles') }}",
      "columns": [
        { "data": "id", "visible": false },
        { "data": "name" },
        { "data": "action", "searchable": false, "orderable": false }
      ]
    }

    dataTableServerSide(params)
  })

  // Confirmation Delete
  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();

    const params = {
      "url": "{{ url('/master-data/roles/') }}",
      "id": $(this).attr('data-id'),
      "tr": $(this).parent("td").parent('tr')
    }

    confirmDelete(params)
  })

</script>
@endsection