$(document).ready(function () {
    // Get the URL from the data attribute
    var baseURL = $('#url-base').data('url');
    var base_URL = $('#url-base1').data('url');
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
            { data: 'head_office', className: 'table-cell text-center font-size-14' },
            { data: 'dealer_name', className: 'table-cell text-center font-size-14' },
            { data: 'dealer_code', className: 'table-cell text-center font-size-14' },
            { data: 'shop_type', className: 'table-cell text-center font-size-14' },
            { data: 'date_opened', className: 'table-cell text-center font-size-14' },
            { data: 'area', className: 'table-cell text-center font-size-14' },
            { data: 'region', className: 'table-cell text-center font-size-14' },
            { data: 'cluster_province', className: 'table-cell text-center font-size-14' },
            {
                data: 'is_active',
                className: 'table-cell text-center font-size-14',
                render: function (data, type, row) {
                    return data == 1 ? 
                        '<span class="badge label-table bg-success">Active</span>' : 
                        '<span class="badge label-table bg-secondary text-light">Inactive</span>';
                }
            },
            { data: 'created_by', className: 'table-cell text-center font-size-14' },
            { data: 'created_at', className: 'table-cell text-center font-size-14' },
            { data: 'updated_by', className: 'table-cell text-center font-size-14' },
            { data: 'updated_at', className: 'table-cell text-center font-size-14' },
           
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
    var isValid = true;
    
    // Clear previous error highlighting and messages
    $('#addItemForm').find('.form-control').removeClass('error');
    $('#addItemForm').find('.error-message').remove();

    var fields = [
        { id: 'head_office', message: 'Head office field cannot be empty' },
        { id: 'dealer_name', message: 'Dealer name field cannot be empty' },
        { id: 'dealer_code', message: 'Dealer Code field cannot be empty' },
        { id: 'shop_type', message: 'Shop type field cannot be empty' },
        { id: 'date_opened', message: 'Date opened field cannot be empty' },
        { id: 'area', message: 'Area field cannot be empty' },
        { id: 'region', message: 'Region field cannot be empty' },
        { id: 'cluster_province', message: 'Cluster/Province field cannot be empty' }
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
            head_office: data.head_office,
            dealer_code: data.dealer_code,
            dealer_name: data.dealer_name,
            area: data.area,
            cluster_province: data.cluster_province,
            region: data.region
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
                    // Populate the edit modal with user data
                    $('#editModal #head_office').val(response.data.head_office);
                    $('#editModal #dealer_code').val(response.data.dealer_code);
                    $('#editModal #dealer_name').val(response.data.dealer_name);
                    $('#editModal #area').val(response.data.area);
                    $('#editModal #cluster_province').val(response.data.cluster_province);
                    $('#editModal #region').val(response.data.region);
                    $('#editModal #user-id').val(response.data.IndexKey);

                    // Fetch areas and set selected value
                    $.ajax({
                        url: base_URL + 'getAreas',
                        method: 'GET',
                        dataType: 'json',
                        success: function (areas) {
                            var $areaDropdown = $('#editModal #area');
                            $areaDropdown.empty().append('<option value="">Please Select Area</option>');
                            $.each(areas, function (index, area) {
                                $areaDropdown.append('<option value="' + area.area + '">' + area.area + '</option>');
                            });
                            $areaDropdown.val(response.data.area); // Set selected value

                            // Attach change event listener to update regions when area changes
                            $areaDropdown.change(function() {
                                var selectedArea = $(this).val();
                                fetchRegion(selectedArea);
                            });

                            // Fetch regions based on initial area
                            fetchRegion(response.data.area);
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

    // Function to fetch and populate regions based on area
    function fetchRegion(areaId) {
        $.ajax({
            url: base_URL + 'getRegion',
            method: 'GET',
            dataType: 'json',
            data: { area: areaId },
            success: function (regions) {
                var $regionDropdown = $('#editModal #region');
                $regionDropdown.empty().append('<option value="">Please Select Region</option>');
                $.each(regions, function (index, region) {
                    $regionDropdown.append('<option value="' + region.region + '">' + region.region + '</option>');
                });
                $regionDropdown.val(originalData.region); // Set selected value

                // Attach change event listener to update cluster provinces when region changes
                $regionDropdown.change(function() {
                    var selectedRegion = $(this).val();
                    fetchCluster(selectedRegion);
                });

                // Fetch cluster provinces based on initial region
                fetchCluster(originalData.region);
            }
        });
    }

    // Function to fetch and populate cluster provinces based on region
    function fetchCluster(regionId) {
        $.ajax({
            url: base_URL + 'getClusterProvince',
            method: 'GET',
            dataType: 'json',
            data: { region: regionId },
            success: function (clusterProvinces) {
                var $clusterProvinceDropdown = $('#editModal #cluster_province');
                $clusterProvinceDropdown.empty().append('<option value="">Please Select Cluster/Province</option>');
                $.each(clusterProvinces, function (index, clusterProvince) {
                    $clusterProvinceDropdown.append('<option value="' + clusterProvince.cluster_province + '">' + clusterProvince.cluster_province + '</option>');
                });
                $clusterProvinceDropdown.val(originalData.cluster_province); // Set selected value
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
    var head_office = safeTrim($('#editModal #head_office').val());
    var dealer_code = safeTrim($('#editModal #dealer_code').val());
    var dealer_name = safeTrim($('#editModal #dealer_name').val());
    var area = safeTrim($('#editModal #area').val());
    var region = safeTrim($('#editModal #region').val());
    var cluster_province = safeTrim($('#editModal #cluster_province').val());

    var currentData = {
        id: id,
        head_office: head_office,
        dealer_code: dealer_code,
        dealer_name: dealer_name,
        area: area,
        region: region,
        cluster_province: cluster_province
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
        text: "Type 'Confirm' to delete your record!",
        input: 'text',
        inputPlaceholder: 'Type Confirm',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        preConfirm: (inputValue) => {
            if (inputValue !== 'Confirm') {
                Swal.showValidationMessage('You need to type "Confirm" to proceed!');
            }
            return inputValue;
        }
    }).then((result) => {
        if (result.isConfirmed && result.value === 'Confirm') {
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

$(document).ready(function() {
    var areaDropdown = $('#area');

    // Fetch categories on page load
    $.ajax({
        url: base_URL + 'getAreas',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Add a default option
            areaDropdown.append('<option value="">Please Select Area</option>');

            // Populate the area dropdown based on the response
            $.each(response, function(index, item) {
                areaDropdown.append('<option value="' + item.area + '">' + item.area + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX Error:', status, error);
        }
    });

    // Populate model_type dropdown based on selected category
    $('#area').on('change', function() {
        var areaId = $(this).val();
        var regionDropdown = $('#region');

        // Clear the model_type dropdown
        regionDropdown.empty();

        if (areaId) {
            $.ajax({
                url: base_URL + 'getRegion',
                type: 'GET',
                dataType: 'json',
                data: { area: areaId },
                success: function(response) {
                    // Add a default option
                    regionDropdown.append('<option value="">Please Select Region</option>');

                    // Populate the model_type dropdown based on the response
                    $.each(response, function(index, item) {
                        regionDropdown.append('<option value="' + item.region + '">' + item.region + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            // If no category is selected, reset the model_type dropdown
            regionDropdown.append('<option value="">Please Select Area First</option>');
        }
    });
});


 // Populate model_type dropdown based on selected category
 $('#region').on('change', function() {
    var regionId = $(this).val();
    var cluster_provinceDropdown = $('#cluster_province');

    // Clear the model_type dropdown
    cluster_provinceDropdown.empty();

    if (regionId) {
        $.ajax({
            url: base_URL + 'getClusterProvince',
            type: 'GET',
            dataType: 'json',
            data: { region: regionId },
            success: function(response) {
                // Add a default option
                cluster_provinceDropdown.append('<option value="">Please Select Cluster/Province</option>');

                // Populate the model_type dropdown based on the response
                $.each(response, function(index, item) {
                    cluster_provinceDropdown.append('<option value="' + item.cluster_province + '">' + item.cluster_province + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX Error:', status, error);
            }
        });
    } else {
        // If no category is selected, reset the model_type dropdown
        cluster_provinceDropdown.append('<option value="">Please Select Region First</option>');
    }
});
});



