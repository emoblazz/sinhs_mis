<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include '../dist/includes/title.php';?> | Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <?php include '../dist/includes/link.php';?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/logo.png" alt="SINHSLogo" height="60" width="60">
  </div>-->

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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php include '../dist/includes/dbcon.php';    
              $date=date("Y-m-d");    
              $i=0;
              $total=0;
              $grand=0;
              $color=array('info','success','warning','danger','info','success','warning','danger');   
              $query=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error($con));
            ?>    
              <!-- Map card -->
            <div class="col-md-8">
              <div class="card bg-gradient-success">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Tracked Users Per Gender
                  </h3>
                </div>
                <div class="card-body">
                  <div id="graph" style="height: 350px; width: 100%;"></div>
                </div>
               
              </div>
            </div>
            <!-- /.card -->
            <div class="col-md-4">
              <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="../dist/img/logo.png" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo date('F d, Y',strtotime($date));?></h3>
                <h5 class="widget-user-desc">Date Today</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                <?php 
                  while ($row=mysqli_fetch_array($query)){
                    $id=$row['cat_id'];
                    //$total=$row['total'];

                    $query1=mysqli_query($con,"select *,count(*) as total from user natural join track where track_date LIKE '$date%' and cat_id='$id'")or die(mysqli_error($con));
                      $row1=mysqli_fetch_array($query1);
                        
                        $total=$row1['total'];
                        $grand=$grand+$total;
                ?>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <?php echo $row['cat_name'];?> <span class="float-right badge bg-<?php echo $color[$i];?>"><?php echo $total;?></span>
                    </a>
                  </li>
                  <?php $i++;}?>
                  <li class="nav-item">
                    <h4><a href="#" class="nav-link">
                      TOTAL <span class="float-right badge bg-primary"><?php echo $grand;?></span>
                    </a></h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
            <!--end of widget-->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Recent 
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Category</th>
                    <th>Track Date/Time</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php include '../dist/includes/dbcon.php';    
                  
                  $query=mysqli_query($con,"select * from track natural join user natural join category natural join city where track_date LIKE '$date%' order by track_id desc LIMIT 0,10")or die(mysqli_error($con));
                    $i=1;
                    while ($row=mysqli_fetch_array($query)){
                    $id=$row['user_id'];
                  ?>       
                  <tr>
                    <td><?php echo $row['track_id'];?></td>
                    <td><?php echo strtoupper($row['user_last']);?>
                    <td><?php echo strtoupper($row['user_first']);?>
                    <td><?php echo strtoupper($row['cat_name']);?>
                    <td><?php echo $row['track_date'];?>
                    
                  <?php $i++; }?>  
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
</body>
<script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'graph',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    spacingBottom: 50,
                },
                title: {
                    text: '',
                    style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '26px' }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '14px' },
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Employability Rate',
                    data: []
                }]
            }
            
            $.getJSON("data_sex_dashboard.php", function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });
            
            
            
        });   
        </script>
      <script src="../dist/js/highcharts.js"></script>
      <script src="../dist/js/exporting.js"></script>
</html>
