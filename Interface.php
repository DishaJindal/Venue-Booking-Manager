<html>
<head>
	<title>ROOM ALLOCATION</title>
	<meta name="description" content="website description">
	<meta name="keywords" content="website keywords, website keywords">
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="Welcome_Style.css">
	<link rel="stylesheet" type="text/css" href="Style.css">
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
			  <li class="selected"><a href="Interface.php">Home</a></li>
			  <li><a href="Booking.php">Book Room</a></li>
			  <li><a href="Booking_Status.php">Check Status</a></li>
			  <li><a href="Cancellation.php">Cancel Request</a></li>
			  <li><a href="contact_us.php">Contact Us</a></li>
			</ul>
		  </div>
		</div>
	</div>

	<div class="site-main" >
			<div id="all" style="position:relative; margin:0 auto 0; width:80%; height:100%">
				<div id="welcome" style="width:100%; text-align:right; font-weight:bold ;color:black;" >
					<form action="welcome.php">
					Welcome <?php session_start(); echo $_SESSION['Name'] ?>!! 
					<input type="submit" class="enjoy-css" value="Log Out" style="width:60px;background: rgba(27,122,247,0.9);" />
					</form><hr>
					<br>
				</div>
					 <div style="width:100%; text-align:left ; background:white; border:1px solid">
						<div style="padding:10px"> 
								<h1> Welcome to the Venue Booking Manager Dashboard
								<br>
								<br>
								Please click the tabs above to get started.
								</h1>
						</div>
					</div>
			</div>
	</div>
	<div id="footer">
	</div>
</body>
</html>


<?php

function checkUser(){
	ConnectToDatabase();
	$query = "SELECT Name from Students where Student_Id ='".$_POST['username']."' AND password='".$_POST['password']."'";
	//echo $query;
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		echo $row{'Name'};
		$name = $row{'Name'};
	}
	echo "Res: ".$row{'Name'}."Cond: ".strlen($name);
	return $name;
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
 //echo "Selected Database Rooms<br>";	
}

?>