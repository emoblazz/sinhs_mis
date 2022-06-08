<?php session_start();

include('dist/includes/dbcon.php');
$display=$_POST['display'];
date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d H:i:s");
$today=date("Y-m-d");
//$time = date("H:i");

	$query=mysqli_query($con,"select * from user where user_id='$display'")or die(mysqli_error($con));
		$row=mysqli_fetch_array($query);
           $id=$row['user_id'];
           $first=$row['user_first'];
           $last=$row['user_last'];
           $audio=$row['audio'];
           $counter=mysqli_num_rows($query);

		  	if ($counter == 0) 
			  {	
			  	echo "<audio controls autoplay hidden='true'>
								<source src='dist/audio/error.ogg' type='audio/ogg'>
								<source src='dist/audio/error.mp3' type='audio/mpeg'>
								Your browser does not support the audio element.
							      </audio>";

							    echo "<script>
										setTimeout(function () {
       									window.location.href = 'scan.php'; 
    									}, 1000); 
									</script>";
			 	 				//echo "<script>document.location='attendance.php'</script>";
			  } 
			  else
			  {

	          		if ($first <> "")
	          			{
	          				$query2=mysqli_query($con,"select * from track where user_id='$display' and date_format(track_date, '%Y-%m-%d') LIKE '$today'")or die(mysqli_error($con));
								$counter2=mysqli_num_rows($query2);
								
									if ($counter2>=1){
										echo "<audio controls autoplay hidden='true'>
														<source src='dist/audio/error.ogg' type='audio/ogg'>
														<source src='dist/audio/error.mp3' type='audio/mpeg'>
														Your browser does not support the audio element.
													      </audio>";
									}
									else{
	          				
							           	mysqli_query($con,"INSERT INTO track(user_id,track_date) VALUES('$display','$date')")or die(mysqli_error()); 
							         		
							         		if ($row['audio']=="")
							         		{
								        		echo "<audio controls autoplay hidden='true'>
												<source src='dist/audio/welcome.ogg' type='audio/ogg'>
												<source src='dist/audio/welcome.mp3' type='audio/mpeg'>
												Your browser does not support the audio element.
											    </audio>";
											}
											else
											{
												echo "<audio controls autoplay hidden='true'>
												<source src='$audio' type='audio/mpeg'>
												Your browser does not support the audio element.
											    </audio>";
											}
										}

								echo "<script>
										setTimeout(function () {
		       							window.location.href = 'scan.php'; 
		    							}, 2000); 
									</script>";
						}
					else{
							echo "<script>document.location='register.php?id=$id'</script>";
					}
						//echo "<script type='text/javascript'>alert('Success!');</script>";
						//echo "<script>document.location='attendance.php'</script>";  
			  }
?>
				
	</form>	
				
	</body>
</html>
