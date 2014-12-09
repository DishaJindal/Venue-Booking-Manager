<?php

ConnectToDatabase();


$room_Id = $_POST['RoomId'];
list($theDay,$mo,$theYear) = explode('/', $_POST['date']);
$theMonth = GetMonth($mo);
$startDateTime = date('Y-m-d', mktime(00, 00, 00, $theMonth, $theDay, $theYear));
$pendingTimes=array();
$bookedTimes=array();

$query = "SELECT R_Id, Start_Time, End_Time FROM Booking_Requests WHERE Room_Id = ".$room_Id." AND Status='pending' AND Start_Time LIKE '".$startDateTime."%'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
 	array_push($pendingTimes, $row);
 	echo $row{'Start_Time'};
 	echo '|';
 	echo $row{'End_Time'};
 	echo '|';
  	}
echo '*';
$query = "SELECT R_Id, Start_Time, End_Time FROM Booking_Requests WHERE Room_Id = ".$room_Id." AND Status='Accepted' AND Start_Time LIKE '".$startDateTime."%'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
 	array_push($bookedTimes, $row);
 	echo $row{'Start_Time'};
 	echo '|';
 	echo $row{'End_Time'};
 	echo '|';
  	}

//echo $pendingTimes;


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

function GetMonth($mo){
switch($mo){
	case "JAN":$mon=1;
	break;
	case "FEB":$mon=2;
	break;
	case "MAR":$mon=3;
	break;
	case "APR":$mon=4;
	break;
	case "MAY":$mon=5;
	break;
	case "JUN":$mon=6;
	break;
	case "JUL":$mon=7;
	break;
	case "AUG":$mon=8;
	break;
	case "SEP":$mon=9;
	break;
	case "OCT":$mon=10;
	break;
	case "NOV":$mon=11;
	break;
	case "DEC":$mon=12;
	break;
}
return $mon;	
}

?>