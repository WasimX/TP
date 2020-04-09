<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";

logincheck();
$username=$_SESSION['username'];


$mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($mysqli);

$mysqli222=mysqli_query( $connection, "SELECT * FROM slots WHERE location='$fetch->location'");
$roulette1=mysqli_fetch_object($mysqli222);
$name = $fetch->username;

echo "$style"; 

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$slots = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM slots WHERE location='$fetch->location'"));
$fetch_owner=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$slots->owner'"));
$date = gmdate('Y-d-m h:i:s');

if ($fetch->casinoban > time()){
die("You cannot gamble for another ".maketime($fetch->casinoban)." because you banned yourself.");
}

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

?>


<script language=JavaScript>
function so(dis)
{
for (i=0;i<dis.elements.length;i++){ 
	if (dis.elements[i].type=='submit')
	   dis.elements[i].style.visibility='hidden';
	}
	if(fs==false){
		 fs=true;
		 return true;
	}else
 		return false;
	}
	function goaway()
{
for(i=0;i<document.forms.length;i++)
 document.forms[i].onsubmit = function() {return so(this);};
}
</script>

<html>
<head>
<title>Slots</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
<body onload=goaway();>

<br>


<form method='post'><?php

if($slots->owner == "0"){

?>
    <?php
	if ($_POST['Buy']){
if($fetch->money < "10000000"){
echo"You dont have enough money, you idiot!";
}elseif($fetch->money > "10000000"){
$n_money = $fetch->money - "10000000";
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
mysqli_query( $connection, "UPDATE slots SET owner='$username' WHERE location='$fetch->location'");
echo"You successfully bought the slots machine in $fetch->location!";
}}
	?>
<table width='50%' height='50' border='0' align="center" cellpadding='0' cellspacing='0'  class='table1px'>
  <tr>
    <td height='30' class="gradient"><div align='center'>No Owner</div></td>
  </tr>
  <tr>
    <td ><div align='center'>There is no owner to this slots! You can buy it for £10,000,000
    <br />    
    <input name='Buy' type='submit' class="custombutton" id="Buy"  value='Buy It!' />
   <br>
    </div>
    </td>
  </tr>
</table>
<p>
  <?php
}elseif($slots->owner != "0"){

				   if (!$_POST['spin']){
				     $tickl = "No";
}elseif (strip_tags($_POST['spin']) && $_POST['bet'] != ""){
$bet=intval(strip_tags($_POST['bet']));

if ($bet == 0 || !$bet || ereg('[^0-9]',$bet)){
 $mess = "You cant bet that amount.";
  $tickl = "No";
}elseif ($bet != 0 || $bet || !ereg('[^0-9]',$bet)){
if ($bet > $slots->maxbet){
$mess = "Your bet exceeds the max bet.";  
 $tickl = "No";
}elseif ($bet <= $slots->maxbet){
if ($bet > $fetch->money){
  $mess = "You dont have that much cash.";
   $tickl = "No";
}elseif ($bet <= $fetch->money){

      $random = rand(0,33);
	  if($random == "0"){$slotone = "Cherry";
}elseif($random == "3"){$slotone = "Cherry";
}elseif($random == "8"){$slotone = "Cherry";
}elseif($random == "12"){$slotone = "Lemon";
}elseif($random == "4"){$slotone = "Lemon";
}elseif($random == "5"){$slotone = "Orange";
}elseif($random == "14"){$slotone = "Orange";
}elseif($random == "7"){$slotone = "Orange";
}elseif($random == "9"){$slotone = "Bell";
}elseif($random == "13"){$slotone = "Bell";
}elseif($random == "11"){$slotone = "Plum";
}elseif($random == "1"){$slotone = "Plum";
}elseif($random == "10"){$slotone = "Bar";
}elseif($random == "6"){$slotone = "Bar";
}elseif($random == "2"){$slotone = "Globe";
}elseif($random == "15"){$slotone = "Lemon";
}elseif($random == "16"){$slotone = "Orange";
}elseif($random == "17"){$slotone = "Cherry";
}elseif($random == "18"){$slotone = "Lemon";
}elseif($random == "19"){$slotone = "Orange";
}elseif($random == "20"){$slotone = "Plum";
}elseif($random == "21"){$slotone = "Bell";
}elseif($random == "22"){$slotone = "Lemon";
}elseif($random == "23"){$slotone = "Lemon";
}elseif($random == "24"){$slotone = "Plum";
}elseif($random == "25"){$slotone = "Lemon";
}elseif($random == "26"){$slotone = "Cherry";
}elseif($random == "27"){$slotone = "Plum";
}elseif($random == "28"){$slotone = "Lemon";
}elseif($random == "29"){$slotone = "Lemon";
}elseif($random == "30"){$slotone = "Cherry";
}elseif($random == "31"){$slotone = "Cherry";
}elseif($random == "32"){$slotone = "Lemon";
}elseif($random == "33"){$slotone = "Cherry";
}
      $random2 = rand(0,33);
	  if($random2 == "0"){$slottwo = "Lemon";
}elseif($random2 == "3"){$slottwo = "Cherry";
}elseif($random2 == "7"){$slottwo = "Cherry";
}elseif($random2 == "12"){$slottwo = "Lemon";
}elseif($random2 == "4"){$slottwo = "Orange";
}elseif($random2 == "5"){$slottwo = "Orange";
}elseif($random2 == "14"){$slottwo = "Orange";
}elseif($random2 == "8"){$slottwo = "Bell";
}elseif($random2 == "9"){$slottwo = "Bell";
}elseif($random2 == "13"){$slottwo = "Plum";
}elseif($random2 == "11"){$slottwo = "Plum";
}elseif($random2 == "1"){$slottwo = "Plum";
}elseif($random2 == "10"){$slottwo = "Bar";
}elseif($random2 == "6"){$slottwo = "Bar";
}elseif($random2 == "2"){$slottwo = "Globe";
}elseif($random2 == "15"){$slottwo = "Lemon";
}elseif($random2 == "16"){$slottwo = "Orange";
}elseif($random2 == "17"){$slottwo = "Lemon";
}elseif($random2 == "18"){$slottwo = "Lemon";
}elseif($random2 == "19"){$slottwo = "Orange";
}elseif($random2 == "20"){$slottwo = "Plum";
}elseif($random2 == "21"){$slottwo = "Bell";
}elseif($random2 == "22"){$slottwo = "Cherry";
}elseif($random2 == "23"){$slottwo = "Lemon";
}elseif($random2 == "24"){$slottwo = "Plum";
}elseif($random2 == "25"){$slottwo = "Cherry";
}elseif($random2 == "26"){$slottwo = "Cherry";
}elseif($random2 == "27"){$slottwo = "Plum";
}elseif($random2 == "28"){$slottwo = "Lemon";
}elseif($random2 == "29"){$slottwo = "Lemon";
}elseif($random2 == "30"){$slottwo = "Cherry";
}elseif($random2 == "31"){$slottwo = "Cherry";
}elseif($random2 == "32"){$slottwo = "Cherry";
}elseif($random2 == "33"){$slottwo = "Lemon";
}
      $random3 = rand(0,33);
	  if($random3 == "0"){$slotthree = "Cherry";
}elseif($random3 == "3"){$slotthree = "Cherry";
}elseif($random3 == "7"){$slotthree = "Cherry";
}elseif($random3 == "12"){$slotthree = "Cherry";
}elseif($random3 == "4"){$slotthree = "Orange";
}elseif($random3 == "5"){$slotthree = "Orange";
}elseif($random3 == "14"){$slotthree = "Orange";
}elseif($random3 == "8"){$slotthree = "Bell";
}elseif($random3 == "9"){$slotthree = "Bell";
}elseif($random3 == "13"){$slotthree = "Plum";
}elseif($random3 == "11"){$slotthree = "Plum";
}elseif($random3 == "1"){$slotthree = "Plum";
}elseif($random3 == "10"){$slotthree = "Bar";
}elseif($random3 == "6"){$slotthree = "Bar";
}elseif($random3 == "2"){$slotthree = "Globe";
}elseif($random3 == "15"){$slotthree = "Lemon";
}elseif($random3 == "16"){$slotthree = "Orange";
}elseif($random3 == "17"){$slotthree = "Lemon";
}elseif($random3 == "18"){$slotthree = "Lemon";
}elseif($random3 == "19"){$slotthree = "Orange";
}elseif($random3 == "20"){$slotthree = "Plum";
}elseif($random3 == "21"){$slotthree = "Bell";
}elseif($random3 == "22"){$slotthree = "Lemon";
}elseif($random3 == "23"){$slotthree = "Lemon";
}elseif($random3 == "24"){$slotthree = "Plum";
}elseif($random3 == "25"){$slotthree = "Cherry";
}elseif($random3 == "26"){$slotthree = "Cherry";
}elseif($random3 == "27"){$slotthree = "Plum";
}elseif($random3 == "28"){$slotthree = "Lemon";
}elseif($random3 == "29"){$slotthree = "Lemon";
}elseif($random3 == "30"){$slotthree = "Cherry";
}elseif($random3 == "31"){$slotthree = "Cherry";
}elseif($random3 == "32"){$slotthree = "Lemon";
}elseif($random3 == "33"){$slotthree = "Lemon";
}
if ($slotone == "Cherry" && $slottwo != "$random2" && $slotthree != "$random3"){
$win = 2;
}elseif ($slotone == "Cherry" && $slottwo == "Cherry" && $slotthree != "$random3"){
$win = 5;
}elseif ($slotone == "Cherry" && $slottwo == "Cherry" && $slotthree != "Cherry"){
$win = 10;
}elseif ($slotone == "Orange" && $slottwo == "Orange" && $slotthree == "Orange"){
$win = 15;
}elseif ($slotone == "Bell" && $slottwo == "Bell" && $slotthree != "Bell"){
$win = 20;
}elseif ($slotone == "Plum" && $slottwo == "Plum" && $slotthree == "Plum"){
$win = 50;
}elseif ($slotone == "Bar" && $slottwo == "Bar" && $slotthree == "Bar"){
$win = 100;
}elseif ($slotone == "Globe" && $slottwo == "Globe" && $slotthree == "Globe"){
$win = 429;
}else{
$win = 0;
}


$new_money = $bet * $win;
if($win == "0"){
$n_money = $fetch->money - $bet;
$owner_money= $fetch_owner->money + $bet;
$winner = "No";
}elseif($win != "0"){
$n_money = $fetch->money + $new_money;
$owner_money= $fetch_owner->money - $new_money;
$winner = "Yes";
}
if ($owner_money <= "0"){ 
$n_money = $fetch->money + $fetch_owner->money;
$owner_money= "0";
$winner = "Yes";
}
					
	$tickl = "Yes";				
	
if ($owner_money <= "0"){ 
 $mess = "  You've won the casino in $fetch->location as $slots->owner went broke!<br>
  You won &pound;".makecomma($fetch_owner->money)." out of the &pound;".makecomma($new_money).".";

mysqli_query( $connection, "UPDATE slots SET owner='$username' WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE accounts SET money='$owner_money' WHERE username='$slots->owner'");
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
}elseif($owner_money > "0"){

if($winner == "Yes"){
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
$ear = $slots->profit - $new_money;
mysqli_query( $connection, "UPDATE slots SET profit='$ear' WHERE location='$fetch->location' AND owner !='0'");
mysqli_query( $connection, "UPDATE accounts SET money='$owner_money' WHERE username='$slots->owner'");
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Slots', '$new_money', '$fetch->location', '$owner', NOW(), 'Win', '$new_money', '')");
$mess = "You won &pound;".makecomma($new_money)."!";

}elseif($winner == "No"){

$ear2 = $slots->profit + $new_money;
mysqli_query( $connection, "UPDATE slots SET profit='$ear2' WHERE location='$fetch->location' AND  owner !='0'");
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Slots', '$bet', '$fetch->location', '$owner', NOW(), 'Lose', '0', '')");
mysqli_query( $connection, "UPDATE accounts SET money='$owner_money' WHERE username='$slots->owner'");
		mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
		$mess = "You lost &pound;".makecomma($bet)."";
}}}}}}
?>
</p>
</form>
<?php
//see if person owns table
if ($slots->owner == $username){
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
			mysqli_query( $connection, "UPDATE slots SET maxbet='$newmax' WHERE owner='$username' AND location='$fetch->location'");
			echo "The maxbet was updated to &pound;".makecomma($newmax).".";
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
			mysqli_query( $connection, "UPDATE slots SET owner='$giveto', maxbet='100' WHERE owner='$username' AND location='$fetch->location'");
			echo "The slots has been given away to $giveto.";
		}
}

if(isset($_POST['drop'])){
if($owner != $name){
$mes2 .="You don't own this slots table.";
}else{
$result = mysqli_query( $connection, "UPDATE slots SET owner='0', maxbet='100000', profit='0' WHERE location='$location'") or die(mysqli_error());
$mes2 .= "You dropped your Slots.";
}}
		
	?>
<form method="post" action="">






<center><?php if($mes2){ ?><?php echo"$mes2";?><?php } ?>This slots CP is still under construction and not finished so all of the options dont exactly work.</center>
<table width="39%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
<tr>
<td height="30" class="gradient" colspan="2"><div align="center">Casino Options</div></td>
</tr>
<tr>
<td height="20" colspan="2" ><div align="center"><br><a href='slots.php'>Refresh Page</a></div><br></td>
</tr><br>
<tr>
<td height="25"  colspan="2"><div align="center">Winnings / losses: <?php echo "&pound;".number_format($profit).""; ?></div><br></td>
</tr>
<tr>
<td width="100%"><div align="center">Transfer To:
<input name="giveto" type="text" class="textbox" id="giveto" size="25" maxlength="25" /></div>
<br></label></td>
</tr>
<tr>
<td width="100%"><div align="center">Set New Maxbet: 
<input name="maxbet" type="text" class="textbox" id="maxbet" size="25" maxlength="25" /><br></div>
</label>
</tr>
<tr>
<td height="20" colspan="2" align="center" ><br>
<input name="Submit" type="submit" class="custombutton" id="Submit" value="Make Changes"  onFocus="if(this.blur)this.blur()"/> - <input name="Submit_profit" type="submit" class="custombutton" id="Submit_profit" value="Reset Profit" /> - <input name="drop" type="submit" class="custombutton" id="drop" value="Drop Casino"  onFocus="if(this.blur)this.blur()"/><br></br></td>
</tr>
</table>

<br>
<br>
</fieldset>




<table width="700" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="4"><b>Betlogs</b> - <a href="slots.php"><img src="images/refresh.png" title="Refresh" border="0" height="20" width="20"></a></td></tr>
<tr>
<td width="25%" class="tableborder" align="center"><u>Username</u></td>
<td width="25%" class="tableborder" align="center"><u>Bet</u></td>
<td width="25%" class="tableborder" align="center"><u>Won</u></td>
<td width="25%" class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $ccc=mysqli_query( $connection, "SELECT * FROM casino_logs WHERE casinoType='Slots' AND owner='$username' AND location='$fetch->location' ORDER BY id DESC LIMIT 30");
while($ddd=mysqli_fetch_object($ccc)){
echo "<tr>
	  <td class='tableborder' width='25%'><a href='profile.php?viewing=$ddd->username'><b><center>$ddd->username</center></b></a></td>
	  <td class='tableborder' width='25%'><center>&pound;".makecomma($ddd->stake)."</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->outcome</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->date</center></td>
	</tr>"; } ?>
</table>
</form>
<?php

	exit();
} ?>
<b><center><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Slots</title>
<link href="../style.css" type="text/css" rel="stylesheet">
<style type="text/css">
<!--
.slots {
	border: 2px solid #666666;
	padding: 5px;
	background-color: #FFFFFF;
}
.style1 {color: #000000}
.style4 {color: #000000; font-size: 10px; font-weight: bold; }
.style8 {
	color: #000000;
	font-size: 10px;
	font-style: italic;
	font-weight: bold;
}
.custombutton {
	font-family: Verdana;
	font-size: 10px;
	font-weight: bold;
	height: 20px;
	width: 92px;
	background-image: url(images/button.jpg);
	color: #990000;
	vertical-align: middle;
	border: 0px solid #000000;
}
.thinline {
	font-family: Verdana;
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	background-color: #000000;
	padding: 5px;	
}
.textb {
	font-family: Verdana;
	font-size: 10px;
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	background-color: #000000;
	background-image: url(../images/login/tablebackground.png);
	background-repeat: no-repeat;
	background-position: center top;
	padding: 5px;	
	
}
-->

</style>
</head>
<body>
<form action="" method=POST>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="500" height="30" class="gradient"><div align="center">Slots</div></td>
    <td width="200" height="30" class="gradient"><div align="center">Payline</div></td>
  </tr>
  <tr>
    <td width="500" height="192" class="table1px"><div align="center" class="tablebackground">
            <b><?php echo"$mess"; echo"<br>$mess2";?></b>                        <br />
            <br />
            <table width="96" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center" class="slots"> <?php if($tickl == "Yes"){   $img1 = "<img src=/images/slots/$slotone.gif>"; }elseif($tickl == "No"){  $img1 = "<img  src=/images/slots/Question.gif>";  }
		echo"$img1"; 
	?> </div></td>
                <td><div align="center" class="slots"> <?php if($tickl == "Yes"){   $img2 = "<img src=/images/slots/$slottwo.gif>"; }elseif($tickl == "No"){  $img2 = "<img  src=/images/slots/Question.gif>";  }
		echo"$img2"; 
	?> </div></td>
                <td><div align="center" class="slots"> <?php if($tickl == "Yes"){   $img3 = "<img src=/images/slots/$slotthree.gif>"; }elseif($tickl == "No"){  $img3 = "<img  src=/images/slots/Question.gif>";  }
		echo"$img3"; 
	?> </div></td>
              </tr>
            </table>
      <br />
      Bet:
      <input type="text" class="textbox" name="bet" value="<?php echo "$_POST[bet]"; ?>">
      <br />
      <br />
      <input type="submit" class="custombutton" name="spin" value="Spin!" >
      <br />
      <br />
      This Slot machine in
      <?php echo"$fetch->location";?> is currently owned by <?php echo"<a href=\"profile.php?viewing=$slots->owner\">$slots->owner</a>";?><br />
The Maximum bet is <b>&pound;<?php echo"".makecomma($slots->maxbet)."";?></b><br />
<br />
<a href="../casinos.php">Gambling Policy</a> - Including information on chance &amp; fairness.</div></td>
    <td width="200" bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="0">

      <tr>
        <td width="120" height="30" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Globe.gif" width="30" height="30" /><img src="images/slots/Globe.gif" width="30" height="30" /><img src="images/slots/Globe.gif" width="30" height="30" /></div></td>
        <td width="120" height="30" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Bar.gif" width="30" height="30" /><img src="images/slots/Bar.gif" width="30" height="30" /><img src="images/slots/Bar.gif" width="30" height="30" /></div></td>
      </tr>
      <tr>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">429X Bet </div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">100X Bet </div></td>
      </tr>
      <tr>
        <td width="120" height="30" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Plum.gif" width="30" height="30" /><img src="images/slots/Plum.gif" width="30" height="30" /><img src="images/slots/Plum.gif" width="30" height="30" /></div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Bell.gif" width="30" height="30" /> <img src="images/slots/Bell.gif" width="30" height="30" /><img src="images/slots/Bell.gif" width="30" height="30" /></div></td>
      </tr>
      <tr>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">50X Bet </div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">20X Bet </div></td>
      </tr>
      <tr>
        <td width="120" height="30" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Orange.gif" width="30" height="30" /><img src="images/slots/Orange.gif" width="30" height="30" /><img src="images/slots/Orange.gif" width="30" height="30" /></div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Cherry.gif" width="30" height="30" /><img src="images/slots/Cherry.gif" width="30" height="30" /><img src="images/slots/Cherry.gif" width="30" height="30" /></div></td>
      </tr>
      <tr>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">15X Bet </div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">10X Bet </div></td>
      </tr>
      <tr>
        <td width="120" height="30" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Cherry.gif" width="30" height="30" /><img src="images/slots/Cherry.gif" width="30" height="30" /><img src="images/slots/Question.gif" width="30" height="30" /></div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style1"><img src="images/slots/Cherry.gif" width="30" height="30" /><img src="images/slots/Question.gif" width="30" height="30" /><img src="images/slots/Question.gif" width="30" height="30" /></div></td>
      </tr>
      <tr>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">5X Bet </div></td>
        <td width="120" bgcolor="#FFFFFF" class="style1"><div align="center" class="style4">2X Bet</div></td>
      </tr>
    </table></td>
  </tr>
</table>
  </form>
</body>
</html><?php }  ?>
<?php  include_once"incfiles/foot.php";?>