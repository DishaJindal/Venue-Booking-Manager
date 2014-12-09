<html>
<head>
	<title>STATUS</title>
	<meta name="description" content="website description">
   	<meta name="keywords" content="website keywords, website keywords">
  	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="Style.css">
	<script>
	function gotoCancel(R_Id){

		var params = "R_Id="+R_Id;
		httpRequest=new XMLHttpRequest();
		httpRequest.open("POST","cancel.php",true);
		httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		
		httpRequest.onreadystatechange = function() {
   			if (httpRequest.readyState == 4) {
      			alert("It has been successfully cancelled!"+httpRequest.responseText);
    		}
  		}
		httpRequest.send(params);

	}
	</script>
</head>
<body>

	<div id="main">
	  	<div id="header">
	      <div id="logo">
	        <div id="logo_text">
	           <class="logo_colour", allows you to change the colour of the text >
	          <h1><a href="index.html">Venue Booking<span class="logo_colour"> Manager</span></a></h1>
	          <h2>Venue Booking Made Simple.</h2>
	        </div>
	        <img src="./Images/pec-logo.png" height="80px" width="170px" right="0px" style="float:right"></img>
	      </div>
	      <div id="menubar">
	        <ul id="menu">
	          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
	          <li><a href="Interface.php">Home</a></li>
	          <li><a href="Booking.php">Book Room</a></li>
	          <li><a href="Booking_Status.php">Check Status</a></li>
	          <li class="selected"><a href="Cancellation.php">Cancel Request</a></li>
	          <li><a href="contact_us.php">Contact Us</a></li>
	        </ul>
	      </div>
	    </div>
	</div>



	<div class="site-main">
			<div id="site">
				<div id="all" style="margin:0 auto 10px; width:80%">
					<div id="welcome" style="width:100%; text-align:right; font-weight:bold ;color:black;" >
						<form action="welcome.php">
				 Welcome <?php session_start(); echo $_SESSION['Name'] ?>!! 
					<input type="submit" class="enjoy-css" value="Log Out" style="width:60px;background: rgba(27,122,247,0.9);" />
				</form><hr>
							
						</div>
						<br>
					<div id="cancellation">
					<form action="Cancellation.php">
					<table border=1 cellspacing=12 align="center" style="margin:0 auto; background:white;">
						<tr>
								<th style="background:rgba(20,20,20,0.2);color:black;">Request Id</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">Room No.</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">Status</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">Requesting Entity</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">Purpose</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">Start Time</th>
								<th style="background:rgba(20,20,20,0.2);color:black;">End Time</th>
						</tr>
					
					<?php

					createTable();
					function createTable(){
						ConnectToDatabase();
						session_start();
						$userID = $_SESSION['username'];
						$query="SELECT R_Id,Room_Id, Status,Requesting_Entity,Purpose,Start_Time,End_Time FROM Booking_Requests WHERE Student_Id='".$userID."'";
						$result = mysql_query($query);
					 		while ($row = mysql_fetch_array($result)) {
				 				//echo $row{'Purpose'}.'\n';
				 				$req_id = '"'.$row{'R_Id'}.'"';
				 				if($row{'Status'} == 'cancelled')
				 				echo "<tr><td>".$row{'R_Id'}."</td><th>".$row{'Room_Id'}."</th><th>".$row{'Status'}."</th><th>".$row{'Requesting_Entity'}."</th><th>".$row{'Purpose'}."</th><th>".$row{'Start_Time'}."</th><th>".$row{'End_Time'}."</th></tr>";
				 				else
				 				echo "<tr><td>".$row{'R_Id'}."</td><th>".$row{'Room_Id'}."</th><th>".$row{'Status'}."</th><th>".$row{'Requesting_Entity'}."</th><th>".$row{'Purpose'}."</th><th>".$row{'Start_Time'}."</th><th>".$row{'End_Time'}."</th><td style='border:none;'><input type='submit' class='shiny' value='Cancel' style='background:red' onclick='gotoCancel(".$req_id.")'></td></tr>";

				  			}
					}
							
					?>
					</table>
					</form>
					</div>
				</div>
			</div>
	</div>
	<div id="footer">
    </div>

</body>

</html>


	<?php


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
	
	?>
