<html>
<head>
<title>Invitation</title>

</head>
<body>
     Welcome <?php echo $_POST['R_Id'];?>

<table>
<form name = 'Invitation' ID = 'Invitation'  action = 'send_invite.php' Method = 'POST'>

<tr>
          <td> Year </td>
     
          <td>
          <INPUT TYPE="checkbox" NAME="chkYear[]" VALUE="1" />1st Year
          <INPUT TYPE="checkbox" NAME="chkYear[]" VALUE="2"/>2nd Year
          <INPUT TYPE="checkbox" NAME="chkYear[]" VALUE="3" />3rd Year
          <INPUT TYPE="checkbox" NAME="chkYear[]" VALUE="4"/>4th Year
          </td>
</tr>

<tr>
          <td> Club </td>
     
          <td>
          <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="APC" />APC
          <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="PDC"/>PDC
          <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="SAASC" />SAASC
          <INPUT TYPE="checkbox" NAME="chkClub[]" VALUE="DRAMATICS"/>DRAMATICS
          </td>
</tr>
</tr>

<tr>
          <td> Society </td>
     
          <td>
          <INPUT TYPE="checkbox" NAME="chkSociety[]" VALUE="IEEE" />IEEE
          <INPUT TYPE="checkbox" NAME="chkSOciety[]" VALUE="IEEE"/>IETE
          </td>
</tr>


</table>
<br><br>

Enter the e-mail address: 
<input type = 'text' name = "email" id = "email">
<Input type = 'submit' value = 'Send Invitation'>

</form>



</body>
</html>