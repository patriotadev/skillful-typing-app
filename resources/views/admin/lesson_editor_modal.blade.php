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
              <input type="text" class="form-control" name="course_name" placeholder="Enter course name">
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
              <input id="course_name" type="text" class="form-control" name="course_name" placeholder="Enter course name">
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
            <input type="text" class="form-control" name="section_name" placeholder="Enter section name">
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
            <input id="section_name" type="text" class="form-control" name="section_name" placeholder="Enter section name">
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
            <input type="text" class="form-control" name="lesson_name" placeholder="Enter Lesson name">
            <input type="hidden" class="form-control" name="course_id" value="{{ isset($course_id) ? $course_id : '' }}">
            <input type="hidden" class="form-control" name="section_id" value="{{ isset($section_id) ? $section_id : '' }}">
            <input type="file" class="mt-3" name="lesson_file" placeholder="Choose Lesson File">
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
            <input id="lesson_name" type="text" class="form-control" name="lesson_name" placeholder="Enter section name">
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