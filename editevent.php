<?PHP
session_start();
require ("functions.php");
displayLMHeader();
//$user=session_is_registered("user_id");
IF (session_is_registered("user_id"))
{ 


// $venue=session_is_registered("validvenue");
    IF (session_is_registered("validvenue"))
    {// Check If Venue Edit


    //include("/inks/LMHeader.php");
    $sqlvenue="SELECT VenueName FROM Venues WHERE VenueID='$validvenue'";
    $A=@mysql_query($sqlvenue,$connection4) or die("Couldn't execute Venue query.");
    $venid=@mysql_fetch_array($A);
    displayloginheader("Louisville Music News.net Event Management Login");?>
    <Table width="360" align="center"><tr><td class="loginhdr"><?PHP echo $venid["VenueName"];?> Event Management</td></tr>
     <tr><td align="center"><BR>
     <?PHP echo "<button OnClick=\"window.location='http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php'\" style=\"background-color: grey\">Edit "; 
     ECHO $venid["VenueName"];
     Echo " Events<font color=\"blue\"></button><BR>";?>
     </td></tr>
     <tr><td align="center"><BR><button OnClick="window.location='http://www.louisvillemusicnews.net/lmn/lmhdr.php'" style="background-color: "grey">Return to Main Page<font color="blue"></button></td></tr></table>
   <?PHP }//end of Venue Edit
    ELSEIF($ActID)
    {// Check If Act Edit
    //include("/inks/LMHeader.php");
    $sqlact="SELECT ActName FROM Acts WHERE ActID='$ActID'";
    $B=@mysql_query($sqlact,$connection4) or die("Couldn't execute Act query.");
    $actid=@mysql_fetch_array($B);
    $thisactname=$actid["ActName"];
    session_register($thisactname);
    displayloginheader("Louisville Music News.net Event Management Login");?>
    <Table width="360" align="center"><tr><td class="loginhdr"><?PHP echo $thisactname;?> Event Management</td></tr>
    <tr><td align="center"><BR>
     <?PHP echo "<button OnClick=\"window.location='http://www.louisvillemusicnews.net/eventediting/editthisactsevents.php'\" style=\"background-color: grey\">Edit "; 
    ECHO $thisactname;
    Echo " Events<font color=\"blue\"></button><BR>";?>
    </td></tr>
    <tr><td align="center"><BR><button OnClick="window.location='http://www.louisvillemusicnews.net/lmn/lmhdr.php'" style="background-color: "grey">Return to Main Page<font color="blue"></button></td></tr></table>
<?PHP    }// End of Venue/Act Check
} 
ELSE
{
ECHO "Nope";
}
