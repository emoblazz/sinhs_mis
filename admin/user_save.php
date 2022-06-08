<?php 

include('../dist/includes/dbcon.php');

	$city = $_POST['city'];
	
	$query=mysqli_query($con,"select * from city where city_name='$city'")or die(mysqli_error($con));
		$counter=mysqli_num_rows($query);
		if ($counter == 0) 
		  {	
			mysqli_query($con,"INSERT INTO city(city_name) VALUES('$city')")or die(mysqli_error());  
			echo "<script type='text/javascript'>alert('Successfully added new city/municipality!');</script>";
			}
		else{
			echo "<script type='text/javascript'>alert('Record already exist!');</script>";
		}
			echo "<script>document.location='city.php'</script>";   
	
?>