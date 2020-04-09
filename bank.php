<?php
session_start();
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/jailcheck.php"; 
logincheck(); 
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$ip = $_SERVER['REMOTE_ADDR'];
$ranking=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank' LIMIT 1"));
$loanbans=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM loanbans WHERE ip='$ip'"));
$fetchloan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM loanbans WHERE ip='$ip'"));
 
$page=$_GET['page'];
$express=$_GET['express'];
$ranklist=$_GET['ranklist'];

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script language="javascript" type="text/javascript">
<!--
function hide(id){ 
var hide = document.all? document.all[id + "_block"] : document.getElementById? document.getElementById(id + "_block") : "";
  	if(hide.style.display == 'none'){ hide.style.display = ''; }
  	else{  hide.style.display = 'none'; }
   }
// -->
</script>
<link rel="stylesheet" href="style.css" type="text/css" />
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
#pastactions {
	width: 75px;
	height: 75px;
	background-image: url(images/bank/pastactions.png);
	position: absolute;
	text-align: left;
	left: 110px;
	top: 475px;
}
.tablebank {
	font-family: Verdana;
	font-size: 10px; 
	font-weight: bold;
	border: 1px solid #000000;
	color: #000000;
	border-collapse: collapse;
	background-image: url(../images/bank.png);
	background-position: center bottom;
	background-repeat: no-repeat;
	padding: 5px;	
}
</style>
<title>Thug Paradise 2 :: Bank</title>
</head>

<body>
<form action="" method="post" name="form">
<?php if ($fetch->bank == "0" || $fetch->bank == ""){ ?>
<table width="600" height="150" cellspacing="0" align="center" cellpadding="0" border="0" class="table1px">
<tr><td height="30" class="gradient">TP Bank!</td></tr>
<tr><td valign="top" height="320" class="tablebank" align="center">
<span style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;">
<?php if (strip_tags($_POST['buyaccount'])){
if($fetch->money < "100000"){
echo "<center>You have not got £100,000 to buy a bank account.<br /><br />"; }elseif($fetch->money >= "100000"){
mysqli_query( $connection, "UPDATE accounts SET money=money-100000, bank=1 WHERE username='$username'");
echo "<center>You have bought a bank account for &pound;100,000.<br /><br />";	}} ?>
<br>
<br>

            <br>
            <br>            <br>
            <br>            <br>
            <br>            <br>                               <br>    <br>            <br>
            <br>            <br><br /><br />
<input name="buyaccount" type="submit" value="Buy Account!" class="custombutton" id="buyaccount" /></span></td>
</tr></table>
<?php }elseif ($fetch->bank == "1"){ ?>
    <table align="center" width="45%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
    <tr>
      <td class="gradient"><div align="center">
        Navigation Bar</div></td>
    </tr>
    <tr class="tableborder">
      <td><div align="center">
              <br>
              <br>
                        <a href="bank.php?page=pastactions">Bank Statements</a> &raquo; <a href="bank1.php">Money Transfer</a> &raquo; <a href="bank.php?page=deposit">Store Money</a> &raquo; <a href="bank.php?page=express">Express Bank</a> &raquo; <a href="bank.php?page=loan">Loans</a>
            <br />
            <br />
          </p>
      </div></td>
    </tr>
  </table>
            <br />
            <br />
<?php echo "$title"; ?>
<?php if (strip_tags($_POST['expressaccount'])){
if($fetch->credits < "25"){
echo "<center>You have not got 25 credits<br /> to buy an express account.<br /><br />"; }elseif($fetch->credits >= "25"){
$randPIN=rand(11111,99999);
mysqli_query( $connection, "UPDATE accounts SET credits=credits-25, express='1', expresspin='$randPIN' WHERE username='$username'");
echo "<center>You have bought an express<br /> account for 25 credits.<br /><br />Your PIN is: <b>$randPIN</b>. Keep it safe.";	}} ?>

<?php if (strip_tags($_POST['loginexpress'])){
$pin = strip_tags($_POST['loginPIN']);
if($fetch->expresspin != "$pin"){ echo "<center>Your express PIN is incorrect."; 
}elseif($fetch->expresspin == "$pin"){
echo "<meta http-equiv=\"refresh\" content=\"0;url=?page=express&express=yes\" />";	}} ?>

<?php if (strip_tags($_POST['expressbutton'])){
$expresschoose = strip_tags($_POST['expresschoose']);
$expressamount = strip_tags($_POST['expressamount']);

if ($expressamount == "0" || !$expressamount || ereg('[^0-9]',$expressamount)){ echo "Invalid amount of money entered.";
}elseif ($expressamount != 0 || $expressamount || !ereg('[^0-9]',$expressamount)){

if ($expresschoose == "deposit"){ 
if ($fetch->money < $expressamount){ echo "<center>You do not have enough money<br />to deposit the amount entered."; }
elseif ($fetch->money >= $expressamount){

mysqli_query( $connection, "UPDATE accounts SET money=money-$expressamount, expressmoney=expressmoney+$expressamount WHERE username='$username'");
echo "<center>You have depositted &pound;".makecomma($expressamount)."<br /> into your express cash account.";	}}

elseif ($expresschoose == "withdraw"){ 
if ($fetch->expressmoney < $expressamount){  
echo "<center>You do not have enough money in your<br /> express account to deposit the amount entered."; }
elseif ($fetch->expressmoney >= $expressamount){

mysqli_query( $connection, "UPDATE accounts SET expressmoney=expressmoney-$expressamount, money=money+$expressamount WHERE username='$username'");
echo "<center>You have withdraw &pound;".makecomma($expressamount)."<br /> from your express cash account."; }} }} ?>

<?php $timenow = time();
if ($fetch->loantime < $timenow){

if ($fetch->loanmoney > $fetch->loanpayed){ 
mysqli_query( $connection, "UPDATE accounts SET status='Dead' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET loan='0', loanmoney='0', loanpayed='0' WHERE username='$username'");
if ($loanbans == "0"){
mysqli_query( $connection, "INSERT INTO `loanbans` (`id`, `username`, `ip`, `times`, `date`) 
VALUES ('', '$username', '$ip', '1', '$date')"); 
}elseif ($loanbans == "1"){
mysqli_query( $connection, "UPDATE loanbans SET times='2' WHERE ip='$ip'"); }
mysqli_query( $connection, "INSERT INTO `attempts` ( `id` , `username` , `target` , `outcome` , `date` , `bullets` )
VALUES ('', 'Kartel', '$username', 'Dead', '$date', 'Loans Kill')");
mysqli_query( $connection, "UPDATE accounts SET modkills=modkills+1 WHERE username='Kartel'");
echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php\">"; }

elseif ($fetch->loanmoney <= $fetch->loanpayed && $fetch->loan != "0"){
mysqli_query( $connection, "UPDATE accounts SET loan='0', loanmoney='0', loanpayed='0' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username', 'Kartel', 'Thanks for paying your loan back to me. Your welcome back to my bank any time!<br><br><i>Automatic message, please do not reply.</i>', '<b>Loan Repayment</b>', '$date', '0');") or die (mysqli_error());  
echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php?page=deposit\">"; }}  

if ($fetch->loanmoney <= $fetch->loanpayed && $fetch->loan != "0"){
mysqli_query( $connection, "UPDATE accounts SET loan='0', loanmoney='0', loanpayed='0' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username', 'Kartel', 'Thanks for paying your loan back to me. Your welcome back to my bank any time!<br><br><i>Automatic message, please do not reply.</i>', '<b>Loan Repayment</b>', '$date', '0');") or die (mysqli_error());
echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php\">"; }

if (strip_tags($_POST['loanrepay'])){
$repayamount = strip_tags($_POST['repayamount']);

if ($repayamount == "0" || !$repayamount || ereg('[^0-9]',$repayamount)){ echo "Invalid amount of money entered.";
}elseif ($repayamount != 0 || $repayamount || !ereg('[^0-9]',$repayamount)){

$loanleft = $fetch->loanmoney - $fetch->loanpayed;

if ($repayamount > $loanleft){ $repayamount = "$loanleft"; }

$loantime = (3600*24) * 5;  
mysqli_query( $connection, "UPDATE accounts SET loanpayed=loanpayed+$repayamount, money=money-$repayamount WHERE username='$username'");
echo "<center>You have added &pound;".makecomma($repayamount)."<br /> towards repaying the amount of your loan."; }} ?>

<?php if (strip_tags($_POST['loan'])){
$loanamount = strip_tags($_POST['loanamount']);

if ($loanamount == "0" || !$loanamount || ereg('[^0-9]',$loanamount)){ echo "<center>Invalid amount of money entered.";
}elseif ($loanamount != 0 || $loanamount || !ereg('[^0-9]',$loanamount)){

if ($ranking->loan < $loanamount){ echo "<center>You have exceeded the maximum<br />loan for your accounts rank."; }
elseif ($ranking->loan >= $loanamount){

$loant = (3600*24) * 0;  
$loantime = time() + $loant;
$tax = round(($loanamount / 100) * 0);
$loanmoney = $loanamount + $tax;
mysqli_query( $connection, "UPDATE accounts SET loanmoney='0', loantime='$loantime', loan='1', money=money+0 WHERE username='$username'");
echo "<center>You have took out a loan of &pound;".makecomma($loanamount)."<br />plus &pound;".makecomma($tax)." of tax, from the bank."; }}} ?>

<?php if(strip_tags($_POST['banktransfer'])){
$sendto = strip_tags($_POST['sendto']);
$sendname = trim(strip_tags($_POST['name']));
$sendtype=strip_tags($_POST['sendtype']);
$sendamount=strip_tags($_POST['sendamount']);

$ip = $_SERVER['REMOTE_ADDR'];
if ($sendto == ""){ echo "<center>Please choose either to send to a user or gang."; }elseif ($sendto != ""){

if ($sendname == ""){ echo "<center>Please enter a username or gang name."; }elseif ($sendname != ""){

if (ereg('[^a-zA-Z0-9_-]', $sendname)) { echo "<center>The username / gangname entered contains invalid characters.";
}elseif (!ereg('[^A-Za-z0-9_-]', $sendname)) { 

if ($sendamount == "0" || !$sendamount || ereg('[^0-9]',$sendamount)){ echo "Invalid amount of money / bullets.";
}elseif ($sendamount != 0 || $sendamount || !ereg('[^0-9]',$sendamount)){
		
if ($sendto == "user"){
$userquery = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$sendname'");

$user_rows = mysqli_num_rows($userquery);
$fetchuser = mysqli_fetch_object($userquery);

if ($user_rows == "0"){ echo "<center>The username entered does not exist."; }elseif ($user_rows != "0"){

if ($fetch->$sendtype < $sendamount){ echo "<center>You do not have enough $sendtype to process the transfer."; }
elseif ($fetch->$sendtype >= $sendamount){

if ($sendtype == "money"){ $tax = round(($sendamount / 100) * 7.5); }elseif ($sendtype != "money"){ $tax = 0; }
$plustax = $sendamount + $tax;

if ($fetch->$sendtype < $plustax){ echo "<center>You cannot afford the 7.5% tax included."; }
elseif ($fetch->$sendtype >= $plustax){

if ($sendname == $username){ echo "<center>You cannot send transfers to yourself!"; }elseif ($sendname != $username){

mysqli_query( $connection, "UPDATE accounts SET $sendtype = $sendtype-$plustax WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET $sendtype = $sendtype+$sendamount WHERE username='$sendname'");
$gmt_time = gmdate('Y-m-d h:i:s');
mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `gang`, `ip`, `type`, `ip2`) 
VALUES ('', '$sendname', '$username', '$sendamount', '$gmt_time', '0', '$ip' ,'$sendtype', '$fetchuser->l_ip');") or die (mysqli_error());

if ($sendtype == "money"){ $sign = "&pound;"; $types = "including<br /> $sign".makecomma($tax)." tax,"; }
if ($sendtype == "fmj"){ $sign = ""; $types = "FMJ"; }
if ($sendtype == "jhp"){ $sign = ""; $types = "JHP"; }

if($sendtype == "money"){
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$sendname', '$username', '<a href=\'profile.php?viewing=$username\'>$username</a> sent you &pound;".makecomma($sendamount).".', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error());

}elseif($sendtype == "fmj" || $sendtype == "jhp"){
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$sendname', '$username', '<a href=\'profile.php?viewing=$username\'>$username</a> sent you ".makecomma($sendamount)." $types.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }

echo "<center>You successfully sent $sign".makecomma($sendamount)." $types to $sendname."; }}}}


}elseif ($sendto == "gang"){
$gangquery = mysqli_query( $connection, "SELECT * FROM crews WHERE name='$sendname'");
$gang_rows = mysqli_num_rows($gangquery);
$fetchgang = mysqli_fetch_object($gangquery);

if ($gang_rows == "0"){ echo "<center>The gangname entered does not exist."; }elseif ($gang_rows != "0"){

if ($fetch->$sendtype < $sendamount){ echo "<center>You do not have enough $sendtype to process the transfer."; }
elseif ($fetch->$sendtype >= $sendamount){

if ($sendtype == "money"){ $tax = round(($sendamount / 100) * 7.5); }elseif ($sendtype != "money"){ $tax = 0; }
$plustax = $sendamount + $tax;

if ($fetch->$sendtype < $plustax){ echo "<center>You cannot afford the 7.5% tax included."; }
elseif ($fetch->$sendtype >= $plustax){

if ($sendname != $fetch->crews){ echo "<center>You can only send transfers to your own gang."; }elseif ($sendname == $fetch->crews){

mysqli_query( $connection, "UPDATE accounts SET $sendtype = $sendtype-$plustax WHERE username='$username'");
mysqli_query( $connection, "UPDATE crews SET $sendtype = $sendtype+$sendamount WHERE name='$sendname'");
$gmt_time = gmdate('Y-m-d h:i:s');
mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 
VALUES ('', '$sendname', '$username', '$sendamount', '$gmt_time', '1', '$ip' ,'$sendtype', '$sendname');") or die (mysqli_error());

if ($sendtype == "money"){ $sign = "&pound;"; $types = "including $sign".makecomma($tax)." tax,"; }
if ($sendtype == "fmj"){ $sign = ""; $types = "FMJ"; }
if ($sendtype == "jhp"){ $sign = ""; $types = "JHP"; }
 
echo "<center>You successfully sent $sign".makecomma($sendamount)." $types to the gang $sendname."; }}}}}
}}}}} ?>


</span></td>
</tr>

<?php if ($page == "" && $fetch->bank == "1"){ ?> 

<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" class="gradient" colspan="2">Welcome To TP Banking</td></tr>
<tr>
<td align="center" class="tableborder">Select an option using the "Navigation  Bar" above!
</tr></table>

<?php }elseif ($page == "transfer"){ ?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" class="gradient" colspan="2">Bank Transfer</td></tr>
<tr>
<td align="right" class="tableborder">Sending To:</td>
<td align="left" class="tableborder">
<select name="sendto" id="sendto" class="textbox"> 
<option value="user">User</option>
<option value="gang">Gang</option>
</select></td></tr>
<tr>
<td width="50%" align="right" class="tableborder">Name: </td>
<td width="50%" align="left" class="tableborder"><input class="textbox" name="name" type="text" id="name" /></td></tr>
<tr>
<td align="right" class="tableborder">Amount:</td>
<td align="center" class="tableborder"><input class="textbox" name="sendamount" type="text" id="sendamount" maxlength="9" /></td></tr>
<tr>
<td align="right" class="tableborder">Type:</td>
<td align="center" class="tableborder">
<select name="sendtype" id="sendtype" class="textbox">
<option value="money" selected="selected">Money - <?php echo"&pound;".makecomma($fetch->money)."";?></option>
<option value="fmj">FMJ Bullets - <?php echo"".makecomma($fetch->fmj)."";?></option>
<option value="jhp">JHP Bullets - <?php echo"".makecomma($fetch->jhp)."";?></option>
</select></td></tr>
<tr>
<td colspan="2" align="center" class="tableborder">
<input name="banktransfer" type="submit" class="custombutton" id="banktransfer" value="Transfer!" /></td>
</tr></table>


<?php

}elseif($page == "deposit"){







$place = mysqli_query( $connection, "SELECT money, bankmoney, banktime, username, intrest, collect, days FROM accounts WHERE username='$username'");

while($success = mysqli_fetch_row($place)){

	$money = $success[0];

	$bankmoney = $success[1];

	$banktime = $success[2];

	$username = $success[3];

$initr = $success[4];

	$collect = $success[5];

		$days = $success[6];

}



$last = $banktime;

$timenow = time();

$time_left = $last - $timenow;



if ($last > 0){

			if($last>$timenow){

					$order = $last-$timenow;

						while($order >= 60){

							$order = $order-60;

							$ordermleft++;

						}

						while($ordermleft >= 60){

							$ordermleft = $ordermleft-60;

							$orderhleft++;

						}

						

						if($ordermleft == 0){ 

							$ordermleft = "";

						} else {

						$ordermleft = "$ordermleft M";

						}

						if($orderhleft == 0){

							$orderhleft = "";

						} else {

						$orderhleft = "$orderhleft H";

						}

					

				}

}



		

	if ($last <= time() && $last != "0"){

$nmoney =  $initr * $bankmoney / 100;

$moneyinbanke = $bankmoney + ($nmoney * $days);

$moneyinbanke= round($moneyinbanke); 





	mysqli_query( $connection, "UPDATE accounts SET bankmoney = '$moneyinbanke' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET banktime = '0', collect='1' WHERE username='$username'");





}

	if($_POST['withdraw']){

	mysqli_query( $connection, "UPDATE accounts SET money=money+bankmoney WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET bankmoney='0', collect='0', days='0' WHERE username='$username'");

    echo "<center>You successfully withdrew &pound;".makecomma($bankmoney)."";


}

$dep = strip_tags(addslashes($_POST['dep']));

$das = strip_tags(addslashes($_POST['das']));

if (strip_tags($_POST['deposit'])){

	if (!$dep){

	echo "You did not choose an amount to be deposited.";

	}elseif ($dep){

	if ($dep < '0'){

	echo "Invalid Amount!";

	}elseif ($dep > 0){

	if  (ereg('[^0-9]',$dep))

   {

     

    echo "Invalid Numbers!";

}elseif(!ereg('[^0-9]',$dep)){



	if ($dep > $money){

	echo "You have not got that much money.";

	}elseif ($dep <= $money){

	$samoney = $money - $dep;

	$bmoney = $dep;





if (($dep >= 1) && ($dep < 50000000)){ $intrest = 2; }

elseif (($dep >= 50000000) && ($dep < 125000000)){ $intrest = 1.5; }

elseif (($dep >= 125000000) && ($dep < 500000000)){ $intrest = 1; }

elseif (($dep >= 500000000) && ($dep < 1000000000)){ $intrest = 0.5; }

elseif ($dep >= 1000000000){ $intrest = 0.5; }



	$ha = (3600*1) * $das;

		

			$timewait=time()+ $ha;

	mysqli_query( $connection, "UPDATE accounts SET money = '$samoney' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET bankmoney = '$bmoney' WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET intrest = '$intrest' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET banktime = '$timewait', days='$das' WHERE username='$username'");

echo "<center>&pound;".makecomma($bmoney)." has been deposited into your bank account.";


}}}}}

?>


<form action="" method="post">

<center>

<table width=300 border=0 cellpadding=2 cellspacing=0 class=table1px>

<tr>

  <td height="22" colspan=2 align=center  class="gradient"><font color=#FFFFFF><b>Bank Account/Balance</b></font></td>

</tr>

  

<tr><td width="50%" class="table1px" align="right">Bank Account:</td><td width="50%"><?php echo "&pound;".makecomma($bankmoney).""; ?></td></tr>

<tr>

  <td class="table1px" align="right">Interest Gained:</td>

  <td class="table1px"><?php if($collect == "1"){ echo"Collect Money"; }else{

  $nmoney =  ($initr) * ($bankmoney / 100) * ($days);

  $nmoney = round($nmoney);

echo "&pound;".makecomma($nmoney)."";  }

  ?></td>

</tr>

<tr>

  <td class="table1px" align="right">Time Left:</td>

  <td class="table1px"><?php if($bankbankmoney  == "0"){ echo"None"; }else{ if ($last <= 0){ echo "None"; }else{ echo "".maketime($last).""; } ?></td>

</tr>


  <td class="tableborder" colspan="2" align=center><?php if ($bankmoney > 0){ echo "<input type=\"submit\" class=custombutton name=withdraw value=\"Withdraw\">"; }else{ echo "

  <select name=\"das\" id=\"select\" class=\"textbox\">

      <option value=\"1\" selected=selected>1 Hour</option>

           <option value=\"2\">2 Hours</option>

           <option value=\"3\">3 Hours</option>

		              <option value=\"4\">4 Hours</option>

           <option value=\"5\">5 Hours</option>           <option value=\"6\">6 Hours</option>

           <option value=\"7\">7 Hours</option>

     </select><br>

  <br>&pound;<input maxlength='9' name=dep size=10 type=text class=\"textbox\">  &nbsp; <input type=submit class=custombutton name=deposit value='Deposit!'>";  ?>    </td>

  </tr>

</table>     

</center>

</form>

<p>

</td>&nbsp;&nbsp;&nbsp;<td width=10>&nbsp;</td>

<td width=100%>



<table width=400 border=0 align="center" cellpadding=2 cellspacing=0 bordercolor=black  class=table1px>

  <tr>

<td height="22" colspan=3 align=center  onclick='hide("main"); return false;' class="gradient"><font color=#FFFFFF><b>Interest Table</b></font></td>

  </tr>
<tbody id="main_block">
<tr class="topic">

<td width=26% height="22" align=center><u>Interest</u></td>

<td width=41% height="22" align=center><u>From</u></td>

<td width=33% height="22" align=center><u>To</u></td>

</tr>	



<tr>

  <td align="center" class="table1px">2%</a></td> 

  <td align="center" class="table1px">&pound;1</td> 

<td align="center" class="table1px">&pound;50,000,000</td>

</tr>

<tr>

  <td align="center" class="table1px">1.5%</a></td> 

  <td align="center" class="table1px">&pound;50,000,000</td> 

<td align="center" class="table1px">&pound;124,999,999</td>

</tr>

<tr>

  <td align="center" class="table1px">1%</a></td> 

<td align="center" class="table1px">&pound;250,000,000</td> 

<td align="center" class="table1px">&pound;499,999,999</td>

</tr>

<tr>

  <td align="center" class="table1px">0.5%</a></td> 

<td align="center" class="table1px">&pound;500,000,000</td> 

<td align="center" class="table1px">&pound;1,000,000,000</td>

</tr>
</tbody>
</table>



<?php } ?>
</table>

<?php }}elseif ($page == "express"){ ?>
<?php if ($fetch->express == "0"){ ?>
<table width="330" border="0" cellpadding="0" cellspacing="0" align="center" class="table1px">
<tr><td height="30" colspan="2" class="gradient">Express Cash!</td></tr>
<tr><td class="tableborder" colspan="2" align="center">
You do not yet posses an express cash account.<br />You can receive an account by clicking "Make Account" below. This will then give you a pin which you need to login to the express cash account.<br /><br />
<b>Please be aware that if you lose the pin, you will not get another and you will lose the account.</b><br /><br />
An express account costs 25 credits.<br /><br />
<input type="submit" class="custombutton" name="expressaccount" value="Make Account" /></td>
</tr>
</table>
<?php }elseif ($fetch->express == "1"){ ?>
<?php if ($express == ""){ ?>
<table width="330" border="0" cellpadding="0" cellspacing="0" align="center" class="table1px">
<tr><td height="30" colspan="2" class="gradient">Express Cash Login</td></tr>
<tr><td class="tableborder" colspan="2" align="center">
Here you can login to your Express Cash account. Everytime you visit this page, you will be made to login to your account, so that it stays secure for yourself.<br /><br />
Your PIN: <input type="password" class="textbox" id="loginPIN" size="8" name="loginPIN" /><br /><br />
<input type="submit" class="custombutton" name="loginexpress" value="Login Now!" /></td>
</tr>
</table>
<?php }elseif ($express == "yes"){ ?>
<table width="356" border="0" cellpadding="0" cellspacing="0" align="center" class="table1px">
<tr><td width="354" bgcolor="#FFFFFF" style="padding: 4px;">
<div align="left">
<span style="font-size: 14px; color: #996600; font-family: Verdana, Arial, Helvetica, sans-serif;">Express Cash</span>
</div>
<div align="right" style="padding-right: 15px;">
<span style="font-size: 17px; color: #996600; font-family: Verdana, Arial, Helvetica, sans-serif;">
<?php echo "&pound;".makecomma($fetch->expressmoney).""; ?> </span>
</div> 
<tr><td bgcolor="#FFFFFF" style="padding: 4px;" align="center">
<span style=" color: #000000; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;">
Welcome to your express cash account!<br /><br />Here you can deposit money into your express account, as well as withdrawing it. This account is yours for the rest of your TP careers, therefore be sure not to lose your express PIN.<br /><br />Use the form below to either withdraw or deposit money into your express account. (The top right corner shows your balance).<br /><br />
Choice: 
<select name="expresschoose" id="expresschoose" class="textbox">
<option value="deposit">Deposit (<?php echo "&pound;".makecomma($fetch->money).""; ?>)</option>
<option value="withdraw">Withdraw (<?php echo "&pound;".makecomma($fetch->expressmoney).""; ?>)</option>
</select><br /><br />
£<input type="text" name="expressamount" id="expressamount" class="textbox" size="14" /><br /><br /> 
<input type="submit" name="expressbutton" id="expressbutton" value="Sumbit" style="border: 1px; color: #996600;" />
</span><br /><br /><span style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;">
<a href="?page=express&express=yes">Refresh</a></span></td> 
</tr>
</table> 
<?php }} ?> 

<?php }elseif ($page == "loan"){ ?>

<?php if ($loanbans == "1" && $fetchloan->times == "2"){ 
echo "<div align=\"center\"><span style=\" color: #FFFFFF; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;\">
Your are IP Banned from the loans page<br />for failing to pay back your last 2 loans.</span></div>"; }
elseif ($loanbans == "0" && $fetchloan->times != "2"){ ?>
<?php if ($fetch->loan == "0"){  
if ($ranklist == "yes"){ ?>
<table width="220" border="0" class="tableback" align="center" cellpadding="0" cellspacing="0">
<tr>  
<td class="gradient" width="35%" align="center" style="padding: 2px;">
<span style=" color: #FFFFFF; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;"><u>Rank</u></span></td>
<td class="gradient" width="35%" align="center" style="padding: 2px;">
<span style=" color: #FFFFFF; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;"><u>Max Loan</u></span></td>
</tr>
<?php $rankkkk=mysqli_query( $connection, "SELECT * FROM `ranking` ORDER BY loan ASC");
while($theloan=mysqli_fetch_object($rankkkk)){
echo "<tr>
<td class=\"table1px\" align=\"center\" style=\"padding: 2px;\">
<span style=\" color: #FFFFFF; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;\">$theloan->rank</span></td>
<td class=\"table1px\" align=\"center\" style=\"padding: 2px;\">
<span style=\" color: #FFFFFF; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;\">&pound;".makecomma($theloan->loan)."</span></td>
</tr>"; } ?>
</table>
<?php }elseif ($ranklist == ""){ ?>
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center" class="table1px">
<tr><td height="30" colspan="2" class="gradient">Take Out Loans!</td></tr>
<tr><td class="tableborder" colspan="2" align="center">This is the loans page. Here you can take out a loan, depending on your rank. You can view the rank list by clicking <a href="?ranklist=yes&page=loan">HERE</a>. You have 5 days to pay back a loan. If the loan is failed to be re-payed, your account will be killed and your IP shall receive 1 strike out of 2 from being IP Banned from the loans system, which cannot be un-done. <br /><br />
Desired Loan: CLOSED!<br /><br />
<input type="submit" class="custombutton" name="loan" value="Take Out Loan!" /></td>
</tr>
</table>
<?php }}elseif ($fetch->loan == "1"){ 
$loanleft = $fetch->loanmoney - $fetch->loanpayed; ?>
<table width="356" border="0" cellpadding="0" cellspacing="0" align="center" class="table1px">
<tr>
<td width="354" bgcolor="#FFFFFF" style="padding: 4px;"><div align="left"> 
<span style="font-size: 14px; color: #660000; font-family: Verdana, Arial, Helvetica, sans-serif;">Your Loans</span> </div>

<div align="right" style="padding-right: 15px;"> 
<span style="font-size: 15px; color: #660000; font-family: Verdana, Arial, Helvetica, sans-serif;">Loan: </span>
<span style="font-size: 15px; color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif;"><?php echo "&pound;".makecomma($fetch->loanmoney).""; ?> </span></div>

<div align="right" style="padding-right: 15px;"> 
<span style="font-size: 15px; color: #660000; font-family: Verdana, Arial, Helvetica, sans-serif;">Loan Left: </span>
<span style="font-size: 15px; color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif;"><?php echo "&pound;".makecomma($loanleft).""; ?> </span></div></td>
  </tr>
<tr>
<td bgcolor="#FFFFFF" style="padding: 4px;" align="center"><span style=" color: #000000; font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;"><b><?php echo "".maketime($fetch->loantime)." left to repay your loan."; ?></b><br /><br />
Welcome to your loans payin account!<br /><br />
Throughout the 5 days you have to pay back your loan, you will have to use this page to keep adding to the money payed back. <br /><br />
This page simply helps you pay back your debts. The top right corner shows you how much you have to pay back from the overall total.<br /><br />By using the form below, you can add money to the pay back of the loan as frequently as you like and in as much bulks as you like. So that you don't forget, the header shall provide you with how long you have until your loan needs repaying. If you don't repay the loan within 5 days, your account will get killed by the gang owner (TheLegend).<br /><br /><br />
Repay: &pound; <input type="text" name="repayamount" id="repayamount" class="textbox" size="14" /><br /><br />
<input type="submit" name="loanrepay" id="loanrepay" value="Sumbit" style="border: 1px; color: #660000;" /></span><br /><br />
<span style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;"> <a href="?page=loan">Refresh</a></span></td>
</tr> 
</table> 
<?php }} ?>

<?php }elseif ($page == "pastactions"){ ?>  

<table width="380" border="0" class="table1px" align="center" cellpadding="0" cellspacing="0">
<tr><td height="30" colspan="3" class="gradient">Received Transactions</td></tr>
<tr>  
<td width="35%" class="tableborder" align="center"><u>From</u></td>
<td width="35%" class="tableborder" align="center"><u>Amount</u></td>
<td width="30%" class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $k=mysqli_query( $connection, "SELECT * FROM `transfers` WHERE `to`='$username' ORDER BY id DESC LIMIT 5");
while($p=mysqli_fetch_object($k)){
if ($p->type == "money") { $sign = "&pound;"; $types = ""; }
if ($p->type == "fmj") { $sign = ""; $types = "FMJ"; } 
if ($p->type == "jhp") { $sign = ""; $types = "JHP"; }
echo "<tr>
<td class=\"tableborder\" align=\"center\"><a href='profile.php?viewing=$p->from'>$p->from</a></td>
<td class=\"tableborder\" align=\"center\">$sign".makecomma($p->amount)." $types</td>
<td class=\"tableborder\" align=\"center\">$p->date</td>
</tr>"; } ?>
</table>
<br /><br />
<table width="380" border="0" class="table1px" align="center" cellpadding="0" cellspacing="0">
<tr><td height="30" colspan="3" class="gradient">Sent Transactions</td></tr>
<tr> 
<td width="35%" class="tableborder" align="center"><u>Sent To</u></td>
<td width="35%" class="tableborder" align="center"><u>Amount</u></td>
<td width="30%" class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $ka=mysqli_query( $connection, "SELECT * FROM `transfers` WHERE `from`='$username' ORDER BY id DESC LIMIT 5");
while($pa=mysqli_fetch_object($ka)){
if ($pa->type == "money") { $sign = "&pound;"; $types = ""; }
if ($pa->type == "fmj") { $sign = ""; $types = "FMJ"; }
if ($pa->type == "jhp") { $sign = ""; $types = "JHP"; }
echo "<tr>
<td class=\"tableborder\" align=\"center\"><a href='profile.php?viewing=$pa->to'>$pa->to</a></td>
<td class=\"tableborder\" align=\"center\">$sign".makecomma($pa->amount)." $types</td>
<td class=\"tableborder\" align=\"center\">$pa->date</td>
</tr>"; } ?>
</table>
<?php } ?>
<tr><td height="324" width="42%" valign="middle">



<?php if ($page == "" && $fetch->bank == "1"){ ?>
<br>
<br>
 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>This section of the page shall endure you with the information of the bank option you have selected. Any option you choose, the information to that figure shall appear here. If you are worried about how much something costs, what it will give you, or any other questions, this section should answer them. If not, please relate to the helpdesk for more details questions.</p><p>

<div align="left">These are the options:<br /><br />

<li /> Transfer money <li /> Deposit money <li /> Express cash account <li /> Loan money <li /> Past actions</div></p> 

<p>Please use your bank account respectively.</p></div></td></tr></table>

<?php }elseif ($page == "transfer"){ ?> 
<br>
<br>
 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>Transferring money is easy. Simple all you have to do is fill in the form to the right hand side. You will be able to select whether you would like to send your money to a gang or a user. If gang is selected, the only gang you will be able to send it to is your own. Otherwise, your free to send to anyone you like! The form to the right includes details such as who you want to send the money to (gang / user), there / it's name, how much and also, you can send bullets too! </p><p><b>On each of the transfer's made, irrespective of who to, you will be charged 7.5% tax.</b> This tax can be lowered by using the "Lower Tax" perk on the credits page, or by receiving a lowered tax by reaching Billionaire.</p>

    <p>Once the money transfer has been sent, you cannot get it back unless the player / gang you sent it to resends it to you. However, they <b>do not</b> have to send it back, even if it was sent by mistake. Only yourself can make mistakes! </p></div></td></tr></table>

<?php }elseif ($page == "deposit"){ ?>

<br>
<br>

<table width="356" border="0" align="center" cellpadding="2" class="tableback">


 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>The deposit page! Here it is simply just for you to deposit your money and gain interest depending on one thing: the amount of time you enter it in for! However, beware! There is a catch, the money which is in this bank gains interest, unlike the express cash account, but is not entirely safe! If your account is killed, this bank account is wiped (unless you decide to revive the account, then it shall be active once again). Therefore you have to be aware of how long you are putting your money in for. If you think you are going to get killed, we recommend you do not put your money in this bank, but in the express cash account (which costs 25 credits). Alternatively, swap your money for credits with someone else.</p>

    <p>Thug Paradise is not responsible for any money lost during deposit. If you lose money when you die, as it is in the bank; we will not refund. You must revive your account to retain the money. Also, although you can send bullets, you cannot deposit them. </p></div></td></tr></table>


<?php }elseif ($page == "express"){ ?>

<br>
<br>
 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>This feature is the most modern way of keeping up-to-date with all your cash. It provides safe shelter for all of your money (if you decide to deposit the money into this account). If you wish to make an account, it will cost you 25 credits, but it is well worth it!</p>

    <p>You can log into this account by entering your pin to the right (if you posses one), this will then take you to the page where you can deposit your money. It is just like the deposit money feature mentioned earlier, however if your account died, the money deposited is retrievable; as you have the express cash account for the rest of your TP future! You will never lose it unless the admins take it away from you. If you unfortunately lose your pin, you will not receive a new one, so keep it safe!</p>

    <p><b>Any account that is inactive for a lengthy amount of time shall be deleted, to clear space. </b></p></div></td></tr></table>


<?php }elseif ($page == "loan"){ ?>

<br>
<br>

 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>Loans are so simple! If you need money fast, this is the place to come. Loans can be taken out from any rank above Criminal. However, you must pay the loan back within 5 days. If the loan is not payed back, the bank manager (Kartel) shall kill you! If you decide to take another loan out (on a new account), the system will register that you failed to pay last time and you will have another 5 days to pay back the loan. If the loan is not payed back this time, you will be firstly killed and secondly IP banned from the loan system. The maximum loan for each rank varies from &pound;1,000,000 (Criminal) to &pound;25,000,000 (Official TP Legend).</p>

    <p>Every loan that is taken out, 10% tax shall be added to the amount of which you have to pay back. Therefore the bigger the loan, the more you have to pay in additional costs.</p>

    <p><b>We advise that you only use this feature if you are in financial troubles. You use the loan feature at your own risk. Prepare to be killed if you do not pay back! </b></p></div></td></tr></table>



<?php }elseif ($page == "pastactions"){ ?>

<br>
<br>
 <table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1"><p>By selecting this option, it simply just shows what transfers you have committed in the past. Admins and moderators have the right to look at these whenever they wish, and they are not able to be deleted by normal accounts. Please be careful about how much you send to each user. Because at the end of the day, you don't want to be a suspect of cheating, do you?</p>

    <p>Each transfer is matched by the table on the right. Each transaction has it's own line, stating clearly who it was sent to, how much and when. </p></div></td></tr></table>


<?php } ?>
</td>
</tr>
</table>  
</td></tr>   
</table> 
<?php } ?>
</form>
<?php include_once "incfiles/foot.php"; ?>
</body> 
</html> 