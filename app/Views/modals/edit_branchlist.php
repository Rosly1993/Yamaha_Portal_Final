<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Motorcycle Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="id">
          <div class="row">
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="head_office" class="form-label">Head Office</label>
              <input type="text" name="head_office" id="head_office" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="dealer_code" class="form-label">Dealer Code</label>
              <input type="text" name="dealer_code" id="dealer_code" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="dealer_name" class="form-label">Dealer Name</label>
              <input type="text" name="dealer_name" id="dealer_name" class="form-control">
              <div class="invalid-feedback">This field is required.</div>
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
            <label for="area" class="form-label">Area</label><span style="color:red">*</span>
            <select type="select" name="area" id="area" class="form-select" placeholder="Enter Category ...." autocomplete="off">
            </select>
            <div class="invalid-feedback">This field is required.</div>
        </div>
  
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="region" class="form-label">Region</label><span style="color:red">*</span>
        <select type="select" name="region" id="region" class="form-select" placeholder="Enter Category ...." autocomplete="off">
      </select>
      <div class="invalid-feedback">This field is required.</div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="cluster_province" class="form-label">Cluster/Province</label><span style="color:red">*</span>
        <select type="select" name="cluster_province" id="cluster_province" class="form-select" placeholder="Enter Category ...." autocomplete="off">
      </select>
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
