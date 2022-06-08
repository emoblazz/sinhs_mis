
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include 'dist/includes/title.php';?> | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page" style="height:85vh">
<div class="register-box">
  

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg"><b>Register a new user</b></p>

      <form action="register_save.php" method="post">
        <?php //$id=$_REQUEST['id'];?>
        <input class="form-control placeholder-no-fix" type="hidden" name="id" value="<?php echo $id;?>" required />
        <div class="input-group mb-3">
          <input type="file" class="form-control" placeholder="First Name" name="first">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-picture"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="First Name" name="first">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Last Name" name="last">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="date" class="form-control" placeholder="Birthday" name="bday">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Contact #" name="contact">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Address" name="address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-pin"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="city" placeholder="City/Municipality" required>
                        <?php

                          include('dist/includes/dbcon.php');
                          $query2=mysqli_query($con,"select * from city order by city_name")or die(mysqli_error($con));
                              while($row2=mysqli_fetch_array($query2)){
                          ?>
                              <option value="<?php echo $row2['city_id'];?>"><?php echo $row2['city_name'];?></option>
                        <?php }?>
                        </select>
          
        </div>
        <div class="input-group mb-3">
          <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="category" placeholder="Category" required>
                        <?php

                          include('dist/includes/dbcon.php');
                          $query2=mysqli_query($con,"select * from category")or die(mysqli_error($con));
                              while($row2=mysqli_fetch_array($query2)){
                          ?>
                              <option value="<?php echo $row2['cat_id'];?>"><?php echo $row2['cat_name'];?></option>
                        <?php }?>
                        </select>
          
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        
        <a href="index.php" class="btn btn-primary">
          <i class="fa fa-home mr-2"></i>
        </a>
        <a href="scan.php" class="btn btn-danger">
          <i class="fa fa-qrcode mr-2"></i>
        </a>
      </div>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
