<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Motorcycle's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Motorcyclecategory/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="category" class="form-label">Category</label><span style="color:red">*</span>
        <input type="text" name="category" id="category" class="form-control" placeholder="Enter Category ...." autocomplete="off">
        <div id="category-error" class="error-message"></div>
    </div>
  
     
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="model_type" class="form-label">Model Type</label><span style="color:red">*</span>
        <input type="text" name="model_type" id="model_type" class="form-control" placeholder="Enter Model Type ...." autocomplete="off">
        <div id="modeltype-error" class="error-message"></div>
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