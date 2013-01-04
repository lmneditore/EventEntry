<? 
/*
** FileName: userdataclass.php
** Description: A Class to store, update and retrieve user data
** Version: 1.0
** Created: 4/13/2004
** Author: Paul Moffett
** Email: editor@louisvillemusicnews.net
** Copyright: 2004 By Louisville Music.com
** Class Documentations
** Class: 
** description: 
** Input: 
** Output:
*/
class userdata {
private $password; 
var $user_id;
var $user_name;
var $email;
var $password;
var $lname;
var $fname;
var $mname;
var $preferred;
var $gender;
var $professional_name;
var $title;
var $residence_address;
var $secondary_address;
var $city;
var $state;
var $postal_code;
var $dateofbirth;
var $dateofdeath;
var $recorddate;
var $country;
var $ip;
var $member_date;
var $lastup_date;
var $status;

function getuserdata ($user_id)
{
	include ("../inks/LMhdrw.inc");
	$usql="SELECT * FROM persons WHERE user_id='{$user_id}'";
	$result=@mysql_query($usql);
	$user=@mysql_fetch_array($result);
	$numfields=@mysql_num_rows($result);
	Do 
	{
		for ($i=0; $i<$numfields; $i++) 
		{
		$fieldname= mysql_field_name($result, $i);
		$this->$fieldname=$user[$fieldname];
		}
	}
	WHILE ($user=@mysql_fetch_array($result));
}

}

?>