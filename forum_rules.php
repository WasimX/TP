<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
$query2=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username' LIMIT 1");
$info = mysqli_fetch_object($query2);
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Posts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<style>body{font-family:Verdana,Tahoma,Arial,Trebuchet MS,Sans-Serif,Georgia,Courier,Times New Roman,Serif;margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;color:#FFFFCC;font-size:11px;line-height:135%;margin:0px;padding:0px;background-image:url(images/gp_bg_lines.gif);background-position:63px 0;background-attachment:fixed;}.post{padding:5px;color:#FFFFCC;background:#161616;font-family:Verdana,Tahoma,Arial,Trebuchet MS,Sans-Serif,Georgia,Courier,Times New Roman,Serif;font-size:11px;line-height:135%;margin:0px;}.postdetails2{background:#161616;border:2px solid #454545;color:#FFFFCC;}.postspace{padding:7px;background:#000000;border:1px solid #454545;}.border{border:2px solid #454545;}.style2{font-size:10px}a:link{text-decoration:none;color:#33CCFF;font-weight:bold;}a:visited{text-decoration:none;color:#33CCFF;font-weight:bold;}a:active{text-decoration:none;color:#33CCFF;font-weight:bold;}a:hover{color:#FFFFFF;font-weight:bold;text-decoration:blink;}.gradient{font-family:Verdana;font-size:11px;font-style:normal;line-height:30px;font-weight:bold;color:#FFFFFF;background-image:url(images/tile_sub.gif);background-repeat:repeat-x;}.style4{font-weight:bold;font-size:12px;}.tableborder2{font-family:Verdana,Tahoma,Arial,Trebuchet MS,Sans-Serif,Georgia,Courier,Times New Roman,Serif;font-size:11px;color:#FFFFFF;background-color:#000000;background-image:url(images/tableback.png);background-repeat:no-repeat;background-position:center top;padding:5px;}</style>
<div id="dhtmltooltip"></div>







<script type="text/javascript">







var offsetxpoint=-60



var offsetypoint=20



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



var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20



var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20







var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000







if (rightedge<tipobj.offsetWidth)



tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"



else if (curX<leftedge)



tipobj.style.left="5px"



else



tipobj.style.left=curX+offsetxpoint+"px"







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
<script type="text/javascript">

var offsetxpoint=-60
var offsetypoint=20
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
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

if (rightedge<tipobj.offsetWidth)
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
tipobj.style.left=curX+offsetxpoint+"px"

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

<script language=JavaScript>
<!--
function ResizeThem()
{
  var maxheight = 9999;
  var maxwidth = 590;
  var imgs = document.getElementsByTagName("img");
  for ( var p = 0; p < imgs.length; p++ )
  {
    if ( imgs[p].getAttribute("alt") == "user posted image" )
    {
      var w = parseInt( imgs[p].width );
      var h = parseInt( imgs[p].height );
      if ( w > maxwidth )
      {
        imgs[p].style.cursor = "pointer";
        imgs[p].onclick = function( )
        {
          var iw = window.open (this.src);
          iw.focus();
        };
        h = ( maxwidth / w ) * h;
        w = maxwidth;
        imgs[p].height = h;
        imgs[p].width = w;
      }
      if ( h > maxheight )
      {
        imgs[p].style.cursor="pointer";
        imgs[p].onclick = function( )
        { 
          var iw = window.open (this.src);
          iw.focus( );
        };
        imgs[p].width = ( maxheight / h ) * w;
        imgs[p].height = maxheight;
      }
    }
  }
}
function setvisibility (idname) {
	block = document.getElementById(idname);
	block.style.display = 'inline';
}
// --> 
</script>
<!--[if lte IE 6]>
<script type="text/javascript" src="png.js"></script>
<![endif]-->
</head>
<body onLoad="ResizeThem()">
<div align="center">
<br>
<table width="550" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gradient"><div align="center">Active forum members within last 15 minutes</div></td>
</tr>
<tr>
<td class="tableborder">5 active posters: <?php $j=mysqli_query( $connection, "SELECT * FROM accounts ORDER BY lastpost DESC LIMIT 5");
while($d=mysqli_fetch_object($j)){
echo "<a href='profile.php?viewing=$d->username'><b>$d->username</b></a><img title='$d->lastpost' height='12' width='12' src='../images/exclamation.png'>, "; } ?><br/><br/>Displays from most active to least active. GF = Gang forum.</td>
</tr>
</table>
<br>
<table width="550" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gradient"><div align="center">Forum Rules &amp; Guidelines</div></td>
</tr>
<tr>
<td class="tablebackground"><p>Please follow these rules when using the forum. It is also advised that you maintain a positive, encouraging attitude towards other players, as no one likes a whinge. <br>
<br>
The following rules apply and if broken, your thread will be deleted
and you may loose your account depending on the severity.<br>
<br>
These are in order of naughtiness:</p>
<ul>
<li>No pornography whatsoever. People of all ages play TP!</li>
<li>Upload, post, email, transmit or otherwise make available any Content that is unlawful, harmful, threatening, abusive, harassing, tortuous, defamatory, vulgar, obscene, libellous, invasive of another's privacy, hateful, or racially, ethnically or otherwise objectionable - As stated in the <a href="tos.php" target="_self">TOS</a>.</li>
<li>No Abuse. People are here to enjoy TP and not be bullied.</li>
<li>Stalk or otherwise harass another player. </li>
<li>No Advertisements for any other website / game.</li>
<li>Spam (multple threads on same subject). There are various methods in place to prevent spam, but it's still possible.</li>
<li>Begging. This includes credits for revival or any other in-game property that is of worth.</li>
<li> Posting in the wrong forum. The Black Market and OC forums were designed to make things easier. Please keep ALL buying / selling in the Black Market. This includes properties, items and pictures etc.</li>
<li> Making a new thread about a topic that already exists. For example, all kill witness statements should be kept in the &quot;who killed who&quot; thread.</li>
<li>No pointless threads which are unnecessary.</li>
</ul>
<p>Forum mods are allowed to moderate the forum by deleting any threads / posts which are in violation of the above rules. They cannot modkill, create an important or stickied topic, or post in a locked topic. These things are given to mods only.<br>
<br>
<a href="fmodrules.php">The Forum Mod Guidelines can be found here.</a><br>
<br>
Rules produced by Kartel :)
</p></td>
</tr>
</table>
<br>
