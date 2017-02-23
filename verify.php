<html>
<head>

</head>
<body>

<?
import_request_variables('p', 'p_');
include "gconnect.php"

$sql = "select password, AES_DECRYPT(password, 'calendar') as pwd from user where userid = '$p_userid'";
$redir = "<p>Login Failed</p> <p><a href=\"login.html\">Try Again</a></p>";

$result = mysql_query($sql, $db) or die (mysql_error());
if ($result)
{
	if ($row = mysql_fetch_array($result))
	{
		if ($p_password == $row['pwd'])
		{
			$redir = '<meta http-equiv="refresh" content="0; URL=addevent.php">';
		}
	}
}
echo $redir;


?>


</body>
</html>

