<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{asset('backend/css/material-dashboard.css')}}" rel="stylesheet" />


  
  @stack('css')
</head>
<body>
    <div id="app">
      @yield('login')
      @yield('register')
  <div class="panel-wrapper ">
    @if(Request::is('admin*'))
    @include('layouts.partial.sidebar ')
    @endif
    <div class="main-panel">
      <!-- Navbar -->
    @if(Request::is('admin*'))
      @include('layouts.partial.topbar ')
    @endif
      <!-- End Navbar -->
   
      @yield('content')
    @if(Request::is('admin*'))
      @include('layouts.partial.footer')
    @endif
    </div>
  </div>  
    </div>


        
 <!--   Core JS Files   -->
  <script src="{{asset('backend/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('backend/js/core/popper.min.js')}}"></script>
  <script src="{{asset('backend/js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('backend/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- Chartist JS -->
  <script src="{{asset('backend/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('backend/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('backend/js/material-dashboard.min.js')}}"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->   

  @stack('scripts') 
  
</body>
</html>
