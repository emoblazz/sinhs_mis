<?php 

include('../dist/includes/dbcon.php');

//Add Form
if (isset($_POST['add_form']))
{
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$date = date("Y-m-d H:i:s");

	//$max_file_size = 100000*100; //10mb
	$path = "../dist/uploads/"; // Upload directory
	$count = 0;

	// Loop $_FILES to exeicute all files
	$name=$_FILES['file']['name']; 
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $path.$name))
	//$count++; // Number of successfully uploaded file
	
	mysqli_query($con,"INSERT INTO form(form_title,form_desc,form_date,form_file) VALUES('$title','$desc','$date','$name')")or die(mysqli_error());  
	//echo "<script type='text/javascript'>alert('Successfully added new category!');</script>";
	echo "<script>document.location='forms.php'</script>";   
	
}
//Update Category
if (isset($_POST['update_category']))
{
	$id = $_POST['cat_id'];
	$cat_name = $_POST['cat_name'];

	 mysqli_query($con,"UPDATE category SET cat_name='$cat_name' where cat_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='category.php'</script>";   
}

//Delete Form	
if (isset($_POST['delete_form']))
{
	$id = $_POST['id'];
	
	 mysqli_query($con,"DELETE from form where form_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='forms.php'</script>";   
}

//Add City
if (isset($_POST['add_city']))
{
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
}
//Update City
if (isset($_POST['update_city']))
{
	$id = $_POST['id'];
	$city = $_POST['city'];

	 mysqli_query($con,"UPDATE city SET city_name='$city' where city_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='city.php'</script>";   
}

//Delete City	
if (isset($_POST['delete_city']))
{
	$id = $_POST['id'];
	
	 mysqli_query($con,"DELETE from city where city_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='city.php'</script>";   
}
//Delete User	
if (isset($_POST['delete_user']))
{
	$id = $_POST['id'];
	
	 mysqli_query($con,"DELETE from user where user_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='user.php'</script>";   
}
//Update User
if (isset($_POST['update_user']))
{
	$id = $_POST['id'];
	$last = strtoupper($_POST['last']);
	$first = strtoupper($_POST['first']);
	$bday = $_POST['bday'];
	$contact = $_POST['contact'];
	$address = strtoupper($_POST['address']);
	$city = $_POST['city'];
	$category = $_POST['category'];
	$sex = $_POST['sex'];
	
	if ($_POST['audio_new']<>""){
		$audio = "dist/audio/".$_POST['audio_new'];
	}
	else
	{
		$audio = $_POST['audio'];
	}

	 mysqli_query($con,"UPDATE user SET user_last='$last',user_first='$first',user_bday='$bday',user_contact='$contact',user_address='$address',city_id='$city',cat_id='$category',user_sex='$sex',audio='$audio' where user_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='user.php'</script>";   
}
//Add User
if (isset($_POST['add_user']))
{
	include '../plugins/phpqrcode/qrlib.php';
	include '../dist/includes/dbcon.php';
	$last = strtoupper($_POST['last']);
	$first = strtoupper($_POST['first']);
	$bday = $_POST['bday'];
	$contact = $_POST['contact'];
	$address = strtoupper($_POST['address']);
	$city = $_POST['city'];
	$category = $_POST['category'];
	$sex = $_POST['sex'];
	
	$query=mysqli_query($con,"select * from user where user_first='$first' and user_last='$last' and user_bday='$bday'")or die(mysqli_error($con));
		$counter=mysqli_num_rows($query);
		if ($counter == 0) 
		  {	
			mysqli_query($con,"INSERT INTO user(user_last,user_first,user_bday,user_contact,user_address,city_id,cat_id,user_sex) VALUES('$last','$first','$bday','$contact','$address','$city','$category','$sex')")or die(mysqli_error($con));  

				$id=mysqli_insert_id($con);

				$fileName = $id.'.png'; 
				$tempDir = "../dist/img";                    // the directory to store the files
				$filePath = $tempDir . "/" . $fileName;
				QRcode::png($id, $filePath);         // note the second parameter

				mysqli_query($con,"UPDATE user SET qrcode='$filePath' where user_id='$id'") or die(mysqli_error()); 

			echo "<script type='text/javascript'>alert('Successfully added new user!');</script>";
			}
		else{
			echo "<script type='text/javascript'>alert('Record already exist!');</script>";
		}
			echo "<script>document.location='user.php'</script>"; 
}

//Add Admin
if (isset($_POST['add_admin']))
{
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	mysqli_query($con,"INSERT INTO admin(fullname,contact,username,password,pic) VALUES('$name','$contact','$username','$password','../dist/img/avatar3.png')")or die(mysqli_error($con));  
	echo "<script type='text/javascript'>alert('Successfully added new administrator!');</script>";	
	echo "<script>document.location='admin.php'</script>";   
}
//Update Admin
if (isset($_POST['update_admin']))
{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$username = $_POST['username'];
	$password = md5($_POST['newpassword']);

	if ($_POST['newpassword'] =="")
	{
		mysqli_query($con,"UPDATE admin SET fullname='$name',contact='$contact',username='$username' where admin_id='$id'") or die(mysqli_error($con)); 
	}
	else
	{
	 mysqli_query($con,"UPDATE admin SET fullname='$name',contact='$contact',username='$username',password='$password' where admin_id='$id'") or die(mysqli_error($con)); 
	}
	 echo "<script>document.location='admin.php'</script>";   
}

//Delete Admin	
if (isset($_POST['delete_admin']))
{
	$id = $_POST['id'];
	
	 mysqli_query($con,"DELETE from admin where admin_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='admin.php'</script>";   
}
//Add Settings
if (isset($_POST['add_settings']))
{
	$email = $_POST['email'];
	$time = $_POST['time'];
	
	mysqli_query($con,"INSERT INTO setting(email,`time`) VALUES('$email','$time')")or die(mysqli_error($con));  
	echo "<script type='text/javascript'>alert('Successfully added new settings!');</script>";	
	echo "<script>document.location='settings.php'</script>";   
}
//Delete Settings	
if (isset($_POST['delete_setting']))
{
	$id = $_POST['id'];
	
	 mysqli_query($con,"DELETE from setting where setting_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='settings.php'</script>";   
}
//Update Settings
if (isset($_POST['update_setting']))
{
	$id = $_POST['id'];
	$email = $_POST['email'];
	$time = $_POST['time'];

	 mysqli_query($con,"UPDATE setting SET email='$email',`time`='$time' where setting_id='$id'") or die(mysqli_error()); 
	 echo "<script>document.location='settings.php'</script>";   
}
?>
