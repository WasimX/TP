<?php
session_start();
include "incfiles/func.php";
include "incfiles/connectdb.php";
logincheck();
$username=$_SESSION['username'];
$date = gmdate('Y-m-d H:i:s');
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$r=mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'");
$rank=mysqli_fetch_object($r);

$cquery=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'");
$fetchc=mysqli_fetch_object($cquery);
$numroc=mysqli_num_rows($cquery);
if($fetch->crew == "0"){ exit('<font color=red>Your not in a crew!</font>'); }
$pe = explode("-", $fetchc->per);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thug Paradise 2 :: Gang Profile</title>
</head>
     <script language="javascript" type="text/javascript">

function emoticon(text) {
	var txtarea = document.tehform.post;
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
<body>   <?php if($fetchc->lhm == $username && $pe[4] == "1" || $fetchc->underboss == $username && $pe[3] == "1" || $fetchc->owner == $username || $fetchc->rhm == $username  && $pe[5] == "1"){  ?>
<form method='post' id='tehform' name='tehform' enctype='multipart/form-data' action=''>
<table align="center" colspan="3" height="34" border="0" cellspacing="0" class="table1px"><tr><td width="500" class="gradient"><b>Navigation Bar</b></td></tr><tr><td class="tableborder"><div align="center"><p align="center"><a href="../Gang_Acc.php"> Acceptance</a> &raquo; <a href="../Gang_Pro.php"> Gang Profile</a> &raquo; <a href="../Gang_Not.php"> Notices</a> &raquo; <a href="../Gang_Mem.php"> Member Options</a> - <a href="../gangCountry.php"> Gang Country</a> &raquo; <a href="../soon.php"> Drive-By</a><font color=red>*</font></p></div></td></tr></table><p></p>
 <table width="600" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td  height="22" align="center" class="gradient">Your Gangs Profile</td>
    </tr> <?php
							  if ($_POST['change_quote']){
		  $post=addslashes(strip_tags($_POST['post']));  
mysqli_query( $connection, "UPDATE crews SET quote='$post' WHERE name='$fetch->crew'");
echo"<center>You changed your crew quote!</center>";
}
							  if ($_POST['profilecolour']){
		  $hexvalue=addslashes(strip_tags($_POST['hexvalue']));  
mysqli_query( $connection, "UPDATE crews SET Prof='$hexvalue' WHERE name='$fetch->crew'");
echo"<center>You changed your profile background colour!</center>";
}


?>
    <tr>
      <td align="center" class="tableborder"><p><br />
          <textarea class="tablebackground" name="post" cols="90" rows="12" id="post" onclick='storeCaret(this)' onkeyup='storeCaret(this)' onfocus='storeCaret(this)' onmouseout='storeCaret(this)'><?php echo"$fetchc->quote";?></textarea>
          <br />
          <br />
        <table width="60%" border="0" cellpadding="0" cellspacing="2" class="table1px">
            <tr>
              <td width="20%" align="center" >
              <a href='#' onClick="return emoticon('[b] TEXT HERE [/b]')"><b>BOLD TEXT</b></a></td>

              <td width="20%" align="center" ><a href='#' onClick="return emoticon('[i] TEXT HERE [/i]')"><i>ITALIC TEXT</i></a></td>
              <td width="20%" align="center"> <a href='#' onClick="return emoticon('[u] TEXT HERE [/u]')"><u>UNDERLINED TEXT</u></a></td>
              
              <td align="center" width='20%' ><a href='#' onClick="return emoticon('[url=\' URL HERE \'] TEXT HERE [/url]')">URL LINKS</a></td>
            
              <td align="center" width='20%' ><a href='#' onClick="return emoticon('[img] IMAGE URL HERE [/img]')">IMAGE</a></td>
            </tr>
          <tr>
                <td colspan="11" align="center" >
<div align="center"><a href="#" onclick="javascript:emoticon(':twisted:')"><img src="images/smilies/twisted.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':roll:')"><img src="images/smilies/rolleyes.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':evil:')"></a> <a href="#" onclick="javascript:emoticon(':twisted:')"></a> <a href="#" onclick="javascript:emoticon(':exclaim:')"><img src="images/smilies/exclaim.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':roll:')"></a><a href="#" onclick="javascript:emoticon(';)')"><img src="images/smilies/wink.gif" alt="a" border="0" height="15" width="15"></a><a href="#" onclick="javascript:emoticon(':question:')"><img src="images/smilies/question.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(';)')"></a> <a href="#" onclick="javascript:emoticon(':)')"><img src="images/smilies/smile.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':(')"><img src="images/smilies/sad.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':o')"><img src="images/smilies/surprised.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':eek:')"><img src="images/smilies/eek.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':eek:')"></a><br> <a href="#" onclick="javascript:emoticon(':idea:')"><img src="images/smilies/idea.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':redface:')"><img src="images/smilies/redface.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':P')"></a> <a href="#" onclick="javascript:emoticon(':cry:')"><img src="images/smilies/cry.gif" alt="a" border="0" height="15" width="15"></a><a href="#" onclick="javascript:emoticon(':redface:')"></a> <a href="#" onclick="javascript:emoticon(':evil:')"><img src="images/smilies/evil.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':arrow:')"><img src="images/smilies/arrow.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':mrgrey:')"><img src="images/smilies/mrgrey.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':D')"><img src="images/smilies/biggrin.gif" alt="a" border="0" height="15" width="15"></a><a href="#" onclick="javascript:emoticon(':S')"><img src="images/smilies/confused.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':S')"></a> <a href="#" onclick="javascript:emoticon(':cool:')"><img src="images/smilies/cool.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':cool:')"></a> <a href="#" onclick="javascript:emoticon(':lol:')"><img src="images/smilies/lol.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':lol:')"></a> <a href="#" onclick="javascript:emoticon(':mad:')"><img src="images/smilies/mad.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':P')"><img src="images/smilies/razz.gif" alt="a" border="0" height="15" width="15"></a> <a href="#" onclick="javascript:emoticon(':mad')"></a> </div></td></td>

              </tr>
          </table>
<br />
         
			            <div align="center">
<input name="change_quote" type="submit" class="custombutton" id="change_quote" value="Update Profile!" />
                        <br />
                        <br />
                    <br />
          <b>Profile Background Colour</b><br />
          <input  name="hexvalue" value="#FFFFFF" size="10" class="textbox" onChange="shouldset(this.value)" > 
              &nbsp; 
              <input class="custombutton"  name="profilecolour" type="submit" id="profilecolour" value="Change">
          <br>
                <br />
         </td>
    </tr>
</table></form><br />
  <?php } ?>
</body>
</html>
