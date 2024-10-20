<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Role Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="role_select" name="role_select">
          <div class="row">
            <div class="mb-3 col-12">
              <table class="table table-bordered">
                <thead class="thead-dark">
                <tr style="background-color: #03346E; color: white">
                    <th scope="col">Role ID</th>
                    <th scope="col">Role Name</th>
                    <th scope="col">Page Name</th>
                    <th scope="col">Is View</th>
                    <th scope="col">Is Add</th>
                    <th scope="col">Is Edit</th>
                    <th scope="col">Is Delete</th>
                  </tr>
                </thead>
                <tbody id="edit_modal_body" style="text-align: center">
                  <!-- Dynamic rows will be added here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="updateChangesBtn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
