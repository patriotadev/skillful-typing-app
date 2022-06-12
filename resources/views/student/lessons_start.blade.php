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
             <div class="d-flex justify-content-end">
                 <div class="time rounded bg-dark p-2">
                     <h3 class="countdown"></h3>
                 </div>
                 {{-- <div class="wpm">
                     <h3 class="font-bold">112 WPM</h3>
                 </div>
                 <div class="accuracy">
                     <h3 class="font-bold">72,2 %</h3>
                 </div> --}}
             </div>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <div class="container d-flex justify-content-center mb-5">
                <input type="hidden" id="lesson_id" value="{{ $lesson_id }}">
                <div class="row">
                    @for ($i = 0; $i < count($lesson_text); $i++)
                        <h1 class="lesson-text mr-3" id="text{{$i}}">{{$lesson_text[$i]}} </h1>  
                    @endfor
                </div>
            </div>
            <hr>
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-text" name="input-text" size="60">
                    </div>
                    {{-- <textarea class="form-control" name="input-text" id="input-text" cols="155" rows="1"></textarea> --}}
                </div>
            </div>
         </div>
         <!-- /.card-body -->
         <div class="card-footer">
                 <div class="d-flex justify-content-end">
                     <a href="/student/lessons" class="btn btn-warning mr-3">Back</a>
                     {{-- <button onclick="start()" id="start-button" class="btn btn-danger">Start</button> --}}
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

<script type="text/javascript">

    lessonText = $('.lesson-text').text().split(" ")
    lessonText.splice(lessonText.length - 1, 1)
    correctWords = 0;
    wpm = 0
    incorrectWords = lessonText.length
    minutes = '<?= $course_duration; ?>'
    accuracy = 0

    inputArray = []
    let disableBackspace = {{ $course_disable_backspace }}

    if(disableBackspace === 1) {
        $('#input-text').on('keydown',  function() {   
            if ((event.keyCode == 8 ||    
            (event.keyCode == 37 && event.altKey) ||    
            (event.keyCode == 39 && event.altKey))   
                &&    
            (event.srcElement.form == null || event.srcElement.isTextEdit == false)   
            )   
            {  
                event.cancelBubble = true;   
                event.returnValue = false;   
            }   
        })
    }

    $('#input-text').on('keyup', function(e) {
        var code = e.key;
        if(code==="Enter") e.preventDefault();
        if(code===" ") {
        correctValue = []
        inCorrectValue = []
        textValue = $(this).val()
        inputArray.push(textValue.substring(0, textValue.length - 1))
            for (let i=0; i < inputArray.length; i++) {
                $(`#text${i + 1}`).css({"background-color": "lightgrey", 'padding': '2px', "border-radius": "7px"});
                console.log(lessonText[i] + ' - ' + inputArray[i])
                if (lessonText[i] == inputArray[i]) {
                    correctValue.push([lessonText[i]])
                    $(`#text${i}`).css("background-color", "transparent");
                    $(`#text${i}`).css("color", "green");
                } else {
                    inCorrectValue.push([lessonText[i]])
                    $(`#text${i}`).css("background-color", "transparent");
                    $(`#text${i}`).css("color", "red");
                }
            } 
     
        totalWordType = correctValue.length + inCorrectValue.length
        timeToSecond = $('.countdown').html()
        timeArray = timeToSecond.split(":")
        getMinutes = parseInt(timeArray[0]);
        getSeconds = parseInt(timeArray[1]);

        minutesToSeconds = (getMinutes * 60) + getSeconds
        secondsToMinutes = minutesToSeconds / 60;

        wpm = (totalWordType / secondsToMinutes).toFixed(2)
        accuracy = ((correctValue.length / totalWordType) * 100).toFixed(2)
        totalWords = lessonText.length
        minutes = secondsToMinutes.toFixed(2)
        correctWords = correctValue.length
        incorrectWords = inCorrectValue.length

        if (lessonText.length === totalWordType) {
            // window.location = '/student/lessons'
            $.ajax({
            url: '/student/lessons/result',
            data: {
                lesson_id: $('#lesson_id').val(),
                total_words: totalWords.toString(),
                minutes: minutes.toString(),
                correct_words: correctWords.toString(),
                incorrect_words: incorrectWords.toString(),
                wpm: wpm,
                accuracy: accuracy,
                overall_rating: '-'
            },
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend : () => {
                Swal.showLoading()
            },
            success : () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Result',
                    text: `${wpm} WPM - ${accuracy}% Accuracy`,
                }).then(function() {
                    window.location = '/student/statics/' + {{ $lesson_id }}
                });
            },
            error: (error) => {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: 'Result',
                    text: `Can't process the result`,
                }).then(function() {
                    window.location = '/student/lessons'
                });
            }
            })
        }
        $(this).val("")
        } else {
            console.log($('#input-text').val())
        }
    });

       let timer2 = "0:00";
       let interval = setInterval(function() {
    
       let timer = timer2.split(':');
       let minutes = parseInt(timer[0], 10);
       let seconds = parseInt(timer[1], 10);
        ++seconds;
        minutes = (seconds > 59) ? ++minutes : minutes;
        // if (minutes < 0) clearInterval(interval);

        if (minutes === <?= $course_duration; ?>) {
            clearInterval(interval);
            $.ajax({
            url: '/student/lessons/result',
            data: {
                lesson_id: $('#lesson_id').val(),
                total_words: lessonText.length,
                minutes: minutes.toString(),
                correct_words: correctWords.toString(),
                incorrect_words: incorrectWords.toString(),
                wpm: wpm,
                accuracy: accuracy,
                overall_rating: '-'
            },
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend : () => {
                Swal.showLoading()
            },
            success : () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Result',
                    text: `${wpm} WPM - ${accuracy}% Accuracy`,
                }).then(function() {
                    window.location = '/student/statics/' + {{ $lesson_id }}
                });
            },
            error: (error) => {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: 'Result',
                    text: `Can't process the result`,
                }).then(function() {
                    window.location = '/student/lessons'
                });
            }
            })
        }

        seconds = (seconds > 59) ? 00 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        
        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
        }, 1000);

</script>
    
@endsection

<style>
    input[type="text"] {
        font-size:24px;
    }
</style>