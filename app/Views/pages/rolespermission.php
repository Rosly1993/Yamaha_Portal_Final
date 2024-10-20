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
                                    <h4 class="page-title">Roles & Permission's Information</h4>
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
                                           <?php if ($is_add_Roles_permission == 1): ?>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                           <i class="fa fa-plus">&nbsp;&nbsp;</i> Add New Roles & Permission
                                            </button>
                                            <?php endif; ?>
                                        </p>

                                        <table id="items_table" class="table table-striped dt-responsive nowrap w-100">
                                            <thead class="table_header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Roles</th>
                                                    <!-- <th>Region</th>
                                                    <th>Cluster/Province</th> -->
                                                    <th>Created By</th>
                                                    <th>Date Created</th>
                                                    <th>Updated By</th>
                                                    <th>Date Updated</th>
                                                    <th>Status</th>
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


                <div id="data-table-url" data-url="<?= base_url('Rolespermission/getData') ?>"></div>
                <div id="url-base" data-url="<?= site_url('Rolespermission/') ?>"></div>
                <div id="is_edit" data-value="<?php echo $is_edit_Roles_permission; ?>"></div>
                <div id="is_delete" data-value="<?php echo $is_delete_Roles_permission; ?>"></div>
                <?= $this->include('modals/add_rolespermission') ?>
                <?= $this->include('modals/edit_rolespermission') ?>
                <?= $this->include('layouts/main_footer') ?>   
                <script>
                var dataTableUrl = '<?= base_url('Rolespermission/getData') ?>';
                var baseURL = '<?= site_url('Rolespermission/') ?>';
                var is_edit = $('#is_edit').data('value'); // Use .data() to get the value of data attribute
                var is_delete = $('#is_delete').data('value'); // Use .data() to get the value of data attribute
                </script>

                <script src="<?= base_url('public/assets/js/rolespermission.js') ?>"></script>
              
