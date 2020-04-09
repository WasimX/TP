<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$pagin=$_GET['page'];

$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

if (strip_tags($_POST['go'])){

if (100000 > $fetch->money){
echo "Your cannot afford to play high or lower!<br /><br />";
}elseif (100000 <= $fetch->money){

$loose_money = $fetch->money - 100000;
$card1 = rand(1,13);
mysqli_query( $connection, "UPDATE accounts SET money='$loose_money', card='$card1' WHERE username='$username'"); }}


if (strip_tags($_POST['higher'])){
$card1 = rand(1,13);

if ($fetch->card <= $card1){ 
$addonmoney = $fetch->money + 30000;
mysqli_query( $connection, "UPDATE accounts SET money='$addonmoney', card='$card1' WHERE username='$username'"); 
$mess = "Well done, correct guess. Please pick either higher or lower to continue..."; 

}elseif ($fetch->card > $card1){ 
mysqli_query( $connection, "UPDATE accounts SET card='' WHERE username='$username'");
$mess = "Unlucky, the card was lower than $fetch->card."; 
$finish = "1"; }}

if (strip_tags($_POST['lower'])){
$card1 = rand(1,13);

if ($fetch->card >= $card1){ 
$addonmoney = $fetch->money + 30000;
mysqli_query( $connection, "UPDATE accounts SET money='$addonmoney', card='$card1' WHERE username='$username'"); 
$mess = "Well done, correct guess. Please pick either higher or lower to continue..."; 

}elseif ($fetch->card < $card1){ 
mysqli_query( $connection, "UPDATE accounts SET card='' WHERE username='$username'");
$mess = "Unlucky, the card was higher than $fetch->card."; 
$finish = "1"; }}
?>

<html>
<head>
<title>Thug Paradise 2 :: Higher Or Lower</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<?php if ($pagin == "higherlower"){  ?>

<body>
<form action="" method="post" name="form">

<table width="508" height="295" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="506" height="30" class="gradient">Higher Or Lower?</td>
</tr>
<tr><td height="260">
<table width="90%" border="0" align="center">
<tr><td height="133" align="center" class="tableborder">
<?php echo "$mess<br><br>"; ?>
<?php if ($card1 == ""){ ?><img src="images/cards/back.png" border="0" /><?php }else{ ?>
<?php if ($finish == "1"){ ?><img src="images/cards/<?php echo "$card1"; ?>.png" border="0" /><?php }else{ ?>
<img src="images/cards/<?php echo "$card1"; ?>.png" border="0" /><br><br>
<input type="submit" class="custombutton" name="higher" value="Higher" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="custombutton" name="lower" value="Lower" /><?php }} ?></td></tr>

<tr><td align="center" class="tableborder"> 
It costs &pound;100,000 to start a bet. For each correct guess you choose (higher / lower), you will receive &pound;30,000. Therefore you will have to get four correct guesses to make a profit. Please start by clicking "Place Bet" below; this will automatically take off &pound;100,000. You will then have the options to choose "Higher" or "Lower". Do not complain if you lose, play at your own risk!<br>
<b>Warning: By refreshing / exitting the page, you will forfeit the game.</b><br>
Ace is counted as a low card, not high!</td></tr>
<tr><td height="43" align="center" class="tableborder">
<input name="go" class="custombutton" type="submit" id="go" value="Place Bet!"></td></tr>
</table>

</td></tr>
</table>
<?php }else{ ?>Unauthorised.<?php } ?>
</form>

</body> 
</html>
<?php require_once "incfiles/foot.php"; ?>