<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include '../dist/includes/title.php';?> | Daily Report</title>
  <!-- Google Font: Source Sans Pro -->
  <?php include '../dist/includes/link.php';?>
  <style type="text/css">
    @media print {
      .card-tools, .card-title{
        display: none;
      }
    }
  </style>
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
            <h1 class="m-0">Report of Tracked Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Tracked Users</li>
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
                <h3 class="card-title">
                  <i class="fa fa-list-ul mr-1"></i>
                  Tracked Lists
                </h3>
                <div class="card-tools">
                  <form method="post" action="">
                  <div class="input-group mb-3">
                    <input type="date" class="form-control" name="date">
                    <div class="input-group-append">
                      <button class="btn btn-success" name="generate"> <i class="fas fa-print"></i> Generate</button>
                    </div>
                    
                      <button class="btn btn-warning" type="button" onclick="window.print()"><span><i class="fas fa-print"></i>Print</span></button>
                      <span id="print"></span>
                       
                    
                </div>
                </form>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2" style="text-align: right;">
                    <img src="../dist/img/logo.png" style="height: 100px" style="float: right">
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <h6 style="text-align: center;">Republic of the Philippines</h6>
                    <h6 style="text-align: center;">Department of Education</h6>
                    <h6 style="text-align: center;">Division of Negros Occidental</h6>
                    <h5 style="text-align: center;">SAN ISIDRO NATIONAL HIGH SCHOOL</h5>
                    <h6 style="text-align: center;">San Isidro, Pontevedra, Negros Occidental</h6><br>
                    <h4 style="text-align: center;">Report of Tracked Users for <?php if (isset($_POST['generate']))
                      { echo date("F d, Y",strtotime($_POST['date']));}?></h4>
                  </div>
                </div>
                
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Track Date/Time</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php include '../dist/includes/dbcon.php';    
                  
                  if (isset($_POST['generate']))
                  {
                  $date=$_POST['date'];
                  $query=mysqli_query($con,"select * from track natural join user natural join category natural join city where track_date LIKE '$date%'  order by user_last,user_first")or die(mysqli_error($con));
                    $i=1;
                    while ($row=mysqli_fetch_array($query)){
                    $id=$row['user_id'];
                  ?>       
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['user_last'];?>
                    <td><?php echo $row['user_first'];?>
                    <td><?php echo $row['user_bday'];?>
                    <td><?php echo $row['user_sex'];?>
                    <td><?php echo $row['user_contact'];?>
                    <td><?php echo $row['user_address'].", ".$row['city_name'];?>
                    <td><?php echo $row['cat_name'];?>
                    <td><?php echo $row['track_date'];?>
                    
                  <?php $i++;}}?>  
                  </tr>
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
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
      "responsive": true, "lengthChange": false, "autoWidth": false,"paging": false, "searching": false,buttons:['excelHtml5']
    }).buttons().container().appendTo('#print');
    $('#example2').DataTable({
      "paging": false,
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
