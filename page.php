<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/jailcheck.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$fetchbf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='$fetch->location'"));
$fetchaf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='$fetch->location'"));
$fetchwf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='$fetch->location'"));

$page=$_GET['page'];
$stockup=$_GET['stockup'];
$buy=$_GET['buy'];
$buystock=$_GET['buystock'];
$updateprices=$_GET['priceupdate'];

if ($page == "wepons"){ $title = ""; }
if ($page == "armour"){ $title = ""; }
if ($page == "bullets"){ $title = ""; }
if ($page == ""){ $title = ""; }


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Thug Paradise 2 :: Go Shopping</title>
</head>

<body>
<form action="" method="post" name="form">

<table class="table1px" height="34" cellspacing="0" border="0" align="center" colspan="3">
<tbody>
<tr>
<td class="gradient" width="425">
<b>Navigation Bar</b>
</td>
</tr>
<tr>
<td class="tableborder">
<div align="center">
<p align="center">
<a href="?page=wepons">Weapons Store</a>
»
<a href="?page=bullets">Bullet Factory</a>
»
<a href="?page=armour">Armour Store</a>
</p>
</div>
</td>
</tr>
</tbody>
</table>

<span style="font-size: 11px; font-family: Arial Rounded MT Bold;">
<?php if (strip_tags($_POST['buyBS'])){
if($fetch->money < "25000000"){
echo "<center>You have not got £25,000,000 to buy this store.<br />"; }elseif($fetch->money > "25000000"){
mysqli_query( $connection, "UPDATE accounts SET money=money-25000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE bf SET owner='$username' WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='bf'");
echo "<center>The bullet store in $fetch->location is now yours. All previous stocks have been dropped.<br />";	}}

if (strip_tags($_POST['buyAS'])){
if($fetch->money < "25000000"){
echo "<center>You have not got £25,000,000 to buy this store.<br />"; }elseif($fetch->money > "25000000"){
mysqli_query( $connection, "UPDATE accounts SET money=money-25000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE af SET owner='$username' WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='af'");
echo "<center>The armour store in $fetch->location is now yours. All previous stocks have been dropped.<br />";	}}

if (strip_tags($_POST['buyWS'])){
if($fetch->money < "25000000"){
echo "<center>You have not got £25,000,000 to buy this store.<br />"; }elseif($fetch->money > "25000000"){
mysqli_query( $connection, "UPDATE accounts SET money=money-25000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE wf SET owner='$username' WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='wf'");
echo "<center>The weapon store in $fetch->location is now yours. All previous stocks have been dropped.<br />";	}} 


if($_POST['buybullets']){

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buy' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "<center>There is no such equipment selected.<br />"; }elseif($rows != "0"){

$bamount=intval(strip_tags($_POST['bamount']));
if ($bamount == "0" || !$bamount || ereg('[^0-9]',$bamount)){ echo "<center>Invalid amount of bullet quantity.<br />";
}elseif ($bamount != 0 || $bamount || !ereg('[^0-9]',$bamount)){
$costs = $check->price * $bamount;
  
if ($costs > $fetch->money){ echo "<center>You do not have enough money to buy $bamount $check->name.<br />";
}elseif ($costs <= $fetch->money){
	
if ($check->quantity < $bamount){ echo "<center>There is not that many bullets in stock.<br />"; }elseif ($bamount <= $check->quantity){

if($check->name == "LHP"){ $newammount = $bamount + $fetch->lhp; }
elseif($check->name == "FMJ"){ $newammount = $bamount + $fetch->fmj; }
$nstock = $check->quantity - $bamount;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs, $check->name=$check->name+$bamount WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchbf->owner'");
echo "<center>You've bought $bamount $check->name for &pound;".makecomma($costs).".<br />"; }}}}}


if($_POST['buyarmour']){

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buy' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$aamount=intval(strip_tags($_POST['aamount']));
if ($aamount == "0" || !$aamount || ereg('[^0-9]',$aamount)){ echo "Invalid amount of armour equipment quantity.<br />";
}elseif ($aamount != 0 || $aamount || !ereg('[^0-9]',$aamount)){
$costs = $check->price * $aamount;
  
if ($costs > $fetch->money){ echo "You do not have enough money to buy $aamount $check->name's.<br />";
}elseif ($costs <= $fetch->money){
	
if ($check->quantity < $aamount){ echo "There is not that many $check->name's in stock.<br />"; }elseif ($aamount <= $check->quantity){

$nstock = $check->quantity - $aamount;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchaf->owner'");
mysqli_query( $connection, "UPDATE inventory SET $check->name=$check->name+$aamount WHERE username='$username'");
echo "You've bought $aamount $check->name's for &pound;".makecomma($costs).".<br />"; }}}}}   


if($_POST['buyweapons']){

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buy' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$amount=intval(strip_tags($_POST['wamount']));
if ($amount == "0" || !$amount || ereg('[^0-9]',$amount)){ echo "Invalid amount of weapon equipment quantity.<br />";
}elseif ($amount != 0 || $amount || !ereg('[^0-9]',$amount)){
$costs = $check->price * $amount;
  
if ($costs > $fetch->money){ echo "You do not have enough money to buy $amount $check->name's.<br />";
}elseif ($costs <= $fetch->money){
	
if ($check->quantity < $amount){ echo "There is not that many $check->name's in stock.<br />"; }elseif ($amount <= $check->quantity){

$nstock = $check->quantity - $amount;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchwf->owner'");
mysqli_query( $connection, "UPDATE inventory SET $check->name=$check->name+$amount WHERE username='$username'");
echo "You've bought $amount $check->name's for &pound;".makecomma($costs).".<br />"; }}}}} 


////////// BUYING STOCKS //////////////

if($_POST['buybulletsstock']){

if ($fetchbf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buystock' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$bstock=intval(strip_tags($_POST['bstock']));
if ($bstock == "0" || !$bstock || ereg('[^0-9]',$bstock)){ echo "Invalid amount of bullet quantity.<br />";
}elseif ($bstock != 0 || $bstock || !ereg('[^0-9]',$bstock)){

if ($check->name == "FMJ"){ $costs = (1000 * $bstock);
}elseif ($check->name == "LHP"){ $costs = (2000 * $bstock); }
  
if ($costs > $fetch->money){ echo "You do not have enough money to buy $bstock $check->name.<br />";
}elseif ($costs <= $fetch->money){

$nstock = $check->quantity + $bstock;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
echo "You've stocked up $bstock $check->name for &pound;".makecomma($costs).".<br />"; }}}}}


if($_POST['buyarmourstock']){

if ($fetchaf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buystock' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$astock=intval(strip_tags($_POST['astock']));
if ($astock == "0" || !$astock || ereg('[^0-9]',$astock)){ echo "Invalid amount of armour quantity.<br />";
}elseif ($astock != 0 || $astock || !ereg('[^0-9]',$astock)){

if ($check->name == "Helmet"){ $costs = (700000 * $astock);
}elseif ($check->name == "Ballistic"){ $costs = (1000000 * $astock);
}elseif ($check->name == "ChainMail"){ $costs = (2000000 * $astock);
}elseif ($check->name == "StabVest"){ $costs = (4000000 * $astock);
}elseif ($check->name == "MK6"){ $costs = (8000000 * $astock); }
  
if ($costs > $fetch->money){ echo "You do not have enough money to buy $astock $check->name's.<br />";
}elseif ($costs <= $fetch->money){

$nstock = $check->quantity + $astock;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
echo "You've stocked up $astock $check->name's for &pound;".makecomma($costs).".<br />"; }}}}}  


if($_POST['buyweaponstock']){

if ($fetchwf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buystock' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$wstock=intval(strip_tags($_POST['wstock']));
if ($wstock == "0" || !$wstock || ereg('[^0-9]',$wstock)){ echo "Invalid amount of weapon quantity.<br />";
}elseif ($wstock != 0 || $wstock || !ereg('[^0-9]',$wstock)){

if ($check->name == "M16A4"){ $costs = (50000 * $wstock);
}elseif ($check->name == "MP5"){ $costs = (100000 * $wstock);
}elseif ($check->name == "P90"){ $costs = (150000 * $wstock);
}elseif ($check->name == "PSG1"){ $costs = (250000 * $wstock);
}elseif ($check->name == "SA80"){ $costs = (400000 * $wstock);
}elseif ($check->name == "G36C"){ $costs = (520000 * $wstock); 
}elseif ($check->name == "FAMAS"){ $costs = (800000 * $wstock);
}elseif ($check->name == "Steyr"){ $costs = (1100000 * $wstock); }
  
if ($costs > $fetch->money){ echo "You do not have enough money to buy $wstock $check->name's.<br />";
}elseif ($costs <= $fetch->money){

$nstock = $check->quantity + $wstock;

mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");
mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");
echo "You've stocked up $wstock $check->name's for &pound;".makecomma($costs).".<br />"; }}}}} 


if($_POST['updatebulletsprice']){	

if ($fetchbf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$bfnewprice=intval(strip_tags($_POST['bfnewprice'])); 
if ($bfnewprice == "0" || !$bfnewprice || ereg('[^0-9]',$bfnewprice)){ echo "Invalid new price quantity.<br />";
}elseif ($bfnewprice != 0 || $bfnewprice || !ereg('[^0-9]',$bfnewprice)){

mysqli_query( $connection, "UPDATE stocks SET price='$bfnewprice' WHERE location='$check->location' AND id='$updateprices'");
echo "You changed the price of the $check->name's to &pound;".makecomma($bfnewprice)." in your bullet store."; }}}}


if($_POST['updatearmourprice']){	

if ($fetchaf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$afnewprice=intval(strip_tags($_POST['afnewprice'])); 
if ($afnewprice == "0" || !$afnewprice || ereg('[^0-9]',$afnewprice)){ 
echo "Invalid new price quantity.<br />";
}elseif ($afnewprice != 0 || $afnewprice || !ereg('[^0-9]',$afnewprice)){

mysqli_query( $connection, "UPDATE stocks SET price='$afnewprice' WHERE location='$check->location' AND id='$updateprices'");
echo "You changed the price of the $check->name's to &pound;".makecomma($afnewprice)."<br /> in your armour store."; }}}}


if($_POST['updateweaponprice']){	

if ($fetchwf->owner == "$username"){ 

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
if($rows == "0"){ echo "There is no such equipment selected.<br />"; }elseif($rows != "0"){

$wfnewprice=intval(strip_tags($_POST['wfnewprice'])); 
if ($wfnewprice == "0" || !$wfnewprice || ereg('[^0-9]',$wfnewprice)){ 
echo "Invalid new price quantity.<br />";
}elseif ($wfnewprice != 0 || $wfnewprice || !ereg('[^0-9]',$wfnewprice)){

mysqli_query( $connection, "UPDATE stocks SET price='$wfnewprice' WHERE location='$check->location' AND id='$updateprices'");
echo "You changed the price of the $check->name's to &pound;".makecomma($wfnewprice)."<br /> in your weapon store."; }}}}



if($_POST['dropbs']){	
if ($fetchbf->owner == "$username"){ 
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='bf'");
mysqli_query( $connection, "UPDATE bf SET owner='0' WHERE location='$fetch->location' AND owner='$username'");
echo "You have dropped the bullet store which you owned in $fetch->location."; }}

if($_POST['dropas']){	
if ($fetchaf->owner == "$username"){ 
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='af'");
mysqli_query( $connection, "UPDATE af SET owner='0' WHERE location='$fetch->location' AND owner='$username'");
echo "You have dropped the armour store which you owned in $fetch->location."; }}

if($_POST['dropws']){	
if ($fetchwf->owner == "$username"){ 
mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='wf'");
mysqli_query( $connection, "UPDATE wf SET owner='0' WHERE location='$fetch->location' AND owner='$username'");
echo "You have dropped the weapon store which you owned in $fetch->location."; }} ?> 
 </span>
</td>
<?php echo "$title"; ?></td>
<?php if ($page == ""){ ?>


<?php }elseif ($page == "bullets"){ ?>  
<?php if ($buy == ""){ ?>
<?php if ($buystock == "" && $updateprices == ""){ ?>
<table width="323" border="0" align="center" cellpadding="2" style="color: #FFFFFF; font-family: Arial Rounded MT Bold; font-size: 10px;">
<br>
<br>
<?php }elseif ($buystock != "" && $updateprices == ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Bullets [Stock]</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Buy an amount of bullets for your store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="bstock" type="text" id="bstock" class="textbox" value="" size="7" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="buybulletsstock" value="Buy Stock"></td>
</tr></table>
<br>
<br>
<?php }elseif ($buystock == "" && $updateprices != ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Update Bullets Price</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Update the price for the bullets store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Current Price:</td>
<td align="left" width="50%" class="tableborder">
<?php $curprice = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ")); 
echo "&pound;".makecomma($curprice->price).""; ?></td>
</tr>
<tr>
<td align="right" width="50%" class="tableborder">New Price:</td>
<td align="left" width="50%" class="tableborder">
<input name="bfnewprice" type="text" id="bfnewprice" class="textbox" value="" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="updatebulletsprice" value="Update Price"></td>
</tr></table>
<br>
<br>
<?php }}elseif ($buy != ""){ ?> 
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Bullets</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Buy an amount of bullets equipment.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="bamount" type="text" id="bamount" class="textbox" value="" size="7" maxlength="10"></td>
</tr>

<tr>
<td colspan="2" class="tableborder" align="center"><input type="submit" class="custombutton" name="buybullets" value="Buy Bullets"></td>
</tr></table>
<br>
<br>
<?php } ?>


<?php }elseif ($page == "armour"){ ?> 
<?php if ($buy == ""){ ?>
<?php if ($buystock == "" && $updateprices == ""){ ?>
<table width="323" border="0" align="center" cellpadding="2" style="color: #FFFFFF; font-family: Arial Rounded MT Bold; font-size: 10px;">
<br>
<br>
<?php }elseif ($buystock != "" && $updateprices == ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Armour [Stock]</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Buy an amount of armour for your store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="astock" type="text" id="astock" class="textbox" value="" size="7" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="buyarmourstock" value="Buy Stock"></td>
</tr></table>
<br>
<br>
<?php }elseif ($buystock == "" && $updateprices != ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Update Armour Price</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Update the price for the armour store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Current Price:</td>
<td align="left" width="50%" class="tableborder">
<?php $curprice = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ")); 
echo "&pound;".makecomma($curprice->price).""; ?></td>
</tr>
<tr>
<td align="right" width="50%" class="tableborder">New Price:</td>
<td align="left" width="50%" class="tableborder">
<input name="afnewprice" type="text" id="afnewprice" class="textbox" value="" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="updatearmourprice" value="Update Price"></td>
</tr></table>
<br>
<br>
<?php }}elseif ($buy != ""){ ?> 
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Armour</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Buy an amount of armour equipment.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="aamount" type="text" id="aamount" class="textbox" value="" size="7" maxlength="10"></td>
</tr>

<tr>
<td colspan="2" class="tableborder" align="center"><input type="submit" class="custombutton" name="buyarmour" value="Buy Armour"></td>
</tr></table>
<br>
<br>
<?php } ?>


<?php }elseif ($page == "wepons"){ ?> 
<?php if ($buy == ""){ ?>
<?php if ($buystock == "" && $updateprices == ""){ ?>
<table width="323" border="0" align="center" cellpadding="2" style="color: #FFFFFF; font-family: Arial Rounded MT Bold; font-size: 10px;">
<br>
<br>
<?php }elseif ($buystock != "" && $updateprices == ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Weapons [Stock]</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Buy an amount of weapons for your store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="wstock" type="text" id="wstock" class="textbox" value="" size="7" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="buyweaponstock" value="Buy Stock"></td>
</tr></table>
<br>
<br>
<?php }elseif ($buystock == "" && $updateprices != ""){ ?>
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Update Weapons Price</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">
Update the price for the weapons store.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Current Price:</td>
<td align="left" width="50%" class="tableborder">
<?php $curprice = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$updateprices' AND `location` ='$fetch->location' ")); 
echo "&pound;".makecomma($curprice->price).""; ?></td>
</tr>
<tr>
<td align="right" width="50%" class="tableborder">New Price:</td>
<td align="left" width="50%" class="tableborder">
<input name="wfnewprice" type="text" id="wfnewprice" class="textbox" value="" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" class="tableborder" align="center">
<input type="submit" class="custombutton" name="updateweaponprice" value="Update Price"></td>
</tr></table>
<br>
<br>
<?php }}elseif ($buy != ""){ ?> 
<br>
<br>
<table width="25%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" colspan="2" class="gradient">Buying Weapons</td></tr>
<tr><td height="20" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Buy an amount of weapon equipment.</td></tr>
<tr>
<td align="right" width="50%" class="tableborder">Quantity:</td>
<td align="left" width="50%" class="tableborder">
<input name="wamount" type="text" id="wamount" class="textbox" value="" size="7" maxlength="10"></td>
</tr>

<tr>
<td colspan="2" class="tableborder" align="center"><input type="submit" class="custombutton" name="buyweapons" value="Buy Weapons"></td>
</tr></table>
<br>
<br>
<?php } ?>
<?php } ?>

<?php if ($page == ""){ ?>
<br><br>
<div align="center"><i>Image Here</i></div>

<?php }elseif ($page == "bullets"){ ?> 
<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient">Bullets Store Information</td></tr>
<tr><td height="22" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Owner of store: 
<?php if ($fetchbf->owner == "0" || $fetchbf->owner == ""){ echo "Unowned"; }else{ echo "$fetchbf->owner"; } ?></td></tr>           
<tr>
<?php if ($fetchbf->owner == "0" || $fetchbf->owner == ""){ echo "<tr><td colspan=\"3\" align=\"center\" class=\"tableborder\"> This store doesn't posses an owner, therefore no stocks are available to buy. You can take over this store by clicking the \"Buy\" button at the bottom.<br /><b>Warning: This store costs &pound;25,000,000.</b><br /><br />
<input name=\"buyBS\" type=\"submit\" class=\"custombutton\" id=\"buyBS\" value=\"Purchase\"></td></tr>"; }else{ ?>
<td width="45%" align="center" class="tableborder"><u>Equipment</u></td>
<td width="30%" align="center" class="tableborder"><u>Price</u></td> 
<td width="25%" align="center" class="tableborder"><u>Stocks</u></td> 
</tr>
<?php $ka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='bf'");
while($pa=mysqli_fetch_object($ka)){
if ($stockup != ""){ $buystocking = " [<a href=\"?page=bullets&buystock=$pa->id&stockup=$fetchbf->id\">Buy Stocks</a>]";
                     $updateprice = " [<a href=\"?page=bullets&priceupdate=$pa->id&stockup=$fetchbf->id\">P</a>]"; }
echo "<tr>
<td align=\"center\" class=\"tableborder\"><a href=\"?buy=$pa->id&page=bullets\"><b>$pa->name</b></a>$buystocking</td>
<td align=\"center\" class=\"tableborder\">&pound;".makecomma($pa->price)."$updateprice</td>
<td align=\"center\" class=\"tableborder\">".makecomma($pa->quantity)."</td>
</tr>"; }} ?>
</table><?php if ($fetchbf->owner == "$username"){ echo "<div align=\"center\"><br /><a href=\"?stockup=$fetchbf->id&page=bullets\">Stocks Control</a></div>"; }else{} ?>
<?php if ($stockup != ""){ ?><div align="center"><br />
<input type="submit" class="custombutton" name="dropws" value="Drop Store"></div><?php } ?>

<?php }elseif ($page == "armour"){ ?> 
<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient">Armour Store Information</td></tr>
<tr><td height="22" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Owner of store: 
<?php if ($fetchaf->owner == "0" || $fetchaf->owner == ""){ echo "Unowned"; }else{ echo "$fetchaf->owner"; } ?></td></tr>           
<tr>
<?php if ($fetchaf->owner == "0" || $fetchaf->owner == ""){ echo "<tr><td colspan=\"3\" align=\"center\" class=\"tableborder\"> This store doesn't posses an owner, therefore no stocks are available to buy. You can take over this store by clicking the \"Buy\" button at the bottom.<br /><b>Warning: This store costs &pound;25,000,000.</b><br /><br />
<input name=\"buyAS\" type=\"submit\" class=\"custombutton\" id=\"buyAS\" value=\"Purchase\"></td></tr>"; }else{ ?>
<td width="45%" align="center" class="tableborder"><u>Equipment</u></td>
<td width="30%" align="center" class="tableborder"><u>Price</u></td> 
<td width="25%" align="center" class="tableborder"><u>Stocks</u></td> 
</tr>
<?php $ka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='af'");
while($pa=mysqli_fetch_object($ka)){
if ($stockup != ""){ $buystocking = " [<a href=\"?page=armour&buystock=$pa->id&stockup=$fetchbf->id\">Buy Stocks</a>]";
                     $updateprice = " [<a href=\"?page=armour&priceupdate=$pa->id&stockup=$fetchbf->id\">P</a>]"; }
echo "<tr>
<td align=\"center\" class=\"tableborder\"><a href=\"?buy=$pa->id&page=armour\"><b>$pa->name</b></a>$buystocking</td>
<td align=\"center\" class=\"tableborder\">&pound;".makecomma($pa->price)."$updateprice</td>
<td align=\"center\" class=\"tableborder\">".makecomma($pa->quantity)."</td>
</tr>"; }} ?>
</table><?php if ($fetchaf->owner == "$username"){ echo "<div align=\"center\"><br /><a href=\"?stockup=$fetchaf->id&page=armour\">Stocks Control</a></div>"; }else{} ?>
<?php if ($stockup != ""){ ?><div align="center"><br />
<input type="submit" class="custombutton" name="dropws" value="Drop Store"></div><?php } ?>

<?php }elseif ($page == "wepons"){ ?> 
<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient">Weapons Store Information</td></tr>
<tr><td height="22" colspan="3" bgcolor="#FFFFFF" style="color: #000000;" align="center">Owner of store: 
<?php if ($fetchwf->owner == "0" || $fetchwf->owner == ""){ echo "Unowned"; }else{ echo "$fetchwf->owner"; } ?></td></tr>           
<tr>
<?php if ($fetchwf->owner == "0" || $fetchwf->owner == ""){ echo "<tr><td colspan=\"3\" align=\"center\" class=\"tableborder\"> This store doesn't posses an owner, therefore no stocks are available to buy. You can take over this store by clicking the \"Buy\" button at the bottom.<br /><b>Warning: This store costs &pound;25,000,000.</b><br /><br />
<input name=\"buyWS\" type=\"submit\" class=\"custombutton\" id=\"buyWS\" value=\"Purchase\"></td></tr>"; }else{ ?>
<td width="45%" align="center" class="tableborder"><u>Equipment</u></td>
<td width="30%" align="center" class="tableborder"><u>Price</u></td> 
<td width="25%" align="center" class="tableborder"><u>Stocks</u></td> 
</tr>
<?php $ka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='wf'");
while($pa=mysqli_fetch_object($ka)){
if ($stockup != ""){ $buystocking = " [<a href=\"?page=wepons&buystock=$pa->id&stockup=$fetchbf->id\">Buy Stocks</a>]";
                     $updateprice = " [<a href=\"?page=wepons&priceupdate=$pa->id&stockup=$fetchbf->id\">P</a>]"; }
echo "<tr>
<td align=\"center\" class=\"tableborder\"><a href=\"?buy=$pa->id&page=wepons\"><b>$pa->name</b></a>$buystocking</td>
<td align=\"center\" class=\"tableborder\">&pound;".makecomma($pa->price)."$updateprice</td>
<td align=\"center\" class=\"tableborder\">".makecomma($pa->quantity)."</td>
</tr>"; }} ?>
</table><?php if ($fetchwf->owner == "$username"){ echo "<div align=\"center\"><br /><a href=\"?stockup=$fetchwf->id&page=wepons\">Stocks Control</a></div>"; }else{} ?><?php } ?>
<?php if ($stockup != ""){ ?><div align="center"><br />
<input type="submit" class="custombutton" name="dropws" value="Drop Store"></div><?php } ?>

</td>
</tr>
<?php if ($updateprices != ""){ ?><tr>
<br>
  <td colspan="2" width="100%" align="center"><center>If prices are ridiculously high, your store shall be removed.</center></span></td>
</tr><?php } ?>

</table>
</td></tr>  
</table> 
 
<?php include_once "incfiles/foot.php"; ?> 
</form>
</body>
</html> 
