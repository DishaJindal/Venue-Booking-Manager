<?php

echo "Your response has been successfully recorded";

$link=mysqli_connect("localhost","root","disha","Rooms");
if(mysqli_connect_errno())
{
   echo "Failed".mysqli_connect_error();
}

$val = $_POST["perm"];
$designation  = $_POST['designation'];
session_start();
$R_ID = $_SESSION['accept_RId'];


$query = "Update Request_Approval set ".$_SESSION['designation']." = '$val' where R_Id = '".$R_ID."'";
$result = mysqli_query($link,$query);


$query = "Select R_Id from Request_Approval where ".$_SESSION['designation']." = 'no' and R_Id = '".$R_ID."'";
//echo $query;
$no = mysqli_query($link,$query); 

$var =0;
while ($row = mysqli_fetch_array($no))
{
   $var = 1;
  // echo $row['R_Id'];
}
//echo $val = mysql_num_rows($no);
//echo $var;
if ($var)
{
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
					        // echo "Room already booked!";
                     }	
                     else
                     {
                           mysqli_query($link,"update Booking_Requests set Status = 'Accepted' where R_Id = '".$R_ID."'"); 
                    //      echo "Room Booked!";
                     }
                     }						  
					    else
              {
                mysqli_query($link,"update Booking_Requests set Status = 'Accepted' where R_Id = '".$R_ID."'"); 
              }
 //////////////query for book room////////////////////
 //mail();
      
   }

?>