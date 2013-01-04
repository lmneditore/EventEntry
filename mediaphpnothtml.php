<?PHP session_start();
function send_mail($to_name, $to_email, $from_name, $from_email, $subject, $message, $headers){ 
//  strip the slashes out of these strings. 
   while(list($key,$val)=each($_REQUEST)){ 
       $$key = stripslashes( $val ); 
    } 
mail($to_email, $subject, $message, $headers);

} 



//include("functions.php");
include("/inks/LMhdrw.inc");

$sqlmedia="SELECT lmuser.email, lmuser.tel, lmuser.salutation,lmuser.fname, lmuser.lname, lmuser.actid, lmuser.venueid, mediaemail.businessname, mediaemail.contactname, mediaemail.title, mediaemail.emailaddress as mediaemail FROM lmuser
LEFT JOIN usermedia 
ON usermedia.userid=lmuser.user_id 
LEFT JOIN mediaemail ON
usermedia.mediaemailid=mediaemail.mediaemailid 
WHERE lmuser.user_id='24'";
$results=@mysql_query($sqlmedia,$connection4) or die("Couldn't execute this sender media query.");
$sender=@mysql_fetch_array($results); 
$salutation=$sender["salutation"];
$fname=$sender["fname"];
$lname=$sender["lname"];
$senderemail=$sender["email"];
$medianame=$sender["businessname"];
$mediacontactname=$sender["contactname"];
$mediatitle=$sender["title"];
$mediaemail=$sender["mediaemail"];
$tomedia=$mediacontactname;
$tomedia .=$title;
$tomedia .=", ";
$tomedia .=$medianame;
$thissender=$salutation;
$thissender .=" ";
$thissender .=$fname;
$thissender .=" ";
$thissender .=$lname;

//include("/inks/LMHeader.php");
$sqlmedia="SELECT Venues.VenueName, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.Prices, MainEvents.EventStart, MainEvents.EventStart, MainEvents.ContactNumber, AgeRestrictions.AgeRestriction, MainEvents.DescriptionOfEvent, MainEvents.DoorsOpen, MainEvents.MainEVID, EventType.TypeofEvent, ScheduleOfEvents.status, MainEvents_Old.EventDate AS EventDate_Old, MainEvents_Old.MainEVID AS MainEVID_Old, ScheduleOfEvents_Old.status AS status_Old, Acts.ActName, Acts_01.ActName AS ActName_Old, eventchangetype.eventchangetype FROM Venues
LEFT JOIN MainEvents ON
Venues.VenueID=MainEvents.VenueID
LEFT JOIN ScheduleOfEvents
ON MainEvents.MainEVID=ScheduleOfEvents.MainEVID
LEFT JOIN AgeRestrictions ON
AgeRestrictions.AgeCodeID=MainEvents.AgeLimits
LEFT JOIN EventType
ON MainEvents.KindOfEvent=EventType.EventTypeID
LEFT JOIN ScheduleOfEvents_Old
ON MainEvents.MainEVID=ScheduleOfEvents_Old.MainEVID
LEFT JOIN MainEvents_Old ON
Venues.VenueID=MainEvents_Old.VenueID
LEFT JOIN Acts ON
ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Acts AS Acts_01 ON
ScheduleOfEvents_Old.ActID=Acts_01.ActID
LEFT JOIN eventchange ON 
MainEvents.MainEVID=eventchange.mainevid
LEFT JOIN eventchangetype ON
eventchange.typechange =eventchangetype.eventchangetypeid 
WHERE (Venues.VenueID='13573' AND (eventchange.sent2media='0000-00-00' OR eventchange.changedid IS NULL))
ORDER BY MainEvents.EventDate, MainEvents_Old.EventDate";
$results=@mysql_query($sqlmedia,$connection4) or die("Couldn't execute this venue query.");
$tomedia=@mysql_fetch_array($results);



$thisdate="2002-01-01";
$thisact="Foo";
$message="Please include the following events in your live events calendar.";
$message .="\n\n\n";
$message .= $tomedia["VenueName"];
$message .="\n\n";
$message .="Questions? Call: ";
$message .= $tomedia["ContactNumber"];
Do
{
    if ($tomedia["EventDate"]==$thisdate)
    {
       if ($tomedia["ActName"]==$thisact)
       {
       }
       ElSE
       {
$message .= "Act Name: ";
$message .= $tomedia["ActName"];
$message .="\n";
$thisdate=$tomedia["EventDate"];
$thisact=$tomedia["ActName"];
       }
    }
    ELSE
    {
$message .="\n\n";
$message .="Event Date: ";
$message .=$tomedia["FDate"];
$message .="\n";
if ($tomedia["TypeofEvent"])
{
$message .="Event Type: ";
$message .= $tomedia["TypeofEvent"];
$message .="\n";
}

if ($tomedia["EventTitle"])
{

$message .="Title: ";
$message .= $tomedia["EventTitle"];
$message .="\n";


}

if ($tomedia["DescriptionOfEvent"])
{
$message .="Description: ";
$message .=$tomedia["DescriptionOfEvent"];
$message .="\n";
}

if ($tomedia["Prices"])
{
$message .= "Prices: ";
$message .=$tomedia["Prices"];
$message .="\n";
}
if ($tomedia["EventStart"])
{
$message .="Event Start: ";
$message .=$tomedia["EventStart"];
$message .="\n";

}
if ($tomedia["AgeRestriction"])
{
		if ($tomedia["AgeRestriction"]=="18+")
		{$age="Eighteen and over";
		}
		ELSEIF ($tomedia["AgeRestriction"]=="21+")
		{$age="Twenty-one and older";
		}
		ELSE 
		{
		$age=$tomedia["AgeRestriction"];
		}

$message .="Age Restriction: ";
$message .= $age;
$message .="\n";

}
if ($tomedia["DoorsOpen"])
{
$message .="Doors: ";
$message .=$tomedia["DoorsOpen"];
$message .="\n";
}

if ($tomedia["ActName"])
{
$message .="Act Name: ";
$message .=$tomedia["ActName"];
$message .="\n";
}
ELSE
{
}
$thisdate=$tomedia["EventDate"];
$thisact=$tomedia["ActName"];
    }

}
WHILE ($tomedia=@mysql_fetch_array($results));
$subject="Test message";
$from_name=$thissender;
$from_email=$senderemail;
$to_email="pmm@louisvillemusicnews.net";
$to_name="Paul"."<".$to_email.">";
$headers .= "From:".$from_name."<".$from_email.">\r\n"; 
$headers .= "To:".$to_name."\r\n"; 
$headers .= "Reply-To:".$from_name."<".$from_email.">\r\n"; 
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "X-Priority: 1\r\n"; 
$headers .= "X-MSMail-Priority: High\r\n"; 
$headers .= "X-Mailer: PHP 4.x"; 


send_mail($to_name, $to_email, $from_name, $from_email, $subject, $message, $headers);

?>




