<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

if($info->userlevel=='0' || $info->userlevel=='3' || $info->userlevel=='2' || $info->userlevel=='6'){
die("");
}

$high1 = time() - (3600 * 24) * 7;
$high = time() - (3600 * 24);

$friends=mysqli_query( $connection, "SELECT * FROM friends WHERE username='$username'");
$friend=mysqli_fetch_object($friends);

$mostever=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));
$cc = explode("-", $mostever->onlinec);
$cc1 = $cc[0];
$cc2 = $cc[1];
$cc3 = $cc[2];
$cc4 = $cc[3];
$cc5 = $cc[4];

$most_online=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));
$timenow=time();
$now_online =mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow'"));
if ($now_online > $most_online->online){
mysqli_query( $connection, "UPDATE stats SET online='$now_online' WHERE id='1'"); }
?>

<head><title>Players Online</title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>

<style type="text/css">
#skill{
position: absolute;
width: 191px;
height: 79px;
border: thin #333333;
margin-left: 15px;
margin-top: 15px;
visibility: hidden;
z-index: 100;
text-align: center;
padding: 5px;
background: #330000;
}
.tableback {	
    font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	background-image: url(../images/navi/playersonline.png);
	background-repeat: no-repeat;
	background-position: center top;
	width: 700px;
	height: 700px;
	border: none;
	padding: 5px; 
}
</style>

<div id="skill"></div>

<script type="text/javascript">


var offsetxpoint=-100 //Customize x offset of tooltip
var offsetypoint=0 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["skill"] : document.getElementById? document.getElementById("skill") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function tip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.x+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.y+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hide(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
</head>
<center><b>Want rewards for making players join? <a href="../newplayers.php">Click Here</a>!</b></center><br>
<form action="" method="post" id="11">
<table width="600" height="300" border="0" align="center" cellspacing="0" class="table1px">
<tr><td colspan="5" class="gradient" height="30"><center>Players Currently Online</center></td></tr>
<tr><td align="center" class="tablebackground" valign="top">
<br><br>
<div align="left" style="padding: 10px;"><b><?php  
$admins = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='4'"));
$sds = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='5'"));
$mods = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='1'"));
$hdops = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='2'"));
$fmods = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='3'"));
$accounts = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='0'"));
$ghosts = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='1'"));
$ghostsout = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0'"));
			
$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by username");
$num = mysqli_num_rows($select); echo "Total number of people online: <b>$num"; ?></b><br></b></p>

<?php
$timenow=time();
$selecta = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by id");
$numa = mysqli_num_rows($selecta);

$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by username ASC");
$num = mysqli_num_rows($select);

while ($i = mysqli_fetch_object($select)){

if ($i->crew == "0" || $i->crew == ""){
$crew = "None"; }else{ $crew=$i->crew; }

if ($i->cc == "1"){ 
$oc="No"; }else{ $oc="Yes"; }

if ($i->userlevel=="1"){
$echo = "<font color=yellow>$i->username</font>"; $userrank = "Moderator";
}elseif ($i->userlevel=="4"){
$echo = "<font color=orange>$i->username</font>"; $userrank = "Admin";
}elseif ($i->userlevel=="3"){
$echo = "$i->username"; $userrank = "Forum Mod";
}elseif ($i->userlevel=="2"){
$echo = "$i->username"; $userrank = "HDOP";
}elseif ($i->userlevel=="0" && $i->rank!="Official TP Legend"){
$echo = "$i->username"; $userrank = "User";
}elseif ($i->userlevel=="0" && $i->rank=="Official TP Legend"){
$echo = "<font color=lightgreen>$i->username</font>"; $userrank = "User"; }

if ($friend->person == "$i->username"){ $nick = "($friend->nickname)"; }else{ $nick = ""; }

if($num != "0"){
echo "<a href='../786/profilex.php?viewing=$i->username' onMouseover=\"tip('<br><font color=#FFFFFF><b>Username:</b> $echo <br><b>Userlevel:</b> $userrank <br><b>Rank:</b> $i->rank<br><b>Gang: </b>$crew  <br><b>OC Ready:</b> $oc </font>')\";
 onMouseout=\"hide()\">$echo $nick</a> - "; }else{
echo "<center>Sorry there is no online players in this filter category: Please reset the filter, to view the players online!</center>"; }} ?></div>

<br><br>

<div align="left" style="padding: 10px;">
<?php $mostever = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'")); 
$takeoff = $mostever->online - $num; ?>

</div>
 <tr>
    <td class='tableborder'><div align="left">
 <tr>
    <td class='tableborder'><div align="left">
    
    
<?php if($fetch->userlevel == "4" || $fetch->userlevel == "1" || $fetch->userlevel == "5"){ ?>
<div align="left" style="padding: 10px;">
<br><br><br>
<u>Ghost Mode</u><br>Currently switched <?php if ($fetch->ghostmode == "0"){ 
$statu="off"; }else{ $statu="on"; } echo "$statu"; ?><br><br>
<b>Turn Ghost Mode</b>
<select name="Ghost" id="Ghost" class="textbox">
<option>On</option>
<option>Off</option>
</select><br><br>
<input type="submit" name="Submit" value="Submit" class="custombutton">
<?php
if (strip_tags($_POST['Submit'])){
if (strip_tags($_POST['Ghost']) == "On"){
mysqli_query( $connection, "UPDATE accounts SET ghostmode='1' WHERE username='$username'");
echo "<font color=green>Ghost mode has been enhanced.</font>";
}elseif (strip_tags($_POST['Ghost']) == "Off"){
mysqli_query( $connection, "UPDATE accounts SET ghostmode='0' WHERE username='$username'"); 
echo"<font color=red>Ghost mode has been dehanced.</font>"; }}

echo "<br><br><br>";



$ghosty = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel != '0'");
$ghonum = mysqli_num_rows($ghosty);
while ($igho = mysqli_fetch_object($ghosty)){
if($igho->userlevel == "2"){ $echo = "<font color=green>$igho->username</font>"; 
}elseif($igho->userlevel=="4"){
$echo = "<font color=orange>$igho->username</font>";
}elseif ($igho->userlevel=="1"){
$echo = "<font color=yellow>$igho->username</font>";
}elseif ($igho->userlevel=="3"){
$echo = "<font color=dodgerblue>$igho->username</font>"; }
echo "<a href='profilex.php?viewing=$igho->username'><b> $echo </b></a> -"; } ?>
</div><?php } ?>
<?php if($fetch->Userlevel == "1" || $fetch->Userlevel == "4"){ ?>
<p>&nbsp;</p>
<table border='0' width='70%' cellspacing='0' cellpadding='0' align=center>
  <tr>
    <td height="22" colspan="7" align="center" class="gradient"><strong>Gangster Online</strong></td>
  </tr>

  <tr>
    <td class='tableborder'><div align="left">
      
</td>
</tr>
</table>
<?php } ?>
<div align="left">

<?php
//////GAY THINGS ABOVE/////
$selecta = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' AND status='Alive' ORDER BY l_ip DESC");
$numa = mysqli_num_rows($selecta);

while ($i = mysqli_fetch_object($selecta)){

$iip = $i->l_ip;

$echo= $i->username;

if($pip == $i->l_ip){ $col = "red"; }else{ $col = "yellow"; } 
$echo = "($echo <font color=$col>$iip</font>)";

echo "<a href='profilex.php?viewing=$i->username' onMouseover=\"tip('<br><font color=#FFFFFF><b>Username:</b> $echo <br><b>Rank:</b> $i->rank<br><b>Gang: </b>$crew  <br><b>OC Ready:</b> $oc </font>')\";
 onMouseout=\"hide()\">$echo</a> <font color=#99CDC9> -&nbsp; </font>  ";


$pip = $i->l_ip;

}


?>
      <br>
        <br>
        <br>
        
        </b> Users With A Red Ip Address Are Dupes \\ Users With A Yellow Ip Are Normal </div></td>
  </tr>
</table>
<p>&nbsp;      </p>
</td>
</tr>
</table>

</tr></tr>
</table>
<br>
<br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>Thug Paradise currently has players playing every second, therefore we like to keep track of the statistics and share them with you. From our records, we know that <b><?php echo "".makecomma($mostever->allonline).""; ?></b> players have logged on since the 6th of March, 2009 at 21:45pm.</p>
<p>The most ever accounts who have been online at the same time is <b><?php echo "$mostever->online"; ?></b>. We need another <b><?php echo "$takeoff"; ?></b> players to beat the record.</p>
<p>Currently on Thug Paradise, there are/is <b><?php echo "$admins"; ?></b> admin(s) online, <b><?php echo "$mods"; ?></b> moderator(s) online, <b><?php echo "$fmods"; ?></b> forum moderator(s) online and <b><?php echo "$hdops"; ?></b> helpdesk operators online, meaning there are <b><?php echo "$accounts"; ?></b> players left, who do not have a staff job.</p>
<p>Moderator's and Admin's have the choice to go into Ghost Mode during the time which they are online. This will mean that there name shall disappear from the players online page. You will still know that there are so many moderators / admins online by looking at the stats, but you won't know who it is. This is enforced so that they can do there jobs without being messaged all the time. Currently, TP has <b><?php echo "$ghosts"; ?></b> member(s) of staff in ghost mode, meaning the rest of the players (<b><?php echo "$ghostsout"; ?></b>) have not entered ghost mode.</p></div></td></tr></table>


<?php require_once "incfiles/foot.php"; ?>

</form>
</body>
</html>
