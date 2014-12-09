<html><head>
  <title>Contact Us</title>
  <meta name="description" content="website description">
  <meta name="keywords" content="website keywords, website keywords">
  <meta http-equiv="content-type" content="text/html; charset=windows-1252">
  <link rel="stylesheet" type="text/css" href="style/style.css">
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
            <li><a href="Interface.php">Home</a></li>
            <li ><a href="Booking.php">Book Room</a></li>
            <li><a href="Booking_Status.php">Check Status</a></li>
            <li><a href="Cancellation.php">Cancel Request</a></li>
            <li class="selected"><a href="contact_us.php">Contact Us</a></li>
          </ul>
      </div>
    </div>
  </div>
   

   <div class="site-main" style="position:relative; top:0px; left:0px; height:100%; width:100%;">
      <div id="all" style="margin:0 auto 0; width:80%;">  
        <div id="welcome" style="width:100%; text-align:right; font-weight:bold ;color:black;" >
         <form action="welcome.php">
         Welcome <?php session_start(); echo $_SESSION['Name'] ?>!! 
          <input type="submit" class="enjoy-css" value="Log Out" style="width:60px;background: rgba(27,122,247,0.9);" />
        </form>
        <br>
            <div style="width:100%; padding:10px ;text-align:left ; background:white;">
              
              <h1 style="font-size:1.3em">PEC Web-based Venue Booking Manager provides expert assistance to meeting planners and event organisers.
              <br>So for any queries regarding this portal, please contact us.
              <br>
              <br>

              Disha Jindal -> <a href="dishajindal11@gmail.com">dishajindal11@gmail.com</a>
              <br>
              Parul Gupta  -> <a href="parulgupta93@gmail.com">parulgupta93@gmail.com</a>
              <br>
              Sudhakar Singh -> <a href="aryansudhakar09@gmail.com">aryansudhakar09@gmail.com</a>
              <h1>
            </div>
        </div>
      </div>
    </div>

 
    
    <div id="footer">
    </div>
      
 
  


</body></html>
