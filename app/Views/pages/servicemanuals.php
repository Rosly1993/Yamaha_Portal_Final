<?= $this->include('layouts/main_header') ?>
<?= $this->include('layouts/main_sidebar') ?>

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
                                    <h4 class="page-title">Service Manual's </h4>
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
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                           <i class="fa fa-plus">&nbsp;&nbsp;</i> Add New Service Manual
                                            </button>
                                        </p>

                                        <table id="items_table" class="table table-striped dt-responsive nowrap w-100">
                                            <thead class="table_header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Motor Name</th>
                                                    <th>Motor Code</th>
                                                    <th>Year Published</th>
                                                    <th>Attachment</th>
                                                    <th>Download</th>
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


                <div id="data-table-url" data-url="<?= base_url('Servicemanuals/getData') ?>"></div>
                <div id="url-base" data-url="<?= site_url('Servicemanuals/') ?>"></div>
                <div id="url-base1" data-url="<?= site_url('/') ?>"></div>
                <?= $this->include('modals/add_servicemanuals') ?>
                <?= $this->include('modals/edit_servicemanuals') ?>
                <?= $this->include('layouts/main_footer') ?>   
                <script>
                var dataTableUrl = '<?= base_url('Servicemanuals/getData') ?>';
                var baseURL = '<?= site_url('Servicemanuals/') ?>';
                var base_URL = '<?= site_url('/') ?>';
                </script>

                <script src="<?= base_url('public/assets/js/servicemanuals.js') ?>"></script>
              
                <style>
                .confidential {
                    background-color: red;
                }

                .non-confidential {
                    background-color: green;
                }

                </style>
                <!-- Modal Structure -->
                <div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="max-width: 95%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="color: white; text-align: center" class="modal-title" id="attachmentModalLabel">Service Manual Attachment's Viewing</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <!-- PDF will be displayed in this iframe -->
                                <iframe id="attachmentPreview" src="" style="width: 100%; height: 100vh;" frameborder="0"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
