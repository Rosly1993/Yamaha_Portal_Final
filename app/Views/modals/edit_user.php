<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="user-id" name="id">
          <div class="row">
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="firstname" class="form-label">Firstname</label>
              <input type="text" name="firstname" id="firstname" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="middlename" class="form-label">Middlename</label>
              <input type="text" name="middlename" id="middlename" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="lastname" class="form-label">Lastname</label>
              <input type="text" name="lastname" id="lastname" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3 col-6 col-md-6 col-sm-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control">
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
