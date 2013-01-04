<?php
If (! $startdate)
{
$startdate=getdate('Y-m-d');
}
IF (! $enddate)
{
$enddate=
}

if ($stylesheet)
{
$stylesheet=urldecode($stylesheet);
echo "<LINK REL=stylesheet HREF=\"".$stylesheet."\" TYPE=\"text/css\">";
}
ELSE
{
echo "<LINK REL=stylesheet HREF=\"http://www.louisvillemusicnews.net/lmn/LMNStyles.css\" TYPE=\"text/css\">";
}?>

<?
include ("/inks/functions.php");
//include("/inks/LMHeader.php");
if ($enddate & $startdate)
{
$sql="SELECT  DailyBlurbs.Blurb,lmngenres.genre, DailyBlurbs.Tixandinfo, Pix4Event.PathToThumbs
FROM DailyBlurbs
LEFT JOIN lmngenres
ON DailyBlurbs.lmngenre=lmngenres.lmngenreid
LEFT JOIN Pix4Event
ON DailyBlurbs.MainEVID=Pix4Event.MainEVID
WHERE (DailyBlurbs.Date>='$startdate' AND DailyBlurbs.Date<='$enddate')
GROUP BY DailyBlurbs.Blurb
ORDER BY lmngenres.genre, DailyBlurbs.Date" ;
$result=@mysql_query($sql) or die("couldn't execute query.");
$upcoming=@mysql_fetch_array($result);
}
ELSE
{$sql="SELECT  DailyBlurbs.Blurb,lmngenres.genre, DailyBlurbs.Tixandinfo, Pix4Event.PathToThumbs
FROM DailyBlurbs
LEFT JOIN lmngenres
ON DailyBlurbs.lmngenre=lmngenres.lmngenreid
LEFT JOIN Pix4Event
ON DailyBlurbs.MainEVID=Pix4Event.MainEVID
WHERE DailyBlurbs.Date>=CurDate()
GROUP BY DailyBlurbs.Blurb
ORDER BY lmngenres.genre, DailyBlurbs.Date" ;
$result=@mysql_query($sql) or die("couldn't execute query.");
$upcoming=@mysql_fetch_array($result);
}

$chosensize="100";
$genreheader1="foo";


?><table class="centertable" width="360"><?
Do
{// if genreheader changes, print genreheader
    $genreheader=$upcoming["genre"];
        if ($genreheader==$genreheader1)
        {
        echo "<TR><TD class=\"normal\">";
            if ($upcoming["PathToThumbs"])
            {
             $image=$upcoming["PathToThumbs"];
             checkisfile($image, $chosensize);
                 if ($imgvar)
                 {
                      if ($side=="left")
                      {
                      $side="right";
                      }
                      ELSE
                      {
                      $side="left";
                      }
                 echo "<img src=\"".$image."\" align=\"".$side."\" ".$imgvar.">";
                 }
                 ELSE
                 {}
             }
             echo" &#183; ".$upcoming["Blurb"]."</td></tr>";
             If ($upcoming["Tixandinfo"])
             {
             echo "<tr><td class=\"tixandinfo\">Tix and info: ".$upcoming["Tixandinfo"]."</td></tr>";
             }
          }
          ELSE
          {
            echo "<TR><TD class=\"musicstyle\">".$genreheader."</td></tr>";
            echo "<TR><TD class=\"normal\">";
               if ($upcoming["PathToThumbs"])
               {
               $image=$upcoming["PathToThumbs"];
               checkisfile($image, $chosensize);
                    if ($imgvar)
                    {
                         if ($side=="left")
                         {
                         $side="right";
                         }
                         ELSE
                         {
                         $side="left";
                         }
                     echo "<img src=\"".$image."\" align=\"".$side."\" ".$imgvar.">";
                     }
                     ELSE
                     {}
               }
               echo" &#183; ".$upcoming["Blurb"]."</td></tr>";
               If ($upcoming["Tixandinfo"])
               {
                echo "<tr><td class=\"tixandinfo\">Tix and info: ".$upcoming["Tixandinfo"]."</td></tr>";
                 }
    $genreheader1=$genreheader;
    }
}
WHILE ($upcoming=@mysql_fetch_array($result));?>
</table>

