<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
error_reporting(0);

$ranking= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

$mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($mysqli);

$mysqli222=mysqli_query( $connection, "SELECT * FROM roulette WHERE location='$fetch->location'");
$roulette1=mysqli_fetch_object($mysqli222);
$name = $fetch->username;
$money = $fetch->money;
$location = $fetch->location;
$sql = "SELECT owner,max,profit FROM roulette WHERE location='$location'";
$query = mysqli_query( $connection, $sql);
$row = mysqli_fetch_object($query);
$owner = htmlspecialchars($row->owner);
$profit = htmlspecialchars($row->profit);
$rl_max = htmlspecialchars($row->max);
$sql = "SELECT status FROM accounts WHERE username='$owner'";
$query = mysqli_query( $connection, $sql);
$row = mysqli_fetch_object($query);
$casino_state = htmlspecialchars($row->status);

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}



if(isset($_POST['Update'])){ 
$_POST['max_bet'] = ereg_replace("[^0-9]",'',$_POST['max_bet']);
if(empty($_POST['max_bet'])){
echo "You didn't enter a maximum bet for your roulette.";
}else{
if($owner != $name ){
$mes2 .= "You don't own this roulette.";
}else{
if($_POST['max_bet'] >= 5000000001){
$mes2 .="The maximum bet allowed is &pound;5,000,000,000";
}else{
if($_POST['max_bet'] < 100000){
$mes2 .= "The minimum bet allowed is &pound;100,000";
}else{
$result = mysqli_query( $connection, "UPDATE roulette SET max='".mysqli_real_escape_string($_POST['max_bet'])."' WHERE location='$location'") or die(mysqli_error());
$mes2 .= "You have changed your maxbet for the Roulette table in $location to &pound;".number_format($_POST['max_bet'])."";
$rl_max = $_POST['max_bet'];

}}}}}


if(isset($_POST['drop'])){
if($owner != $name ){
$mes2 .="You don't own this roulette table.";
}else{
$result = mysqli_query( $connection, "UPDATE roulette SET owner='0', max='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$mes2 .= "You dropped your roulette.";
}}

if(isset($_POST['Transfer'])){
$sql = "SELECT username,status FROM accounts WHERE username='".mysqli_real_escape_string($_POST['name'])."'";
$query = mysqli_query( $connection, $sql) or die(mysqli_error());
$row = mysqli_fetch_object($query);
$new_name = htmlspecialchars($row->username);
$receivers_state = htmlspecialchars($row->status);
if($receivers_state == "Banned"){
$mes2 .= "Its not allowed to sent properties to people that have been banned.";
}else{
if($receivers_state == "Dead"){
$mes2 .= "Its not allowed to send properties to people that have been killed.";
}else{
if(empty($new_name)){
$mes2 .= $lang_no_user;
}else{
if($owner != $name ){
$mes2 .="You don't own this roulette table.";
}else{
$result = mysqli_query( $connection, "UPDATE roulette SET owner='$new_name', max='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$mes2 .= "You sent your Roulette to <a href='profile.php?viewing=$new_name'>$new_name</a>.";
}}}}}

if(isset($_POST['Bet'])){

$number = rand(1,36);

for ($i = 0; $i < 37; $i++) { $_POST[$i] = ereg_replace("[^0-9]",'',$_POST[$i]); $_POST[$i] = round($_POST[$i]); }

$_POST['47'] = round(ereg_replace("[^0-9]",'',$_POST['47']));
$_POST['48'] = round(ereg_replace("[^0-9]",'',$_POST['48']));

$_POST['43'] = round(ereg_replace("[^0-9]",'',$_POST['43']));
$_POST['44'] = round(ereg_replace("[^0-9]",'',$_POST['44']));
$_POST['45'] = round(ereg_replace("[^0-9]",'',$_POST['45']));
$_POST['46'] = round(ereg_replace("[^0-9]",'',$_POST['46']));
$_POST['37'] = round(ereg_replace("[^0-9]",'',$_POST['37']));
$_POST['38'] = round(ereg_replace("[^0-9]",'',$_POST['38']));
$_POST['39'] = round(ereg_replace("[^0-9]",'',$_POST['39']));
$_POST['40'] = round(ereg_replace("[^0-9]",'',$_POST['40']));
$_POST['41'] = round(ereg_replace("[^0-9]",'',$_POST['41']));
$_POST['42'] = round(ereg_replace("[^0-9]",'',$_POST['42']));


$wager = $_POST['1']+$_POST['2']+$_POST['3']+$_POST['4']+$_POST['5']+$_POST['6']+$_POST['7']+$_POST['8']+$_POST['9']+$_POST['10']+$_POST['11']+$_POST['12']+$_POST['13']+$_POST['14']+$_POST['15']+$_POST['16']+$_POST['17']+$_POST['18']+$_POST['19']+$_POST['20']+$_POST['21']+$_POST['22']+$_POST['23']+$_POST['24']+$_POST['25']+$_POST['26']+$_POST['27']+$_POST['28']+$_POST['29']+$_POST['30']+$_POST['31']+$_POST['32']+$_POST['33']+$_POST['34']+$_POST['35']+$_POST['36']+$_POST['37']+$_POST['38']+$_POST['39']+$_POST['40']+$_POST['41']+$_POST['42']+$_POST['43']+$_POST['44']+$_POST['45']+$_POST['46']+$_POST['47']+$_POST['48'];



if($wager < 1){
$message .= "You need to bet &pound;1 or higher.";
}else{

if($money < $wager){
$message .= "You don't have that much money.";
}else{

if($rl_max < $wager){
$message .= "You can't bet more then the maximum bet.";
}else{

if($owner == "0"){
$message .= "You can't gamble at a roulette if it has no owner.";
}else{

$won_money = 0;
for ($i = 0; $i <= 37; $i++) {if ($number == $i){ $won_money = $won_money + $_POST[$i] * 36;}}

$black = array ("2", "4", "6", "8", "10", "11", "13", "15", "17", "20", "22", "24", "26", "28", "29", "31", "33", "35"); 
$red = array ("1", "3", "5", "7", "9", "12", "14", "16", "18", "19", "21", "23", "25", "27", "30", "32", "34", "36"); 
$one_18 = array ("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18"); 
$nineteen_36 = array ("19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36"); 
$one_12 = array ("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"); 
$twelve_24 = array ("13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24"); 
$twentyfour_36 = array ("25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36"); 
$odd = array ("1", "3", "5", "7", "9", "11", "13", "15", "17", "19", "21", "23", "25", "27", "29", "31", "33", "35"); 
$even = array ("2", "4", "6", "8", "10", "12", "14", "16", "18", "20", "22", "24", "26", "28", "30", "32", "34", "36"); 
$th_1 = array ("1", "4", "7", "10", "13", "16", "19", "22", "25", "28", "31", "34"); 
$nd_2 = array ("2", "5", "8", "11", "14", "17", "20", "23", "26", "29", "32", "35"); 
$rd_3 = array ("3", "6", "9", "12", "15", "18", "21", "24", "27", "30", "33", "36"); 

for ($i = 0; $i <= 37; $i++) {if ($number == $black[$i]){ $won_money = $won_money + $_POST['48'] * 2;}}
for ($i = 0; $i <= 37; $i++) { if ($number == $red[$i]){ $won_money = $won_money + $_POST['47'] * 2;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $one_18[$i]){ $won_money = $won_money + $_POST['45'] * 2;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $nineteen_36[$i]){ $won_money = $won_money + $_POST['46'] * 2;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $one_12[$i]){ $won_money = $won_money + $_POST['40'] * 3;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $twelve_24[$i]){ $won_money = $won_money + $_POST['41'] * 3;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $twentyfour_36[$i]){ $won_money = $won_money + $_POST['42'] * 3;}}
for ($i = 0; $i <= 37; $i++) { if ($number == $odd[$i]){ $won_money = $won_money + $_POST['44'] * 2;} }
for ($i = 0; $i <= 37; $i++) { if ($number == $even[$i]){ $won_money = $won_money + $_POST['43'] * 2;}}
for ($i = 0; $i <= 37; $i++) {if ($number == $th_1[$i]){ $won_money = $won_money + $_POST['37'] * 3;}}
for ($i = 0; $i <= 37; $i++) { if ($number == $nd_2[$i]){ $won_money = $won_money + $_POST['38'] * 3;}}
for ($i = 0; $i <= 37; $i++) { if ($number == $rd_3[$i]){ $won_money = $won_money + $_POST['39'] * 3;}}


$cash_count = $won_money - $wager;
$sql = "SELECT money FROM accounts WHERE username='$owner'";
$query = mysqli_query( $connection, $sql) or die(mysqli_error());
$row = mysqli_fetch_object($query);
$owners_money = htmlspecialchars($row->money);

if($owners_money - $cash_count < 0 && $fetch->rankpoints < 9999){
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Roulette', '$wager', '$fetch->location', '$owner', NOW(), 'Win', '$owners_money', 'Casino Dropped Not High Enough Rank')");
$result = mysqli_query( $connection, "UPDATE accounts SET money='0' WHERE username='$owner'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$owners_money WHERE username='$name'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE roulette SET owner='0', max='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$message .= "<b>You would have taken over this casino, but unfortunately you can only own a casino when ranked at Boss or above!<br><br>
The ball landed on $number! You bet &pound;".makecomma($wager)." and won &pound;".makecomma($won_money)."!</b>";
}else{
if($owners_money - $cash_count < 0 && $fetch->rankpoints > 9999){
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Roulette', '$wager', '$fetch->location', '$owner', NOW(), 'Win', '$owners_money', 'Wiped previous owner')");
$result = mysqli_query( $connection, "UPDATE accounts SET money='0' WHERE username='$owner'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$owners_money WHERE username='$name'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE roulette SET owner='$name', max='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$message .= "<b>You have taken over this Roulette table in $location from the previous owner, $owner, as they ran out of money!<br><br>
The ball landed on $number! You bet &pound;".makecomma($wager)." and won &pound;".makecomma($won_money)."!</b>";
}else{
if($won_money >= "1") {
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Roulette', '$cash_count', '$fetch->location', '$owner', NOW(), 'Win', '$cash_count', '')");
$result = mysqli_query( $connection, "UPDATE accounts SET money=money-$cash_count WHERE username='$owner'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$cash_count WHERE username='$username'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE roulette SET profit=profit-$cash_count WHERE location='$location'") or die(mysqli_error());
$message .= "The ball landed on $number! You bet &pound;".makecomma($wager)." and won &pound;".makecomma($won_money)."!";
}else{
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Roulette', '$wager', '$fetch->location', '$owner', NOW(), 'Lose', '0', '')");
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$cash_count WHERE username='$username'") or die(mysqli_error());
$sql = "SELECT money FROM accounts WHERE username='$username'";
$query = mysqli_query( $connection, $sql) or die(mysqli_error());
$row = mysqli_fetch_object($query);
$money_check = htmlspecialchars($row->money);
if($money_check < 0){
$result = mysqli_query( $connection, "UPDATE accounts SET status='Exploiter' WHERE username='$username'") or die(mysqli_error());
$message .= "You have been reported to the admins for exploiting the roulette table.";
}else{
$result = mysqli_query( $connection, "UPDATE accounts SET money=money-$cash_count WHERE username='$owner'") or die(mysqli_error());
$message .= "The ball landed on $number! You bet &pound;".makecomma($wager)." and won &pound;".makecomma($won_money)."!";
$result = mysqli_query( $connection, "UPDATE roulette SET profit=profit-$cash_count WHERE location='$location'") or die(mysqli_error());
}



$chek222=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='3'"));



if($chek222 > '0'){



mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); 

}}}}}}}}}


?>
<link rel="stylesheet" href="style.css" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {color: #000000; font-weight: bold; font-style: italic; }
-->
</style>


			<div class="scrll">
       		  <script>
			function Play(field){document.getElementById(field).value = parseInt(document.getElementById(field).value)+parseInt(document.getElementById('chipsze').value);
			document.getElementById(1000).value = parseInt(document.getElementById(1000).value)+parseInt(document.getElementById('chipsze').value);			}
			
			function Chip(amount){document.getElementById('chipsze').value=amount;}
			function Reset(){i=1;while (i<=50){document.getElementById(i).value=0;i++;}}
			
			
            </script>
            <style>
            area{
			cursor:pointer;
						}
			            </style><form method='post'><?php

if($owner == "0"){

?>
    <?php
	if ($_POST['Buy']){
if($ranking->id < 9){
echo"You need to be ranked Boss or above to own a casino!";
}elseif ($ranking->id >= 9) {
if($fetch->money < "10000000"){
echo"You dont have enough money, you idiot!";
}elseif($fetch->money > "10000000"){
$n_money = $fetch->money - "10000000";
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
mysqli_query( $connection, "UPDATE roulette SET owner='$username' WHERE location='$fetch->location'");
echo"You successfully bought the Roulette!";
}}}
	?>
<table width='50%' height='50' border='0' align="center" cellpadding='0' cellspacing='0'  class='table1px'>
  <tr>
    <td height='22' class="gradient"><div align='center'>No Owner</div></td>
  </tr>
  <tr>
    <td ><div align='center'>There is no owner to this Roulette! You can buy it for £10,000,000
    <br />    
    <input name='Buy' type='submit' class="custombutton" id="Buy"  value='Buy It!' />
   <br>
    </div>
    </td>
  </tr>
</table>
<p>
  <?php
}else{
?>
</form>
            <form method="POST" action="">
                        
                        <?php if($username == $owner){?>
<center><?php if($mes2){ ?><?php echo"$mes2";?><?php } ?></center>
<table width="39%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
<tr>
<td height="30" class="gradient" colspan="2"><div align="center">Casino Options</div></td>
</tr>
<tr>
<td height="20" colspan="2" ><div align="center"><br><a href='roulette.php'>Refresh Page</a></div><br></td>
</tr><br>
<tr>
<td height="25"  colspan="2"><div align="center">Winnings / losses: <?php echo "&pound;".number_format($profit).""; ?></div><br></td>
</tr>
<tr>
<td width="100%"><div align="center">Transfer To:
<input name="name" type="text" class="textbox" id="name" size="25" maxlength="25" /></div>
<br></label></td>
</tr>
<tr>
<td width="100%"><div align="center">Set New Maxbet: 
<input name="max_bet" type="text" class="textbox" id="max_bet" size="25" maxlength="25" /><br></div>
</label>
</tr>
<tr>
<td height="20" colspan="2" align="center" ><br>
<input name="Transfer" type="submit" class="custombutton" id="Transfer" value="Transfer"  onFocus="if(this.blur)this.blur()"/> - <input name="Update" type="submit" class="custombutton" id="Update" value="Set Maxbet"  onFocus="if(this.blur)this.blur()"/> - <input name="Submit_profit" type="submit" class="custombutton" id="Submit_profit" value="Reset Profit" /> - <input name="drop" type="submit" class="custombutton" id="drop" value="Drop Casino"  onFocus="if(this.blur)this.blur()"/><br></br></td>
</tr>
</table>

<br>
<br>
</fieldset>




<table width="700" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="4"><b>Betlogs</b> - <a href="roulette.php"><img src="images/refresh.png" title="Refresh" border="0" height="20" width="20"></a></td></tr>
<tr>
<td width="25%" class="tableborder" align="center"><u>Username</u></td>
<td width="25%" class="tableborder" align="center"><u>Bet</u></td>
<td width="25%" class="tableborder" align="center"><u>Won</u></td>
<td width="25%" class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $ccc=mysqli_query( $connection, "SELECT * FROM casino_logs WHERE casinoType='Roulette' AND owner='$username' AND location='$fetch->location' ORDER BY id DESC LIMIT 30");
while($ddd=mysqli_fetch_object($ccc)){
echo "<tr>
	  <td class='tableborder' width='25%'><a href='profile.php?viewing=$ddd->username'><b><center>$ddd->username</center></b></a></td>
	  <td class='tableborder' width='25%'><center>&pound;".makecomma($ddd->stake)."</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->outcome</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->date</center></td>
	</tr>"; } ?>
</table>
<?php
exit();
 ?>
<?php }?>
<title>Thug Paradise :: Roulette</title>
 <style type="text/css">.style1{font-size:36px;font-weight:bold;}.text{font-size:10px;color:#FFFF00;font-family:Verdana;font-weight:bold;}</style>
<link rel="stylesheet" href="style.css" type="text/css" />
<center> <b><?php echo"$message";?></b></center><br>
<?php if($message){ ?><table width="25%" border="1" align="center" cellpadding="0" cellspacing="0" class="table1px">
  <tr>
<link rel="stylesheet" href="style.css" type="text/css" />
<style type="text/css">.style1{font-size:36px;font-weight:bold;}.text{font-size:10px;color:#FFFF00;font-family:Verdana;font-weight:bold;}</style>
<center>
<table align="center" width="100" border="2" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
<tr bgcolor="<?php if ($number == "1" || $number == "3" || $number == "5" || $number == "7" || $number == "9" || $number == "12" || $number == "14" || $number == "16" || $number == "18" || $number == "19" || $number == "21" || $number == "23" || $number == "25" || $number == "27" || $number == "30" || $number == "32" || $number == "34" || $number == "36"){ echo"red"; }?><?php if ($number == "2" || $number == "4" || $number == "6" || $number == "8" || $number == "10" || $number == "11" || $number == "13" || $number == "15" || $number == "17" || $number == "20" || $number == "22" || $number == "24" || $number == "26" || $number == "28" || $number == "29" || $number == "31" || $number == "33" || $number == "35"){ echo"black"; }?>">
<td bgcolor="<?php if ($number == "1" || $number == "3" || $number == "5" || $number == "7" || $number == "9" || $number == "12" || $number == "14" || $number == "16" || $number == "18" || $number == "19" || $number == "21" || $number == "23" || $number == "25" || $number == "27" || $number == "30" || $number == "32" || $number == "34" || $number == "36"){ echo"red"; }?><?php if ($number == "2" || $number == "4" || $number == "6" || $number == "8" || $number == "10" || $number == "11" || $number == "13" || $number == "15" || $number == "17" || $number == "20" || $number == "22" || $number == "24" || $number == "26" || $number == "28" || $number == "29" || $number == "31" || $number == "33" || $number == "35"){ echo"black"; }?>"><center>
<span class="style1"><?php echo"$number";?></span>
</td>
</tr>
</table>
  </tr>

<br>
<?php }?>
	<table align="center" width="650" height="276" border="0" cellpadding="3" cellspacing="0" background="../images/roulette2.jpg" class="text">
<tr>
<td width="130" rowspan="12">&nbsp;</td>
<td width="130" height="17"><div align="right">01:
<input type="text" value="<?php if(!$_POST['1']){ echo""; }else{ echo $_POST['1']; } ?>" id="1" class="textbox" size="5" name="1">
</div></td>
<td width="130" height="17"><div align="right">02:
<input type="text" value="<?php if(!$_POST['2']){ echo""; }else{ echo $_POST['2']; } ?>" id="2" class="textbox" size="5" name="2">
</div></td>
<td width="130" height="17"><div align="right">03:
<input type="text" value="<?php if(!$_POST['3']){ echo""; }else{ echo $_POST['3']; } ?>" id="3" class="textbox" size="5" name="3">
      </div></td>
      <td width="130" height="17"><div align="right">04:
<input type="text" value="<?php if(!$_POST['4']){ echo""; }else{ echo $_POST['4']; } ?>" id="4" class="textbox" size="5" name="4">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">05:
<input type="text" value="<?php if(!$_POST['5']){ echo""; }else{ echo $_POST['5']; } ?>" id="5" class="textbox" size="5" name="5">
      </div></td>
      <td width="130" height="17"><div align="right">06:
<input type="text" value="<?php if(!$_POST['6']){ echo""; }else{ echo $_POST['6']; } ?>" id="6" class="textbox" size="5" name="6">
      </div></td>
      <td width="130" height="17"><div align="right">07:
<input type="text" value="<?php if(!$_POST['7']){ echo""; }else{ echo $_POST['7']; } ?>" id="7" class="textbox" size="5" name="7">
      </div></td>
      <td width="130" height="17"><div align="right">08:
<input type="text" value="<?php if(!$_POST['8']){ echo""; }else{ echo $_POST['8']; } ?>" id="8" class="textbox" size="5" name="8">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">09:
<input type="text" value="<?php if(!$_POST['9']){ echo""; }else{ echo $_POST['9']; } ?>" id="9" class="textbox" size="5" name="9">
      </div></td>
      <td width="130" height="17"><div align="right">10:
<input type="text" value="<?php if(!$_POST['10']){ echo""; }else{ echo $_POST['10']; } ?>" id="10" class="textbox" size="5" name="10">
      </div></td>
      <td width="130" height="17"><div align="right">11:
<input type="text" value="<?php if(!$_POST['11']){ echo""; }else{ echo $_POST['11']; } ?>" id="11" class="textbox" size="5" name="11">
      </div></td>
      <td width="130" height="17"><div align="right">12:
<input type="text" value="<?php if(!$_POST['12']){ echo""; }else{ echo $_POST['12']; } ?>" id="12" class="textbox" size="5" name="12">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">13:
<input type="text" value="<?php if(!$_POST['13']){ echo""; }else{ echo $_POST['13']; } ?>" id="13" class="textbox" size="5" name="13">
      </div></td>
      <td width="130" height="17"><div align="right">14:
<input type="text" value="<?php if(!$_POST['14']){ echo""; }else{ echo $_POST['14']; } ?>" id="14" class="textbox" size="5" name="14">
      </div></td>
      <td width="130" height="17"><div align="right">15:
<input type="text" value="<?php if(!$_POST['15']){ echo""; }else{ echo $_POST['15']; } ?>" id="15" class="textbox" size="5" name="15">
      </div></td>
      <td width="130" height="17"><div align="right">16:
<input type="text" value="<?php if(!$_POST['16']){ echo""; }else{ echo $_POST['16']; } ?>" id="16" class="textbox" size="5" name="16">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">17:
<input type="text" value="<?php if(!$_POST['17']){ echo""; }else{ echo $_POST['17']; } ?>" id="17" class="textbox" size="5" name="17">
      </div></td>
      <td width="130" height="17"><div align="right">18:
<input type="text" value="<?php if(!$_POST['18']){ echo""; }else{ echo $_POST['18']; } ?>" id="18" class="textbox" size="5" name="18">
      </div></td>
      <td width="130" height="17"><div align="right">19:
<input type="text" value="<?php if(!$_POST['19']){ echo""; }else{ echo $_POST['19']; } ?>" id="19" class="textbox" size="5" name="19">
      </div></td>
      <td width="130" height="17"><div align="right">20:
<input type="text" value="<?php if(!$_POST['20']){ echo""; }else{ echo $_POST['20']; } ?>" id="20" class="textbox" size="5" name="20">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">21:
<input type="text" value="<?php if(!$_POST['21']){ echo""; }else{ echo $_POST['21']; } ?>" id="21" class="textbox" size="5" name="21">
      </div></td>
      <td width="130" height="17"><div align="right">22:
<input type="text" value="<?php if(!$_POST['22']){ echo""; }else{ echo $_POST['22']; } ?>" id="22" class="textbox" size="5" name="22">
      </div></td>
      <td width="130" height="17"><div align="right">23:
<input type="text" value="<?php if(!$_POST['23']){ echo""; }else{ echo $_POST['23']; } ?>" id="23" class="textbox" size="5" name="23">
      </div></td>
      <td width="130" height="17"><div align="right">24:
<input type="text" value="<?php if(!$_POST['24']){ echo""; }else{ echo $_POST['24']; } ?>" id="24" class="textbox" size="5" name="24">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">25:
<input type="text" value="<?php if(!$_POST['25']){ echo""; }else{ echo $_POST['25']; } ?>" id="25" class="textbox" size="5" name="25">
      </div></td>
      <td width="130" height="17"><div align="right">26:
<input type="text" value="<?php if(!$_POST['26']){ echo""; }else{ echo $_POST['26']; } ?>" id="26" class="textbox" size="5" name="26">
      </div></td>
      <td width="130" height="17"><div align="right">27:
<input type="text" value="<?php if(!$_POST['27']){ echo""; }else{ echo $_POST['27']; } ?>" id="27" class="textbox" size="5" name="27">
      </div></td>
      <td width="130" height="17"><div align="right">28:
<input type="text" value="<?php if(!$_POST['28']){ echo""; }else{ echo $_POST['28']; } ?>" id="28" class="textbox" size="5" name="28">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">29:
<input type="text" value="<?php if(!$_POST['29']){ echo""; }else{ echo $_POST['29']; } ?>" id="29" class="textbox" size="5" name="29">
      </div></td>
      <td width="130" height="17"><div align="right">30:
<input type="text" value="<?php if(!$_POST['30']){ echo""; }else{ echo $_POST['30']; } ?>" id="30" class="textbox" size="5" name="30">
      </div></td>
      <td width="130" height="17"><div align="right">31:
<input type="text" value="<?php if(!$_POST['31']){ echo""; }else{ echo $_POST['31']; } ?>" id="31" class="textbox" size="5" name="31">
      </div></td>
      <td width="130" height="17"><div align="right">32:
<input type="text" value="<?php if(!$_POST['32']){ echo""; }else{ echo $_POST['32']; } ?>" id="32" class="textbox" size="5" name="32">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">33:
<input type="text" value="<?php if(!$_POST['33']){ echo""; }else{ echo $_POST['33']; } ?>" id="33" class="textbox" size="5" name="33">
      </div></td>
      <td width="130" height="17"><div align="right">34:
<input type="text" value="<?php if(!$_POST['34']){ echo""; }else{ echo $_POST['34']; } ?>" id="34" class="textbox" size="5" name="34">
      </div></td>
      <td width="130" height="17"><div align="right">35:
<input type="text" value="<?php if(!$_POST['35']){ echo""; }else{ echo $_POST['35']; } ?>" id="35" class="textbox" size="5" name="35">
      </div></td>
      <td width="130" height="17"><div align="right">36:
<input type="text" value="<?php if(!$_POST['36']){ echo""; }else{ echo $_POST['36']; } ?>" id="36" class="textbox" size="5" name="36">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">Red:
        <input type="text" value="<?php if(!$_POST['47']){ echo""; }else{ echo $_POST['47']; } ?>" id="47" class="textbox" name="47" size="5">      
      </div></td>
      <td width="130" height="17"><div align="right">Black:
<input type="text" value="<?php if(!$_POST['48']){ echo""; }else{ echo $_POST['48']; } ?>" id="48" class="textbox" name="48" size="5">
      </div></td>
      <td width="130" height="17"><div align="right">Odd:
<input type="text" value="<?php if(!$_POST['44']){ echo""; }else{ echo $_POST['44']; } ?>" id="44" class="textbox" name="44" size="5">
      </div></td>
      <td width="130" height="17"><div align="right">Even:
<input type="text" value="<?php if(!$_POST['43']){ echo""; }else{ echo $_POST['43']; } ?>" id="43" class="textbox" name="43" size="5">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">1 - 18 :
<input type="text" value="<?php if(!$_POST['45']){ echo""; }else{ echo $_POST['45']; } ?>" id="45" class="textbox" size="5" name="45">
      </div></td>
      <td width="130" height="17"><div align="right">19 - 36 :
<input type="text" value="<?php if(!$_POST['46']){ echo""; }else{ echo $_POST['46']; } ?>" id="46" class="textbox" size="5" name="46">
      </div></td>
      <td width="130" height="17"><div align="right">1 - 12 :
<input type="text" value="<?php if(!$_POST['40']){ echo""; }else{ echo $_POST['40']; } ?>" id="40" class="textbox" size="5" name="40">
      </div></td>
      <td width="130" height="17"><div align="right">13 - 24 :
<input type="text" value="<?php if(!$_POST['41']){ echo""; }else{ echo $_POST['41']; } ?>" id="41" class="textbox" size="5" name="41">
      </div></td>
    </tr>
    <tr>
      <td width="130" height="17"><div align="right">25 - 36 :
<input type="text" value="<?php if(!$_POST['42']){ echo""; }else{ echo $_POST['42']; } ?>" id="42" class="textbox" size="5" name="42">
      </div></td>
      <td width="130" height="17"><div align="right">1st col :
<input type="text" value="<?php if(!$_POST['37']){ echo""; }else{ echo $_POST['37']; } ?>" id="37" class="textbox" size="5" name="37">
      </div></td>
      <td width="130" height="17"><div align="right">2nd col :
<input type="text" value="<?php if(!$_POST['38']){ echo""; }else{ echo $_POST['38']; } ?>" id="38" class="textbox" size="5" name="38">
      </div></td>
      <td width="130" height="17"><div align="right">3rd col :
<input type="text" value="<?php if(!$_POST['39']){ echo""; }else{ echo $_POST['39']; } ?>" id="39" class="textbox" size="5" name="39">
      </div></td>
    </tr>
    <tr>
      <td height="36" colspan="5"><div align="center">
        <input type="submit" name="Bet" value="Spin!" class="custombutton">&nbsp;
			     <input type="button" OnClick="Reset();" value="Reset Bet" class="custombutton">
      </div></td>
      </tr>
    <tr>
      <td height="36" colspan="5"><div align="center">
        <p>This Roulette table in <?php if($location == "England"){$loc = "London, England";}
      if($location == "Pakistan"){$loc = "Lahore, Pakistan";}
      if($location == "Jamaica"){$loc = "Kingston, Jamaica";}
      if($location == "America"){$loc = "New York, USA";}
      if($location == "Japan"){$loc = "Tokyo, Japan";}
      if($location == "Germany"){$loc = "Berlin, Germany";}
      if($location == "China"){$loc = "Beijing, China";}
         ?><?php echo"$loc";?> is currently owned by <a href='profile.php?viewing=<?php echo"$owner";?>'><?php echo"$owner";?></a><br />
          The Maximum bet currently set by the owner of this table is &pound;<?php echo"".makecomma($rl_max)."";?></p>
        </div></td>
      </tr>
  </table>
			            </form>


<table width="500" border="0" cellpadding="0" align="center" cellspacing="0">
      <tr>
        <td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46" /></div></td>
        <td width="450" class="tableborder"><div align="center">
          <p><strong>Roulette</strong> is a casino and gambling game (<em>Roulette</em> is a French word meaning &quot;small wheel&quot;). A croupier turns a round roulette wheel which has 37 or 38 separately numbered pockets in which a ball must land. The main pockets are numbered from 1 to 36 and alternate  between red and black, with number 1 being red. There is also a green  pocket numbered 0. In most roulette wheels in the United States but not in Europe, there is a second zero compartment marked 00, also colored green.</p>
            <p>If a player bets on a single number and wins, the payout is 35 to 1.  The bet itself is returned, so in total it is multiplied by 36. (In a lottery one would say 'the prize is 36 times the cost of the ticket', because  in a lottery the cost of the ticket is not returned additionally.)</p>
            <p>A player can bet on numbers, combinations, ranges, odds/evens, and colors.</p>
<a href="../casinos.php">Gambling Policy</a> - Including information on chance &amp; fairness.
        </div></td>
      </tr>
    </table>

<?php } ?>
</div>
			
<?php include_once "incfiles/foot.php"; ?>