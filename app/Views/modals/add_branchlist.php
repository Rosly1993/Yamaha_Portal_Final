<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Branclist's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Branchlist/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="head_office" class="form-label">Head Office</label><span style="color:red">*</span>
        <input type="text" name="head_office" id="head_office" class="form-control" placeholder="Enter Head Office ...." autocomplete="off">
        <div id="head_office-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="dealer_name" class="form-label">Dealer Name</label><span style="color:red">*</span>
        <input type="text" name="dealer_name" id="dealer_name" class="form-control" placeholder="Enter Dealer Name ...." autocomplete="off">
        <div id="dealer_name-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="dealer_code" class="form-label">Dealer Code</label><span style="color:red">*</span>
        <input type="text" name="dealer_code" id="dealer_code" class="form-control" placeholder="Enter Dealer Code...." autocomplete="off">
        <div id="dealer_code-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="shop_type" class="form-label">Shop Type</label><span style="color:red">*</span>
        <input type="text" name="shop_type" id="shop_type" class="form-control" placeholder="Enter Shop Type...." autocomplete="off">
        <div id="shop_type-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="date_opened" class="form-label">Date Opened</label><span style="color:red">*</span>
        <input type="date" name="date_opened" id="date_opened" class="form-control" placeholder="Enter Shop Type...." autocomplete="off">
        <div id="date_opened-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="area" class="form-label">Area</label><span style="color:red">*</span>
        <select type="select" name="area" id="area" class="form-select" placeholder="Enter Area ...." autocomplete="off">
        <!-- <option>Please Select Area</option> -->
        </select>
        <div id="area-error" class="error-message"></div>
    </div>
  
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="region" class="form-label">Region</label><span style="color:red">*</span>
        <select type="select" name="region" id="region" class="form-select" placeholder="Enter Region...." autocomplete="off">
        <option>Please Select Area First</option>
        </select>
        <div id="region-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="cluster_province" class="form-label">Cluster/Province</label><span style="color:red">*</span>
        <select type="select" name="cluster_province" id="cluster_province" class="form-select" placeholder="Enter Cluster/Province...." autocomplete="off">
        <option>Please Select Region First</option>
        </select>
        <div id="cluster_province-error" class="error-message"></div>
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