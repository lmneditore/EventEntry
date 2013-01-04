	function isEmpty(field)
{ 
if((field.value == null) || (field.length == 0))
	{
	message="This is a required field and cannot be left blank";
	alert(message);
	field.focus;
	return false;  
	}
	else
	{
	return true;
	}
}
	function checkfieldlength(field,lmin,lmax)
{
    if(field.value.length<lmin || field.value.length>lmax)
    {    
	var lenmin=lmin;
	var lenmax=lmax; 
	message="This field must have more than "+lenmin+" and fewer than "+lmax+" characters.";
          alert(message);
         field.focus();
         return false;     
     }
    else
    {
         return true;     
     }
	 
}
	//    if (isEmpty(field)) 
//       if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
//       else return (isAlphanumeric.arguments[1] == true);
    // Search through string's characters one by one
    // until we find a non-alphanumeric character.
    // When we do, return false; if we don't, return true.
	function isLetter(c)
{   return ( ((c >= "a") && (c <= "z")) || ((c >= "A") && (c <= "Z")) )
}
function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}
function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}

 function isAlphanumeric(field)
{   var i;
thisfield=field;
field=field.value;
    for (i = 0; i < field.length; i++)
    {   
   // Check that current character is number or letter.
     var c = field.charAt(i);
	      if (! (isLetterOrDigit(c) ) )
		  {
//		  m="Only numbers and letters are permitted in this field.";
          alert("Only letters are permitted in this field");
      thisfield.focus();
	           return false;     
			   }
			   else
			   {
			   return true;
			   }
    }
// All characters are letters.
 }
 
  function isAlpha(field)
{   var i;
thisfield=field;
field=field.value;
    for (i = 0; i < field.length; i++)
    {   
   // Check that current character is a letter.
     var c = field.charAt(i);
	      if (! (isLetter(c) ) )
//		  m="Only numbers and letters are permitted in this field.";
          alert("Only letters are permitted in this field");
      thisfield.focus();
    }
// All characters are letters.
 }
 
 
 function badwords(field)
 {
<!--BEGIN WORD FILTER JAVASCRIPT--> 
// Word Filter 2.0 
// (c) 2002 Premshree Pillai 
// Created : 29 September 2002 
// http://www.qiksearch.com 
// http://javascript.qik.cjb.net 

var swear_words_arr=new Array("shit","fuck","fuk","piss","cunt","asshole","motherfucker","muthafuka","shithead","cock","blowjob","screw","cocksucker","tit","ass","asshole","puss","sex","s*h*i*t","f*u*c*k"); 
var swear_alert_arr=new Array(); 
var swear_alert_count=0; 

function reset_alert_count() 
{ 
swear_alert_count=0; 
} 

function wordFilter(form,fields) 
{ 
reset_alert_count(); 
var compare_text; 
var fieldErrArr=new Array(); 
var fieldErrIndex=0; 
for(var i=0; i<fields.length; i++) 
{ 
eval('compare_text=document.' + form + '.' + fields[i] + '.value;'); 
for(var j=0; j<swear_words_arr.length; j++) 
{ 
for(var k=0; k<(compare_text.length); k++) 
{ 
if(swear_words_arr[j]==compare_text.substring(k,(k+swear_words_arr[j].length)).toLowerCase()) 
{ 
swear_alert_arr[swear_alert_count]=compare_text.substring(k,(k+swear_words_arr[j].length)); 
swear_alert_count++; 
fieldErrArr[fieldErrIndex]=i; 
fieldErrIndex++; 
} 
} 
} 
} 
var alert_text=""; 
for(var k=1; k<=swear_alert_count; k++) 
{ 
alert_text+="\n" + "(" + k + ") " + swear_alert_arr[k-1]; 
eval('compare_text=document.' + form + '.' + fields[fieldErrArr[0]] + '.focus();'); 
eval('compare_text=document.' + form + '.' + fields[fieldErrArr[0]] + '.select();'); 
} 
if(swear_alert_count>0) 
{ 
alert("The form cannot be submitted.\nThe following illegal words were found:\n_______________________________\n" + alert_text + "\n_______________________________"); 
return false; 
} 
else 
{ 
return true; 
} 
} 
}
</script> 

