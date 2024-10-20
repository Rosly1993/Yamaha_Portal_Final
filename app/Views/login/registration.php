<?= $this->include('layouts/header_login') ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .logo-wrapper img {
        width: 350px;
        height: auto;
    }

    .account-pages {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .logo-wrapper {
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        text-align: center;
        width: 100%;
    }

    .card-body {
        position: relative;
        padding-top: 120px;
    }

    .card {
        overflow: visible;
    }

    .auth-brand img {
        max-width: 100%;
        height: auto;
    }

    /* Style for the disabled button */
    #signup-btn:disabled {
        background-color: #7EACB5;
        border-color: #7EACB5;
        cursor: not-allowed;
    }

    .highlight-error {
        border: 2px solid red;
    }
</style>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="logo-wrapper">
                            <div class="auth-brand">
                                <a href="" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?= base_url('public/assets/images/Yamaha2.png') ?>" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="text-center w-75 m-auto"><br>
                            <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                        </div>

                        <form action="" id="login-form" method="POST">
                            <?php if($session->getFlashdata('error')): ?>
                                <div class="alert alert-danger rounded-0 mb-3">
                                    <?= $session->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            <?php if($session->getFlashdata('success')): ?>
                                <div class="alert alert-success rounded-0 mb-3">
                                    <?= $session->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="firstname" class="form-label">First Name</label><span style="color:red">*</span>
                                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Enter your Firstname">
                                </div>
                                <div class="col-md-4">
                                    <label for="middlename" class="form-label">Middle Name</label><span style="color:red">*</span>
                                    <input class="form-control" type="text" name="middlename" id="middlename" placeholder="If not applicable put N/A....">
                                </div>
                                <div class="col-md-4">
                                    <label for="lastname" class="form-label">Last Name</label><span style="color:red">*</span>
                                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Enter your Lastname">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label><span style="color:red">*</span>
                                    <select class="form-select" type="text" name="gender" id="gender" placeholder="Enter your Lastname">
                                        <option value="">Please Select Gender...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                <label for="date_birth" class="form-label">Date of Birth</label><span style="color:red">*</span>
                                <input type="date"  max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" name="date_birth" id="date_birth" class="form-control" autocomplete="off">
                            </div>
                        
                            <div class="col-md-4">
                                <label for="id_number" class="form-label">ID Number</label><span style="color:red">*</span>
                                <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter ID Number ...." autocomplete="off">
                            </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label><span style="color:red">*</span>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Enter your valid email">   
                                </div>
                                <div class="col-md-4">
                                    <label for="phone_number" class="form-label">Phone Number</label><span style="color:red">*</span>
                                    <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Enter Phone Number(ex. 0916-768-0741)">   
                                </div>
                        
                                <div class="col-md-4">
                                <label for="role_id" class="form-label">Employee Type</label><span style="color:red">*</span>
                                <select name="role_id" id="role_id" class="form-select" autocomplete="off">
                                <option value="">Select Employee Type</option>
                                <?php foreach ($rolename as $role): ?>
                                    <option value="<?= $role['IndexKey']; ?>"><?= $role['roles']; ?></option>
                                <?php endforeach; ?>
                                </select>
                               
                            </div>
                            </div>

                            <div class="row mb-3">
                           <div class="mb-3 col-4 col-md-4 col-sm-4">
                            <label for="headoffice" class="form-label">Head Office</label><span style="color:red">*</span>
                            <select type="select" name="headoffice" id="headoffice" class="form-select" autocomplete="off">
                            <!-- <option>Please Select headoffice</option> -->
                            </select>
                        
                        </div>
                    
                        <div class="mb-3 col-4 col-md-4 col-sm-4">
                            <label for="branchname" class="form-label">Branch Name</label><span style="color:red">*</span>
                            <select type="select" name="branchname" id="branchname" class="form-select"  autocomplete="off">
                            <option value="">Please Select Area First</option>
                            </select>
                        
                        </div>
                        <div class="mb-3 col-4 col-md-4 col-sm-4">
                            <label for="area" class="form-label">Area</label><span style="color:red">*</span>
                            <select type="select" name="area" id="area" class="form-select" autocomplete="off">
                            <option value="">Please Select Branch Name First</option>
                            </select>
                        
                        </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signup" name="terms" <?= old('terms') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button id="signup-btn" class="btn btn-success" type="submit" <?= old('terms') ? '' : 'disabled' ?>>Sign Up</button>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have an account? <a href="<?= base_url() ?>" class="text-white ms-1"><b>Sign In</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div id="url-base" data-url="<?= site_url('LoginController/') ?>"></div>
<script> var baseURL = '<?= site_url('LoginController/') ?>'; </script>
<!-- JavaScript to handle enabling/disabling the button -->
<script>
$(document).ready(function() {
    // Get references to the checkbox and the sign-up button
    const checkbox = document.getElementById('checkbox-signup');
    const signupButton = document.getElementById('signup-btn');

    // Listen for changes on the checkbox
    checkbox.addEventListener('change', function() {
        // Toggle the disabled attribute based on whether the checkbox is checked
        signupButton.disabled = !this.checked;
    });

    // Function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Form submission handler
    $('#login-form').on('submit', function(event) {
        let isValid = true;
        $('.highlight-error').removeClass('highlight-error'); // Remove previous highlights

        // Check each required field
        $('#firstname, #middlename, #lastname, #email, #gender, #date_birth, #id_number, #phone_number, #role_id, #headoffice, #branchname, #area').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('highlight-error');
                isValid = false;
            }
        });

        // Validate email format
        const email = $('#email').val().trim();
        if (email !== '' && !isValidEmail(email)) {
            $('#email').addClass('highlight-error');
            isValid = false;
        }

        // Prevent form submission if not valid
        if (!isValid) {
            event.preventDefault(); // Prevent the form from submitting

            // Show SweetAlert2 alert
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields and ensure the email address is valid.',
                confirmButtonText: 'OK'
            });
        }
    });
});
    
</script>

<script>
$(document).ready(function() {
    const baseURL = $('#url-base').data('url');
    
    // Fetch head offices
    $.ajax({
        url: baseURL + 'getHeadoffice',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            const headofficeDropdown = $('#headoffice');
            headofficeDropdown.empty().append('<option value="">Please Select Head Office</option>');
            $.each(response, function(index, item) {
                headofficeDropdown.append('<option value="' + item.head_office + '">' + item.head_office + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });

    // Populate branch names based on selected head office
    $('#headoffice').on('change', function() {
        const headofficeId = $(this).val();
        const branchnameDropdown = $('#branchname');
        branchnameDropdown.empty().append('<option value="">Please Select Branch Name</option>');

        if (headofficeId) {
            $.ajax({
                url: baseURL + 'getBranchname',
                type: 'GET',
                dataType: 'json',
                data: { headoffice: headofficeId },
                success: function(response) {
                    $.each(response, function(index, item) {
                        branchnameDropdown.append('<option value="' + item.dealer_name + '">' + item.dealer_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            branchnameDropdown.append('<option value="">Please Select Head Office First</option>');
        }
    });

    // Populate areas based on selected branch name
    $('#branchname').on('change', function() {
        const branchnameId = $(this).val();
        const areaDropdown = $('#area');
        areaDropdown.empty().append('<option value="">Please Select Cluster/Province</option>');

        if (branchnameId) {
            $.ajax({
                url: baseURL + 'getArea',
                type: 'GET',
                dataType: 'json',
                data: { branchname: branchnameId },
                success: function(response) {
                    $.each(response, function(index, item) {
                        areaDropdown.append('<option value="' + item.location_id + '">' + item.area + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            areaDropdown.append('<option value="">Please Select Branch Name First</option>');
        }
    });
});

   
</script>


<?= $this->include('layouts/footer_login') ?>
