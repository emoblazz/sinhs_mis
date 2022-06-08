<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include '../dist/includes/title.php';?> | Generate QRCode</title>
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
            <h1 class="m-0">Print QRCode</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">QRCode</li>
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
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-success">
              <div class="card-header">
                <div class="card-tools">
                  <a class="btn btn-danger" onclick="window.print()"> <i class="fas fa-print"></i></a>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php 
                  include '../dist/includes/dbcon.php';    
                  include '../plugins/phpqrcode/qrlib.php';
                 
                  if (isset($_POST['print']))
                  {
                    $ii=0;
                    $selected=$_POST['selected'];
                    foreach ($selected as $value) {
                        $query=mysqli_query($con,"select * from user where user_id='$value'")or die(mysqli_error($con));
                          $row=mysqli_fetch_array($query);
                          $qr=$row['qrcode']
                    ?>
                          <div class="col-lg-2 col-md-2 col-sm-2" style="text-align: center;border-bottom: 1px solid #000;margin-bottom: 10px">     
                        <img src="<?php echo $qr;?>" style="height: 150px;width: 150px;margin-bottom: 20px" class="border border-primary">
                        <h4 style="text-align: center"><?php echo $value;?></h4><br>
                      </div>
                      <?php
                        $ii++;
                    }

                  }
                  else  
                  {
                      $i=0;   
                      $ids=array();             
                      while ($i<12)
                      {
                        mysqli_query($con,"INSERT INTO user(user_bday) VALUES('0000-00-00')")or die(mysqli_error($con)); 
                        $ids[]=mysqli_insert_id($con);
                        $i++;
                      }

                                $ii=0;
                                foreach ($ids as $value) 
                                {
                                  $value1=sprintf('%06d',$value);
                                  //echo $value1;
                                  $fileName = $value1.'.png'; 
                                  $tempDir = "../dist/img";                    // the directory to store the files
                                  $filePath = $tempDir . "/" . $fileName;
                                  QRcode::png($value1, $filePath);         // note the second parameter

                                  mysqli_query($con,"UPDATE user SET qrcode='$filePath' where user_id='$value1'") or die(mysqli_error($con)); 
                          
                      ?>  
                      <div class="col-lg-2 col-md-2 col-sm-2" style="text-align: center;border-bottom: 1px solid #000;margin-bottom: 10px">     
                        <img src="<?php echo $filePath;?>" style="height: 150px;width: 150px;margin-bottom: 20px" class="border border-primary">
                        <h4 style="text-align: center"><?php echo $value;?></h4><br>
                      </div>
                      <?php
                        $ii++;
                      }
                    }
                ?>    
                </div><!-- /.row -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
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
