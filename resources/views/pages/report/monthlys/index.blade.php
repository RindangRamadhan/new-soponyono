@extends('layouts.app')
{{-- page title --}}
@section('title','Laporan Bulanan')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
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
          <div class="col-sm-4">
            <div class="controls form-label-group position-relative has-icon-left">
              <select id="up3_id" name="up3_id" class="select2 form-control ">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
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
              <select id="month" name="month" class="select2 form-control filter-change">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="controls form-label-group position-relative has-icon-left">
              <select id="year" name="year" class="select2 form-control filter-change">
                <option></option>
              </select>
              <div class="form-control-position">
                <i class="bx bx-edit-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <button type="reset" id="btnSearch" class="btn btn-primary btn-block glow users-list-clear mb-0">
              <i class="bx bx-search"></i> Search
            </button>
          </div>
          <div class="col-sm-2">
            <button id="btnShare" class="btn btn-success">
              <i class="bx bx-share-alt"></i> Share
            </button>
          </div>

        </div>

        <div class="table-responsive">
          <table id="boruto" class="table table-sm table-ssr nowrap">
            <tfoot style="display: table-row-group">
              <th>Petugas</th>
              <th>Total Wo</th>
              <th>Lunas</th>
              <th>Janji</th>
              <th>Total Realisasi</th>
              <th>%</th>
            </tfoot>
            <thead>
              <tr>
                <th>Petugas</th>
                <th>Total Wo</th>
                <th>Lunas</th>
                <th>Janji</th>
                <th>Total Realisasi</th>
                <th>%</th>
              </tr>
            </thead>

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
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script>
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

    const date = moment();

    $('#month').select2({
      data: @php echo json_encode($months) @endphp,
      placeholder: 'Pilih Bulan'
    });

    $('#year').select2({
      data: @php echo json_encode($years) @endphp,
      placeholder: 'Pilih Tahun'
    });
    $("#month").val(date.month() + 1).change();
    $("#year").val(date.year()).change();

  });

  $(document).on('click', '#btnShare', function (e) {
    const month = $("#month").val();
    const year = $("#year").val();
    const up3_id = $("#up3_id").val();
    let ulp_id = $("#ulp_id").val();

    if (up3_id == "" ) {
      Swal.fire('Info', 'UP3 belum dipilih', 'warning');
      return
    }
    if(ulp_id == ""){
      ulp_id ="-"
    }

    Swal.fire({
      title: 'Yakin Mau Share ???',
      text: 'Laporan Bulanan ',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Share!'
    }).then((result) => {
      window.open(`/report/monthly/share-all/${up3_id}/${ulp_id}/${month}/${year}`);
      
    })
    

  })
  
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
    const year = $("#year").val();

    const up3_id = $("#up3_id").val();
    let ulp_id = $("#ulp_id").val();
    let qFilter = "";
    if (month != "") {
      qFilter += `month=${month}`
    }
    if (year != "") {
      qFilter += `year=${year}`
    }
    if (up3_id != "") {
      qFilter += `&up3_id=${up3_id}`
    }

    if (ulp_id != "") {
      qFilter += `&ulp_id=${ulp_id}`
    }
    
    const params = {
      "url": "{{ url('/report/monthly') }}",
      "columns": [
        { "data": "name" },
        { "data": "total_wo" },
        { "data": "total_paid" },
        { "data": "total_debt" },
        { "data": "total_realisasi" },
        { "data": "total_persen" },
      ],
      "args": {
        "month": month,
        "year": year,
        "up3_id": up3_id,
        "ulp_id": ulp_id,
      }
    }
    
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: `${api}/report/monthly/list`,
      dataType:"json",
      data: params.args,
      success: function(response){
        if(response.length>0){
          response.map((row)=>{
            var total_persen =parseInt(row.total_realisasi)/parseInt(row.total_wo) * 100
            row.total_persen =total_persen.toFixed(2);
          })
          
          $('#boruto tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" size="15" placeholder="Search ' + title + '" />');
          });
          
          $('#boruto').DataTable({
            filter: true,
            paging: false,
            data:response,
            columns: params.columns,
            order: [[4, 'desc']],
            initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
          })
          
        }
      }
    });

    
  }

</script>
@endsection