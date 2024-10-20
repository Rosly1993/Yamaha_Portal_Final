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
                                    <h4 class="page-title">Activity Logs </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

              
                                  
                                        <div class="row mb-4">
                                        <div class="col-md-2">
                                            <select id="filter-month" class="form-control">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="filter-year" class="form-control"  >
                                        </div>
                                    </div>


                                        <table id="items_table" class="table table-striped dt-responsive nowrap w-100">
                                            <thead class="table_header">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>IP Address</th>
                                                    <th>Username</th>
                                                    <th>Activity</th>
                                                    <th>Details</th>
                                                    <th>Date Recorded</th>
                                               
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


                <div id="data-table-url" data-url="<?= base_url('Activitylogs/getData') ?>"></div>
                <div id="url-base" data-url="<?= site_url('Activitylogs/') ?>"></div>
                <?= $this->include('layouts/main_footer') ?>   
                <script>
                var dataTableUrl = '<?= base_url('Activitylogs/getData') ?>';
                var baseURL = '<?= site_url('Activitylogs/') ?>';
                </script>

                <script src="<?= base_url('public/assets/js/activitylogs.js') ?>"></script>
              
