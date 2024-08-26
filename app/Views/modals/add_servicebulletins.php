<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Bulletins's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Servicebulletins/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="title" class="form-label">Title</label><span style="color:red">*</span>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Category ...." autocomplete="off">
        <div id="title-error" class="error-message"></div>
    </div>
  
     
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="reference_number" class="form-label">Reference Number</label><span style="color:red">*</span>
        <input type="text" name="reference_number" id="reference_number" class="form-control" placeholder="Enter Reference Number ...." autocomplete="off">
        <div id="reference_number-error" class="error-message"></div>
    </div>

    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="date_published" class="form-label">Date Published</label><span style="color:red">*</span>
        <input type="date" name="date_published" id="date_published" class="form-control" max="<?php echo date('Y-m-d'); ?>" placeholder="Enter Date Opened ...." autocomplete="off">
        <div id="date_published-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="attachment" class="form-label">Attachment</label><span style="color:red">*</span>
        <input type="file" name="attachment" id="attachment" class="form-control" placeholder="Enter Date Opened ...." autocomplete="off">
        <div id="attachment-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="confidential-toggle" class="col-form-label">Document Type</label><span style="color:red">*</span>
        <div class="form-check form-switch">
          <input  style="width: 50px;height: 20px" class="form-check-input" type="checkbox" id="confidential-toggle">
          <label class="form-check-label" for="confidential-toggle">&nbsp;Not Confidential</label>
        </div>
        <input type="hidden" id="confidential-value" name="confidential_value" value="0">
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

<script>
 document.getElementById('confidential-toggle').addEventListener('change', function () {
  const label = this.nextElementSibling;
  const hiddenInput = document.getElementById('confidential-value');
  
  if (this.checked) {
    label.textContent = 'Confidential';
    hiddenInput.value = '1';
  } else {
    label.textContent = 'Not Confidential';
    hiddenInput.value = '0';
  }
});

</script>