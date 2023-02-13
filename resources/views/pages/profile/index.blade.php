@extends('layouts.app')
{{-- page title --}}
@section('title','Profil')

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
        <div class="row">
          <div class="col-sm-4">
            <div class="media mb-1 d-flex justify-content-center">
              <a class="mr-1" href="#">
                <img src="https://ui-avatars.com/api/?name={{$user->name}}" alt="users view avatar" class="users-avatar-shadow round" height="100" width="100">
              </a>
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center">
              <h5 class="card-title mb-0">{{ $user->name }}</h5>
            </div>

            <h5 class="card-title">Informasi</h5>
            <table>
              <tr>
                <td width="50%">
                  <i class="cursor-pointer bx bx-group mr-50"></i>
                  Tipe User
                </td>
                <td width="10%">:</td>
                <td>{{ $user->type }}</td>
              </tr>
              <tr>
                <td width="50%">
                  <i class="cursor-pointer bx bx-lock mr-50"></i>
                  Hak Akses
                </td>
                <td width="10%">:</td>
                <td>{{ $user->role_name }}</td>
              </tr>
            </table>
          </div>
          <div class="col-sm-8">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
                  <i class="bx bx-user align-middle"></i>
                  <span class="align-middle">Profil</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" aria-controls="edit-profile" role="tab" aria-selected="true">
                  <i class="bx bx-edit align-middle"></i>
                  <span class="align-middle">Edit Profil</span>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                @include('pages.profile.show')
              </div>
              <div class="tab-pane active" id="edit-profile" aria-labelledby="edit-profile-tab" role="tabpanel">
                <form action="{{ url("/users/$user->id/profile" ) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  {{ method_field('PATCH') }}
                  @include('pages.profile.form')

                  <button type="submit" class="btn btn-outline-primary mr-1 mb-1">
                    <i class="bx bx-save"></i>
                    <span class="align-middle ml-25">Simpan</span>
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
  
  $(document).ready(function() {
    $('#role_id').select2({
      data: @php echo json_encode($roles) @endphp,
      placeholder: 'Pilih Hak Akses'
    });

    $('#role_id').val(@php echo $user->role_id @endphp).change()
  });
</script>
@endsection