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
          {{-- <button class="btn btn-primary" onclick="openAddSectionModal()">Back</button> --}}
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
           <h3 class="card-title">{{$lesson_name}}</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <h1 class="text-center">{{$text}}</h1>
         </div>
         <!-- /.card-body -->
         <div class="card-footer">
             <div class="d-flex justify-content-end">
                <button class="mr-2 btn btn-primary" onclick="openUpdateLessonModal(`{{$lesson_id}}`, `{{$lesson_name}}`, `{{$text}}`)">Edit Text</button>
                <a href="/admin/courses/{{$course_id}}/sections/{{$section_id}}/lessons">
                    <button class="btn btn-warning">Back</button>
                </a>
             </div>
         </div>
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
        const openUpdateLessonModal = (id, name, text) => {
            $('#modal-update-lesson').modal('show')
            $('#lesson_id').val(id)
            $('#lesson_name').val(name)
            $('#lesson_text').val(text)
        }

        $('#form-update-lesson').on('submit', () => {
        $.ajax({
          url : $(this).attr('action'),
          data : $(this).serialize(),
          method : $(this).attr('method'),
          contentType: false,
          processData: false,
          beforeSend : () => {
            $('#modal-update-lesson').modal('hide');
            Swal.showLoading()
          },
          success : () => {
            msg('success', 'Lesson has been updated!')
            window.location = '/admin/courses/' + <?= $course_id; ?> + '/sections/' + <?= $section_id; ?> + '/lessons'
          },
          error: (error) => {
            console.log(error)
          }
        });
      });
    </script>
@endsection