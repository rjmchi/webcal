<html>
<head>
</head>

<body>
<?php

$db = mysql_connect ("localhost","root") or die ('I cannot connect to the database because: ' . mysql_error());

$result = mysql_query("grant usage on *.* to 'dummy'@'localhost'", $db) or die ("dummmy Invalid query");

echo $result;


$result = mysql_query("grant select on webcal.* to 'guest'@'localhost' identified by 'pw'", $db) or die ("Invalid query");

echo $result;

?>
</body>
</html>