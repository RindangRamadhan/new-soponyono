@extends('layouts.app')
{{-- title --}}
@section('title','Pelanggan')
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
                  <label>UID</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="uid_name" class="form-control" value="{{ $customer->uid_name }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>UP3</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="up3" class="form-control" value="{{ $customer->up3_name }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>ULP</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="ulp" class="form-control" value="{{ $customer->ulp_name }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>ULP</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="ulp" class="form-control" value="{{ $customer->ulp_name }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>ID PEL</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="id_pel" class="form-control " value="{{ $customer->id_pel }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="name" class="form-control " value="{{ $customer->name }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>No Telp</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="phone_number" class="form-control " value="{{ $customer->phone_number }}"
                      readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tarif</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="tarif" class="form-control " value="{{ $customer->tarif }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Daya</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="daya" class="form-control " value="{{ $customer->daya }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Kogol</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="kogol" class="form-control " value="{{ $customer->kogol }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Gardu</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="gardu" class="form-control " value="{{ $customer->gardu }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Alamat</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <textarea class="form-control editors" name="address" rows="10" cols="30"
                      readonly>{{ $customer->address }}</textarea>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Status</label>
                  <div class="controls form-label-group position-relative has-icon-left">
                    <input type="text" name="status" class="form-control " value="{{ $customer->status }}" readonly>
                    <div class="form-control-position">
                      <i class="bx bx-edit-alt"></i>
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
    
  });

</script>
@endsection