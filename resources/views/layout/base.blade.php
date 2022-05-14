<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Water+Brush&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <link rel="shortcut icon" href="{{ asset('images/typing.png') }}"/>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">


  @include('layout.navbar')

  @include('layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->


  @include('layout.footer')
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>


<!-- Bootstrap -->
<script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


@yield('js')

<script>

  $('#table').DataTable({
  })

  const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  width:350,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
  })
  function msg(icon,title){
  Toast.fire({ icon, title })
  }
</script>

<!-- AdminLTE -->
<script src="{{ asset('admin_lte/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin_lte/plugins/chart.js/Chart.min.js') }} "></script>

<script src="{{ asset('admin_lte/dist/js/pages/dashboard3.js') }} "></script>

<script>
  // Current Time
  $time = new Date().toLocaleDateString();
  $('#current-time').text($time)

</script>

</body>
</html>
