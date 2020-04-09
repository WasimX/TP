<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
include_once "incfiles/jailcheck.php";
logincheck();
$username=$_SESSION['username'];

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

$above = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch = mysqli_fetch_object($above);

$fetch2 = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$date = gmdate('Y-m-d H:i:s');

$query3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='$fetch->location'"));


$tax = $query3->tax + 3;
$tax2 = $query3->tax;

$receiver = mysqli_query( $connection, "SELECT * FROM `deal` WHERE `receiver`='$username'");
$receiver = mysqli_fetch_object($receiver);

$starter = mysqli_query( $connection, "SELECT * FROM `deal` WHERE `starter`='$username'");
$starter = mysqli_fetch_object($starter);

	 $starterswap = $starter->starterswap;
	 $startertype = $starter->startertype;
	 $starterswap2 = $starter->receiverswap;
	 $startertype2 = $starter->receivertype;
     
	 $receiverswap = $receiver->starterswap;
	 $receivertype = $receiver->startertype;
	 $receiverswap2 = $receiver->receiverswap;
	 $receivertype2 = $receiver->receivertype;
	 
?>

<?php if($fetch->rank=='Chav' || $fetch->rank=='Pickpocket'){
die("You need to be ranked <b>Vandal</b> or above to use the deal page.");
}

if($fetch->safehouse != "0"){
die("Where do you think your going? You're meant to be in the safehouse!");
}

if($fetch->userlevel == "1"){
die("Sorry, Moderators are not allowed to deal! If you need to send somthing via this page, please contact an Administrator.");
}

if($fetch->username == "Frisk Alive"){
die("A payment is needed before you can deal.");
}
?>

<?php ///Starting The Deal - Use $starter///
	 
if (strip_tags($_POST['radiobutton']) && strip_tags($_POST['startdeal'])){
$receiver=strip_tags($_POST['receiver']);
$radio=intval(strip_tags($_POST['radiobutton']));
$password=addslashes(strip_tags($_POST['security_password']));
$money=addslashes(intval(strip_tags($_POST['money'])));
$credits=addslashes(intval(strip_tags($_POST['credits'])));
$bulletstype=intval(strip_tags($_POST['bulletstype']));
$bullets=addslashes(intval(strip_tags($_POST['bullets'])));


$sql=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' AND password='$password' LIMIT 1");
$login_check=mysqli_num_rows($sql);

$checkreceiver=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$receiver' AND deal='0' AND status != 'Dead' LIMIT 1");
$check=mysqli_num_rows($checkreceiver);

	   $query="SELECT * FROM accounts WHERE '$username' LIKE '%$receiver%'";
		$result=mysqli_query( $connection, $query);
		$total=mysqli_num_rows($result);

if ($check == "0"){
echo"The user you wish to send the deal to is currently in a deal, or isn't alive.";
}elseif ($check != "0"){

if ($login_check == "0"){
echo"The password you entered does not match your current one.";
}elseif ($login_check != "0"){

if ($total > "1"){
echo"You can't deal with yourself.";
}elseif ($total <= "1"){ 

if ($radio == "" || $radio == "0"){
echo"You must select a radiobutton."; 
}elseif ($radio != ""){ 
 
if($radio == "1"){
$checkmoney=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchmoney=mysqli_fetch_object($checkmoney); 
if ($money < '100'){ echo "You have to send at least &pound;100 or more!"; 
}elseif($money >= '100'){
if ($money > '10000000000'){ echo "You must send less than £10,000,000,000."; 
}elseif($money <= '10000000000'){
$ttac = ($money / 100) * $tax2;
$tacc = $money + $ttac;
if ($fetchmoney->money < $tacc){ echo "You have not got that much money - you need &pound".makecoma($tacc)."."; 
}elseif($fetchmoney->money >= $tacc){
mysqli_query( $connection, "UPDATE accounts SET deal='4' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `deal` ( `id` , `starter` , `receiver` , `starterswap` , `receiverswap` , `startertype` , `receivertype` )
VALUES ('', '$username', '$receiver', '$money', '', 'money', '')");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> would like to know if you want to deal with him. He is offering &pound;".makecomma($money).".<br>";
echo"The deal for <b>&pound;".makecomma($money)."</b> was successfully sent to <a href=\"profile.php?viewing=$receiver\">$receiver</a>.";
}}}}

elseif($radio == "2"){
$checkcredits=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchcredits=mysqli_fetch_object($checkcredits); 
if ($credits < 0){ echo "You cannot send $credits credits! It is not a valid amount."; 
}elseif($credits > 0){
if ($credits > '2000000'){ echo "You must send less than 2,000,000 credits."; 
}elseif($credits <= '2000000'){
if ($fetchcredits->credits < $credits){ echo "You have not got that many credits to send during your deal."; 
}elseif($fetchcredits->credits >= $credits){
mysqli_query( $connection, "UPDATE accounts SET deal='4' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `deal` ( `id` , `starter` , `receiver` , `starterswap` , `receiverswap` , `startertype` , `receivertype` )
VALUES ('', '$username', '$receiver', '$credits', '', 'credits', '')");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> would like to know if you want to deal with him. He is offering $credits credits.<br>";
echo"The deal for <b>$credits</b> credits was successfully sent to <a href=\"profile.php?viewing=$receiver\">$receiver</a>.";
}}}}

elseif($radio == "3"){
if ($bullets < 0){ echo "You cannot send $bullets bullets! It is not a valid amount."; 
}elseif($bullets > 0){
if ($bullets > '500000000'){ echo "You must send less than 500,000,000 bullets per deal."; 
}elseif($bullets <= '500000000'){

if ($bulletstype == "fmj"){ 
$checkfmj=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchfmj=mysqli_fetch_object($checkfmj); 
if ($fetchfmj->fmj < $bullets){ echo "You have not got ".makecomma($bullets)." FMJ on your account."; 
}elseif($fetchfmj->fmj >= $bullets){
mysqli_query( $connection, "UPDATE accounts SET deal='4' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `deal` ( `id` , `starter` , `receiver` , `starterswap` , `receiverswap` , `startertype` , `receivertype` )
VALUES ('', '$username', '$receiver', '$bullets', '', 'FMJ', '')");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> would like to know if you want to deal with him. He is offering ".makecomma($bullets)." FMJ<br>";
echo"The deal for <b>".makecomma($bullets)."</b> FMJ was successfully sent to <a href=\"profile.php?viewing=$receiver\">$receiver</a>.";

}}elseif ($bulletstype == "jhp"){ 
$checkjhp=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchjhp=mysqli_fetch_object($checkjhp); 
if ($fetchjhp->jhp < $bullets){ echo "You have not got ".makecomma($bullets)." JHP on your account."; 
}elseif($fetchjhp->jhp >= $bullets){
mysqli_query( $connection, "UPDATE accounts SET deal='4' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `deal` ( `id` , `starter` , `receiver` , `starterswap` , `receiverswap` , `startertype` , `receivertype` )
VALUES ('', '$username', '$receiver', '$bullets', '', 'JHP', '')");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> would like to know if you want to deal with him. He is offering ".makecomma($bullets)." JHP.<br>";
echo"The deal for <b>".makecomma($bullets)."</b> JHP was successfully sent to <a href=\"profile.php?viewing=$receiver\">$receiver</a>.";
}} 
}}} 
 
if ($text != "") {

$text2 = "Would you like to <a href=\'inbox.php?deal=$username\'>Accept</a> the deal, or <a href=\'inbox.php?deald=$username\'>Decline</a> the deal?</center>";
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$receiver', '$username', '$text $text2', '<b>Deal Request</b>', '$date', '0');") or die (mysqli_error()); }}}}}}
?>  


<?php ///Returning The Deal, Use $receiver - Starter owes there swap.///
   
if (strip_tags($_POST['radiobuttonreturn']) && strip_tags($_POST['returndeal'])){
$radioreturn=intval(strip_tags($_POST['radiobuttonreturn']));
$money=addslashes(intval(strip_tags($_POST['moneyreturn'])));
$credits=addslashes(intval(strip_tags($_POST['creditsreturn']))); 
$bulletstype=intval(strip_tags($_POST['bulletstypereturn']));
$bullets=addslashes(intval(strip_tags($_POST['bulletsreturn'])));
$security_password = addslashes(strip_tags($_POST['security_passwordreturn']));

$sql=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' AND password='$security_password' LIMIT 1");
$login_check=mysqli_num_rows($sql);

if ($login_check1 == "0"){
echo"You have entered an incorrect password. It does not match your account details.";
}elseif ($login_check1 != "0"){

if($radioreturn == "1"){
$checkmoney=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchmoney=mysqli_fetch_object($checkmoney); 
if ($money < 100){ echo "The minimum amount you can return is &pound;100."; 
}elseif($money >= 100){
if ($fetchmoney->money < $money){ echo "You have not got that much money on your account."; 
}elseif($fetchmoney->money >= $money){
mysqli_query( $connection, "UPDATE accounts SET deal='2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='5' WHERE username='$receiver->starter'");
mysqli_query( $connection, "UPDATE deal SET receiverswap='$money', receivertype='money' WHERE receiver='$username'");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> has successfully returned his bid to you. He is now offering &pound;".makecomma($money)."<br>";
echo"You have returned <b>&pound;".makecomma($money)."</b> back to <a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>.";
}}}

elseif($radioreturn == "2"){
$checkcredits=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchcredits=mysqli_fetch_object($checkcredits); 
if ($credits < 0){ echo "That is an invalid amount of credits. They were not sent."; 
}elseif($credits > 0){
if ($fetchcredits->credits < $credits){ echo "You have not got that many credits on your account.";  
}elseif($fetchcredits->credits >= $credits){
mysqli_query( $connection, "UPDATE accounts SET deal='2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='5' WHERE username='$receiver->starter'");
mysqli_query( $connection, "UPDATE accounts SET receiverswap='$credits', receivertype='credits' WHERE receiver='$username'");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> has successfully returned his bid to you. He is now offering $credits credits.<br>";
echo"You have returned <b>$credits</b> credits back to <a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>.";
}}}

elseif($radioreturn == "3"){
if ($bulletstype == "fmj"){ 
$checkfmj=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchfmj=mysqli_fetch_object($checkfmj); 
if ($bullets < 0){ echo "That is an invalid amount of FMJ bullets. They were not sent."; 
}elseif($bullets > 0){
if ($fetchfmj->fmj < $bullets){ echo "You have not got ".makecomma($bullets)." FMJ on your account."; 
}elseif($fetchfmj->fmj >= $bullets){
mysqli_query( $connection, "UPDATE accounts SET deal='2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='5' WHERE username='$receiver->starter'");
mysqli_query( $connection, "UPDATE deal SET receiverswap='$bullets', receivertype='FMJ' WHERE receiver='$username'");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> has successfully returned his bid to you. He is now offering ".makecomma($bullets)." FMJ.<br>";
echo"You have returned <b>".makecomma($bullets)."</b> FMJ back to <a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>.";
}}}

elseif ($bulletstype == "jhp"){ 
$checkjhp=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetchjhp=mysqli_fetch_object($checkjhp); 
if ($bullets < 0){ echo "That is an invalid amount of JHP bullets. They were not sent."; 
}elseif($bullets > 0){
if ($fetchjhp->jhp < $bullets){ echo "You have not got ".makecomma($bullets)." JHP on your account."; 
}elseif($fetchjhp->jhp >= $bullets){
mysqli_query( $connection, "UPDATE accounts SET deal='2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='5' WHERE username='$receiver->starter'");
mysqli_query( $connection, "UPDATE deal SET receiverswap='$bullets', receivertype='JHP' WHERE receiver='$username'");
$text = "<center><a href=\"profile.php?viewing=$username\">$username</a> has successfully returned his bid to you. He is now offering ".makecomma($bullets)." JHP.<br>";
echo"You have returned <b>".makecomma($bullets)."</b> JHP back to <a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>.";
}}}}

$text2 = "Please go to the Deal Page to finish or decline the deal.</center>";
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$receiver->starter', '$username', '$text $text2', '<b>Deal Returned</b>', '$date', '0');") or die (mysqli_error());
}}
?>
        <?php ///Returning deal - User cancelled - Use $receiver///
if (strip_tags($_POST['canceldeal'])){
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$receiver->starter'");
mysqli_query( $connection, "DELETE FROM `deal` WHERE `receiver`='$username'");
echo"You have successfully left the deal and it has been cancelled.";
}
?>

<?php ///Starter received the return deal, but cancelled - Use $starter///
if (strip_tags($_POST['cancelthedeal'])){
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$starter->receiver'");
mysqli_query( $connection, "DELETE FROM `deal` WHERE `starter`='$username'");
echo"You successfully left the deal, your dealing partner has been informed.";
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$starter->receiver', '$username', 'Sorry to inform you, but <a href=\"profile.php?viewing=$username\">$username</a> has cancelled the deal.', '<b>Deal Cancelled</b>', '$date', '0');") or die (mysqli_error());
}
?>

<?php ///Receiver waiting for Starter to finish the deal, but cancelled - Use $receiver///
if (strip_tags($_POST['cancellingdeal'])){
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$receiver->starter'");
mysqli_query( $connection, "DELETE FROM `deal` WHERE `receiver`='$username'");
echo"You successfully left the deal, your dealing partner has been informed.";
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$receiver->starter', '$username', 'Sorry to inform you, but <a href=\"profile.php?viewing=$username\">$username</a> has cancelled the deal.', '<b>Deal Cancelled</b>', '$date', '0');") or die (mysqli_error());
} ?>

<?php ///Starter cancelling the deal on the finish deal page - Use $starter///
if (strip_tags($_POST['cancellingthedeal'])){
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$starter->receiver'");
mysqli_query( $connection, "DELETE FROM `deal` WHERE `starter`='$username'");
echo"You successfully left the deal, your dealing partner has been informed.";
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$starter->receiver', '$username', 'Sorry to inform you, but <a href=\"profile.php?viewing=$username\">$username</a> has cancelled the deal.', '<b>Deal Cancelled</b>', '$date', '0');") or die (mysqli_error());
} ?>

<?php ////Starter finishing the deal - Use $starter///
if (strip_tags($_POST['finishdeal'])){
$fetchreceiver=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$starter->receiver'"));
$fetchstarter=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$starters = mysqli_query( $connection, "SELECT * FROM `deal` WHERE `starter`='$username'"); 
$starter = mysqli_fetch_object($starters);

	   if ($starter->startertype == "money"){ $fetching2 = "$fetchreceiver->money"; $fetching11 = "$fetchstarter->money"; }
	   if ($starter->startertype == "credits"){ $fetching2 = "$fetchreceiver->credits"; $fetching11 = "$fetchstarter->credits"; }
	   if ($starter->startertype == "FMJ"){ $fetching2 = "$fetchreceiver->fmj"; $fetching11 = "$fetchstarter->fmj"; }
	   if ($starter->startertype == "JHP"){ $fetching2 = "$fetchreceiver->jhp"; $fetching11 = "$fetchstarter->jhp"; }
	   if ($starter->receivertype == "money"){ $fetching = "$fetchstarter->money"; $fetching22 = "$fetchreceiver->money";}
	   if ($starter->receivertype == "credits"){ $fetching = "$fetchstarter->credits"; $fetching22 = "$fetchreceiver->credits"; }
	   if ($starter->receivertype == "FMJ"){ $fetching = "$fetchstarter->fmj"; $fetching22 = "$fetchreceiver->fmj"; }
	   if ($starter->receivertype == "JHP"){ $fetching = "$fetchstarter->jhp"; $fetching22 = "$fetchreceiver->jhp"; }

if ($fetching11 < $starter->starterswap) {
echo "You do not have enough $starter->startertype to finish the deal. Please cancel it.
 <a href=\"deal.php\">Go Back</a>";
exit(); }
elseif ($fetching11 >= $starter->starterswap) {
if ($fetching22 < $starter->receiverswap) {
echo "$starter->receiver does not have enough $starter->receivertype to finish the deal. Please cancel it.
 <a href=\"deal.php\">Go Back</a>";
exit(); }
elseif ($fetching22 >= $starter->receiverswap) { 
  

mysqli_query( $connection, "UPDATE accounts SET $starter->receivertype=$starter->receivertype-$starter->receiverswap, $starter->startertype=$starter->startertype+$starter->starterswap WHERE username='$starter->receiver'");
mysqli_query( $connection, "UPDATE accounts SET $starter->receivertype=$starter->receivertype+$starter->receiverswap, $starter->startertype=$starter->startertype-$starter->starterswap WHERE username='$username'");		  
 
mysqli_query( $connection, "INSERT INTO `deal_t` ( `id` , `starter` , `receiver` , `starterswap` , `receiverswap` , `startertype` , `receivertype` , `date` )VALUES ('', '$username', '$starter->receiver', '$starter->starterswap', '$starter->receiverswap', '$starter->startertype', '$starter->receivertype', '$date')"); 

	   if ($starter->startertype == "money"){ $startersign = "&pound;"; $startertype = ""; }
	   if ($starter->startertype == "credits"){ $startersign = ""; $startertype = "Credits"; }
	   if ($starter->startertype == "FMJ"){ $startersign = ""; $startertype = "FMJ"; }
	   if ($starter->startertype == "JHP"){ $startersign = ""; $startertype = "JHP"; }
	   if ($starter->receivertype == "money"){ $receiversign = "&pound;"; $receivertype = ""; }
	   if ($starter->receivertype == "credits"){ $receiversign = ""; $receivertype = "Credits"; }
	   if ($starter->receivertype == "FMJ"){ $receiversign = ""; $receivertype = "FMJ"; } 
	   if ($starter->receivertype == "JHP"){ $receiversign = ""; $receivertype = "JHP"; }  

$text1 = "<center>The deal with <a href\"profile.php?viewing=$starter->receiver\">$starter->receiver</a> has been completed.<br><br> During the deal, you received $receiversign".makecomma($starter->receiverswap)." $receivertype in return of $startersign".makecomma($starter->starterswap)." $startertype</center>";

$text2 = "<center>The deal with <a href\"profile.php?viewing=$username\">$username</a> has been completed.<br><br> During the deal, you received $startersign".makecomma($starter->starterswap)." $startertype in return of $receiversign".makecomma($starter->receiverswap)." $receivertype</center>";
	 
	 $sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username', '$username', '$text1', 'Finished Deal', '$date', '0');") or die (mysqli_error());
	 $sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$starter->receiver', '$username', '$text2', 'Finished Deal', '$date', '0');") or die (mysqli_error());

echo"The deal has been completed. Check your inbox for the details of the deal."; 
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'"); 
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$starter->receiver'");
mysqli_query( $connection, "DELETE FROM `deal` WHERE `starter`='$username'");
}}}

	 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thug Paradise :: Deal</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" language="javascript" src="stopSteal.js"></script>
<body>
<?php if ($fetch->deal == "0"){ ?>
<form id="form1" name="form1" method="post" action="">
<div align="center">

   
  <table width="60%" border="0">
    <tr>
      <td width="40%" valign="top">
	  
  <table width="322" height="156" border="0" cellpadding="2" cellspacing="0"  class="table1px" align="center">
    <tr>
      <td height="22" colspan="2"  class="gradient"><center>
         <b>The Dealing Page</b>
      </center></td>
    </tr>
    <tr>
        <td width="306" align="center">Amount Of Money:<span class="tableborder"><b>
          <input name="money" class="textbox" type="text" id="money" size="12" />
        </b></span></td>
      <td width="20" class="tableborder"><input type="radio" name="radiobutton" value="1"/></td>
    </tr>
    <tr>
	      <td align="center">Amount Of Credits:<span class="tableborder"><b>
	        <input name="credits" class="textbox" type="text" id="credits" size="12" />
	      </b></span></td> 
      <td class="tableborder"><input type="radio" name="radiobutton" value="2"/></td>
    </tr>
    <tr>
	<td align="center" colspan="2">Bullets coming soon.</td>
    </tr>
    <tr>
      <td colspan="2" class="tableborder"><center>
	  <br />
        <b>Please fill in the details below for security.</b>    
      </center>  </td>
    </tr>
    <tr>
      <td colspan="2" align="right" class="tableborder">Dealing With:
        <input name="receiver" class="textbox" type="text" id="receiver" size="15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2" align="right" class="tableborder">Your Password:
        <input name="security_password" class="textbox" type="password" id="security_password" size="15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
        <tr>
      <td colspan="3" class="table1px"><center>
        <br />
          <input name="startdeal" type="submit" class="custombutton" id="startdeal" value="Start Dealing" />

      </center>  </td>
    </tr>
  </table>  </td>
      <td width="29%"> <table width="250" height="48" border="0" cellpadding="2" cellspacing="0" class="table1px" align="left">
    <tr>
      <td height="22" class="gradient" colspan="2"><center>
          <b>Your Details</b>
      </center></td>
    </tr>
    <tr>
      <td width="137" align="right"><div align="right"><b>Money:</b></div></td>
	  <td width="195"><?php echo "&pound;".makecomma($fetch->money).""; ?></td>
	</tr>
	<tr>
      <td width="137" align="right"><div align="right"><b>Credits:</b></div></td>
	  <td width="195"><?php echo "$fetch->credits"; ?></td>
	</tr>
	<tr>
      <td width="137" align="right"><div align="right"><b>FMJ Bullets:</b></div></td>
	  <td width="195"><?php echo "".makecomma($fetch->fmj).""; ?></td>
	</tr>
	<tr>
	  <td width="137" align="right"><div align="right"><strong>JHP Bullets: </strong></div></td>
	  <td><?php echo "".makecomma($fetch->jhp).""; ?></td>
	  </tr>
	
	</tr>

  </table></td>
    </tr>
</table>
</div>
</form>  

<?php }elseif ($fetch->deal == "3"){ ?>


<form id="form1" name="form1" method="post" action="">
<div align="center">
  <table width="60%" border="0">
    <tr>
      <td width="40%" valign="top">
	 
  <table width="322" height="156" border="0" cellpadding="2" cellspacing="0" bgcolor="black"  class="table1px" align="center">
    <tr> 
      <td height="22" colspan="2"  class="gradient"><center>
         <b>The Dealing Page</b>
      </center></td>
    </tr>
<tr>
<td height="21" colspan="2" class="table1px">
	<?php if ($receiver->startertype == "money"){ $startersign = "&pound;"; $startertype = ""; }
	   if ($receiver->startertype == "credits"){ $startersign = ""; $startertype = "Credits"; }
	   if ($receiver->startertype == "FMJ"){ $startersign = ""; $startertype = "FMJ"; }
	   if ($receiver->startertype == "JHP"){ $startersign = ""; $startertype = "JHP"; } ?>
<center><b>You have a deal with <?php echo "<a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>"; ?>. They offered 
<?php echo "$startersign$receiver->starterswap $startertype"; ?> </b></center></td>
      </tr> 
    <tr>
        <td align="center">Amount Of Money:<span class="table1px"><b>
          <input name="moneyreturn" class="textbox" type="text" id="moneyreturn" size="12" />
        </b></span></td>
      <td width="34"><input type="radio" name="radiobuttonreturn" value="1"/></td>
    </tr> 
    <tr>
	      <td align="center">Amount Of Credits:<span class="tableborder"><b>
	        <input name="creditsreturn" class="textbox" type="text" id="creditsreturn" size="12" />
	      </b></span></td>
      <td class="tableborder"><input type="radio" name="radiobuttonreturn" value="2"/></td>
    </tr>
    <tr>
      <td colspan="2" class="table1px"><center>
	  <br />
        <b>Please fill your password below for security.</b>    
      </center>  </td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="table1px">Your Password:
        <input name="security_passwordreturn" class="textbox" type="password" id="security_passwordreturn" size="15" /></td>
      </tr>
        <tr>
      <td colspan="3" class="tableborder"><center>
        <br />
          <input name="returndeal" type="submit" class="custombutton" id="returndeal" value="Return The Deal" /> &nbsp; &nbsp; &nbsp;
		  <input name="canceldeal" type="submit" class="custombutton" id="canceldeal" value="Cancel Dealing" />

      </center>  </td>
    </tr>
  </table>  </td>
      <td width="29%"><table width="250" height="48" border="0" cellpadding="2" cellspacing="0" bgcolor="black"  class="table1px" align="left">
        <tr>
          <td height="22" class="gradient" colspan="2"><center>
              <b>Your Details</b>
          </center></td>
        </tr>
        <tr>
          <td width="137" align="right"><div align="right"><b>Money:</b></div></td>
          <td width="195"><?php echo "&pound;".makecomma($fetch->money).""; ?></td>
        </tr>
        <tr>
          <td width="137" align="right"><div align="right"><b>Credits:</b></div></td>
          <td width="195"><?php echo "$fetch->credits"; ?></td>
        </tr>
        <tr>
          <td width="137" align="right"><div align="right"><b>FMJ Bullets:</b></div></td>
          <td width="195"><?php echo "".makecomma($fetch2->FMJ).""; ?></td>
        </tr>
        <tr>
          <td width="137" align="right"><div align="right"><strong>RNL Bullets: </strong></div></td>
          <td><?php echo "".makecomma($fetch2->RNL).""; ?></td>
        </tr>
        <tr>
          <td width="137" align="right"><div align="right"><b>JSP Bullets:</b></div></td>
          <td width="195"><?php echo "".makecomma($fetch2->JSP).""; ?></td>
        </tr>
      </table></td>
    </tr>
</table>
</div> 
</form> 

<?php }elseif($fetch->deal == "4"){ ?>
</p><center><form id="form2" name="form1" method="post" action="">
<table width="514" height="48" border="0" cellpadding="2" cellspacing="0" bgcolor="black"  class="table1px">
  <tr>
    <td width="500" height="22" class="gradient"><center>
      <b>The Dealing Page</b>
    </center></td>
  </tr>
  <tr>
    <td height="21"><center>
	<?php if ($starter->startertype == "money"){ $startersign = "&pound;"; $startertype = ""; }
	   if ($starter->startertype == "credits"){ $startersign = ""; $startertype = "Credits"; }
	   if ($starter->startertype == "FMJ"){ $startersign = ""; $startertype = "FMJ"; }
	   if ($starter->startertype == "JHP"){ $startersign = ""; $startertype = "JHP"; } ?>
You currently have a deal going on with <?php echo"<a href=\"profile.php?viewing=$starter->receiver\">$starter->receiver</a>"; ?>
<br /><br />
You offered <b><?php echo"$startersign".makecomma($starter->starterswap).""; ?></b> <?php echo"$startertype"; ?><br /><br />
      <input name="cancelthedeal" type="submit" class="custombutton" id="start4" value="Cancel The Deal" />
        <br />
      </p>
    </center></td>
  </tr>
</table></form></center>

<?php }elseif($fetch->deal == "2"){ ?>
<center><form id="form2" name="form1" method="post" action="">
<table width="514"  border="0" cellpadding="2" cellspacing="0" bgcolor="black"  class="table1px">
  <tr>
    <td width="500" height="22" class="gradient"><center>
      <b>The Dealing Page</b>
    </center></td>
  </tr>
  <tr>
    <td height="21"><center> 
      <p>
	  	<?php if ($receiver->startertype == "money"){ $startersign = "&pound;"; $startertype = ""; }
	   if ($receiver->startertype == "credits"){ $startersign = ""; $startertype = "Credits"; }
	   if ($receiver->startertype == "FMJ"){ $startersign = ""; $startertype = "FMJ"; }
	   if ($receiver->startertype == "JHP"){ $startersign = ""; $startertype = "JHP"; }
	   if ($receiver->receivertype == "money"){ $receiversign = "&pound;"; $receivertype = ""; }
	   if ($receiver->receivertype == "credits"){ $receiversign = ""; $receivertype = "Credits"; }
	   if ($receiver->receivertype == "FMJ"){ $receiversign = ""; $receivertype = "FMJ"; }
	   if ($receiver->receivertype == "JHP"){ $receiversign = ""; $receivertype = "JHP"; } ?>

You currently have a deal going on with <b><?php echo"<a href=\"profile.php?viewing=$receiver->starter\">$receiver->starter</a>"; ?></b>.<br /><br />
You have offered them <b><?php echo"$receiversign".makecomma($receiver->receiverswap).""; ?></b> <?php echo"$receivertype"; ?> in return for his offer of <b><?php echo"$startersign".makecomma($receiver->starterswap).""; ?> <?php echo"$startertype"; ?></b><br />
        <br /><input name="cancellingdeal" type="submit" class="custombutton" id="cancellingdeal" value="Cancel The Deal" />
        <br />
      </p>
    </center></td>
  </tr>
</table>
</form></center>
  <?php }elseif($fetch->deal == "5"){ ?>
</p><center><form id="form2" name="form1" method="post" action="">
<table width="514" height="48" border="0" cellpadding="2" cellspacing="0" bgcolor="black"  class=table1px>
  <tr>
    <td width="500" height="22" class="gradient"><center>
     <b> The Dealing Page</b>
    </center></td>
  </tr>
  <tr>
    <td height="21"><center>
	  <p>
	    <?php if ($starter->startertype == "money"){ $startersign = "&pound;"; $startertype = ""; }
	   if ($starter->startertype == "credits"){ $startersign = ""; $startertype = "Credits"; }
	   if ($starter->startertype == "FMJ"){ $startersign = ""; $startertype = "FMJ"; }
	   if ($starter->startertype == "JHP"){ $startersign = ""; $startertype = "JHP"; }
	   if ($starter->receivertype == "money"){ $receiversign = "&pound;"; $receivertype = ""; }
	   if ($starter->receivertype == "credits"){ $receiversign = ""; $receivertype = "Credits"; }
	   if ($starter->receivertype == "FMJ"){ $receiversign = ""; $receivertype = "FMJ"; }
	   if ($starter->receivertype == "JHP"){ $receiversign = ""; $receivertype = "JHP"; } ?>
	    
	    You currently have a deal going on with <?php echo"<a href=\"profile.php?viewing=$starter->receiver\">$starter->receiver</a>"; ?>.
  <br />
  <br />
	    You offered them <b><?php echo"$startersign".makecomma($starter->starterswap).""; ?></b> <?php echo"$startertype"; ?><br />
	    He will give you <b><?php echo"$receiversign".makecomma($starter->receiverswap).""; ?></b> <?php echo"$receivertype"; ?>
  <br />
  <br />
  <input name="finishdeal" type="submit" class="custombutton" id="finish" value="Finish The Deal" />
  &nbsp; &nbsp; &nbsp;
  <input name="cancellingthedeal" type="submit" class="custombutton" id="start4" value="Cancel The Deal" />
	    </p>
	  <p><?php $fetchreceiver=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$starter->receiver'"));
$fetchstarter=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

	  $starters = mysqli_query( $connection, "SELECT * FROM `deal` WHERE `starter`='$username'"); 
$starter = mysqli_fetch_object($starters);

	   if ($starter->startertype == "money"){ $fetching2 = "$fetchreceiver->money"; $fetching11 = "$fetchstarter->money"; }
	   if ($starter->startertype == "credits"){ $fetching2 = "$fetchreceiver->credits"; $fetching11 = "$fetchstarter->credits"; }
	   if ($starter->startertype == "FMJ"){ $fetching2 = "$fetchreceiver->fmj"; $fetching11 = "$fetchstarter->fmj"; }
	   if ($starter->startertype == "JHP"){ $fetching2 = "$fetchreceiver->jhp"; $fetching11 = "$fetchstarter->jhp"; }
	   if ($starter->receivertype == "money"){ $fetching = "$fetchstarter->money"; $fetching22 = "$fetchreceiver->money";}
	   if ($starter->receivertype == "credits"){ $fetching = "$fetchstarter->credits"; $fetching22 = "$fetchreceiver->credits"; }
	   if ($starter->receivertype == "FMJ"){ $fetching = "$fetchstarter->fmj"; $fetching22 = "$fetchreceiver->fmj"; }
	   if ($starter->receivertype == "JHP"){ $fetching = "$fetchstarter->jhp"; $fetching22 = "$fetchreceiver->jhp"; }
	   
	if ($fetching11 < $starter->starterswap) {
echo "<b><font color=\"red\">ALERT:</font> You do not have enough $starter->startertype to finish the deal.</b><br>"; }
if ($fetching22 < $starter->receiverswap) {
echo "<b><font color=\"red\">ALERT:</font> $starter->receiver does not have enough $starter->receivertype to finish the deal.</b>"; }
 ?><br />
	    </p>
    </center></td> 
  </tr>
</table></form></center>
<p>
  <?php } ?>
</br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>The Deal page is used for trading many things like bullets, money and credits. An example of how the Deal page works is if you wanted buy a certain amount of credits, you can offer a deal to another person for an amount of money and then wait to see if they accept, if accepted the items will be exchanged.</p></div></td></tr></table></td></tr></table></td></tr></table>
<?php include_once "incfiles/foot.php"; ?> 


</body></html>
