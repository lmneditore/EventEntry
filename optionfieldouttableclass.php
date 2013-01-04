<?
function optionfield_outtable($fieldname, $outtable,$selvalue, $emptyvalue)
{

    $cnxn=new lm_netconnection ;
   
    $cnxn->lm_connection($outtable);
		if (!$selvalue)
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1 ORDER BY $fieldname";
		$outtableresult=@mysql_query($sqlouttable) OR DIE ("Can't open the $outtable table");
		}
		ELSE
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1";
		$outtableresult=@mysql_query($sqlouttable) OR DIE ("Can't open the $outtable.");
		}
	$outtablelist=@mysql_fetch_array($outtableresult);
		DO
		{$thisfieldname=$outtablelist[$fieldname];
			if ($thisfieldname==$emptyvalue)
			{
			printf ("<OPTION value=\"%s\">%s</OPTION>\n",$outtablelist[$fieldname],$outtablelist[$fieldname]);
			}
			ELSEIF ($thisfieldname==$selvalue)
			{
			printf ("<OPTION value=\"%s\" SELECTED>%s</OPTION>\n",$outtablelist[$fieldname],$outtablelist[$fieldname]);
			}
			ELSE 
			{
			printf ("<OPTION value=\"%s\">%s</option>\n",$outtablelist[$fieldname], $outtablelist[$fieldname]);
			}
		}
		WHILE ($outtablelist=@mysql_fetch_array($outtableresult));
		@mysql_close();
		echo "</SELECT>";
	}// END OF Outfieldoption
    ?>
