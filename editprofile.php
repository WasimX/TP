<?php session_start();

include_once "incfiles/connectdb.php";

include_once"incfiles/func.php";

logincheck();

$username=$_SESSION['username'];

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$fetch=mysqli_fetch_object($query);

$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$user=mysqli_fetch_object($query1);





if (($_POST['change_quote']) && ($_POST['content'])){
$quote=addslashes(strip_tags($_POST['content']));

$strip = "/^[<>,'\"^-]+$/";

if(preg_match($strip,$quote)){ 
echo "The profile content entered contains invalid characters.<br><br>This may involve: /^,'\"-";
}else{

mysqli_query( $connection, "UPDATE accounts SET quote=\"$quote\", proedited=NOW() WHERE username=\"$username\"");
echo "Your profile has been updated.";

$nickname = addslashes(strip_tags($_POST['nick']));
mysqli_query( $connection, "UPDATE accounts SET nickname='$nickname' WHERE username='$username'");  
}}




if (($_POST['change_customgender']) && ($_POST['customgender'])){

$email111=addslashes(strip_tags($_POST['customgender']));



mysqli_query( $connection, "UPDATE accounts SET gender='$email111' WHERE username='$username'");

echo "<center>Your gender has been updated</center>";

}

if (strip_tags($_POST['sex_button']) && strip_tags($_POST['sex'])){

$sex=strip_tags($_POST['sex']);

if ($sex == "1"){ $new_sex="Male"; }else{ $new_sex="Female"; }

mysqli_query( $connection, "UPDATE accounts SET gender='$new_sex' WHERE username='$username'");

echo "<center>Gender updated!</center>";

}

if(strip_tags($_POST['UpdateOps'])){
$nickname = addslashes(strip_tags($_POST['nick']));
mysqli_query( $connection, "UPDATE accounts SET nickname='$nickname' WHERE username='$username'"); 
echo "<b>Your Nickname Has Been Updated!</b>"; 
}


if (($_POST['change_bg']) && ($_POST['bg'])){

$bg=mysqli_real_escape_string(stripslashes(strip_tags($_POST['bg'])));

mysqli_query( $connection, "UPDATE accounts SET profcolour=\"$bg\" WHERE username=\"$username\"");

echo "Your profile background colour has been updated.";

}

if ($_POST['profilecolour']){

$procolour=mysqli_real_escape_string(stripslashes(strip_tags($_POST['hexvalue'])));

mysqli_query( $connection, "UPDATE accounts SET profcolour=\"$profcolour\" WHERE username=\"$username\"");

echo "Your profile colour has been changed to $profcolour.";

}

if (strip_tags($_POST['change_views']) && strip_tags($_POST['sex'])){

$sex=strip_tags($_POST['sex']);

if ($sex == "1"){ $new_sex="0"; }else{ $new_sex="1"; }

mysqli_query( $connection, "UPDATE accounts SET showviews='$new_sex' WHERE username='$username'");

echo "<center>Profile views updated!</center>";

}



if ((stripslashes(strip_tags($_POST['change_password']) && ($_POST['current_password']) && ($_POST['new_password']) && ($_POST['verify_password'])))){

$new_password=mysqli_real_escape_string(stripslashes(strip_tags($_POST['new_password'])));
$new_password=htmlentities(stripslashes(strip_tags($new_password)));

$verify_password=mysqli_real_escape_string(stripslashes(strip_tags($_POST['verify_password'])));
$verify_password=htmlentities(stripslashes(strip_tags($verify_password)));

$current_password=mysqli_real_escape_string(stripslashes(strip_tags($_POST['current_password'])));
$current_password=htmlentities(stripslashes(strip_tags($current_password)));

if ($current_password == $fetch->password && $new_password == $verify_password){

$new_password=mysqli_real_escape_string(stripslashes(strip_tags($_POST['new_password'])));

mysqli_query( $connection, "UPDATE accounts SET password='$new_password' WHERE username='$username'");

echo "Your account settings have successfully been changed.";

session_destroy();

echo "<script language=\"javascript\">

top.document.location.reload();

</script>";



}else{

echo "<b><center><font color=red>Your password could not be changed. Please try again with the right details!</font></b></center>";

}}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<title>Edit Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<center>
<script language="JavaScript" type="text/javascript">
<!--
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
		} 
		else
		{
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
	}
	else 
	{
		myField.value += myValue;
		myField.focus();
	}
}
//-->
</script>
<table width='700' border="0" class="table1px" align='center' cellpadding="0" cellspacing='0'>
<tr>
<td width="49%" class='gradient'><div align="center">Edit Profile </div></td>
</tr>
<tr>
<td height="0" valign="top" class='tableborder'><form name="form" method="post" action="">
<div align="center">
<table width="500" border="0" cellspacing="0" class="table1px" cellpadding="0">
<tr>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':D')"><img src="images/smilies/biggrin.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':)')"><img src="images/smilies/smile.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':(')"><img src="images/smilies/sad.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':o')"><img src="images/smilies/surprised.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':eek:')"><img src="images/smilies/eek.gif" width="15" height="15" border="0"></a></div></td>
<td width="240" rowspan="4" class="table1px" bgcolor="#000000"><div align="center"> <a href="javascript:emoticon('[b]Text[/b]')"><br>
Bold</a> | <a href="javascript:emoticon('[u]Text[/u]')">Underline</a> | <a href="javascript:emoticon('[i]Text[/i]')">Italic</a> | <a href="javascript:emoticon('[color=COLOUR HERE]Text[/color]')">Colour</a> | <a href="javascript:emoticon('[size=SIZE HERE(1-8)]Text[/size]')">Size</a><br>
<br>
<a href="javascript:emoticon('[img]IMAGE URL[/img]')">Image</a> | <a href="javascript:emoticon('[youtube]VIDEO ID[/youtube]')">YouTube Video</a> | <a href="javascript:emoticon('[url]URL HERE[/url]')">URL</a> | <strong><a href="javascript:emoticon('[user]USERNAME[/user]')">User</a></strong><br>
<br>
<br>
</div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="30" height="20" class="table1px" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':eek:')"></a><a href="javascript:emoticon(':S')"><img src="images/smilies/confused.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':S')"></a><a href="javascript:emoticon(':cool:')"><img src="images/smilies/cool.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':cool:')"></a><a href="javascript:emoticon(':lol:')"><img src="images/smilies/lol.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':lol:')"></a><a href="javascript:emoticon(':mad:')"><img src="images/smilies/mad.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':P')"><img src="images/smilies/razz.gif" width="15" height="15" border="0"></a></div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':mad')"></a><a href="javascript:emoticon(':redface:')"><img src="images/smilies/redface.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':P')"></a><a href="javascript:emoticon(':cry:')"><img src="images/smilies/cry.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':redface:')"></a><a href="javascript:emoticon(':evil:')"><img src="images/smilies/evil.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':cry:')"></a><a href="javascript:emoticon(':twisted:')"><img src="images/smilies/twisted.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':roll:')"><img src="images/smilies/rolleyes.gif" width="15" height="15" border="0"></a></div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="20" bgcolor="#000000">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':evil:')"></a><a href="javascript:emoticon(';)')"><img src="images/smilies/wink.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':twisted:')"></a><a href="javascript:emoticon(':exclaim:')"><img src="images/smilies/exclaim.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':roll:')"></a><a href="javascript:emoticon(':question:')"><img src="images/smilies/question.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(';)')"></a><a href="javascript:emoticon(':idea:')"><img src="images/smilies/idea.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':arrow:')"><img src="images/smilies/arrow.gif" width="15" height="15" border="0"></a></div></td>
</tr>
</table>
<br>
<br>
<textarea name='content' cols='120' rows='20' class="tablebackground" id="text"><?php echo "$fetch->quote"; ?></textarea>
<br/>
<br/>
<b>Youtube Video ID:</b>
<input name='musicurl' type='text' class="textbox" value='' size='35' maxlength='15'/>
<input type="radio" name="autop" value="1" <?php if ($query->ytautoplay == "1"){ echo "checked"; } ?>>
On
<input type="radio" name="autop" value="0" <?php if ($query->ytautoplay == "0"){ echo "checked"; } ?>>
Off<br>
Example: http://www.youtube.com/watch?v=<strong>PUS2jgsxiwQ</strong><br>
<strong>PUS2jgsxiwQ</strong> is the Video ID after v= <br>
<br>
<b>Known as:</b>
<input type="text" class="textbox" name="nick" id="nick" value="<?php echo "$fetch->nickname"; ?>">
<br><br>
Your Password:
<input name='update_pass' type='password' class="textbox" id="update_pass" size='15' maxlength='15'/>
</div>
<div align="center"><br><br>
<input name='change_quote' type='submit' class="custombutton" value='Update Profile' />
<br>
<br>
<a href="profile.php?viewing=<?php echo "$username"; ?>">VIEW PROFILE</a>
<br><br>
<table width="307" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center"> Including youtube videos in your profile! </div></td>
</tr>
<tr>
<td><div align="center" class="tableborder">Take the Video ID found after &quot;v=&quot; in the URL <br>
<br>
<img src="http://g-p-1.com/Images/yturl.JPG" width="307" height="159"></div></td>
</tr>
</table>
</div>
</form></td>
</tr>



  <form name="form2" method="post" action="">
<tr>
<td height="0" valign="top" class='tableborder'>
<p align="center"><strong>Account Settings: </strong></p>
<p align="center">Current Password:
<input name='current_password' type='password' class="textbox" size='15' />
<br>
<br>
New Password:
<input name='new_password' type='password' class="textbox" size='15' />
<br>
<br>
Verify New Password:
<input name='verify_password' type='password' class="textbox" size='15' />
</p>
<p align="center">*Change Email:
<input name='new_email' type='text' class="textbox" id="new_email" value='<?php echo "$fetch->email"; ?>' size='40' maxlength='40'/>
<br>
<br>
<input name="change_password" type="submit" class="custombutton" value="Make Changes">
<br>
<br>
*You must fill in your Current Password to change your email! CaSe SeNsItIvE! </p>
</form></td>
</tr>
<tr>
<td height="0" valign="top" class='tableborder'><div align="center">
<tr><form name="form" method="post" action="">
<td valign="top">
<table cols="2" align="center" border="0" cellspacing="10">
<tbody><tr>
<td>
<table class="table1px" cols="2" align="center" border="0" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">
<tbody><tr><td colspan="2" class="gradient">Account Settings</td>
      </tr>
<tr><td class="tableborder" colspan="2" align="center">
<input type="radio" name="sex" value="1" >

Male

<input type="radio" name="sex" value="2" >

Female </td></tr>

<td align="center"><input name="sex_button" type="submit" id="sex_button" class="custombutton" value="Change">
</td></tr>
</tbody></table>
</td>
<td valign="top">

<table class="table1px" cols="2" align="center" border="0" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">

<tbody><tr><td colspan="2" class="gradient">Account Settings</td>
      </tr>
<tr><td class="tableborder" colspan="2" align="center">
Profile Colour: <input class="textbox" name="bg" value="#000000" type="text"></td></tr>
<tr><td class="tableborder" colspan="2" align="center">
<input name="change_bg" class="custombutton" value="Change" type="submit">
<br></td></tr>
</tbody></table>
</td></tr></tbody></table>



<table cols="2" align="center" border="0" cellspacing="10">
<tbody><tr>
<td>
<table class="table1px" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">

<tbody><tr height="30">

<td colspan="1" class="gradient" align="center">Show/Hide Profile Views</td></tr><tr>

<td class="tableborder" align="center">

<input name="sex" value="1" type="radio">

Off

<input name="sex" value="2" type="radio">

On </td></tr>

<tr>

<td align="center"><input name="change_views" id="change_views" class="custombutton" value="Change" type="submit"></td>

</tr>

</tbody></table>
</td>
<td>
<table class="table1px" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">

<tbody><tr height="30">

<td colspan="1" class="gradient" align="center">Youtube Autoplay</td></tr><tr>

<td class="tableborder" align="center">

<input name="autop" value="0" type="radio">

Off

<input name="autop" value="1" checked="" type="radio">

On </td></tr>

<tr>

<td align="center"><input name="change_autop" id="change_autop" class="custombutton" value="Change" type="submit"></td>

</tr>

</tbody></table>
</td>
</tr>
</table></table>
</center></form>











<?php include_once"incfiles/foot.php"; ?>


</body>

</html>
