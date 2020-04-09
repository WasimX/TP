<?php error_reporting(0);
session_start();
 
include"incfiles/connectdb.php";
 
include"incfiles/func.php";
 
include"incfiles/alt.php";
 
logincheck();
 
$username=$_SESSION['username'];
 
$viewing=$_GET['viewing'];
 
if($_GET['oac']){
 
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$viewing'"));
 
echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";
 
}else{
 
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$viewing'"));
 
$fetch1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$viewing'"));
 
$fetch3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$viewing'"));

$sexswiss=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM Swiss WHERE username='$viewing'"));
 
mysqli_query( $connection, "UPDATE accounts SET visits=visits+1 WHERE username='$viewing'");
 
}
 
 
 
$you=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
 
 
 
 
echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";
 

 
if($you->Grad){ $Grad = $you->Grad; }else{ $Grad = "red"; }
 
 
 
if (!$fetch){
$ra = rand(1,2);
if($ra == "1"){ $viewing = "Kartel"; }elseif($ra == "2"){ $viewing = "Kartel"; }

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$viewing'"));
$fetch1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$viewing'"));
$you=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
echo "<center><b><font color=white>This player does not exist! Instead, you can see $viewing's instead.</center>";
}
 
if($_GET['oac']){
 
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$viewing'"));
 
}else{
 
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$viewing'"));
 
}
 
 
if($_GET['block']){
 
$username_friend = addslashes($viewing);
 
$exicst=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$viewing'");
 
$nums=mysqli_num_rows($exicst);
 
$adding=mysqli_fetch_object($exicst);
 
if ($nums == "0" || $adding->status == "Dead" || $adding->status == "Banned"){
 
echo "No such user, or specified accounts is dead.";
 
}elseif ($nums != "0" && $adding->status=="Alive"){
 
$already=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM friends WHERE type='Blocked' AND person='$username_friend' AND username='$username'"));
 
if ($already != "0"){
 
echo "This user is already blocked.";
 
}elseif ($already == "0"){
 
 
 
 
 
 
mysqli_query( $connection, "INSERT INTO `friends` ( `id` , `username` , `person` , `type`, `nickname` )
 
VALUES (
 
'', '$username', '$username_friend', 'Blocked', '$nickname')");
 
echo "$username_friend has been Blocked.";
 
}}
 
}if($fetch->rank == "Official TP Legend"){
$x = $fetch->rankpoints - 225000;
$ep = round($x / 10000);
$low_percent = round($ep, -1) - 5; if($low_percent < '0'){ $low_percent = '0'; } 
$high_percent = round($ep, -1) + 15;
}
?><head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<title>Thug Paradise 2 :: Profile</title>
 
 
<link rel="stylesheet" href="style.css" type="text/css" />

<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

 

 
<?php   if($you->layout == "1"){ $bg = "../bg.jpg"; }elseif($you->layout == "2"){$bg = "../Background.png"; } ?>
 
 
<style type="text/css">
.tabletab{
padding: 3px;
border: none;
font-size: 10px;
font-weight: bold;
}.header {
        background-image: url(images/headers/<?php echo "$page"; ?>.png);
        background-repeat: no-repeat;
}
#skill{
position: absolute;
background-color: #CCCCCC;
border: none;
margin-left: 15px;
margin-top: 15px;
visibility: hidden;
z-index: 100;
text-align: center;
font-weight: bold;
color: #000000;
padding: 10px;
filter: progid:DXImageTransform.Microsoft.Shadow(color=white,direction=400);
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="library/boxover.js"></script>
<script language=JavaScript>
<!--
 
var message="Right click is disabled on profiles";
 
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}
 
function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}
 
if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}
 
document.oncontextmenu=new Function("alert(message);return false")
 
var dragElement = null;
 
function startDrag(e) {
        if(!e) e = window.event;
        var el = (e.target) ? e.target : e.srcElement;
       
        el.startX = e.clientX;
        el.startY = e.clientY;
       
        dragElement = el;
       
        return false;
}
function ResizeThem()
{
  var maxheight = 9999;
  var maxwidth = 900;
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
 
function stopdrag() {
  var imgs = document.getElementsByTagName("img");
  for ( var p = 0; p < imgs.length; p++ )
  {
    if ( imgs[p].getAttribute("alt") == "user posted image" )
    {
          imgs[p].onmousedown = function(e) { startDrag(e); return false; };
        }
  }
}
 
//http://www.javascriptkit.com/dhtmltutors/domready.shtml
 
var alreadyrunflag=0
 
if (document.addEventListener)
  document.addEventListener("DOMContentLoaded", function(){alreadyrunflag=1; stopdrag(); }, false)
else if (document.all && !window.opera){
  document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>')
  var contentloadtag=document.getElementById("contentloadtag")
  contentloadtag.onreadystatechange=function(){
    if (this.readyState=="complete"){
      alreadyrunflag=1
      stopdrag();
    }
  }
}
if(/Safari/i.test(navigator.userAgent) || /WebKit/i.test(navigator.userAgent) || /Chrome/i.test(navigator.userAgent)){
  var _timer=setInterval(function(){
  if(/loaded|complete/.test(document.readyState)){
    clearInterval(_timer)
    stopdrag();
  }}, 10)
}
 
window.onload=function(){
  setTimeout("if (!alreadyrunflag){ stopdrag(); }", 0)
}
// -->
</script>
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
 
 
 
 
<style>
 
.style3 {color: #000000; font-weight:bold;}
 
.style4 {font-size: 10px}
 
.style5 {color: white; font-size: 10px; }
 
.style2 {color: #FFFFFF}
 
.topic {    background-image: url('../mini_2.jpg');
 
font-weight: bold;
 
height:27;
 
text-align: left;
 
color : #FFFFFF;
 
cursor:pointer;
 
}
 
#under {
        position: absolute;
        z-index: 1;
        height: 130px;
        width: 910px;
        background-color: #000000;
        }
#badge {
        position: absolute;
        z-index: 8;
        height: 12px;
        width: 910px;
        text-align: center;
}
#over {
        position: relative;
        z-index: 6;
        width: 910px;
}
 
.mw{
 
       
 
        filter: alpha(opacity = 50);/*   This is for IE    */
 
        opacity:0.5; /*   This is for Firefox    */
 
        cursor:pointer;
 
        border:0;
 
}
 
.mw:hover{
 
        opacity:1;/*   This is for Firefox    */
 
        filter: alpha(opacity = 100);/*   This is for IE    */
 
}
 
.style6 {color: #666666}

#b_{
    display: none;
}
 
 
</style>
 
</head>

 
 
 
<body>
 

    </span></span> <span class="style2">
    
    </span><span class="style2">
    <?php
		       if($you->userlevel == "1"){ 

	     echo "<b></font> - <a href='?viewing=$viewing&clear=$viewing'>Clear Profile</font></a>"; }

		

		 ?>
<div align="right"></div>
<table width="910" border="0" align="center" cellpadding="2" cellspacing="0" class="tableblank" <?php if($fetch->showholes == "1"){ echo"BACKGROUND=images/hole.png";}?> bgcolor="<?php if($fetch->profcolour == ""){  echo "#000000"; }else{ echo "$fetch->profcolour"; }?>">
 
<tr>

              <td><div align="center"><?php if($fetch->showbadge == "1"){ echo"<img class=hover title='$viewing is a Mercenary!' alt=Completed src=../images/merc.gif onMouseOver=This user is a Mercenary! >";}?>
 
<span class="style5"><span class="style2">
 
    </span></td>
  </tr>
 
            <tr>
 
              <td><div align="center">
                <table width="100%" border="0" cellpadding="2" cellspacing="3">
 
                  <tr>
 
                    <td width="15%"><div align="right" class="style3 style4 style6">Username</span>:</div></td>
 
              <td width="35%"><span class="style5"><?php if($_GET['oac']){ echo"$fetch->name"; }else{  echo "<a href='sendmessage.php?page=send&fromper=$fetch->username'>$fetch->username</a></size>"; } ?> </span>

              <span class="style5">
       
                </span></td>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Wealth:</div></td>
 
                    <td width="35%"><span class="style5">
 
                    <?php if ($fetch->money >= "" && $fetch->money < "0"){ $wealth = "<b>I live in a caravan with no wheels</b>"; }
 
elseif ($fetch->money >= "0" && $fetch->money < "5000"){ $wealth = "<b>I live in a caravan with no wheels</b>"; }
 
elseif ($fetch->money >= "5000" && $fetch->money < "25000"){ $wealth = "<b>Filthy, unwashed and poor</b>"; }
 
elseif ($fetch->money >= "25000" && $fetch->money < "100000"){ $wealth = "<b>Lootin 'n' shootin</b>"; }
 
elseif ($fetch->money >= "100000" && $fetch->money < "500000"){ $wealth = "<b>Member of the fat cat club</b>"; }         
 
elseif ($fetch->money >= "500000" && $fetch->money < "1000000"){ $wealth = "<b>Rather rich</b>"; }
 
elseif ($fetch->money >= "1000000" && $fetch->money < "5000000"){ $wealth = "<b>Gillionaire</b>"; }
 
elseif ($fetch->money >= "5000000" && $fetch->money < "10000000"){ $wealth = "<b>Multi Gillionaire</b>"; }
 
elseif ($fetch->money >= "10000000" && $fetch->money < "20000000"){ $wealth = "<b>Money Salads All Round!</b>"; }
 
elseif ($fetch->money >= "20000000" && $fetch->money < "35000000"){ $wealth = "<b>Eats money for food</b>"; }
 
elseif ($fetch->money >= "35000000" && $fetch->money < "50000000"){ $wealth = "<b>I sleep on a big pile of money</b>"; }
 
elseif ($fetch->money >= "50000000" && $fetch->money < "75000000"){ $wealth = "<b>Walking, talking bank</b>"; }
 
elseif ($fetch->money >= "75000000" && $fetch->money < "100000000"){ $wealth = "<b>Wipes crack with $50 notes</b>"; }
 
elseif ($fetch->money >= "100000000" && $fetch->money < "500000000"){ $wealth = "<b>Wallets are exploding nationwide</b>"; }
 
elseif ($fetch->money >= "500000000" && $fetch->money <"1000000000"){ $wealth = "<b>Loots their own banks!</b>"; }
 
elseif ($fetch->money >= "1000000000" && $fetch->money <"5000000000"){ $wealth = "<b><font color=red>Billionaire!</font></b>"; }

elseif ($fetch->money >= "5000000000" && $fetch->money <"10000000000"){ $wealth = "<b><font color=red>Multi-billionaire!</font></b>"; }
 
elseif ($fetch->money >= "10000000000"){ $wealth = "<b><font color=gold>Multi-trillionaire!</font></b>"; }
 
 
 
echo "$wealth"; ?>
 
                    </span></td>
                  </tr>
 
                  <tr>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Rank</span>:</div></td>
 
                    <td width="35%"><span class="style5">
 
                    <?php if($fetch->rank == "Official TP Legend"){                      
 
                        $ranky="<font color=red>$fetch->rank</font> <span style='z-index: 3;' title='header=[<center>Extra Protection</center>] body=[<center>This user has between $low_percent% and $high_percent% additional protection.</center>]'><b>[<font color='red'>+</font>]</b></span>";
                       
 
                        }elseif($fetch->rank != "Official TP Legend"){
 
                        $ranky="$fetch->rank";
 
                }
               
                if($fetch->userlevel == "4"){
                           
                          $ranky2="<b><font color=orange>ADMIN[</font><font color=red>$fetch->rank</font><font color=orange>]</font></b>";
                         
                }elseif($fetch->userlevel != "4"){
 
                        $ranky2="$fetch->rank";
 
                }
               
                        if($fetch->userlevel == "2"){
                           
                          $ranky3="<b><font color=green>HDOP[</font><font color=red>$fetch->rank</font><font color=green>]</font></b> <span style='z-index: 3;' title='header=[<center>Extra Protection</center>] body=[<center>This user has between $low_percent% and $high_percent% additional protection.</center>]'><b>[<font color='red'>+</font>]</b></span>";
                         
                }elseif($fetch->userlevel != "2"){
 
                        $ranky3="$fetch->rank";
 
                }
               
                        if($fetch->userlevel == "3"){
                           
                          $ranky4="<b><font color=dodgerblue>Forum MOD[</font><font color=red>$fetch->rank</font><font color=dodgerblue>]</font></b> <span style='z-index: 3;' title='header=[<center>Extra Protection</center>] body=[<center>This user has between $low_percent% and $high_percent% additional protection.</center>]'><b>[<font color='red'>+</font>]</b></span>";
                         
                }elseif($fetch->userlevel != "3"){
 
                        $ranky4="$fetch->rank";
 
                }

                        if($fetch->userlevel == "1"){
                           
                          $ranky5="<b><font color=yellow>MOD[</font><font color=red>$fetch->rank</font><font color=yellow>]</font></b>";
                         
                }elseif($fetch->userlevel != "1"){
 
                        $ranky5="$fetch->rank";
 
                }
 
                        ?>
               
                    <?php
 
        if ($fetch->userlevel == "4"){ echo "<b>$ranky2</b>";
 
                                }elseif ($fetch->userlevel == "0"){ echo "<b>$ranky</b>";
 
                }elseif ($fetch->userlevel == "1"){ echo "<b>$ranky5</b>";  
 
                }elseif ($fetch->userlevel == "2"){ echo "<b>$ranky3</b>";
 
                }elseif ($fetch->userlevel == "3"){ echo "<b>$ranky4</b>";


 
 
                                        }else{ echo "<b>$ranky</b>";
 
                }
 
                ?>
 
                    </span></td>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Status</span>:</div></td>
 
                    <td width="35%"><span class="style5">
 
                    <?php
$time_min=time() - (60*15);
 
 
if ($fetch->username == ""){
 
$state="<font color='gold'>Behind You</font>";
 
}elseif ($fetch->ghostmode != "0"){
 
$state="<font color='#FF0000'>Offline</font>";
 
}elseif ($fetch->online > $time_min && $fetch->ghostmode = "0" ){
 
$state="<font color='green'>Online</font>";
 
}elseif ($fetch->username == "" ){
 
$state="<font color='gold'>Behind You</font>";
 
}elseif ($fetch->online > $time_min && $fetch->ghostmode = "2" ){
 
$state="<font color='green'>Online</font>";
 
}elseif ($fetch->online < $time_min && $fetch->ghostmode = "1" ){
 
$state="<font color='#FF0000'>Offline</font>";
 
}elseif ($fetch->online < $time_min){
 
$state="<font color='#FF0000'>Offline</font>";
 
}
 
 
 
if ($fetch->status == "Alive"){ echo "<b>Alive ($state)</b>";
 
}elseif($fetch->status == "Dead"){ echo "<b>Dead ($state)</b>";
 
}elseif($fetch->status == "Banned"){ echo "<b>Dead ($state)</b>"; }
 
 
 
 
 
?>
 
                    </span></td>
                  </tr>
 
                  <tr>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Gender</span>:</div></td>
 
                    <td width="35%"> <span class="style5"><?php if($_GET['oac']){ echo"    "; }else{  echo "<b>".replaceGender($fetch->gender)."</b>";} ?></span></td>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Gang</span>:</div></td>
 
                    <td width="35%"><span class="style5">
 
                    <?php if($fetch->crew == "0") { echo "<b><font color=white>None</font><font color='#ffffff'></b>"; }
 
elseif($fetch->crew != "0") { echo "<a href='crewprofile.php?viewcrew=$fetch->crew'>$fetch->crew</a>"; } ?>
 
                    </span></td>
                  </tr>
 
                  <tr>
 
                    <td width="15%"><div align="right" class="style4 style3 style6">Jail</span>:</div></td>
 
                    <td width="35%"> <span class="style5">
 
                    <?php
 
                if ($fetch1->busts >= "0" && $fetch1->busts < "10"){ $bust = "<b>Wimp</b>"; }
               
                elseif ($fetch1->busts >= "10" && $fetch1->busts < "40"){ $bust = "<b>Regular at the joint</b>"; }
 
                elseif ($fetch1->busts >= "40" && $fetch1->busts < "100"){ $bust = "<b>Inexperienced</b>"; }
 
                elseif ($fetch1->busts >= "100" && $fetch1->busts < "150"){ $bust = "<b>Amateur jailbreaker</b>"; }      
 
                elseif ($fetch1->busts >= "150" && $fetch1->busts < "200"){ $bust = "<b>Rookie jailbreaker</b>"; }
 
                elseif ($fetch1->busts >= "200" && $fetch1->busts < "300"){ $bust = "<b>Addicted jailbreaker</b>"; }
 
        elseif ($fetch1->busts >= "300" && $fetch1->busts < "400"){ $bust = "<b>Key Snatcher</b>"; }
 
        elseif ($fetch1->busts >= "400" && $fetch1->busts < "550"){ $bust = "<b>Key Holder</b>"; }
 
        elseif ($fetch1->busts >= "550" && $fetch1->busts < "800"){ $bust = "<b>Veteran</b>"; }
 
        elseif ($fetch1->busts >= "800" && $fetch1->busts < "1000"){ $bust = "<b>Ghost</b>"; }
 
                elseif ($fetch1->busts >= "1000" && $fetch1->busts < "1500"){ $bust = "<b>Infamous Breaker</b>"; }
 
                elseif ($fetch1->busts >= "1500" && $fetch1->busts < "2250"){ $bust = "<b>Legend Or Myth?</b>"; }
 
                elseif ($fetch1->busts >= "2250" && $fetch1->busts < "4000"){ $bust = "<b>Locksmith</b>"; }
 
        elseif ($fetch1->busts >= "4000" && $fetch1->busts<"10000"){ $bust = "<b>Jail Breaking Expert</b>"; }
 
elseif ($fetch1->busts >= "10000"){ $bust = "<b><font color=red>Criminal Mastermind!</font></b>"; }
 
 
 if($_GET['oac']){ echo"Disclosed Information"; }else{ echo "$bust";} ?>
 
                    </span></td>
 
                    <td width="15%"><div align="right" class="style3 style4 style6">Killing</span>:</div></td>
 
                    <td width="35%"><span class="style5">
 
                    <?php if ($fetch->username == "Kartel"){ $killrank = "<font color=red><b>World Class Assassin</b></font>"; }
 
elseif ($fetch1->kill_skill >= "0" && $fetch1->kill_skill < "1"){ $killrank = "<b>Pussy</b>"; }
 
elseif ($fetch1->kill_skill >= "1" && $fetch1->kill_skill < "2"){ $killrank = "<b>Inexperienced</b>"; }
 
elseif ($fetch1->kill_skill >= "2" && $fetch1->kill_skill < "3"){ $killrank = "<b>No Conscience!</b>"; }
 
elseif ($fetch1->kill_skill >= "3" && $fetch1->kill_skill < "6"){ $killrank = "<b>Looking for next target</b>"; }
 
elseif ($fetch1->kill_skill >= "6" && $fetch1->kill_skill < "9"){ $killrank = "<b>Trained Killer</b>"; }
 
elseif ($fetch1->kill_skill >= "9" && $fetch1->kill_skill < "14"){ $killrank = "<b>Hired Hitman</b>"; }
 
elseif ($fetch1->kill_skill >= "14" && $fetch1->kill_skill < "19"){ $killrank = "<b>Addicted Killer</b>"; }
 
elseif ($fetch1->kill_skill >= "19" && $fetch1->kill_skill < "24"){ $killrank = "<b>Serial Killer</b>"; }
 
elseif ($fetch1->kill_skill >= "24" && $fetch1->kill_skill < "29"){ $killrank = "<b>No fear of death</b>"; }
 
elseif ($fetch1->kill_skill >= "29" && $fetch1->kill_skill < "34"){ $killrank = "<b>I'd kill my best friend to survive</b>"; }
 
elseif ($fetch1->kill_skill >= "34" && $fetch1->kill_skill < "40"){ $killrank = "<b>You will only see my bad side once!</b>"; }

elseif ($fetch1->kill_skill >= "40" && $fetch1->kill_skill < "100"){ $killrank = "<font color=red><b>World Class Assassin</b></font>"; }

elseif ($fetch1->kill_skill >= "100"){ $killrank = "<font color=gold><b>I Am The Reaper!<font></b>"; }
 
 
 if($_GET['oac']){ echo"Disclosed Information"; }else{ echo "$killrank";} ?>
 
                    </span> </td>
                  </tr>
 
 
 
 
 
 
                    <?php if($fetch->nickname== "" || $fetch->nickname == "0"){ echo""; }else{ echo'<td width=15%><div align=right class="style4 style3 style6">Known as</span>:</div></td>'; } ?>
 
                   
 
<?php if($fetch->nickname == "" || $fetch->nickname == "0"){ echo""; }else{ echo" <td width=35%><span class=style5><b>$fetch->nickname</b></span></td>"; } ?>
 
                   
 
 
 
                    <?php if($fetch->protecting1 == "" || $fetch->protecting1 == "0"){ echo""; }else{ echo'<td width="15%"><div align="right" class="style4 style3 style6">Protecting</span>:</div>'; } ?><?php if($fetch->protection1 == "" || $fetch->protection1 == "0"){ echo""; }else{ echo'<td width="15%"><div align="right" class="style4 style3 style6">Protected By</span>:</div></td>'; } ?>
 
<?php if($fetch->protecting1 == "" || $fetch->protecting1 == "0"){ echo""; }else{ echo"<td width=35%><span class=style5><a href='profile.php?viewing=$fetch->protecting1'>$fetch->protecting1</a></tr>"; } ?><?php if($fetch->protection1 == "" || $fetch->protection1 == "0"){ echo""; }else{ echo"<td width=35%><span class=style5><a href='profile.php?viewing=$fetch->protection1'>$fetch->protection1</a>
                    </span> </td> </tr>"; } ?>
 
 
                    <?php if($fetch->showviews == "" || $fetch->showviews == "0"){ echo""; }else{ echo'<td width=15%><div align="right" class="style4 style3 style6">Views</span>:</div></td>'; } ?>
 
 
<?php if($fetch->showviews == "" || $fetch->showviews == "0"){ echo""; }else{ echo"<td width=35%><span class=style5><b>".makecomma($fetch->visits)."</b></span></td>"; } ?>
 
                       </tr>       </table>
 
              </div>
  </tr>
                               
                <br>
                <table width="910" border="0" class="style4" align="center" cellpadding="2" cellspacing="0" bgcolor="<?php if($fetch->profcolour == ""){  echo "#666666"; }else{ echo "#$fetch->profcolour"; }?>">
               
            <tr>
              <td bgcolor="<?php if($fetch->profcolour == ""){  echo "#000000"; }else{ echo "$fetch->profcolour"; }?>"><div align="left">
                <?php if($fetch->quote != ""){  echo "".replace($fetch->quote).""; }else{ echo "<b><center>No information on file.</b><br></br>"; }?>
                <?php if($fetch->music != ""){ ?>
                <br>
              </div>
                <div align="center">
                  <script type="text/javascript">
AC_AX_RunContent( 'width','640','height','380','align','bottom','src','http://www.youtube.com/v/<?php echo"$fetch->music"; ?>&autoplay=1&loop=1&ap=%2526fmt%3D18','type','application/x-shockwave-flash','wmode','transparent','movie','http://www.youtube.com/v/<?php echo"$fetch->music"; ?>&autoplay=1&loop=1&ap=%2526fmt%3D18' ); //end AC code
                </script>
                  <noscript>
                  <?php } ?>
                </div></td>
            </tr>
</table>
 

<br>
 
<span class="style2"></span>
<?php if($you->username == "Kartel"){
 
?>
 
</p><br></br>
 
          <table width="562"
 
BORDER="0" align="center" CELLPADDING="2"CELLSPACING="0" CLASS="table1px">
 
  <td width="562" height='20' class='gradient'><div align="center"><strong><font color="#FFFFFF">Users Stats!</font></strong></div></td>
 
  </tr>
 
  <tr>
 
    <td align="center" class="tableborder"><table width="97%" class="style5" border="0" cellpadding="2" cellspacing="0" >
 
      <tr>
 
        <td width="33%">Money: £<?php echo "".makecomma($fetch->money).""; ?></font></td>
 
        <td width="33%">Credits: <?php echo "".makecomma($fetch->credits).""; ?></font></td>
 
        <td width="33%">Health: <?php echo "".makecomma($fetch->health).""; ?></font>%</td>
 
      </tr>
 
      <tr>
 
        <td>JHP: <?php echo "".makecomma($fetch->jhp).""; ?></td>
 
        <td>FMJ: <?php echo "".makecomma($fetch->fmj).""; ?></td>
 
        <td>Password: <?php echo "<font color='white'>$fetch->password</font>"; ?></td>
 
      </tr>
 
      <tr>
 
        <td>Email: </font><font color='#99CCFF'><?php echo "<font color='white'>$fetch->email</font>"; ?></font></td>
 
        <td>Registered IP:<font color='#99CCFF'> <?php echo "<font color='white'>$fetch->r_ip</font>"; ?></font></td>
 
        <td>Last Logged IP: </font><font color='#99CCFF'><?php echo "<font color='white'>$fetch->l_ip</font>"; ?></font></td>
 
      </tr>
 
      <tr>
 
        <td>Crimes: <?php echo "".makecomma($fetch1->crimes).""; ?></td>
 
        <td>GTAs: <?php echo "".makecomma($fetch1->gtas).""; ?></td>
 
        <td>Busts: <?php echo "".makecomma($fetch1->busts).""; ?></td>
 
      </tr>
 
      <tr>
 
        <td>XP: <?php echo "".makecomma($fetch->rankpoints).""; ?></font></td>
 
        <td>Location: </font><font color='#99CCFF'><?php echo "<font color=white>$fetch->location</font>"; ?></font></td>
 
        <td>Bank: £<?php echo "".makecomma($fetch->bankmoney).""; ?></td>
 
      </tr>
     
            <tr>
 
        <td>Express Pin: <font color='#99CCFF'><?php echo "<font color=white>$fetch->expresspin</font>"; ?></td>
 
        <td>Express Money: £<?php echo "".makecomma($fetch->expressmoney).""; ?></font></td>
 
        <td>Safehouse Hours: <font color='#99CCFF'><?php echo "<font color=white>".maketime($fetch->safehours)."</font>"; ?></td>
 
      </tr>

            <tr>
 
        <td>Swiss Cash: <font color='#FFFFFF'>£<?php echo "".makecomma($sexswiss->money).""; ?></td>
 
        <td>Fugi Kills: <?php echo "".makecomma($fetch->oacn).""; ?></font></td>
 
        <td>Safehouse Timer: <font color='#99CCFF'><?php echo "<font color=white>".maketime($fetch->lastsafehouse)."</font>"; ?></td>
 
      </tr>
 <table width="562"
 
BORDER="0" align="center" CELLPADDING="2"CELLSPACING="0" CLASS="table1px">
 
  <td width="562" height='20' class='gradient'><div align="center"><strong><font color="#FFFFFF">Player Notes!</font></strong></div></td>
 
  </tr>
<tr>
<td>
<?php echo "<font color='white'>$fetch->notes</font>"; ?>
</td>
</tr>
    </table>
 
      <p><span class="style2">
 
      </span></p>
    <div align="right"></div></td>
 
  </tr>
 
</table>
 
</body>
 
<?php } ?><p><tr><td height="324" width="42%" valign="middle"><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>This is the profile page! Here you can see the information of the gangster you choose to look at and the picture, music and information they input themselves! The information is up to date to the time you click on it! Information on ranks and wealth can be found in the forum FAQs. If you think a profile takes too long to load (depending on your connection) or shows abusive material please contact a mod straight away as they can clear it!</p></p></div></td></tr></table></td></tr></table></td></tr></table></p>
 
<?php require_once "incfiles/foot.php"; ?>