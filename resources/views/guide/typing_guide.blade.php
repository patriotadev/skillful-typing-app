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
                        <h3 class="card-title">Typing Guide</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold">Ten Finger Typing</h6>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex flex-row flex-wrap">
                                    <div id="left-pinky-box"></div>
                                    <p id="left-pinky-text">Left Pinky</p>
                                    <div id="left-ring-box"></div>
                                    <p id="left-ring-text">Left Ring</p>
                                    <div id="left-middle-box"></div>
                                    <p id="left-middle-text">Left Middle</p>
                                    <div id="left-pointer-box"></div>
                                    <p id="left-pointer-text">Left Pointer</p>
                                    <div id="left-thumb-box"></div>
                                    <p id="left-thumb-text">Left Thumb</p>
                                    <div id="right-thumb-box"></div>
                                    <p id="right-thumb-text">Right Thumb</p>
                                    <div id="right-pointer-box"></div>
                                    <p id="right-pointer-text">Right Pointer</p>
                                    <div id="right-middle-box"></div>
                                    <p id="right-middle-text">Right Middle</p>
                                    <div id="right-ring-box"></div>
                                    <p id="right-ring-text">Right Ring</p>
                                    <div id="right-pinky-box"></div>
                                    <p id="right-pinky-text">Right Pinky</p>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <img src="{{ asset('images/finger_typing.png') }}" alt="Typing Guide">
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-4 ">
                                    <h6 class="font-weight-bold">Basic Position</h6>
                                </div>
                            </div>
                            <div class="row mt-5 d-flex justify-content-center">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/basic-position.jpg') }}" alt="" width="450">
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li class="mb-2">Feel the bumps on the F and J keys.</li>
                                        <li class="mb-2">The bumps are there to guide you to posistion your fingers on the keyboard without looking.</li>
                                        <li class="mb-2">Place your index fingers on the F and J keys. The other finger should be placed on the keyboard as shown in the figure.</li>
                                        <li class="mb-2">Your fingers should lighly touch the keys.</li>
                                        <li class="mb-2">This is the "Basic Position". When not typing or after pressing a key your fingers should always return to the basic position.</li>
                                        <li class="mb-2">Ten finger typing can be summarized as: basic position and then press a key, then basic position again. And so forth.</li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5 d-flex justify-content-center">
                                <h5>Let's Try!</h5>
                            </div>
                            <div class="row mb-5 mt-2 d-flex justify-content-center">
                                <textarea id="keyboard" style="width: 400px"></textarea>   
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
  </div>
<!-- /.content -->

<style>
    #left-pinky-box {
        width: 12px;
        height: 12px;
        background-color: red;
        margin-left: 8px;
        margin-right: 4px;
    }

    #left-pinky-text {
        line-height: 12px;
    }

    #left-ring-box {
        width: 12px;
        height: 12px;
        background-color: orange;
        margin-left: 16px;
        margin-right: 4px;
    }

    #left-ring-text {
        line-height: 12px;
    }

    #left-middle-box {
        width: 12px;
        height: 12px;
        background-color: green;
        margin-left: 16px;
        margin-right: 4px;
    }

    #left-middle-text {
        line-height: 12px;
    }
    
    #left-pointer-box {
        width: 12px;
        height: 12px;
        background-color: #00B0EC;
        margin-left: 16px;
        margin-right: 4px;
    }

    #left-pointer-text {
        line-height: 12px;
    }

    #left-thumb-box {
        width: 12px;
        height: 12px;
        background-color: #bdc8e6;
        margin-left: 16px;
        margin-right: 4px;
    }

    #left-thumb-text {
        line-height: 12px;
    }
    
    #right-thumb-box {
        width: 12px;
        height: 12px;
        background-color: #bdc8e6;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-thumb-text {
        line-height: 12px;
    }

    #right-pointer-box {
        width: 12px;
        height: 12px;
        background-color: #5985c2;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-pointer-text {
        line-height: 12px;
    }

    #right-pointer-box {
        width: 12px;
        height: 12px;
        background-color: #5985c2;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-pointer-text {
        line-height: 12px;
    }

    #right-middle-box {
        width: 12px;
        height: 12px;
        background-color: lightblue;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-middle-text {
        line-height: 12px;
    }

    #right-ring-box {
        width: 12px;
        height: 12px;
        background-color: #ffe9a0;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-ring-text {
        line-height: 12px;
    }

    #right-pinky-box {
        width: 12px;
        height: 12px;
        background-color: #bfe1c0;
        margin-left: 16px;
        margin-right: 4px;
    }

    #right-pinky-text {
        line-height: 12px;
    }

</style>
@endsection


@section('js')
<script>
    $('#keyboard').keyboard({ layout: 'qwerty' }).addTyping({
        showTyping : true
    });
</script>
@endsection