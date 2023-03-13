@extends('layouts.app')
{{-- page title --}}
@section('title','Harian')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
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
<!-- Order start -->
<section id="basic-datatable">
  <div class="card">
    <div class="card-content">
      <div class="card-body card-dashboard">
        <div class="row">
          <div class="col-sm-3">
            <div class="controls form-label-group position-relative has-icon-left">
              <select id="up3_id" name="up3_id" class="select2 form-control ">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="controls form-label-group position-relative has-icon-left">
              <select id="ulp_id" name="ulp_id" class="select2 form-control ">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="controls form-label-group position-relative has-icon-left">
              <input type="text" name="date_range" id="date_range" class="form-control pickdaterange" placeholder="Pilih Tanggal">
              <div class="form-control-position">
                <i class="bx bx-calendar"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <button type="reset" id="btnSearch" class="btn btn-primary btn-block glow users-list-clear mb-0">
              <i class="bx bx-search"></i> Search
            </button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-sm table-ssr nowrap">
            <tfoot style="display: table-row-group">
              <th>Id</th>
              <th>UP3</th>
              <th>ULP</th>
              <th>Petugas</th>
              <th>Status</th>
              <th>Action</th>
            </tfoot>
            <thead>
              <tr>
                <th>Id</th>
                <th>UP3</th>
                <th>ULP</th>
                <th>Petugas</th>
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
<!-- Order ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script>
  $(document).ready(function () {
    $('.pickdaterange').daterangepicker({
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });
  })

  $(document).on('click', '#btnSearch', function (e) {
    GetOrder();
  })

  $(document).ready(function() {
    $('#up3_id').select2({
      data: @php echo json_encode($up3s) @endphp,
      placeholder: 'Pilih UP3'
    });

    $('#ulp_id').select2({
      placeholder: 'Pilih ULP'
    });
  });
  
  $(document).on('change', '#up3_id', function (e) {
    const data = $(this).select2('data')[0]
    const ulp = $('#ulp_id');

    ulp.html('').select2({
      data: [{id: '', text: ''}]
    });

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: `${api}/master-data/ulp/list-select`,
      dataType:"json",
      data: { up3_id: data.id },
      success: function(response){
        ulp.select2({
          data: response,
          placeholder: 'Pilih ULP'
        });
      }
    });
  })

  function GetOrder() {
    const date_range = $("#date_range").val().split(" - ");
    const start_date = date_range[0];
    const end_date = date_range[1];
    const up3_id = $("#up3_id").val();
    const ulp_id = $("#ulp_id").val();

    if (up3_id == "" && ulp_id == "") {
      return
    }

    let qFilter = "";
    if (start_date != "") {
      qFilter += `start_date=${start_date}`
    }
    
    if (end_date != "") {
      qFilter += `&end_date=${end_date}`
    }
    
    if (up3_id != "") {
      qFilter += `&up3_id=${up3_id}`
    }

    if (ulp_id != "") {
      qFilter += `&ulp_id=${ulp_id}`
    }
    
    const params = {
      "url": "{{ url('/monitoring') }}",
      "columns": [
        { "data": "orders__id", "visible": false },
        { "data": "up3__name" },
        { "data": "ulp__name" },
        { "data": "u__name" },
        { "data": "status" },
        {
          "data": "action", "searchable": false, "orderable": false,
          "render": function (data, type, row) {
            const detail = `
              <a href="{{ url('/monitoring/${row.user_id}/detail?${qFilter}') }}" class='btn btn-icon rounded-circle btn-info'>
                <i class='bx bx-list-ul'></i>
              </a>
            `
            const location = `
              <a href="{{ url('/monitoring/${row.user_id}/location?${qFilter}') }}" class='btn btn-icon rounded-circle btn-success'>
                <i class='bx bx-map'></i>
              </a>
            `
            return `${detail} ${location}`;
          }
        }
      ],
      "args": {
        "start_date": start_date,
        "end_date": end_date,
        "up3_id": up3_id,
        "ulp_id": ulp_id,
      }
    }

    dataTableServerSide(params)
  }
</script>
@endsection