@extends('layout.base')


@section('content')
      <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-between">
        <div class="col-sm-6">
          <h1 class="m-0">Student Static</h1>
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
           <h3 class="card-title">Students Table</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>No.</th>
               <th>NIM</th>
               <th>Name</th>
               <th>Email</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
                @foreach ($students as $student)        
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $student->nim }}</td>
                  <td>{{ $student->fullname }}</td>
                  <td>{{ $student->email }}</td>
                  <td>
                    <a href="/admin/courses/{{$student->user_id}}/student" class="badge badge-primary">View</a>
                    <a onclick="openUpdateClassModal(`{{$student->user_id}}`)" class="badge badge-info">Overall Result</a>
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
{{-- @include('admin.student_static_modal') --}}

@endsection


@section('js')
    
@endsection