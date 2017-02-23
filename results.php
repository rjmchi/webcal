<html>
<head>
<link rel="stylesheet" href="calendar.css">
</head>

<body>
<form method="POST" action="results.php">

<?php

import_request_variables('g','g_');
if ($g_eventid)
{
	$eventid = $g_eventid;
}

import_request_variables('p','p_');
if ($p_del)
{
	$eventid = $p_eventid;
} 
elseif ($p_submit)
{
	$eventid = $p_eventid;
	$event = $p_event;
	$userid = $p_userid;
	$event_type = $p_event_type;
	$hour = $p_hour;
	$event_finish = $p_event_finish;
}

$db = mysql_connect ("localhost") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("calendar",$db);

if ($p_del) 
{
	$array = explode(",",$p_delete);
	$sql = "DELETE FROM calendar WHERE UserID='$array[0]' AND Received='$array[1]'";
	$result = mysql_query($sql, $db) or die ("Invalid query");
}
if ($p_submit) 
{
	$event_id = "$eventid $hour:00:00";
	echo "<hr>";
	echo $event_id;
	echo "<hr>";
	$durhour = $hour + $event_finish;
	$event_finish = "$eventid $durhour:00:00";
	$sql = "INSERT INTO calendar
		(Received, Event, UserID, EventType, EventFinish) VALUES('$event_id','$event', '$userid', '$event_type', '$event_finish')";
	$result = mysql_query($sql, $db) or die ("Invalid query");

	echo "<b>Submission Added</b><br><br>";
}


$sql = "SELECT * from calendar where Received LIKE '$eventid%' ORDER BY Received";
$result = mysql_query($sql, $db) or die ("Invalid query");

if (!mysql_num_rows($result)) 
{
	echo "I'm sorry, but there are no events for that date.";
} 
else 
{
	echo "For $eventid the following events have been located:";
}
?>

<br>
<hr>

<table class="event-table">
<tr><td>
<table class="event-table">
<tr>
<th>Start Time</th>
<th>Event</th>
<th>Event Type</th>
<th>Event Finish</th>
<th>UserID</th>
<th>Delete?</th>
</tr>

<?php

while ($row = mysql_fetch_array($result))
{
	echo "<tr><td>$row[Received]</td><td>";
	echo "$row[Event]</td><td>";
	echo "$row[EventType]</td><td>";
	echo "$row[EventFinish]</td><td>";
	echo "$row[UserID]</td><td>";
	echo "<input type=\"radio\" value=\"$row[UserID],$row[Received]\" name=\"delete\"></td></tr>";
}

?>

</table>
</td>
</tr>
</table>
<input type="hidden" name="eventid" value="<?php echo $eventid;?>">
<input type="submit" name="del" value="Delete Event">
</form>
<form method="POST" action="results.php"><br><br>
Add an Event for <?php echo "$eventid";?>
<input type="hidden" name="eventid" value="<?php echo $eventid;?>"><br>
Hour:
<select name="hour">
<option value="1">1AM
<option value="2">2AM
<option value="3">3AM
<option value="4">4AM
<option value="5">5AM
<option value="6">6AM
<option value="7">7AM
<option value="8">8AM
<option value="9">9AM
<option value="10">10AM
<option value="11">11AM
<option value="12">12PM
<option value="13">1PM
<option value="14">2PM
<option value="15">3PM
<option value="16">4PM
<option value="17">5PM
<option value="18">6PM
<option value="19">7PM
<option value="20">8PM
<option value="21">9PM
<option value="22">10PM
<option value="23">11PM
</select>
<br>
Event Information:<br>
<textarea name="event" cols="20" rows="5"></textarea>
<br>
UserID:<br>
<input type="text" name="userid"><br>
Event Type:<br>
<input type="text" name="event_type"><br>
Event Duration (in hours):<br>
<input type="text" name="event_finish"><br>
<input type="submit" name="submit" value="Add Event">
</form>
<a href="cal.php">Back to the Calendar</a>
</body>
</html>

<?
function CheckConflict($db, $dt, $dur,$usr)
{
	$sql = "SELECT * from calendar where Received LIKE '$dt%' ORDER BY Received";
	$result = mysql_query($sql, $db) or die ("Invalid query");

	if (!mysql_num_rows($result)) 
	{
		echo "I'm sorry, but there are no events for that date.";
	} 
	else 
	{
		echo "For $eventid the following events have been located:";
	}	
}
?>






