<? function optionfield_outtable($keyfieldname, $valfieldname, $outtable,$selvalue, $emptyvalue, $connection )
{
include ($connection);
	if (!$selvalue)
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1 ORDER BY $valfieldname";
		$outtableresult=@mysql_query($sqlouttable,$connection4) OR DIE ("Can't open the $outtable table");
		}
		ELSE
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1";
		$outtableresult=@mysql_query($sqlouttable,$connection4) OR DIE ("Can't open the $outtable.");
		}
	$outtablelist=@mysql_fetch_array($outtableresult);
		DO
		{$thisfieldname=$outtablelist[$keyfieldname];
			if ($thisfieldname==$emptyvalue)
			{
			printf ("<OPTION value=\"%s\">%s</OPTION>\n",$outtablelist[$fieldname],$outtablelist[$fieldname]);
			}
			ELSEIF ($thisfieldname==$selvalue)
			{
			printf ("<OPTION value=\"%s\" SELECTED>%s</OPTION>\n",$outtablelist[$keyfieldname],$outtablelist[$valfieldname]);
			}
			ELSE 
			{
			printf ("<OPTION value=\"%s\">%s</option>\n",$outtablelist[$keyfieldname], $outtablelist[$valfieldname]);
			}
		}
		WHILE ($outtablelist=@mysql_fetch_array($outtableresult));
		@mysql_close();
		}// END OF Outfieldoption
	?>