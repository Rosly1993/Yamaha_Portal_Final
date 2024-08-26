<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Manual's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Servicemanuals/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="model_name" class="form-label">Model Name</label><span style="color:red">*</span>
        <select type="text" name="model_name" id="model_name" class="form-select" placeholder="Enter Category ...." autocomplete="off">
        </select>
        <div id="model_name-error" class="error-message"></div>
    </div>
  
     
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="model_code" class="form-label">Model Code</label><span style="color:red">*</span>
        <select type="text" name="model_code" id="model_code" class="form-select" placeholder="Enter Reference Number ...." autocomplete="off">
        <option>Please Select Model Name First</option>
      </select>
        <div id="model_code-error" class="error-message"></div>

    </div>

        <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="year_published" class="form-label">Year Published</label><span style="color:red">*</span>
        <input type="text" name="year_published" id="year_published" class="form-control" placeholder="Enter Year ..." autocomplete="off">
        <div id="year_published-error" class="error-message"></div>
    </div>
        <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="attachment" class="form-label">Attachment</label><span style="color:red">*</span>
        <input type="file" name="attachment" id="attachment" class="form-control" placeholder="Enter Date Opened ...." autocomplete="off">
        <div id="attachment-error" class="error-message"></div>
    </div>
    <input type="hidden" name="is_confidential" id="is_confidential" value="1">

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

