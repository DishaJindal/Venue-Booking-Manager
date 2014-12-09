<html>
<head>
	<title>BOOKING STATUS</title>
	<meta name="description" content="website description">
   	<meta name="keywords" content="website keywords, website keywords">
  	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" type="text/css" href="style/style.css">
	<!--link rel="stylesheet" type="text/css" href="Welcome_Style.css"-->
	<link rel="stylesheet" type="text/css" href="Style.css">
	
	<script>
	function gotoInvitation(R_Id){
		console.log("heer"+R_Id);
		document.getElementById("booking_status").style.display="none";
		document.getElementById("invitation").style.display="";
	}
	function validateForm(form) {
 
/* var inputs = document.getElementById("year");
  alert("sdfsdfsdfsdf"+inputs.length);
      for(var i = 0; i < inputs.length; i++) {
          /* if(inputs[i].type == "checkbox" && inputs[i].checked) 
                return true;
		alert(inputs[i]);
        }
      //  alert('You must select at least 1');
	
	*/
	
	var x = document.forms["Invitation"]["email"].value;
	alert("ghjghj   "+x);
	if(x.length!=0)
    {var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
	}
	
	
	
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
	          <li class="selected"><a href="Booking_Status.php">Check Status</a></li>
	          <li><a href="Cancellation.php">Cancel Request</a></li>
	          <li><a href="contact_us.php">Contact Us</a></li>
	        </ul>
	      </div>
	    </div>
	</div>




	<div class="site-main">
		<div id="all" style="margin:0 auto 0px; width:80%">	
			<div id="welcome" style="width:100%; text-align:right; font-weight:bold ;color:black;" >
				 <form action="welcome.php">
				 Welcome <?php session_start(); echo $_SESSION['Name'] ?>!! 
					<input type="submit" class="enjoy-css" value="Log Out" style="width:60px;background: rgba(27,122,247,0.9);" />
				</form><hr>
					
				</div>
				<br>
			<div id="booking_status" style="display:">
				<table border=1 cellspacing=12 align="center" style="margin:0 auto; background:white;" >
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
					ConnectToDatabase();
					session_start();
					$userID = $_SESSION['username'];
					$query="SELECT R_Id,Room_Id, Status,Requesting_Entity,Purpose,Start_Time,End_Time FROM Booking_Requests WHERE Student_Id='".$userID."'";
					$result = mysql_query($query);
				 		while ($row = mysql_fetch_array($result)) {
			 				$req_id = '"'.$row{'R_Id'}.'"';
			 				if($row{'Status'} == 'cancelled')
				 			echo "<tr><td>".$row{'R_Id'}."</td><th>".$row{'Room_Id'}."</th><th>".$row{'Status'}."</th><th>".$row{'Requesting_Entity'}."</th><th>".$row{'Purpose'}."</th><th>".$row{'Start_Time'}."</th><th>".$row{'End_Time'}."</th></tr>";
				 			else	
			 				echo "<tr><td>".$row{'R_Id'}."</td><th>".$row{'Room_Id'}."</th><th>".$row{'Status'}."</th><th>".$row{'Requesting_Entity'}."</th><th>".$row{'Purpose'}."</th><th>".$row{'Start_Time'}."</th><th>".$row{'End_Time'}."</th><td style='border:none;'> <input type='Button' style='background:green;' class='shiny' value='Invite' onclick='gotoInvitation(".$req_id.")'/></td></tr>";
			  			}	


				?>
				</table>
			</div>

			<div id="invitation"  style="display:none; width:80%; margin:0 auto 0" >
	
				<form name = 'Invitation' ID = 'Invitation'  action = 'send_invite.php' Method = 'POST' onSubmit = "return validateForm(this.form);" style="padding:10px; text-align:center; color:black ;border:1px solid; background:white">
				
			       
				<h3 style="text-align:center; font-weight:bold;">Everybody</h3>
			    <input type = "checkbox" name="all" id="checkbox-2-0" class="regular-checkbox" VALUE="all" /><label for="checkbox-2-0">ALL</label>
			    <br><br><hr>
			    	 <h3 style="text-align:center; font-weight:bold;">Years</h3>
		        <INPUT TYPE="checkbox" NAME="chkYear[]" id="checkbox-2-1" class="regular-checkbox" VALUE="1" /><label for="checkbox-2-1">1</label>
		        <INPUT TYPE="checkbox" NAME="chkYear[]" id="checkbox-2-2" class="regular-checkbox" VALUE="2"/><label for="checkbox-2-2">2</label>
		        <INPUT TYPE="checkbox" NAME="chkYear[]" id="checkbox-2-3" class="regular-checkbox" VALUE="3" /><label for="checkbox-2-3">3</label>
		        <INPUT TYPE="checkbox" NAME="chkYear[]" id="checkbox-2-4" class="regular-checkbox" VALUE="4"/><label for="checkbox-2-4">4</label>
				<br><br><hr>
				<h3 style="text-align:center; font-weight:bold;">Clubs</h3>
		        <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="APC" id="checkbox-2-5" class="regular-checkbox" /><label for="checkbox-2-5">APC</label>
		        <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="PDC" id="checkbox-2-6" class="regular-checkbox"/><label for="checkbox-2-6">EDC</label>
		        <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="SAASC" id="checkbox-2-7" class="regular-checkbox"/><label for="checkbox-2-7">SAASC</label>
		        <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="DRAMATICS"id="checkbox-2-8" class="regular-checkbox"><label for="checkbox-2-8">DRAMS</label>
		        <br><br><hr>
		       	<h3 style="text-align:center; font-weight:bold;">Technical Societies</h3>
		        <INPUT TYPE="checkbox" NAME="chkSociety[]" VALUE="IEEE" id="checkbox-2-9" class="regular-checkbox"/><label for="checkbox-2-9">IEEE</label>
		        <INPUT TYPE="checkbox" NAME="chkSOciety[]" VALUE="IETE" id="checkbox-2-10" class="regular-checkbox"/><label for="checkbox-2-10">IETE</label>
		        <INPUT TYPE="checkbox" NAME="chkSOciety[]" VALUE="SAE" id="checkbox-2-11" class="regular-checkbox"/><label for="checkbox-2-11">SAE</label>
		        <br><br><hr>	
				<h3 style="text-align:center; font-weight:bold; ">Email Address</h3>
				<input type = 'text' name = "email" id = "email" placeholder="Email Id" style="padding:5px" size="30"/>
				<br><br><hr><br>

				<Input type = 'submit' value = 'Send' class='shiny' />
				</form>

			</div>
		</div>
	</div>
	<div id="footer">
    </div>
</body>
</html>


	<?php

function pls($Rid){
	echo $Rid;

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
	
	?>
