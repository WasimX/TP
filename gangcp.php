<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
include "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'"));

if($fetch->username != $fetch3->owner){
die("<link href='../style.css' rel='stylesheet' type='text/css'>				
<form name='form1' method='post' action=''>
<table width='350' border='1' align='center' class='table'>
<tr align='center' class='header'>
  <td background='Images/Grads/Error.jpg'>Error</td>
</tr>
<tr align='center'>
  <td>Your not the owner of your gang!</td>
</tr>
</table>
</form>");
}

if($fetch->crew == "0"){
die("<link href='../style.css' rel='stylesheet' type='text/css'>				
<form name='form1' method='post' action=''>
<table width='350' border='1' align='center' class='table'>
<tr align='center' class='header'>
  <td background='Images/Grads/Error.jpg'>Error</td>
</tr>
<tr align='center'>
  <td>You are not in a gang!</td>
</tr>
</table>
</form>");
}

$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'"));

echo "$style"; 

$crew = $fetch2->name;

$option = $_GET['option'];

if ($_POST['change_gang']){

$gangpro=addslashes(strip_tags($_POST['gangpro']));

mysqli_query( $connection, "UPDATE crews SET quote=\"$gangpro\" WHERE name=\"$crew\"");

echo "Your gang profile has been changed!";

}
?>

<html>

<head>

<link href="style.css" rel="stylesheet" type="text/css"> 
<style type="text/css">
#tooltip {
	position: absolute;
	z-index: 3000;
	border: 1px solid #333333;
	background-color: #222222;
	color: #FFFFFF;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	padding: 5px;
	opacity: 0.85;
	max-width: 310px;
}
#tooltip h3, #tooltip div { margin: 0; }
#tooltip h3 {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: normal;
}
.bar_cont {
	display: inline-block;
	vertical-align:middle;
}
.bar {
	position: relative;
	width: 150px;
	line-height: 11px;
	border: 1px solid #000;
	color: #000000;
	background: url('images/crimebg/red.jpg');
	background-repeat: repeat-x;
}
.rg {
	position: relative;
	height: 11px;
	background-image: url('images/crimebg/green.jpg');
	background-repeat: repeat-x;
	z-index: 2;
}

.unselected_link {background: url(images/subhead.png) repeat-x; 
	                    padding: 5px 20px 5px 20px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }

.selected_link {background: url(images/selected_box.png) repeat-x;
	                    padding: 5px 20px 5px 20px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }

.menubox {
	text-align: left;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	border: 1px solid #333333;
	background-color: #111111;
	padding: 5px 5px 5px 5px;
}
.menubox a {
	color: #CCCCCC;
	text-decoration: none;
	display: block;
	width: 50px;
}
.menubox .unselected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin: 6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/subhead.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
.menubox .selected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin:	6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/selected_box.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
			
</style>

<script language="JavaScript">

function emoticon(myValue) 

{
var myField = document.getElementById('text');
	//IE support
if (document.selection) {
var temp;
myField.focus();
sel = document.selection.createRange();
temp = sel.text.lenght;
sel.text = myValue;
if (myValue.length == 0) {
sel.moveStart('character', myValue.length);
sel.moveEnd('character', myValue.length);
}else{
sel.moveStart('character', -myValue.length + temp);
}
sel.select();
	}

	//MOZILLA/NETSCAPE support
else if (myField.selectionStart || myField.selectionStart == '0')
{
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue
+ myField.value.substring(endPos, myField.value.length);
myField.focus();
myField.selectionStart = startPos + myValue.length;
myField.selectionEnd = startPos + myValue.length;
}else{
myField.value += myValue;
myField.focus();

	}
}
</script>

</head>

<body>

		<center><table class='menubox' align='center' style='border-radius: 20px; border: 0px;'>
			<tr>
				<td align='center'>				
                                <div style='float:left;'><a href='gang_editprofile.php?option=profile_edit' class='selected_link' style='width: 120px;'><u>Edit Profile</u></a></div>
                                <div style='float:left;'><a href='gang_app.php' class='unselected_link' style='width: 120px;'><u>Applications</u></a></div>
                                <div style='float:left;'><a href='memberscp.php' class='unselected_link' style='width: 120px;'><u>Members</u></a></div>
				<div style='float:left;'><a href='gang_editprofile.php?option=business' class='unselected_link' style='width: 120px;'><u>Business</u></a></div></div>
				<div style='float:left;'><a href='gangprof.php?viewcrew=<?php echo"$fetch->crew"; ?>' class='unselected_link' style='width: 120px;'><u>View Profile</u></a></div>
				</td>
            </tr>
		</table></center>

<td width='25'>&nbsp;</td><td valign="top" width="300">


<?php if ($option == ""){ ?>
<center><table width="200" border="0" class="table1px" cellpadding="2" cellspacing="3">
  <tr>

<td height="30" colspan="2" class="gradient"><div align="center">Gang CP!</div></td>

      </tr>
  <tr>

   

    <td> <div align="center" class="style7">

      <p align="center">Here you can control every part of your gang, from kicking members to even ranking them up to top four. You can use this part of the page to do anything you like to do with your gang. </p>

    </div>    </td>

</td></tr>

	

	</table><br /><br />


<?php }elseif ($option == "profile_edit"){
?>

  <form name="form1" method="post" action="">
<table width="600" align="center" border="0" cellspacing="0" class="table1px">

<tr class="gradient"><td colspan="4">Edit Gang Profile!</td></tr>
<tr>
<td align="center">
<a href='#' onClick="javascript:emoticon(':twisted:')"><img src="images/smilies/twisted.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':roll:')"><img src="images/smilies/rolleyes.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':evil:')"></a> <a href='#' onClick="javascript:emoticon(':twisted:')"></a> <a href='#' onClick="javascript:emoticon(':exclaim:')"><img src="images/smilies/exclaim.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':roll:')"></a><a href='#' onClick="javascript:emoticon(';)')"><img src="images/smilies/wink.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':question:')"><img src="images/smilies/question.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(';)')"></a> <a href='#' onClick="javascript:emoticon(':)')"><img src="images/smilies/smile.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':(')"><img src="http://1.gangsterparadise.co.uk/Images/smilies/icon_sad.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':o')"><img src="images/smilies/surprised.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':eek:')"><img src="images/smilies/eek.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':eek:')"></a> <a href='#' onClick="javascript:emoticon(':idea:')"><img src="images/smilies/idea.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':redface:')"><img src="images/smilies/redface.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':P')"></a> <a href='#' onClick="javascript:emoticon(':cry:')"><img src="images/smilies/cry.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':redface:')"></a> <a href='#' onClick="javascript:emoticon(':evil:')"><img src="images/smilies/evil.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':arrow:')"><img src="images/smilies/arrow.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':mrgreen:')"><http://1.gangsterparadise.co.uk/Images/smilies/icon_mrgreen.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':D')"><img src="images/smilies/biggrin.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':S')"><img src="http://1.gangsterparadise.co.uk/Images/smilies/icon_confused.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':S')"></a> <a href='#' onClick="javascript:emoticon(':cool:')"><img src="images/smilies/cool.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':cool:')"></a> <a href='#' onClick="javascript:emoticon(':lol:')"><img src="images/smilies/lol.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':lol:')"></a> <a href='#' onClick="javascript:emoticon(':mad:')"><img src="images/smilies/mad.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':P')"><img src="images/smilies/razz.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':mad')"></a> </div></td>
              <td width="216" class="tableborder"><div align="center"> <a href="javascript:emoticon('[b]Text[/b]')">Bold</a> - <a href="javascript:emoticon('[u]Text[/u]')">Underline</a> - <a href="javascript:emoticon('[i]Text[/i]')">Italic</a> - <a href="javascript:emoticon('[color=COLOUR HERE]Text[/color]')">Colour</a> <br>
      <a href="javascript:emoticon('[img]IMAGE URL[/img]')">Image</a> - <a href="javascript:emoticon('[url]URL HERE[/url]')">URL</a> - <a href="javascript:emoticon('[user]USERNAME[/user]')">User</a> - <a href="javascript:emoticon('[size=SIZE HERE(1-8)]Text[/size]')">Size</a>
<br>
<textarea name="gangpro" id="text" class='textbox' style='width: 100%; height: 200px'><?php echo "$fetch2->quote"; ?></textarea>  </td>
</tr>
<tr>
<td align="center"><input name="change_gang" class="custombutton" type="submit" id="change_gang" class="custombutton" value="Update"></td>
</tr>
</table></form><br /><br />
<?php } ?>

<?php if ($option == "business"){ ?>
             <table width='400' border='0' cellpadding='0' cellspacing='0' bordercolor=black class='table' align='center'>

              <tr class='header'><td colspan='4'><center>Page Coming Soon</center></td>

              </tr>
</table>
<?php } ?>
</body>
