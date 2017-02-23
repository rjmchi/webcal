<html>
<head>
<LINK REL=STYLESHEET HREF="calendar.css" TYPE="text/css" MEDIA="SCREEN">
</head>
<body>

<?
import_request_variables('g','g_');

include ("gconnect.php");

$sql = "SELECT * from calendar where month = $g_month and year = $g_year and day = $g_day order by sortorder";

$result = mysql_query($sql, $db) or die (mysql_error());

echo "<p class=\"eventdate\">Events for $g_month/$g_day/$g_year</p>";

if (!mysql_num_rows($result)) 
{
	echo "<p class=\"eventdate\">No events for this day</p>";
} 
else
{
	while ($row = mysql_fetch_array($result))
	{
		$event = $row["event"];
		$desc = $row["description"];
		echo "<p class=\"eventhead\">$event</p>";
		$change = array("\r\n" => "<p>");
		strtr($desc, $change);
 		echo "<p class=\"eventdesc\">$desc</p>";
	}
}
mysql_close($db);

?>
<div id="layer1" style="width:126px; height:26px; position:absolute; left:300px; top:450px; z-index:1;">
<a href='#' onClick="self.close()" class =' close_window'>Close Window</a>
</div>
</body>
</html>