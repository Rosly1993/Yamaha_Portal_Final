<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Motorcycle's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Motorcyclelist/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="pet_name" class="form-label">Pet Name</label><span style="color:red">*</span>
        <input type="text" name="pet_name" id="pet_name" class="form-control" placeholder="Enter Pet Name ...." autocomplete="off">
        <div id="petname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="model_code" class="form-label">Model Code</label><span style="color:red">*</span>
        <input type="text" name="model_code" id="model_code" class="form-control" placeholder="Enter Model Code ...." autocomplete="off">
        <div id="modelcode-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="model_name" class="form-label">Model Name</label><span style="color:red">*</span>
        <input type="text" name="model_name" id="model_name" class="form-control" placeholder="Enter Model Name ...." autocomplete="off">
        <div id="modelname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="category" class="form-label">Category</label><span style="color:red">*</span>
        <select type="select" name="category" id="category" class="form-select" placeholder="Enter Category ...." autocomplete="off">
       
        </select>
        <div id="category-error" class="error-message"></div>
    </div>
  
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="model_type" class="form-label">Model Type</label><span style="color:red">*</span>
        <select type="select" name="model_type" id="model_type" class="form-select" placeholder="Enter Category ...." autocomplete="off">
        <option>Please Select Category First</option>
        </select>
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