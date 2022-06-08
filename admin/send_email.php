<?php 
	ini_set( 'display_errors', 1 );
    
    error_reporting( E_ALL );
    
    $from = "leepipez14@gmail.com";
    
    $to = "emoblazz@gmail.com";
    
    $subject = "Reservation Details";
    
    $message = "Dear Name. Below are your reservation details to Lee Pipez Catering<br>
    	Reservation Code: 1111
    	Event Date: Jan302022
    	Event Time: 7:30
    	Venue: Busay
    	Motif: Pink
    	Ocassion: Wedding
    	Total Payable: 5000
    	Package: Package 1
    	
    ";
    
    $headers = "From:" . $from;
    
    mail($to,$subject,$message, $headers);
    
    echo "<script>
		alert('Check Your Email Inbox for the details');		
	</script>";
?>