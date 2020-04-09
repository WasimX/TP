<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

logincheck();


if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}


$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));

$fetchinv=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$username'"));

$site=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));

if($fetch->health <= "-100"){
exit('You cant do this as your health is below minus 100.'); }

$boatsql=mysqli_query( $connection, "SELECT * FROM boat WHERE leader='$username'");

$boat = mysqli_fetch_object($boatsql);

$boatnum = mysqli_num_rows($boatsql);



$fetchbooat=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM boat WHERE side='$username'"));

$fetch3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$boat->side'"));



$rank=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));



?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Thug Paradise 2 :: Boat Hijacking</title>

</head>

<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
#transfer {
    width: 75px;
	height: 75px;
	background-image: url(images/bank/transfermoney.png);
	position: absolute;
	text-align: left;
	left: 110px;
	top: 75px;
	border-color: #000000;
}
#deposit {
	width: 75px;
	height: 75px;
	background-image: url(images/bank/depositmoney.png);
	position: absolute;
	text-align: left;
	left: 110px;
	top: 175px;
	border-color: #000000;
}
#express {
	width: 75px;
	height: 75px;
	background-image: url(images/bank/expresscash.png);
	position: absolute;
	text-align: left;
	left: 110px;
	top: 275px;
}
#loan {
	width: 75px;
	height: 75px;
	background-image: url(images/bank/moneyloans.png);
	position: absolute;
	text-align: left;
	left: 110px;
	top: 375px;
}
.AshTheShiaShagUrGranma { 
    font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px; 
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	padding: 4px;	
} 
.tablebank {
	border: 1px solid #000000;
	color: #000000;
	border-collapse: collapse;
	background-image: url(../images/boatcrimebg.jpg);
	background-position: center bottom;
	background-repeat: no-repeat;
	padding: 5px;	
}
</style>
<body>

<form method="post" id="" name="">

<?php if($fetch->boat_last > time()){ echo"<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable><center>You've still got to wait ".maketime($fetch->boat_last)." untill you can Boat Hi-Jack again.</center></div>"; exit(); } ?>



<?php if($fetch->boat == "0"){ ?>



<table width="635" height="280" align="center" cellpadding="2" cellspacing="0"  class="tablebank">

  <tr>

    <td width="100%"  height="22" align="center" class=gradient><b>Boat Hi-Jack</b></td>

  </tr>

  <tr><td>

  <table align="center">

  <tr>

    <td align="center" class="AshTheShiaShagUrGranma"><em>It costs 25 credits to set up a Boat Hi-Jack. You only need 2 participants to complete the crime.</em><br></td>

  </tr>

  <tr>

    <td height="33" align="center" class="AshTheShiaShagUrGranma">

      Steal the

      <select name="select" id="select" class="textbox">

      <option value="drugs">Drugs from boat</option>

      <option value="money">Money from boat</option>

                        <option value="bullets">Bullets from boat</option>

      </select>    </td>

  </tr>

  <tr>

    <td height="32" align="center" class="AshTheShiaShagUrGranma">Sidekick uses 

      <select name="select2" id="select2" class="textbox">

        <option value="wep">Weapons (Better chance on Drugs)</option>

        <option value="exp">Explosives (Better chance on Bullets)</option>

      </select></td>

  </tr>

  <tr>

    <td align="center" class="AshTheShiaShagUrGranma"><br>

    <input type="submit" class="custombutton" name="button" id="button" value="Start Hijack!" />

      <br /> <br>
     

      <?php

	  if (strip_tags($_POST['button'])){

$select2=strip_tags($_POST['select2']);

$select=strip_tags($_POST['select']);

if($fetch->health <= "-1000"){
exit('You cant do this as your health is below minus 1,000.'); }


$ranks=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

if($ranks->id < "4"){ echo "<center><b><font size=2>You must be ranked at least Thief to hi-jack a boat.</font></b></center><br>";
}elseif($ranks->id >= "4"){

if($fetch->credits <= '25'){

echo"You cant afford 25 credits";

}elseif($fetch->credits > '25'){

mysqli_query( $connection, "UPDATE accounts SET boat='1', credits=credits-25 WHERE username='$username'");

mysqli_query( $connection, "INSERT INTO `boat` ( `id` , `leader` , `type` , `side` , `sidestuff` , `using` )

VALUES (NULL , '$username', '$select', '', '', '$select2')");

echo"The Boat-Hijackings Blueprints Have Been Setup!";

	  }}}

	  ?></td></tr></table></td></tr>

</table><br>
</br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>The Boat Hi-Jacking page is a shortcut to get a hold of large amounts of money, drugs and bullets as the target to in this act is to steal from rich yachts and grab all you can with your partner and get out of there and getting less damage to your health as possible and split the loot! </p></div></td></tr></table></td></tr></table></td></tr></table>

<?php }elseif($fetch->boat == "1"){



if($boatnum == "1"){



 ?>

<br />

<br />

<table width="71%"  align="center" cellpadding="2" cellspacing="0"  class="table1px">

  <tr>

    <td  height="22" align="center" colspan="6" class=gradient><b>Leader Control Panel</b></td>

  </tr>

  <tr>

    <td  height="1" align="center" colspan="6" ></td>

  </tr>



  <tr>

    <td width="16%" align="center" class="tableborder"><b><u>Position</u></b></td>

    <td width="21%" align="center" class="tableborder"><b><u>Username</u></b></td>

    <td width="25%" align="center" class="tableborder"><b><u>Equipment</u></b></td>

    <td width="17%" align="center" class="tableborder"><b><u>Ready</u></b></td>



    <td width="21%" align="center"><label>

      <b><u>Option</u>

    </label></td>

  </tr>

  <tr>

    <td align="center" class="tableborder">Sidekick</td>

    <td align="center" class="tableborder"><?php

	if($boat->side == ""){

	echo"None";

	}elseif($boat->side != ""){

	 echo"<a href='javascript: ;' onclick=\"modal('profile.php?viewing=$boat->side','<div class=\'header1\'>$boat->side\'s Profile</div>','950','600');\">$boat->side</a> ";

	 }

	  ?></td>

    <td align="center" class="tableborder"><?php

	if($boat->side == ""){

	echo"None";

	}elseif($boat->side != ""){

	 echo"$boat->sidestuff ($boat->using)";

	 }

	  ?></td>

    <td align="center" class="tableborder"><?php

	if($boat->sidestuff == ""){

	echo"Not Ready";

	}elseif($boat->sidestuff != ""){

	 echo"Ready";

	 }

	  ?></td>

    <td align="center" class="tableborder"><?php

 if($boat->side != ""){

	echo"<input type=\"submit\" name=\"kick\" id=\"kick\" value=\"Kick Sidekick\"/>";

	}elseif($boat->side == ""){

     echo"<input name=\"inv\" type=\"text\" class=\"textbox\" id=\"inv\" size=\"20\" />";

	 }

	 ?></td>

  </tr>

  <tr>

    <td align="center" colspan="4" class="tableborder"><br><input type="submit" class="custombutton" name="finish" id="finish" value="Finish" />

      <input type="submit" class="custombutton" name="cancel" id="cancel" value="Cancel" /></td>

      <td align="center"><input type="submit" class="custombutton" name="invite" id="invite" value="Invite User" /></td>

  </tr>

  <tr>

    <td align="center" colspan="5" class="tableborder">

  <?php

    $datenow = gmdate('Y-m-d H:i:s');

	if (strip_tags($_POST['cancel'])){

mysqli_query( $connection, "UPDATE accounts SET boat='0' WHERE username='$boat->side'");

mysqli_query( $connection, "UPDATE accounts SET boat='0' WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM boat WHERE leader='$username'");

echo"Successfully cancelled the boat crime!";



}

	if (strip_tags($_POST['invite'])){

	$inv=strip_tags($_POST['inv']);

	if($inv == ""){

}elseif($inv != ""){

$find=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$inv'"));



if($find->bjm == "Off"){



if($rank->id >= $find->bjrank){

$enter1 = "yes";

}elseif($rank->id < $find->bjrank){

$enter1 = "no";

}



}elseif($find->bjm == "On"){

$enter1 = "yes";

}





if($enter1 == "no"){

echo"<b>
<a href='javascript: ;' onclick=\"modal('profile.php?viewing=$inv','<div class=\'header1\'>$inv\'s Profile</div>','950','600');\">$inv</a> is not accepting oc invites from people of your rank!</b><br>";

}elseif($enter1 == "yes"){







	if($find->boat_last > time()){

echo"<b><a href='javascript: ;' onclick=\"modal('profile.php?viewing=$inv','<div class=\'header1\'>$inv\'s Profile</div>','950','600');\">$inv</a> cant Boat Jack for another ".maketime($find->boat_last).".</b><br>";

}elseif($find->boat_last < time()){



$text = "<center>\[user\]$username\[/user\] would like to know if you want to be in his/her Boat Jack.

<a href=inbox.php?inv=accept&cd=$boat->id>Accept</a>          -        <a href=inbox.php?inv=decline&cd=$boat->id>Decline</a></center>";



$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$inv', '$username', '$text', '<b>BJ Invite</b>', '$datenow', '0')");



echo"Sent invite to <b><a href='javascript: ;' onclick=\"modal('profile.php?viewing=$inv','<div class=\'header1\'>$inv\'s Profile</div>','950','600');\">$inv</a></b>!<br>";

	}}}}

	if (strip_tags($_POST['kick'])){

mysqli_query( $connection, "UPDATE accounts SET boat='0' WHERE username='$boat->side'");

mysqli_query( $connection, "UPDATE boat SET side='', sidestuff='' WHERE leader='$username'");

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read` , `saved` , `event_id` , `witness` , `witness_per` )

VALUES ('', '$boat->side', '$username', '<b>You have been kicked from the boat jack, involving $username!</b>', 'Been Kicked!', '$datenow', '0', '0', '0', '0', '')");

echo"Successfully kicked him/her!";



}

	if (strip_tags($_POST['finish'])){

	$lboat = time() + 21600;

	$randomrank = 1000 + $site->else;

if($boat->sidestuff == ""){

echo"The sidekick is not ready yet.";

}elseif($boat->sidestuff != ""){

if ($boat->sidestuff == "FiveSeven"){$equ = "1"; $w = "wep";

}elseif ($boat->sidestuff == "Shotgun"){$equ = "2"; $w = "wep";

}elseif ($boat->sidestuff == "PSG1"){$equ = "3"; $w = "wep";

}elseif ($boat->sidestuff == "M82A1"){$equ = "4"; $w = "wep";

}elseif ($boat->sidestuff == "Cherry Bomb"){$equ = "1"; $w = "exp";

}elseif ($boat->sidestuff == "Petrol Bomb"){$equ = "2"; $w = "exp";

}elseif ($boat->sidestuff == "Smoke Grenade"){$equ = "3"; $w = "exp";

}elseif ($boat->sidestuff == "TNT"){$equ = "4"; $w = "exp";

}elseif ($boat->sidestuff == "C4"){$equ = "5"; $w = "exp";

}



if($boat->type == "drugs"){

if($w = "wep"){ 

$ge = $equ + 3;

}elseif($w = "exp"){

$ge = $equ + 2;

}

$get = $ge * 2;

$rand = rand(140, $get);

$getb = $rand * 2;

$randdrug = rand(0,4);

$mm = explode("-", $fetch->drugs);

$mm2 = explode("-", $fetch3->drugs);

if($randdrug != "0"){ $drug1 = $mm[0]; }elseif($randdrug == "0"){ $drug1 = $mm[0]+ $getb; }

if($randdrug != "1"){ $drug2 = $mm[1]; }elseif($randdrug == "1"){ $drug2 = $mm[1]+ $getb; }

if($randdrug != "2"){ $drug3 = $mm[2]; }elseif($randdrug == "2"){ $drug3 = $mm[2]+ $getb; }

if($randdrug != "3"){ $drug4 = $mm[3]; }elseif($randdrug == "3"){ $drug4 = $mm[3]+ $getb; }

if($randdrug != "4"){ $drug5 = $mm[4]; }elseif($randdrug == "4"){ $drug5 = $mm[4]+ $getb; }

if($randdrug != "5"){ $drug6 = $mm[5]; }elseif($randdrug == "5"){ $drug6 = $mm[5]+ $getb; }

if($randdrug != "6"){ $drug7 = $mm[6]; }elseif($randdrug == "6"){ $drug7 = $mm[6]+ $getb; }

if($randdrug != "7"){ $drug8 = $mm[7]; }elseif($randdrug == "7"){ $drug8 = $mm[7]+ $getb; }



if($randdrug != "0"){ $drugs1 = $mm2[0]; }elseif($randdrug == "0"){ $drugs1 = $mm2[0]+ $getb; }

if($randdrug != "1"){ $drugs2 = $mm2[1]; }elseif($randdrug == "1"){ $drugs2 = $mm2[1]+ $getb; }

if($randdrug != "2"){ $drugs3 = $mm2[2]; }elseif($randdrug == "2"){ $drugs3 = $mm2[2]+ $getb; }

if($randdrug != "3"){ $drugs4 = $mm2[3]; }elseif($randdrug == "3"){ $drugs4 = $mm2[3]+ $getb; }

if($randdrug != "4"){ $drugs5 = $mm2[4]; }elseif($randdrug == "4"){ $drugs5 = $mm2[4]+ $getb; }

if($randdrug != "5"){ $drugs6 = $mm2[5]; }elseif($randdrug == "5"){ $drugs6 = $mm2[5]+ $getb; }

if($randdrug != "5"){ $drugs7 = $mm2[6]; }elseif($randdrug == "6"){ $drugs7 = $mm2[6]+ $getb; }

if($randdrug != "6"){ $drugs8 = $mm2[7]; }elseif($randdrug == "7"){ $drugs8 = $mm2[7]+ $getb; }



$newdrugs1 = "$drug1-$drug2-$drug3-$drug4-$drug5-$drug6-$drug7-$drug8";

$newdrugs2 = "$drug1-$drug2-$drug3-$drug4-$drug5-$drug6-$drug7-$drug8";

mysqli_query( $connection, "UPDATE accounts SET drugs='$newdrugs1', boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET drugs='$newdrugs2', boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$boat->side'");

mysqli_query( $connection, "INSERT INTO `boatjlogs` (`id`, `leader`, `sidekick`, `loot`) VALUES (NULL, '$username', '$boat->side', NULL)");

$textfrom = "You got away with ".makecomma($getb)." of drug number $randdrug.";

}elseif($boat->type == "bullets"){

if($w = "wep"){ 

$ge = $equ + 2;

}elseif($w = "exp"){

$ge = $equ + 3;

}

$get = $ge * 2;

$rand = rand(17000, $get);

$getb = $rand * 2;

$randn = rand(1,2);

if($randn == "1"){

$bulg = "FMJ";

}elseif($randn == "2"){

$bulg = "jhp";

}

mysqli_query( $connection, "UPDATE accounts SET boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$boat->side'");



mysqli_query( $connection, "UPDATE accounts SET $bulg=$bulg+$getb WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET $bulg=$bulg+$getb WHERE username='$boat->side'");

$textfrom = "You got away with ".makecomma($getb)." of $bulg.";

}elseif($boat->type == "money"){

$ge = $equ + 2;

$get = $ge * 10000000;

$rand = rand(34000000, $get);

$getb = $rand * 2;

mysqli_query( $connection, "UPDATE accounts SET money=money+$getb, boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET money=money+$getb, boat_last='$lboat', rankpoints=rankpoints+$randomrank WHERE username='$boat->side'");

$textfrom = "You got away with &pound;".makecomma($getb).".";

}

$loose1 = rand(5,10);

$loose2 = rand(5,10);

echo"You got away with valuable goods and sold them visit your inbox for how much you made, you lost $loose1% health.";







$daten = gmdate('Y-m-d H:i:s');

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES (

'', '$username', '$username', '$textfrom You managed to loose $loose1% health.', 'Your Boat Jack - ".makecomma($getb)." $boat->type', '$daten', '0');") or die (mysqli_error());



mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES (

'', '$boat->side', '$username', '$textfrom You managed to loose $loose2% health.', 'Your Boat Jack - ".makecomma($getb)." $boat->type', '$daten', '0');") or die (mysqli_error());





mysqli_query( $connection, "UPDATE accounts SET boat='0', health=health-$loose1 WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET boat='0', health=health-$loose2 WHERE username='$boat->side'");



mysqli_query( $connection, "DELETE FROM boat WHERE id='$boat->id'");



}}

	?>    </td>

  </tr>

</table>

<p><br>
</br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>The Boat Hi-Jacking page is a shortcut to get a hold of large amounts of money, drugs and bullets as the target to in this act is to steal from rich yachts and grab all you can with your partner and get out of there and getting less damage to your health as possible and split the loot! </p></div></td></tr></table></td></tr></table></td></tr></table>

<?php }else{ ?></p>

<table width="35%" border="0" align="center" cellpadding="0" cellspacing="0"  class="thinline">

  <tr>

    <td width="100%"  height="30" align="center" class=gradient><b>Side Kick</b></td>

  </tr>

  <tr>

    <td  height="1" align="center" ></td>

  </tr>

  <tr>

    <td align="center" class="tableborder">

    <?php if($fetchbooat->sidestuff == ""){ ?>

    <?php if($fetchbooat->using == "wep"){ ?>

    <select class="textbox" name="wepown" id="wepown">

      <option class="textbox" selected="selected" value="No">No Weapons</option>

<?php if ($fetchinv->M16A4 > "0"){ echo"<option value='M16A4'>M16A4</option>"; } ?>

<?php if ($fetchinv->MP5 > "0"){ echo"<option value='MP5'>MP5</option>"; } ?>

<?php if ($fetchinv->P90 > "0"){ echo"<option value='P90'>P90</option>"; } ?>

<?php if ($fetchinv->PSG1 > "0"){ echo"<option value='PSG1'>PSG1</option>"; } ?>

<?php if ($fetchinv->SA80 > "0"){ echo"<option value='SA80'>SA80</option>"; } ?>

<?php if ($fetchinv->G36C > "0"){ echo"<option value='G36C'>G36C</option>"; } ?>

<?php if ($fetchinv->FAMAS > "0"){ echo"<option value='FAMAS'>FAMAS</option>"; } ?>

<?php if ($fetchinv->M82A1> "0"){ echo"<option value='M82A1'>M82A1</option>"; } ?>

</select>

</select>

    <?php }elseif($fetchbooat->using == "exp"){ ?>

    <select name="use2" id="12" class="textbox">

      <option selected="selected" value="Cherry Bomb">Cherry Bombs  -  &pound;250,000</option>

      <option value="Petrol Bomb">Petrol Bombs  -  &pound;500,000</option>

      <option value="Smoke Grenade">Smoke Grenades  -  &pound;1,000,000</option>

      <option value="TNT">TNT  -  &pound;2,500,000</option>

      <option value="C4">C4  -  &pound;5,000,000</option>

    </select>

    <?php } ?>

      <?php }elseif($fetchbooat->sidestuff != ""){ }?>    </td>

  </tr>

  <tr>

    <td align="center" class="tableborder"><br><?php if($fetchbooat->sidestuff == ""){ ?><input type="submit" class="custombutton" name="button2" id="button2" value="Add Equipment" />

        <?php }elseif($fetchbooat->sidestuff != ""){ }?>  <input type="submit" class="custombutton" name="leave" id="leave" value="Leave" />

        <br />

       <br> <?php

		  if (strip_tags($_POST['leave'])){

		  mysqli_query( $connection, "UPDATE accounts SET boat='0' WHERE username='$username'");

mysqli_query( $connection, "UPDATE boat SET side='', sidestuff='' WHERE id='$fetchbooat->id'");

echo"Successfully left Boat Jack!";

		  }

	  if (strip_tags($_POST['button2'])){

	  $wepown=strip_tags($_POST['wepown']);

$use1=strip_tags($_POST['use2']);



if($fetchbooat->using == "wep"){

if($wepown == "No"){

echo"You have no weapons you sado!";

}elseif($wepown != "No"){

mysqli_query( $connection, "UPDATE boat SET sidestuff='$wepown' WHERE side='$username'");

echo"Successfully are now successfully using $wepown!";

mysqli_query( $connection, "UPDATE account_info SET $wepown=$wepown-1 WHERE username='$username'");

}}elseif($fetchbooat->using == "exp"){

if($use1 == "Cherry Bomb"){

$cost1 = "250000";

}elseif($use1 == "Petrol Bomb"){

$cost1 = "500000";

}elseif($use1 == "Smoke Grenade"){

$cost1 = "1000000";

}elseif($use1 == "TNT"){

$cost1 = "2500000";

}elseif($use1 == "C4"){

$cost1 = "5000000";

}

if($fetch->money < $cost1){

echo"You cant afford that you cheapo!";

}elseif($fetch->money > $cost1){



$lost = $fetch->money - $cost1;

mysqli_query( $connection, "UPDATE accounts SET money='$lost' WHERE username='$username'");

mysqli_query( $connection, "UPDATE boat SET sidestuff ='$use1' WHERE side='$username'");

echo"Successfully bought $use1's for &pound;".makecomma($cost1)."!";



}}

}

	  ?></td> 

  </tr>

</table> 

<p><br>
</br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>The Boat Hi-Jacking page is a shortcut to get a hold of large amounts of money, drugs and bullets as the target to in this act is to steal from rich yachts and grab all you can with your partner and get out of there and getting less damage to your health as possible and split the loot! </p></div></td></tr></table></td></tr></table></td></tr></table>

  

  <?php }} ?>

</p>

</form>

</body>

</html>





<?php require_once "incfiles/foot.php"; ?>