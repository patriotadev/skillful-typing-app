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
        <a id="current-time" class="nav-link"></a>
      </li>
      <li class="mr-2">
        <div class="btn-group">
          <button class="text-dark border-0 mt-2 btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
          </button>
          <div class="dropdown-menu">
            <div class="container">
              <div class="row mt-2">
                <div class="col">
                  <i class="far fa-id-card mr-2">
                  </i>
                   <span onclick="toEditProfilePage()" class="user-name">Profile</span>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <i class="fas fa-share mr-2">
                  </i>
                   <span onclick="toLogout()" class="user-name">Logout</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a href="/logout" class="nav-link">
          <i class="fa fa-external-link"></i>
          Logout
        </a>
      </li> --}}
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

  toLogout = () => {
    window.location = '/logout'
  }

</script>