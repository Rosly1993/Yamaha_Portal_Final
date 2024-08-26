<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Service Bulletin's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="id">
          <div class="row">
            
          <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="title" class="form-label">Title</label>
              <input type="title" name="title" id="title" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="reference_number" class="form-label">Reference Number</label>
              <input type="text" name="reference_number" id="reference_number" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="date_published" class="form-label">Date Published</label>
              <input type="date" name="date_published" id="date_published" class="form-control" max="<?php echo date('Y-m-d'); ?>">
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
