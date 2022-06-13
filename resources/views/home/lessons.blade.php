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
        <form action="/lessons/start" method="post">
        @csrf
        <div class="card-header">
           <h3 class="card-title">Current Lessons</h3>
        </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container">
                {{-- <div class="row">
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Courses</label>
                            <select class="form-control" id="course" name="course" required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Sections</label>
                            <select class="form-control" id="section" name="section" required>
                                @foreach ($sections as $section)    
                                    <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col">
                      <label for="" class="mt-2">Select Lesson</label>
                      <div class="form-group">
                        <select class="form-control" onchange="showConfigure()" name="lesson" id="flexRadioDefault2" required>
                          <option value="">-- Lessons --</option>
                          @foreach ($lessons as $lesson)
                            <option backspace={{App\Models\Course::where('course_id', $lesson->course_id)->first()->disable_backspace}} duration={{ App\Models\Course::where('course_id', $lesson->course_id)->first()->max_duration}} allow="{{ App\Models\Course::where('course_id', $lesson->course_id)->first()->allow_configure }}" value="{{$lesson->lesson_id}}">
                            {{ App\Models\Course::where('course_id', $lesson->course_id)->first()->course_name }},
                            {{ App\Models\Section::where('section_id', $lesson->section_id)->first()->section_name }},
                            {{ $lesson->lesson_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- /.card-body -->
        <div class="card-footer">
             <div class="d-flex justify-content-end">
                 <button onclick="openConfigureModal()" type="button" id="setting-btn" class="invisible btn btn-warning mr-2">Setting</button>
                 <button id="start-btn" type="submit" class="btn btn-primary">Start</button>
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

@include('home.configure_modal')
@endsection


@section('js')
  <script>
      const showConfigure = () => {
        var option = $('option:selected').attr('allow');
        var duration = $('option:selected').attr('duration');
        var backspace = $('option:selected').attr('backspace');
        var id = $('option:selected').val();

        $('#modal-configure-course #lesson_id').val(id)
        $('#modal-configure-course #max_duration').val(duration)
        $('#modal-configure-course #disable_backspace').val(backspace)

        if (option !== "0") {
          $('#setting-btn').removeClass('invisible')
        } else {
          $('#setting-btn').addClass('invisible')
        }
      }

      const openConfigureModal = () => {
        $('#modal-configure-course').modal('show')
      }
  </script>
@endsection
