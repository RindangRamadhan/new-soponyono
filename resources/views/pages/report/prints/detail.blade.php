@extends('layouts.app')
{{-- title --}}
@section('title','Report Cetak')
{{-- vendor scripts --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
@endsection
@section('content')

<!-- Multiple Rules Validation start -->
<section class="multiple-validation">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Detail @yield('title')</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama Petugas</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" class="form-control " value="{{ $user->officer_name }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>RBM</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" class="form-control " value="{{ $user->rbm_code }}" readonly>

                  </div>
                </div>
              </div>

            </div>
            <div class="table-responsive">
              <table id="table" class="table table-sm table-ssr nowrap">
                <thead>
                  <tr>
                    <th>ID PEL</th>
                    <th>Nama</th>
                    <th>Tarif</th>
                    <th>Daya</th>
                    <th>Rp.Tag</th>
                    <th>Status Cetak</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $row)
                  <tr>
                    <td>{{ $row->customer_id }}</td>
                    <td>{{ $row->customer_name }}</td>
                    <td>{{ $row->tarif }}</td>
                    <td>{{ $row->power }}</td>
                    <td>{{ $row->bill }}</td>
                    @if ($row->printout_status==='Belum')
                    <td style="background-color:#ff6666">{{ $row->printout_status }}</td>
                    @else
                    <td style="background-color:#b3ff99" >{{ $row->printout_status }}</td>
                    @endif

                    <td><a href="{{ url("/report/print/cetak-order/$row->id") }}" class='btn btn-icon rounded-circle btn-info'>
                      <i class='bx bx-printer'></i>
                    </a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Multiple Rule Validation end -->

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script>
  $(document).ready(function () {
    $('#table').DataTable({
      filter: true,
    });
});
</script>
@endsection