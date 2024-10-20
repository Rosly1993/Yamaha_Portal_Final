<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Arsha Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('public/assets/arsha/img/favicon.png')?>" rel="icon">
  <link href="<?= base_url('public/assets/arsha/img/apple-touch-icon.png')?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('public/assets/arsha/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('public/assets/arsha/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= base_url('public/assets/arsha/vendor/aos/aos.css')?>" rel="stylesheet">
  <link href="<?= base_url('public/assets/arsha/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('public/assets/arsha/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= base_url('public/assets/arsha/css/main.css')?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">YAMAHA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Portal Links</a></li>
          <li><a href="#mission">Mission/Vision</a></li>
          
          <li><a href="#team">Org Chart</a></li>
         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- <a class="btn-getstarted" href="#about">Login</a> -->
      <a class="btn-getstarted" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>



    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Ongoing Development</h1>
            <!-- <p>We are team of talented designers making websites with Bootstrap</p> -->
            <div class="d-flex">
              <!-- <a href="#about" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="<?= base_url('public/assets/arsha/img/hero-img.png')?>"  class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="zoom-in">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor1.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor2.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor3.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor1.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor2.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor3.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor1.png')?>" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('public/assets/arsha/img/clients/motor2.png')?>" class="img-fluid" alt=""></div>
          </div>
        </div> 

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Who We Are</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
          <p>
                    We are a leading motorcycle manufacturer in the Philippines, dedicated to providing high-quality, reliable, and affordable motorcycles for riders of all levels. Our passion for innovation and performance drives us to continuously improve our products, ensuring that each bike we produce meets the highest standards of safety and efficiency.
                </p>
                <p>
                    With years of experience in the industry, we have built a strong reputation for excellence, earning the trust of countless riders across the country. Our commitment to customer satisfaction is at the core of everything we do.
                </p>
          </div>

        

        </div>

      </div>

    </section><!-- /About Section -->

   

   

    <!-- Services Section -->
    <section id="services" class="services section light-background">
<style>
 .service-link {
  text-decoration: none;
  color: inherit;
  display: block;
  width: 100%;
}

.service-item {
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  max-width: 350px; /* Fix the max width of each box */
  margin: 0 auto; /* Center the boxes within the column */
  transition: transform 0.3s ease;
  width: 100%; /* Ensure it takes full width of the column */
}

.service-item:hover {
  transform: translateY(-10px); /* Add hover effect */
}

</style>
    <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Services</h2>
    <p>Ongoing Development</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex" data-aos="fade-up" data-aos-delay="100">
        <a href="https://example.com/dnd-web" target="_blank" class="service-link">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-activity icon"></i></div>
            <h4>DND WEB</h4>
            <p>Ongoing Development</p>
          </div>
        </a>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex" data-aos="fade-up" data-aos-delay="200">
        <a href="https://example.com/3s-academy" target="_blank" class="service-link">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
            <h4>3s Academy</h4>
            <p>Ongoing Development</p>
          </div>
        </a>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6 col-sm-12 d-flex" data-aos="fade-up" data-aos-delay="300">
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
            <h4>Advance Kiosk Portal</h4>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
          </div>
        </a>
      </div><!-- End Service Item -->

    </div>

  </div>

</section>

    <!-- mission Section -->
    <section id="mission" class="mission section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Mission</h2>
        <p>To deliver innovative, high-quality motorcycles that provide Filipinos with reliable, safe, and exhilarating riding experiences, while prioritizing customer satisfaction, environmental sustainability, and community development. We aim to continuously improve our products and services through advanced technology, efficient production, and a commitment to excellence.</p>
      </div><!-- End Section Title -->

      <div class="container section-title" data-aos="fade-up">
        <h2>Vision</h2>
        <p>To be the leading motorcycle manufacturer in the Philippines, recognized for our commitment to innovation, quality, and customer-centric solutions. We aspire to shape the future of mobility in the country, empowering communities through sustainable and accessible transportation, while being a trusted partner in driving economic growth and social progress.</p>
      </div><!-- End Section Title -->

    

    </section><!-- /Services Section -->
    <!-- /Portfolio Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="<?= base_url('public/assets/arsha/img/team/team-1.jpg')?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="<?= base_url('public/assets/arsha/img/team/team-2.jpg')?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="<?= base_url('public/assets/arsha/img/team/team-3.jpg')?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="<?= base_url('public/assets/arsha/img/team/team-4.jpg')?>" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->



  </main>

  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Arsha</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your login form here -->
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
                                    <!-- <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember" value="1">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label> -->
                                </div>
                            </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Log In</button>
                                </div>
                            </form>
                                                        

                  

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                               
                                <p class="text-black-50">Forgot your password? <a href="<?= base_url('request_otp') ?>" class="text-black ms-1"><b>Reset</b></a></p>
                                <p class="text-black-50">Don't have an account? <a href="<?= base_url('registration') ?>" class="text-black ms-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
 
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Check if there's an error message in the session and trigger the modal
    var hasError = <?= json_encode($session->getFlashdata('error') ? true : false) ?>;
    
    if (hasError) {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    }
});

</script>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('public/assets/arsha/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/php-email-form/validate.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/aos/aos.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/swiper/swiper-bundle.min.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/waypoints/noframework.waypoints.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/imagesloaded/imagesloaded.pkgd.min.js')?>"></script>
  <script src="<?= base_url('public/assets/arsha/vendor/isotope-layout/isotope.pkgd.min.js')?>')?>"></script>

  <!-- Main JS File -->
  <script src="<?= base_url('public/assets/arsha/js/main.js')?>"></script>

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

</body>

</html>