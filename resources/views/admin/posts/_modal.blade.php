<div class="modal fade" id="postsModal" tabindex="-1" aria-labelledby="postsModalLabel" aria-hidden="true" style="overflow:hidden!important;">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postsModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="postForm" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" autocomplete="off" autofocus>
          </div>
          <div class="row row-cols-1 row-cols-lg-2">
            <div class="col">
              <div class="form-group">
                <label for="category">Select Category</label>
                <select class="form-control" id="category" name="category">
                  @foreach ($dataCategories as $categories)
                  <option value={{$categories->id}}>{{$categories->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" id="tags" name="tags" multiple="multiple">
                  @foreach ($dataTags as $tags)
                  <option data-description="something" value={{$tags->name}}>{{$tags->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="thumb" name="thumb" accept="image/*">
              <label class="custom-file-label" for="thumb">Choose file</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-save" value="update">Save changes</button>
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
