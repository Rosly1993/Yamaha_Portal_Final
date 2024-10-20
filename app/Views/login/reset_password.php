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
            <div class="col-md-8 col-lg-6 col-xl-4">
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
                            <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
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
                                <div class="col-md-12">
                                    <label for="OTP" class="form-label">OTP</label><span style="color:red">*</span>
                                    <input class="form-control" type="number" name="otp" id="otp" placeholder="Enter 6 digit OTP">   
                                    <div id="otp-password-error" style="color: red;"></div>
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label><span style="color: red">*</span>
                                    <div class="input-group">
                                        <input class="form-control" type="password" required name="new-password" id="new-password" placeholder="Enter your new password" autocomplete="off">
                                        <span class="input-group-text" id="new-password-eye">
                                            <i class="fas fa-eye" id="new-password-eye-icon"></i>
                                        </span>
                                    </div>
                                    <div id="password-error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm New Password</label><span style="color: red">*</span>
                                    <div class="input-group">
                                        <input class="form-control" type="password" required id="confirm-password" placeholder="Confirm your new password" autocomplete="off" onpaste="return false;">
                                        <span class="input-group-text" id="confirm-password-eye">
                                            <i class="fas fa-eye" id="confirm-password-eye-icon"></i>
                                        </span>
                                    </div>
                                    <div id="confirm-password-error" style="color: red;"></div>
                                </div>

                            <div class="mb-3">
                             
                            </div>
                            <div class="text-center d-grid">
                                <button id="signup-btn" class="btn btn-success" type="submit">Confirm</button>
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


<script>
  $(document).ready(function() {
    $('#signup-btn').click(function(event) {
        // Prevent form submission
        event.preventDefault();

        // Get form field values
        const otp = $('#otp').val();
        const newPassword = $('#new-password').val();
        const confirmPassword = $('#confirm-password').val();

        // Reset error highlights
        $('#otp').removeClass('highlight-error');
        $('#new-password').removeClass('highlight-error');
        $('#confirm-password').removeClass('highlight-error');

        let formValid = true;

        // Check if OTP is empty
        if (otp === '') {
            $('#otp').addClass('highlight-error');
            formValid = false;
            Swal.fire('Error', 'OTP cannot be empty.', 'error');
        }

        // Validate password length and character requirements
        const passwordError = validatePassword();
        if (!passwordError) {
            formValid = false;
        }

        // If the form is valid, submit it
        if (formValid) {
            $('#login-form').submit();
        }
    });

    // Password validation function
    function validatePassword() {
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        // Reset error messages
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        // Check if password is empty
        if (newPassword === '') {
            $('#new-password').addClass('highlight-error');
            Swal.fire('Error', 'Password cannot be empty.', 'error');
            return false;
        }

        // Password must be at least 8 characters long
        if (newPassword.length < 8) {
            $('#new-password').addClass('highlight-error');
            passwordError.textContent = 'Password must be at least 8 characters long';
            return false;
        }

        // Password must contain at least one letter and one number
        const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
        if (!regex.test(newPassword)) {
            $('#new-password').addClass('highlight-error');
            passwordError.textContent = 'Password must contain at least one letter and one number';
            return false;
        }

        // Check if passwords match
        if (newPassword !== confirmPassword) {
            $('#confirm-password').addClass('highlight-error');
            confirmPasswordError.textContent = 'Passwords do not match';
            return false;
        }

        return true; // Return true if all checks pass
    }

    // Toggle password visibility
    function togglePasswordVisibility(inputId, eyeIconId) {
        const passwordField = $(`#${inputId}`);
        const eyeIcon = $(`#${eyeIconId}`);
        const isPasswordVisible = passwordField.attr('type') === 'text';

        if (isPasswordVisible) {
            passwordField.attr('type', 'password');
            eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            passwordField.attr('type', 'text');
            eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    }

    $('#new-password-eye').click(function() {
        togglePasswordVisibility('new-password', 'new-password-eye-icon');
    });

    $('#confirm-password-eye').click(function() {
        togglePasswordVisibility('confirm-password', 'confirm-password-eye-icon');
    });
});

</script>




<?= $this->include('layouts/footer_login') ?>
