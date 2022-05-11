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
         <div class="card-header">
           <h3 class="card-title">Current Test</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Courses</label>
                            <select class="form-control" id="roles" name="roles" required>
                                <option value="">-- Courses --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Sections</label>
                            <select class="form-control" id="roles" name="roles" required>
                                <option value="">-- Sections --</option>
                                @foreach ($sections as $section)    
                                    <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" class="mt-2">Lessons</label>
                        @foreach ($lessons as $lesson) 
                        <div class="form-check">
                          <input id="id" class="form-check-input" name="assigned_courses[]" type="checkbox" value="{{$lesson->lesson_id}}" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            {{ $lesson->lesson_name }}
                          </label>
                        </div>
                        @endforeach
                    </div>
                    {{-- <div class="col">
                        <img src="{{ asset('/images/laptop.jpg') }}" class="rounded" alt="images" width="500">
                    </div> --}}
                </div>
            </div>
         </div>
         <!-- /.card-body -->
         <div class="card-footer">
             <div class="d-flex justify-content-center">
                 <button class="btn btn-primary">Start</button>
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

@endsection


@section('js')
    
@endsection