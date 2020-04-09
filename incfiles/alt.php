<?php
include_once "connectdb.php";
include_once "func.php";

$find = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$username=$_SESSION['username'];
$viewuser= (isset($_GET['username']));

function img_check1($forbidden1) {
$forbidden1 = eregi_replace("javascript:document.getElementsByTagName
","not allowed",$forbidden1);
 return $forbidden1;
}
function sig($txt) {
$txt = preg_replace("#\[color=(.+?)\](.+?)#is","<font color=\"\\1\">\\2",$txt);
$txt = str_replace("[/color]", "</font>", $txt);
$txt = str_replace("[b]", "<b>", $txt);
$txt = str_replace("£","&pound;",$txt);
$txt = str_replace("™","&trade;",$txt);
$txt = str_replace("[/b]", "</b>", $txt);
$txt = str_replace("[i]", "<i>", $txt);
$txt = str_replace("[/i]", "</i>", $txt);
$txt = str_replace("[u]", "<u>", $txt);
$txt = str_replace("[/u]", "</u>", $txt);
$txt = str_replace("[center]", "<center>", $txt);
$txt = str_replace("[/center]", "</center>", $txt);
$txt = str_replace("[marquee]", "<marquee>", $txt);
$txt = str_replace("[/marquee]", "</marquee>", $txt);
return $txt;
}
function replace($txt) {
	$username = $_SESSION['username'];
	$find = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$txt = str_replace(":D", "<img src=images/smilies/biggrin.gif>", $txt);
$txt = str_replace(":question:", "<img src=images/smilies/question.gif>", $txt);
$txt = str_replace(":)", "<img src=images/smilies/smile.gif>", $txt);
$txt = str_replace(":(", "<img src=images/smilies/sad.gif>", $txt);
$txt = str_replace(":o", "<img src=images/smilies/surprised.gif>", $txt);
$txt = str_replace(":O", "<img src=images/smilies/surprised.gif>", $txt);
$txt = str_replace(":S", "<img src=images/smilies/confused.gif>", $txt);
$txt = str_replace(":P", "<img src=images/smilies/razz.gif>", $txt);
$txt = str_replace(":p", "<img src=images/smilies/razz.gif>", $txt);
$txt = str_replace(":cry:", "<img src=images/smilies/cry.gif>", $txt);
$txt = str_replace(";)", "<img src=images/smilies/wink.gif>", $txt);
$txt = str_replace(":mad:", "<img src=images/smilies/mad.gif>", $txt);
$txt = str_replace(":lol:", "<img src=images/smilies/lol.gif>", $txt); 
$txt = str_replace(":cool:", "<img src=images/smilies/cool.gif>", $txt);
$txt = str_replace(":evil:", "<img src=images/smilies/evil.gif>", $txt);
$txt = str_replace(":twisted:", "<img src=images/smilies/twisted.gif>", $txt);
$txt = str_replace(":devil:", "<img src=images/smilies/devil.gif>", $txt);
$txt = str_replace(":roll:", "<img src=images/smilies/rolleyes.gif>", $txt);
$txt = str_replace(":eek:", "<img src=images/smilies/eek.gif>", $txt); 
$txt = str_replace(":redface:", "<img src=images/smilies/redface.gif>", $txt);
$txt = str_replace(":arrow:", "<img src=images/smilies/arrow.gif>", $txt);
$txt = str_replace(":!:", "<img src=images/smilies/exclaim.gif>", $txt);
$txt = str_replace(":exclaim:", "<img src=images/smilies/exclaim.gif>", $txt);
$txt = str_replace(":?:", "<img src=images/smilies/question.gif>", $txt);
$txt = str_replace(":idea:", "<img src=images/smilies/idea.gif>", $txt); 
$txt = str_replace(":mrgrey:", "<img src=images/smilies/mrgrey.gif>", $txt);


$query = mysqli_query( $connection, "SELECT * FROM sensor");
		$rows = mysqli_num_rows($query);
		for($i = 0; $i < $rows; $i++) {
			$array = mysqli_fetch_assoc($query);
			$txt = str_replace($array[content], $array[block], $txt);
		}	

$txt = preg_replace("#\[color=(.+?)\](.+?)#is","<font color=\"\\1\">\\2",$txt);
$txt = str_replace("[/color]", "</font>", $txt);
$txt = str_replace("[img]", "<img border=0 src=", $txt);
$txt = str_replace("[/img]", ">", $txt);
$txt = str_replace("[IMG]", "<img border=0 src=", $txt);
$txt = str_replace("[/IMG]", ">", $txt);
$txt = str_replace("[center]", "<center>", $txt);
$txt = str_replace("[/center]", "</center>", $txt);
$txt = str_replace("[b]", "<b>", $txt);
$txt = str_replace("[quote]", "<div class='quote'><font color=#660000><b><i>Quote</i></b></font><br><br>", $txt);
$txt = str_replace("[/quote]", "</font></div>", $txt);
$txt = str_replace("£","&pound;",$txt);
$txt = str_replace("[/b]", "</b>", $txt);
$txt = str_replace("<", "<", $txt);
$txt = str_replace("[i]", "<i>", $txt);
$txt = str_replace("[/i]", "</i>", $txt);
$txt = str_replace("[u]", "<u>", $txt);
$txt = str_replace("[/u]", "</u>", $txt);
$txt = str_replace("[marquee]", "<marquee>", $txt);
$txt = str_replace("[/marquee]", "</marquee>", $txt);
$txt = preg_replace("#\[url=(.+?)\](.+?)\[/url\]#is","<a href=\"url/?site=\\1\" target=\"_blank\">\\2</a>",$txt);
$txt = str_replace("[code]", "<span style='font-size: 11px;'><pre>", $txt);
$txt = str_replace("[/code]", "</pre></span>", $txt);
$txt = str_replace(array("\r\n", "\n", "\r"), '<br>', $txt); 
$txt = str_replace("[b]", "<b>", $txt);
$txt = str_replace("[current-user]", "$_SESSION[username]", $txt);
$txt = str_replace("$fetch", "", $txt);  
$txt = str_replace("[hr]", "<hr>", $txt);
$txt = str_replace("
				", "<br>", $txt);


$txt = preg_replace("#\[user](.+?)\[/user\]#is","<a href=\"profile.php?viewing=\\1\" target=\"middle\"><font color=33CCFF><b>\\1</b></font></a>",$txt);
$txt = preg_replace("#\[user-font=(.+?)\](.+?)\[/user\]#is","<a href=\"profile.php?viewing=\\2\" target=\"middle\"><font color=\\1>\\2</font></a>",$txt);

$txt = preg_replace("#\[ffont](.+?)\[/ffont\]#is","<font style=\"font-variant: small-caps\">\\1</font>",$txt);

$txt = str_replace("[gang='", "<a href='crewprofile2.php?viewcrew=$txt", $txt);
$txt = str_replace("']", "'> $txt", $txt);
$txt = preg_replace("#\[gang-font=(.+?)\](.+?)\[/gang\]#is","<a href=\"crewprofile2.php?viewcrew=\\2\" target=\"middle\"><font color=\\1>\\2</font></a>",$txt);
$txt = preg_replace("#\[gang](.+?)\[/gang\]#is","<a href=\"crewprofile2.php?viewcrew=\\1\" target=\"middle\"><b>\\1</font></b>",$txt);

$ytautoplay = $find->ytautoplay;

$txt = preg_replace("#\[size=(.+?)\](.+?)\[/size\]#is","<font size=\"\\1\">\\2</font>",$txt);
$txt = str_replace("
", "<br>", $txt);
$txt = str_replace("[youtube]", "<object width='640' height='380'><param name='movie'></param><param name='wmode' value='transparent'></param><embed src=http://www.youtube.com/v/", $txt);
$txt = str_replace("[/youtube]", "&autoplay=".$ytautoplay."&loop=1&ap=%2526fmt%3D18 type='application/x-shockwave-flash' wmode='transparent' width='640' height='380'></embed></object>", $txt);
$txt = str_replace("[/gang]", "</a>", $txt);

return $txt;
}

function replaceGender($txt) {
$txt = str_replace(":D", "<img src=images/smilies/biggrin.gif>", $txt);
$txt = str_replace(":d", "<img src=images/smilies/biggrin.gif>", $txt);
$txt = str_replace(":question:", "<img src=images/smilies/question.gif>", $txt);
$txt = str_replace(":)", "<img src=images/smilies/smile.gif>", $txt);
$txt = str_replace(":(", "<img src=images/smilies/sad.gif>", $txt);
$txt = str_replace(":o", "<img src=images/smilies/surprised.gif>", $txt);
$txt = str_replace(":O", "<img src=images/smilies/surprised.gif>", $txt);
$txt = str_replace(":S", "<img src=images/smilies/confused.gif>", $txt);
$txt = str_replace(":P", "<img src=images/smilies/razz.gif>", $txt);
$txt = str_replace(":p", "<img src=images/smilies/razz.gif>", $txt);
$txt = str_replace(":cry:", "<img src=images/smilies/cry.gif>", $txt);
$txt = str_replace(";)", "<img src=images/smilies/wink.gif>", $txt);
$txt = str_replace(":mad:", "<img src=images/smilies/mad.gif>", $txt);
$txt = str_replace(":lol:", "<img src=images/smilies/lol.gif>", $txt); 
$txt = str_replace(":cool:", "<img src=images/smilies/cool.gif>", $txt);
$txt = str_replace(":evil:", "<img src=images/smilies/evil.gif>", $txt);
$txt = str_replace(":twisted:", "<img src=images/smilies/twisted.gif>", $txt);
$txt = str_replace(":roll:", "<img src=images/smilies/rolleyes.gif>", $txt);
$txt = str_replace(":eek:", "<img src=images/smilies/eek.gif>", $txt); 
$txt = str_replace(":redface:", "<img src=images/smilies/redface.gif>", $txt);
$txt = str_replace(":arrow:", "<img src=images/smilies/arrow.gif>", $txt);
$txt = str_replace(":!:", "<img src=images/smilies/exclaim.gif>", $txt);
$txt = str_replace(":exclaim:", "<img src=images/smilies/exclaim.gif>", $txt);
$txt = str_replace(":?:", "<img src=images/smilies/question.gif>", $txt);
$txt = str_replace(":idea:", "<img src=images/smilies/idea.gif>", $txt); 
$txt = str_replace(":mrgrey:", "<img src=images/smilies/mrgrey.gif>", $txt);


$query = mysqli_query( $connection, "SELECT * FROM sensor");
		$rows = mysqli_num_rows($query);
		for($i = 0; $i < $rows; $i++) {
			$array = mysqli_fetch_assoc($query);
			$txt = str_replace($array[content], $array[block], $txt);
		}	

$txt = preg_replace("#\[color=(.+?)\](.+?)#is","<font color=\"\\1\">\\2",$txt);
$txt = str_replace("[/color]", "</font>", $txt);
$txt = str_replace("[b]", "<b>", $txt);
$txt = str_replace("£","&pound;",$txt);
$txt = str_replace("™","&trade;",$txt);
$txt = str_replace("®","&reg;",$txt);
$txt = str_replace("[/b]", "</b>", $txt);
$txt = str_replace("<", "<", $txt);
$txt = str_replace("[i]", "<i>", $txt);
$txt = str_replace("[/i]", "</i>", $txt);
$txt = str_replace("[u]", "<u>", $txt);
$txt = str_replace("[/u]", "</u>", $txt);
$txt = str_replace("[marquee]", "<marquee>", $txt);
$txt = str_replace("[/marquee]", "</marquee>", $txt);
$txt = preg_replace("#\[url=(.+?)\](.+?)\[/url\]#is","<a href=\"url/?site=\\1\" target=\"_blank\">\\2</a>",$txt);
$txt = str_replace(array("\r\n", "\n", "\r"), '<br>', $txt); 
$txt = str_replace("[b]", "<b>", $txt);
$txt = str_replace("[hr]", "<hr>", $txt);
$txt = str_replace("
				", "<br>", $txt);

return $txt;
}

$txt="";
$txt = preg_replace("/includes/","index2.php",$txt);


function rep2($txt) {
$txt = str_replace('&lt;','<',$txt);
$txt = str_replace('&gt;','>',$txt);
$txt = str_replace('&quot;','\"',$txt);
$txt = str_replace('&#amp;','&',$txt);
$txt = preg_replace('£','&pound;',$txt);
return $txt; 
}
?>

