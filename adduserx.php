<html>
<head>

</head>
<body>

<?

 $dbh=mysql_connect ("localhost", "efe0164", "thrill") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("efete");

$sql = "insert into user (userid, password) values ('admin', AES_ENCRYPT('calendar', 'webcal'))";

$result = mysql_query($sql, $db);

if ($result)
{
	echo "User added";
}
else
{
	echo "user not added";
}

?>


</body>
</html>

