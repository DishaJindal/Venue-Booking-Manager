<?php

	list($theDay,$mo,$theYear) = explode('/', $_POST['bookingDate']);
	$theMonth = GetMonth($mo);
	$startDateTime = date('YmdHis', mktime($theSHour, $theSMinute, 00, $theMonth, $theDay, $theYear)); 
	$endDateTime = date('YmdHis', mktime($theEHour, $theEMinute, 00, $theMonth, $theDay, $theYear)); 


	echo "In process booking";
	ConnectToDatabase();
	echo "after connecting";
	InsertRequestIntoDatabase();
	echo "After Inserting";
	SendMail();
	echo "After Sending";
	destroysessionvar();

function destroysessionvar(){
	unset($_SESSION['R_Id']);
}

function SendMail(){
	$ReqEn = $_POST['reqEntity'];
	$Student_Head;
 	$CCS;
 	$Teacher_Head_Id;
 	$Student_Head_EmailId;
 	$CCS_EmailId;
 	$Teacher_Head_Id_EmailId;
 	
 	$query = "SELECT Student_Head_Id,CCS_Id,Teacher_Head_Id,Security_Id from Authorities where Requesting_Entity ='".$ReqEn."'";

	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
 		//echo "student head id: ".$row{'Student_Head_Id'}." CCS_Id: ".$row{'CCS_Id'}." Teacher_Head_Id: ".$row{'Teacher_Head_Id'}." Security_Id: ".$row{'Security_Id'};
		$Student_Head = $row{'Student_Head_Id'};
		$CCS = $row{'CCS_Id'};
		$Teacher_Head_Id = $row{'Teacher_Head_Id'};
	}

	$query1 = "select Email_Id from Students where Student_Id='".$Student_Head."'";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_array($result1)) {
		echo " StudentHead_Email_id: ".$row1{'Email_Id'};
		$Student_Head_EmailId = $row1{'Email_Id'};
	}

	$query1 = "select Email_Id from Students where Student_Id='".$CCS."'";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_array($result1)) {
		echo " CCS_Email_id: ".$row1{'Email_Id'};
		$CCS_EmailId = $row1{'Email_Id'};
	}

	$query1 = "select Email_Id from Students where Student_Id='".$Teacher_Head_Id."'";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_array($result1)) {
		echo " Teacher_Head_Id: ".$row1{'Email_Id'};
		$Teacher_Head_Id_EmailId = $row1{'Email_Id'};
	}

	sendMailToAuthorities($Student_Head_EmailId,"Club_Head");
	sendMailToAuthorities($CCS_EmailId,"Ccs_Head");
	sendMailToAuthorities($Teacher_Head_Id_EmailId,"Teacher_Head");
}


function sendMailToAuthorities($to ,$designation ){
echo $to;
/*
$_SESSION['R_Id']
$_POST['RoomId']
$_POST['purpose']
$_SESSION['username']
$_POST['reqEntity']
$startDateTime
$endDateTime
*/

//$to = "aryansudhakar09@gmail.com"; //parulgupta93@gmail.com
$subject = "Test HTML E-mail";

$headers = "From: dishajindal11@gmail.com" . "\n" . "Reply-To: aryansudhakar09@gmail.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";

//unique boundary
$boundary = uniqid("HTMLDEMO");

//tell e-mail client this e-mail contains//alternate versions
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

//plain text version of message
$body = "--$boundary\r\n" .
   "Content-Type: text/plain; charset=ISO-8859-1\r\n" .
   "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split(base64_encode("

Hello, Tom!!! 
This is simple text email message.

"));

//HTML version of message
$body .= "--$boundary\r\n" .
   "Content-Type: text/html; charset=ISO-8859-1\r\n" .
   "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split(base64_encode("

<html>
<body>
<form NAME='mailcon' ID='mailcon' ACTION='http://localhost/Capstone/welcome.php' METHOD='post'>
<input type = 'hidden' name  = 'mailFlag' id = 'mailFlag' value ='1'> 
<input type = 'hidden' name  = 'designation' id = 'designation' value ='".$designation."'/>
<input type ='hidden' name='request' id='request' value = '".$_SESSION['R_Id']."'/>	
Hi,<br><br>This is a request to get a room booked. Below are the details. Please accept/reject accordingly..<br><br>
<b>Room Details:<b><br>
Room Number: '".$_POST['RoomId']."'<br>
<b>Requesting Details:<b><br>
Requesting Entity: '".$_POST['reqEntity']."'<br>
Requesting ID: '".$_SESSION['username']."'<br>
Purpose: '".$_POST['purpose']."'<br>
Time: '".$startDateTime.' - '.$endDateTime."'<br><br>

<input type = 'submit' value = 'Accept' /><br><br>

Thanks,'".
$_SESSION['Name']."' ('".$_SESSION['username']."')<br>'".
$_POST['reqEntity']."'<br>
PEC University of Technology

</form>
</body>

</html>



"));

//$message = ob_get_clean();
$mail_sent = mail( $to, $subject, $body, $headers );
echo $mail_sent ? "Mail sent\n" : "Mail failed\n";
}


function InsertRequestIntoDatabase(){
	
	$data = $_POST['status'].$_POST['RoomId'].$_POST['startTime'].$_POST['endTime'].$_POST['reqEntity'].$_POST['purpose'];
	if($_POST['startTime']%2==0){
		$theSHour = $_POST['startTime']/2;
		$theSHour = $theSHour - 1;
		$theSMinute = 30;
	}else{
		$theSHour = $_POST['startTime']/2;
		$theSMinute = 00;
	}

	if(($_POST['endTime']+1)%2==0){
		$theEHour = ($_POST['endTime'])/2;
		$theEMinute = 30;
	}else{
		$theEHour = ($_POST['endTime']+1)/2;
		$theEMinute = 00;
	}


	$currentDatetime = date('Y-m-d H:i:s') ;
	$R_id = uniqid();
	session_start();

	list($theDay,$mo,$theYear) = explode('/', $_POST['bookingDate']);
	$theMonth = GetMonth($mo);
	echo $theSHour." : ".$theSMinute." : 00 , ".$theDay."/".$theMonth."/".$theYear;
	$startDateTime = date('YmdHis', mktime($theSHour, $theSMinute, 00, $theMonth, $theDay, $theYear)); 
	$endDateTime = date('YmdHis', mktime($theEHour, $theEMinute, 00, $theMonth, $theDay, $theYear)); 
	$queryToBookingRequests = 'INSERT INTO Booking_Requests values("'.$R_id.'","'.$_POST['status'].'",'.$_POST['RoomId'].',"'.$startDateTime.'","'.$endDateTime.'","'.$_POST['purpose'].'","'.$_SESSION['username'].'","'.$_POST['reqEntity'].'","'.date('Y-m-d H:i:s').'")';
	mysql_query($queryToBookingRequests);

	$queryToReqApproval = 'INSERT INTO Request_Approval(R_Id) values("'.$R_id.'")';
	mysql_query($queryToReqApproval);


	session_start();
	$_SESSION['R_Id'] = $R_id;

}

function ConnectToDatabase(){

$username = "root";
$password = "disha";
$hostname = "localhost"; 
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
$selected = mysql_select_db("Rooms",$dbhandle) 
  or die("Could not select Rooms");
// echo "Selected Database Rooms<br>";
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