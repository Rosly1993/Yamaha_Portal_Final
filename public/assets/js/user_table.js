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
            { data: 'id_number', className: 'table-cell text-center font-size-14' },
            { data: 'firstname', className: 'table-cell text-center font-size-14' },
            { data: 'middlename', className: 'table-cell text-center font-size-14' },
            { data: 'lastname', className: 'table-cell text-center font-size-14' },
            { data: 'username', className: 'table-cell text-center font-size-14' },
            { data: 'gender', className: 'table-cell text-center font-size-14' },
            { data: 'date_of_birth', className: 'table-cell text-center font-size-14' },
            { data: 'email', className: 'table-cell text-center font-size-14' },
            { data: 'phone_number', className: 'table-cell text-center font-size-14' },
            { data: 'roles', className: 'table-cell text-center font-size-14' },
            { data: 'date_started', className: 'table-cell text-center font-size-14' },
            { data: 'head_office', className: 'table-cell text-center font-size-14' },
            { data: 'dealer_name', className: 'table-cell text-center font-size-14' },
            { data: 'area', className: 'table-cell text-center font-size-14' },
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
                    let buttons = '';
            
                    if (is_edit == 1) { // Show edit button based on is_edit
                        buttons += '<a class="btn-primary edit-btn"><i class="fas fa-user-edit"></i></a>';
                    }

                    if (is_delete == 1) { // Show activate/deactivate buttons based on is_delete
                        if (row.is_active == 0) {
                            buttons += '<a class="btn-danger activate-btn"><i class="fas fa-power-off"></i>&nbsp;</a>';
                           
                        }

                        if (row.is_active == 1) {
                            buttons += '<a class="btn-success deactivate-btn"><i class="fas fa-power-off"></i>&nbsp;</a>';
                            
                        }

                        if (row.is_locked == 1) {
                            buttons += '<a class="btn-danger unlock-btn"><i class="fas fa-lock"></i>&nbsp;</a>';
                            
                        }else{
                            buttons += '<a class="btn-success lock-btn"><i class="fas fa-lock-open"></i>&nbsp;</a>';

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
        var firstname = $('#firstname').val().trim();
        var middlename = $('#middlename').val().trim();   
        var email = $('#email').val().trim();
        var lastname = $('#lastname').val().trim();   
        var gender = $('#gender').val().trim();   
        var date_birth = $('#date_birth').val().trim();   
        var id_number = $('#id_number').val().trim();   
        var password = $('#password').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var role_id = $('#role_id').val().trim();
        var date_started = $('#date_started').val().trim();
        var branchname = $('#branchname').val().trim();
        var headoffice = $('#headoffice').val().trim();
        var area = $('#area').val().trim();
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email pattern
        var isValid = true;
    
        // Clear previous errors
        $('.error').removeClass('error');
        $('.error-message').remove();
    
        // Validate contact_number
        if (contact_number === '') {
            $('#contact_number').addClass('error');
            $('#contact_number').after('<div class="error-message">Phone number is required.</div>');
            isValid = false;
        }
        // Validate role_id
        if (role_id === '') {
            $('#role_id').addClass('error');
            $('#role_id').after('<div class="error-message">Employee Type is required.</div>');
            isValid = false;
        }
        // Validate date_started
        if (date_started === '') {
            $('#date_started').addClass('error');
            $('#date_started').after('<div class="error-message">Date Started is required.</div>');
            isValid = false;
        }
        // Validate branchname
        if (branchname === '') {
            $('#branchname').addClass('error');
            $('#branchname').after('<div class="error-message">Branch name is required.</div>');
            isValid = false;
        }
        // Validate headoffice
        if (headoffice === '') {
            $('#headoffice').addClass('error');
            $('#headoffice').after('<div class="error-message">Head office is required.</div>');
            isValid = false;
        }
          // Validate area
          if (area === '') {
            $('#area').addClass('error');
            $('#area').after('<div class="error-message">Area is required.</div>');
            isValid = false;
        }
          // Validate firstname
          if (firstname === '') {
            $('#firstname').addClass('error');
            $('#firstname').after('<div class="error-message">First name is required.</div>');
            isValid = false;
        }
        // Validate middlename
        if (middlename === '') {
            $('#middlename').addClass('error');
            $('#middlename').after('<div class="error-message">Middle name is required.</div>');
            isValid = false;
        }
         // Validate lastname
         if (lastname === '') {
            $('#lastname').addClass('error');
            $('#lastname').after('<div class="error-message">Last name is required.</div>');
            isValid = false;
        }

         // Validate gender
         if (gender === '') {
            $('#gender').addClass('error');
            $('#gender').after('<div class="error-message">Gender is required.</div>');
            isValid = false;
        }
         // Validate date_birth
         if (date_birth === '') {
            $('#date_birth').addClass('error');
            $('#date_birth').after('<div class="error-message">Date of Birth is required.</div>');
            isValid = false;
        }
         // Validate id_number
         if (id_number === '') {
            $('#id_number').addClass('error');
            $('#id_number').after('<div class="error-message">ID Number is required.</div>');
            isValid = false;
        }
            // Validate email
        if (email === '') {
            $('#email').addClass('error');
            $('#email').after('<div class="error-message">Email is required.</div>');
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $('#email').addClass('error');
            $('#email').after('<div class="error-message">Please enter a valid email address.</div>');
            isValid = false;
        }


        // Validate password
        if (!passwordPattern.test(password)) {
            $('#password').addClass('error');
            $('#password').after('<div class="error-message">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.</div>');
            isValid = false;
        }
    
        return isValid; // Return false to prevent form submission if any validation fails
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
                    // Show SweetAlert error message
                    let errors = response.errors;
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There were some errors!',
                        footer: '<ul>' + Object.values(errors).map(error => '<li>' + error + '</li>').join('') + '</ul>'
                    });

                    // Highlight errors and show messages
                    for (let field in errors) {
                        $('#' + field).addClass('error');
                        $('#' + field + '-error').text(errors[field]);
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
          firstname: data.firstname,
          middlename: data.middlename,
          lastname: data.lastname,
          username: data.username,
          email: data.email
      };

      console.log('Original Data:', originalData); // Log original data

      $.ajax({
          url: baseURL + 'edit/' + id,
          method: 'GET',
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  // Populate your edit modal with user data
                  $('#editModal #firstname').val(response.data.firstname);
                  $('#editModal #middlename').val(response.data.middlename);
                  $('#editModal #lastname').val(response.data.lastname);
                  $('#editModal #username').val(response.data.username);
                  $('#editModal #email').val(response.data.email);
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

  // Edit form submission
  $('#editForm').on('submit', function (e) {
      e.preventDefault();

      var id = $('#editModal #user-id').val();

      // Get the current values from the form
      var firstname = $('#editModal #firstname').val().trim();
      var middlename = $('#editModal #middlename').val().trim();
      var lastname = $('#editModal #lastname').val().trim();
      var username = $('#editModal #username').val().trim();
      var email = $('#editModal #email').val().trim();
      var password = $('#editModal #password').val();
      var confirmPassword = $('#editModal #confirm-password').val();

      // Ensure values are defined and trim them
      password = password ? password.trim() : '';
      confirmPassword = confirmPassword ? confirmPassword.trim() : '';

      var currentData = {
          id: id,
          firstname: firstname,
          middlename: middlename,
          lastname: lastname,
          username: username,
          email: email,
          password: password
      };

      console.log('Current Data:', currentData); // Log current data

      // Check if data has changed
      var hasChanges = false;
      $.each(originalData, function (key, value) {
          console.log(`Comparing ${key}: Original: ${value}, Current: ${currentData[key]}`); // Log each comparison
          if (currentData[key] !== value) {
              hasChanges = true;
              return false; // Exit loop if a change is found
          }
      });

      // Check if password has changed
      if (password !== '' && (password !== originalData.password || password !== confirmPassword)) {
          hasChanges = true; // Password has changed or mismatch
      }

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
                      text: 'User information has been updated.'
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
  

  // lock button click
  $('#items_table tbody').on('click', '.lock-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    var id = data.IndexKey;

    Swal.fire({
        title: 'Are you sure?',
        text: "Your record will be lock!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, lock it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + 'lock/' + id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Locked!',
                            'Your record has been locked.',
                            'success'
                        );
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to lock the record.'
                        });
                    }
                }
            });
        }
    });
});
  
// unlock button click
$('#items_table tbody').on('click', '.unlock-btn', function () {
    var data = table.row($(this).parents('tr')).data();
    var id = data.IndexKey;

    Swal.fire({
        title: 'Are you sure?',
        text: "Your record will be unlock!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, unlock it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseURL + 'unlock/' + id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Unlocked!',
                            'Your record has been unlocked.',
                            'success'
                        );
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to unlock the record.'
                        });
                    }
                }
            });
        }
    });
});
  




// for the dropdown

$(document).ready(function() {
    var headofficeDropdown = $('#headoffice');

    // Fetch categories on page load
    $.ajax({
        url: baseURL + 'getHeadoffice',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Add a default option
            headofficeDropdown.append('<option value="">Please Select Head Office</option>');

            // Populate the headoffice dropdown based on the response
            $.each(response, function(index, item) {
                headofficeDropdown.append('<option value="' + item.head_office + '">' + item.head_office + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX Error:', status, error);
        }
    });

    // Populate model_type dropdown based on selected category
    $('#headoffice').on('change', function() {
        var headofficeId = $(this).val();
        var branchnameDropdown = $('#branchname');

        // Clear the model_type dropdown
        branchnameDropdown.empty();

        if (headofficeId) {
            $.ajax({
                url: baseURL + 'getBranchname',
                type: 'GET',
                dataType: 'json',
                data: { headoffice: headofficeId },
                success: function(response) {
                    // Add a default option
                    branchnameDropdown.append('<option value="">Please Select Branch Name</option>');

                    // Populate the model_type dropdown based on the response
                    $.each(response, function(index, item) {
                        branchnameDropdown.append('<option value="' + item.dealer_name + '">' + item.dealer_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            // If no category is selected, reset the model_type dropdown
            branchnameDropdown.append('<option value="">Please Select Head Office First</option>');
        }
    });
});


 // Populate model_type dropdown based on selected category
 $('#branchname').on('change', function() {
    var branchnameId = $(this).val();
    var areaDropdown = $('#area');

    // Clear the model_type dropdown
    areaDropdown.empty();

    if (branchnameId) {
        $.ajax({
            url: baseURL + 'getArea',
            type: 'GET',
            dataType: 'json',
            data: { branchname: branchnameId },
            success: function(response) {
                // Add a default option
                areaDropdown.append('<option value="">Please Select Cluster/Province</option>');

                // Populate the model_type dropdown based on the response
                $.each(response, function(index, item) {
                    areaDropdown.append('<option value="' + item.location_id + '">' + item.area + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX Error:', status, error);
            }
        });
    } else {
        // If no category is selected, reset the model_type dropdown
        areaDropdown.append('<option value="">Please Select Branch Name First</option>');
    }
});
});

