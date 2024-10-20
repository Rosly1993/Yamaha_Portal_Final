<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width:70%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Table/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="firstname" class="form-label">Firstname</label><span style="color:red">*</span>
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname ...." autocomplete="off">
        <div id="firstname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="middlename" class="form-label">Middlename</label><span style="color:red">*</span>
        <input type="text" name="middlename" id="middlename" class="form-control" placeholder="If not applicable put N/A...." autocomplete="off">
        <div id="middlename-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="lastname" class="form-label">Lastname</label><span style="color:red">*</span>
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter lastname ...." autocomplete="off">
        <div id="lastname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="gender" class="form-label">Gender</label><span style="color:red">*</span>
        <select type="text"  name="gender" id="gender" class="form-select"  autocomplete="off">
          <option value="">Please Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <div id="gender-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="date_birth" class="form-label">Date of Birth</label><span style="color:red">*</span>
        <input type="date"  max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" name="date_birth" id="date_birth" class="form-control" autocomplete="off">

        <div id="date_birth-error" class="error-message"></div>
    </div>
  
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="id_number" class="form-label">ID Number</label><span style="color:red">*</span>
        <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter ID Number ...." autocomplete="off">
        <div id="id_number-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="password" class="form-label">Password</label><span style="color:red">*</span>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password ...." autocomplete="off">
        <div id="password-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="email" class="form-label">Email</label><span style="color:red">*</span>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email ...." autocomplete="off">
        <div id="email-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="contact_number" class="form-label">Phone Number</label><span style="color:red">*</span>
        <input type="number" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Phone Number(ex. 0916-768-0741)" autocomplete="off">
        <div id="contact_number-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="role_id" class="form-label">Employee Type</label><span style="color:red">*</span>
        <select name="role_id" id="role_id" class="form-select" autocomplete="off">
          <option value="">Select Employee Type</option>
          <?php foreach ($rolename as $role): ?>
            <option value="<?= $role['IndexKey']; ?>"><?= $role['roles']; ?></option>
          <?php endforeach; ?>
        </select>
        <div id="role_id-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="date_started" class="form-label">Date Started</label><span style="color:red">*</span>
        <input type="date"  max="<?php echo date('Y-m-d');?>" name="date_started" id="date_started" class="form-control"  autocomplete="off">
        <div id="date_started-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="headoffice" class="form-label">Head Office</label><span style="color:red">*</span>
        <select type="select" name="headoffice" id="headoffice" class="form-select" autocomplete="off">
        <!-- <option>Please Select headoffice</option> -->
        </select>
        <div id="headoffice-error" class="error-message"></div>
    </div>
  
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="branchname" class="form-label">Branch Name</label><span style="color:red">*</span>
        <select type="select" name="branchname" id="branchname" class="form-select"  autocomplete="off">
        <option value="">Please Select Area First</option>
        </select>
        <div id="branchname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-4 col-md-4 col-sm-4">
        <label for="area" class="form-label">Area</label><span style="color:red">*</span>
        <select type="select" name="area" id="area" class="form-select" autocomplete="off">
        <option value="">Please Select Branch Name First</option>
        </select>
        <div id="area-error" class="error-message"></div>
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