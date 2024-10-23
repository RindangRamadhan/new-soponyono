@extends('layouts.app')
{{-- title --}}
@section('title','Hak Akses')
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
          <h4 class="card-title">Tambah @yield('title')</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form-horizontal form-submit" action="{{ url('/master-data/roles') }}" method="post" novalidate>
              @csrf
              @include('pages.master-data.roles.form')
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
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/extensions/tree.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>

<script>
  const data = @php echo json_encode($permissions) @endphp;

  new Tree('.tree-view', {
    data: [{ id: '-1', text: 'All', children: @php echo json_encode($permissions) @endphp }],
    closeDepth: 4,
    loaded: function () {
      this.values = [-1]
    },
    onChange: function () {
      const values = this.selectedNodes.reduce((x, y) => ((y.id != "-1") && x.push(y.id), x), [])      
      $("#permission").val(values)
    }
})
</script>
@endsection