<?php session_start();
//if(empty($_SESSION['id'])):
//header('Location:../index.php');
//endif;

include('../dist/includes/dbcon.php');

$start=$_SESSION['start'];
$end=$_SESSION['end'];

$query = mysqli_query($con,"select *, COUNT(*) as total,date_format(track_date, '%Y-%m-%d') as formatted_date from track natural join user natural join city where date_format(track_date, '%Y-%m-%d') BETWEEN '$start' and '$end' group by city_id")or die(mysqli_error($con));

$category = array();
$category['name'] = 'Total';

$series1 = array();
//while($r2 = mysqli_fetch_array($query)) {
$series1['name'] = " ";
//}



while($r = mysqli_fetch_array($query)) {
    //$count=$r['total'];
	
    $category['data'][] =$r['city_name'];
    $series1['data'][] = $r['total'];

}

$result = array();
array_push($result,$category);
array_push($result,$series1);
//array_push($result,$series2);




print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?> 
