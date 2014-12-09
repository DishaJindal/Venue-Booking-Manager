<html>
<head><title>ROOM ALLOCATION</title></head>
<body>
	Congratulations!! you are registered Succesfully..
	<?php

	$sid=$_POST['SID'];
	$password=$_POST['password'];
	$name=$_POST['fname']." ".$_POST['lname'];
	$branch=$_POST['branch'];
	$year=$_POST['year'];
	$club=$_POST['club'];
	$society=$_POST['society'];
	$emailId=$_POST['emailId'];
	//	echo $_POST['SID']."  ".$_POST['password']."  ".$_POST['fname']."  ".$_POST['lname']."  ".$_POST['branch']."  ".$year."  ".$_POST['club']."  ".$_POST['society']."  ".$_POST['emailId']."  "."end";
	ConnectToDatabase();

	$query = 'INSERT INTO Students values("'.$sid.'","'.$password.'","'.$name.'","'.$branch.'",'.$year.',"'.$club.'","'.$society.'","'.$emailId.'")';
	mysql_query($query);
	//echo $query."  result: ".mysql_query($query);

	function ConnectToDatabase(){
	$username = "root";
	$password = "disha";
	$hostname = "localhost"; 
	$dbhandle = mysql_connect($hostname, $username, $password) 
  	or die("Unable to connect to MySQL");
	//echo "Connected to MySQL<br>";
	$selected = mysql_select_db("Rooms",$dbhandle) 
  	or die("Could not select Rooms");
 	//echo "Selected Database Rooms<br>";	
	}
	
	?>
</body>
</html>