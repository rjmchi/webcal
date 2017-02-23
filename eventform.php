
<form action="addevent.php" method="POST" name="NewEvent">
<table class="event-entry" width="370">
    <tr>
        <td width="85">Date (Month/Day/Year):</td>
        <td width="275">
<?
	echo "<input type=\"text\" name=\"month\" maxlength=\"2\" size=\"2\" value=\"$emonth\">";
	echo "<input type=\"text\" name=\"day\" maxlength=\"2\" size=\"2\" value = \"$eday\">";
	echo "<input type=\"text\" name=\"year\" maxlength=\"4\" size=\"4\" value = \"$eyear\">";
?>
    </td>
    </tr>
    <tr>
        <td width="85">Event Heading:</td>
<?
        echo "<td width=\"275\"><input type=\"text\" name=\"event\" value=\"$eevent\" maxlength=\"255\" size=\"45\"></td>";
?>
    </tr>
    <tr>
        <td width="85">Event Description:</td>
<?
        echo "<td width=\"275\"><textarea name=\"desc\" rows=\"5\" cols=\"45\">$edesc</textarea></td>";
?>
    </tr>
    <tr>
        <td width="85">Sort Order:</td>
<?
        echo "<td width=\"275\"><input type=\"text\" name=\"order\" value=\"$eorder\" maxlength=\"2\" size=\"2\"></td>";
?>
    </tr>

</table>
<?
echo "<input type=\"hidden\" name=\"dispmonth\" value=\"$dispmonth\">";
echo "<input type=\"hidden\" name=\"dispyear\" value=\"$dispyear\">";
if ($p_edit_x)
{
	echo "<p><input type=\"submit\" name=\"submit\" value=\"Change Event\">";
	echo "<input type=\"hidden\" name=\"update\" value = \"update\">";
	echo "<input type=\"hidden\" name=\"id\" value=\"$p_id\">";
}
else
{
	echo "<p><input type=\"submit\" name=\"submit\" value=\"Add Event\">";
	echo "<input type=\"reset\" name=\"reset\" value=\"Clear\"></p>";
}
?>

</form>

