<?= $this->include('layouts/main_header') ?>
<?= $this->include('layouts/main_sidebar') ?>
<?php include('./app/views/layouts/add_script.php'); ?>

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    <h4 class="page-title">User's Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="col-lg-12 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-pills nav-fill navtab-bg">
                                            <li class="nav-item">
                                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Basic Information
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                    Trainings
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#othersinfo" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                    Others Info
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    Settings
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="aboutme">
                                            <img src="<?= base_url('public/assets/images/' . $session->get('login_profile'))?>" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                        <h4 class="mb-0"><?= $session->get('login_firstname') ?>&nbsp;<?= $session->get('login_lastname') ?></h4>
                                        <p class="text-muted"> <?php echo $roles; ?></p>

                                        <!-- <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                                        <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button> -->

                                        <div class="text-start mt-3">
                                            <h4 class="font-13 text-uppercase">Personal Information :</h4>
                                            <!-- <p class="text-muted font-13 mb-3">
                                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                                            </p> -->
                                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2"><?= $session->get('login_firstname') ?>&nbsp;<?= $session->get('login_middlename') ?>&nbsp;<?= $session->get('login_lastname') ?></span></p>
                                        
                                            <p class="text-muted mb-2 font-13"><strong>Gender :</strong><span class="ms-2"><?= $session->get('login_gender') ?></span></p>

                                            <p class="text-muted mb-2 font-13"><strong>Birthdate :</strong><span class="ms-2"><?= $session->get('login_date_of_birth') ?></span></p>

                                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2"><?= $session->get('login_phone_number') ?></span></p>
                                        
                                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2"><?= $session->get('login_email') ?></span></p>
                                        
                                            <p class="text-muted mb-1 font-13"><strong>Id Number :</strong> <span class="ms-2"><?= $session->get('login_id_number') ?></span></p>

                                            <p class="text-muted mb-1 font-13"><strong>Head Office :</strong> <span class="ms-2"><?php  echo $head_office;?></span></p>

                                            <p class="text-muted mb-1 font-13"><strong>Branch Name :</strong> <span class="ms-2"><?php  echo $dealer_name;?></span></p>

                                            <p class="text-muted mb-1 font-13"><strong>Area :</strong> <span class="ms-2"><?php  echo $area;?></span></p>
                                        </div> 
                                                
    
                                               
                                            
    
                                            </div> <!-- end tab-pane -->
                                            <!-- end about me section content -->
    
                                            <div class="tab-pane" id="timeline">
                                            <center><br><br><br><h2>Ongoing Development</h2></center>
                                       
                                            </div>
                                            <!-- end timeline content-->

                                            <div class="tab-pane" id="othersinfo">
                                            <center><br><br><br><h2>Ongoing Development</h2></center>
                                       
                                            </div>
                                            <!-- end timeline content-->
    
                                            <div class="tab-pane" id="settings">
                                               
                                                            
                                            <center><br><br><br><h2>Ongoing Development</h2></center>
                                                    
                                                    <div class="text-end">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <!-- end settings content-->
                     


     
                <?= $this->include('layouts/main_footer') ?>   
        
              
