@extends('layout.base')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-between">
        <div class="col-sm-6">
          <h1 class="m-0">Users Management</h1>
        </div><!-- /.col -->
        <div>
          <button class="btn btn-primary" onclick="openAddUserModal()">Add User</button>
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
       <div class="card">
         <div class="card-header">
           <h3 class="card-title">Users Table</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>No.</th>
               <th>NIM</th>
               <th>Name</th>
               <th>Class</th>
               <th>Email</th>
               {{-- <th>Level</th> --}}
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
             @foreach ($users as $user)        
             <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $user->nim }}</td>
               <td>{{ $user->fullname }}</td>
               <td>{{ isset(App\Models\Group::where('class_id', $user->class)->first()->class_name) ? App\Models\Group::where('class_id', $user->class)->first()->class_name : '' }}</td>
               <td>{{ $user->email }}</td>
               {{-- <td>{{ $user->level }}</td> --}}
               <td>
                 <a onclick="openUpdateUserModal(
                   `{{$user->user_id}}`, `{{$user->nim}}`, `{{$user->fullname}}`, `{{$user->class}}`, `{{$user->major}}`, `{{$user->phone}}`, `{{$user->email}}`,
                   `{{$user->username}}`, `{{$user->password}}`, `{{$user->roles}}`, `{{$user->status}}`, `{{$user->level}}`
                   )" class="badge badge-info">Edit</a>
                 <a onclick="openDeleteUserModal({{$user->user_id}})" class="badge badge-danger">Delete</a>
               </td>
             </tr>
             @endforeach
             </tbody>
           </table>
         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
      </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
<!-- /.content -->
@include('admin.users_management_modal');

@endsection


@section('js')
    <script type="text/javascript">
        const openAddUserModal = () => {
            $('#modal-add-user').modal('show')
        }

        $('#form-add-user').on('submit', () => {
        $.ajax({
          url : $(this).attr('action'),
          data : $(this).serialize(),
          method: $(this).attr('method'),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          contentType: false,
          processData: false,
          beforeSend : () => {
            $('#modal-add-user').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'User has been added!')
            window.location = '/admin/users'
          },
          error: (error) => {
            msg('error', 'Failed to add the user!')
            console.log(error)
          }
          })
        })

        const openUpdateUserModal = (id, nim, fullname, user_class, major, phone, email, username, password, roles, status, level) => {
          $('#modal-update-user').modal('show')
          $('#modal-update-user #id').val(id)
          $('#modal-update-user #nim').val(nim)
          $('#modal-update-user #fullname').val(fullname)
          $('#modal-update-user #class').val(user_class)
          $('#modal-update-user #major').val(major)
          $('#modal-update-user #phone').val(phone)
          $('#modal-update-user #email').val(email)
          $('#modal-update-user #username').val(username)
          $('#modal-update-user #password').val(password)
          $('#modal-update-user #roles').val(roles)
          $('#modal-update-user #level').val(level)

          if (status == 1) {
            $('#modal-update-user #status_active').attr('checked', true)
          } else {
            $('#modal-update-user #status_not_active').attr('checked', true)
          }
        }

        $('#form-update-user').on('submit', () => {
        $.ajax({
          url : $(this).attr('action'),
          data : $(this).serialize(),
          method : $(this).attr('method'),
          contentType: false,
          processData: false,
          beforeSend : () => {
            $('#modal-update-user').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'User has been updated!')
            window.location = '/admin/users'
          },
          error: (error) => {
          msg('error', 'Failed to update the user!')
            console.log(error)
          }
        });
      });

      const openDeleteUserModal = (id) => {
        user_id = id
        Swal.fire({
            title: 'Delete this class?',
            text: "User will be removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
              url:'/admin/users/delete/' + user_id,
              type: 'GET',
              success: function() {
                  Swal.fire({
                        title: 'Deleted!',
                        text: 'User has been removed!',
                        icon: 'success',
                      }).then(function() {
                    location.reload();
                  });
                },
                error: function() {
                  Swal.fire({
                        title: 'Failed!',
                        text: 'Failed to remove the user!',
                        icon: 'danger',
                      }).then(function() {
                    location.reload();
                  });
                }
              })
            }
          })
        }

    </script>
@endsection