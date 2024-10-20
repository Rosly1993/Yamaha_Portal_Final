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
                                        <!-- <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Datatables</li>
                                        </ol> -->
                                    </div>
                                    <h4 class="page-title">Branchlist</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

              
                                        <p class="text-muted font-13 mb-4">
                                           <!-- Button trigger modal -->
                                           <?php if ($is_add_3s_branchlist == 1): ?>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                           <i class="fa fa-plus">&nbsp;&nbsp;</i> Add New Branchlist
                                            </button>
                                            <?php endif; ?>
                                        </p>

                                        <table id="items_table" width="90%" class="table table-striped dt-responsive nowrap w-100">
                                            <thead class="table_header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Head Office</th>
                                                    <th>Dealer Name</th>
                                                    <th>Dealer Code</th>
                                                    <th>Shop Type</th>
                                                    <th>Date Opened</th>
                                                    <th>Area</th>
                                                    <th>Region</th>
                                                    <th>Cluster/Province</th>
                                                    <th>Status</th>
                                                    <th>Created By</th>
                                                    <th>Date Created</th>
                                                    <th>Updated By</th>
                                                    <th>Date Updated</th>                                                   
                                                    <th>Action</th>
                                                   
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
                                                  <!-- Table body content goes here -->
                                            </tbody>
                                        </table>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->                      
                    </div> <!-- container -->
                </div> <!-- content -->


                <div id="data-table-url" data-url="<?= base_url('Branchlist/getData') ?>"></div>
                <div id="url-base" data-url="<?= site_url('Branchlist/') ?>"></div>
                <div id="url-base1" data-url="<?= site_url('Location/') ?>"></div>
                <div id="is_edit" data-value="<?php echo $is_edit_3s_branchlist; ?>"></div>
                <div id="is_delete" data-value="<?php echo $is_delete_3s_branchlist; ?>"></div>

                <?= $this->include('modals/add_branchlist') ?>
                <?= $this->include('modals/edit_branchlist') ?>
                <?= $this->include('layouts/main_footer') ?>   
                <script>
                var dataTableUrl = '<?= base_url('Branchlist/getData') ?>';
                var baseURL = '<?= site_url('Branchlist/') ?>';
                var base_URL = '<?= site_url('Location/') ?>';
                var is_edit = $('#is_edit').data('value'); // Use .data() to get the value of data attribute
                var is_delete = $('#is_delete').data('value'); // Use .data() to get the value of data attribute
                </script>

                <script src="<?= base_url('public/assets/js/branchlist.js') ?>"></script>
              
