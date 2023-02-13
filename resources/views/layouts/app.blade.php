<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">

  @isset($pageConfigs)
  {!! App\Helpers\Helper::updatePageConfig($pageConfigs) !!}
  @endisset

  @php
  $config = App\Helpers\Helper::applClasses();
  @endphp

  <head>
    @include('layouts.head')
  </head>

  <body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static semi-dark-layout" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          @if($config['pageHeader']=== true && isset($breadcrumbs))
          @include('panels.breadcrumbs')
          @endif
        </div>
        <div class="content-body">
          @yield('content')
        </div>
      </div>
    </div>

    <!-- Button Floating Fix -->
    <div class="footer-buttons">

      @if($config['isReload'] === true && isset($config['isReload']))
      <button type="button" class="btn btn-icon rounded-circle btn-secondary glow mb-1" data-toggle="tooltip" data-placement="top" title="Refresh" onClick="window.location.reload();">
        <i class="bx bx-revision"></i>
      </button>
      @endif

      @can($config['permission']['create'])

      @if($config['isCreate'] === true && isset($config['isCreate']))

      <a data-toggle="tooltip" data-placement="top" title="Add" href="{{ url(Request::path().'/create') }}" class="btn btn-icon rounded-circle btn-primary glow mb-1">
        <i class="bx bx-plus"></i>
      </a>

      @endif

      @if($config['isCreateModal'] === true && isset($config['isCreateModal']))

      <button type="button" class="btn btn-icon rounded-circle btn-primary glow mb-1" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="onshowbtn" data-target="#modal">
        <i class="bx bx-plus"></i>
      </button>

      @endif

      @endcan

      @if($config['isBack'] === true && isset($config['isBack']))
      <button type="button" class="btn btn-icon rounded-circle btn-secondary glow mb-1" data-toggle="tooltip" data-placement="top" title="Back" onClick="window.history.back();">
        <i class="bx bx-left-arrow-alt"></i>
      </button>
      @endif

      @if($config['isExport'] === true)

      <a data-toggle="tooltip" data-placement="top" title="Download" class="btn btn-icon rounded-circle btn-info glow mb-1 white" id="btnDownload" type="button">
        <i class="bx bx-download"></i>
      </a>

      @endif

      @if($config['isSave'] === true && isset($config['isSave']))
      <button type="submit" class="btn btn-icon rounded-circle btn-primary glow mb-1" data-toggle="tooltip" data-placement="top" title="Save" id="btn-save">
        <i class="bx bx-save"></i>
      </button>
      @endif

    </div>

    @include('layouts.footer')
  </body>

</html>