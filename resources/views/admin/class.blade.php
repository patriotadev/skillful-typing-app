@extends('layout.base')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-between">
        <div class="col-sm-6">
          <h1 class="m-0">Student Static</h1>
        </div><!-- /.col -->
        <div>
          <button class="btn btn-primary" onclick="openAddClassModal()">Add Class</button>
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
           <h3 class="card-title">Class Table</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>No.</th>
               <th>Course</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
                @foreach ($class as $class)        
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $class->class_name }}</td>
                  <td>
                    <a href="/admin/class/{{$class->class_id}}/students" class="badge badge-primary">View</a>
                    <a onclick="openUpdateClassModal(`{{$class->class_id}}`, `{{$class->class_name}}`, `{{$class->assigned_courses}}`)" class="badge badge-info">Edit</a>
                    <a onclick="openDeleteClassModal({{$class->class_id}})" class="badge badge-danger">Delete</a>
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
@include('admin.student_static_modal')

@endsection

@section('js')
    <script text="text/javascript">
        const openAddClassModal = () => {
        $('#modal-add-class').modal('show')
        }

        $('#form-add-class').on('submit', () => {
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
            $('#modal-add-class').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'Class has been added!')
            // window.location = '/admin/class'
            location.reload();
          },
          error: (error) => {
            msg('error', 'Failed to add the class!')
            console.log(error)
          }
          })
        })

        const openUpdateClassModal = (id, name, assigned_courses) => {
          $('#modal-update-class').modal('show')
          $('#class_id').val(id)
          $('#class_name').val(name)
          assigned_courses_array = assigned_courses.split(",")
          $('input').attr('checked', false)
          for (let i=0; i < assigned_courses_array.length; i++) {
            let id = assigned_courses_array[i].trim()
            $(`#id${id}`).attr('checked', true)
          }
        }

      $('#form-update-class').on('submit', () => {
        $.ajax({
          url : $(this).attr('action'),
          data : $(this).serialize(),
          method : $(this).attr('method'),
          contentType: false,
          processData: false,
          beforeSend : () => {
            $('#modal-update-class').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'Class has been updated!')
            // window.location = '/admin/class'
            location.reload();
          },
          error: (error) => {
          msg('error', 'Failed to update the class!')
            console.log(error)
          }
        });
      });

      const openDeleteClassModal = (id) => {
        class_id = id
        Swal.fire({
            title: 'Delete this class?',
            text: "Class will be removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
              url:'/admin/class/delete/' + class_id,
              type: 'GET',
              success: function() {
                  Swal.fire({
                        title: 'Deleted!',
                        text: 'Class has been removed!',
                        icon: 'success',
                      }).then(function() {
                    location.reload();
                  });
                },
                error: function() {
                  Swal.fire({
                        title: 'Failed!',
                        text: 'Failed to remove the class!',
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