
<?= $this->include('layouts/header_login') ?>
<style>

.logo-wrapper img {
    width: 350px; /* Set the width you prefer */
    height: auto; /* Keeps the aspect ratio */
}

.account-pages {
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
    min-height: 100vh; /* Ensure full viewport height */
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
    padding-top: 120px; /* Adjust padding to account for the logo overlap */
}

.card {
    overflow: visible;
}

.auth-brand img {
    max-width: 100%;
    height: auto;
}


</style>

<div class="account-pages d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="logo-wrapper">
                            <div class="auth-brand">
                                <a href="" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?= base_url('public/assets/images/Yamaha2.png') ?>" alt="" height="">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="text-center w-75 m-auto mt-5">
                            <!-- <p class="text-muted mb-4 mt-5">Enter your username and password to access admin panel.</p> -->
                        </div>


                                <form action="<?= base_url('login') ?>" id="login-form" method="POST">
                                <?php if($session->getFlashdata('error')): ?>
                                    <div class="alert alert-danger rounded-0 py-1 px-2 mb-3">
                                        <?= $session->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($session->getFlashdata('success')): ?>
                                    <div class="alert alert-success rounded-0 py-1 px-2 mb-3">
                                        <?= $session->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username...">
                                    <div id="username-error" class="invalid-feedback" style="display:none;">Username is required.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                                        <div class="input-group-text">
                                            <span class="" id="toggle-password" style="cursor: pointer;">
                                                <i id="eye-icon" class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="password-error" class="invalid-feedback" style="display:none;">Password is required.</div>
                                </div>
                                      <!-- end card -->
                        <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Log In</button>
                                </div>
                            </form>
                                                        

                            </div> <!-- end card-body -->
                        </div>
                  

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="auth-recoverpw.html" class="text-white-50 ms-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <a href="<?= base_url('registration') ?>" class="text-white ms-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <?= $this->include('layouts/footer_login') ?>

<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var eyeIcon = document.getElementById('eye-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    });
    document.getElementById('login-form').addEventListener('submit', function(event) {
        // Get the form fields
        var username = document.getElementById('username');
        var password = document.getElementById('password');

        // Flag to check if the form is valid
        var isValid = true;

        // Reset any previous error states
        username.classList.remove('is-invalid');
        password.classList.remove('is-invalid');
        document.getElementById('username-error').style.display = 'none';
        document.getElementById('password-error').style.display = 'none';

        // Validate username
        if (username.value.trim() === '') {
            username.classList.add('is-invalid');
            document.getElementById('username-error').style.display = 'block';
            isValid = false;
        }

        // Validate password
        if (password.value.trim() === '') {
            password.classList.add('is-invalid');
            document.getElementById('password-error').style.display = 'block';
            isValid = false;
        }

        // If the form is not valid, prevent submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
