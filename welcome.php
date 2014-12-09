<!DOCTYPE html>
<html>

<style>

</style>
<head>

  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login_style/login_style.css" media="screen" type="text/css" />

  <script>
  function validateForm() {
    
    var x = document.forms["registration"]["SID"].value;
    //console.log(x);
    if (x==null || x=="") {
        document.getElementById("errsid").innerHTML="Please enter your Student ID";
        return false;
    }
    
    var x = document.forms["registration"]["fname"].value;
    alert(x);
    if (x==null || x=="") {
        document.getElementById("errfn").innerHTML="What's your name?";
        return false;
    }
    var x = document.forms["registration"]["lname"].value;
    if (x==null || x=="") {
        document.getElementById("errln").innerHTML="What's your name?";
        return false;
    }

    var x = document.forms["registration"]["password"].value;
    alert(x);
    if (x==null || x=="") {
        document.getElementById("errpwd").innerHTML="Please enter a password";
        return false;
    }
    var x = document.forms["registration"]["emailId"].value;
    if (x==null || x=="") {
        document.getElementById("erreid").innerHTML="Please enter a valid email address";
        return false;
    }
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        document.getElementById("erreid").innerHTML="Not a valid e-mail address";
        return false;
    }
}
</script>

</head>

<body>
<div id="base">
<input type="button" value="Login" class="login login-submit" onclick="document.getElementById('login-panel').style.display='block';"></input>
<input type="button" value="Register" class="login login-submit" onclick="document.getElementById('register-panel').style.display='block';"></input>

          <div id="login-panel" style="display:none;">
            <div  class="login-card" >
                  <h1>Log-in</h1><br>
                  <form name="login" action="" method="post">
                  <?php $flag = "'".$_POST['mailFlag']."'"?>
                  <input type = 'hidden'  name  = 'mailFlag' id = 'mailFlag' value = <?php echo $flag; ?>>
                  <input type ='hidden'  name='request' id='request' value = <?php echo $_POST['request'] ?>>
                  <input type ='hidden' name='designation' id='designation' value = <?php echo $_POST['designation'] ?>>
                  <input type="text" name="username" placeholder="Username">
                  <input type="password" name="password" placeholder="Password">
                  <input type="submit" name="login" class="login login-submit" value="login" onclick="action='checkUser.php';" >
                </form>

                <div class="login-help">
                  <a href="Register.php">Register</a> <!--• <a href="#">Forgot Password</a-->
                </div>
            </div>
          </div>
          </div>

          <div id="register-panel" style="display:none;">

                 <div class="login-card">
                  <h1>Register</h1>
                <form name="registration" action="SuccesfullyRegistered.php" method="post" onsubmit="return validateForm()">
                  <div id="errsid" class="errorInfo">   </div>
                   <input type="text" name="SID" placeholder="Student ID"></input>
                  <div id="errfn" class="errorInfo">   </div>
                   <input type="text" name="fname" placeholder="First Name"></input>
                   <div id="errln" class="errorInfo">   </div>
                  <input type="text" name="lname" placeholder="Last Name"></input>
                  <div id="errpwd" class="errorInfo">   </div>
                  <input type="password" name="password" placeholder="Password"></input>
                
                <label>
                  <select name="branch">
                    <option >Branch</option>
                    <option value="CSE">CSE</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Electrical">Electrical</option>
                    <option value="IT">IT</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Metallurgy">Metallurgy</option>
                    <option value="Production">Production</option>
                    <option value="Aeronautics">Aeronautics</option>
                    <option value="Civil">Civil</option>
                  </select><br>
                </label>
                  
                  <select name="year" id="year">
                    
                    </select><br>
                  <script>
                  var year = 2011;
                  var till = 2050;
                  var options = "";
                  options += "<option>Year</option>";
                  for(var y=year; y<=till; y++){
                      options += "<option value='"+ y +"'>"+ y +"</option>";
                  }
                  document.getElementById("year").innerHTML = options;
                  </script> 
                  
                  <select name="club">
                    <option >Club</option>
                    <option value="APC">Art and Photography Club</option>
                    <option value="Dramatics">Dramatics Club</option>
                    <option value="Communication">Communication Club</option>
                    <option value="Energy">Energy and Enviro-vision Club</option>
                    <option value="EDC">Entrepreneurship Development Cell</option>
                    <option value="Hindi">Hindi_Editorial_Board</option>
                    <option value="SAASC">Speakers Association and Study Circle (SAASC)</option>
                    <option value="PDC">Projection and Design Club</option>
                    <option value="Music">Music Club</option>
                    <option value="Rotaract">Rotaract Club</option>
                    <option value="English">The_English_Editorial_board</option>
                    <option value="Punjabi">Punjabi_Editorial_Board</option>
                    <option value="Other">Other</option>
                  </select><br> 
                  
                  <select name="society">
                    <option >Technical Society</option>
                    <option value="IEEE">I.E.E.E.</option>
                    <option value="ISTE">I.S.T.E.</option>
                    <option value="SAE">S.A.E.</option>
                    <option value="IEE">I.E.E.</option>
                    <option value="Robotics">Robotics</option>
                    <option value="SESI">SESI</option>
                    <option value="IIM">IIM</option>
                    <option value="SME">S.M.E.</option>
                  </select>
                  <input type="text" name="emailId" placeholder="Email Id"><div id="erreid" class="errorInfo">   </div><br>
                  <input type="submit" class="login login-submit" value="Sign Up"></input>
                

                </form>
              </div>
          </div>
<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

  <!--script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script-->

</body>

</html>
