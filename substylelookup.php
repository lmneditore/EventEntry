<?PHP
session_start();

if($subgenretext)
{
}
ELSE
{
$subgenretext="black";
}

include ("/inks/LMHeader.php");

If ($thisgenre1)
{

$sqlsubgenre ="SELECT AMGSubCategory1.AMGSubCat1ID, AMGSubCategory1.SubStyle1
FROM AMGSubCategory1
WHERE NewMainGenreID='$thisgenre1'
ORDER BY SubStyle1";


$result = @mysql_query($sqlsubgenre) or die("couldn't execute  subgenre query.");
$thissubgenre = @mysql_fetch_array($result);


      if ($thissubgenre)
      {
            DO
            {
            if ($subgenreid==$thissubgenre["AMGSubCat1ID"])
            {
            $subgenreid= $thissubgenre["AMGSubCat1ID"];
            $subgenrename=$thissubgenre["SubStyle1"];
            $option_block .= "<OPTION style=\"color: $subgenretext; \" value=\"$subgenreid\" selected>$subgenrename</OPTION>";
            }
             Else
            {
            $subgenreid= $thissubgenre["AMGSubCat1ID"];
            $subgenrename=$thissubgenre["SubStyle1"];
            $option_block .= "<OPTION style=\"color:$subgenretext;\" value=\"$subgenreid\">$subgenrename</OPTION>";
            }
        }
        While ($thissubgenre = @mysql_fetch_array($result));
?>

<tr><td>
Music Substyle1:</td><td> <select name="thissubgenre1">
<?PHP echo "$option_block"; ?>
</SELECT></td></tr>

<?
     }
     ELSE
     {
     }
}
ELSE
{
$sqlsubgenre2 ="SELECT AMGSubcat2.Substyle2ID, AMGSubcat2.Substyle2 
FROM AMGSubcat2
WHERE NewMainGenreID='$thisgenre1'
AND NewSubCate1='$thissubgenre1'
ORDER BY Substyle2";


$result = @mysql_query($sqlsubgenre2) or die("couldn't execute  subgenre query.");
$thissubgenre2 = @mysql_fetch_array($result);


      if ($thissubgenre2)
      {
            DO
            {
            if ($subgenreid2==$thissubgenre2["Substyle2ID"])
            {
            $subgenre2id= $thissubgenre2["Substyle2ID"];
            $subgenre2name=$thissubgenre2["Substyle2"];
            $option_block .= "<OPTION style=\"color: $subgenre2text; \" value=\"$subgenre2id\" selected>$subgenre2name</OPTION>";
            }
             Else
            {
            $subgenre2id= $thissubgenre2["Substyle2ID"];
            $subgenre2name=$thissubgenre2["Substyle2"];
            $option_block .= "<OPTION style=\"color:$subgenre2text;\" value=\"$subgenre2id\">$subgenre2name</OPTION>";
            }
        }
        While ($thissubgenre2 = @mysql_fetch_array($result));
		
?>

<tr><td>
Music Substyle2:</td><td> <select name="thissubgenre2">
<?PHP echo "$option_block"; ?>
</SELECT></td></tr>

<?


}
}
?>