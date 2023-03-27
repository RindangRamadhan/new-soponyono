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
          <div class="col-sm-2">
            <div class="controls form-label-group position-relative has-icon-left">
              <select id="month" name="month" class="select2 form-control filter-change">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <button type="button" id="btnSearch" class="btn btn-primary btn-block glow users-list-clear mb-0">
              <i class="bx bx-search"></i> Search
            </button>
          </div>
          <div class="col-sm-4 mb-2" id="btnDownload" style="display: none">
            {{-- <button type="button" id="btnPdf" class="btn btn-danger glow users-list-clear mb-0">
              <i class="bx bxs-file-pdf"></i> PDF
            </button> --}}

            <button type="button" id="btnExcel" class="btn btn-success glow users-list-clear mb-0">
              <i class="bx bxs-file-doc"></i> Unduh Excel
            </button>

          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-sm table-bordered table-ssr-custome nowrap">
            <tfoot style="display: table-row-group">
              <th>Petugas</th>
              @for ($i = 1; $i <= 20; $i++) <th>Lunas</th>
                <th>Janji</th>
                @endfor
            </tfoot>
            <thead>
              <tr>
                <th rowspan="2">Petugas</th>
                @for ($i = 1; $i <= 20; $i++) <th colspan="2">{{ $i }}</th>
                  @endfor
              </tr>
              <tr>
                @for ($i = 1; $i <= 20; $i++) <th>Lunas</th>
                  <th>Janji</th>
                  @endfor
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
    const date = moment();

    $('#month').select2({
      data: @php echo json_encode($months) @endphp,
      placeholder: 'Pilih Bulan'
    });

    $('#up3_id').select2({
      data: @php echo json_encode($up3s) @endphp,
      placeholder: 'Pilih UP3'
    });

    $("#month").val(date.month() + 1).change();
  })

  $(document).on('click', '#btnSearch', function (e) {
    GetOrder();
  })

  $(document).on('click', '#btnPdf', function (e) {
    const month = $("#month").val();
    const up3_id = $("#up3_id").val();
    const ulp_id = $("#ulp_id").val();

    window.open(`/report/daily/export?up3_id=${up3_id}&ulp_id=${ulp_id}&month=${month}&doc_type=pdf`);
  })

  $(document).on('click', '#btnExcel', function (e) {
    const month = $("#month").val();
    const up3_id = $("#up3_id").val();
    const ulp_id = $("#ulp_id").val();

    window.open(`/report/daily/export?up3_id=${up3_id}&ulp_id=${ulp_id}&month=${month}&doc_type=excel`);
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
    const month = $("#month").val();
    const up3_id = $("#up3_id").val();
    const ulp_id = $("#ulp_id").val();

    if (up3_id == "" && ulp_id == "") {
      return
    }
    
    const params = {
      "url": "{{ url('/report/daily') }}",
      "columns": [
        { "data": "name" },
      ],
      "args": {
        "month": month,
        "up3_id": up3_id,
        "ulp_id": ulp_id,
      },
      "resp": null
    }

    for (let i = 1; i <= 20; i++) {
      params.columns.push(
        { "data": `total_paid_${i}`},
        { "data": `total_debt_${i}`}
      )
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: params.url + "/list",
      dataType:"json",
      data: params.args,
      success: function(response){
        params.resp = response
        initDataTable(params)
      }
    });


    $("#btnDownload").show();
  }

  function initDataTable(params) {
    var dataTable;
    
    $(".table-ssr-custome").DataTable().destroy();

    switch (true) {
        case !params.url:
            console.warn("params.url is required");
            break;
        case !params.columns:
            console.warn("params.columns is required");
            break;
        case !Array.isArray(params.columns):
            console.warn("params.columns must be array");
            break;
    }

    // Setup - add a text input to each footer cell
    $(".table-ssr-custome tfoot th").each(function (i) {
        const title = $(this).text();
        const placeholder = `Cari ${title}`;
        const width = placeholder.length * 7 + 32;
        const type =
            params.columns[i].searchable === false ? "hidden" : "text";

        params.columns[i].name = params.columns[i].field
            ? params.columns[i].field
            : params.columns[i].name;

        $(this).html(
            `<input type="${type}" class="form-control" placeholder="${placeholder}" style="margin: 10px 0px; min-width: ${width}px" />`
        );
    });

    // DataTable
    let payload = params.args ? params.args : {};

    dataTable = $(".table-ssr-custome").DataTable({
        filter: true,
        // searchDelay: 500,
        // processing: true,
        // serverSide: true,
        data: params.resp,
        columns: params.columns,
        order: [params.order ? params.order : [0, "desc"]],
        language: {
            paginate: {
                previous: `<i class="bx bx-chevron-left"></i>`,
                next: `<i class="bx bx-chevron-right"></i>`,
            },
        },
    });

    // Apply the search
    dataTable.columns().every(function () {
        var that = this;

        $("input", this.footer()).on("keyup", function (e) {
            if (
                (e.key == "Enter" && that.search() !== this.value) ||
                (e.target.value == "" && that.search() !== this.value)
            ) {
                that.search(this.value).draw();
            }
        });
    });
  }
</script>
@endsection