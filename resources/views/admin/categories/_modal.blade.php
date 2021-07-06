<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="categoryForm">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="category" autofocus>
          </div>
          <button type="submit" class="btn btn-primary btn-save" value="update">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>