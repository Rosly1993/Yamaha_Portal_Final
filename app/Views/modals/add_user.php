<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Table/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="firstname" class="form-label">Firstname</label><span style="color:red">*</span>
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname ...." autocomplete="off">
        <div id="firstname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="middlename" class="form-label">Middlename</label><span style="color:red">*</span>
        <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter middlename ...." autocomplete="off">
        <div id="middlename-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="lastname" class="form-label">Lastname</label><span style="color:red">*</span>
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter lastname ...." autocomplete="off">
        <div id="lastname-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="username" class="form-label">Username</label><span style="color:red">*</span>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username ...." autocomplete="off">
        <div id="username-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="password" class="form-label">Password</label><span style="color:red">*</span>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password ...." autocomplete="off">
        <div id="password-error" class="error-message"></div>
    </div>
    <div class="mb-3 col-6 col-md-6 col-sm-6">
        <label for="email" class="form-label">Email</label><span style="color:red">*</span>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email ...." autocomplete="off">
        <div id="email-error" class="error-message"></div>
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