<?php session_start();
?>
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
                    <input type="date" class="form-control" name="start">  
                    <button class="btn btn-danger" type="button"><span>to</span></button> 
                    <input type="date" class="form-control" name="end">
                    <div class="input-group-append">
                      <button class="btn btn-success" name="generate"> <i class="fas fa-print"></i> Generate</button>
                    </div>
                    
                      <button class="btn btn-danger" type="button"><span><i class="fas fa-print"></i>Excel</span></button> 
                      <button class="btn btn-warning" type="button" onclick="window.print()"><span><i class="fas fa-print"></i>Print</span></button> 
                    
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
                    <h4 style="text-align: center;">Report of Tracked Users Per Sex for <br> 
                    <?php 
                    $grandtotal=0;
                    if (
                      isset($_POST['generate']))
                      { 
                        $start=$_POST['start'];
                        $_SESSION['start']=$start;
                        $end=$_POST['end'];
                        $_SESSION['end']=$end;
                        echo date('F d, Y',strtotime($start))." to ". date('F d, Y',strtotime($end));
                      }?></h4><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6" style="text-align: center;">
                    <div id="<?php if (isset($_POST['generate'])){echo "graph";}?>" style="padding-right: 100px"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6">                  
                
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Sex</th>
                        <th>Total</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php include '../dist/includes/dbcon.php';    
                      
                      if (isset($_POST['generate']))
                      {
                        
                      ?>       

                      <tr>
                        <td>1</td>
                        <td>Male</td>
                        <td>
                          <?php 
                            $query=mysqli_query($con,"select *, COUNT(*) as total,date_format(track_date, '%Y-%m-%d') as formatted_date from track natural join user where user_sex='Male' and date_format(track_date, '%Y-%m-%d') BETWEEN '$start' and '$end'")or die(mysqli_error($con));
                              $row=mysqli_fetch_array($query);
                              //$count=mysqli_num_rows($query);
                              
                                echo $row['total'];
                                  $male=$row['total'];  
                                
                             
                          ?>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Female</td>
                        <td>
                          <?php 
                            $query1=mysqli_query($con,"select *, COUNT(*) as total,date_format(track_date, '%Y-%m-%d') as formatted_date from track natural join user where user_sex='Female' and date_format(track_date, '%Y-%m-%d') BETWEEN '$start' and '$end'")or die(mysqli_error($con));
                              $row1=mysqli_fetch_array($query1);
                              //$count1=mysqli_num_rows($query1);
                              
                                echo $row1['total'];
                                  $female=$row1['total'];
                                  $grandtotal=$male+$female;  
                                
                              
                          ?>
                      <?php }?>  
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Grand Total</th>
                        <th></th>
                        <th><?php echo $grandtotal;?></th>
                      </tr>
                      </tfoot>
                    </table>
                  </div><!-- /.col -->
                </div><!-- /.row -->
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
      "responsive": true, "lengthChange": false, "autoWidth": false,"paging": false, "searching": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
   //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
</script>
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
            
            $.getJSON("data_sex.php", function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });
            
            
            
        });   
        </script>
      <script src="../dist/js/highcharts.js"></script>
      <script src="../dist/js/exporting.js"></script>
</body>
</html>
