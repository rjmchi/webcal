<?
$redir = '<meta http-equiv="refresh" content="0; URL=login.html">';

if ($p_pwd && $p_userid)
{
	include "gconnect.php";

	$sql = "select password, AES_DECRYPT(password, 'webcal') as pwd from secur where userid = '$p_userid'";

	$result = mysql_query($sql, $db) or die (mysql_error());

	if ($result)
	{
		if ($row = mysql_fetch_array($result))
		{
			if ($p_pwd == $row['pwd'])
			{
				$redir = "";
			}
		}
	}
	mysql_close($db);
}
else if ($p_submit || $p_prev || $p_next || $p_delete_x || $p_edit_x)
{
	$redir = "";
}

echo $redir;

?>