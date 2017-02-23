<html>
<head>

<link rel="stylesheet" href="calendar.css">

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
<center>

<?php
include("calendar.php"); 
// Check for a Month Change submission
import_request_variables('p','p_');
if ($p_submit) 
{

// Subtract one from the month for previous, add one for next

	if ($p_submit == "Prev") 
	{
		$p_month_now--;
	} 
	else 
	{
		$p_month_now++; 
	}

	$date = getdate(mktime(0,0,0,$p_month_now,1,$p_year_now));
} 
else 
{
	$date = getdate();
}

// allow for form submission to the script for forward and backwards
$year = $date["year"];
$month_num=$date["mon"];

echo "<form action=\"cal.php\" method=\"POST\" name=\"calendar\">
<input type=\"hidden\" name=\"month_now\" value=\"$month_num\">
<input type=\"hidden\" name=\"year_now\" value=\"$year\">

<table>
<tr><td><input type=\"submit\" name=\"submit\" value=\"Prev\"></td>
    <td align=right><input
type=\"submit\" name=\"submit\" value=\"Next\"></td>
</tr>
</table>
</form>";

echo "<p>&nbsp;</p>";

echo "<table><tr><td>";
DisplayCalendar($date);
$month_num = $date["mon"];
$month_num++;
$year = $date["year"];
$date = getdate(mktime(0,0,0,$month_num,1,$year));
echo "</td><td>";
DisplayCalendar($date);
echo "</td></tr></table>";
echo "</body></html>";
?>

