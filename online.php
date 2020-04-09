<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

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
	background-image: url(images/navi/playersonline.png);
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



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Players Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">.style2{color:#009900}#dhtmltooltip{position:absolute;width:250px;border:2px solid #333333;padding:10px;background-color:#370000;visibility:hidden;z-index:100;color:#CCCCCC;text-align:center;filter:progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);}.gradient{text-align:center;}.tableborder{line-height:15px;}#back{position:absolute;top:5px;left:5px;}</style>
<script src="p_ajax.js"></script>
</head>
<body>
<div id='back'></div><div id="dhtmltooltip"></div>
<script type="text/javascript">

/***********************************************
* Cool DHTML tooltip script- ï¿½ Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
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
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
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

function hideddrivetip(){
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
<div id='back'><a href='profileupdates.php'>Edited<br/>Profiles</a></div><div id="dhtmltooltip"></div>
<p>
<table border='0' width='90%' cellspacing='0' cellpadding='0' align=center>
<tr>
<td class='gradient'>Players currently online</td>
</tr>
<tr>
<td class='tableborder'> <?php  
$admins = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='4'"));
$sds = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='5'"));
$mods = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='1'"));
$hdops = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='2'"));
$fmods = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='3'"));
$accounts = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND userlevel='0'"));
$ghosts = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='1'"));
$ghostsout = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0'"));

$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by username");
$num = mysqli_num_rows($select); ?> </u></b></p>

			

<?php
$timenow=time();
$selecta = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by id");
$numa = mysqli_num_rows($selecta);

$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' ORDER by username ASC");
$num = mysqli_num_rows($select);

while ($i = mysqli_fetch_object($select)){

if ($i->gang == "0" || $i->gang == ""){
$crew = "None"; }else{ $crew=$i->gang; }

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
echo "<a href='profile.php?viewing=$i->username' onMouseover=\"tip('<br><font color=#FFFFFF><b>Username:</b> $echo <br><b>Userlevel:</b> $userrank <br><b>Rank:</b> $i->rank<br><b>Gang: </b>$crew  <br><b>OC Ready:</b> $oc </font>')\";
 onMouseout=\"hide()\">$echo $nick</a> - "; }else{
echo "<center>Sorry there is no online players in this filter catergory: Please reset the filter, to view the players online!</center>"; }} ?></div>
<br /><br />
Total number of people online: <?php echo"$num"; ?>
</b><br /><br />If you wish to find a friend on this page, press CTRL + F and enter their username in the box that appears!<br /><br /><span style='color: #F9B024;'><b>Orange</b></span> Users are Admin<br /><b><span style='color: #FFFF00;'>Yellow</span></b> Users are Moderators<br /><b><span style='color: #F10E0E;'>Red</span></b> Users are on your friends list<br /><b><span style='color: lightgreen;'>Green</span></b> Users have reached the final rank, Official TP Legend!</td></tr></table>


</body>
</html>
<style>
.foot {
	border: 1px solid #666;
	font-size: 9px;
}
.foot a {
	color: #CCC;
	text-decoration: none;	
	font-weight: bold;
	font-style: italic;
	border-bottom: 1px solid #333;
}
</style>
</table>
<?php require_once "incfiles/foot.php"; ?>