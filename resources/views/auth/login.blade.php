<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Skillful Typing | Login</title>

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
</head>
<body class="hold-transition login-page">
        <div class="container py-5 mt-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              @if (Session::has('fail_user'))       
              <div class="alert alert-danger" role="alert">
                {{ session('fail_user') }}
              </div>
              @endif
              @if (Session::has('fail_pass'))       
              <div class="alert alert-danger" role="alert">
                {{ session('fail_pass') }}
              </div>
              @endif
              <div class="card mt-5 shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 bg-dark rounded">
                <div class="logo d-flex justify-content-center mb-3">
                  <img src="{{ asset('/images/typing.png') }}" alt="" width="80">
                </div>
                <h3 class="title mb-5 text-center">Skillful -- Typing</h3>
                <form action="/login/post" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                      <label class="form-label">Username</label>
                      <input type="text" name="username" class="@error ('username') is-invalid @enderror form-control form-control-lg" />
                      @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="@error ('password') is-invalid @enderror form-control form-control-lg" />
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    <div class="d-flex justify-content-end mt-3">
                      <a href="/">Login as Guest &rarr;</a>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- jQuery -->
<script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- AdminLTE -->
<script src="{{ asset('admin_lte/dist/js/adminlte.js') }}"></script>

<script>
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

</body>
</html>

<style>
    .login-page {
        background-image: linear-gradient(to right, #ffffff, #4e546e)
    }

    .title {
        font-family: 'Water Brush', cursive;
    }
</style>
