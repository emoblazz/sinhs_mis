<?php 
 
include('dist/includes/dbcon.php');
	$id = $_POST['id'];
	$last = $_POST['last'];
	$first = $_POST['first'];
	$bday = $_POST['bday'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$category = $_POST['category'];
	$date=date("Y-m-d");

	//$bday=date("Y-m-d",strtotime($bday1));
	
	$query=mysqli_query($con,"select * from user where user_last='$last' and user_first='$first' and user_bday='$bday'")or die(mysqli_error($con));

			$count=mysqli_num_rows($query);
			if ($count>0)
				{
					echo "<script type='text/javascript'>alert('You are already registered!');</script>";
					//echo "<script>window.history.back(); </script>";
				}
			else
			{
					 mysqli_query($con,"UPDATE user SET user_first='$first',user_last='$last',user_contact='$contact',user_address='$address',city_id='$city',cat_id='$category',user_bday='$bday' where user_id='$id'")
 						or die(mysqli_error()); 
				

						

						  echo "<script type='text/javascript'>alert('You have successfully registered! Please  Scan QR Code again!');</script>";
						  
			}
			echo "<script>document.location='scan.php'</script>";  	
?>
