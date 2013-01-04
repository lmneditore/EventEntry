<?PHP
session_start();
include ("/inks/LMHeaderpr.inc");
$sqlchanged="SELECT MainEvents_Old.MainEVID, DATE_FORMAT(MainEvents_Old.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents_Old.sent2media, MainEvents_Old.EventDate, MainEvents_Old.EventTitle, MainEvents_Old.DoorsOpen, MainEvents_Old.EventStart, MainEvents_Old.EventEnd, DATE_FORMAT(MainEvents_Old.onsaledate, '%W, %M %e, %Y') as SDate, MainEvents_Old.Prices,  MainEvents_Old.onsaledate, Venues.VenueName, Venues.ContactPh, Venues.MailAddress, Venues.City, Venues.State, AgeRestrictions.AgeRestriction
FROM MainEvents_Old
LEFT JOIN Venues
ON MainEvents_Old.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents_Old.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents_Old.MainEVID='$thiseventMainEVID' AND MainEvents_Old.sent2media<>'0000-00-00')
ORDER BY MainEvents_Old.sent2media DESC ";
$result=@mysql_query($sqlchanged,$connectionpr) or die ("Couldn't run the old MainEvents query");
$oldshows=@mysql_fetch_array($result);
$numrows=mysql_num_rows($result);

for ($i=0; $i<$numrows; $i++) 
{
IF ($i==0)
{
$oldfdate=$oldshows["FDate"];
session_register("olddate");
$oldtitle=$oldshows["EventTitle"];
session_register("oldtitle");
$oldstart=$oldshows["EventStart"];
session_register("oldstart");
$oldprices=$oldshows["Prices"];
session_register("oldprices");
$oldonsale=$oldshows["onsaledate"];
session_register("oldonsale");
$oldages=$oldshows["AgeRestriction"];
session_register("oldages");
$olddoors=$oldshows["DoorsOpen"];
session_register("olddoors");
}
}
WHILE (@mysql_fetch_array($result));
mysql_close($connectionpr);
?>