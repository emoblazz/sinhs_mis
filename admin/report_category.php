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
      #graph{
        margin-right:50px;
      }
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
                    <h4 style="text-align: center;">Report of Tracked Users Per Category for <br> <?php if (isset($_POST['generate']))
                      { 
                        $start=$_POST['start'];
                        $_SESSION['start']=$start;
                        $end=$_POST['end'];
                        $_SESSION['end']=$end;
                        echo date('F d, Y',strtotime($start))." to ". date('F d, Y',strtotime($end));
                      }?></h4>
                  </div>
                </div>
                <div class="row" style="text-align: center;">
                  <div class="col-lg-7 col-md-7 col-sm-12" style="text-align: center;">
                    <div id="<?php if (isset($_POST['generate'])){echo "graph";}?>" style=""></div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-12">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Total</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php include '../dist/includes/dbcon.php';    
                      $grandtotal=0;
                      if (isset($_POST['generate']))
                      {
                      
                      $query=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error($con));
                        $i=1;
                        while ($row=mysqli_fetch_array($query)){
                        $id=$row['cat_id'];
                      ?>       

                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['cat_name'];?>
                        <td>
                          <?php 
                            $query1=mysqli_query($con,"select *, COUNT(*) as total,date_format(track_date, '%Y-%m-%d') as formatted_date from track natural join user where user.cat_id='$id' and date_format(track_date, '%Y-%m-%d') BETWEEN '$start' and '$end' group by cat_id;")or die(mysqli_error($con));
                              $row1=mysqli_fetch_array($query1);
                              $count=mysqli_num_rows($query1);
                              if ($count>0)
                                {echo $row1['total'];
                                  $grandtotal=$grandtotal+$row1['total'];  
                                }
                              else
                                {echo "0";}
                          ?>
                      <?php $i++;}}?>  
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
                  </div>
                </div>
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
                  type: 'column',
                  marginRight: 20,
                  marginBottom: 25
              },
              plotOptions: {
                  series:{
                    colorByPoint: true
                  }
              },
              title: {
                  text: '',
                  x: -20 //center
              },
              subtitle: {
                  text: '',
                  x: -10
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  
                  title: {
                      text: 'No.'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                  formatter: function() {
                          return '<b>'+ this.series.name +'</b><br/>'+  Highcharts.numberFormat(this.y, 0)
                          this.x +': '+ this.y
                          
                  ;
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'right',
                  x: 0,
                  y: 100,
                  borderWidth: 0
              },
              series: []
          }
          
          $.getJSON("data_category.php", function(json) {
            options.xAxis.categories = json[0]['data'];
            options.series[0] = json[1];
            //options.series[1] = json[2];
            
            
            
            chart = new Highcharts.Chart(options);
          });
      });
    </script>
    <script src="../dist/js/highcharts.js"></script>
    <script src="../dist/js/exporting.js"></script>
</body>
</html>
