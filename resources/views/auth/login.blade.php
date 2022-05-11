<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Typing App | Login</title>

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
              <div class="card mt-5 shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 bg-dark rounded">
                <h3 class="title mb-5 text-center">Typing App</h3>
                <form action="/login/post" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                      <label class="form-label">Username</label>
                      <input type="text" name="username" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control form-control-lg" />
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
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
