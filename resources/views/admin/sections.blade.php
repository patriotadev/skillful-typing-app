@extends('layout.base')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-between">
        <div class="col-sm-6">
          <h1 class="m-0">Lesson Editor</h1>
        </div><!-- /.col -->
        <div>
          <button class="btn btn-primary" onclick="openAddSectionModal()">Add Section</button>
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
           <h3 class="card-title">Section Table</h3>
           <br>
            <a href="/admin/courses/" class="btn btn-warning">&larr; Back</a>
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
                @foreach ($sections as $section)        
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $section->section_name }}</td>
                  <td>
                    <a href="/admin/courses/{{$course_id}}/sections/{{$section->section_id}}/lessons" class="badge badge-primary">View</a>
                    <a onclick="openUpdateSectionModal(`{{$section->section_id}}`, `{{$section->section_name}}`)" class="badge badge-info">Edit</a>
                    <a onclick="openDeleteSectionModal({{$section->section_id}})" class="badge badge-danger">Delete</a>
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

@include('admin.lesson_editor_modal')

@endsection

@section('js')
    <script type="text/javascript">
        const openAddSectionModal = () => {
            $('#modal-add-section').modal('show')
        }

        $('#form-add-section').on('submit', () => {
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
            $('#modal-add-course').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'Section has been added!')
            // window.location = '/admin/courses/' + <?= $course_id; ?> + '/sections'
            document.location.reload(true)
          },
          error: (error) => {
            msg('error', 'Failed to add the section!')
            console.log(error)
          }
        })
      })

      const openUpdateSectionModal = (id, name) => {
        $('#modal-update-section').modal('show')
        $('#section_id').val(id)
        $('#section_name').val(name)
      }

      $('#form-update-section').on('submit', () => {
        $.ajax({
          url : $(this).attr('action'),
          data : $(this).serialize(),
          method : $(this).attr('method'),
          contentType: false,
          processData: false,
          beforeSend : () => {
            $('#modal-update-section').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'Section has been updated!')
            // window.location = '/admin/courses/' + <?= $course_id; ?> + '/sections'
            document.location.reload(true)
          },
          error: (error) => {
          msg('error', 'Failed to update the section!')
            console.log(error)
          }
        });
      });

      const openDeleteSectionModal = (id) => {
        section_id = id
        Swal.fire({
            title: 'Delete this section?',
            text: "Section will be removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
              url:'/admin/sections/delete/' + section_id,
              type: 'GET',
              success: function() {
                  Swal.fire({
                        title: 'Deleted!',
                        text: 'Section has been removed!',
                        icon: 'success',
                      }).then(function() {
                    document.location.reload(true)
                  });
                },
                error: function() {
                  Swal.fire({
                        title: 'Failed!',
                        text: 'Failed to remove the section!',
                        icon: 'danger',
                      }).then(function() {
                    document.location.reload(true)
                  });
                }
              })
            }
          })
      }
    </script>
@endsection