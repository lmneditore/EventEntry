<?PHP
include("louisvillemusic_netcnxn.php");
$cnxn=new lm_netconnection;
	$cnxn->lm_connection("louisvil_louisvillemusic2");
include ("library.php");

$library=new library();
$library-> agerestriction($thisagecode,$agecodetext)  ;

?>
