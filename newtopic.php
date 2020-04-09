<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
$query1=mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'");
$ranks=mysqli_fetch_object($query1);

$forum=$_GET['forum'];

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

if($fetch->bantime <= time()){
mysqli_query( $connection, "UPDATE accounts SET forum_ban='0' WHERE username='$username'");
}elseif($fetch->bantime > time()){ }

if($fetch->forum_ban == "1"){
echo"You are still banned from the forums for ".maketime($fetch->bantime).".";
exit(); }

if($fetch->lasttop <= time()){
mysqli_query( $connection, "UPDATE accounts SET lasttop='0' WHERE username='$username'");
}elseif($fetch->lasttop > time()){ }

if($fetch->lasttop >= "1"){
echo"You need to wait for ".maketime($fetch->lasttop)." untill you can make another topic.";
exit(); }

if ($fetch->userlevel != "4"){
if ($fetch->lasttop > time()){
echo "You need to wait for ".maketime($lasttopic)." untill you can make another topic<br>
"; }}

if (($fetch->userlevel != '0') || (time() >= $lasttopic)){ 
$timer = gmdate('H:i:s, l (jS)-M-y ');

if(strip_tags($_POST['Submit']) && strip_tags($_POST['title']) && strip_tags($_POST['insert_context'])){
$time = time()+ (60 * 1);

$title = addslashes(strip_tags($_POST['title']));
$topic_text=addslashes(strip_tags($_POST['insert_context']));
$forum=strip_tags($_POST['forum']);
$topictype=strip_tags($_POST['topictype']);
$typetopic=strip_tags($_POST['typetopic']);

if($ranks->id < "4"){ echo "You cant post topics until your ranked at Vandal.";
}elseif($ranks->id >= "4"){

if ($topictype == ""){

if($forum != "crew"){
mysqli_query( $connection, "INSERT INTO `posts` (`id`, `username`, `title`, `topictext`, `forum`, `locked`, `sticky`, `imp`, `lastreply`, `made`) 
VALUES ('', '$username', '$title', '$topic_text', '$forum', '0', '0', '0', '$time', '$timer');") or die (mysqli_error());

}elseif($forum == "crew"){
mysqli_query( $connection, "INSERT INTO `posts` (`id`, `username`, `title`, `topictext`, `forum`, `locked`, `sticky`, `imp`, `lastreply`, `made`, `gang`, `gname`, `crew`) 
VALUES ('', '$username', '$title', '$topic_text', '$forum', '0', '0', '0', '$time', '$timer', '1', '$fetch->crew', '$fetch->crew')") or die (mysqli_error()); }


mysqli_query( $connection, "UPDATE accounts SET lasttop='$time', posts=posts+1 WHERE username='$username'");
echo "The topic $title was made successfully.";


}
}
}
}
?>



<html>
<head>
<title>Make Topic</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<script language="JavaScript" type="text/javascript">
<!--
function emoticon(text) {
	var txtarea = document.start_topic.insert_context;
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

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}
//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
function emoticon(text) {
    var txtarea = document.form1.insert_context;
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

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}
//-->
</script>
<form name="form1" method="post" action="">
<table width="600" border="0" class="table1px" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Make a Topic </div></td>
</tr>
<tr>
<td class="tableborder"><div align="center">Subject:
<input name="title" type="text" class="textbox" id="title" value="" size="35" maxlength="23">
<br>
<br>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20" class="table1px" bgcolor="#000000">&nbsp;</td>
<td width="20" class="table1px" bgcolor="#000000">&nbsp;</td>
<td width="30" class="table1px" height="20" bgcolor="#000000"><div align="center"><a href="javascript:emoticon(':D')"><img src="images/smilies/biggrin.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':)')"><img src="images/smilies/smile.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':(')"><img src="images/smilies/sad.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':o')"><img src="images/smilies/surprised.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':eek:')"><img src="images/smilies/eek.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':mrgrey:')"><img src="images/smilies/mrgrey.gif" width="15" height="15" border="0"></a></div></td>
<td width="240" rowspan="4" bgcolor="#000000" class="table1px"><div align="center"> <a href="javascript:emoticon('[b]Text[/b]')"><br>
Bold</a> | <a href="javascript:emoticon('[u]Text[/u]')">Underline</a> | <a href="javascript:emoticon('[i]Text[/i]')">Italic</a> | <a href="javascript:emoticon('[color=COLOUR HERE]Text[/color]')">Colour</a> | <a href="javascript:emoticon('[size=SIZE HERE(1-8)]Text[/size]')">Size</a><br>
<br>
<a href="javascript:emoticon('[img]IMAGE URL[/img]')">Image</a> | <a href="javascript:emoticon('[youtube]VIDEO ID[/youtube]')">YouTube Video</a> | <a href="javascript:emoticon('[url]URL HERE[/url]')">URL</a> | <strong><a href="javascript:emoticon('[user]USERNAME[/user]')">User</a></strong><br>
<br>
<br>
</div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':eek:')"></a><a href="javascript:emoticon(':S')"><img src="images/smilies/confused.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':S')"></a><a href="javascript:emoticon(':cool:')"><img src="images/smilies/cool.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':cool:')"></a><a href="javascript:emoticon(':lol:')"><img src="images/smilies/lol.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':lol:')"></a><a href="javascript:emoticon(':mad:')"><img src="images/smilies/mad.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':P')"><img src="images/smilies/razz.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" rowspan="3" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':devil:')"><img src="images/smilies/devil.gif" width="30" height="52" border="0"></a></div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':mad')"></a><a href="javascript:emoticon(':redface:')"><img src="images/smilies/redface.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':P')"></a><a href="javascript:emoticon(':cry:')"><img src="images/smilies/cry.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':redface:')"></a><a href="javascript:emoticon(':evil:')"><img src="images/smilies/evil.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':cry:')"></a><a href="javascript:emoticon(':twisted:')"><img src="images/smilies/twisted.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':roll:')"><img src="images/smilies/rolleyes.gif" width="15" height="15" border="0"></a></div></td>
</tr>
<tr>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="20" bgcolor="#000000" class="table1px">&nbsp;</td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':evil:')"></a><a href="javascript:emoticon(';)')"><img src="images/smilies/wink.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':twisted:')"></a><a href="javascript:emoticon(':exclaim:')"><img src="images/smilies/exclaim.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':roll:')"></a><a href="javascript:emoticon(':question:')"><img src="images/smilies/question.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(';)')"></a><a href="javascript:emoticon(':idea:')"><img src="images/smilies/idea.gif" width="15" height="15" border="0"></a></div></td>
<td width="30" height="20" bgcolor="#000000" class="table1px"><div align="center"><a href="javascript:emoticon(':arrow:')"><img src="images/smilies/arrow.gif" width="15" height="15" border="0"></a></div></td>
</tr>
</table><br>
<textarea name="insert_context" cols="118" rows="15" class="tablebackground" id="textarea" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"></textarea></td>
</tr>
<tr>
<td class="tableborder">
<div align="center"><br>
<input type="submit" class="custombutton" name="Submit" value="Create Topic">
<br>
</div></td>
</tr>
</table>
          <input type="hidden" name="forum" value="<?php echo "$forum"; ?>">
          <br>
        </div></td>
    </tr>

  </table>
</form>
<?php require_once "incfiles/foot.php"; ?>
</body>
</html>
