<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Location's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="id">
          <div class="row">
            
          <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="area" class="form-label">Area</label>
              <input type="area" name="area" id="area" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="region" class="form-label">Region</label>
              <input type="text" name="region" id="region" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-12 col-md-12 col-sm-12">
              <label for="cluster_province" class="form-label">Cluster/Province</label>
              <input type="text" name="cluster_province" id="cluster_province" class="form-control">
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
