<table class="event-list">
    <tr>
        <th width="25" class="event-list">Edit</th>
        <th width="25" class="event-list">Del</th>
        <th width="57" class="event-list">Date</th>
        <th width="198" class="event-list">Event</th>
        <th width="376" class="event-list">Description</th>
    </tr>
<?
include ("gconnect.php");

$sql = "SELECT * from calendar order by year, month, day, sortorder";

$result = mysql_query($sql, $db) or die (mysql_error());

if (mysql_num_rows($result) > 0) 
{
	while ($row = mysql_fetch_array($result))
	{
		$edate = $row["month"]."/".$row["day"]."/".$row["year"];
		$event = $row["event"];
		$desc = $row["description"];
		$id = $row["id"];
		echo "<form method=\"POST\" action=\"addevent.php\">";
		echo "<tr>";
		echo "<td width=\"25\" class=\"event-list\">";
		echo "<input type=\"image\" name=\"edit\" value=\"edit\" src=\"images/edit.png\" title=\"Edit\" width=\"16\" height=\"16\" border=\"0\"></td>";
		echo "<td width=\"25\" class=\"event-list\">";
		echo "<input type=\"image\" name=\"delete\" value=\"delete\" src=\"images/del.png\" title=\"Delete\" width=\"16\" height=\"16\" border=\"0\"></td>";		
		echo "<td width=\"57\" class=\"event-list\">$edate</td>";
		echo "<td width=\"198\" class=\"event-list\">$event</td>";
		echo "<td width=\"376\" class=\"event-list\">$desc</td>";
		echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		echo "<input type=\"hidden\" name=\"dispmonth\" value=\"$dispmonth\">";
		echo "<input type=\"hidden\" name=\"dispyear\" value=\"$dispyear\">";
		echo "</tr>";	        
		echo "</form>";
	}
mysql_close($db);
}
?>
</table>