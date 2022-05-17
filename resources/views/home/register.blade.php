@extends('layout.base')


@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-between">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Lesson Editor</h1> --}}
        </div><!-- /.col -->
        <div>
          {{-- <button class="btn btn-primary" onclick="openAddCourseModal()">Add Course</button> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            @if (Session::has('add_teacher_success'))
            <div class="alert alert-success" role="alert">
                {{ session('add_teacher_success') }}
            </div>
            @endif
       <div class="card">
        <form id="form-add-teacher" action="/register" method="post">
        @csrf
        <div class="card-header">
           <h3 class="card-title">Register as a teacher</h3>
        </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" class="@error ('fullname') is-invalid @enderror form-control mb-2" name="fullname" id="fullname" placeholder="Enter Name">                       
                            @error ('fullname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Birth</label>
                            <input type="date" class="@error ('birth') is-invalid @enderror form-control mb-2" name="birth" id="birth" placeholder="Enter Birth Date">                       
                            @error ('birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Gender</label>
                            <select class="@error ('gender') is-invalid @enderror form-control" id="gender" name="gender">
                                <option value="">-- Gender --</option>
                                <option value="Man">Man</option>
                                <option value="Woman">Woman</option>
                            </select>
                            @error ('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">City</label>
                            <input type="text" class="@error ('city') is-invalid @enderror form-control mb-2" name="city" id="city" placeholder="Enter City">
                            @error ('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror                      
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="@error ('phone') is-invalid @enderror form-control mb-2" name="phone" id="phone" placeholder="Enter Phone">
                            @error ('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror              
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="@error ('email') is-invalid @enderror form-control mb-2" name="email" id="email" placeholder="Enter Email">       
                            @error ('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror             
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="@error ('username') is-invalid @enderror form-control mb-2" name="username" id="username" placeholder="Enter Username">                       
                            @error ('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror      
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="@error ('password') is-invalid @enderror form-control mb-2" name="password" id="password" placeholder="Enter Password">                       
                            @error ('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>
                        <div class="form-group"> 
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" class="@error ('confirm_pass') is-invalid @enderror form-control mb-2" name="confirm_pass" id="confirm_pass" placeholder="Enter Confirm Password">                       
                            @error ('confirm_pass')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Level</label>
                            <select class="@error ('level') is-invalid @enderror form-control" id="level" name="level">
                                <option value="">-- Level --</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                            @error ('level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <div class="d-flex justify-content-around">
                                <div class="form-check">
                                    <input class="@error ('status') is-invalid @enderror form-check-input status" type="radio" id="status_active" name="status" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Active
                                    </label>
                                    @error ('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input class="@error ('status') is-invalid @enderror form-check-input status" type="radio" id="status_not_active" name="status" value="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Not Active
                                    </label>
                                    @error ('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>
        </div>
         <!-- /.card-body -->
        <div class="card-footer">
             <div class="d-flex justify-content-end">
                 {{-- <button class="btn btn-primary">Start</button> --}}
                 <button type="submit" class="btn btn-primary">Save</button>
             </div>
         </div>
        </form>
        </div>
       <!-- /.card -->
      </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
<!-- /.content -->
@endsection

@section('js')

@endsection