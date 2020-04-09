<?php 
error_reporting(0);
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Thug Paradise 2</title>
<link href="style.css" rel="stylesheet" type="text/css" />
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

<body>


<?php 
$engweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='England'")); 
$germweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='Pakistan'")); 
$fraweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='Jamaica'")); 
$spaweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='America'")); 
$chiweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='Japan'")); 
$rusweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='Germany'")); 
$itaweapon=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='China'")); 

$engarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='England'")); 
$germarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='Pakistan'")); 
$fraarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='Jamaica'")); 
$spaarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='America'")); 
$chiarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='Japan'")); 
$rusarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='Germany'")); 
$itaarmour=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='China'")); 

$engbullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='England'")); 
$germbullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='Pakistan'")); 
$frabullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='Jamaica'")); 
$spabullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='America'")); 
$chibullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='Japan'")); 
$rusbullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='Germany'"));
$itabullet=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='China'")); 

$engairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='England'")); 
$germairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='Pakistan'")); 
$fraairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='Jamaica'")); 
$spaairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='America'")); 
$chiairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='Japan'")); 
$rusairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='Germany'"));
$itaairport=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='China'")); 

$engbj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='England'")); 
$germbj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='Pakistan'")); 
$frabj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='Jamaica'")); 
$spabj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='America'")); 
$chibj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='Japan'")); 
$rusbj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='Germany'"));
$itabj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='China'")); 

$engroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='England'")); 
$germroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='Pakistan'")); 
$fraroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='Jamaica'")); 
$sparoulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='America'")); 
$chiroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='Japan'")); 
$rusroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='Germany'"));
$itaroulette=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM roulette WHERE location='China'"));

$engslots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='England'")); 
$germslots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='Pakistan'")); 
$fraslots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='Jamaica'")); 
$spaslots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='America'")); 
$chislots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='Japan'")); 
$russlots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='Germany'"));
$itaslots=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='China'"));
 
$engrace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='England'")); 
$germrace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='Pakistan'")); 
$frarace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='Jamaica'")); 
$sparace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='America'")); 
$chirace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='Japan'")); 
$rusrace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='Germany'"));
$itarace=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='China'"));

$gangEngland=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='England'")); 
$gangPakistan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Pakistan'")); 
$gangJamaica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Jamaica'")); 
$gangAmerica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='America'")); 
$gangJapan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Japan'")); 
$gangGermany=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Germany'"));
$gangChina=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='China'"));

$engrps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='England'")); 
$germrps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='Pakistan'")); 
$frarps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='Jamaica'")); 
$sparps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='America'")); 
$chirps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='Japan'")); 
$rusrps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='Germany'"));
$itarps=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='China'"));
?>

<body>
<div align="center">
  <table width="95%" border="0" cellpadding="0" cellspacing="0" class="table1px">
	<tr>
      <td class="gradient" height="30" align="center"><b>Property / Location</u></td>
      <td class="gradient" align="center"><b>England</b></td>
      <td class="gradient" align="center"><b>Pakistan</b></td>
      <td class="gradient" align="center"><b>Jamaica</b></td>
      <td class="gradient" align="center"><b>America</b></td>
      <td class="gradient" align="center"><b>Japan</b></td>
      <td class="gradient" align="center"><b>Germany</b></td>
	  <td class="gradient" align="center"><b>China</b></td>
    </tr>
    <tr>
<td class="tableborder"><div align="center"><b>Weapon Store</b></div></td>
<td class="tableborder"><div align="center"><b><?php if($engweapon->owner == "0") { echo ""; } elseif ($engweapon->owner !='0') { 
echo "<a href='profile.php?viewing=$engweapon->owner'><u>$engweapon->owner</u></a>";} ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($germweapon->owner == "0") { echo ""; } elseif ($germweapon->owner !='0') { echo "<a href='profile.php?viewing=$germweapon->owner'><u>$germweapon->owner</u></a>"; } ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($fraweapon->owner == "0") { echo ""; } elseif ($fraweapon->owner !='0') { echo "<a href='profile.php?viewing=$fraweapon->owner'><u>$fraweapon->owner</u></a>"; } ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($spaweapon->owner == "0") { echo ""; } elseif ($spaweapon->owner !='0') { echo "<a href='profile.php?viewing=$spaweapon->owner'><u>$spaweapon->owner</u></a>"; } ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($chiweapon->owner == "0") { echo ""; } elseif ($chiweapon->owner !='0') { echo "<a href='profile.php?viewing=$chiweapon->owner'><u>$chiweapon->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($rusweapon->owner == "0") { echo ""; } elseif ($rusweapon->owner !='0') { echo "<a href='profile.php?viewing=$rusweapon->owner'><u>$rusweapon->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($itaweapon->owner == "0") { echo ""; } elseif ($itaweapon->owner !='0') { echo "<a href='profile.php?viewing=$itaweapon->owner'><u>$itaweapon->owner</u></a>"; } ?></b></div></td>
    </tr>
    <tr> 
<td class="tableborder"bordercolor="black"><div align="center"><b>Armour Store</b> </div></td>
<td class="tableborder"><div align="center"><b><?php if($engarmour->owner == "0") { echo ""; } elseif ($engarmour->owner !='0') { echo "<a href='profile.php?viewing=$engarmour->owner'><u>$engarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($germarmour->owner == "0") { echo ""; } elseif ($germarmour->owner !='0') { echo "<a href='profile.php?viewing=$germarmour->owner'><u>$germarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($fraarmour->owner == "0") { echo ""; } elseif ($fraarmour->owner !='0') { echo "<a href='profile.php?viewing=$fraarmour->owner'><u>$fraarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($spaarmour->owner == "0") { echo ""; } elseif ($spaarmour->owner !='0') { echo "<a href='profile.php?viewing=$spaarmour->owner'><u>$spaarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($chiarmour->owner == "0") { echo ""; } elseif ($chiarmour->owner !='0') { echo "<a href='profile.php?viewing=$chiarmour->owner'><u>$chiarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($rusarmour->owner == "0") { echo ""; } elseif ($rusarmour->owner !='0') { echo "<a href='profile.php?viewing=$rusarmour->owner'><u>$rusarmour->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($itaarmour->owner == "0") { echo ""; } elseif ($itaarmour->owner !='0') { echo "<a href='profile.php?viewing=$itaarmour->owner'><u>$itaarmour->owner</u></a>"; } ?></b></div></td>
    </tr>
    <tr>
<td class="tableborder"><div align="center"><b>Bullet Factory</b> </div></td>
<td class="tableborder"><div align="center"><b><?php if($engbullet->owner == "0") { echo ""; } elseif ($engbullet->owner !='0') { echo "<a href='profile.php?viewing=$engbullet->owner'><u>$engbullet->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($germbullet->owner == "0") { echo ""; } elseif ($germbullet->owner !='0') { echo "<a href='profile.php?viewing=$germbullet->owner'><u>$germbullet->owner</u></a>"; } ?></b></div></td> 
<td class="tableborder"><div align="center"><b><?php if($frabullet->owner == "0") { echo ""; } elseif ($frabullet->owner !='0') { echo "<a href='profile.php?viewing=$frabullet->owner'><u>$frabullet->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($spabullet->owner == "0") { echo ""; } elseif ($spabullet->owner !='0') { echo "<a href='profile.php?viewing=$spabullet->owner'><u>$spabullet->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($chibullet->owner == "0") { echo ""; } elseif ($chibullet->owner !='0') { echo "<a href='profile.php?viewing=$chibullet->owner'><u>$chibullet->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($rusbullet->owner == "0") { echo ""; } elseif ($rusbullet->owner !='0') { echo "<a href='profile.php?viewing=$rusbullet->owner'><u>$rusbullet->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($itabullet->owner == "0") { echo ""; } elseif ($itabullet->owner !='0') { echo "<a href='profile.php?viewing=$itabullet->owner'><u>$itabullet->owner</u></a>"; } ?></b></div></td>
    </tr> 
    
    <tr>
      <td class="tableborder"><div align="center"><b>The Airport</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engairport->owner == "0"){ echo ""; }elseif  ($engairport->owner != "0"){ echo "<a href='profile.php?viewing=$engairport->owner'><u>$engairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germairport->owner == "0"){ echo ""; }elseif  ($germairport->owner != "0"){ echo "<a href='profile.php?viewing=$germairport->owner'><u>$germairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($fraairport->owner == "0"){ echo ""; }elseif  ($fraairport->owner != "0"){ echo "<a href='profile.php?viewing=$fraairport->owner'><u>$fraairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($spaairport->owner == "0"){ echo ""; }elseif  ($spaairport->owner != "0"){ echo "<a href='profile.php?viewing=$spaairport->owner'><u>$spaairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chiairport->owner == "0"){ echo ""; }elseif  ($chiairport->owner != "0"){ echo "<a href='profile.php?viewing=$chiairport->owner'><u>$chiairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($rusairport->owner == "0"){ echo ""; }elseif  ($rusairport->owner != "0"){ echo "<a href='profile.php?viewing=$rusairport->owner'><u>$rusairport->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($itaairport->owner == "0"){ echo ""; }elseif  ($itaairport->owner != "0"){ echo "<a href='profile.php?viewing=$itaairport->owner'><u>$itaairport->owner</u></a>"; } ?></b></div></td>
    </tr> 
    <tr>
      <td class="tableborder"><div align="center"><b>BlackJack</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engbj->bjowner == "0"){ echo ""; }elseif ($engbj->bjowner != "0"){ echo "<a href='profile.php?viewing=$engbj->bjowner'><u>$engbj->bjowner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germbj->bjowner == "0"){ echo ""; }elseif ($germbj->bjowner != "0"){ echo "<a href='profile.php?viewing=$germbj->bjowner'><u>$germbj->bjowner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($frabj->bjowner == "0"){ echo ""; }elseif ($frabj->bjowner != "0"){ echo "<a href='profile.php?viewing=$frabj->bjowner'><u>$frabj->bjowner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($spabj->bjowner == "0"){ echo ""; }elseif ($spabj->bjowner != "0"){ echo "<a  href='profile.php?viewing=$spabj->bjowner'><u>$spabj->bjowner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chibj->bjowner == "0"){ echo ""; }elseif ($chibj->bjowner != "0"){ echo "<a href='profile.php?viewing=$chibj->bjowner'><u>$chibj->bjowner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($rusbj->bjowner == "0"){ echo ""; }elseif ($rusbj->bjowner != "0"){ echo "<a href='profile.php?viewing=$rusbj->bjowner'><u>$rusbj->bjowner</u></a>"; } ?></b></div></td> 
<td class="tableborder"><div align="center"><b><?php if ($itabj->bjowner == "0"){ echo ""; }elseif ($itabj->bjowner != "0"){ echo "<a href='profile.php?viewing=$itabj->bjowner'><u>$itabj->bjowner</u></a>"; } ?></b></div></td> 
    </tr> 
            <tr>
      <td class="tableborder"><div align="center"><b>BlackJack Maxbet</b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($engbj->bjmaxbet).""; ?></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($germbj->bjmaxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($frabj->bjmaxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($spabj->bjmaxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($chibj->bjmaxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($rusbj->bjmaxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($itabj->bjmaxbet).""; ?></b></div></td>
    </tr> 
         <tr>
      <td class="tableborder"><div align="center"><b>RPS</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engrps->owner == "0"){ echo ""; }elseif ($engrps->owner != "0"){ echo "<a href='profile.php?viewing=$engrps->owner'><u>$engrps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germrps->owner == "0"){ echo ""; }elseif ($germrps->owner != "0"){ echo "<a href='profile.php?viewing=$germrps->owner'><u>$germrps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($frarps->owner == "0"){ echo ""; }elseif ($frarps->owner != "0"){ echo "<a href='profile.php?viewing=$frarps->owner'><u>$frarps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($sparps->owner == "0"){ echo ""; }elseif ($sparps->owner != "0"){ echo "<a href='profile.php?viewing=$sparps->owner'><u>$sparps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chirps->owner == "0"){ echo ""; }elseif ($chirps->owner != "0"){ echo "<a href='profile.php?viewing=$chirps->owner'><u>$chirps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($rusrps->owner == "0"){ echo ""; }elseif ($rusrps->owner != "0"){ echo "<a href='profile.php?viewing=$rusrps->owner'><u>$rusrps->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($itarps->owner == "0"){ echo ""; }elseif ($itarps->owner != "0"){ echo "<a href='profile.php?viewing=$itarps->owner'><u>$itarps->owner</u></a>"; } ?></b></div></td>
    </tr>
                            <tr>
      <td class="tableborder"><div align="center"><b>RPS Maxbet</b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($engrps->maxbet).""; ?></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($germrps->maxbet).""; ?></b></div></td> 
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($frarps->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($sparps->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($chirps->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($rusrps->maxbet).""; ?></b></div></td> 
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($itarps->maxbet).""; ?></b></div></td>
    </tr>
    <tr>
      <td class="tableborder"><div align="center"><b>Racetrack</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engrace->owner == "0"){ echo ""; }elseif ($engrace->owner != "0"){ echo "<a href='profile.php?viewing=$engrace->owner'><u>$engrace->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germrace->owner == "0"){ echo ""; }elseif ($germrace->owner != "0"){ echo "<a href='profile.php?viewing=$germrace->owner'><u>$germrace->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($frarace->owner == "0"){ echo ""; }elseif ($frarace->owner != "0"){ echo "<a href='profile.php?viewing=$frarace->owner'><u>$frarace->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($sparace->owner == "0"){ echo ""; }elseif ($sparace->owner != "0"){ echo "<a  href='profile.php?viewing=$sparace->owner'><u>$sparace->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chirace->owner == "0"){ echo ""; }elseif ($chirace->owner != "0"){ echo "<a href='profile.php?viewing=$chirace->owner'><u>$chirace->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($rusrace->owner == "0"){ echo ""; }elseif ($rusrace->owner != "0"){ echo "<a href='profile.php?viewing=$rusrace->owner'><u>$rusrace->owner</u></a>"; } ?></b></div></td> 
<td class="tableborder"><div align="center"><b><?php if ($itarace->owner == "0"){ echo ""; }elseif ($itarace->owner != "0"){ echo "<a href='profile.php?viewing=$itarace->owner'><u>$itarace->owner</u></a>"; } ?></b></div></td> 
    </tr> 
            <tr>
      <td class="tableborder"><div align="center"><b>Racetrack Maxbet</b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($engrace->maxbet).""; ?></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($germrace->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($frarace->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($sparace->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($chirace->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($rusrace->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($itarace->maxbet).""; ?></b></div></td>
    </tr> 
    
    <tr>
      <td class="tableborder"><div align="center"><b>Roulette</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engroulette->owner == "0"){ echo ""; }elseif ($engroulette->owner != "0"){ echo "<a href='profile.php?viewing=$engroulette->owner'><u>$engroulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germroulette->owner == "0"){ echo ""; }elseif ($germroulette->owner != "0"){ echo "<a href='profile.php?viewing=$germroulette->owner'><u>$germroulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($fraroulette->owner == "0"){ echo ""; }elseif ($fraroulette->owner != "0"){ echo "<a href='profile.php?viewing=$fraroulette->owner'><u>$fraroulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($sparoulette->owner == "0"){ echo ""; }elseif ($sparoulette->owner != "0"){ echo "<a href='profile.php?viewing=$sparoulette->owner'><u>$sparoulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chiroulette->owner == "0"){ echo ""; }elseif ($chiroulette->owner != "0"){ echo "<a href='profile.php?viewing=$chiroulette->owner'><u>$chiroulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($rusroulette->owner == "0"){ echo ""; }elseif ($rusroulette->owner != "0"){ echo "<a href='profile.php?viewing=$rusroulette->owner'><u>$rusroulette->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($itaroulette->owner == "0"){ echo ""; }elseif ($itaroulette->owner != "0"){ echo "<a href='profile.php?viewing=$itaroulette->owner'><u>$itaroulette->owner</u></a>"; } ?></b></div></td>
    </tr>
                    <tr>
      <td class="tableborder"><div align="center"><b>Roulette Maxbet</b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($engroulette->max).""; ?></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($germroulette->max).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($fraroulette->max).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($sparoulette->max).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($chiroulette->max).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($rusroulette->max).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($itaroulette->max).""; ?></b></div></td>
    </tr> 
    
        <tr>
      <td class="tableborder"><div align="center"><b>Slots</b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($engslots->owner == "0"){ echo ""; }elseif ($engslots->owner != "0"){ echo "<a href='profile.php?viewing=$engslots->owner'><u>$engslots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($germslots->owner == "0"){ echo ""; }elseif ($germslots->owner != "0"){ echo "<a href='profile.php?viewing=$germslots->owner'><u>$germslots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($fraslots->owner == "0"){ echo ""; }elseif ($fraslots->owner != "0"){ echo "<a href='profile.php?viewing=$fraslots->owner'><u>$fraslots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($spaslots->owner == "0"){ echo ""; }elseif ($spaslots->owner != "0"){ echo "<a href='profile.php?viewing=$spaslots->owner'><u>$spaslots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($chislots->owner == "0"){ echo ""; }elseif ($chislots->owner != "0"){ echo "<a href='profile.php?viewing=$chislots->owner'><u>$chislots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($russlots->owner == "0"){ echo ""; }elseif ($russlots->owner != "0"){ echo "<a href='profile.php?viewing=$russlots->owner'><u>$russlots->owner</u></a>"; } ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if ($itaslots->owner == "0"){ echo ""; }elseif ($itaslots->owner != "0"){ echo "<a href='profile.php?viewing=$itaslots->owner'><u>$itaslots->owner</u></a>"; } ?></b></div></td>
    </tr>
                            <tr>
      <td class="tableborder"><div align="center"><b>Slots Maxbet</b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($engslots->maxbet).""; ?></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($germslots->maxbet).""; ?></b></div></td> 
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($fraslots->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($spaslots->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($chislots->maxbet).""; ?></b></div></td>
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($russlots->maxbet).""; ?></b></div></td> 
<td class="tableborder"><div align="center"><?php echo "&#163;".makecomma($itaslots->maxbet).""; ?></b></div></td>
    </tr>
    
  </table>  
  
   <div align="center">
  <table width="95%" border="0" cellpadding="0" cellspacing="0" class="table1px">
	<tr>
      <td class="gradient" width="11%" height="30" align="center"><b>Gang Country</u></td>
      <td class="gradient" width="11%" align="center"><b>England</b></td>
      <td class="gradient" width="11%" align="center"><b>Pakistan</b></td>
      <td class="gradient" width="11%" align="center"><b>Jamaica</b></td>
      <td class="gradient" width="11%" align="center"><b>America</b></td>
      <td class="gradient" width="11%" align="center"><b>Japan</b></td>
      <td class="gradient" width="11%" align="center"><b>Germany</b></td>
	  <td class="gradient" width="11%" align="center"><b>China</b></td>
    </tr>
    <tr>
<td class="tableborder"><div align="center"><b>Gang Name</b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangEngland->gang == "0"){ echo ""; } elseif ($gangEngland->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangEngland->gang'><u>$gangEngland->gang</u></a>";
} ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangPakistan->gang == "0"){ echo ""; } elseif ($gangPakistan->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangPakistan->gang'><u>$gangPakistan->gang</u></a>";
} ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangJamaica->gang == "0"){ echo ""; } elseif ($gangJamaica->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangJamaica->gang'><u>$gangJamaica->gang</u></a>";
} ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangAmerica->gang == "0"){ echo ""; } elseif ($gangAmerica->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangAmerica->gang'><u>$gangAmerica->gang</u></a>";
} ?></a></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangJapan->gang == "0"){ echo ""; } elseif ($gangJapan->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangJapan->gang'><u>$gangJapan->gang</u></a>";
} ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangGermany->gang == "0"){ echo ""; } elseif ($gangGermany->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangGermany->gang'><u>$gangGermany->gang</u></a>";
} ?> </b></div></td>
<td class="tableborder"><div align="center"><b><?php if($gangChina->gang == "0"){ echo ""; } elseif ($gangChina->gang !=='0') { echo "<a href='crewprofile.php?viewcrew=$gangChina->gang'><u>$gangChina->gang</u></a>";
} ?> </b></div></td>
    </tr>
    <tr> 
<td class="tableborder"bordercolor="black"><div align="center"><b>Tax Rate</b> </div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangEngland->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangPakistan->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangJamaica->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangAmerica->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangJapan->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangGermany->tax)."%"; ?></b></div></td>
<td class="tableborder"><div align="center"><b><?php echo "".makecomma($gangChina->tax)."%"; ?></b></div></td>
    </tr>

</div>
</body>
</html><?php require_once "incfiles/foot2.php"; ?>
