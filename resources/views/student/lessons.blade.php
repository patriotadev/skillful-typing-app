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
       <div class="card">
        <form action="/student/lessons/start" method="post">
        @csrf
        <div class="card-header">
           <h3 class="card-title">Current Lessons</h3>
        </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Courses</label>
                            <select class="form-control" id="course" name="course" required>
                                @foreach ($courses as $course)
                                    <option {{ $course->course_id == $last_course_id ? 'selected' : '' }} value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Sections</label>
                            <select class="form-control" id="section" name="section" required>
                                @foreach ($sections as $section)    
                                    <option {{ $section->section_id == $last_section_id ? 'selected' : '' }} value="{{ $section->section_id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" class="mt-2">Finished Lessons</label>
                        @isset($all_finished_lesson)  
                          @foreach ($all_finished_lesson as $finished)   
                            @foreach ($lessons as $lesson)
                              @if($lesson->lesson_id == $finished->lesson_id)
                              <div class="form-check">
                                <input checked id="lesson{{$lesson->lesson_id}}" class="form-check-input" type="checkbox" value="{{$lesson->lesson_id}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  {{ $lesson->lesson_name }}
                                </label>
                              </div>
                              @endif
                            @endforeach
                          @endforeach
                        @endisset
                    </div>
                    <div class="col">
                      <label for="" class="mt-2">Select Lesson</label>
                      @foreach ($lessons as $lesson)
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="lesson" value="{{$lesson->lesson_id}}" id="flexRadioDefault2" required>
                        <label class="form-check-label" for="flexRadioDefault2">
                          {{ $lesson->lesson_name }}
                        </label>
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
         <!-- /.card-body -->
        <div class="card-footer">
             <div class="d-flex justify-content-end">
                 {{-- <button class="btn btn-primary">Start</button> --}}
                 <button type="submit" class="btn btn-primary">Start</button>
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
    <script>
      $(document).ready(() => {
        course_id = null
        section_id = null

        $('#course').on('change', () => {
          this.course_id = $('#course').val()
          console.log(this.course_id)

          // $.ajax({
          //   url: '/student/lessons/' + this.course_id,
          //   method: 'get',
          //   success: () => {
          //     window.location = '/student/le'
          //   }
          // })


        })

        $('#section').on('change', () => {
          this.section_id = $('#course').val()
          console.log(this.section_id)

        })

      });
    </script>
@endsection