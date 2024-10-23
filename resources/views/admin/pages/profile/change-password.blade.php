@extends('layouts.app')
{{-- page title --}}
@section('title','Ubah Password')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
@endsection

@section('content')
<section id="basic-tabs-components">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <form class="form-horizontal form-submit" action="{{ url("/users/$user->id/change-password" ) }}" method="POST" novalidate>
          @csrf
          {{ method_field('PATCH') }}
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Kata Sandi Sekarang</label>
                <div class="controls form-label-group position-relative  has-icon-left">
                  <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Kata Sandi Sekarang" required data-validation-required-message="This current_password field is required" autofocus>
                  <a href="javascript:void(0)" class="__show-hide-pw __curr-password">
                    <img src="https://icongr.am/fontawesome/eye.svg?size=16&color=696969" alt="" srcset="">
                  </a>
                  <div class="form-control-position">
                    <i class="bx bx-lock"></i>
                  </div>
                  <!-- Error Message -->
                  @error('current_password')
                  <div class="help-block">
                    <ul role="alert">
                      <li>{{ $message }}</li>
                    </ul>
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Kata Sandi Baru</label>
                <div class="controls form-label-group position-relative has-icon-left">
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi Baru" required data-validation-required-message="This password field is required" autofocus>
                  <a href="javascript:void(0)" class="__show-hide-pw __password">
                    <img src="https://icongr.am/fontawesome/eye.svg?size=16&color=696969" alt="" srcset="">
                  </a>
                  <div class="form-control-position">
                    <i class="bx bx-lock"></i>
                  </div>
                  <!-- Error Message -->
                  @error('password')
                  <div class="help-block">
                    <ul role="alert">
                      <li>{{ $message }}</li>
                    </ul>
                  </div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>
<script>
  @if (Session::get('status') == 200)
    $(document).ready(function(){
      toastr.success('Data has been saved', 'Success', { "progressBar": true, "showDuration": 500, "closeButton": true })
    });
  @endif
  
  @if (Session::get('status') == 500)
    $(document).ready(function(){
      let text = "{{ Session::get('message') }}"
      toastr.error(text, 'Success', { "progressBar": true, "showDuration": 500, "closeButton": true })
    });
  @endif


  // Show hide password
  $(document).on('click', '.__password', function (e) {
    console.log("__show-hide")
    const type = $("#password").attr('type') == 'password' ? 'text' : 'password'
    const icon = $("#password").attr('type') == 'password' ? 'eye-slash' : 'eye'
    
    $("#password").attr('type', type)
    $(this).children('img').attr('src', `https://icongr.am/fontawesome/${icon}.svg?size=16&color=696969`)
  })

  // Show hide password
  $(document).on('click', '.__curr-password', function (e) {
    console.log("__show-hide-curr")
    const type = $("#current_password").attr('type') == 'password' ? 'text' : 'password'
    const icon = $("#current_password").attr('type') == 'password' ? 'eye-slash' : 'eye'
    
    $("#current_password").attr('type', type)
    $(this).children('img').attr('src', `https://icongr.am/fontawesome/${icon}.svg?size=16&color=696969`)
  })
</script>
@endsection