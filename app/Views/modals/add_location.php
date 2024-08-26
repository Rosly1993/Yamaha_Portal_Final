<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Location's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Location/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="area" class="form-label">Area</label><span style="color:red">*</span>
        <input type="text" name="area" id="area" class="form-control" placeholder="Enter Area ...." autocomplete="off">
        <div id="area-error" class="error-message"></div>
    </div>
  
     
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="region" class="form-label">Region</label><span style="color:red">*</span>
        <input type="text" name="region" id="region" class="form-control" placeholder="Enter Region ...." autocomplete="off">
        <div id="region-error" class="error-message"></div>
    </div>

    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="cluster_province" class="form-label">Cluster/Province</label><span style="color:red">*</span>
        <input type="text" name="cluster_province" id="cluster_province" class="form-control" placeholder="Enter Cluster/Province ...." autocomplete="off">
        <div id="clusterprovince-error" class="error-message"></div>
    </div>
   
  

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save data</button>
      </div>
    </div>
  </div>
</div>

</form>