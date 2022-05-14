<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><span class="text-bold">Hello, </span>{{ session('user_name') }}</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item d-none d-sm-inline-block">
        <a id="current-time" class="nav-link">Header</a>
      </li>
      <li class="nav-item">
        <a href="/logout" class="nav-link">
          <i class="fa fa-external-link"></i>
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->