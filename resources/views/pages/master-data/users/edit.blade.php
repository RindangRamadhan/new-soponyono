@extends('layouts.app')
{{-- title --}}
@section('title','Pengguna')
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
          <h4 class="card-title">Edit @yield('title')</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form-horizontal form-submit" action="{{ route('users.update', $user->id) }}" method="POST" novalidate>
              @csrf
              {{ method_field('PATCH') }}
              @include('pages.master-data.users.form')
            </form>
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
<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>

<script>
  $(document).ready(function() {
    $('#type').select2({
      data: @php echo json_encode($types) @endphp,
      placeholder: 'Pilih Tipe'
    });

    $('#role_id').select2({
      data: @php echo json_encode($roles) @endphp,
      placeholder: 'Pilih Hak Akses'
    });

    $('#uid_id').select2({
      data: @php echo json_encode($uids) @endphp,
      placeholder: 'Pilih UID'
    });

    $('#up3_id').select2({
        placeholder: 'Pilih UP3'
    });
    
    $('#ulp_id').select2({
      placeholder: 'Pilih ULP'
    });

    $('#type').val("@php echo $user->type @endphp").change()
    $('#uid_id').val(@php echo $user->uid_id @endphp).change()
    $('#role_id').val(@php echo $user->role_id @endphp).change()
  });


  $(document).on('change', '#uid_id', function (e) {
    const data = $(this).select2('data')[0]
    const up3 = $('#up3_id');

    up3.html('').select2({
      data: [{id: '', text: ''}]
    });
    
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: `${api}/master-data/up3/list-select`,
      dataType:"json",
      data: { uid_id: data.id },
      success: function(response){
        up3.select2({
          data: response,
          placeholder: 'Pilih Satuan Kerja'
        });

        console.log(@php echo $user->up3_id @endphp)
        up3.val(@php echo $user->up3_id @endphp).change()
      }
    });
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
          placeholder: 'Pilih Satuan Kerja'
        });

        ulp.val(@php echo $user->ulp_id @endphp).change()
      }
    });
  })
</script>
@endsection