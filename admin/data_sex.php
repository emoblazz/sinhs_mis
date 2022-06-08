<?php session_start();
//if(empty($_SESSION['id'])):
//header('Location:../index.php');
//endif;
include('../dist/includes/dbcon.php');

$start=$_SESSION['start'];
$end=$_SESSION['end'];
           
$result = mysqli_query($con,"select *, COUNT(*) as total,date_format(track_date, '%Y-%m-%d') as formatted_date from track natural join user where date_format(track_date, '%Y-%m-%d') BETWEEN '$start' and '$end' group by user_sex");

$rows = array();
while($r = mysqli_fetch_array($result)) {
    $row[0] = $r['user_sex'];
    $row[1] = $r['total'];
    array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);

//mysql_close($con);
?>

