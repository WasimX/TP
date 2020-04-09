<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];

$mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($mysqli);

$money = $fetch->money;
$location = $fetch->location;
$name = $fetch->username;

$race=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM race WHERE location='$location'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

$sql = "SELECT owner,maxbet,profit FROM race WHERE location='$fetch->location'";
$query = mysqli_query( $connection, $sql);
$row = mysqli_fetch_object($query);
$owner = htmlspecialchars($row->owner);
$profit = htmlspecialchars($row->profit);
$rt_max = htmlspecialchars($row->maxbet);



if(isset($_POST['Bet'])){
$_POST['horse'] = ereg_replace("[^0-9]",'',$_POST['horse']);
if(empty($_POST['horse'])){ $mes =   "You didn't select a horse."; }else{
if($_POST['horse'] > "11" || $_POST['horse'] < "1"){ $mes =   "You didn't pick a right horse."; }else{ 
$_POST['wager'] = round(ereg_replace("[^0-9]",'',$_POST['wager']));
if(empty($_POST['wager'])){ $mes =   "Empty Wager."; }else{
if($money < $_POST['wager']){ $mes =    "You don't have that much money.";}else{
if($_POST['wager'] > $rt_max){ $mes =    "Its not possible to bet more then the maximum bet."; }else{
$wag = $_POST['wager'];

$horse_1 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 6","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_2 = array("Horse 1","Horse 3","Horse 4","Horse 5","Horse 6","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_3 = array("Horse 2","Horse 1","Horse 4","Horse 5","Horse 6","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_4 = array("Horse 2","Horse 3","Horse 1","Horse 5","Horse 6","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_5 = array("Horse 2","Horse 3","Horse 4","Horse 1","Horse 6","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_6 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 1","Horse 7","Horse 8","Horse 9","Horse 10");
$horse_7 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 6","Horse 1","Horse 8","Horse 9","Horse 10");
$horse_8 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 6","Horse 7","Horse 1","Horse 9","Horse 10");
$horse_9 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 6","Horse 7","Horse 8","Horse 1","Horse 10");
$horse_10 = array("Horse 2","Horse 3","Horse 4","Horse 5","Horse 6","Horse 7","Horse 8","Horse 9","Horse 1");

if($_POST['horse'] == 1){if(rand(1,3) == 2){ $won = true; $winning_horse = "Horse 1"; $payout = $_POST['wager'] * 2;}else{$won = false; $winning_horse = $horse_1[rand(0,8)];}}
if($_POST['horse'] == 2){if(rand(1,4) == 2){ $won = true; $winning_horse = "Horse 2"; $payout = $_POST['wager'] * 3; }else{$won = false; $winning_horse = $horse_2[rand(0,8)];}}
if($_POST['horse'] == 3){if(rand(1,5) == 2){ $won = true; $winning_horse = "Horse 3"; $payout = $_POST['wager'] * 4;}else{$won = false; $winning_horse = $horse_3[rand(0,8)];}}
if($_POST['horse'] == 4){if(rand(1,6) == 2){ $won = true; $winning_horse = "Horse 4"; $payout = $_POST['wager'] * 5;}else{$won = false; $winning_horse = $horse_4[rand(0,8)];}}
if($_POST['horse'] == 5){if(rand(1,7) == 2){ $won = true; $winning_horse = "Horse 5"; $payout = $_POST['wager'] * 6;}else{$won = false; $winning_horse = $horse_5[rand(0,8)];}}
if($_POST['horse'] == 6){if(rand(1,8) == 2){ $won = true; $winning_horse = "Horse 6"; $payout = $_POST['wager'] * 7;}else{$won = false; $winning_horse = $horse_6[rand(0,8)];}}
if($_POST['horse'] == 7){if(rand(1,9) == 2){ $won = true; $winning_horse = "Horse 7"; $payout = $_POST['wager'] * 8;}else{$won = false; $winning_horse = $horse_7[rand(0,8)];}}
if($_POST['horse'] == 8){if(rand(1,10) == 2){ $won = true; $winning_horse = "Horse 8"; $payout = $_POST['wager'] * 9;}else{$won = false; $winning_horse = $horse_8[rand(0,8)];}}
if($_POST['horse'] == 9){if(rand(1,11) == 2){ $won = true; $winning_horse = "Horse 9"; $payout = $_POST['wager'] * 10;}else{$won = false; $winning_horse = $horse_9[rand(0,8)];}}
if($_POST['horse'] == 10){if(rand(1,12) == 2){ $won = true; $winning_horse = "Horse 10"; $payout = $_POST['wager'] * 11;}else{$won = false; $winning_horse = $horse_10[rand(0,8)];}}


$sql = "SELECT * FROM accounts WHERE username='$owner'";
$query = mysqli_query( $connection, $sql) or die(mysqli_error());
$row = mysqli_fetch_object($query);
$owners_money = htmlspecialchars($row->money);

if($won == true){

if(($payout - $_POST['wager']) <= ($owners_money)){
$mes =   "You picked the winning horse and won £".number_format($payout)."";
$new_money = $payout - $_POST['wager'];
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Race Track', '$_POST[wager]', '$fetch->location', '$owner', NOW(), 'Win', '$new_money', '')");
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$new_money WHERE username='$username'") or die(mysqli_error());
$new_profit = ($profit - $payout) + $_POST['wager'];
$result = mysqli_query( $connection, "UPDATE race SET profit='$new_profit' WHERE location='$location'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money-$new_money WHERE username='$owner'") or die(mysqli_error());
}else{
	mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Race Track', '$_POST[wager]', '$fetch->location', '$owner', NOW(), 'Win', '$owners_money', 'Wiped previous owner')");
$result = mysqli_query( $connection, "UPDATE accounts SET money='0' WHERE username='$owner'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$owners_money WHERE username='$username'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE race SET owner='$username', maxbet='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$mes .= "You won all the owners money and now own this Race Track.";
$money = $money + $owners_money;
$owner = $username; }}
if($won == false){
$mes =  "You picked horse ".$_POST['horse']." but $winning_horse won. You lost £".number_format($_POST['wager'])."";
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Race Track', '$_POST[wager]', '$fetch->location', '$owner', NOW(), 'Lose', '', '')");
$result = mysqli_query( $connection, "UPDATE accounts SET money=money-$wag WHERE username='$username'") or die(mysqli_error());
$new_profit = $profit + $_POST['wager'];
$result = mysqli_query( $connection, "UPDATE race SET profit='$new_profit' WHERE location='$location'") or die(mysqli_error());
$result = mysqli_query( $connection, "UPDATE accounts SET money=money+$wag WHERE username='$owner'") or die(mysqli_error());
}
$sql = "SELECT money FROM accounts WHERE username='$username'";
$query = mysqli_query( $connection, $sql) or die(mysqli_error());
$row = mysqli_fetch_object($query);
$money = htmlspecialchars($row->money);
if($money < 0 ){
$sql = "UPDATE accounts SET status='Banned' WHERE username='$username'"; $res = mysqli_query( $connection, $sql);
$mes =   "You have been banned for exploiting the racetrack table.";
}}}}}}}
?><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Thug Paradise 2 :: Race Track</title>
<link href="style.css" rel="stylesheet" type="text/css"> 
</head><body>


<form method='post'><?php

if($owner == "0"){

?>
    <?php
	if ($_POST['Buy']){
if($fetch->money < "10000000"){
echo"You dont have enough money, you idiot!";
}elseif($fetch->money > "10000000"){
$n_money = $fetch->money - "10000000";
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
mysqli_query( $connection, "UPDATE race SET owner='$username' WHERE location='$fetch->location'");
echo"You succsesfully bought the race!";
}}
	?>
    <table width='50%' height='50' border='1' align="center" cellpadding='2' cellspacing='0' class='table1px'>
      <tr>
        <td height='22' class="gradient"><div align='center'>No Owner!</div></td>
      </tr>
      <tr>
        <td height="30" ><div align='center'>
            <p>The RaceTrack casino is currently unowned. However, you can take over the casino for a price of £10,000,000. This will be taken off your account immediately, and the possesion of the casino shall take act straight away. If you are certain that you wish to buy the casino, click the "Buy RaceTrack" button below.<br />
                <br />
            </p>
        </div></td>
      </tr>
      <tr>
        <td height="30" ><div align="center">
            <input name='Buy' type='submit' id="Buy" class="custombutton"  value='Buy RaceTrack!' />
            <br />
            <br />
        </div></td>
      </tr>
    </table>
    <p>
  <?php
}else{
?>
</form>


<?php
//see if person owns table
if ($race->owner == $username){
	if ($_POST['maxbet']){ 
		$newmax = $_POST['maxbet'];
		if ($newmax < 100000){
			echo "The maxbet must be at least £100,000.";
			//in
			exit();
		}elseif ($newmax > 1500000000){
			echo "The maxbet must be lower than £1,500,000,000.";
			//in
			exit();
		}elseif(ereg("[^[:digit:]]", $newmax)){
			echo "Max bet can only contain numbers!";
			//in
			exit();
		}else{
			mysqli_query( $connection, "UPDATE race SET maxbet='$newmax' WHERE owner='$username' AND location='$fetch->location'");
			echo "The maxbet to your race track has been updated to &pound;".makecomma($newmax).".";
		}
	}
	

	if ($_POST['giveto']){
		$giveto = $_POST['giveto'];
		$checkgiveto = mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$giveto'");
		$checkifexist = mysqli_num_rows($checkgiveto);
		if($checkifexist <= 0){
			echo "That user does not exist";
			//in
			exit();
		}else{
		while($giver = mysqli_fetch_row($checkgiveto)){
				$giveto = $giver[0];
			}
			mysqli_query( $connection, "UPDATE race SET owner='$giveto', maxbet='100000' WHERE owner='$username' AND location='$fetch->location'");
			echo "The RaceTrack has been given away to $giveto.";
		}
}
		
	?>
<form method="post" action="">
  <table width=300 border=0 align=center cellpadding="0" cellspacing="0" bordercolor=black class=table1px>
    <tr>
      <td height="22" colspan=4 align="center" class="gradient">Race</td>
    </tr>
    <tr class=text>
      <td  width=130>Profit Made:</td>
      <td  width=148 colspan=3>&pound;<?php echo number_format($profit); ?></td>
    </tr>
    <tr class=text>
      <td >Change Maxbet: </td>
      <td  width=148 colspan=3><input name='maxbet' class="textbox" type='text' id='maxbet'></td>
    </tr>
    <tr class=text>
      <td >Current Maxbet: </td>
      <td  colspan=3>&pound;<?php echo"".makecomma($race->maxbet).""; ?></td>
    </tr>
    <tr class=text>
      <td >Give RaceTrack To: </td>
      <td  colspan=3><input name="giveto" class="textbox" type="text" id="giveto"></td>
    </tr>
    <tr class=text>
      <td  colspan=6 align="center"><input type=submit name=Submit class="custombutton" value=Submit></td>
    </tr>
  </table>
</form>
<?php

	exit();
} ?>

<form id="submit" method="post" name="submit" action="">
<?php if($mes){ ?><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
  <tr>
    <td width="100%" align="center" class='gradient'>The Race</td>
  </tr>
  <tr >
    <td align="center" class="tableborder"><?php echo"$mes"; ?></td>
    </tr>
</table>
<br><?php }?>

		<table border="0" align="center" cellpadding="1" cellspacing="1" class="tablert" style="width: 650px; height: 375px">
			<thead>
				<tr>
					<td height="25" class="gradient" colspan="3">
						The RaceTrack</td>
				</tr>
				<tr>
					<td align="center" valign="bottom" height="32" width="30%">
						Horse 1# (1:2)</td>
					<td valign="bottom" align="center" width="10%">
						<input name="horse" <?php if($_POST['horse'] == 1){echo "checked='checked'"; }?> value="1" id="1" type="radio" /></td>
					<td valign="bottom" align="center" width="60%">
						&nbsp;</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td valign="bottom" align="center" width="30%">
						Horse 10# (1:11)</td>
					<td valign="bottom" align="center" width="10%">
						<input name="horse" value="10" <?php if($_POST['horse'] == 10){echo "checked='checked'"; }?> id="10" type="radio" /></td>
					<td>
						&nbsp;</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;" align="center" width="30%">
						Horse 4# (1:5)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="4" <?php if($_POST['horse'] == 4){echo "checked='checked'"; }?> id="4" type="radio" /></td>
					<td valign="bottom" style="text-align: center;">
						&nbsp;</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 3# (1:4)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="3" <?php if($_POST['horse'] == 3){echo "checked='checked'"; }?> id="3" type="radio" /></td>
					<td valign="bottom" style="text-align: center;">
&nbsp;</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 6# (1:7)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="6" <?php if($_POST['horse'] == 6){echo "checked='checked'"; }?> id="6" type="radio" /></td>
					<td valign="bottom" style="text-align: center;">
												&nbsp;</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 5# (1:6)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="5" <?php if($_POST['horse'] == 5){echo "checked='checked'"; }?> id="5" type="radio" /></td>
					<td valign="bottom" style="text-align: center;">
						&nbsp;</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 7# (1:8)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="7" <?php if($_POST['horse'] == 7){echo "checked='checked'"; }?> id="7" type="radio" /></td>
					<td valign="top" style="text-align: center;">
						Bet Amount:</td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 2# (1:3)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="2" <?php if($_POST['horse'] == 2){echo "checked='checked'"; }?> id="2" type="radio" /></td>
					<td valign="top" style="text-align: center;">
						<input name="wager" id="wager" size="15" class="textbox" value="<?php if(isset($_POST['Bet'])){ echo $_POST['wager']; }else{ echo ""; } ?>" type="text" /></td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse 9# (1:10)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="9" <?php if($_POST['horse'] == 9){echo "checked='checked'"; }?> id="9" type="radio" /></td>
					<td height="25" valign="bottom" style="text-align: center;">
						<input name="Bet" id="Bet" class="custombutton" value="Place Bet!" type="submit" /></td>
				</tr>
				<tr>
					<td valign="bottom" style="text-align: center;">
						Horse #8 (1:9)</td>
					<td valign="bottom" style="text-align: center;">
						<input name="horse" value="8" <?php if($_POST['horse'] == 8){echo "checked='checked'"; }?> id="8" type="radio" /></td>
					<td>
						&nbsp;</td>
				</tr>
				<tr>
					<td>
						&nbsp;</td>
					<td height="2" valign="bottom" style="text-align: center;">
						&nbsp;</td>
					<td>
						&nbsp;</td>
				</tr>
				<tr>
					<td>
						&nbsp;</td>
					<td height="5" valign="bottom" style="text-align: center;">
						&nbsp;</td>
					<td>
						&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="bottom" colspan="3">
						 This Racetrack casino in <?php echo"$fetch->location";?> is currently owned by <?php 
			  if($owner != "0"){echo "<a href='profile.php?viewing=$owner'>$owner</a>"; }else{echo "No Owner.";} ?><br>
 The Maximum bet currently set by the owner of this Racetrack is <?php echo "£".number_format($rt_max).""; ?></td>
				</tr>
				<tr>
					<td valign="bottom" height="5" colspan="3">
						&nbsp;</td>
				</tr>
			</tbody>
		</table></body>
</form>
<?php } ?>
<table width="500" align="center" class="table1px">
<tr>
<td width="50" height="62"><div align="left"><img src="images/questionmark.jpg" width="49" height="46"/></div></td>
<td width="450" valign="middle"><div align="center" class="table1px">
<p>At all official horse races, there is a gambling station, where gamblers can stake money on a horse.</p>
<p> Bet to win means that you stake money on the horse, and if it comes in first place, you, the gambler will receive the money.</p>
<a href="casinos.php">Gambling Policy</a> - Including information on chance &amp; fairness.
</div></td>
</tr>
</table>
</body>