<?php
function DisplayCalendar($date)
{
include ("gconnect.php");

$month_num = $date["mon"];
$year = $date["year"];

$sql = "SELECT distinct month, day, year from calendar where month = $month_num and year = $year ORDER BY year, month, day";
$result = mysql_query($sql, $db) or die ("Invalid query");

$events = true;

if (!mysql_num_rows($result)) 
{
	$events=false;
} 
else
{
	if ($row = mysql_fetch_array($result))
	{
	
	}
}



$month_name = $date["month"];

$date_today = getdate(mktime(0,0,0,$month_num,1,$year));
$first_week_day = $date_today["wday"];
$cont = true;
$today = 27;

while (($today <= 32) && ($cont)) 
{
	$date_today = getdate(mktime(0,0,0,$month_num,$today,$year));
	if ($date_today["mon"] != $month_num) 
	{
		$lastday = $today - 1;
		$cont = false;
	}
	$today++;
}

echo "<table class=\"cal-table\">
<tr><th colspan=\"7\">$month_name $year</th></tr>
<tr><th>Su</th><th>M</th><th>T</th><th>W</th><th>Th</th><th>F</th><th>Sat</th></
tr>";

// begin placement of days according to their beginning weekday

$day = 1;
$wday = $first_week_day;
$firstweek = true;
$weeks = 0;

while ( $day <= $lastday) 
{
	if ($firstweek) 
	{
		echo "<TR>";
		for ($i=1; $i<=$first_week_day; $i++) 
		{
			echo "<TD> &nbsp;</td>";
		}
		$firstweek = false;
	}
	else if ($wday==0) 
	{
		echo "<tr>";
		$weeks++;
	}

// make each day linkable to the following result.php page

	$lnk = "\n<td>$day</td>";
	if ($events)
	{
		if ($row["day"] == $day)
		{

			$lnk = "\n<td class=\"busy\"><a href='javascript:js_popup(\"events.php?month=$month_num&year=$year&day=$day\")'> $day </a></td>";
			if (!$row = mysql_fetch_array($result))
			{
				$events = false;
			} 
		}
	}
	echo $lnk;

	if ($wday==6) 
	{
		echo "</tr>\n";
	}

	$wday++;
	$wday = $wday % 7;
	$day++;
}
if ($wday > 0 && $wday < 7)
{
	while ($wday < 7)
	{
		echo "\n<td>&nbsp;</td>";
		$wday++;
	}
	echo "</tr>\n";
}
while ($weeks < 5)
{
	echo "\n<tr>";
	for ($wday = 0;$wday<7;$wday++)
	{
		echo "\n<td>&nbsp;</td>";
	}
	echo "</tr>\n";
	$weeks++;
}

echo "</table>";
mysql_close($db);
}

?>
<script language="JavaScript" type="text/javascript">
function js_popup(url)
{
	window.open(url, "Events","width=630,height=600");
}
</script>
