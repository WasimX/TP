<?php 
session_start(); 
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
$query1=mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'");
$ranks=mysqli_fetch_object($query1);

$fromper=strip_tags($_GET['fromper']);
$date = gmdate('Y-m-d H:i:s');
?>
<html>
<head>
<script language=JavaScript>
function so(dis)
{
for (i=0;i<dis.elements.length;i++){ 
	if (dis.elements[i].type=='submit')
	   dis.elements[i].style.visibility='hidden';
	}
	if(fs==false){
		 fs=true;
		 return true;
	}else
 		return false;
	}
	function goaway()
{
for(i=0;i<document.forms.length;i++)
 document.forms[i].onsubmit = function() {return so(this);};
}
</script>
<title>Thug Paradise 2 :: Send Message</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css"></head>

<body onLoad="goaway();">
<form action="" method="post" id="form" name="form" enctype="multipart/form-data">
  <div align="center">
    <?php
		if(strip_tags($_POST['Submit']) && strip_tags($_POST['username']) && strip_tags($_POST['post'])){
$to = strip_tags($_POST['username']);
$to2=strip_tags($_POST['subject']);
$text=addslashes(strip_tags($_POST['post']));

if($ranks->id < "3"){ echo "You need to rank up over vandal..";
}elseif($ranks->id >= "3"){

$frows=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM block WHERE blocked='$username' AND username='$to'"));



if($frows == "1"){ echo"<link rel=stylesheet href=style.css type=text/css><center><b><font color=red>You Can't Message This User As He/She Has Blocked You!</font></b></center>"; }else{


$sql = mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `subject`, `to`, `from`, `message`, `date`, `read`) VALUES ('', '$to2', '$to', '$username', '$text', '$date', '0');") or die (mysqli_error());


echo "<center><b>You sent a message to <a href=\"profile.php?viewing=$to\">$to</a>.<br><br>";

}}} ?>
    <br>
  </div>
<script language="javascript" type="text/javascript">
function emoticon(text) {
	var txtarea = document.form.post;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}
       </script>
  <table width="29%" align="center" cellpadding="2" cellspacing="0" border="0" class="table1px">
    <tr>
      <td height="30" class="gradient"><div align="center">Navigation Bar</div></td>
    </tr>
    <tr>
      <td align="center" class="tableborder"><a href="inbox.php">Your Inbox</a> &raquo; <b>Send Message</b> &raquo; <a href="inbox.php?saved=1">Saved Messages</a></td>
    </tr>
  </table>
  <br>
  <table width="50%" border="0" cellpadding="2" cellspacing="0" class="table1px" align="center">
    <tr>
      <td height="30" colspan="3" align="center" class="gradient">Send Message</td>
    </tr>
    <tr>
      <td width="280" align="right" class="tableborder">Username:</td>
      <td width="100" align="left" class="tableborder"><input name="username" type="text" class="textbox" value="<?php echo"$fromper";?>" size="20" maxlength="20">      </td>
    </tr>
    <tr>
      <td align="right" class="tableborder">Subject:</td>
      <td align="left" class="tableborder"><input name="subject" class="textbox" type="text" value="None" size="35" maxlength="20"></td>
    </tr>
    <tr>
      <td class="tableborder"><div align="center">
<div align="center"><a href='#' onClick="javascript:emoticon(':twisted:')"><img src="images/smilies/twisted.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':roll:')"><img src="images/smilies/rolleyes.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':evil:')"></a> <a href='#' onClick="javascript:emoticon(':twisted:')"></a> <a href='#' onClick="javascript:emoticon(':exclaim:')"><img src="images/smilies/exclaim.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':roll:')"></a><a href='#' onClick="javascript:emoticon(';)')"><img src="images/smilies/wink.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':question:')"><img src="images/smilies/question.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(';)')"></a> <a href='#' onClick="javascript:emoticon(':)')"><img src="images/smilies/smile.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':(')"><img src="images/smilies/sad.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':o')"><img src="images/smilies/surprised.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':eek:')"><img src="images/smilies/eek.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':eek:')"></a><br> <a href='#' onClick="javascript:emoticon(':idea:')"><img src="images/smilies/idea.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':redface:')"><img src="images/smilies/redface.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':P')"></a> <a href='#' onClick="javascript:emoticon(':cry:')"><img src="images/smilies/cry.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':redface:')"></a> <a href='#' onClick="javascript:emoticon(':evil:')"><img src="images/smilies/evil.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':arrow:')"><img src="images/smilies/arrow.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':mrgrey:')"><img src="images/smilies/mrgrey.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':D')"><img src="images/smilies/biggrin.gif" alt="a" width="15" height="15" border="0" /></a><a href='#' onClick="javascript:emoticon(':S')"><img src="images/smilies/confused.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':S')"></a> <a href='#' onClick="javascript:emoticon(':cool:')"><img src="images/smilies/cool.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':cool:')"></a> <a href='#' onClick="javascript:emoticon(':lol:')"><img src="images/smilies/lol.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':lol:')"></a> <a href='#' onClick="javascript:emoticon(':mad:')"><img src="images/smilies/mad.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':P')"><img src="images/smilies/razz.gif" alt="a" width="15" height="15" border="0" /></a> <a href='#' onClick="javascript:emoticon(':mad')"></a> </div></td>
              <td width="216" class="tableborder"><div align="center"> <a href="javascript:emoticon('[b]Text[/b]')">Bold</a> - <a href="javascript:emoticon('[u]Text[/u]')">Underline</a> - <a href="javascript:emoticon('[i]Text[/i]')">Italic</a> - <a href="javascript:emoticon('[color=COLOUR HERE]Text[/color]')">Colour</a> <br>
      <a href="javascript:emoticon('[img]IMAGE URL[/img]')">Image</a> - <a href="javascript:emoticon('[url]URL HERE[/url]')">URL</a> - <a href="javascript:emoticon('[user]USERNAME[/user]')">User</a> - <a href="javascript:emoticon('[size=SIZE HERE(1-8)]Text[/size]')">Size</a> </div></td>
    </tr>
<tr><td align="center" class="tableborder" colspan="2"> 
        </p>
          <br>
        <textarea class="tablebackground" name="post" cols="70" rows="12" id="post"onClick='storeCaret(this)' onKeyUp='storeCaret(this)' onFocus='storeCaret(this)' onMouseOut='storeCaret(this)'><?php if ($_GET['reply']){
				$reply=strip_tags($_GET['reply']);
				$reply=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM inbox WHERE id='$reply'")); 
				$mess = stripslashes($reply->message);
				echo"


-------- 
At $reply->date $reply->from sent:
				
$mess";}?></textarea>
        <br>
        <br>
          <input type="submit" name="Submit" class="custombutton" value="Submit">
          <br></td> 
    </tr>

  </table>
  <p>&nbsp;</p>
  <div align="center"><br>
  </div>
</form>
<?php require_once "incfiles/foot.php"; ?>
</body>
</html>