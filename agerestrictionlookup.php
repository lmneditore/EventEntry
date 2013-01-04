<?PHP
session_start();
//require ("editvars.php");
//Include ("/inks/LMHeader.php");

IF ($thisagecode1)
{
    If 
    ($thisagecode==$thisagecode1)
    {$agecodetext=$defaulttext;
    }
    ELSE
    {
    $thisagecode=$thisagecode1;
    $agecodetext=$changedtext;
    }
}
ELSE
{
$agecodetext=$defaulttext;
}
$cnxn=new lm_connection;
$cnxn->lm_connection("louisvil_louisvillemusiccom");
$sqlAge ="SELECT AgeRestrictions.AgeRestriction, AgeRestrictions.AgeCodeID
FROM AgeRestrictions
WHERE 1";

$resultage = @mysql_query($sqlAge) or die("couldn't execute age restriction query.");
$thisrow = @mysql_fetch_array($resultage);
		   echo "<select name=\"thisagecode1\" size=\"5\">";
    DO
    {
       If ($thisrow["AgeCodeID"]>0)
       {
          if ($thisrow["AgeCodeID"]==$thisagecode)
         {
         $AC=$thisrow["AgeCodeID"];
         $AR=$thisrow["AgeRestriction"];
		 echo $AC;
         echo "<OPTION style=\"color:".$agecodetext."\" value=\"".$AC."\" SELECTED>".$AR."</OPTION>";
         }
         ELSE
         {
         $AC= $thisrow["AgeCodeID"];
         $AR=$thisrow["AgeRestriction"];
         echo "<OPTION style=\"color:".$agecodetext."\" value=\"".$AC."\">".$AR."</OPTION>";
         }
       }
	   ELSE
	   {
	   }
     }
    While ($thisrow = @mysql_fetch_array($resultage));
?>
</SELECT>

