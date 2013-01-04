<?PHP 
function WriteDateSelect($BeginYear = 0, 
                         $EndYear = 0, 
                         $IsPosted = true,
                         $Prefix = '',$thisyear,$thismonth,$thisay)
{
    if (! $BeginYear)
  {
    $BeginYear = date('Y');
  }
		
  if (! $EndYear)
  {
    $EndYear = $BeginYear;
  }
  echo '<select name="', $Prefix, 'Year">
         ';
	
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    echo '<option ';
		
    if ($i == $thisyear)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }
	
  echo '</select>-
        <select name="', $Prefix, 'Month">
          ';	

  for ($i = 1; $i <= 12; $i++)
  {
    echo '<option ';
		
    if ($i == $thismonth)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }

  echo '</select>-
        <select name="', $Prefix, 'Day">
          ';	

  for ($i = 1; $i <= 31; $i++)
  {
    echo '<option ';
		
    if ($i == $thisay)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }

  echo '</select>';
  return;
}
$Year=2007;
$Month=11;
$Day=30;
$thisyear = date("Y"); 
$endyear = $thisyear+5;
$prefix = "event";
WriteDateSelect($thisyear,$endyear,'',$prefix,$Year,$Month,$Day);
?>