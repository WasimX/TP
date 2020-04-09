<?php



include_once "incfiles/func.php";



logincheck();



$query=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username' LIMIT 1");



$info = mysqli_fetch_object($query);



$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");



$fetch = mysqli_fetch_object($query1);



////VERIFYING CREDS\\\\



if(strip_tags($_POST['verifybutton'])){



		   



$verifyperson = (strip_tags($_POST['verifyperson']));



		   



$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)



VALUES (



'', '$verifyperson', 'Kartel', '<b>$username currently has ".makecomma($fetch->credits)." credits!</b> Please check that this verification message was sent by <a href=profile.php?viewing=Kartel>Kartel</a> to be sure that these credits really do exist!', 'Credit Verification', '$date', '0')");





echo "<center>Credits successfully verified to $verifyperson (they will recieve an instant message from Kartel!)</center>"; }



		  if($_POST['use_creds']){



  $secrea=$_POST['pass_use'];



$type=$_POST['type'];



if($secrea == $fetch->password){


if($type == "kills"){
  if($fetch->credits < 1000000){
    echo"<center>You can't afford that.";
  }else{
    mysqli_query( $connection, "UPDATE `accounts` SET credits=credits-1000 WHERE username='$username'");
    mysqli_query( $connection, "UPDATE `account_info` SET kill_skill=kill_skill+10 WHERE username='$username'");
    mysqli_query( $connection, "INSERT INTO `creditpagelog` (`id`, `username`, `info`, `date`) VALUES ('', '$username', 'Purchased 10 kills.', '$date')");
    echo"<center>You have added 10 kills to your account for 1,000 credits.";
  }
}




if($type == "1"){



$health=$_POST['health'];



if ($health == 0 || !$health || ereg('[^0-9]',$health)){



echo"<center>You cant buy that many health %.";



}elseif ($health != 0 || $health || !ereg('[^0-9]',$health)){



if($fetch->credits >= $health){



$gain = $health * 10;



$newhealth = $fetch->health + $gain;



if($newhealth > "100"){ $newhealth = "100";



}else{ $newhealth = $newhealth; }



mysqli_query( $connection, "UPDATE accounts SET health='$newhealth', credits=credits-$health WHERE username='$username'");



echo"<center>You bought $health health packs.";



}elseif($fetch->credits < $health){



echo"<center>You cant afford ".makecomma($gain)."% of health.";



}}}elseif($type == "2"){







$ster=$_POST['ster'];



if ($ster == 0 || !$ster || ereg('[^0-9]',$ster)){



echo"<center>You cant buy that many steroids.";



}elseif ($ster != 0 || $ster || !ereg('[^0-9]',$ster)){



$price = $ster * 2;



if($fetch->credits >= $price){



$sters2 = $ster * 20;



mysqli_query( $connection, "UPDATE accounts SET steroids=steroids+$sters2, credits=credits-$price WHERE username='$username'");



echo"<center>You bought $sters2 steroids.";



}elseif($fetch->credits < $price){



echo"<center>You cant afford $sters2 of steroids.";







}}}elseif($type == "3"){



if($fetch->credits >= "4"){



mysqli_query( $connection, "INSERT INTO `garage` ( `id` , `owner` , `car` , `damage`,`origion`,`location`,`worth`, `status`) 



VALUES ('', '$username', 'Hummer H2', '0', '$fetch->location', '$fetch->location', '1750000', '0')");



echo"<center>You bought a Hummer H2 for 4 Credits.";



mysqli_query( $connection, "UPDATE accounts SET  credits=credits-4 WHERE username='$username'");



}elseif($fetch->credits < "4"){



echo"<center>You cant afford a Hummer H2.";







}}elseif($type == "4"){



if($fetch->credits >= "35"){



echo"<center>You bought a AWP for 35 Credits.";



mysqli_query( $connection, "UPDATE inventory SET AWP=AWP+1 WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits=credits-35 WHERE username='$username'");



}elseif($fetch->credits < "35"){



echo"<center>You cant afford a AWP.";







}}elseif($type == "5"){



if($fetch->credits >= 9){



mysqli_query( $connection, "UPDATE accounts SET credits=credits-9, lasttravel='0' WHERE username='$username'");



echo "<center>You reset your travel timer for 9 Credits.";



}elseif($fetch->credits < 9){



echo "<center>You cant afford to reset your travel timer.";



}}elseif($type == "6"){







if($fetch->credits < 60){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 60){



$newcredits=$fetch->credits-60;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE inventory SET FullMetalJacket=FullMetalJacket+1 WHERE username='$username'");



echo "<center>Full Metal Jacket has been equipped and added to your inventory!";



}







}elseif($type == "7"){



if($fetch->credits >= 15){



mysqli_query( $connection, "UPDATE accounts SET credits=credits-10, lastshoot='0' WHERE username='$username'");



echo "<center>You reset your shoot timer for 15 Credits.";



}elseif($fetch->credits < 15){



echo "<center>You cant afford to reset your shoot timer.";







}}elseif($type == "8"){



if($fetch->credits < 23){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 23){



$newcredits=$fetch->credits-23;



mysqli_query( $connection, "UPDATE accounts SET jhp=jhp+10000 WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



echo "<center>You have just successfully bought 10,000 jhp bullets!";







}}elseif($type == "9"){



if($fetch->credits < 30){



echo "<center>You need more credits."; 



}elseif($fetch->credits >= 30){



$newcredits=$fetch->credits-30;



mysqli_query( $connection, "UPDATE accounts SET fmj=fmj+10000 WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



echo "<center>You have just successfully bought 10,000 FMJ bullets!";



}



}elseif($type == "10"){



if($fetch->credits < 20){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 20){



$newcredits=$fetch->credits-20;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET money=money+10000000 WHERE username='$username'");



echo "<center>You have successfully got $10,000,000 for 20 credits!"; 



}



}elseif($type == "373"){



if($fetch->credits < 250){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 250){



$newcredits=$fetch->credits-250;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET bulletcalc='1' WHERE username='$username'");



echo "<center>The bullets calculater was added to your account.";



}
}elseif($type == "24"){
    
if($fetch->credits < 250){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 250){



$newcredits=$fetch->credits-250;

$changegender = addslashes($_POST['changegender']);

mysqli_query( $connection, "INSERT INTO `creditpagelog` (`id`, `username`, `info`, `date`) 
VALUES ('', '$username', 'has changed gender to: $changegender', '$date')");
mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET gender='$changegender' WHERE username='$username'");
echo "<center>Your gender has been changed to $changegender!</center>"; 
}



}elseif($type == "11"){



if($fetch->credits < 45){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 45){



$newcredits=$fetch->credits-45;



mysqli_query( $connection, "INSERT INTO `bodygaurd` ( `id` , `username` , `weapon` , `ranktoshoot` , `status`, `bullets` )



VALUES ('', '$username', 'None', '0', 'Off', '0')");



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



echo "<center>Bodyguard bought for your needs.";



}}elseif($type == "12"){



if($fetch->credits < 60){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 60){



$newcredits=$fetch->credits-60;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE inventory SET FullMetalJacket=FullMetalJacket+1 WHERE username='$username'");



echo "<center>Full Metal Jacket has been equipped and added to your inventory!";



}



}elseif($type == "13"){



if($fetch->credits < 80){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 80){



$newpoints=$fetch->credits-80;



$newrpoints=$fetch->rankpoints+10000;



mysqli_query( $connection, "UPDATE accounts SET rankpoints='$newrpoints' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits='$newpoints' WHERE username='$username'");



echo "<center>You successfully bought 10,000 rankpoints!";



}



}elseif($type == "1515"){



if($fetch->credits < 45){



echo "<center>You need more credits.";



}elseif($fetch->credits >= 45){



$newcredits=$fetch->credits-45;



mysqli_query( $connection, "UPDATE account_info SET RG='1' WHERE username='$username'");


mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



echo "<center>Ricochet Granny bought for your needs.";



}



}elseif($type == "151617"){



if($fetch->credits < 15){



echo "<center>You need more credits."; 



}elseif($fetch->credits >= 15){



$newcredits=$fetch->credits-15;



mysqli_query( $connection, "UPDATE accounts SET last_kill='0' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



echo "<center>You successfully updated your shooting timer.";



}



}elseif($type == "54321"){



if($fetch->money < 75000000){



echo "<center>You need more money."; 



}elseif($fetch->money >= 75000000){



$newmoney=$fetch->money-75000000;



$newcredits=$fetch->credits+25;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET money='$newmoney' WHERE username='$username'");



echo "<center>You have bought 25 credits.";



}



}elseif($type == "14"){



$gang=strip_tags($_POST['gang']);



$GBass=strip_tags($_POST['GBass']);

$check=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$gang' LIMIT 1");
$cge = mysqli_fetch_object($check);

$rezCost = 250 + ($cge->revive_times * 100);

if($fetch->credits < $rezCost){



echo "<center>You need more credits.";



}elseif($fetch->credits >= $rezCost){



$newcredits=$fetch->credits-$rezCost;



$check=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$gang' LIMIT 1");
$cge = mysqli_fetch_object($check);



$rowd = mysqli_num_rows($check);

if($rowd == "0"){ echo"No such user."; }else{

    $rezCodeQ = mysqli_query( $connection, "SELECT * FROM `rezcodes` WHERE username='$gang' AND code='$GBass' ORDER BY `id` DESC LIMIT 1");
    $rezCodeR = mysqli_num_rows($rezCodeQ);
    $rez = mysqli_fetch_object($rezCodeQ);

    if($rezCodeR == '0'){
      echo'Revive code not found.';
    }else{
      if($rez->expire < time()){
        echo'Revive code has expired.';
      }else{





if($cge->status != "Dead" || $cge->status == "Banned"){ echo"Please check the status of that account as it is not dead!"; }elseif($cge->status == "Dead" || $cge->status == "Banned"){

    mysqli_query( $connection, "INSERT INTO `creditpagelog` (`id`, `username`, `info`, `date`) VALUES ('', '$username', 'Revived: $gang (Cost: $rezCost)', '$date')");

mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET status='Alive', revive_times=revive_times+1 WHERE username='$gang'");

mysqli_query( $connection, "UPDATE accounts SET health='100' WHERE username='$gang'");

mysqli_query( $connection, "DELETE FROM `rezcodes` WHERE username='$gang'");

mysqli_query( $connection, "INSERT INTO `revives` ( id`, `username`, `reviveduser`) VALUES ('', '$username', '$gang')");



echo"<center>You have revived <b>$gang</b> for $rezCost credits.";



}}}}    
    }



}elseif($type == "15"){



if($fetch->credits < 5){



echo "You need more credits.";



}elseif($fetch->credits >= 5){



$newcredits=$fetch->credits-5;



$newmoney1=$fetch->money+7500000;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET money='$newmoney1' WHERE username='$username'");



echo "<center>You successfully bought &pound;3,000,000!";



}



}elseif($type == "16"){



if($fetch->credits < 50){



echo "You need more credits.";



}elseif($fetch->credits >= 50){



$newcredits=$fetch->credits-50;



mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET bulletcalc='1' WHERE username='$username'");



echo "<center>Bullet calculator has been bought.";



}}



elseif($secrea != $fetch->password){



echo"<center>That password was incorrect."; } 



}}



?>















<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">



<html>



<head>



<title>Use Credits :: Thug Paradise 2</title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" href="style.css" type="text/css">

<style>



.style3 {color: #000000}



.style4 {color: #FFFFFF; }



#dhtmltooltip{



position: absolute;



width: 250px;



border: 2px solid #333333;



padding: 5px;



background-color: #666666;



visibility: hidden;



z-index: 100;



text-align: center;



filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);



}



.cells {



	font-family: Verdana, Arial, Helvetica, sans-serif;



	font-size: 10px; 



	font-style: normal;



	background-color: #000000;



	border: 1px solid #333333;



	padding: 8px;


}



a:link, a:visited, a:active, a:hover {



	color: #33CCFF;



	font-weight: bold;



	text-decoration: bold;



}



.style1 {color: #FFFFFF;



	font-weight: bold;



}



.style8 {

	color: white;

	font-weight: bold;

}

</style>




<style>.style3{color:#000000}.style4{color:#FFFFFF;}.style5{font-size:18px}#dhtmltooltip{position:absolute;width:250px;border:2px solid #333333;padding:5px;background-color:#666666;visibility:hidden;z-index:100;text-align:center;filter:progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);}.cells{background-color:#000000;border:1px solid #CCCCCC;padding:8px;font-family:Verdana;font-size:10px;font-style:normal;}a:link,a:visited,a:active,a:hover{color:#FF6600;font-weight:bold;text-decoration:underline;}.style6{color:#0000FF}.style8{color:#0000FF;font-size:12px;}#bullet{position:absolute;width:200px;height:200px;top:0;left:0;}</style>
<body>







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
<div id="bullet"><img src="../images/bullet.png" alt="Credit Options" border="0" height="200" width="200" onclick="location=&quot;bc.php&quot;"></div>
<div align="center"><b><span class="style5">You currently have <?php echo "".makecomma($fetch->credits).""; ?> credits!</span><br></div><br>



<form method="post" name="use_Credits" id="use_Credits">

  <table width="70%" border="0" align="center" cellpadding="2" cellspacing="0" class=table1px>



    <tr>



      <td height="22" colspan="7" class=gradient><div align="center"><b>Use Your Credits</b></div></td>

    </tr>


<tr>
<td colspan="6" class="tableborder" bgcolor="#000000" height="15"><div align="center"><strong>Hover over the links to see a description of each item </strong></div></td>
</tr>
    <tr>



      <td bgcolor="#000000" class="cells" width="22%" rowspan="2" ><div align="center" class="style4"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Are you injured? Have you done too many Organised Crimes?<br /><br />This is the place to get your HP back up, quick and easy.')"



onMouseOut="hideddrivetip()";>10% Health Pack</a></div></td>



      <td bgcolor="#000000" class="cells" width="10%" height="7" ><div align="center"><span class="style3"><span class="style4"></span></span>1 per 10% </div></td>



      <td bgcolor="#000000" class="cells" width="16%" ><div align="center">



          <input name="type" type="radio" value="1" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="7" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('10,000 Jacket Hollow Point (JHP) bullets will be added to your inventory. These bullets are most effective against people wearing no armour with a penalty against those with protection.')";



onMouseOut="hideddrivetip()">10,000 JHP Bullets</a></div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="7" ><div align="center">23</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="8" />



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" height="15" colspan="2" ><div align="center">Number of Packs:



        <input name="health" type="text" class="textbox" id="health" value="1" size="10" maxlength="3">



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="15" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('10,000 Full Metal Jacket (FMJ) bullets will be added to your inventory. These bullets are most effective against those wearing armour and contains no penalty against those without any protection.')";



onMouseOut="hideddrivetip()">10,000 FMJ Bullets</a></div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><div align="center">30</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="9" />



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" width="22%" rowspan="2" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Hate waiting for the Gta, Crime, Jail, and Drug Crime timer?<br /><br />Buy 20 steroids here and gain an advantage on other players who have to wait.')";



onMouseOut="hideddrivetip()">Take a Steroid (<?php echo "".makecomma($fetch->steroids)."";?> uses left!)</a></div></td>



      <td bgcolor="#000000" class="cells" width="10%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>2</div></td>



      <td bgcolor="#000000" class="cells" width="16%" ><div align="center">



          <input name="type" type="radio" value="2" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Need to switch some cash into credits? Heres the quickest way on TP to do it!<br> &pound;75,000,000 into 25 credits.')";



onMouseOut="hideddrivetip()"> Buy 25 Credits</div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>&pound;75,000,000</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="54321" />



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" height="15" colspan="2" ><div align="center">Number of Steroids:



        <input name="ster" type="text" class="textbox" id="ster" value="1" size="10" maxlength="3">



      </div></td>



      <td bgcolor="#000000" class="cells" height="15" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('With this feature, you shall be able to reset the shoot timer on your account. Therefore releasing the time which you have to wait.<br><br>Although this costs 10 credits, it is very useful when wiping gangs, or when killing a mass amount of people.')";



onMouseOut="hideddrivetip()">Reset Shoot Timer</a></div></td>

      <td bgcolor="#000000" class="cells" height="15" ><div align="center">15</div></td>

      <td bgcolor="#000000" class="cells" ><div align="center">

          <input name="type" type="radio" value="151617" />

      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" width="22%" height="15" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('The powerfullest and the best car on TP.<br /><br />A must have for every high classed Organised Crime to get the maximum chance of escape.')";



onMouseOut="hideddrivetip()">Hummer H2</a></div></td>



      <td bgcolor="#000000" class="cells" width="10%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>4</div></td>



      <td bgcolor="#000000" class="cells" width="16%" ><div align="center">



          <input name="type" type="radio" value="3" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Full Metal Jacket armour is the most protective armour on TP, a no brainer purchase for any serious player.<br /><br />This armour is 20% more protective than any armour purchasable from the in-game stores.')";



onMouseOut="hideddrivetip()">Full Metal Jacket</a></div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>60</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="12" />



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" width="22%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('The Steyr is a very effective weapon.<br /><br />The AWP is the ultimate weapon of choice to kill.<br /><br />The AWP is better then any other gun on the game!')";



onMouseOut="hideddrivetip()">AWP Sniper Rifle</a></div></td>



      <td bgcolor="#000000" class="cells" width="10%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>35</div></td>



      <td bgcolor="#000000" class="cells" width="16%" ><div align="center">



          <input name="type" type="radio" value="4" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="15" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('10,000 Rank Credits aid your ranking in the game. These Credits instantly give you more experience and will help you advance through the ranks quickly.<br />')";



onMouseOut="hideddrivetip()">10,000 Rank Credits</a></div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><div align="center">80</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="13" />



      </div></td>

    </tr>



	



	    <tr>



      <td bgcolor="#000000" class="cells" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="granny.php" target="_self" onMouseOver=



      "ddrivetip('this is like a ricochet it will be found in your inventory after purchased.<br>Very good for protection!')";



onMouseOut="hideddrivetip()">Ricochet Granny</a> </div></td>



      <td bgcolor="#000000" class="cells" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span>45</div></td>



      <td bgcolor="#000000" class="cells"><div align="center">



          <input name="type" type="radio" value="1515" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" height="15" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Need a shortcut? Can you afford it?<br>10Kills for 1,000 credits!*')";



onMouseOut="hideddrivetip()">Add 10 Kills</a><span style="color: #F00">*</span> </div> </td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><center>1,000</center></td>



      <td bgcolor="#000000" class="cells" width="24%" ><center><input name="type" type="radio" value="kills" /></center></td>

    </tr>



	



    <tr>



      <td bgcolor="#000000" class="cells" width="22%" height="15" ><div align="center"><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Reset your travel timer to travel after previously travelling to eliminate the 60 minute wait.')";



onMouseOut="hideddrivetip()">Reset Travel Timer</a></div></td>



      <td bgcolor="#000000" class="cells" width="10%" height="15" ><div align="center">9</div></td>



      <td bgcolor="#000000" class="cells" width="16%" ><div align="center">



          <input name="type" type="radio" value="5" />



      </div></td>



      <td bgcolor="#000000" class="cells" width="19%" rowspan="3" ><div align="center"><a href="?info=RezCost" target="_self" onMouseOver=



      "ddrivetip('You can resurrect an old account!<br /><br />If you have been killed by another player on the game, you can bring your old account back to life. Your account will be just as it was before death excluding 20%-75% of your money which will have been taken by your murderer.<br />A revive costs 250 + (number of lives * 100)<br />')";



onMouseOut="hideddrivetip()">Gangster Resurrection</a></div></td>



      <td bgcolor="#000000" class="cells" width="9%" height="15" ><div align="center">See Desc</div></td>



      <td bgcolor="#000000" class="cells" width="24%" ><div align="center">



          <input name="type" type="radio" value="14" />



      </div></td>

    <tr>



      <td bgcolor="#000000" class="cells" width="22%" height="15" rowspan="2" ><div align="center"><span class="style3"><span class="style4"></span></span><a href="credits.php" target="_self" onMouseOver=



      "ddrivetip('Want to make your account unique? Change your gender and colour to whatever you want! Supports standard bb-codes excluding img, url, user/gang, youtube.')";



onMouseOut="hideddrivetip()">Custom Gender</a> </div></td>



      <td bgcolor="#000000" class="cells" width="10%" rowspan="2" ><center>250</center></td>



      <td width="16%" rowspan="2" ><center><input name="changegender" value="" type="text" class="textbox" id="changegender" size="18" valign="middle"><input name="type" type="radio" value="24" /></center></td>



      <td bgcolor="#000000" class="cells" height="15" colspan="2" ><div align="center">Gangster:



        <input name="gang" type="text" class="textbox" id="gang" size="20" maxlength="30">



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" height="8" colspan="2" ><div align="center">Rezz Code:



          <input name="GBass" type="password" class="textbox" id="GBass" size="10" maxlength="5">



      </div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" height="15" colspan="6" ><div align="center"><strong>Hover over the links to see a description of each item.</strong></div></td>

    </tr>



    <tr>



      <td bgcolor="#000000" class="cells" height="15" colspan="7" ><div align="center"> Your Password (Security)



        <input name="pass_use" type="password" class="textbox" id="pass_use" size="20">



        &nbsp;&nbsp;&nbsp;&nbsp;

<br><br>

        <input name="use_creds" type="submit" class="custombutton" id="use_creds" value="Use Credits!" onclick="javascript:return confirm('Are you sure?')">



              <br>



      </div></td>

    </tr>

  </table>
</form>
<form method="post" name="use_Credits" id="use_Credits">


<table cols="2" align="center" border="0" cellspacing="10">
<tbody><tr>
<td>
<table class="table1px" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">

<tbody><tr height="30">

<td colspan="1" class="gradient" align="center">Verify Credits</td></tr><tr>

<td class="tableborder" align="center"><div align="center">

        <p>Verify To:

          <label>

              <input name="verifyperson" type="text" class="textbox" id="verifyperson">

              </label>

        </p>

        <p>Verify your credits to someone to prove<br>

          you have them before making a deal.<br><br>

          This will give them more confidence that <br>

          you will fulfill your end of the bargain.</p>

        <p>

          <label>

            <input name="verifybutton" type="submit" class="custombutton" id="verifybutton" value="Verify Credits!">

            </label>

          <br>

    </p>

      </div>

    </center></td>

</tr>

</tbody></table>
</td>
<td>
<table class="table1px" cellspacing="0" width="300" style="border: 1px solid #FFFFFF;">

<tbody><tr height="30">

<td colspan="1" class="gradient" align="center">Transfer Credits</td></tr><tr>

<td class="tableborder" align="center">
<center>

          <div align="center">

            <table width="340" border="0" cellpadding="2" cellspacing="0">

              <tr><br>

                <td width="125" class="table1px"><div align="right">Old Username:</div></td>

                <td width="175" class="table1px"><span class="style1">

                  <input name="oldname" type="text" class="textbox" id="oldname" />

                </span></td>

              </tr>

              <tr>

                <td width="125" class="table1px"><div align="right">Old Password:</div></td>

                <td width="175" class="table1px"><span class="style1">

                  <input name="oldpassword" type="password" class="textbox" id="oldpassword" />

                </span></td>

              </tr>

              <tr>

                <td colspan="2"><div align="center">

                    <input type="submit" class="custombutton" name="rr" id="rr" value="Move Credits!" />

                </div></td>

            Move credits from a dead old account.  <br></tr>

</tbody></table>


            <?php



if ($_POST['rr'] && strip_tags($_POST['oldname']) && strip_tags($_POST['oldpassword'])){



$oldname = addslashes(strip_tags($_POST['oldname']));



$oldpassword = addslashes(strip_tags($_POST['oldpassword']));











$sql = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$oldname' AND password='$oldpassword' AND status='Dead' LIMIT 1");



$login_check = mysqli_num_rows($sql);



$inf = mysqli_fetch_object($sql);











if($login_check == "0"){



echo"No such account.";



}elseif($login_check != "0"){







if($inf->credits == "0"){



echo"No credits on that account.";



}elseif($inf->credits != "0"){







if($inf->username == "Frisk Alive"){



echo"You have not paid for those credits yet.";



}elseif($inf->username != "Frisk Alive"){



}



if($inf->userban2 == "1"){



echo"You cannot move credits from a userbanned account.";



}elseif($inf->userban2 != "1"){







mysqli_query( $connection, "UPDATE accounts SET credits=credits+$inf->credits WHERE username='$username'");



mysqli_query( $connection, "UPDATE accounts SET credits='0' WHERE username='$oldname'");



mysqli_query( $connection, "INSERT INTO `creditmove` ( `id`, `olduser`, `newuser`, `amount`, `ip` ) 



VALUES ('', '$oldname', '$username', '$inf->credits', '$ip')");



echo"$inf->credits credits have been moved to your account.";



}}}



 ?>




  <p>&nbsp;

    </p>

</form>



</body>


</html>

  <p>

    <?php }?>
  <p>
</table></table></table>
    <?php include_once"incfiles/foot.php"; ?>
<a name="bottom"></a>
  </p>
  </p>