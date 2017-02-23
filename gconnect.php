<?php

$db=mysql_connect ("localhost","root","kether1330") or die ('I cannot connect to the database because: ' . mysql_error());
if (!mysql_select_db ("webcal"))
{
    die('Not connected : ' . mysql_error());
}

//$db=mysql_connect ("mysql01.800hosting.com","efe0164", "thrill") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("efete");

?>