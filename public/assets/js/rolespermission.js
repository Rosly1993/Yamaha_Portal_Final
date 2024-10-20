$(document).ready(function () {
    // Get the URL from the data attribute
    var baseURL = $('#url-base').data('url');
    var url = $('#data-table-url').data('url');
    var is_edit = $('#is_edit').data('value'); // Correctly get the value
    var is_delete = $('#is_delete').data('value'); // Correctly get the value

    // Display or hide the edit button based on is_edit value
    if (is_edit == 0) {
        $('.edit-btn').hide();
    } else if (is_edit == 1) {
        $('.edit-btn').show();
    }

    var table = $('#items_table').DataTable({
        "ajax": {
            "url": url,
            "type": "GET",
            "dataSrc": function (json) {
                console.log(json); // Log the data to check if it's correct
                return json.data;
            },
            "error": function (xhr, error, thrown) {
                console.log("Error: ", error); // Log errors
            }
        },
        "columns": [
            { data: 'IndexKey', className: 'table-cell text-center font-size-14' },        
            { data: 'roles', className: 'table-cell text-center font-size-14' },
            { data: 'created_by', className: 'table-cell text-center font-size-14' },
            { data: 'created_at', className: 'table-cell text-center font-size-14' },
            { data: 'updated_by', className: 'table-cell text-center font-size-14' },
            { data: 'updated_at', className: 'table-cell text-center font-size-14' },
            
            {
                data: 'is_active',
                className: 'table-cell text-center font-size-14',
                render: function (data, type, row) {
                    return data == 1 ? 
                        '<span class="badge label-table bg-success">Active</span>' : 
                        '<span class="badge label-table bg-secondary text-light">Inactive</span>';
                }
            },
            {
                data: null,
                className: 'table-cell text-center font-size-14',
                responsivePriority: 1, // Ensures this column stays visible
                render: function (data, type, row) {
                    let buttons = '';
            
                    if (is_edit == 1) { // Show edit button based on is_edit
                        buttons += '<a class="btn-primary edit-btn"><i class="fas fa-edit"></i></a>';
                    }

                    if (is_delete == 1) { // Show activate/deactivate buttons based on is_delete
                        if (row.is_active == 0) {
                            buttons += '<a class="btn-danger activate-btn"><i class="fas fa-trash"></i></a>';
                        }

                        if (row.is_active == 1) {
                            buttons += '<a class="btn-success deactivate-btn"><i class="fas fa-trash"></i></a>';
                        }
                    }
            
                    return buttons;
                }
            }
            
        ],
        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10
    });
// Form validation
function validateForm() {
    var role_id = $('#role_id').val();
    if (role_id === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Role field cannot be empty'
        });
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

// Handle form submission
$('#addItemForm').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    
    if (!validateForm()) return; // Validate the form before proceeding

    // Get data from form
    var role_id = $('#role_id').val();
    var page_names = [];
    var is_add_values = [];
    var is_edit_values = [];
    var is_view_values = [];
    var is_delete_values = [];
    
    // Loop through each row in the table
    $('#addItemForm tbody tr').each(function() {
        var page_name = $(this).find('input[name="page_name"]').val(); // Get page name from each row
        var is_add = $(this).find('input[name="is_add[]"]').is(':checked') ? '1' : '0'; // Add 1 if checked, 0 if not checked
        var is_edit = $(this).find('input[name="is_edit[]"]').is(':checked') ? '1' : '0'; 
        var is_view = $(this).find('input[name="is_view[]"]').is(':checked') ? '1' : '0'; 
        var is_delete = $(this).find('input[name="is_delete[]"]').is(':checked') ? '1' : '0'; 

        page_names.push(page_name);
        is_add_values.push(is_add);
        is_edit_values.push(is_edit);
        is_view_values.push(is_view);
        is_delete_values.push(is_delete);
    });

    $(document).ready(function() {
        $('#addItemForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(), // Serialize the form data
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#exampleModal').modal('hide'); // Close the modal
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function () {
                            table.ajax.reload(); // Reload the table data
                            $('#addItemForm')[0].reset(); // Reset the form fields
                        });
                    } else {
                        if (response.message === 'Role already exists!') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Duplicate Entry',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.'
                    });
                }
            });
        });
    });
});

// Store original data when the edit button is clicked


// Handle the click event on the edit button
$('#items_table tbody').on('click', '.edit-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    var role_id = data.role_id;
    $.ajax({
        url: baseURL + 'edit/' + role_id,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Clear existing rows in the modal body
                $('#edit_modal_body').empty();

                // Iterate over each role detail and add a row to the modal body
                $.each(response.data, function (index, roleDetail) {
                    var rowHtml = '<tr data-role-id="' + roleDetail.role_id + '">' + // Add role_id as a data attribute
                    '<td>' + roleDetail.role_id + '</td>' +
                    '<td>' + roleDetail.roles + '</td>' +
                    '<td>' + roleDetail.page_name + '</td>' +
                    '<td><input type="checkbox" class="form-check-input is_view_checkbox" ' + (roleDetail.is_view === '1' ? 'checked' : '') + '></td>' +
                    '<td><input type="checkbox" class="form-check-input is_add_checkbox" ' + (roleDetail.is_add === '1' ? 'checked' : '') + '></td>' +
                    '<td><input type="checkbox" class="form-check-input is_edit_checkbox" ' + (roleDetail.is_edit === '1' ? 'checked' : '') + '></td>' +
                    '<td><input type="checkbox" class="form-check-input is_delete_checkbox" ' + (roleDetail.is_delete === '1' ? 'checked' : '') + '></td>' +
                    '</tr>';
                    $('#edit_modal_body').append(rowHtml);
                });
                
                
                $('#editModal #role_select').val(response.data[0].role_id); // Assuming all role details have the same role_id
                // Show modal with pre-filled form fields
                $('#editModal').modal('show');
              
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.'
            });
        }
    });
});
$('#updateChangesBtn').click(function (event) {
    event.preventDefault();
    var role_id = $('#role_select').val(); // Ensure this retrieves the correct role ID
    console.log("Role ID:", role_id); // Log role_id for debugging

    var editedData = [];
    $('#edit_modal_body tr').each(function () {
        var page_name = $(this).find('td:eq(2)').text(); // Ensure page_name is correctly selected
        var isView = $(this).find('.is_view_checkbox').prop('checked') ? '1' : '0';
        var isAdd = $(this).find('.is_add_checkbox').prop('checked') ? '1' : '0';
        var isEdit = $(this).find('.is_edit_checkbox').prop('checked') ? '1' : '0';
        var isDelete = $(this).find('.is_delete_checkbox').prop('checked') ? '1' : '0';

        editedData.push({
            role_id: role_id,
            page_name: page_name,
            is_view: isView,
            is_add: isAdd,
            is_edit: isEdit,
            is_delete: isDelete
        });
    });

    console.log("Edited Data:", editedData);

    $.ajax({
        url: baseURL + 'update/'+ role_id,
        method: 'POST',
        data: {
            role_id: role_id,
            editedData: editedData
        },
        dataType: 'json',
        success: function (response) {
            console.log('Success:', response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data updated successfully!',
                    showConfirmButton: true
                }).then(() => {
                    $('#editModal').modal('hide');
                    table.ajax.reload(); // Reload the DataTable
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while saving the data. Please try again.'
            });
        }
    });
});

// Deactivate button click
$('#items_table tbody').on('click', '.deactivate-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    var role_id = data.role_id;

    Swal.fire({
        title: 'Are you sure?',
        text: "Type 'Confirm' to delete this record.",
        icon: 'warning',
        input: 'text',
        inputPlaceholder: 'Type Confirm',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        preConfirm: (inputValue) => {
            if (inputValue !== 'Confirm') {
                Swal.showValidationMessage('You need to type "Confirm"');
                return false;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + 'deactivate/' + role_id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Deactivated!',
                            'Your record has been deleted.',
                            'success'
                        );
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to deactivate the record.'
                        });
                    }
                }
            });
        }
    });
});



});