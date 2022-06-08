<?php session_start();

include('dist/includes/dbcon.php');


$user_unsafe=$_POST['username'];
$pass_unsafe=$_POST['password'];
$type=$_POST['type'];

$username = mysqli_real_escape_string($con,$user_unsafe);
$pass = mysqli_real_escape_string($con,$pass_unsafe);
$pass=md5($pass);

$query=mysqli_query($con,"select * from user where username='$username' and password='$pass' and user_type='$type'")or die(mysqli_error($con));
		$row=mysqli_fetch_array($query);
           
           $counter=mysqli_num_rows($query);
		  	if ($counter == 0) 
			  {	
			 	 echo "<script type='text/javascript'>alert('Invalid Username or Password!');
			  	 document.location='index2.php'</script>";
			  } 
			  elseif ($counter > 0)
			  {
			   $id=$row['user_id'];
	           $user_last=$row['user_last'];
	           $user_first=$row['user_first'];
	           $username=$row['username'];
	           $user_type=$row['user_type'];
				  $_SESSION['id']=$id;
				  //$_SESSION['pic']=$pic;
				  //$_SESSION['name']=$fullname;
				  if ($user_type=="Admin")
				  {
				  	echo "<script type='text/javascript'>document.location='admin/index.php'</script>";
				  }
				  else{
				  	echo "<script type='text/javascript'>document.location='personnel/index.php'</script>";
				  }

				  
			  }
?>

