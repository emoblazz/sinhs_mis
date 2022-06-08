<?php
include '../plugins/phpqrcode/qrlib.php';
include '../dist/includes/dbcon.php';
$id=$_REQUEST['id'];

$fileName = $id.'.png'; 
$tempDir = "../dist/img";                    // the directory to store the files
$filePath = $tempDir . "/" . $fileName;
QRcode::png($id, $filePath);         // note the second parameter

 mysqli_query($con,"UPDATE user SET qrcode='$filePath' where user_id='$id'")
 or die(mysqli_error()); 
 echo "<script>document.location='user.php'</script>"; 
?>