<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include '../dist/includes/title.php';?> | Users</title>
  <!-- Google Font: Source Sans Pro -->
  <?php include '../dist/includes/link.php';?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/logo.png" alt="SINHSLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include '../dist/includes/navbar.php';?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../dist/includes/sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-list-ul mr-1"></i>
                  List
                </h3>
                <div class="card-tools">
                  <a class="btn btn-danger" href="qr_list.php"> <i class="fas fa-qrcode"></i> Print QRCode</a>
                  <a class="btn btn-success" href="qr_print.php?action=generate"> <i class="fas fa-qrcode"></i> Generate Blank QRCode</a>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>QR</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php include '../dist/includes/dbcon.php';    
                  
                  $query=mysqli_query($con,"select * from user left join category on user.cat_id=category.cat_id left join city on user.city_id=city.city_id order by user_last,user_first")or die(mysqli_error($con));
                    $i=0;
                    while ($row=mysqli_fetch_array($query)){
                    $id=$row['user_id'];
                    $sex=$row['user_sex'];
                    $i++;      
                  ?>       
                  <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $row['user_last'];?>
                    <td><?php echo $row['user_first'];?>
                    <td><?php echo $row['user_contact'];?>
                    <td><?php echo $row['user_address']//.", ".$row['city_name'];?>
                    <td><a href="<?php echo $row['qrcode'];?>"><img src="<?php echo $row['qrcode'];?>" style="width: 50px;height: 50px"></a>
                    </td>
                    <td>
                      <a class="btn text-success" data-toggle="modal" data-target="#modal-default<?php echo $id;?>"><i class="fas fa-edit"></i></a>
                      <a class="btn text-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id;?>"><i class="fas fa-trash"></i></a>
                      <?php if ($row['qrcode']=="")
                        {
                          echo "
                          <a href='generate_qrcode.php?id=$id' class='btn text-primary' alt='Generate QRcode'><i class='fa fa-qrcode'></i>";
                        }
                      ?>
                    </td>
                    <div class="modal fade" id="modal-default<?php echo $id;?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post" action="functions.php">
                              <div class="modal-header">
                                <h4 class="modal-title">Update Record</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Last Name</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name" name="last" value="<?php echo $row['user_last'];?>">
                                    <input type="hidden" class="form-control" id="inputEmail3" placeholder="" name="id" value="<?php echo $id;?>">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">First Name</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="First Name" name="first" value="<?php echo $row['user_first'];?>">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Birthday</label>
                                  <div class="col-sm-8">
                                    <input type="date" class="form-control" id="inputEmail3" placeholder="Birthday" name="bday" value="<?php echo $row['user_bday'];?>">
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Sex</label>
                                      <div class="col-sm-4">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" id="sex" name="sex" value="Male" <?php if ($sex=="Male") echo "checked";?> required="true">
                                          <label class="form-check-label">Male</label>
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" id="sex" name="sex" value="Female" required="true" <?php if ($sex=="Female") echo "checked";?>>
                                          <label class="form-check-label">Female</label>
                                        </div>
                                      </div>
                                    
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Contact #</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Contact #" name="contact" value="<?php echo $row['user_contact'];?>">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Address</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address 1" name="address" value="<?php echo $row['user_address'];?>">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">City/Municipality</label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="city" placeholder="City/Municipality">
                                          <option value="<?php echo $row['city_id'];?>"><?php echo $row['city_name'];?></option>
                                    <?php

                                      $query2=mysqli_query($con,"select * from city order by city_name")or die(mysqli_error($con));
                                          while($row2=mysqli_fetch_array($query2)){
                                      ?>
                                          <option value="<?php echo $row2['city_id'];?>"><?php echo $row2['city_name'];?></option>
                                    <?php }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Category</label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="category" placeholder="Select Category">
                                          <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                                    <?php

                                      $query2=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error($con));
                                          while($row2=mysqli_fetch_array($query2)){
                                      ?>
                                          <option value="<?php echo $row2['cat_id'];?>"><?php echo $row2['cat_name'];?></option>
                                    <?php }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-4 col-form-label">Audio</label>
                                  <div class="col-sm-8">
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" placeholder="Upload Audio Here" name="audio_new"><input type="hidden" name="audio" value="<?php echo $row['audio'];?>">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="update_user">Save changes</button>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                    <!-- /.modal -->
                      <div class="modal fade" id="modal-delete<?php echo $id;?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post" action="functions.php">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Record</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure you want to delete User with ID No. <?php echo $id;?>?</p>
                                <input type="hidden" class="form-control" id="inputEmail3" placeholder="Category" name="id" value="<?php echo $id;?>">
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="delete_user">Delete</button>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                  <?php }?>  
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>QR</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-3 connectedSortable">

            <!-- Map card -->
            <div class="card card-danger shadow-lg">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Add City/Municipality
                </h3>
              </div>
              <div class="card-body">
                <form method="post" action="functions.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Enter Last Name" name="last" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name" name="first" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Birthday</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter Birthday" name="bday" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Sex</label>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="sex" name="sex" value="Male" checked required="true">
                          <label class="form-check-label">Male</label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="sex" name="sex" value="Female" required="true">
                          <label class="form-check-label">Female</label>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Contact</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number/s" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter City/Municipality" name="address" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City/Municipality</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="city" placeholder="City/Municipality" required>
                        <?php

                          $query2=mysqli_query($con,"select * from city order by city_name")or die(mysqli_error($con));
                              while($row2=mysqli_fetch_array($query2)){
                          ?>
                              <option value="<?php echo $row2['city_id'];?>"><?php echo $row2['city_name'];?></option>
                        <?php }?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="category" placeholder="Select Category" required>
                        <?php

                          $query2=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error($con));
                              while($row2=mysqli_fetch_array($query2)){
                          ?>
                              <option value="<?php echo $row2['cat_id'];?>"><?php echo $row2['cat_name'];?></option>
                        <?php }?>
                        </select>
                </div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success btn-block" name="add_user"><i class="fa fa-save"></i> Save</button>
                  </div>
                </div>
                <!-- /.row -->
              </div>
              </form>
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include '../dist/includes/footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include '../dist/includes/script.php';?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
