<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><span class="text-bold">Hello, </span><span onclick="toEditProfilePage()" class="user-name">{{ session('user_name') }}</span></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @if (session('hasLogin'))
      <li class="nav-item d-none d-sm-inline-block">
        <a id="current-time" class="nav-link">Header</a>
      </li>
      <li class="nav-item">
        <a href="/logout" class="nav-link">
          <i class="fa fa-external-link"></i>
          Logout
        </a>
      </li>
      @else
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="fa fa-external-link"></i>
          Home
        </a>
      </li>
      <li class="nav-item">
        <a href="/register" class="nav-link">
          <i class="fa fa-external-link"></i>
          Register as a teacher
        </a>
      </li>
      <li class="nav-item">
        <a href="/about" class="nav-link">
          <i class="fa fa-external-link"></i>
          About Us
        </a>
      </li>
      <li class="nav-item">
        <a href="/login" class="nav-link">
          <i class="fa fa-external-link"></i>
          Login
        </a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->


<style>
  .user-name:hover {
    cursor: pointer;
  }
</style>


<script>
  toEditProfilePage = () => {
    window.location = '/profile/<?= session('user_id') ?>'
  }
</script>