<?PHP
class pageLoad{
   var $start;
   var $end;
   
   function pageLoad(){
     $this->start();
   }
   
   function start(){
    $this->start = $this->getTime();
   }
   
   function end(){
     $this->end = $this->getTime();
   }
   
   function getLoadTime($format = '%01.2f'){
     if (empty($this->end) )$this->end();
     return sprintf($format, ($this->end - $this->start));
   }
   
   function getTime(){
    $time = microtime();
$time = explode(' ', $time);
return $time[1] + $time[0]; 
   }
 }
 ?>
