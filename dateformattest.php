<?PHP 
function WriteDateSelect($BeginYear = 0, 
                         $EndYear = 0, 
                         $IsPosted = true,
                         $Prefix = '',$thisdate, $thistextcolor)
{
$thisyear=substr($thisdate,0,4);
$thismonth=substr($thisdate,5,2);
$thisday=substr($thisdate,8,2);

    if (! $BeginYear)
  {
    $BeginYear = date('Y');
  }
		
  if (! $EndYear)
  {
    $EndYear = $BeginYear;
  }
  
  echo "<select style=\"color:".$thistextcolor."\" name=\"".$Prefix. "Year\" >";
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    echo "<option ";
		
    if ($i == $thisyear)
      { echo "SELECTED";
	  }
	  Else
	  {
	  }
    echo " value=\"".$i."\">".$i."</option>";
  }
	
  echo "</select>-<select style=\"color:".$thistextcolor."\" name=\"". $Prefix."Month\" >";
  for ($i = 1; $i <= 12; $i++)
  {
    echo "<option";
    if ($i == $thismonth)
      {echo " SELECTED";
	  }
	  ELSE
	  {}
    echo " value=\"".$i."\">".$i. "</option>";
	 }
  echo "</select>-<select style=\"color:".$thistextcolor."\" name=\"".$Prefix."Day\">";
  for ($i = 1; $i <= 31; $i++)
  {
    echo "<option ";
		
    if ($i == $thisday)
      {echo " SELECTED";}
		ELSE{}
    echo " value=\"".$i."\">".$i."</option>";
  }

  echo "</select>";
  return;
}
$thisdate="2004-10-20";

writedateselect(2003,2008,'','event','2003-12-31','Red');

Echo $BeginYear;
echo $thisyear;

?>
<FORM>
<select name="Test" size="3">
	<option value="1" SELECTED>1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select></form>
