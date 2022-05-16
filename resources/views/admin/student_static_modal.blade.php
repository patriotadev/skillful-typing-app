<!-- Add Class Modal -->
<div class="modal fade" id="modal-add-class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-add-class" action="/admin/class/add" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Class Name</label>
              <input type="text" class="form-control" name="class_name" placeholder="Enter class name" required>
              <label for="" class="mt-2">Assigned Class</label>
              @foreach ($courses as $course)
              <div class="form-check">
                <input class="form-check-input" name="assigned_courses[]" type="checkbox" value="{{$course->course_id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  {{$course->course_name}}
                </label>
              </div>
              @endforeach                        
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

<!-- Update Class Modal -->
<div class="modal fade" id="modal-update-class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-update-class" action="/admin/class/update" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Class Name</label>
              <input id="class_name" type="text" class="form-control" name="class_name" placeholder="Enter class name" required>
              <input id="class_id" type="hidden" class="form-control" name="class_id">
              <label for="" class="mt-2">Assigned Class</label>
              @foreach ($courses as $course)
              <div class="form-check">
                <input id="id{{$course->course_id}}" class="form-check-input" name="assigned_courses[]" type="checkbox" value="{{$course->course_id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  {{$course->course_name}}
                </label>
              </div>
              @endforeach                        
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
