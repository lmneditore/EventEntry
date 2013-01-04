<?PHP
class dateselect {
function WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$Prefix = '',$EventDate, $thistextcolor)
{
  $BeginYear =(!isset($BeginYear) ? date('Y') : $BeginYear);
  $EndYear=(!isset($EndYear) ? $BeginYear+5 : $EndYear);
  $display .="<select style=\"color:".$thistextcolor."\" name=\"".$Prefix. "Year\" >";
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    $display .="<option>".$i."</option>";
  }
  $display .= "</select>-<select style=\"color:".$thistextcolor."\" name=\"". $Prefix."Month\">";
  for ($i = 1; $i < 13; $i++)
  {
    $display .= "<option>".$i."</option>";
  }
  $display .= "</select>-<select style=\"color:".$thistextcolor."\" name=\"".$Prefix."Day\">";
  for ($i = 0; $i <= 31; $i++)
  {
    $display .= "<option>".$i."</option>";
  }
 $display .="</select>";
 echo $display;
}
}
?>
