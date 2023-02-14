@extends('layouts.app')
{{-- title --}}
@section('title','Ulp')
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
            <form class="form-horizontal form-submit" action="{{ route('ulps.update', $rsdata->id) }}" method="POST" novalidate>
              @csrf
              {{ method_field('PATCH') }}
              @include('pages.master-data.ulps.form')
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
    var kode=$('[name="id"]');
    kode[0].disabled=true;

    $('#up3_id').select2({
      data: @php echo json_encode($up3s) @endphp,
      placeholder: 'Pilih UP3'
    });

    $('#up3_id').val(@php echo $rsdata->up3_id @endphp).change()
    
  });

</script>
@endsection