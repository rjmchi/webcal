<html>

<head>
<title>Add Event</title>
<LINK REL=STYLESHEET HREF="calendar.css" TYPE="text/css" MEDIA="SCREEN">
<LINK REL=STYLESHEET HREF="admin.css" TYPE="text/css" MEDIA="SCREEN">

<script>
<!--

function js_popup(url) 
{
window.open(url, "moreinfo", "height = 500, width = 440, resizable = 1, scrollbars = 1, location = 0, statusbar = 1, menubar = 1, left = 287, right = 364");
}

-->
</script>
</head>

<body>

<?
include("calendar.php"); 
import_request_variables('p', 'p_');

include ("verifylogin.php");

if (isset($p_desc))
{
	$change = array("\r\n" => "<p>");
	strtr($p_desc, $change);

}
$dispdate = getdate();
$dispmonth = $dispdate["mon"];
$dispyear = $dispdate["year"];

if ($p_prev)
{
	$dispmonth = $p_dispmonth-1;
	$dispdate = getdate(mktime(0,0,0,$dispmonth,1,$p_dispyear));
}
else if ($p_next)
{
	$dispmonth = $p_dispmonth+1;
	$dispdate = getdate(mktime(0,0,0,$dispmonth,1,$p_dispyear));
}
if ($p_submit || $p_edit_x || $p_delete_x)
{
	$dispmonth = $p_dispmonth;
	$dispyear = $p_dispyear;
	$dispdate = getdate(mktime(0,0,0,$dispmonth,1,$p_dispyear));
}
if ($p_submit)
{
	include("connect.php");
	if ($p_update)
	{
		$sql = "update calendar set month=$p_month, day=$p_day, year=$p_year, event='$p_event', description='$p_desc', sortorder=$p_order where id=$p_id";
	}
	else
	{
		$sql = "insert into calendar (month, day, year,event, description, sortorder) values ($p_month, $p_day, $p_year, '$p_event', '$p_desc', $p_order)";
	}
	$result = mysql_query($sql, $db) or die ("Invalid insert/update query");
	mysql_close($db);
}
if ($p_delete_x)
{
	include("connect.php");
	$sql = "delete from calendar where id=$p_id";
	$result = mysql_query($sql, $db) or die ("Invalid delete query");	
	mysql_close($db);
}
$eorder = 1;
if ($p_edit_x)
{
	include("connect.php");
	$sql = "select * from calendar where id=$p_id";
	$result = mysql_query($sql, $db) or die ("invalid edit query");

	if (mysql_num_rows($result) > 0) 
	{
		$row = mysql_fetch_array($result);
		$emonth = $row["month"];
		$eday = $row["day"];
		$eyear = $row["year"];
		$eevent = $row["event"];
		$edesc = $row["description"];
		$eorder = $row["sortorder"];
	}
	mysql_close($db);
}
?>


<table>
<tr>
<td valign="top">
<?
echo "<form action=\"addevent.php\" method=\"POST\" name=\"changecal\">";

echo "<table><tr><td>";
echo "<input type=\"submit\" name=\"prev\" value=\"<<\">";
echo "</td><td>";
DisplayCalendar($dispdate);
echo "</td><td>";
echo "<input type=\"submit\" name=\"next\" value=\">>\">";
echo "</td>";
echo "<input type=\"hidden\" name=\"dispmonth\" value=\"$dispmonth\">";
echo "<input type=\"hidden\" name=\"dispyear\" value=\"$dispyear\">";
echo "</form>";
?>
<? include ("eventform.php"); ?>
</td>
<td valign="top">

<? include ("eventlist.php"); ?>

</tr>
</table>



<p>&nbsp;</p>
</body>

</html>




