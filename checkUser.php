<html>
<body>
<form method="POST">
	<?php
	session_start();
	$_SESSION['username']=$_POST['username'];
	$_SESSION['accept_RId'] = $_POST['request'];
	$_SESSION['designation'] = $_POST['designation'];

	ConnectToDatabase();
	$query = "SELECT Name from Students where Student_Id ='".$_POST['username']."' AND Password='".$_POST['password']."'";
	$result = mysql_query($query);
	$name;

	while ($row = mysql_fetch_array($result)) {
		$name = $row{'Name'};
	}

	if(strlen($name)>0){
		$_SESSION['Name']=$name;
	}
	else{
	$query = "SELECT Name from Staff where Staff_Id ='".$_POST['username']."' AND Password='".$_POST['password']."'";
	$result = mysql_query($query);

	while ($row = mysql_fetch_array($result)) {
		$name = $row{'Name'};
		$_SESSION['Name']=$name;
	}
	}



	
	if((strlen($name)>0)&&($_POST['mailFlag']=='1')){
		header("location:PermissionForm.php");	
	}else if(strlen($name)>0){
		header("location:Interface.php");	
  	}else{
		header("location:welcome.php");
  	}

function ConnectToDatabase(){
$username = "root";
$password = "disha";
$hostname = "localhost"; 
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
$selected = mysql_select_db("Rooms",$dbhandle) 
  or die("Could not select Rooms");
 echo "Selected Database Rooms<br>";	
}

?>
</form>
</body>
</html>