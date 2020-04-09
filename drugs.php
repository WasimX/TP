<?php
error_reporting(0);
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/jailcheck.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$drugtime=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM drugs WHERE location='$fetch->location'"));

$rankss=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));
$limit = $rankss->id * 5;
$drugsa = mysqli_query( $connection, "SELECT drugs, money, rank FROM accounts WHERE username='$username'");
while($successa = mysqli_fetch_row($drugsa)){
	$boya = explode("-", $successa[0]);
	$money = $successa[1];
	$rank= $successa[2];
}
$drugs1 = mysqli_query( $connection, "SELECT drugprices FROM drugs WHERE location='$fetch->location'");
while($success1 = mysqli_fetch_row($drugs1)){
$prices = explode("-", $success1[0]); }

if ($drugtime->timeleft < time()){ 
$rand0 = rand(1500,2500);
$rand01 = rand(1500,2500);
$weed = $prices[0] + $rand0 - $rand01;
if ($weed < "0"){ $weed = "3000"; }

$rand1 = rand(2000,7500);
$rand11 = rand(2000,7500);
$heroin = $prices[1] + $rand1 - $rand11;
if ($heroin < "0"){ $heroin = "18000"; }

$rand2 = rand(7500,10000);
$rand21 = rand(7500,10000);
$cocaine = $prices[2] + $rand2 - $rand21;
if ($cocaine < "0"){ $cocaine = "50000"; }

$rand3 = rand(500,1000);
$rand31 = rand(500,1000);
$hash = $prices[3] + $rand3 - $rand31;
if ($hash < "0"){ $hash = "900"; }

$rand4 = rand(1500,2500);
$rand41 = rand(1500,2500);
$speed = $prices[4] + $rand4 - $rand41;
if ($speed < "0"){ $speed = "8000"; }

$rand5 = rand(1000,5000);
$rand51 = rand(1000,5000);
$morphine = $prices[5] + $rand5 - $rand51;
if ($morphine < "0"){ $morphine = "13000"; }

$rand3 = rand(2000,3000);
$rand31 = rand(2000,3000);
$phencyclidine = $prices[6] + $rand3 - $rand31;
if ($phencyclidine < "0"){ $phencyclidine = "27000"; }

$rand3 = rand(6000,7000);
$rand31 = rand(6000,7000);
$ecstacy = $prices[7] + $rand3 - $rand31; 
if ($ecstacy < "0"){ $ecstacy = "37000"; }

$newtime=time() + 5400;
mysqli_query( $connection, "UPDATE drugs SET timeleft='$newtime', drugprices='$weed-$heroin-$cocaine-$hash-$speed-$morphine-$phencyclidine-$ecstacy' WHERE location='$fetch->location'"); 
}


$timelef = $drugtime->timeleft - time();
$time = $timelef / 60;
$timeleft = round($time);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>

<body>
<center>
  <form action="" method="post" name="">
  <table width="400" border="0" cellspacing="0" cellpadding="0" class="table1px">
    <tr>

      <td colspan="5" class="gradient" height="30">Drugs Cartel</td>
    </tr> 
    <tr>
      <td class="tableborder" align="center"><u>Drug</u></td>
      <td class="tableborder" align="center"><u>Price</u></td>
      <td class="tableborder" align="center"><u>Buy </u></td>
      <td class="tableborder" align="center"><u>Sell</u></td>
      <td class="tableborder" align="center"><u>Quantity</u></td>
    </tr>
    <tr>
      <td width="20%" class="tableborder" align="center">Weed</td>
      <td width="44%" class="tableborder" align="center"><?php echo "£".makecomma($prices[0]).""; ?> per unit</td>
      <td width="10%" class="tableborder" align="center"><input name="type" type="radio" value="1" /></td>
      <td width="9%" class="tableborder" align="center"><input name="type" type="radio" value="1b" /></td>
      <td width="17%" class="tableborder" align="center"><?php echo "$boya[0]"; ?></td>
    </tr>
    <tr>

      <td class="tableborder" align="center">Heroin</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[1]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="2" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="2b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[1]"; ?></td>
    </tr>
    <tr>
      <td class="tableborder" align="center">Cocaine</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[2]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="3" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="3b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[2]"; ?></td>
    </tr>

    <tr>
      <td class="tableborder" align="center">Hash</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[3]).""; ?>  per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="4" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="4b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[3]"; ?></td>
    </tr>
    <tr>
      <td class="tableborder" align="center">Speed</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[4]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="5" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="5b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[4]"; ?></td>

    </tr>
    <tr>
      <td class="tableborder" align="center">Morphine</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[5]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="6" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="6b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[5]"; ?></td>
    </tr>
    <tr>
      <td class="tableborder" align="center">Phencyclidine</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[6]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="7" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="7b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[6]"; ?></td>

    </tr>
    <tr>
      <td class="tableborder" align="center">Ecstasy</td>
      <td class="tableborder" align="center"><?php echo "£".makecomma($prices[7]).""; ?> per unit</td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="8" /></td>
      <td class="tableborder" align="center"><input name="type" type="radio" value="8b" /></td>
      <td class="tableborder" align="center"><?php echo "$boya[7]"; ?></td>
    </tr>
    <tr>
      <td colspan="5" class="tablebackground" align="center">
You are currently in the capital of <b><?php echo "$fetch->location"; ?></b>, where you have met your drug dealer. He can only offer you a maximum of <b><?php echo "$limit"; ?></b> units per drug, due to your rank being <b><?php echo "$fetch->rank"; ?></b><br /><br />
You better hurry, as the dealer will change his prices; either higher or lower in <b><?php echo "$timeleft"; ?> minutes</b>, therefore you need to get a good deal!

        <p align="center">Amount (Buy / Sell): 
          <input name="quantity" type="text" class="textbox" id="quantity" size="5" maxlength="3" />
          <br />
          <br />
          <input name="dd" type="submit" class="custombutton" id="dd" value="Deal Drugs!" />
        </p></td>
    </tr>
  </table>

<?php 
if (strip_tags($_POST['dd'])){
$quantity=strip_tags($_POST['quantity']);
$radio=strip_tags($_POST['type']);

if (ereg('[^0-9]', $quantity)) {  
echo "$quantity is an invalid numeric figure.";
}elseif (!ereg('[^0-9]', $quantity)) {  

if ($radio == "1"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[0];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[0] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $quant;
$tot2 = $boya[1];
$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='5'"));
if($chek > '0'){
if($fetch->location == "England"){
if($d3 != "0"){
echo"You cant buy any weed in England while on mission 5.";
exit();
}}}
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of weed.";
}}}}

if ($radio == "1b"){
if ($quantity > "0"){ 
if ($quantity > $boya[0]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[0]){
$quant = $boya[0] - $quantity;
$price = $prices[0] * $quantity;
$tot1 = $quant;
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of weed.";
}}}

if ($radio == "2"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[1];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[1] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $quant;
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of heroin.";
}}}}

if ($radio == "2b"){
if ($quantity > "0"){ 
if ($quantity > $boya[1]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[1]){
$quant = $boya[1] - $quantity;
$price = $prices[1] * $quantity;
$tot1 = $boya[0];
$tot2 = $quant;
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of heroin.";
}}}


if ($radio == "3"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[2];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[2] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $quant;
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of cocaine.";
}}}}

if ($radio == "3b"){
if ($quantity > "0"){ 
if ($quantity > $boya[2]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[2]){
$quant = $boya[2] - $quantity;
$price = $prices[2] * $quantity;
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $quant;
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of cocaine.";
}}}

if ($radio == "4"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[3];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[3] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $quant;
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of hash.";
}}}}

if ($radio == "4b"){
if ($quantity > "0"){ 
if ($quantity > $boya[3]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[3]){
$quant = $boya[3] - $quantity;
$price = $prices[3] * $quantity;
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $quant;
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of hash.";
}}}


if ($radio == "5"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[4];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[4] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $quant;
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of speed.";
}}}}

if ($radio == "5b"){
if ($quantity > "0"){ 
if ($quantity > $boya[4]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[4]){
$quant = $boya[4] - $quantity;
$price = $prices[4] * $quantity;
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $quant;
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of speed.";
}}}


if ($radio == "6"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[5];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[5] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $quant; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of morphine.";
}}}}

if ($radio == "6b"){
if ($quantity > "0"){ 
if ($quantity > $boya[5]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[5]){
$quant = $boya[5] - $quantity;
$price = $prices[5] * $quantity;
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boya[3];
$tot5 = $boya[4];
$tot6 = $quant; 
$tot7 = $boya[6];
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of morphine.";
}}}

if ($radio == "7"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[6];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[6] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boys[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $quant;
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of phencyclidine.";
}}}}

if ($radio == "7b"){
if ($quantity > "0"){ 
if ($quantity > $boya[6]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[6]){
$quant = $boya[6] - $quantity;
$price = $prices[6] * $quantity;
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boys[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $quant;
$tot8 = $boya[7];
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of phencyclidine.";
}}}


if ($radio == "8"){
if ($quantity > "0"){ 
$quant = $quantity + $boya[7];
if ($quant > $limit){ echo "You are not allowed over your limit of <b>$limit</b> drugs."; }
elseif ($quant <= $limit){
$price = $prices[7] * $quantity;
if ($price > $fetch->money){ echo "You cannot afford <b>$quantity</b> drugs."; }
elseif ($price <= $fetch->money){
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boys[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $quant;
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money-$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have bought <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of ecstacy.";
}}}}

if ($radio == "8b"){
if ($quantity > "0"){ 
if ($quantity > $boya[7]){ echo "You do not have <b>$quantity</b> drugs to sell."; }
elseif ($quantity <= $boya[7]){
$quant = $boya[7] - $quantity;
$price = $prices[7] * $quantity; 
$tot1 = $boya[0];
$tot2 = $boya[1];
$tot3 = $boya[2];
$tot4 = $boys[3];
$tot5 = $boya[4];
$tot6 = $boya[5]; 
$tot7 = $boya[6];
$tot8 = $quant;
$newdrugs = "$tot1-$tot2-$tot3-$tot4-$tot5-$tot6-$tot7-$tot8";
mysqli_query( $connection, "UPDATE accounts SET money=money+$price, drugs='$newdrugs' WHERE username='$username'");
echo "You have sold <b>$quantity</b> drugs for <b>&pound;".makecomma($price).".</b> You now have <b>$quant</b> units of ecstacy.";
}}}
}
} ?>
</td> 
  </form>
<?php include_once "incfiles/foot.php"; ?>
</body>
</html>
