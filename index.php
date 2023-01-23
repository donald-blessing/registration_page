<?php

require_once 'register.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet"/>

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-danger">
                                    <?php
                                    echo isset($message) ? $message : null; ?>
                                </div>

                                <h4 class="card-title">Registration</h4>
                                <p class="card-title-desc">Upload your info</p>

                                <form action="#" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <legend>Personal Info</legend>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class=" form-control" value="<?php
                                            echo isset($name) ? $name : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($name_error) ? $name_error : null; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Birth date</label>
                                            <input name="birthdate" type="date" class=" form-control" value="<?php
                                            echo isset($birthdate) ? $birthdate : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($birthdate_error) ? $birthdate_error : null; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Complete Address</label>
                                            <textarea name="complete_address" type="date" class=" form-control"
                                                      required><?php
                                                echo isset($complete_address) ? $complete_address : null; ?></textarea>
                                            <span class="text-danger"><?php
                                                echo isset($complete_address_error) ? $complete_address_error : null; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Upload profile picture</label>
                                            <input type="file" class="filestyle" name="profile_picture"
                                                   accept="image/*">
                                            <span class="text-danger"><?php
                                                echo isset($profile_picture_error) ? $profile_picture_error : null; ?></span>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Credit Card Info</legend>
                                        <div class="form-group">
                                            <label>Card Name</label>
                                            <input name="card_name" type="text" class="form-control" value="<?php
                                            echo isset($card_name) ? $card_name : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($card_name_error) ? $card_name_error : null; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Card Number</label>
                                            <input name="card_number" type="text" minlength="16" maxlength="16"
                                                   class="form-control" value="<?php
                                            echo isset($card_number) ? $card_number : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($card_number_error) ? $card_number_error : null; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Card Month</label>
                                            <input name="card_month" type="text" minlength="2" maxlength="2"
                                                   class="form-control" value="<?php
                                            echo isset($card_month) ? $card_month : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($card_month_error) ? $card_month_error : null; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Card Year</label>
                                            <input name="card_year" type="text" minlength="2" maxlength="2"
                                                   class="form-control" value="<?php
                                            echo isset($card_year) ? $card_year : null; ?>" required>
                                            <span class="text-danger"><?php
                                                echo isset($card_year_error) ? $card_year_error : null; ?></span>
                                        </div>

                                    </fieldset>
                                    <input name="register" value="Register" type="submit" class="btn btn-primary">
                                    <input value="Reset" type="reset" class="btn btn-secondary">
                                </form>
                            </div>
                        </div>

                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->


<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<script src="assets/js/pages/form-advanced.init.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
