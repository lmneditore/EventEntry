	function isEmpty(textinput)
{
if((textinput.value == null) || (textinput.value.length == 0))
	{
	message="This is a required field and cannot be left blank";
	alert(message)
	textinput.focus();
	return false;  
	}
	else
	{
	return true;
	}
}
	function checkfieldlength(field1,lmin,lmax)
{
    if(field1.value.length<lmin || field1.value.length>lmax)
    {    
	var lenmin=lmin;
	var lenmax=lmax; 
	message="This field must have more than "+lenmin+" and fewer than "+lmax+" characters.";
          alert(message);
         field1.focus();
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
{   return ( ((c >= "a") && (c <= "z")) || ((c >= "A") && (c <= "Z")) || (c=="\'"))
}
function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}
function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}

 function isAlphanumeric(field2)
{   var i;
fieldname=field2;
field2=field2.value;
    for (i = 0; i < field2.length; i++)
    {   
   // Check that current character is number or letter.
     var c = field.charAt(i);
	      if (! (isLetterOrDigit(c) ) )
		  {
//		  m="Only numbers and letters are permitted in this field.";
          alert("Only numbers and letters are permitted in this field");
	           return false;     
      field2.focus();

			   }
			   else
			   {
			   return true;
			   }
    }
// All characters are letters.
 }
 
  function isAlpha(field3)
{   var i;
var fieldname=field3;

    for (i = 0; i < field3.length; i++)
    {   
   // Check that current character is a letter.
     var c = field3.charAt(i);
	      if (! (isLetter(c) ) )
		  {
		  message="Only letters are permitted in this field.";
         alert(message)
  		field3.focus();
	  	return false;
	  	}
		else
		{
		return true;
		}
    }

// All characters are letters.
 }
function validatePHONE(field) {
var valid = "0123456789-";
var hyphencount = 0;
var temp ="";
fieldname=field;
field=field.value;
for (var i=0; i < field.length; i++) {
temp = "" + field.substring(i, i+1);
if (temp == "-") hyphencount++;
if (valid.indexOf(temp) == "-1") {
alert("There are invalid characters in your telephone.  Please try again.");
fieldname.focus();
fieldname.value="" ;
return false;
}
}
if ((hyphencount > 2) || ((field.length==12) && ""+field.charAt(4)!="-" && ""+ field.charAt(8)!="-")) {
alert("The hyphen character should be used with a properly formatted telephone number, e.g., 555-222-1111. Please try again.");
fieldname.focus();
fieldname.value="";

return false;
   }
   if ((fieldname.value.length<12) && (fieldname.value.length>0)) {
alert("You have entered too few numbers. Please enter your complete telephone number, including the area code. Use digits and hyphens only.");
fieldname.focus();
fieldname.value="" ;
return false;
	}
   if (fieldname.value.length>12) {
alert("You have entered too many numbers. Please enter your complete telephone number, including the area code. Use digits and hyphens only.");
fieldname.focus();
fieldname.value="" ;
return false;
	}

return true;
}
pagename= "personinfo.php.";
formname="person";
<? include("../inks/lmnformvalidation.js");?>
function checkInput(element) {
  if (element.value == "") {
    alert("This is a required field!");
	fieldname.focus();
  }
}



