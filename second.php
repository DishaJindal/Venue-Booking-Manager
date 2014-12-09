<?php
$username = "root";
$password = "disha";
$hostname = "localhost"; 


$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

$selected = mysql_select_db("Rooms",$dbhandle) 
  or die("Could not select Rooms");
 echo "Selected Database Rooms<br>";

 $askedProjector=$_POST['rdProjector'];

 foreach ( $_POST['chkDept'] as $dept) {
 $Quo="'";
 foreach ( $_POST['chkCapacity'] as $askedCapacity) {

 $result = mysql_query("SELECT R_Id, Department,Capacity,Projector FROM Rooms WHERE Department=".$Quo.$dept.$Quo.
 	"AND Projector=".$Quo.$askedProjector.$Quo.
 	"AND Capacity BETWEEN ".$askedCapacity);


	while ($row = mysql_fetch_array($result)) {
  	echo "<br>"."R_ID: ".$row{'R_Id'}."   Department: ".$row{'Department'}."   Projector: ".$row{'Projector'};
	}}
}
?>