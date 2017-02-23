<html>
<head>
<link rel="stylesheet" href="admin.css">

<script language="JavaScript">
<!--
function validate_form(form)
{
	error = 0;
	var par = document.getElementById("usermsg");
	if (form.userid.value == '')
	{
		par.childNodes[0].nodeValue = "Error: Cannot be empty";
		error = 1;
	}
	else
	{
		par.childNodes[0].nodeValue = "";
	}

	par = document.getElementById("oldpwmsg");
	if (form.oldpw.value == '')
	{
		par.childNodes[0].nodeValue = "Error: Cannot be empty";
		error = 1;
	}
	else
	{
		par.childNodes[0].nodeValue = "";
	}

	par = document.getElementById("newpwmsg");
	if (form.newpw.value == '')
	{
		par.childNodes[0].nodeValue = "Error: Cannot be empty";
		error = 1;
	}
	else
	{
		par.childNodes[0].nodeValue = "";
	}

	par = document.getElementById("reppwmsg");
	if (form.reppw.value == '')
	{
		par.childNodes[0].nodeValue = "Error: Cannot be empty";
		error = 1;
	}
	else if (form.reppw.value != form.newpw.value)
	{
		par.childNodes[0].nodeValue = "Error: New password does not match";
		error = 1;
	}
	else
	{
		par.childNodes[0].nodeValue = "";
	}
	if (!error)
		form.submit();
}


// -->
</script>




</head>
<body>
<?
import_request_variables('p', 'p_');
if ($p_Update)
{
include "gconnect.php";

	$sql = "select password, AES_DECRYPT(password, 'webcal') as pwd from secur where userid = '$p_userid'";

	$result = mysql_query($sql, $db) or die (mysql_error());

	if ($result)
	{
		if ($row = mysql_fetch_array($result))
		{
			if ($p_oldpw == $row['pwd'])
			{
				if (ChangePassword($p_newpw, $p_userid))
					$usererr = "Password Changed";
				else
					$usererr = "Error: password not changed!";
			}
			else
			{
				$pwerr = "Incorrect password";
			}
		}
		else
		{
			$usererr = "Invalid User ID";
		}
	}

mysql_close($db);
}
?>
<form name="form1" action="changepw.php" method="post">
<table border="0" width="547">
<tr>
<td width="70">User Id:</td>
<td width="191">         
<input type="text" name="userid" maxlength="25" size="25">
</td>
<td width="272">
<p id="usermsg" class="errormsg">
<?
echo $usererr;
?>
&nbsp;</p>
</td>
</tr>
<tr>
<td width="70">Old Password:</td>
<td width="191"><input type="password" name="oldpw" maxlength="25" size="25"></td>
<td width="272">
<p id="oldpwmsg" class="errormsg">
<?
	echo $pwerr;
?>
&nbsp;</p>
</td>

</tr>
<tr>
            <td width="70">New Password:</td>
            <td width="191"><input type="password" name="newpw" maxlength="25" size="25"></td>
<td width="272">
<p id="newpwmsg" class="errormsg">&nbsp;</p>
</td>
			
</tr>
<tr>
            <td width="70">Repeat Password:</td>
            <td width="191"><input type="password" name="reppw" maxlength="25" size="25"></td>
<td width="272">
<p id="reppwmsg" class="errormsg">&nbsp;</p>
</td>
			
</tr>
</table>
<p><input type="button" name="Change" value="Change Password" OnClick="validate_form(this.form);"></p>
<input type="hidden" name="Update" value="Update">
</form>

</body>
</html>
<?
function ChangePassword($newpw, $uid)
{
	include("connect.php");
	$sql = "update secur set password=AES_ENCRYPT('$newpw', 'webcal') where userid='$uid'";

	$result = mysql_query($sql, $db);
	$rtn = false;

	if ($result)
	{
		$rtn=true;
	}
	return $rtn;
}
?>