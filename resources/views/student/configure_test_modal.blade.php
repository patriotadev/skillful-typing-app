<!-- Add Course Modal -->
<div class="modal fade" id="modal-configure-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-configure-course" action="/student/tests/start" method="POST">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="lesson" id="lesson_id" value="">
            <div class="form-group">
              <label for="exampleInputEmail1">Course Duration</label>
              <input type="number" min="1" id="max_duration" class="form-control" step=".01" name="max_duration" placeholder="Minutes" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Slowdown aren't more than</label>
              <input id="max_slowdown" min="1" type="number" class="form-control" name="max_slowdown" placeholder="Seconds">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Backspace Key</label>
              <select class="form-control" id="disable_backspace" name="disable_backspace" required>
                  <option value="">-- Select --</option> 
                  <option value="1">Disabled</option> 
                  <option value="0">Enabled</option> 
              </select>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Start</button>
          </div>
        </form>
      </div>
    </div>
</div>