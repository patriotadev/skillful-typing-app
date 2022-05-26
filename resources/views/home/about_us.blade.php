@extends('layout.base')

@section('content')
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
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row mt-5">
                                <div class="col">
                                    <div class="point-item d-flex flex-column align-items-between">
                                        <i class="nav-icon fas fa-laptop" style="font-size: 50px"></i>
                                        <span class="mt-3">Dapat diakses dimana saja dan kapan saja.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="point-item d-flex flex-column align-items-between">
                                        <i class="nav-icon far fa-hand-paper" style="font-size: 50px"></i>
                                        <span class="mt-3">Melatih dalam peletakan jari pada posisi hutuf yang benar.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <div class="point-item d-flex flex-column align-items-between">
                                        <i class="nav-icon far fa-file-alt" style="font-size: 50px"></i>
                                        <span class="mt-3">Latihan yang terdiri dari berbagai tingkatan.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="point-item d-flex flex-column align-items-between">
                                        <i class="nav-icon 	far fa-chart-bar" style="font-size: 50px"></i>
                                        <span class="mt-3">Dilengkapi dengan statistik dari hasil latihan yang telah dikerjakan.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
  </div>
<!-- /.content -->

<style>
    .point-item i {
        text-align: center;
    }

    .point-item span {
        font-size: 1.3rem;
        text-align: center;
        font-style: italic;
    }
</style>
@endsection

@section('js')
    
@endsection