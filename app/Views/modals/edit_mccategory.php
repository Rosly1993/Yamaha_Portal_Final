<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="id">
          <div class="row">
            
          <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="category" class="form-label">Category</label>
              <input type="category" name="category" id="category" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="model_type" class="form-label">Model Type</label>
              <input type="text" name="model_type" id="model_type" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
           
         
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
