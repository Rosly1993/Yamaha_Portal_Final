<?= $this->include('layouts/main_header') ?>
<?= $this->include('layouts/main_sidebar') ?>
<?php include('./app/views/layouts/add_script.php'); ?>
<link href="<?= base_url('public/assets/css/custom_dashboard.css') ?>" rel="stylesheet" type="text/css" />
<style>
    .row-count {
    display: inline-block; /* Make it a block element */
    width: 25px; /* Width for the circle */
    height: 25px; /* Height for the circle */
    line-height: 25px; /* Center the text vertically */
    border-radius: 50%; /* Make it a circle */
    background-color: #97BE5A; /* Background color */
    color: white; /* Text color */
    text-align: center; /* Center the text horizontally */
    font-weight: bold; /* Bold text */
    margin-right: 5px; /* Space between the circle and the text */
}
.notification-bell {
    position: relative; /* Position relative for absolute badge positioning */
    display: inline-block; /* Align with the text */
    margin-left: 10px; /* Space between the title and bell */
}
.notification-bell .badge {
    position: absolute; /* Position the badge relative to the bell */
    top: -5px; /* Adjust vertical position */
    right: -8px; /* Adjust horizontal position */
    padding: 3px 6px; /* Padding for the badge */
    border-radius: 50%; /* Make the badge circular */
    font-size: 12px; /* Font size for the badge */
    background-color: #d9534f; /* Background color for the badge */
    color: white; /* Text color for the badge */
    border: 1px solid white; /* Optional: add a border for better visibility */
}
@keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .notification-bell.animate {
        animation: pulse 1s infinite; /* Add the animation class */
    }


</style>

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <!-- <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard 4</li>
                                        </ol> -->
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        

                        <div class="row">

                        <div class="col-md-4 col-xl-4">
                            <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card card-danger" id="tooltip-container" style="height: 175px">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" 
                                        data-bs-container="#tooltip-container" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" 
                                        title="More Info">
                                        </i>
                                        <h4 class="mt-0 font-16">Service Manual List</h4>
                                        <h2 class="text-primary my-3 text-center">
                                            <i style="color:#059212; font-weight: bolder; font-size: 20px" class="icon-docs"></i>&nbsp;
                                            <span data-plugin="counterup"><?php echo $manual_count; ?></span>
                                        </h2>
                                        <p class="text-muted mb-0">For the month of <b><?php echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                            </a>
                        </div>




                            <div class="col-md-4 col-xl-4">
                         <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card card-primary" id="tooltip-container" style="height: 175px">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                        <h4 class="mt-0 font-16">Resigned Technician</h4>
                                        <h2 class="text-primary my-3 text-center"><i style="color:#DC0083; font-weight: bolder; font-size: 20px" class="icon-user-unfollow"></i>&nbsp;<span data-plugin="counterup">31</span></h2>
                                        <p class="text-muted mb-0">For the month of <b><?php  echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                  <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card" id="tooltip-container">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                        <h4 class="mt-0 font-16">For Training Technician SA/SR</h4>
                                        <h2 class="text-primary my-3 text-center"><i style="color:#FF7F3E; font-weight: bolder; font-size: 20px" class="fas fa-chalkboard-teacher"></i>&nbsp;<span data-plugin="counterup">870</span></h2>
                                        <p class="text-muted mb-0">For the month of <b><?php  echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                  <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card card-danger" id="tooltip-container" style="height: 175px">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                        <h4 class="mt-0 font-16">Service Bulletins</h4>
                                        <h2 class="text-primary my-3 text-center"><i style="color:#059212; font-weight: bolder; font-size: 20px" class="icon-docs"></i>&nbsp;<span data-plugin="counterup"><?php echo $bulletin_count; ?></span></h2>
                                        <p class="text-muted mb-0">For the month of <b><?php  echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                  <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card  card-primary" id="tooltip-container" style="height: 175px">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                        <h4 class="mt-0 font-16">Resigned SA/SR</h4>
                                        <h2 class="text-primary my-3 text-center"><i style="color:#DC0083; font-weight: bolder; font-size: 20px" class="icon-user-unfollow"></i>&nbsp;<span data-plugin="counterup">570</span></h2>
                                        <p class="text-muted mb-0">For the month of <b><?php  echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xl-4">
                            <!-- Wrap the entire card in an anchor tag -->
                            <a href="<?= base_url('Servicebulletins') ?>" class="text-decoration-none">
                                <div class="card" id="tooltip-container">
                                    <div class="card-body">
                                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                        <h4 class="mt-0 font-16">No Trainings</h4>
                                        <h2 class="text-primary my-3 text-center"><i style="color:#FF7F3E; font-weight: bolder; font-size: 20px" class="fas fa-chalkboard-teacher"></i>&nbsp;<span data-plugin="counterup">3,170</span></h2>
                                        <p class="text-muted mb-0">For the month of <b><?php  echo date('F Y'); ?></b>.</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            



                    <div class="col-xl-12 col-lg-12">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                <span class="notification-bell">
                              
                                    <span class="notification-bell <?php echo $query_manual->getNumRows() > 0 ? 'animate' : ''; ?>">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge bg-danger">
                                        <?php echo $query_manual->getNumRows() > 0 ? $query_manual->getNumRows() : 0; ?>
                                    </span>
                                </span>
                                </span>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-3">What's new for Service Manual Lists?</h4>


                                <div class="inbox-widget" data-simplebar style="max-height: 407px;">
                              <?php if ($query_manual->getNumRows() > 0): ?>
                            <ul class="bullet-list">
                                <?php 
                                $rowCount = 1; // Initialize row count
                                foreach ($query_manual->getResult() as $row): ?>
                                    <li class="inbox-item">
                                        <p class="inbox-item-author">
                                            <strong>
                                                <span class="row-count"><?php echo $rowCount++; ?></span> Model Name:
                                            </strong> <?php echo $row->model_name; ?> &nbsp;&nbsp;
                                            <strong>Model Code:</strong> <?php echo $row->model_code; ?>&nbsp;&nbsp;
                                            <strong>Year Published:</strong> <?php echo $row->year_published; ?>
                                        </p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No service manual found for the current month.</p>
                        <?php endif; ?>
                    </div> <!-- end inbox-widget -->

        </div>
    </div> <!-- end card -->
</div> <!-- end col -->



<div class="col-xl-12 col-lg-12">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                <span class="notification-bell">
                              
                                    <span class="notification-bell <?php echo $query_bulletins->getNumRows() > 0 ? 'animate' : ''; ?>">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge bg-danger">
                                        <?php echo $query_bulletins->getNumRows() > 0 ? $query_bulletins->getNumRows() : 0; ?>
                                    </span>
                                </span>
                                </span>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-3">What's new for Service Bulletins?</h4>


                                <div class="inbox-widget" data-simplebar style="max-height: 407px;">
                              <?php if ($query_bulletins->getNumRows() > 0): ?>
                            <ul class="bullet-list">
                                <?php 
                                $rowCount = 1; // Initialize row count
                                foreach ($query_bulletins->getResult() as $row): ?>
                                    <li class="inbox-item">
                                        <p class="inbox-item-author">
                                            <strong>
                                                <span class="row-count"><?php echo $rowCount++; ?></span> Title:
                                            </strong> <?php echo $row->title; ?> &nbsp;&nbsp;
                                            <strong>Reference:</strong> <?php echo $row->reference_number; ?>&nbsp;&nbsp;
                                            <strong>Date Published:</strong> <?php echo $row->date_published; ?>
                                        </p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No service bulletins found for the current month.</p>
                        <?php endif; ?>
                    </div> <!-- end inbox-widget -->

        </div>
    </div> <!-- end card -->
</div> <!-- end col -->

                           

 <?= $this->include('layouts/main_footer') ?>
 <script>
$('.counter').counterUp({
    delay: 10,
    time: 1000
});

</script>