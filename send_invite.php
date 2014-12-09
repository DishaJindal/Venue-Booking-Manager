

<?php


connectToDatabase();
extractReceiverIds();
sendInvitations();


function connectToDatabase(){
$link=mysqli_connect("localhost","root","disha","Rooms");
if(mysqli_connect_errno())
{
   echo "Failed".mysqli_connect_error();
} 
}

function extractReceiverIds(){

$date = getdate();
$month = $date['mon'];
$year1 = $date['year'];


$email_array = array();
$q_all = mysqli_query($link,"SELECT Email_Id from Students");

if(isset($_POST['chkYear']) && isset($_POST['chkClub']) && isset($_POST['chkSociety']))
{
  foreach ( $_POST['chkYear'] as $year) {
    $year = $year1-$year;
    if($month>=7){
      $year = $year+1;
    }
    foreach ( $_POST['chkClub'] as $Club) {
      foreach ( $_POST['chkSociety'] as $Society) {
        $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Year = '$year'  AND Club = '$Club' AND Society = '$Society'");
        while ($row = mysqli_fetch_array($result)) {
          array_push($email_array,$row);
        } 
      } 
    }
  }
}
else if(  isset($_POST['chkYear']) && isset($_POST['chkClub']))
{ 
  foreach ( $_POST['chkYear'] as $year) {
      $year = $year1-$year;
      if($month>=7){
        $year = $year+1;
      } 
      foreach ( $_POST['chkClub'] as $Club) {
        $query  = "SELECT Email_Id,Student_Id from Students where  Year = $year  AND Club = '$Club'";
        $result = mysqli_query($link,$query);
        while ($row = mysqli_fetch_array($result)) {
          array_push($email_array,$row);
        } 
      } 
    }
}
else if(  isset($_POST['chkYear']) && isset($_POST['chkSociety']))
{   
  foreach ( $_POST['chkYear'] as $year) {
    $year = $year1-$year;
    if($month>=7){
      $year = $year+1;
    }
    foreach ( $_POST['chkSociety'] as $Society) {
      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Year = '$year'  AND Society = '$Society'");
        while ($row = mysqli_fetch_array($result)) {
          array_push($email_array,$row);
        } 
    } 
  }
}
else if(  isset($_POST['chkClub']) && isset($_POST['chkSociety']))
{ 
    foreach ( $_POST['chkClub'] as $Club){
    foreach ( $_POST['chkSociety'] as $Society) {

      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Club = '$Club'  AND Society = '$Society'");

      while ($row = mysqli_fetch_array($result)) {
        array_push($email_array,$row);
        } 
    } 
  }
}
else if(  isset($_POST['chkClub']))
{    
  foreach ( $_POST['chkClub'] as $Club){
      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Club = '$Club'");

      while ($row = mysqli_fetch_array($result)) {
        array_push($email_array,$row);
        } 
    } 
}

else if(  isset($_POST['chkSociety']))
{    foreach ( $_POST['chkSociety'] as $Society){
      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Society = '$Society'");

      while ($row = mysqli_fetch_array($result)) {
        array_push($email_array,$row);
        } 
    } 
}

else if(  isset($_POST['chkClub']))
{    foreach ( $_POST['chkClub'] as $Club){
      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where  Club = '$Club'");

      while ($row = mysqli_fetch_array($result)) {
        array_push($email_array,$row);
        } 
    } 
}

else if(  isset($_POST['chkYear']))
{    
  foreach ( $_POST['chkYear'] as $year){
      $year = $year1-$year;
    if($month>=7){
      $year = $year+1;
    }
      $result = mysqli_query($link,"SELECT Email_Id,Student_Id from Students where Year = '$Year'");

      while ($row = mysqli_fetch_array($result)) {
        array_push($email_array,$row);
        } 
    } 
}

else
{
      while ($row = mysqli_fetch_array($q_all)) {
        array_push($email_array,$row);
}
}

function sendInvitations(){         

  /* Always set content-type when sending HTML email */

/*  mail($to,$subject,$message,$headers);   */

session_start();
$R_ID = $_POST['r_id_holder'];
$res = mysqli_fetch_array(mysqli_query($link,"select * from Booking_Requests where R_Id = '".$R_ID."'"));

$subject = "Booking Request | ".$_POST['reqEntity'];

$headers = "From: dishajindal11@gmail.com" . "\n" . "Reply-To: aryansudhakar09@gmail.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";

//unique boundary
$boundary = uniqid("HTMLDEMO");

//tell e-mail client this e-mail contains//alternate versions
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

//plain text version of message
$body = "--$boundary\r\n" .

//HTML version of message
$body .= "--$boundary\r\n" .
   "Content-Type: text/html; charset=ISO-8859-1\r\n" .
   "Content-Transfer-Encoding: base64\r\n\r\n";

/*
$res['Start_Date']
$res['End_Date']
$res['Purpose']
$res['hj']
$res['Room_Id']

$msg="
<html>
<body>
<form NAME='mailcon' ID='mailcon' ACTION='permission_ccs.php' METHOD='post'>
<input type = 'label' style='display:none' name  = 'request' id = 'request' value = '".$_SESSION['R_Id']."'>  
Room NUmber: '".$_POST['RoomId']."'<br>
<input type = 'submit' value = 'continue'>
</form>
</body>
</html>"

*/

$body .= chunk_split(base64_encode("

<html>
<body>
<form NAME='mailcon' ID='mailcon' METHOD='post'>
<input type ='hidden' name='request' id='request' value = '".$_SESSION['R_Id']."'/> 
Hi,<br><br>You are cordially invited for an event. Below are the details: <br><br>
<b>Event:<b> '".$res['Purpose']."'<br>
<b>Time:<b>'".$res['Start_Date']." - ".$res['End_Date']."'<br>
<b>Venue:<b> '".$res['Room_Id']."'<br>

<input type = 'submit' value = 'Accept' /><br><br>

Thanks,'".
$res['reqEntity']."'<br>
PEC University of Technology

</form>
</body>

</html>



"));
     for($i=0;$i<count($email_array);$i++){
     $arr = $email_array[$i]; 
     $result = "insert into Request_Invitation values('".$_POST['r_id_holder']."','".$arr['Student_Id']."','Pending','".$arr['Email_Id']."')"; 
     mysqli_query($link,$result);
     if (mail($arr['Email_Id'],"Abcd","jhurt9ti9i0yu0",$headers)){
      echo"Email Send Done1 ";
     }
     else
       echo "Mail not sent!";
    }


$ID = array();

if(isset($_POST['email']) && !empty($_POST['email']))
{

$str = $_POST['email'];
$email = array();
$email = explode(',',$str);

$arrlength=count($email);
echo "hfbguhnikjgiji".$email[0];
for($i = 0;$i<$arrlength;$i++)
{
  
  $result = mysqli_query($link, "select Student_Id from Students where Email_Id = '".$email[$i]."'");
  while ($row = mysqli_fetch_array($result)) {
   echo $row['Student_Id'] ;
    array_push($ID,$row);
  }
}

for($x=0;$x<$arrlength;$x++) {
  $arr = $ID[$x];
mysqli_query($link,"insert into Request_Invitation values('".$_POST['r_id_holder']."','".$arr['Student_Id']."','Pending','".$email[$x]."')");
      echo $email[$x];
  if (mail($email[$x],"Abcd","FSA",$headers)){
 echo"Email Sent.";
 }
else
 echo "Mail not sent!";
}

}
}
?>
