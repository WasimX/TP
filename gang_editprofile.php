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

echo "<div class=success>Your gang profile quote has been changed!";

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
<table width="600" align="center" border="0" cellspacing="0" class="table">

<tr class="header"><td colspan="4">Gang Profile Preview!</td></tr>

	

	<tr><td><?php if (!$fetch2->quote){ echo "<center><i>Your gang profile contains no information!"; }else{ echo "".replace($fetch2->quote).""; } ?></td></tr>

	

	</table><br /><br />


<?php }elseif ($option == "profile_edit"){
?>

  <form name="form1" method="post" action="">
<table width="600" align="center" border="0" cellspacing="0" class="table1px">

<tr class="gradient"><td colspan="4">Edit Gang Profile!</td></tr>
<tr>
<td align="center">
<a href="javascript:emoticon(':D')"><img src="Smiles/icon_biggrin.gif" width="15" height="15" border="0"></a>
<a href="javascript:emoticon(':sleep:')"><img src="Smiles/sleep.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':)')"><img src="Smiles/icon_smile.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':(')"><img src="Smiles/icon_sad.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':o')"><img src="Smiles/icon_surprised.gif" width="15" height="15" border="0"></a>
<a href="javascript:emoticon(':S')"><img src="Smiles/icon_confused.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':P')"><img src="Smiles/icon_razz.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':cry:')"><img src="Smiles/icon_cry.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(';)')"><img src="Smiles/icon_wink.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':mad:')"><img src="Smiles/icon_mad.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':lol:')"><img src="Smiles/icon_lol.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':cool:')"><img src="Smiles/icon_cool.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':evil:')"><img src="Smiles/icon_evil.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':roll:')"><img src="Smiles/icon_rolleyes.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':eek:')"><img src="Smiles/icon_eek.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':redface:')"><img src="Smiles/icon_redface.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':arrow:')"><img src="Smiles/icon_arrow.gif" width="15" height="15" border="0"></a>  
<a href="javascript:emoticon(':twisted:')"><img src="Smiles/icon_twisted.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':?:')"><img src="Smiles/icon_question.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':idea:')"><img src="Smiles/icon_idea.gif" width="15" height="15" border="0"></a>
<a href="javascript:emoticon(':mrgreen:')"><img src="Smiles/icon_mrgreen.gif" width="15" height="15" border="0"></a> 
<a href="javascript:emoticon(':o')"><img src="Smiles/icon_surprised.gif" width="15" height="15" border="0"></a>
    <br>
<a href="javascript:emoticon('[img]Image URL[/img]')"><b>Image</b></a>
|<a href="javascript:emoticon('[color=COLOUR]Text[/color]')"><b>Colour</b></a>
|<a href="javascript:emoticon('[size=(1-8)]Text[/size]')"><b>Size</b></a>
|<a href="javascript:emoticon('[b]Text[/b]')"><b>Bold</b></a>   
|<a href="javascript:emoticon('[marquee]Text[/marquee]')"><b>Marquee</b></a>
|<a href="javascript:emoticon('[u]Text[/u]')"><b>Underline</b></a>
|<a href="javascript:emoticon('[i]Text[/i]')"><b>Italic</b></a>
|<a href="javascript:emoticon('[youtube]Video ID[/youtube]')"><b>Youtube</b></a>
|<a href="javascript:emoticon('[user]Username[/user]')"><b>User</b></a>
|<a href="javascript:emoticon('[url=http://URL HERE]Text[/url]')"><b>URL</b></a>
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
