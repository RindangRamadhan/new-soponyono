@extends('layouts.app')

{{-- page Title --}}
@section('title','Dashboard')

{{-- vendor scripts --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-analytics.css')}}">
@endsection

@section('content')

<!-- Dashboard Starts -->
<section class="invoice-list-wrapper">
  <div class="row">
    <div class="col-12 col-sm-3">
      <div class="form-group">
        <label>UP3</label>
        <fieldset class="form-group position-relative has-icon-left mb-0">
          <select id="up3_id" name="up3_id" class="select2 form-control filter-change">
            <option></option>
          </select>
          <div class="form-control-position">
            <i class="bx bx-edit-alt"></i>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="col-12 col-sm-3">
      <div class="form-group">
        <label>ULP</label>
        <fieldset class="form-group position-relative has-icon-left mb-0">
          <select id="ulp_id" name="ulp_id" class="select2 form-control filter-change">
            <option></option>
          </select>
          <div class="form-control-position">
            <i class="bx bx-edit-alt"></i>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="col-12 col-sm-3">
      <div class="form-group">
        <label>Bulan</label>
        <fieldset class="form-group position-relative has-icon-left mb-0">
          <select id="month" name="month" class="select2 form-control filter-change">
            <option></option>
          </select>
          <div class="form-control-position">
            <i class="bx bx-edit-alt"></i>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="col-12 col-sm-3">
      <div class="form-group">
        <label>Tahun</label>
        <fieldset class="form-group position-relative has-icon-left mb-0">
          <select id="year" name="year" class="select2 form-control filter-change">
            <option></option>
          </select>
          <div class="form-control-position">
            <i class="bx bx-edit-alt"></i>
          </div>
        </fieldset>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="d-flex align-items-center">
              <h6>Total Order</h6>
              <i class="bx bx-info-circle" style="margin-bottom: 7px; margin-left: 5px"></i>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="card mb-0 border rounded">
                  <div class="card-header d-flex align-items-center" style="padding: 1rem">
                    <div class="avatar bg-rgba-warning m-0 mr-75" style="border-radius: 10%;">
                      <div class="avatar-content">
                        <i class="bx bx-repeat warning"></i>
                      </div>
                    </div>
                    <label style="margin: auto 0px">Total WO</label>
                  </div>
                  <div class="card-content">
                    <div class="card-body" style="padding-left: 1rem">
                      <div class="d-flex align-items-end">
                        <div class="registration-content">
                          <h3 class="mb-0" id="total_wo">@number(0)</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card mb-0 border rounded">
                  <div class="card-header d-flex align-items-center" style="padding: 1rem">
                    <div class="avatar bg-rgba-success m-0 mr-75" style="border-radius: 10%;">
                      <div class="avatar-content">
                        <i class="bx bx-dollar-circle success"></i>
                      </div>
                    </div>
                    <label style="margin: auto 0px">Total Lunas</label>
                  </div>
                  <div class="card-content">
                    <div class="card-body" style="padding-left: 1rem">
                      <div class="d-flex align-items-end">
                        <div class="registration-content">
                          <h3 class="mb-0" id="total_paid">@number(0)</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card mb-0 border rounded">
                  <div class="card-header d-flex align-items-center" style="padding: 1rem">
                    <div class="avatar bg-rgba-info m-0 mr-75" style="border-radius: 10%;">
                      <div class="avatar-content">
                        <i class="bx bx-user-minus info"></i>
                      </div>
                    </div>
                    <label style="margin: auto 0px">Total Janji</label>
                  </div>
                  <div class="card-content">
                    <div class="card-body" style="padding-left: 1rem">
                      <div class="d-flex align-items-end">
                        <div class="registration-content">
                          <h3 class="mb-0" id="total_promise">@number(0)</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card mb-0 border rounded">
                  <div class="card-header d-flex align-items-center" style="padding: 1rem">
                    <div class="avatar bg-rgba-danger m-0 mr-75" style="border-radius: 10%;">
                      <div class="avatar-content">
                        <i class="bx bx-user-x danger"></i>
                      </div>
                    </div>
                    <label style="margin: auto 0px">Total Tidak Dieksekusi</label>
                  </div>
                  <div class="card-content">
                    <div class="card-body" style="padding-left: 1rem">
                      <div class="d-flex align-items-end">
                        <div class="registration-content">
                          <h3 class="mb-0" id="total_not_executed">@number(0)</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-5">
      <div class="card">
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="d-flex align-items-center mt-1 mb-2">
              <h6>Grafik Status Order</h6>
              <i class="bx bx-info-circle" style="margin-bottom: 7px; margin-left: 5px"></i>
            </div>
            <div id="status-order-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="card">
        <div class="card-content">
          <div class="card-body card-dashboard" style="padding-bottom: 0.7rem;">
            <div class="d-flex align-items-center">
              <h6>Top 10 Petugas</h6>
              <i class="bx bx-info-circle" style="margin-bottom: 7px; margin-left: 5px"></i>

              <ul class="nav nav-pills ml-2">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" aria-expanded="true" style="border-radius: 100px">
                    Tertinggi 3 Bulan Terakhir
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="pill" href="#profile" aria-expanded="false" style="border-radius: 100px">
                    Terendah 3 Bulan Terakhir
                  </a>
                </li>
              </ul>
            </div>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                <div class="table-responsive">
                  <table id="table-marketing-campaigns" class="table table-borderless table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Lunas</th>
                        <th>Janji Bayar</th>
                      </tr>
                    </thead>
                    <tbody id="top_officers"></tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                <div class="table-responsive">
                  <table id="table-marketing-campaigns" class="table table-borderless table-sm mb-0">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Lunas</th>
                        <th>Janji Bayar</th>
                      </tr>
                    </thead>
                    <tbody id="bottom_officers"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="status_orders">
</section>
<!-- Dashboard loan end -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/moment.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>

<script>
  $(document).ready(function() {
    const date = moment();

    $('#up3_id').select2({
      data: @php echo json_encode($up3s) @endphp,
      placeholder: 'Pilih UP3'
    });

    $('#month').select2({
      data: @php echo json_encode($months) @endphp,
      placeholder: 'Pilih Bulan'
    });

    $('#year').select2({
      data: @php echo json_encode($years) @endphp,
      placeholder: 'Pilih Tahun'
    });

    $('#ulp_id').select2({
      placeholder: 'Pilih ULP'
    });

    $("#month").val(date.month() + 1).change();
    $("#year").val(date.year()).change();

    const params = {
      up3_id: $("#up3_id").val(),
      ulp_id: $("#ulp_id").val(),
      month: $("#month").val(),
      year: $("#year").val(),
    }

    initOrderStatusChart();
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

  $(document).on('change', '.filter-change', function (e) {
    const params = {
      up3_id: $("#up3_id").val(),
      ulp_id: $("#ulp_id").val(),
      month: $("#month").val(),
      year: $("#year").val(),
    }

    if (params.month != "" && params.year != "") {
      filterDashboard(params);
    }
  })

  function filterDashboard(params) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('dashboard.filter') }}",
      type: 'POST',
      dataType: "JSON",
      data: { ...params },
      success: function (resp) {

        if (resp.status_orders.length == 1) {
          $("#status_orders").val(JSON.stringify(resp.status_orders[0]));
        }

        let top_officers = '';
        let bottom_officers = '';

        for (const el of resp.top_officers) {
          top_officers += `
            <tr>
              <td>${el.name}</td>
              <td>${number(el.total_paid)}</td>
              <td>${number(el.total_debt)}</td>
            </tr>
          `
        }
        
        if (resp.top_officers.length == 0) {
          top_officers = '<tr><td colspan="3">No Record Found</td></tr>'
        }

        for (const el of resp.bottom_officers) {
          bottom_officers += `
            <tr>
              <td>${el.name}</td>
              <td>${number(el.total_paid)}</td>
              <td>${number(el.total_debt)}</td>
            </tr>
          `
        }
        
        if (resp.bottom_officers.length == 0) {
          bottom_officers = '<tr><td colspan="3">No Record Found</td></tr>'
        }

        $("#top_officers").html(top_officers)
        $("#bottom_officers").html(bottom_officers)

        $("#total_wo").text(number(resp.total_wo))
        $("#total_paid").text(number(resp.total_paid))
        $("#total_promise").text(number(resp.total_promise))
        $("#total_not_executed").text(number(resp.total_not_executed))

        updateSummaryChart(resp.summary)
      },
      error: function(xhr) {}
    });
  }
</script>
@endsection