@extends('layouts.app')
{{-- title --}}
@section('title','Detail')
{{-- vendor scripts --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
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
                  <label>UP3</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="up3" class="form-control" value="{{ $order->up3_name }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>ULP</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="ulp" class="form-control" value="{{ $order->ulp_name }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama Petugas</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" class="form-control " value="{{ $order->officer_name }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>RBM</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" class="form-control " value="{{ $order->rbm_code }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>ID PEL</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" class="form-control " value="{{ $order->customer_id }}" readonly>

                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="name" class="form-control " value="{{ $order->customer_name }}" readonly>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>No Telp</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="name" class="form-control " value="{{ $order->phone_number }}" readonly>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tarif</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="tarif" class="form-control " value="{{ $order->tarif }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Daya</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="power" class="form-control " value="{{ $order->power }}" readonly>

                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Gardu</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="substation" class="form-control " value="{{ $order->substation }}"
                      readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Alamat</label>
                  <div class="controls form-label-group position-relative ">
                    <textarea class="form-control editors" name="customer_address" rows="10" cols="30"
                      readonly>{{ $order->customer_address }}</textarea>

                  </div>
                </div>
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">
                  <label>RP TAG</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="bill" class="form-control " value="{{ $order->bill }}" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tanggal Upload</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" id="update_at" name="update_at" class="form-control " value="" readonly>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Status Cetak</label>
                  <div class="controls form-label-group position-relative ">
                    <input type="text" name="class" class="form-control " value="{{ $order->status_cetak }}" readonly>

                  </div>
                </div>
              </div>
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
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script src="{{asset('js/scripts/forms/validation/form-validation.js')}}"></script>

<script>
  $(document).ready(function() {
    const data = @php echo $order @endphp;
    document.getElementById("update_at").value=createTanggalIndo(data.update_at)

  });

</script>
@endsection