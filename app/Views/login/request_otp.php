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
                                    <label for="id_number" class="form-label">ID Number</label><span style="color:red">*</span>
                                    <input class="form-control" type="text" name="id_number" id="id_number" placeholder="Enter your ID Number">   
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label><span style="color:red">*</span>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Enter your valid email">   
                                </div>
                               
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signup" name="terms" <?= old('terms') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="text-center d-grid">
                                <button id="signup-btn" class="btn btn-success" type="submit" <?= old('terms') ? '' : 'disabled' ?>>Confirm</button>
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
        $('#email, #id_number').each(function() {
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



<?= $this->include('layouts/footer_login') ?>
