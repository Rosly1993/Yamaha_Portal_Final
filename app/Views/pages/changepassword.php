<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Expired||Change Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- Theme Config Js -->
		<script src="<?= base_url('public/assets/js/head.js') ?>"></script>

		<!-- Bootstrap css -->
		<link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" id="app-style" />

		<!-- App css -->
		<link href="<?= base_url('public/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />

		<!-- Icons css -->
		<link href="<?= base_url('public/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <style>
        .position-relative {
    position: relative;
}

.logo-overlay {
    position: absolute;
    top: -40px; /* Adjust this value to move the logo up or down */
    left: 50%;
    transform: translateX(-50%);
    z-index: 10; /* Ensure the logo is above other content */
}

    </style>

    <body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container" style="max-width: 100%">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern position-relative">

                    <!-- Logo Overlay -->
                    <div class="logo-overlay">
                        <img src="<?= base_url('public/assets/images/Yamaha2.png') ?>" alt="Logo" height="150">
                    </div>

                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                       <br>
                       <br>
                       <br>
                        </div>

                        <div class="text-center w-75 m-auto">
                            <img src="<?= base_url('public/assets/images/' . $session->get('login_profile')) ?>" height="100" width="100" alt="user-image" class="rounded-circle shadow">
                            <h4 class="text-dark-50 text-center mt-3">Hi ! <?= $session->get('login_firstname') ?></h4>
                            <p class="text-muted mb-4">Password Expiration Alert! Your password is no longer valid. Please update it now to maintain secure access.</p>
                        </div>

                                <form action="<?= base_url('Main/changepassword') ?>" method="POST" onsubmit="return validatePassword()">
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

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Change Password</button>
                                </div>
                            </form>

                            <?php if(session()->getFlashdata('success')): ?>
                        <script>
                            // Display the success alert
                            Swal.fire({
                                title: 'Success!',
                                text: 'Password changed successfully. You will be logged out and redirected to the login page.',
                                icon: 'success',
                                timer: 3000, // Show for 3 seconds
                                showConfirmButton: false
                            }).then(function() {
                                // After alert, destroy session via AJAX
                                fetch("<?= base_url('Main/logout'); ?>")
                                    .then(response => {
                                        // After session destruction, redirect to login page
                                        window.location.href = "<?= base_url('/'); ?>";
                                    })
                                    .catch(error => {
                                        console.error('Error during logout:', error);
                                    });
                            });
                        </script>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('error')): ?>
                        <script>
                            // Display the success alert
                            Swal.fire({
                                title: 'Recently Used!',
                                text: 'Password recently used, please choose another password!',
                                icon: 'warning',
                                timer: 3000, // Show for 3 seconds
                                showConfirmButton: false
                            });
                        </script>
                        <?php endif; ?>

                            <script>
                                const newPasswordEye = document.getElementById('new-password-eye-icon');
                                const confirmPasswordEye = document.getElementById('confirm-password-eye-icon');

                                // Toggle password visibility
                                newPasswordEye.addEventListener('click', () => {
                                    const newPasswordInput = document.getElementById('new-password');
                                    if (newPasswordInput.type === 'password') {
                                        newPasswordInput.type = 'text';
                                        newPasswordEye.classList.add('fa-eye-slash');
                                    } else {
                                        newPasswordInput.type = 'password';
                                        newPasswordEye.classList.remove('fa-eye-slash');
                                    }
                                });

                                confirmPasswordEye.addEventListener('click', () => {
                                    const confirmPasswordInput = document.getElementById('confirm-password');
                                    if (confirmPasswordInput.type === 'password') {
                                        confirmPasswordInput.type = 'text';
                                        confirmPasswordEye.classList.add('fa-eye-slash');
                                    } else {
                                        confirmPasswordInput.type = 'password';
                                        confirmPasswordEye.classList.remove('fa-eye-slash');
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

                                    // Password must be at least 8 characters long
                                    if (newPassword.length < 8) {
                                        passwordError.textContent = 'Password must be at least 8 characters long';
                                        return false;
                                    }

                                    // Password must contain at least one letter and one number
                                    const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
                                    if (!regex.test(newPassword)) {
                                        passwordError.textContent = 'Password must contain at least one letter and one number';
                                        return false;
                                    }

                                    // Check if passwords match
                                    if (newPassword !== confirmPassword) {
                                        confirmPasswordError.textContent = 'Passwords do not match';
                                        return false;
                                    }

                                    return true; // If all checks pass, submit the form
                                }
                            </script>


                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Not you? return <a href="auth-login.html" class="text-white ms-1"><b>Sign In</b></a></p>
                            </div> 
                        </div> -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
           <script>document.write(new Date().getFullYear())</script> &copy; Yamaha Service Portal <a href="" class="text-white-50"></a> 
        </footer>
    </body>
</html>