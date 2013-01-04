<?PHP
session_start();
Include ("/inks/LMHeader.php");
if($validvenue)
{
}
ELSE
{ 
$validvenue=-1;
}
if($genretext)
{
}
ELSE
{
$genretext="black";
}
$sqlmaingenre ="SELECT AMGMainGenre.AMGMGID, AMGMainGenre.AMGMainGenre
FROM AMGMainGenre
WHERE 1
ORDER BY AMGMainGenre";
$result = @mysql_query($sqlmaingenre) or die("couldn't execute  maingenre query.");
$thisgenre = @mysql_fetch_array($result);

if ($thisgenre)
{

   DO
   {
      if ($genreid==$thisgenre["AMGMGID"])
      {
      $genreid= $thisgenre["SeriesID"];
      $genrename=$thisgenre["AMGMainGenre"];
      $option_block .= "<OPTION style=\"color: $genretext; \" value=\"$genreid\" selected>$genrename</OPTION>";
       }
       Else
       {
       $genreid= $thisgenre["AMGMGID"];
       $genrename=$thisgenre["AMGMainGenre"];
       $option_block .= "<OPTION style=\"color:$genretext;\" value=\"$genreid\">$genrename</OPTION>";
        }
     }
     While ($thisgenre = @mysql_fetch_array($result));
?>
 <select name="thisgenre1">
<?PHP echo "$option_block"; ?>
</SELECT>

<?
}
ELSE
{
}
?>
