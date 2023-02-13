<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - {{ env('APP_NAME') }}</title>
<link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
<link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.png')}}">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/sweetalert2.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/themes/semi-dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/dropify/dropify.css')}}">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('css/core/menu/menu-types/vertical-menu.css')}}">
<!-- END: Page CSS-->

{{-- Include core + vendor Styles --}}
@include('panels.styles')