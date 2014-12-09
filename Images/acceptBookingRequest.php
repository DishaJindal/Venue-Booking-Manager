<?php

$link=mysqli_connect("localhost","root","disha","Rooms");
if(mysqli_connect_errno())
{
   echo "Failed".mysqli_connect_error();
}

echo "asdfgfdsdfdgfds";
$val = $_POST["perm"];
$designation  = $_SESSION['designation'];
session_start();
$R_ID = $_SESSION['accept_RId'];


$query = "Update Request_Approval set ".$_SESSION['designation']." = '$val' where R_Id = '".$R_ID."'";
$result = mysqli_query($link,$query);


$query = "Select R_Id from Request_Approval where ".$_SESSION['designation']." = 'no' and R_Id = '".$R_ID."'";
echo $query;
$no = mysqli_query($link,$query); 

$var =0;
while ($row = mysqli_fetch_array($no))
{
   $var = 1;
   echo $row['R_Id'];
}
//echo $val = mysql_num_rows($no);
echo $var2;
$no1 ;
if ($var2)
{
   $no1 = 'You request has been cancelled';
   mysqli_query($link,"update Booking_Requests set Status = 'cancelled' where R_Id = '".$R_ID."'"); 
} 
  
else
{
   $var = 0;
   $yes = mysqli_query($link,"Select * from Request_Approval where Ccs_Head ='yes' and Club_Head = 'yes' and Teacher_Head = 'yes' and R_Id = '".$R_ID."'");
   //echo $query."  ".$result;
   while ($row = mysqli_fetch_array($yes))
   {
     $var = 1;
   }
   if($var)
   {
         $var1 = 0;
         $res1 = mysqli_query($link,"SELECT S.* 
                        FROM booking_requests AS T, booking_requests AS S
                        WHERE T.R_id <> S.R_id
                        AND T.Start_Time = S.Start_Time
						AND T.Room_Id = S.Room_Id
						AND T.Status = 'Booked'
                        AND T.R_id = '".$R_ID."'");
					 while ($row = mysqli_fetch_array($res1))
                     {
                       $var1 = 1;
                     }
					 
					 if($var1)
					 {
					   mysqli_query($link,"update Booking_Requests set Status = 'Already Booked' where R_id = '".$R_ID."'");
             $no1 = 'The room is already booked for some other event. We recommend you to book some other room. You will be notified if in case the room becomes available.';
					         echo "Room already booked!";
                     }	
                     else
                     {
                           mysqli_query($link,"update Booking_Requests set Status = 'Accepted' where R_Id = '".$R_ID."'"); 
                           $no1 = "You request has been accepted. The requested room is now Booked";
                          echo "Room Booked!";
                     }
                     }						  
					    else
              {
                $no1 = "You request has been accepted. The requested room is now Booked";
                mysqli_query($link,"update Booking_Requests set Status = 'Accepted' where R_Id = '".$R_ID."'"); 
              }
 //////////////query for book room////////////////////

$stu_emailId;
$room_no;
$purpose;
$reqEnt;
$stu_id = mysqli_query($link,"select * from Booking_Requests where R_Id = '".$R_ID."'");
while ($row = mysqli_fetch_array($stu_id))
   {
    $room_no = $row['Room_Id'];
    $purpose = $row['Purpose'];
    $reqEnt = $row['Requesting_Entity'];

    mysqli_query($link,"select Email_Id from Students where Student_Id='".$row['Student_Id']."'");
    while ($row = mysqli_fetch_array($stu_id))
   {
     $stu_emailId = $row['Email_Id'];
   }
}

$query1 = ;
sendMail($no1 , $stu_emailId,$room_no,$purpose,$reqEnt);
}


function sendMail($no1, $to, $room_no, $purpose, $reqEnt){
//echo $to;
/*
$_SESSION['R_Id']
$_POST['RoomId']
$_POST['purpose']
$_SESSION['username']
$_POST['reqEntity']
$startDateTime
$endDateTime
*/
//$to = //"aryansudhakar09@gmail.com"; //parulgupta93@gmail.com
$subject = "Test HTML E-mail";
$headers = "From: dishajindal11@gmail.com" . "\n" . "Reply-To: aryansudhakar09@gmail.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$boundary = uniqid("HTMLDEMO");
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
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
Hi,<br><br>".$no1."<br><br>
Room Number: '".$room_no."'<br>
Requesting Entity: '".$reqEnt."'<br>
Purpose: '".,$purpose."'<br>
Time: '".$startDateTime.' - '.$endDateTime."'<br><br>


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


?>