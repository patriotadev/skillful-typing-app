<!-- Add Class Modal -->
<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-add-user" action="/admin/users/add" method="POST">
        <div class="modal-body">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIM</label>
                            <input type="text" class="form-control mb-2" name="nim" placeholder="Enter NIM" required>
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" class="form-control mb-2" name="fullname" placeholder="Enter Name" required>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Class</label>
                            <select class="form-control" id="user_class" name="class" required>
                                <option value="">-- Class --</option>
                            @foreach ($class as $class)
                                <option value="{{$class->class_id}}">{{$class->class_name}}</option>    
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Major</label>
                            <input type="text" class="form-control mb-2" name="major" placeholder="Enter Major" required>     
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control mb-2" name="phone" placeholder="Enter Phone" required>     
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control mb-2" name="email" placeholder="Enter Email" required>     
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" pattern="[a-z0-9_\.]+" autocomplete="off" class="form-control mb-2" name="username" placeholder="Enter Username" required>
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" autocomplete="off" class="form-control mb-2" name="password" placeholder="Enter Password" required>
                            {{-- <label for="exampleInputEmail1" class="mt-2">Confirmation Password</label>
                            <input type="password" class="form-control mb-2" name="conf_password" placeholder="Enter Confirmation" required> --}}
                            <div class="form-group mt-3">
                                <label for="exampleFormControlSelect1">Roles</label>
                                <select class="form-control" name="roles" required>
                                    <option value="">-- Roles --</option>
                                    {{-- <option value="Admin">Admin</option> --}}
                                    <option value="Student">Student</option>
                                </select>
                            </div>
                            {{-- <div class="form-group mt-3">
                                <label for="exampleFormControlSelect1">Level</label>
                                <select class="form-control" id="user_class" name="level" required>
                                    <option value="">-- Level --</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div> --}}
                            <label for="exampleInputEmail1">Status</label>
                            <div class="d-flex justify-content-around">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"  value="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Not Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
</div>

<!-- Update Class Modal -->
<div class="modal fade" id="modal-update-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-update-user" action="/admin/users/update" method="POST">
        <div class="modal-body">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" class="form-control mb-2" name="id" id="id">
                            <label for="exampleInputEmail1">NIM</label>
                            <input type="text" class="form-control mb-2" name="nim" id="nim" placeholder="Enter NIM" required>
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" class="form-control mb-2" name="fullname" id="fullname" placeholder="Enter Name" required>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Class</label>
                            <select class="form-control" id="class" name="class" required>
                                <option value="">-- Class --</option>
                            @foreach ($class_update as $class)
                                <option value="{{$class->class_id}}">{{$class->class_name}}</option>    
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Major</label>
                            <input type="text" class="form-control mb-2" id="major" name="major" placeholder="Enter Major" required>     
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control mb-2" id="phone" name="phone" placeholder="Enter Phone" required>     
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control mb-2" id="email" name="email" placeholder="Enter Email" required>     
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" pattern="[a-z0-9_\.]+" autocomplete="off" class="form-control mb-2" id="username" name="username" placeholder="Enter Username" required>
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" autocomplete="off" class="form-control mb-2" id="password" name="password" placeholder="Enter Password" required>
                            {{-- <label for="exampleInputEmail1" class="mt-2">Confirmation Password</label>
                            <input type="password" class="form-control mb-2" id="conf_password" name="conf_password" placeholder="Enter Confirmation" required> --}}
                            <div class="form-group mt-3">
                                <label for="exampleFormControlSelect1">Roles</label>
                                <select class="form-control" id="roles" name="roles" required>
                                    <option value="">-- Roles --</option>
                                    {{-- <option value="Admin">Admin</option> --}}
                                    <option value="Student">Student</option>
                                </select>
                            </div>
                            {{-- <div class="form-group mt-3">
                                <label for="exampleFormControlSelect1">Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="">-- Level --</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div> --}}
                            <label for="exampleInputEmail1">Status</label>
                            <div class="d-flex justify-content-around">
                                <div class="form-check">
                                    <input class="form-check-input status" type="radio" id="status_active" name="status" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input status" type="radio" id="status_not_active" name="status" value="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Not Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
</div>
