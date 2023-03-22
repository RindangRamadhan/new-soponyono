@extends('layouts.app')
{{-- title --}}
@section('title','Manager Ulp')
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
            <form class="form-horizontal form-submit" action="{{ route('manager-ulps.update', $manager_ulp->id) }}" method="POST" novalidate>
              @csrf
              {{ method_field('PATCH') }}
              @include('pages.master-data.manager-ulps.form')
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
   

    $('#ulp_id').select2({
      data: @php echo json_encode($ulps) @endphp,
      placeholder: 'Pilih ULP'
    });

    $('#ulp_id').val(@php echo $manager_ulp->ulp_id @endphp).change()
    
  });


  $(document).on('change', '#ulp_id', function (e) {
    const data = $(this).select2('data')[0]
    const user = $('#user_id');

    user.html('').select2({
      data: [{id: '', text: ''}]
    });

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: `${api}/master-data/user/list-select`,
      dataType:"json",
      data: { ulp_id: data.id },
      success: function(response){
        user.select2({
          data: response,
          placeholder: 'Pilih Petugas'
        });
        user.val(@php echo $manager_ulp->user_id @endphp).change()
      }
    });
  })

</script>
@endsection