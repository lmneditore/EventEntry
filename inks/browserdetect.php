<?php
class css_browser_set {
var $BROWSER_AGENT, $BROWSER_VER, $BROWSER_PLATFORM;
var $font_size, $font_smaller, $font_smallest;

function css_browser_set ()
{
unset ($BROWSER_AGENT);
unset ($BROWSER_VER);
unset ($BROWSER_PLATFORM);

function browser_get_agent () {
  global $BROWSER_AGENT;
  return $BROWSER_AGENT;
}

function browser_get_version() {
  global $BROWSER_VER;
  return $BROWSER_VER;
}

function browser_get_platform() {
  global $BROWSER_PLATFORM;
  return $BROWSER_PLATFORM;
}

function browser_is_mac() {
  if (browser_get_platform()=='Mac') {
    return true;
  } else {
    return false;
  }
}

function browser_is_windows() {
  if (browser_get_platform()=='Win') {
    return true;
  } else {
    return false;
  }
}

function browser_is_ie() {
  if (browser_get_agent()=='IE') {
    return true;
  } else {
    return false;
  }
}

function browser_is_netscape() {
  if (browser_get_agent()=='MOZILLA') {
    return true;
  } else {
    return false;
  }
}
/*
  Determine browser and version
*/
if (ereg( 'MSIE ([0-9].[0-9]{1,2})',$_SERVER['HTTP_USER_AGENT'],$log_version)) {
  $this->BROWSER_VER=$log_version[1];
  $this->BROWSER_AGENT='IE';
} elseif (ereg( 'Opera ([0-9].[0-9]{1,2})',$_SERVER['HTTP_USER_AGENT'],$log_version)) {
  $this->BROWSER_VER=$log_version[1];
  $this->BROWSER_AGENT='OPERA';
} elseif (ereg( 'Mozilla/([0-9].[0-9]{1,2})',$_SERVER['HTTP_USER_AGENT'],$log_version)) {
  $this->BROWSER_VER=$log_version[1];
  $this->BROWSER_AGENT='MOZILLA';
} else {
  $this->BROWSER_VER=0;
  $this->BROWSER_AGENT='OTHER';
}

/*
  Determine platform
*/

if (strstr($_SERVER['HTTP_USER_AGENT'],'Win')) {
  $this->BROWSER_PLATFORM='Win';
} else if (strstr($_SERVER['HTTP_USER_AGENT'],'Mac')) {
  $this->BROWSER_PLATFORM='Mac';
} else if (strstr($_SERVER['HTTP_USER_AGENT'],'Linux')) {
  $this->BROWSER_PLATFORM='Linux';
} else if (strstr($_SERVER['HTTP_USER_AGENT'],'Unix')) {
  $this->BROWSER_PLATFORM='Unix';
} else {
  $this->BROWSER_PLATFORM='Other';
}

  //determine font for this platform
  if (browser_is_windows() && browser_is_ie()) {

    //ie needs smaller fonts than anyone else
    $this->font_size='x-small';
    $this->font_smaller='xx-small';
    $this->font_smallest='7pt';

  } else if (browser_is_windows()) {

    //netscape or "other" on wintel
    $this->font_size='small';
    $this->font_smaller='x-small';
    $this->font_smallest='x-small';

  } else if (browser_is_mac()){

    //mac users need bigger fonts
    $this->font_size='medium';
    $this->font_smaller='small';
    $this->font_smallest='x-small';

  } else {

    //linux and other users
    $this->font_size='small';
    $this->font_smaller='x-small';
    $this->font_smallest='x-small';
	}
}//end of constructor
/*
//debug code
echo "\n\nAgent: $_SERVER['HTTP_USER_AGENT']";
echo "\nIE: ".browser_is_ie();
echo "\nMac: ".browser_is_mac();
echo "\nWindows: ".browser_is_windows();
echo "\nPlatform: ".browser_get_platform();
echo "\nVersion: ".browser_get_version();
echo "\nAgent: ".browser_get_agent();
*/
	
}// end of class definition
?>