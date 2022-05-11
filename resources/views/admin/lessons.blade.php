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
          <button class="btn btn-primary" onclick="openAddLessonModal()">Add Lesson</button>
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
           <h3 class="card-title">Lesson Table</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>No.</th>
               <th>Lesson</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
                @foreach ($lessons as $lesson)        
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $lesson->lesson_name }}</td>
                  <td>
                    <a href="/admin/courses/{{$course_id}}/sections/{{$section_id}}/lessons/{{$lesson->lesson_id}}" class="badge badge-primary">View</a>
                    {{-- <a onclick="openUpdateLessonModal(`{{$lesson->lesson_id}}`, `{{$lesson->lesson_name}}`)" class="badge badge-info">Edit</a> --}}
                    <a onclick="openDeleteLessonModal({{$lesson->lesson_id}})" class="badge badge-danger">Delete</a>
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
    const openAddLessonModal = () => {
        $('#modal-add-lesson').modal('show')
    }

    $('#form-add-lesson').on('submit', () => {
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
        $('#modal-add-lesson').modal('hide');
        Swal.showLoading()
      },
      success : () => {
        msg('success', 'Lesson has been added!')
        window.location = '/admin/courses/' + <?= $course_id; ?> + '/sections/' + <?= $section_id; ?> + '/lessons'
      },
      error: (error) => {
        msg('error', 'Failed to add the lesson!')
        console.log(error)
      }
    })
  })

  const openDeleteLessonModal = (id) => {
        lesson_id = id
        Swal.fire({
            title: 'Delete this lesson?',
            text: "Lesson will be removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
              url:'/admin/lessons/delete/' + lesson_id,
              type: 'GET',
              success: function() {
                  Swal.fire({
                        title: 'Deleted!',
                        text: 'Lesson has been removed!',
                        icon: 'success',
                      }).then(function() {
                    location.reload();
                  });
                },
                error: function() {
                  Swal.fire({
                        title: 'Failed!',
                        text: 'Failed to remove the lesson!',
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