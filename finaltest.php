
UPDATE Acts SET ActName='Tim Krekel',MailAddress='123 Pope St.',SecondaryAddress='',City='Louisville',State='KY',PostalCode='40204-2491' WHERE ActID='15405' LIMIT 1<script language="Javascript" TYPE="TEXT/JAVASCRIPT">
pagename= "ActinfoA.php.";
forSecondaryAddress="";
</script>
<style type="text/css">
.formbody
{
background-color: #2f5266;
}
.td1
{
text-align: right;
font-weight: bold;
font-family: arial;
font-size: .8em;
}
.td2
{
text-align: left;
font-weight: bold;
font-size: .8em
}
.td3
{
text-align: center;
font-size: .6em;
font-weight: semi-bold;
font-family: arial, sansserif;
}
.td4
{
text-align: center;
font-size: .6em;
font-weight: semi-bold;
font-family: arial, sansserif;
}
.th
{
background-color: #0F3925; 
color: #ffff66; 
text-align: center; 
font-size: .8em;
text-align:center;
}
</style></head><BODY class="formbody">


		<script language="Javascript" type="Text/Javascript">
function changebgcolor() {
	var allbuttons = document.getElementsByTagName("button")
	for (var i = 0; i < allbuttons.length; i++) {
		allbuttons[i].onmouseover = function() {
			this.style.backgroundColor = '#0F3925'
			this.style.fontWeight='600'
			this.style.color='#ffffcc'
			this.style.fontVariant='small-caps'
		}
		allbuttons[i].onmouseout = function() {
			this.style.backgroundColor = '#0F3925'
			this.style.fontWeight='normal'
			this.style.color='white'
			this.style.fontVariant='normal'
		}
	}
}
window.onload = changebgcolor

</script>
		<title>Louisville Music News.net Main Menu </title>
<link rel="stylesheet" href="http://www.louisvillemusicnews.net/webmanager/classes/lmstyles.css" type="text/css">
</head>

<body bgcolor="#0F3925">

<table valign="top" width="583" align="center" border="1"  bgcolor="#f5e3a1"><tr><td align="center" bgcolor="#c0c0c0" colspan="5" valign="top"><img src="http://www.louisvillemusicnews.net/lmn/lmcomlogogrey.GIF" width="583" align="center"></td></tr><tr><td bgcolor="#0c4a7d" colspan="5"><LINK REL=stylesheet HREF="http://www.louisvillemusicnews.com/LMNStyles.css" TYPE="text/css">

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<title>Louisville Music News.net Menu</title>

<style TYPE="text/css">
#menu a:link {
	color: black;
	background-color: transparent;
	text-decoration: none;
	}
#menu a:active {
	color: #e43d41;
	background-color: transparent;
	text-decoration: none;
	}
#menu a:visited {
	color: #990066;
	background-color:transparent;
	text-decoration: none;
	}
#menu a:hover {
	color: #666666;
	background-color: #96C6E4;
	text-decoration: none;
	}
.menubg {
background-image: url(http://www.louisvillemusicnews.net/lmn/menubtnblue.jpg); width:80px; height:25px; color:#ffffcc; font-size: .6em;
line-height:11pt; bgcolor:#0099D1; text-transform:uppercase; font-stretch:; text-align: center; font-weight:bold; font-family:arial; padding-bottom: 2px; border-style: none;}
</style>
</head>
<table BGCOLOR="#0c4a7d" BORDER="0"><tr>
<span id="menu"><td class="menubg"><a href="<?PHP echo $mainhdr;?>?thisid=2&thismenuid=">Main</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=16&thismenuid=2">News</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=9&thismenuid=3">Calendar</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=31&thismenuid=50">Acts</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=28&thismenuid=60">Directory</a></td></span><span id="menu"><td class="menubg"><a href="http://www.louisvillemusicnews.net/Classified/index.php?thisid=0&thismenuid=70">Classified</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=26&thismenuid=85">Photos</a></td></span><span id="menu"><td class="menubg"><a href="".$mainhdr."?thisid=15&thismenuid=99">Contact Us</a></td></span></td></tr></table>
       </td></tr>
	   <tr><td align="center" width="583" class="eventdate" colspan="5" valign="top" background=\"#0c4a7d\"> 
     Friday, September 12, 2003      </td></tr>
<tr><td valign="top">
    <table valign="top" align="center">
<FORM action="/eventediting/ActinfoA.php" method="GET" name="actinfo">
<th colspan="3" class="th">Updated Act information has been accepted.</th>
<TR><TD class="td1">Act Name :</td><TD class="td2"><input type="text" name="ActName1" value="Tim Krekel"  style="color:blue;" size="10 " onblur="isAlpha(lname1); isEmpty(lname1);" ></td></TR>
<TR><TD class="td1">Mailing Address :</td><TD class="td2"><input type="text" name="MailAddress1" value="123 Pope St."  style="color:blue;" size="12 " onblur="isAlpha(MailAddress1); isEmpty(MailAddress1);"  ></td><TR>

<TR><TD class="td1">Secondary Address:</td><TD class="td2"><input type="text" name="SecondaryAddress1" value=""  style="color:blue;" size="0 " </td><TR>
<TR><TD class="td1">City :</td><TD class="td2"><input type="text" name="City1" value="Louisville"  style="color:blue;" size="10" Louisville onblur="isAlpha(City1); isEmpty(City1);"></td><TR>
<TR><TD class="td1">State :</td><TD class="td2"><SELECT name="State1" size="1" style="color:blue" >
<OPTION value="AK">AK</option>
<OPTION value="AL">AL</option>
<OPTION value="AR">AR</option>
<OPTION value="AZ">AZ</option>
<OPTION value="CA">CA</option>
<OPTION value="CO">CO</option>
<OPTION value="CT">CT</option>
<OPTION value="DC">DC</option>
<OPTION value="DE">DE</option>
<OPTION value="FL">FL</option>
<OPTION value="GA">GA</option>
<OPTION value="IA">IA</option>
<OPTION value="ID">ID</option>
<OPTION value="IL">IL</option>
<OPTION value="IN">IN</option>
<OPTION value="KS">KS</option>
<OPTION value="KY" SELECTED>KY</OPTION>
<OPTION value="LA">LA</option>
<OPTION value="MA">MA</option>
<OPTION value="MD">MD</option>
<OPTION value="ME">ME</option>
<OPTION value="MI">MI</option>
<OPTION value="MN">MN</option>
<OPTION value="MO">MO</option>
<OPTION value="MS">MS</option>
<OPTION value="MT">MT</option>
<OPTION value="NC">NC</option>
<OPTION value="ND">ND</option>
<OPTION value="NE">NE</option>
<OPTION value="NH">NH</option>
<OPTION value="NJ">NJ</option>
<OPTION value="NM">NM</option>
<OPTION value="NV">NV</option>
<OPTION value="NY">NY</option>
<OPTION value="OH">OH</option>
<OPTION value="OK">OK</option>
<OPTION value="OR">OR</option>
<OPTION value="PA">PA</option>
<OPTION value="RI">RI</option>
<OPTION value="SC">SC</option>
<OPTION value="SD">SD</option>
<OPTION value="TN">TN</option>
<OPTION value="TX">TX</option>
<OPTION value="UT">UT</option>
<OPTION value="VA">VA</option>
<OPTION value="VT">VT</option>
<OPTION value="WA">WA</option>
<OPTION value="WI">WI</option>
<OPTION value="WV">WV</option>
<OPTION value="WY">WY</option>
<OPTION value="HI">HI</option>
<OPTION value="AA">AA</OPTION>
</SELECT></td><TR>
<TR><TD class="td1">Zip Code :</td><TD class="td2"><input type="text" name="PostalCode1" value="40204-2491"  style="color:blue;" size="10"  > </td><TR>
 </td></tr><TR><TD colspan="2" align="Center">
		

</head>
<table width="140" align="center" border="1"><TH colspan="5" class="th">Phone Numbers</th>
<tr><Td class="td3" width="12" align="right">Number</td><td class="td3" width="8">Type</td><TD class="td3" width="10">Location</td><TD class="td4" width="12">Public</td></tr>
<!-- Phones -->			<input type="hidden" name="t_0act_phoneid" value="2">
			<input type="hidden" name="t_0act_phonenumber" value="502-551-7602">
			<tr><Td class="td1" >
			<input type="text" name="t_0act_phonenumber1" value="502-551-7602" size="14" style="color:;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="t_0act_phonetype" value="1">
			<SELECT name="t_0act_phonetype1" style="size: 1; width: 5 em; color:;" >
<OPTION value="1" SELECTED>Voice</OPTION>
<OPTION value="2">Fax</option>
<OPTION value="3">Cell</option>
<OPTION value="4">Concert</option>
<OPTION value="5">Information</option>
<OPTION value="6">Toll-Free</option>
<OPTION value="7">Pager</option>
</SELECT>			</td><td class="td2" align="left">
		<input type="hidden" name="t_0act_location" value="Home">
			<select name="t_0act_location1" size="1" style="color: ;" >
			<option value="Home" >Home</option><option value="Office" >Office</option><option value="Individual" >Individual</option><option value="Other" >Other</option></select></td>
				<TD class="td4">
				<input type="hidden" name="t_0act_public" value="">
<input type="checkbox" name="t_0act_public1" ></td></tr>
			<input type="hidden" name="t_1act_phoneid" value="">
			<input type="hidden" name="t_1act_phonenumber" value="">
			<tr><Td class="td1" >
			<input type="text" name="t_1act_phonenumber1" value="" size="14" style="color:;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="t_1act_phonetype" value="1">
			<SELECT name="t_1act_phonetype1" style="size: 1; width: 5 em; color:;" >
<OPTION value="1" SELECTED>Voice</OPTION>
<OPTION value="2">Fax</option>
<OPTION value="3">Cell</option>
<OPTION value="4">Concert</option>
<OPTION value="5">Information</option>
<OPTION value="6">Toll-Free</option>
<OPTION value="7">Pager</option>
</SELECT>			</td><td class="td2" align="left">
		<input type="hidden" name="t_1act_location" value="Home">
			<select name="t_1act_location1" size="1" style="color: ;" >
			<option value="Home" >Home</option><option value="Office" >Office</option><option value="Individual" >Individual</option><option value="Other" >Other</option></select></td>
				<TD class="td4">
				<input type="hidden" name="t_1act_public" value="">
<input type="checkbox" name="t_1act_public1" ></td></tr>
			<input type="hidden" name="t_2act_phoneid" value="">
			<input type="hidden" name="t_2act_phonenumber" value="">
			<tr><Td class="td1" >
			<input type="text" name="t_2act_phonenumber1" value="" size="14" style="color:;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="t_2act_phonetype" value="2">
			<SELECT name="t_2act_phonetype1" style="size: 1; width: 5 em; color:;" >
<OPTION value="1">Voice</option>
<OPTION value="2" SELECTED>Fax</OPTION>
<OPTION value="3">Cell</option>
<OPTION value="4">Concert</option>
<OPTION value="5">Information</option>
<OPTION value="6">Toll-Free</option>
<OPTION value="7">Pager</option>
</SELECT>			</td><td class="td2" align="left">
		<input type="hidden" name="t_2act_location" value="Home">
			<select name="t_2act_location1" size="1" style="color: ;" >
			<option value="Home" >Home</option><option value="Office" >Office</option><option value="Individual" >Individual</option><option value="Other" >Other</option></select></td>
				<TD class="td4">
				<input type="hidden" name="t_2act_public" value="">
<input type="checkbox" name="t_2act_public1" ></td></tr>
			<input type="hidden" name="t_3act_phoneid" value="">
			<input type="hidden" name="t_3act_phonenumber" value="">
			<tr><Td class="td1" >
			<input type="text" name="t_3act_phonenumber1" value="" size="14" style="color:;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="t_3act_phonetype" value="3">
			<SELECT name="t_3act_phonetype1" style="size: 1; width: 5 em; color:;" >
<OPTION value="1">Voice</option>
<OPTION value="2">Fax</option>
<OPTION value="3" SELECTED>Cell</OPTION>
<OPTION value="4">Concert</option>
<OPTION value="5">Information</option>
<OPTION value="6">Toll-Free</option>
<OPTION value="7">Pager</option>
</SELECT>			</td><td class="td2" align="left">
		<input type="hidden" name="t_3act_location" value="Home">
			<select name="t_3act_location1" size="1" style="color: ;" >
			<option value="Home" >Home</option><option value="Office" >Office</option><option value="Individual" >Individual</option><option value="Other" >Other</option></select></td>
				<TD class="td4">
				<input type="hidden" name="t_3act_public" value="">
<input type="checkbox" name="t_3act_public1" ></td></tr>
			<input type="hidden" name="t_4act_phoneid" value="">
			<input type="hidden" name="t_4act_phonenumber" value="">
			<tr><Td class="td1" >
			<input type="text" name="t_4act_phonenumber1" value="" size="14" style="color:;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="t_4act_phonetype" value="7">
			<SELECT name="t_4act_phonetype1" style="size: 1; width: 5 em; color:;" >
<OPTION value="1">Voice</option>
<OPTION value="2">Fax</option>
<OPTION value="3">Cell</option>
<OPTION value="4">Concert</option>
<OPTION value="5">Information</option>
<OPTION value="6">Toll-Free</option>
<OPTION value="7" SELECTED>Pager</OPTION>
</SELECT>			</td><td class="td2" align="left">
		<input type="hidden" name="t_4act_location" value="Home">
			<select name="t_4act_location1" size="1" style="color: ;" >
			<option value="Home" >Home</option><option value="Office" >Office</option><option value="Individual" >Individual</option><option value="Other" >Other</option></select></td>
				<TD class="td4">
				<input type="hidden" name="t_4act_public" value="">
<input type="checkbox" name="t_4act_public1" ></td></tr>
</table>
				</td></tr><TR><TD colspan=\"2\" align=\"Center\">

</head>
<table width="140" align="center" border="1"><TH colspan="5" class="th">Act Websites</th>
<tr><Td class="td3" width="12" align="right">URL</td><td class="td3" width="12">Type</td></tr>
<!-- links --><input type="hidden" name="l_0act_link_url" value="">
<input type="hidden" name="l_0act_link_id" value=""><tr><Td class="td1" >
<input type="text" name="l_0act_link_url1" value="" size="" style="color:;" onBlur=return validatelink(this)></td><td class="td2">
			<input type="hidden" name="l_0act_link_categoriesid" value="">
			<SELECT name="l_0act_link_categoriesid1" style="size: 1; color:; width: "8";" >
<OPTION value="1">Home Page
<OPTION value="2">Personal
<OPTION value="3">Business Main Page
<OPTION value="4" SELECTED>Act Main Page
<OPTION value="5">Links Page
<OPTION value="6">Record Company Page
<OPTION value="7">Act Record Company Page
<OPTION value="8">Music File
<OPTION value="9">Act Music File
</SELECT>			</td></tr>
			<!--
		<input type="hidden" name="l_0act_link_title" value="">
			<input type="text" name="l_0act_link_title1" size="" style="color: ;" value=""></td>-->
<!--
				<tr><TD class="td4" colspan="3">
				<input type="hidden" name="l_0act_link_description" value="">
				Description: <input type="text" name="l_0act_link_description1" size="" style="color: ;" value=""></td><tr> -->

<input type="hidden" name="l_1act_link_url" value="">
<input type="hidden" name="l_1act_link_id" value=""><tr><Td class="td1" >
<input type="text" name="l_1act_link_url1" value="" size="" style="color:;" onBlur=return validatelink(this)></td><td class="td2">
			<input type="hidden" name="l_1act_link_categoriesid" value="">
			<SELECT name="l_1act_link_categoriesid1" style="size: 1; color:; width: "8";" >
<OPTION value="1">Home Page
<OPTION value="2">Personal
<OPTION value="3">Business Main Page
<OPTION value="4">Act Main Page
<OPTION value="5">Links Page
<OPTION value="6">Record Company Page
<OPTION value="7" SELECTED>Act Record Company Page
<OPTION value="8">Music File
<OPTION value="9">Act Music File
</SELECT>			</td></tr>
			<!--
		<input type="hidden" name="l_1act_link_title" value="">
			<input type="text" name="l_1act_link_title1" size="" style="color: ;" value=""></td>-->
<!--
				<tr><TD class="td4" colspan="3">
				<input type="hidden" name="l_1act_link_description" value="">
				Description: <input type="text" name="l_1act_link_description1" size="" style="color: ;" value=""></td><tr> -->

<input type="hidden" name="l_2act_link_url" value="">
<input type="hidden" name="l_2act_link_id" value=""><tr><Td class="td1" >
<input type="text" name="l_2act_link_url1" value="" size="" style="color:;" onBlur=return validatelink(this)></td><td class="td2">
			<input type="hidden" name="l_2act_link_categoriesid" value="">
			<SELECT name="l_2act_link_categoriesid1" style="size: 1; color:; width: "8";" >
<OPTION value="1">Home Page
<OPTION value="2">Personal
<OPTION value="3">Business Main Page
<OPTION value="4">Act Main Page
<OPTION value="5">Links Page
<OPTION value="6">Record Company Page
<OPTION value="7">Act Record Company Page
<OPTION value="8">Music File
<OPTION value="9" SELECTED>Act Music File
</SELECT>			</td></tr>
			<!--
		<input type="hidden" name="l_2act_link_title" value="">
			<input type="text" name="l_2act_link_title1" size="" style="color: ;" value=""></td>-->
<!--
				<tr><TD class="td4" colspan="3">
				<input type="hidden" name="l_2act_link_description" value="">
				Description: <input type="text" name="l_2act_link_description1" size="" style="color: ;" value=""></td><tr> -->

</table>
</form>
		 <tr><td align="center" colspan="3">
		<style>.$buttons->lmnbutton{font-size: .9em;background-color: #0F3925;color: white;font-weight: normal;font-family: Arial;border-bottom: medium ridge #bdd7c8;border-right-width: medium;border-left-width: thin;border-top-width: thin;}</style><button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" class="$buttons->lmnbutton" name="Submit" >Log Out</button>&nbsp;&nbsp;<style>.$buttons->lmnbutton{font-size: .9em;background-color: #0F3925;color: white;font-weight: normal;font-family: Arial;border-bottom: medium ridge #bdd7c8;border-right-width: medium;border-left-width: thin;border-top-width: thin;}</style><button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/membersonly.php'" class="$buttons->lmnbutton" name="" >Members Page</button>
		

