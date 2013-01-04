<?PHP 
class newrecord {
var $tablename;
var $connection;
var $newrecordid;
	function newtablerecord ($tablename,$database) 
	{
	
        $cnxn=new lm_netconnection();
        $cnxn->lm_connection($database);
	$sql="SELECT * FROM ".$tablename." LIMIT 1";// Get a record to analyze
	$result=@mysql_query($sql) or die ("Unable to complete {$sql} query");
	$thisrec=@mysql_fetch_array($result);
	$numfields=@mysql_num_fields($result);
		//Loop through fields and determine if there is a an autonumber field and primary key
		Do 
		{
				for ($i=0; $i < $numfields; $i++) //%loop through fields & identify primary - auto_increment & unique_key 
				{
				$fieldname = mysql_field_name($result, $i);
				$flags = mysql_field_flags($result, $i);
					if(strpos($flags,"auto_increment")>0)
					{
					$autofield=$fieldname;
					$autopos=$i;
					}
					ELSE
					{
					}
					IF (strpos($flags,"primary_key")>0)
					{
					$primaryfield=$fieldname;
					$primarypos=$i;
					}
					ELSE
					{
					}
					IF (strpos($flags,"unique_key")>0)
					{
					$uniquefield=$fieldname;
					$uniquepos=$i;
					}
					ELSE
					{
					}
				}
			}
		WHILE ($thisrec=@mysql_fetch_array($result));
	if ($autofield==$primaryfield)
	{
	$autofield="";
	}
	//%if the table does not have an auto_increment field, find maxid in table
	if (!$autofield)
	{
		if (!$primaryfield) 
		{
		echo "This table is malformed - there is not an autofield or primarykey field";
		}
		ELSE // There is an primaryfield that is not autonumbers. Find the Maximum ID & create a new record
		{
		$msql="SELECT max({$primaryfield}) AS maxid FROM {$tablename}";
		$findmaxid=@mysql_query($msql);
		$reqs=@mysql_fetch_array($findmaxid);
		$newid=$reqs["maxid"]+1;
			$newrecstring="INSERT INTO {$tablename} Values ("; 
			for ($j=0; $j<$numfields; $j++) 
			{
				if ($j==$primarypos)
				{
				$newrecstring .="'{$newid}',";
				}
				ELSE
				{
				$newrecstring .="'',";
				}
			}
		$len=strlen($newrecstring)-1;
		$newrecstring=substr(trim($newrecstring),0,$len);
		$newrecstring .= " )";
		$result=@mysql_query($newrecstring) OR DIE ("Unable to complete {$newrecstring} at line 77");
		$this->newrecordid=$newid;
		}
	}
	ELSE //%there is an autonumbered field
	{
			$newrecstring="INSERT into {$tablename} VALUES (";
			for ($i=0; $i<($numfields); $i++) 
			{
			$values .="'', ";
			}
			$newrecstring .=$values;
			$len=strlen($newrecstring)-2;
			$newrecstring=substr(trim($newrecstring),0,$len);
			$newrecstring .= " )";
			$newrecord=@mysql_query($newrecstring);
			// Get the id for the new empty record
			$lastid=mysql_insert_id();
			$this->newrecordid=$lastid;
	}
	mysql_close();
	}//%end of constructor 
}//End of class definition
?>