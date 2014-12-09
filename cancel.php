
<?php


ConnectToDatabase();

$R_Id = $_POST['R_Id'];
$query = 'update Booking_Requests set Status = "cancelled" where R_Id = "'.$R_Id.'"';
mysql_query($query);
mysql_query('update Request_Invitation set Status = "cancelled" where R_Id = "'.$R_Id.'"');

$totalEmailIds=array();
$result = mysql_query("SELECT Receiver_Id, Status FROM Request_Invitation where R_Id = '".$R_Id."'");
while ($row = mysql_fetch_array($result)) {
	$email  = mysql_query("select Email_id from Students where Student_Id='".$row{'Receiver_Id'}."'");
	while ($emailId = mysql_fetch_array($email)) {
		array_push($totalEmailIds, $emailId[0]);
	}
}

echo "Send cancellation mails to: ".$totalEmailIds[0].$totalEmailIds[1];	///send them event cancellation mails




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