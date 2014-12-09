<html>
<head>
	<title>ROOM ALLOCATION</title>
	<!--link rel="stylesheet" type="text/css" href="Welcome_Style.css"-->
	<!--link rel="stylesheet" type="text/css" href="Style.css"-->
</head>
<body>
	<form name="login" action="" method="post" >
		<div>
		<div id="userpass">
		<?php session_start(); echo $_SESSION['errorMsg'];?><br>
		UserName&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password&nbsp;&nbsp;<br> 
		<input type="text" name="username"><input type="password" name="password"><br>
		</div>
		<div id="button">
		<input type="submit" name="confirm" class="simple" value="Login" onclick="action='checkUser.php';" />
		</div>
		<div id="link">
		<br><a href="Register.php"><b>Sign Up!!</a>
		</div>
	</div>
	</form>
</body>
</html>

