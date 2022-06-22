@extends('layout.base')


@section('content')
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
          @if (Session::has('edit_profile_success'))
          <div class="alert alert-success" role="alert">
              {{ session('edit_profile_success') }}
          </div>
          @endif
       <div class="card">
        <form id="form-edit-profile" action="/profile/{{ $user_id }}" method="post">
        @csrf
        <div class="card-header">
           <h3 class="card-title">Teacher Profile</h3>
        </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input value="{{ $fullname }}" type="text" class="@error ('fullname') is-invalid @enderror form-control mb-2" name="fullname" id="fullname" placeholder="Enter Name">                       
                        @error ('fullname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input value="{{ $phone }}" type="text" class="@error ('phone') is-invalid @enderror form-control mb-2" name="phone" id="phone" placeholder="Enter Phone">                       
                        @error ('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input value="{{ $email }}" type="email" class="@error ('email') is-invalid @enderror form-control mb-2" name="email" id="email" placeholder="Enter Email">                       
                        @error ('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input value="{{ $username }}" pattern="[a-z0-9_\.]+" type="text" class="@error ('username') is-invalid @enderror form-control mb-2" name="username" id="username" placeholder="Enter Username">                       
                      @error ('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Password</label>
                      <input type="password" class="@error ('password') is-invalid @enderror form-control mb-2" name="password" id="password" placeholder="Enter New Password">                       
                      @error ('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirm New Password</label>
                      <input value="" type="password" class="@error ('confirm_new_password') is-invalid @enderror form-control mb-2" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">                       
                      @error ('confirm_new_password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>
                  </div>
                </div>
                <div class="row">
                  {{-- <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Level</label>
                      <select class="@error ('level') is-invalid @enderror form-control" id="level" name="level">
                          <option value="">-- Level --</option>
                          <option {{ $level == 'Beginner' ? 'selected' : '' }} value="Beginner">Beginner</option>
                          <option {{ $level == 'Intermediate' ? 'selected' : '' }} value="Intermediate">Intermediate</option>
                          <option {{ $level == 'Advanced' ? 'selected' : '' }} value="Advanced">Advanced</option>
                      </select>
                      @error ('level')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror 
                  </div>
                  </div> --}}
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <div class="d-flex justify-content-around">
                          <div class="form-check">
                              <input {{ $status == 1 ? 'checked' : '' }} class="@error ('status') is-invalid @enderror form-check-input status" type="radio" id="status_active" name="status" value="1">
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
                              <input {{ $status == 0 ? 'checked' : '' }} class="@error ('status') is-invalid @enderror form-check-input status" type="radio" id="status_not_active" name="status" value="0">
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
                  <div class="col">

                  </div>
                </div>
            </div>
        </div>
         <!-- /.card-body -->
        <div class="card-footer">
             <div class="d-flex justify-content-end">
                 <button type="submit" class="btn btn-primary">Update</button>
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