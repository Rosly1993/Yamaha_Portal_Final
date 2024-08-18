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
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Datatables</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Datatables</h4>
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
                                           <i class="fa fa-plus">&nbsp;&nbsp;</i> Add New User
                                            </button>
                                        </p>

                                        <table id="items_table" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
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

                <?= $this->include('modals/add_user') ?>
                <?= $this->include('layouts/main_footer') ?>       
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('#addItemForm').on('submit', function(e) {
                        e.preventDefault(); // Prevent default form submission

                        $.ajax({
                            url: $(this).attr('action'),
                            method: 'post',
                            data: $(this).serialize(), // Serialize the form data
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Close the modal and show a success message
                                    $('#exampleModal').modal('hide');
                                    alert('User added successfully');
                                    // Optionally, refresh the table or redirect
                                } else {
                                    // Display validation errors
                                    let errors = response.errors;
                                    for (let key in errors) {
                                        alert(errors[key]);
                                    }
                                }
                            },
                            error: function() {
                                alert('An error occurred. Please try again.');
                            }
                        });
                    });
                });
                </script>