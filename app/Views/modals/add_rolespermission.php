<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Roles & Permission's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addItemForm" action="<?= site_url('Rolespermission/add') ?>" method="post">
      <div class="modal-body">
      <div class="row">

      <div class="mb-3 col-12 col-md-12 col-sm-12">
        <label for="role_id" class="form-label">Role Name</label><span style="color:red">*</span>
        <select name="role_id" id="role_id" class="form-select" autocomplete="off">
          <option value="">Select Roles</option>
          <?php foreach ($rolename as $role): ?>
            <option value="<?= $role['IndexKey']; ?>"><?= $role['roles']; ?></option>
          <?php endforeach; ?>
        </select>
        <div id="role_id-error" class="error-message"></div>
      </div>

      <table class="table">
        <thead class="thead-dark">
          <tr style="background-color: #03346E; color: white">
            <th style="text-align: center;" scope="col">Page Name</th>
            <th style="text-align: center;" scope="col">Is View</th>
            <th style="text-align: center;" scope="col">Is Add</th>
            <th style="text-align: center;" scope="col">Is Edit</th>
            <th style="text-align: center;" scope="col">Is Delete</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
          <?php foreach ($pagename as $index => $page): ?>
            <tr>
              <td><input type="hidden" name="page_names[]" value="<?= $page['page_name']; ?>"><?= $page['page_name']; ?></td>
              <td><input type="checkbox" name="is_view[<?= $index; ?>]" value="<?= $page['page_name']; ?>"></td>
              <td><input type="checkbox" name="is_add[<?= $index; ?>]" value="<?= $page['page_name']; ?>"></td>
              <td><input type="checkbox" name="is_edit[<?= $index; ?>]" value="<?= $page['page_name']; ?>"></td>
              <td><input type="checkbox" name="is_delete[<?= $index; ?>]" value="<?= $page['page_name']; ?>"></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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