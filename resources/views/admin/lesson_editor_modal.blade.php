<!-- Add Course Modal -->
<div class="modal fade" id="modal-add-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-add-course" action="/admin/courses/add" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Course Name</label>
              <input type="text" class="form-control" name="course_name" placeholder="Enter course name" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Course Type</label>
              <select class="form-control" id="course_type" name="course_type">
                  <option value="">-- Select --</option> 
                  <option value="Lesson">Lesson</option> 
                  <option value="Test">Test</option> 
              </select>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
</div>

<!-- Update Course Modal -->
<div class="modal fade" id="modal-update-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Update Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-update-course" action="/admin/courses/update" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Course Name</label>
              <input id="course_name" type="text" class="form-control" name="course_name" placeholder="Enter course name" required>
              <input id="course_id" type="hidden" class="form-control" name="course_id" placeholder="Enter course Id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
</div>

<!-- Setting Course Modal -->
<div class="modal fade" id="modal-setting-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Setting Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-setting-course" action="/admin/courses/setting" method="POST">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="course_id" id="course_id">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Course Type</label>
                <select class="form-control" id="course_type" name="course_type">
                    <option value="">-- Course Type --</option> 
                    <option value="Lesson">Lesson</option> 
                    <option value="Test">Test</option> 
                </select>
            </div>
            <div class="form-group">
              <label>Speed isn't less than</label>
              <div class="input-group">
                <input id="min_speed" type="number" class="form-control" name="min_speed" placeholder="WPM">
                <div class="input-group-append">
                  <span class="input-group-text"> WPM </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Slowdown aren't more than</label>
              <div class="input-group">
                <input id="max_slowdown" min="1" type="number" class="form-control" name="max_slowdown" placeholder="Seconds">
                <div class="input-group-append">
                  <span class="input-group-text"> Seconds </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Lesson Duration</label>
              <div class="input-group">
                <input id="max_duration" type="number" step=".01" class="form-control" name="max_duration" placeholder="Minutes">
                <div class="input-group-append">
                  <span class="input-group-text"> Minutes </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Backspace Key</label>
              <select class="form-control" id="disable_backspace" name="disable_backspace">
                <option value="">-- Select --</option> 
                <option value="1">Disabled</option> 
                <option value="0">Enabled</option> 
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Allow Student Configure Course</label>
              <select class="form-control" id="allow_configure" name="allow_configure">
                <option value="">-- Select --</option> 
                <option value="1">Allow</option> 
                <option value="0">Don't Allow</option> 
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Course Score (WPM | Accuracy)</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">A</span>
                </div>
                <input type="number" min="0" id="min_speed_a" name="min_speed_a" class="form-control" placeholder="Minimum WPM / Speed">
                <input type="number" min="0" id="min_accuracy_a" name="min_accuracy_a" class="form-control" placeholder="Minimum Accuracy">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">B</span>
                </div>
                <input type="number" min="0" id="min_speed_b" name="min_speed_b" class="form-control" placeholder="Minimum WPM / Speed">
                <input type="number" min="0" id="min_accuracy_b" name="min_accuracy_b" class="form-control" placeholder="Minimum Accuracy">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">C</span>
                </div>
                <input type="number" min="0" id="min_speed_c" name="min_speed_c" class="form-control" placeholder="Minimum WPM / Speed">
                <input type="number" min="0" id="min_accuracy_c" name="min_accuracy_c" class="form-control" placeholder="Minimum Accuracy">
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- Add Section Modal -->
<div class="modal fade" id="modal-add-section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Add Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-section" action="/admin/sections/add" method="POST">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Section Name</label>
            <input type="text" class="form-control" name="section_name" placeholder="Enter section name" required>
            <input type="hidden" class="form-control" name="course_id" value="{{ isset($course_id) ? $course_id : '' }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Section Modal -->
<div class="modal fade" id="modal-update-section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Update Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-update-section" action="/admin/sections/update" method="POST">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Section Name</label>
            <input id="section_name" type="text" class="form-control" name="section_name" placeholder="Enter section name" required>
            <input id="section_id" type="hidden" class="form-control" name="section_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Lesson Modal -->
<div class="modal fade" id="modal-add-lesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Add Lesson</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-lesson" action="/admin/lessons/add" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Lesson Name</label>
            <input type="text" class="form-control" name="lesson_name" placeholder="Enter Lesson name" required>
            <input type="hidden" class="form-control" name="course_id" value="{{ isset($course_id) ? $course_id : '' }}">
            <input type="hidden" class="form-control" name="section_id" value="{{ isset($section_id) ? $section_id : '' }}">
            <input type="file" class="mt-3" accept=".txt" name="lesson_file" placeholder="Choose Lesson File" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Lesson Modal -->
<div class="modal fade" id="modal-update-lesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Update Lesson</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-update-lesson" action="/admin/lessons/update" method="POST">
      <div class="modal-body">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Lesson Name</label>
            <input id="lesson_name" type="text" class="form-control" name="lesson_name" placeholder="Enter section name" required>
            {{-- <input id="lesson_file" class="mt-3" type="file" name="lesson_file"> --}}
            <input id="lesson_id" type="hidden" class="form-control" name="lesson_id">
            <textarea class="mt-3" name="lesson_text" id="lesson_text" cols="62" rows="10">{{isset($text) ? $text : ''}}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>