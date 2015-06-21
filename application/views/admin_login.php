<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <!-- Bootstrap -->

    <link href="http://<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/plugins/morris.css" rel="stylesheet" type="text/css">
    <link href="http://<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container ">

      <div class="row row-centered">
        <h1>Control Panel</h1>
          <div class="col-md-4 col-centered">

                      <?php $attributes = array("class" => "form-horizontal", "name" => "contactform");
                      echo form_open("http://" . base_url() . "Admin/login", $attributes);?>
            


                      <div class="form-group" >
                          <label for="adminName">Login Name</label>
                          <input type="text" class="form-control" id="adminName" placeholder="Enter login name" name="adminName" value='<?php echo set_value('adminName'); ?>'>
                          <span class="text-danger"><?php echo form_error('adminName'); ?></span>
                      </div>
                       <div class="form-group" >
                          <label for="adminPassword">Password</label>
                          <input type="password" class="form-control" id="adminPassword" placeholder="Enter password" name="adminPassword" value=''>
                          <span class="text-danger"><?php echo form_error('adminPassword'); ?></span>
                      </div>


                      <input class="btn btn-lg" type="submit" value="Sign in" name="loginAdmin">
            <?php echo form_close(); ?>
          </div>
    </div>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>