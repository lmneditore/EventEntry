<?PHP 

echo "<select name=\"thisstatus1\" size=\"3\">";
  $statuses = array ("DI" => "Display",
                        "PE" => "Pending",
                        "DE"  => "Delete");
  while (list ($key, $value) = each ($statuses))
    {
	if ($key==$thisstatus)
	{?>
<option style="color:<?PHP echo $textcolorstatus; ?>  value="<?PHP echo $key; ?>" SELECTED><?PHP echo $value; ?></option><?PHP 
	}
	ELSE
	{
	e?>
<option style="color:<?PHP echo $textcolorstatus; ?>"  value="<?PHP echo $key; ?>"><?PHP echo $value; ?></option><?PHP 

    }
}
echo" </select>";

?>