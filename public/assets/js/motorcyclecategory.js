$(document).ready(function () {
    // Get the URL from the data attribute
    var baseURL = $('#url-base').data('url');
    var url = $('#data-table-url').data('url');

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
            { data: 'category', className: 'table-cell text-center font-size-14' },
            { data: 'model_type', className: 'table-cell text-center font-size-14' },
            { data: 'created_by', className: 'table-cell text-center font-size-14' },
            { data: 'created_at', className: 'table-cell text-center font-size-14' },
            { data: 'updated_by', className: 'table-cell text-center font-size-14' },
            { data: 'updated_at', className: 'table-cell text-center font-size-14' },
            {
                data: 'is_active',
                className: 'table-cell text-center font-size-14',
                render: function (data, type, row) {
                    return data == 1 ? 
                        '<button class="btn btn-success">Active</button>' : 
                        '<button class="btn btn-danger">Inactive</button>';
                }
            },
            {
                data: null,
                className: 'table-cell text-center font-size-14',
                responsivePriority: 1, // Ensures this column stays visible
                render: function (data, type, row) {
                    let buttons = '<a class="btn-primary edit-btn"><i class="fas fa-user-edit"></i></a>';
            
                    if (row.is_active == 0) {
                        buttons += '<a class="btn-danger activate-btn"><i class="fas fa-power-off"></i></a>';
                    }
            
                    if (row.is_active == 1) {
                        buttons += '<a class="btn-success deactivate-btn"><i class="fas fa-power-off"></i></a>';
                    }
            
                    return buttons;
                }
            }
            
        ],
        "responsive": true,
        autoWidth: false, 
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10
    });
// Form validation
function validateForm() {
    var isValid = true;
    
    // Clear previous error highlighting and messages
    $('#addItemForm').find('.form-control').removeClass('error');
    $('#addItemForm').find('.error-message').remove();

    var fields = [
        { id: 'model_type', message: 'Model Type field cannot be empty' },
        { id: 'category', message: 'Category field cannot be empty' }
    ];

    fields.forEach(function(field) {
        var value = $('#' + field.id).val().trim();
        if (value === '') {
            $('#' + field.id).addClass('error');
            $('#' + field.id).after('<div class="error-message">' + field.message + '</div>');
            isValid = false;
        }
    });

    return isValid; // Allow form submission if valid
}
// Add item form submission
$('#addItemForm').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Validate the form
    if (!validateForm()) {
        return; // Stop form submission if validation fails
    }

    // Remove previous error highlighting and messages
    $('#addItemForm').find('.form-control').removeClass('error');
    $('#addItemForm').find('.error-message').text(''); // Clear previous error messages

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(), // Serialize the form data
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Close the modal
                $('#exampleModal').modal('hide');
                // Show SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'User added successfully',
                }).then(function () {
                    // Reload the table data
                    table.ajax.reload();
                    $('#addItemForm')[0].reset(); // Reset the form fields
                });
            } else {
                if (response.message === 'Record already exists') {
                    // Show SweetAlert warning message for duplicates
                    Swal.fire({
                        icon: 'warning',
                        title: 'Duplicate Entry',
                        text: 'The record already exists. Please check your data and try again.',
                    });
                } else {
                    // Ensure errors is defined and is an object
                    let errors = response.errors || {};
                    
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There were some errors!',
                        footer: '<ul>' + Object.values(errors).map(error => '<li>' + error + '</li>').join('') + '</ul>'
                    });

                    // Highlight errors and show messages
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            $('#' + field).addClass('error');
                            $('#' + field + '-error').text(errors[field]);
                        }
                    }
                }
            }
        },
        error: function () {
            // Show SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.',
            });
        }
    });
});


  // Store original data when the edit button is clicked
  var originalData = {};

  $('#items_table tbody').on('click', '.edit-btn', function () {
      var data = table.row($(this).parents('tr')).data();
      var id = data.IndexKey;

      // Store original data
      originalData = {
          id: data.IndexKey,
          model_type: data.model_type,
          category: data.category
      };

      console.log('Original Data:', originalData); // Log original data

      $.ajax({
          url: baseURL + 'edit/' + id,
          method: 'GET',
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  // Populate your edit modal with user data
                  $('#editModal #model_type').val(response.data.model_type);
                  $('#editModal #category').val(response.data.category);
                  $('#editModal #user-id').val(response.data.IndexKey);
                  $('#editModal').modal('show');
              } else {
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: response.message
                  });
              }
          }
      });
  });

   // Helper function to safely trim a value
function safeTrim(value) {
    return value ? value.trim() : '';
}
  // Edit form submission
  $('#editForm').on('submit', function (e) {
      e.preventDefault();

      var id = $('#editModal #user-id').val();

      // Get the current values from the form
  
      var model_type = safeTrim($('#editModal #model_type').val());
      var category = safeTrim($('#editModal #category').val());

      var currentData = {
          id: id,
          model_type: model_type,
          category: category,
          
      };

      console.log('Current Data:', currentData); // Log current data
       // Clear previous highlights and error messages
       $('#editModal input, #editModal select').removeClass('is-invalid');
       $('#editModal .invalid-feedback').hide();

       // Check for empty fields
       var isValid = true;
       $.each(currentData, function (key, value) {
           if (value === '') {
               var $input = $('#editModal #' + key);
               $input.addClass('is-invalid'); // Highlight empty field in red
               $input.next('.invalid-feedback').show(); // Show error message
               isValid = false;
           }
       });

       if (!isValid) {
           Swal.fire({
               icon: 'warning',
               title: 'Validation Error',
               text: 'Please fill out all required fields.'
           });
           return; // Stop form submission if any field is empty
       }
      // Check if data has changed
      var hasChanges = false;
      $.each(originalData, function (key, value) {
          console.log(`Comparing ${key}: Original: ${value}, Current: ${currentData[key]}`); // Log each comparison
          if (currentData[key] !== value) {
              hasChanges = true;
              return false; // Exit loop if a change is found
          }
      });

     
      if (!hasChanges) {
          Swal.fire({
              icon: 'info',
              title: 'No changes',
              text: 'No changes have been made to the data.'
          });
          return; // Stop form submission if no changes
      }

      $.ajax({
          url: baseURL + 'update/' + id,
          method: 'POST',
          data: $(this).serialize(),
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  $('#editModal').modal('hide');
                  Swal.fire({
                      icon: 'success',
                      title: 'Updated!',
                      text: 'Information has been updated.'
                  }).then(function () {
                      table.ajax.reload();
                  });
              } else {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'There were some errors!',
                      footer: '<ul>' + Object.values(response.errors).map(error => '<li>' + error + '</li>').join('') + '</ul>'
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

  // Activate button click
  $('#items_table tbody').on('click', '.activate-btn', function () {
      var data = table.row($(this).parents('tr')).data();
      var id = data.IndexKey;

      Swal.fire({
          title: 'Are you sure?',
          text: "Your record will be activated!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, activate it!'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: baseURL + 'activate/' + id,
                  method: 'GET',
                  dataType: 'json',
                  success: function (response) {
                      if (response.success) {
                          Swal.fire(
                              'Activated!',
                              'Your record has been activated.',
                              'success'
                          );
                          table.ajax.reload();
                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Failed to delete the record.'
                          });
                      }
                  }
              });
          }
      });
  });


  // Deactivate button click
  $('#items_table tbody').on('click', '.deactivate-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    var id = data.IndexKey;

    Swal.fire({
        title: 'Are you sure?',
        text: "Your record will be deactivated!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactivate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + 'deactivate/' + id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Deactivated!',
                            'Your record has been deactivated.',
                            'success'
                        );
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete the record.'
                        });
                    }
                }
            });
        }
    });
});
  


});