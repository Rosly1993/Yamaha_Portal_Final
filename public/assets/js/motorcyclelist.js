$(document).ready(function () {
    // Get the URL from the data attribute
    var baseURL = $('#url-base').data('url');
    var base_URL = $('#url-base1').data('url');
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
            { data: 'pet_name', className: 'table-cell text-center font-size-14' },
            { data: 'model_code', className: 'table-cell text-center font-size-14' },
            { data: 'model_name', className: 'table-cell text-center font-size-14' },
            { data: 'model_type', className: 'table-cell text-center font-size-14' },
            { data: 'category', className: 'table-cell text-center font-size-14' },
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
        { id: 'pet_name', message: 'Pet Name field cannot be empty' },
        { id: 'model_code', message: 'Model Code field cannot be empty' },
        { id: 'model_name', message: 'Model Name field cannot be empty' },
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
  $(document).ready(function() {
   
    $('#items_table tbody').on('click', '.edit-btn', function () {
        var data = table.row($(this).parents('tr')).data();
        var id = data.IndexKey;

        // Store original data
        originalData = {
            id: data.IndexKey,
            pet_name: data.pet_name,
            model_code: data.model_code,
            model_name: data.model_name,
            model_type: data.model_type,
            category: data.category
        };

        console.log('Original Data:', originalData); // Log original data

        // Fetch and populate the edit modal
        $.ajax({
            url: baseURL + 'edit/' + id,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log('Response:', response); // Log the response
                if (response.success) {
                    // Populate your edit modal with user data
                    $('#editModal #pet_name').val(response.data.pet_name);
                    $('#editModal #model_code').val(response.data.model_code);
                    $('#editModal #model_name').val(response.data.model_name);
                    $('#editModal #user-id').val(response.data.IndexKey);

                    // Fetch categories and set selected value
                    $.ajax({
                        url: base_URL + 'getCategories',
                        method: 'GET',
                        dataType: 'json',
                        success: function (categories) {
                            var $categoryDropdown = $('#editModal #category');
                            $categoryDropdown.empty().append('<option value="">Please Select Category</option>');
                            $.each(categories, function (index, category) {
                                $categoryDropdown.append('<option value="' + category.category + '">' + category.category + '</option>');
                            });
                            $categoryDropdown.val(response.data.category); // Set selected value

                            // Attach change event listener to update model types
                            $categoryDropdown.change(function() {
                                var selectedCategory = $(this).val();
                                fetchModelTypes(selectedCategory);
                            });

                            // Fetch model types based on initial category
                            fetchModelTypes(response.data.category);
                        }
                    });
                    
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

  
   // Function to fetch and populate model types based on category
function fetchModelTypes(categoryId) {
    $.ajax({
        url: base_URL + 'getModelTypes',
        method: 'GET',
        dataType: 'json',
        data: { category: categoryId },
        success: function (modelTypes) {
            var $modelTypeDropdown = $('#editModal #model_type');
            $modelTypeDropdown.empty(); // Clear existing options
            // Add default option
            $modelTypeDropdown.append('<option value="">Please Select Model Type</option>');
            // Add fetched model types
            $.each(modelTypes, function (index, modelType) {
                $modelTypeDropdown.append('<option value="' + modelType.model_type + '">' + modelType.model_type + '</option>');
            });
            // Set selected model type after updating dropdown
            $modelTypeDropdown.val(originalData.model_type);
        }
    });
}
});

// Helper function to safely trim a value
function safeTrim(value) {
    return value ? value.trim() : '';
}
  // Edit form submission
  $('#editForm').on('submit', function (e) {
      e.preventDefault();

      var id = $('#editModal #user-id').val();

        // Get the current values from the form and use safeTrim
        var pet_name = safeTrim($('#editModal #pet_name').val());
        var model_code = safeTrim($('#editModal #model_code').val());
        var model_name = safeTrim($('#editModal #model_name').val());
        var model_type = safeTrim($('#editModal #model_type').val());
        var category = safeTrim($('#editModal #category').val());
 
      

      var currentData = {
          id: id,
          pet_name: pet_name,
          model_code: model_code,
          model_name: model_name,
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
 
$(document).ready(function() {
    var categoryDropdown = $('#category');

    // Fetch categories on page load
    $.ajax({
        url: base_URL + 'getCategories',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Add a default option
            categoryDropdown.append('<option value="">Please Select Category</option>');

            // Populate the category dropdown based on the response
            $.each(response, function(index, item) {
                categoryDropdown.append('<option value="' + item.category + '">' + item.category + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX Error:', status, error);
        }
    });

    // Populate model_type dropdown based on selected category
    $('#category').on('change', function() {
        var categoryId = $(this).val();
        var modelTypeDropdown = $('#model_type');

        // Clear the model_type dropdown
        modelTypeDropdown.empty();

        if (categoryId) {
            $.ajax({
                url: base_URL + 'getModelTypes',
                type: 'GET',
                dataType: 'json',
                data: { category: categoryId },
                success: function(response) {
                    // Add a default option
                    modelTypeDropdown.append('<option value="">Please Select Model Type</option>');

                    // Populate the model_type dropdown based on the response
                    $.each(response, function(index, item) {
                        modelTypeDropdown.append('<option value="' + item.model_type + '">' + item.model_type + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            // If no category is selected, reset the model_type dropdown
            modelTypeDropdown.append('<option value="">Please Select Category First</option>');
        }
    });
});
});


