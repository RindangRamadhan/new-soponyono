@extends('layouts.full')
{{-- title --}}
@section('title','Login Page')
{{-- vendor scripts --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
<style>
  .login-bg {
    background-image: url("{{ asset('images/login-bg.png') }}");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .login-ic {
    position: relative;
  }

  .login-ic img {
    position: absolute;
    top: 20px;
    left: 30px;
  }

</style>
@endsection

@section('content')
<!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-5 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none login-bg">
    <div class="login-ic">
      <img src="{{ asset('images/login-ic.png') }}" />
    </div>
  </div>
  <div class="col-sm-7" style="background: #F5F5F5">
    <div class="row justify-content-md-center">
      <div class="col-sm-6">
        <h3 class="text-center" style="font-weight: bolder; color: #009C9F;">SIMPHEL</h3>
        <h5 class="text-center mb-2">
          Sistem Informasi Monitoring Pinjaman <br> Hibah Elektronik
        </h5>
        <div class="card bg-authentication mb-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h3 class="text-center">Lupa Password</h3>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <form method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="form-group mb-50">
                    <label class="text-bold-600" for="nip">User Name</label>
                    <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" autocomplete="nip" autofocus placeholder="User Name">
                    @error('nip')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                    <div class="text-right">
                      <a href="{{ url('login') }}" class="card-link"><small>Sudah Punya Akun ?</small></a>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary glow w-100 position-relative">Submit
                    <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login page ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script>
  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
  });

  // Show hide password
  $(document).on('click', '.__password', function (e) {
    const type = $("#password").attr('type') == 'password' ? 'text' : 'password'
    const icon = $("#password").attr('type') == 'password' ? 'eye-slash' : 'eye'
    
    $("#password").attr('type', type)
    $(this).children('img').attr('src', `https://icongr.am/fontawesome/${icon}.svg?size=16&color=696969`)
  })
</script>
@endsection