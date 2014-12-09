 <!DOCTYPE html>

<html>
	<head>
		<title>
			ROOM ALLOCATION
		</title>

		<meta name="description" content="website description">
  		<meta name="keywords" content="website keywords, website keywords">
  		<meta http-equiv="content-type" content="text/html; charset=windows-1252">

  		<link rel="stylesheet" type="text/css" href="style/style.css">

		<link rel="stylesheet" type="text/css" href="Style.css">
		<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

		<script type="text/javascript" src="jsDatePick.min.1.3.js">	</script>
		<script>

	
	window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"inputField",
				dateFormat:"%d/%M/%Y"
			/*selectedDate:{This is an example of what the full configuration offers.
				day:5,		For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
			});
		};
	var count=0,start=-1,end=-1;

	function AddImages(Room_Id){

		var i,result;
		varstartDates = new Array();
		var date = document.getElementById("inputField").value;
		var params = "RoomId="+Room_Id+"&date="+date;
		httpRequest=new XMLHttpRequest();
		httpRequest.open("POST","getBookedRooms.php",true);
		httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		httpRequest.onreadystatechange = function() {
   			if (httpRequest.readyState == 4) {
   				var startDiv,endDiv;
      			result = httpRequest.responseText;
      			//alert(result);
      			mainArray = result.split('*');
      			startDates = mainArray[0].split('|');
				console.log("In AddImages result: "+result.length+" Start dates: " + startDates.length-1);
				for(i=0;i<startDates.length-1;i+=2){
					if(startDates[i].split(" ")[1].split(":")[1]==30){
						startDiv = startDates[i].split(" ")[1].split(":")[0]*2 +2;
					}
					else{
						startDiv = startDates[i].split(" ")[1].split(":")[0]*2+1;
					}

					if(startDates[i+1].split(" ")[1].split(":")[1]==30){
						endDiv = (startDates[i+1].split(" ")[1].split(":")[0])*2 +1;
					}
					else{
						endDiv = (startDates[i+1].split(" ")[1].split(":")[0])*2 ;
					}
					
					console.log("\nDate: "+startDates[i].split(" ")[1].split(":")[0]+startDates[i+1].split(" ")[1].split(":")[0]);
					console.log("Divs: "+startDiv+" "+endDiv);
					for(j=startDiv;j<=endDiv;j++){
					document.getElementById(j).style.background = "red";
//					document.getElementById(j).innerHTML = '<img src="Images/pend.jpg" style="width:100%;height:100%;max-width: 100%;max-height:100%;"/>';
					}
				}

				startDates = mainArray[1].split('|');
				console.log("In AddImages result: "+result.length+" Start dates: " + startDates.length-1);
				for(i=0;i<startDates.length-1;i+=2){
					if(startDates[i].split(" ")[1].split(":")[1]==30){
						startDiv = startDates[i].split(" ")[1].split(":")[0]*2 +2;
					}
					else{
						startDiv = startDates[i].split(" ")[1].split(":")[0]*2+1;
					}

					if(startDates[i+1].split(" ")[1].split(":")[1]==30){
						endDiv = (startDates[i+1].split(" ")[1].split(":")[0])*2 +1;
					}
					else{
						endDiv = (startDates[i+1].split(" ")[1].split(":")[0])*2 ;
					}
					
					console.log("\nDate: "+startDates[i].split(" ")[1].split(":")[0]+startDates[i+1].split(" ")[1].split(":")[0]);
					console.log("Divs: "+startDiv+" "+endDiv);
					for(j=startDiv;j<=endDiv;j++){
					document.getElementById(j).style.background = "black";
	//				document.getElementById(j).innerHTML = '<img src="Images/booked.jpg" style="width:100%;height:100%;max-width: 100%;max-height:100%;"/>';
					}
				}
    		}
  		}
		httpRequest.send(params);
	}

	function createDivs(Room_Id){
		var content ='';
 		for(i=1;i<=48;i++){
 		content = content + '<div id="'+i+'" onmousedown="getStartId(event)" onmouseup="getEndId(event,'+Room_Id+')" style="position: relative;float:left;top:0;width: 2.08%;height: 100%;"></div>';
 		}
		document.getElementById("time_bar").innerHTML = content;
		document.getElementById("time_bar").style.background = "blue";
	}

	function getStartId(e){
		e = e || window.event;
  		var elementId = e.target ? e.target.id : e.srcElement.id;
  		var info = e.target ? e.target.event:e.target.event;
  		start=elementId;
  		console.log("start: "+start);
  		}

	function getEndId(e,Room_Id){
		var i;
		e = e || window.event;
  		var elementId = e.target ? e.target.id : e.srcElement.id;
  		var info = e.target ? e.target.event:e.srcElement.event;
  		
  		end=elementId;
  		console.log("end: "+end);
  		console.log("R_id while inserting from db: "+ Room_Id);

  		for(i=start;i<=end;i++)
  		document.getElementById(i).innerHTML = '<img src="Images/pend.jpg" style="width:100%;height:100%;max-width: 100%;max-height:100%;"/>';
	}


	function processBookingReq(Room_Id){
		var e = document.getElementById("reqEntity");
		var reqEntity =document.getElementById("reqEntity").options[e.selectedIndex].text ;
		var purpose = document.getElementById("purpose").value;
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var date = document.getElementById("inputField").value;
		
		var params = "status=pending&RoomId="+Room_Id+"&bookingDate="+date+"&startTime="+start+"&endTime="+end+"&reqEntity="+reqEntity+"&purpose="+purpose;
		
		console.log("In enterRequestToDatabase : Room_Id: "+Room_Id+" start: "+start+" end: "+end);
		
		httpRequest=new XMLHttpRequest();
		httpRequest.open("POST","processBookingRequest.php",true);
		httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		
		httpRequest.onreadystatechange = function() {
   			if (httpRequest.readyState == 4) {
      			console.log("Inserted to database"+httpRequest.responseText);
      			alert("You request has been successfully submitted!"+httpRequest.responseText);
    		}
  		}

		httpRequest.send(params);
	}

	function getSelectedR_ID(){
		var e = document.getElementById("selectRoom");
		var strUser = e.options[e.selectedIndex].value;
		//console.log("selected room_ID: " + strUser);
		return strUser;
	}

	function displayPurpose(){
		//alert(start +end);
		if(start==-1 && end ==-1){
			alert("Select time!!");
		}
		else
		document.getElementById("purposediv").style.display="";
	}
	function displayTimeBar(){
		//testDate();
		if(testDate()==1){
			document.getElementById("time_bar").style.display="";
		
		//document.getElementById("main").style.display="";
		createDivs(getSelectedR_ID());
		AddImages(getSelectedR_ID());
	}}

	function testDate(){
		var currentdate = new Date();
		var value = new Date(currentdate.getFullYear(), currentdate.getMonth(), currentdate.getDate());
//		var dat1 = new Date();
//		var date1 = dat1.format("HH:mm:ss");
		var date2 = document.getElementById("inputField").value;
		list = date2.split('/');
		theDay=list[0];mo=list[1];theYear = list[2];
		theMonth = GetMonth(mo);
		//alert(theYear+"  "+currentdate.getFullYear()+"  "+theMonth+"  "+getmonth(currentdate.getMonth())+"  "+theDay+" "+currentdate.getDate());
		
		if(theYear<currentdate.getFullYear() || (theYear == currentdate.getFullYear())&&(theMonth<(currentdate.getMonth())+1)||((theYear == currentdate.getFullYear())&&(theMonth  == (currentdate.getMonth())+1)&&(theDay < currentdate.getDate()))){
			//document.getElementById("errorMsgDate").style.display="block";
			document.getElementById("errorMsgDate").innerHTML = "Invalid Date";
			document.getElementById("time_bar").style.display="none";
		//	document.getElementById("bookRoom").style.display="none";
//			document.getElementById("purposediv").style.display="none";
			return 0;
		}
		else{
			//document.getElementById("errorMsgDate").style.display="none";
			document.getElementById("time_bar").style.display="block";
			document.getElementById("errorMsgDate").innerHTML = "";
			document.getElementById("bookRoom").style.display="block";
			return 1;	
		}
//		alert("Testing: date1: "+value+" date2: "+date2);
	}


	function GetMonth(mo){
	switch(mo){
	case "JAN":mon=1;
	break;
	case "FEB":mon=2;
	break;
	case "MAR":mon=3;
	break;
	case "APR":mon=4;
	break;
	case "MAY":mon=5;
	break;
	case "JUN":mon=6;
	break;
	case "JUL":mon=7;
	break;
	case "AUG":mon=8;
	break;
	case "SEP":mon=9;
	break;
	case "OCT":mon=10;
	break;
	case "NOV":mon=11;
	break;
	case "DEC":mon=12;
	break;
}
return mon;	
}

	function getmonth(mo){
	switch(mo){
	case "Jan":mon=1;
	break;
	case "Feb":mon=2;
	break;
	case "Mar":mon=3;
	break;
	case "Apr":mon=4;
	break;
	case "May":mon=5;
	break;
	case "Jun":mon=6;
	break;
	case "Jul":mon=7;
	break;
	case "Aug":mon=8;
	break;
	case "Sep":mon=9;
	break;
	case "Oct":mon=10;
	break;
	case "Nov":mon=11;
	break;
	case "Dec":mon=12;
	break;
}
return mon;	
}


function scrollDown()
{
	window.scrollTo(0,document.body.scrollHeight);
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
	          <li class="selected"><a href="Booking.php">Book Room</a></li>
	          <li><a href="Booking_Status.php">Check Status</a></li>
	          <li><a href="Cancellation.php">Cancel Request</a></li>
	          <li><a href="contact_us.php">Contact Us</a></li>
	        </ul>
	      </div>
	    </div>
	</div>

		
<!--div style="display:block; background:blue; position:relative;float:left; height:10px; widht:100px;"></div-->
		<div class="site-main" style="width:100%;">
			<div id="all" style=" margin:0 auto 0; width:80%;">	
				<div id="welcome" style="width:100%; text-align:right; font-weight:bold ;color:black;" >
				 	<form action="welcome.php">
				 		Welcome <?php session_start(); echo $_SESSION['Name'] ?>!! 
						<input type="submit" class="enjoy-css" value="Log Out" style="width:60px;background: rgba(27,122,247,0.9);" />
					</form><hr>
					
				</div>
				<br>
				<!--div class="book-form" style="background:white; border:1px solid;"-->
					<form NAME="fromMainOne" ID="fromMainOne" ACTION="Booking.php" METHOD="post" >
						
						  
						  <!--div style="position:relative; width:25%; float:left; background:rgba(20,20,20,0.3);">
							
						  </div-->
						  
						  	<div style="position:relative;width:100%%;float:left; background:rgba(20,20,220,0.3); text-align:center; color:black;">
							    <br>
							    <h3 style="text-align:center; font-weight:bold;">Department</h3>
								
							    
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-1" class="regular-checkbox" VALUE="CSE" <?php echo(isset($_POST['chkDept']) && in_array("CSE",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-1">CSE</label>
								
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-2" class="regular-checkbox" VALUE="Electrical"<?php echo(isset($_POST['chkDept'])&&in_array("Electrical",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-2">Electrical</label>
							  	
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-3" class="regular-checkbox" VALUE="E&EC"<?php echo(isset($_POST['chkDept'])&&in_array("E&EC",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-3">E&EC</label>
							
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-4" class="regular-checkbox" VALUE="Aerospace"<?php echo(isset($_POST['chkDept'])&&in_array("Aerospace",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-4">Aerospace</label>
								
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-5" class="regular-checkbox" VALUE="Mechanical"<?php echo(isset($_POST['chkDept'])&&in_array("Mechanical",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-5">Mechanical</label>
								
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-6" class="regular-checkbox" VALUE="Civil"<?php echo(isset($_POST['chkDept'])&&in_array("Civil",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-6">Civil</label>
								
								<INPUT TYPE="checkbox" NAME="chkDept[]" id="checkbox-1-7" class="regular-checkbox" VALUE="Metallurgy"<?php echo(isset($_POST['chkDept'])&&in_array("Metallurgy",$_POST['chkDept'])?'checked="true"':"")?>/><label for="checkbox-1-7">Metallurgy</label>
							  	<br>
							  	<br>
						  	</div>
						  

							<div style="position:relative;width:100%; float:left; background:rgba(220,220,220,0.3);text-align:center;color:black;">
								<br>
								<h3 style="text-align:center; font-weight:bold">Projector</h3>
								<INPUT TYPE="radio" NAME="rdProjector" id="radio-1-1" class="regular-radio"  VALUE="Yes"<?php echo(isset($_POST['rdProjector'])&&$_POST['rdProjector']=="Yes"?'checked="true"':"")?>/><label for="radio-1-1">Yes</label>
								
								<INPUT TYPE="radio" NAME="rdProjector" id="radio-1-2" class="regular-radio"  VALUE="NO" <?php echo(isset($_POST['rdProjector'])&&$_POST['rdProjector']=="NO"?'checked="true"':"")?>/><label for="radio-1-2">No</label>
							    <br>
							    <br>
							</div>
							

							<div style="position:relative;width:100%; float:left; background:rgba(20,20,220,0.3);text-align:center;color:black;">
								<br>
								<h3 style="text-align:center;font-weight:bold">Capacity</h3>
								<INPUT TYPE="checkbox" NAME="chkCapacity[]" id="checkbox-1-8" class="regular-checkbox" VALUE="0 AND 40" TABINDEX="5" <?php echo(isset($_POST['chkCapacity']) && in_array("0 AND 40",$_POST['chkCapacity'])?'checked="true"':"")?>/><label for="checkbox-1-8">Less than 40</label>
								
								<INPUT TYPE="checkbox" NAME="chkCapacity[]" id="checkbox-1-9" class="regular-checkbox" VALUE="40 AND 100" TABINDEX="6"<?php echo(isset($_POST['chkCapacity']) && in_array("40 AND 100",$_POST['chkCapacity'])?'checked="true"':"")?>/><label for="checkbox-1-9">40-100</label>
								
								<INPUT TYPE="checkbox" NAME="chkCapacity[]" id="checkbox-1-10" class="regular-checkbox" VALUE="100 AND 500" TABINDEX="7"<?php echo(isset($_POST['chkCapacity']) && in_array("100 AND 500",$_POST['chkCapacity'])?'checked="true"':"")?>/><label for="checkbox-1-10">More than 100</label>
							  	<br>
							  	<br>
							</div>

						  	<div style="position:relative; width:100%; float:left; background:rgba(220,220,220,0.3);text-align:center;color:black;">
							  	<br>
								<INPUT  TYPE="submit" NAME="shwRooms" VALUE="Show Rooms" class="shiny" onmouseup="" TABINDEX="8" style="margin:0 auto 0;"/><br><br>
								<INPUT TYPE="hidden" NAME="ifReqRooms" VALUE="1" />
																	
									<?php
										if (isset($_POST["ifReqRooms"]) ) {
											echo '<select NAME="selectRoom" id="selectRoom" style="padding:5px; cursor:pointer">';
											$totalRooms = ShowRooms();
											for($i=0;$i<count($totalRooms);$i++){
												$oneRoom = $totalRooms[$i];
												echo "<option value=\"".$oneRoom{'R_Id'}."\"".CheckSelected($oneRoom{'R_Id'}).">".GenerateOption($oneRoom)."</option>";
											}
											echo "</select>";
										}
										echo "<script>scrollDown();</script>";
									?>
									
								<br>
								<br>
							</div>
							
							
							<div style="position:relative; width:100%; float:left; background:rgba(20,20,220,0.3);text-align:center;color:black;">
								<div id = "errorMsgDate" ></div>
								<h3 style="text-align:center; font-weight:bold;">Calendar</h3>
								<input type="text" size="12" id="inputField" onfocus="test()" style="padding:5px" placeholder="Select Date"></input>	
								<br>
								<br>
								<INPUT TYPE="button" NAME="shwDetails" VALUE="Show Details" class="simple" TABINDEX="8" onclick="displayTimeBar()"/>
								<br>
								<br>

							</div>
							
							<div style=" position:relative; width:100%; float:left; background:rgba(220,220,220,0.3);text-align:center;color:black;">
										<br>
											<div id="time_bar"  style="display:none; width:100%; height:50px;"></div>
										<br>
							</div>
						
							<div style=" position:relative; width:100%; float:left; background:rgba(20,20,220,0.3);text-align:center;color:black;">
								<input id="bookRoom" TYPE="button"  NAME="bookRoom" VALUE="Book Room" class="simple" onclick="displayPurpose()" />
							</div><br>
							
							<div id="purposediv" style="position:relative; width:100%; float:left; background:rgba(220,220,220,0.3);text-align:center;color:black;">
							
										<select name="reqEntity" id="reqEntity">
										<option value="1">Requesting Entity</option>
										<option value="2">APC</option>
										<option value="3">Drams</option>
										<option value="4">PDC</option>
										<option value="5">SAASC</option>	
										<option value="6">IEEE</option>
										<option value="7">SESI</option>
										</select>
									
										<br><br>Purpose<br> <textarea id="purpose" rows="4" cols="50"></textarea>
										<br><INPUT TYPE="button" NAME="bookRoomReq" VALUE="Book Room" class="simple" onclick="processBookingReq(getSelectedR_ID())"/>				
			
							</div>
						
					</form>
				<!--/div-->
			</div>
		</div>
		
		<div id="footer" style="position:relative; float:left;">
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
echo "Connected to MySQL<br>";
$selected = mysql_select_db("Rooms",$dbhandle) 
  or die("Could not select Rooms");
echo "Selected Database Rooms<br>";

}
function ShowRooms(){

	ConnectToDatabase();

	$askedProjector=$_POST['rdProjector'];
 	$totalRooms=array();

 	foreach ( $_POST['chkDept'] as $dept) {
 		$Quo="'";
 		foreach ( $_POST['chkCapacity'] as $askedCapacity) {
			$result = mysql_query("SELECT R_Id, Department,Capacity,Projector FROM Rooms WHERE Department=".$Quo.$dept.$Quo.
 			"AND Projector=".$Quo.$askedProjector.$Quo.
 			"AND Capacity BETWEEN ".$askedCapacity);

	 		while ($row = mysql_fetch_array($result)) {
 				array_push($totalRooms, $row);
  			}	
		}	
	}
	/*	for($i=0;$i<count($totalRooms);$i++){
	$row=$totalRooms[$i];
  	echo "<br>"."R_ID: ".$row{'R_Id'}."   Department: ".$row{'Description'}."   Projector: ".$row{'Projector'};
	}*/

	return $totalRooms;
}

function GenerateOption($oneRoom){
	return ($oneRoom{'Description'}."(".$oneRoom{'Department'}.")(".$oneRoom{'Capacity'}.")(".$oneRoom{'Projector'}.")");

}

function CheckSelected($value){
	if(isset($_POST['selectRoom'])&&($_POST['selectRoom']==$value))
		return 'selected = "selected"';
	else 
		return "";
}	


?>

