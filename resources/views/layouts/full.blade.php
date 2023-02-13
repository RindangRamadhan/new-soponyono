<!DOCTYPE html>

{{-- pageConfigs variable pass to Helper's updatePageConfig function to update page configuration  --}}
@isset($pageConfigs)
{!! App\Helpers\Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
// confiData variable layoutClasses array in Helper.php file.
$config = App\Helpers\Helper::applClasses();
@endphp

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.png')}}">

    {{-- Include core + vendor Styles --}}
    @include('panels.styles')

    <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 5px !important;
      }

    </style>
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->

  <body class="vertical-layout 1-column navbar-sticky {{$config['bodyCustomClass']}} footer-static blank-page
  @if($config['theme'] === 'dark'){{'dark-layout'}} @elseif($config['theme'] === 'semi-dark'){{'semi-dark-layout'}} @else {{'light-layout'}} @endif" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-scripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('js/core/app.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page-scripts')
    <!-- END: Page JS-->

    @stack('scripts')

  </body>
  <!-- END: Body-->

</html>