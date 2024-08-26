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
            { data: 'title', className: 'table-cell text-center font-size-14' },
            { data: 'reference_number', className: 'table-cell text-center font-size-14' },
            { data: 'date_published', className: 'table-cell text-center font-size-14' },
            {
                data: 'attachment',
                className: 'table-cell text-center font-size-14',
                render: function (data, type, row) {
                    var fileURL = base_URL + 'public/assets/uploads/' + data;
                    var pdfURL = fileURL + '#toolbar=0&navpanes=0&scrollbar=0'; // Disable toolbar and scrollbar
                    var confidentialClass = row.is_confidential == 1 ? 'danger' : 'info';
                    var confidentialIcon = row.is_confidential == 1 ? 'fas fa-eye' : 'fas fa-eye';
                    var confidentialColor = row.is_confidential == 1 ? '#73BBA3' : '#73BBA3';
                    
                    return '<a href="#" class="btn ' + confidentialClass + ' view-attachment" data-url="' + pdfURL + '" data-confidential="' + row.is_confidential + '"><i style="font-size: 30px; color: ' + confidentialColor + '" class="' + confidentialIcon + '"></i></a>';
                }
            },
            {
                data: 'attachment',
                className: 'table-cell text-center font-size-14',
                render: function (data, type, row) {
                    var fileURL = baseURL + 'files/download/' + data;
                    // Check if the file is confidential
                    if (row.is_confidential == 1) {
                        return '<a href="#" class="btn-danger" aria-disabled="true" title="Confidential: Viewing Only"><i style="font-size: 30px; color: red" class="fas fa-times-circle"></i></a>';
                    } else {
                        return '<a href="' + fileURL + '" class="btn-info" download title="Download"><i style="font-size: 30px; color: #399918" class="fas fa-cloud-download-alt"></i></a>';
                    }
                }
            },
            
            
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
    $('#items_table').on('click', '.view-attachment', function (e) {
        e.preventDefault();
        var fileURL = $(this).data('url');
        var isConfidential = $(this).data('confidential');
    
        $('#attachmentPreview').attr('src', fileURL);
        $('#attachmentModal').modal('show');
    
        // Set the background color based on confidentiality
        var modalContent = $('#attachmentModal .modal-content');
        modalContent.removeClass('confidential non-confidential'); // Remove any existing classes
        if (isConfidential == 1) {
            modalContent.addClass('confidential');
        } else {
            modalContent.addClass('non-confidential');
        }
    });
// Form validation
function validateForm() {
    var isValid = true;
    
    // Clear previous error highlighting and messages
    $('#addItemForm').find('.form-control').removeClass('error');
    $('#addItemForm').find('.error-message').remove();

    var fields = [
        { id: 'title', message: 'Title field cannot be empty' },
        { id: 'reference_number', message: 'Reference Number field cannot be empty' },
        { id: 'date_published', message: 'Date Opened field cannot be empty' },
        { id: 'is_confidential', message: 'Is Confidential field cannot be empty' }
    ];

    fields.forEach(function(field) {
        var value = String($('#' + field.id).val()).trim(); // Convert value to string
        if (value === '') {
            $('#' + field.id).addClass('error');
            $('#' + field.id).after('<div class="error-message">' + field.message + '</div>');
            isValid = false;
        }
    });

    // Check if the attachment field is not empty and is a PDF file
    var attachment = $('#attachment')[0].files[0];
    if (!attachment) {
        $('#attachment').addClass('error');
        $('#attachment').after('<div class="error-message">Attachment field cannot be empty</div>');
        isValid = false;
    } else if (attachment.type !== 'application/pdf') {
        $('#attachment').addClass('error');
        $('#attachment').after('<div class="error-message">Attachment must be a PDF file</div>');
        isValid = false;
    }

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
    
    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        processData: false, // Do not process data
        contentType: false, // Do not set content type header
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
                    $('#addItemForm')[0].reset(); // Reset the form fields tial-value
                    $('#confidential-value').val('');
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
          title: data.title,
          reference_number: data.reference_number,
          date_published: data.date_published
      };

      console.log('Original Data:', originalData); // Log original data

      $.ajax({
          url: baseURL + 'edit/' + id,
          method: 'GET',
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  // Populate your edit modal with user data
                  $('#editModal #title').val(response.data.title);
                  $('#editModal #reference_number').val(response.data.reference_number);
                  $('#editModal #date_published').val(response.data.date_published);
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
  
      var title = safeTrim($('#editModal #title').val());
      var reference_number = safeTrim($('#editModal #reference_number').val());
      var date_published = safeTrim($('#editModal #date_published').val());

      var currentData = {
          id: id,
          title: title,
          reference_number: reference_number,
          date_published: date_published,
          
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
        text: "Your record will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + 'deactivate/' + id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
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