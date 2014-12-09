<html>
<body style="">
	<?php 
	session_start();
	$req = '"'.$_SESSION['accept_RId'].'"';
	$designation = "'".$_POST['designation']."'";
	echo $req;
	?>
	<div >
		<form name = "permission" ID = "Permission" action = "acceptBookingRequest.php" method = "POST" style="background:rgba(20,20,20,0.1); width:50%; margin:100 auto 0; padding:100px; text-align:center; border:1px solid" >
			<input type = 'hidden' name  = 'designation' id = 'designation' value  = <?php echo $designation; ?>/>
			<input type = "radio" name = "perm" value = "Yes">Yes</input>
			<input type = "radio" name = "perm" value = "No">No<br><br>
			<input type = "submit" value = "Submit">	
		</form>
	</div>
</body>
</html>


