<?php

session_start();

include_once "incfiles/connectdb.php";

include "incfiles/func.php";

logincheck();

$username=$_SESSION['username'];

$page=strip_tags($_GET['page']);

$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$fetch2= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$query3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='$fetch->location'"));


$tax = $query3->tax + 3;
$tax2 = $query3->tax;

$gmt_time = gmdate('Y-m-d h:i:s');

if(!$_GET['page']){ $page="1"; }





?><link href="style.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="style.css"/>
	<script type="text/javascript" src="sortable.js"></script>


<?php if($page == "1"){?>



<html>

<style type="text/css">
<!--
.style4 {
	font-size: 18px;
	font-weight: bold;
}

-->
</style>
<head>

<script type="text/javascript" language="javascript" src="stopSteal.js"></script>

<title>Bank</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</head>



<body>

<form action="" method="post">



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



<br>



<table width="31%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">

<tr><td height="22" class="gradient" align="center"><b>Bank Transfer</b></td></tr>

<tr><td>

<table class="table1px" width="100%" border="0" cellpadding="3" cellspacing="0">

<tr><td height="12" width="24%" align="right">To:</td>

<td height="12" width="76%" align="center"><input class="textbox" name="to_person" type="text" id="to_person"></td></tr>

<tr><td height="12" align="right">Amount:<br></td>

<td height="12" align="center"><input class="textbox" name="send_amount" type="text" id="send_amount" maxlength="9"></td></tr>

<tr><td height="12" align="right" class="tableborder">Type:</td>

<td height="12" align="center" class="table1px">

            <select name="type" id="type" class="textbox">

            <option value="money" selected>Money - <?php echo"&pound;".makecomma($fetch->money)."";?></option>

            <option value="fmj">FMJ Bullets - <?php echo"".makecomma($fetch2->fmj)."";?></option>

			<option value="jhp">JHP Bullets - <?php echo"".makecomma($fetch2->jhp)."";?></option>

            </select></td></tr>

<tr><td colspan="2" align="center" class="tableborder">Player <input name="type2" type="radio" value="user" />&nbsp;&nbsp;&nbsp;

Crew <input name="type2" type="radio" value="crew" /></td></tr>

<tr><td colspan="2" align="center"><input name="Send_button" type="submit" class=custombutton id="Send_button" value="Send"></table>




<?php

if($_POST['Send_button']){

$send_amount = strip_tags($_POST['send_amount']);

$to_person = trim(strip_tags($_POST['to_person']));

$type=strip_tags($_POST['type']);

$type2=strip_tags($_POST['type2']);

$ip = $_SERVER['REMOTE_ADDR'];



if (!$type2){	

echo"Please choose either to send to a player or a crew.";

}elseif ($type2){

if (!$to_person){

echo "<center>Please enter a username or gang name.";

}elseif ($to_person){

		

if($type2 == "user"){

$result= mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$to_person'");

$to_user= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$to_person'"));

$row_to = mysqli_num_rows($result);

$type3 == "username";

}elseif($type2 == "crew"){

$result= mysqli_query( $connection, "SELECT * FROM crews WHERE name='$to_person'");

$row_to = mysqli_num_rows($result);

$crews = mysqli_fetch_object($result);

$type3 == "name"; }

		

if ($row_to == "0"){

echo "<center>No such $type2.";

}elseif ($row_to != "0"){

		

if ($send_amount > "0"){

if ($send_amount == 0 || !$send_amount || ereg('[^0-9]',$send_amount)){

print "<center>You cant send that amount."; 

}elseif ($send_amount != 0 || $send_amount || !ereg('[^0-9]',$send_amount)){	

$send_amount=intval($_POST['send_amount']);

			

if ($type2 == "user"){

if(strtolower($row_to['username']) == strtolower($username)){

echo "<center>You cannot send things to yourself.";						

}elseif (strtolower($to_person) != strtolower($username)){

					

if ($type == "money"){ 

$tax=round(($send_amount / 100) * $tax); 



$newmoney = $send_amount + $tax;

if ($newmoney > $fetch->money){ 

echo "<center>You do not have that much money to send.";

}elseif ($$newmoney <= $fetch->money){

mysqli_query( $connection, "UPDATE accounts SET money=money-$newmoney WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET money=money+$send_amount WHERE username='$to_person'");

echo "<center>You sent &#163;".makecomma($send_amount)." to $to_person plus &#163;".makecomma($tax)." of tax.";


$tax2=round(($send_amount / 100) * $tax2); 
mysqli_query( $connection, "UPDATE gangCountry SET profit=profit+$tax2 WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE crews SET money=money+$tax2 WHERE name='$query3->gang'");


mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '0', '$ip' ,'money', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$to_person', '$username', '\[user\]$username\[/user\] sent you £".makecomma($send_amount).".', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "JSP"){ 

if ($send_amount > $fetch1->JSP){ 

echo "<center>You do not have that much JSP to send.";

}elseif ($send_amount <= $fetch1->JSP){

mysqli_query( $connection, "UPDATE account_info SET JSP=JSP-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE account_info SET JSP=JSP+$send_amount WHERE username='$to_person'");

echo "<center>You sent ".makecomma($send_amount)." JSP to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '0', '$ip' ,'JSP', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$to_person', '$username', '<a href=\'profile.php?viewuser=$username\'>$username</a> sent you ".makecomma($send_amount)." JSP.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "fmj"){ 

if ($send_amount > $fetch2->fmj){ 

echo "<center>You do not have that much FMJ to send.";

}elseif ($send_amount <= $fetch2->fmj){

mysqli_query( $connection, "UPDATE accounts SET fmj=fmj-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET fmj=fmj+$send_amount WHERE username='$to_person'");

echo "<center>You sent ".makecomma($send_amount)." FMJ to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '0', '$ip' ,'fmj', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$to_person', '$username', '<a href=\'profile.php?viewing=$username\'>$username</a> sent you ".makecomma($send_amount)." FMJ.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "jhp"){ 

if ($send_amount > $fetch2->jhp){ 

echo "<center>You do not have that much JHP to send.";

}elseif ($send_amount <= $fetch2->jhp){

mysqli_query( $connection, "UPDATE accounts SET jhp=jhp-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET jhp=jhp+$send_amount WHERE username='$to_person'");

echo "<center>You sent ".makecomma($send_amount)." JHP to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '0', '$ip' ,'jhp', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$to_person', '$username', '<a href=\'profile.php?viewuser=$username\'>$username</a> sent you ".makecomma($send_amount)." JHP.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}





}}elseif ($type2 == "crew"){ 



if ($type == "money"){ 

$tax=round(($send_amount / 100) * $tax); 

$newmoney = $send_amount + $tax;

if ($newmoney > $fetch->money){ 

echo "<center>You do not have that much money to send. Remember this includes $tax% from tax.";

}elseif ($newmoney <= $fetch->money){

mysqli_query( $connection, "UPDATE accounts SET money=money-$newmoney WHERE username='$username'");

mysqli_query( $connection, "UPDATE crews SET money=money+$send_amount WHERE name='$to_person'");

echo "<center>You sent $".makecomma($send_amount)." to $to_person plus $".makecomma($tax)." of tax."; 


$tax2=round(($send_amount / 100) * $tax2); 
mysqli_query( $connection, "UPDATE gangCountry SET profit=profit+$tax2 WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE crews SET money=money+$tax2 WHERE name='$query3->gang'");

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '1', '$ip' ,'money', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$crews->owner', '$username', '<a href=\'profile.php?viewuser=$username\'>$username</a> sent your gang £".makecomma($send_amount).".', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "JSP"){ 

if ($send_amount > $fetch1->JSP){ 

echo "You do not have that much JSP to send.";

}elseif ($send_amount <= $fetch1->JSP){

mysqli_query( $connection, "UPDATE account_info SET JSP=JSP-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE crews SET jsp=jsp+$send_amount WHERE name='$to_person'");

echo "You sent ".makecomma($send_amount)." JSP to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '1', '$ip' ,'JSP', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$crews->owner', '$username', '<a href=\'profile.php?viewuser=$username\'>$username</a> sent your gang ".makecomma($send_amount)." JSP.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "fmj"){ 

if ($send_amount > $fetch2->fmj){ 

echo "You do not have that much FMJ to send.";

}elseif ($send_amount <= $fetch2->fmj){

mysqli_query( $connection, "UPDATE accounts SET fmj=fmj-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE crews SET fmj=fmj+$send_amount WHERE name='$to_person'");

echo "You sent ".makecomma($send_amount)." FMJ to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '1', '$ip' ,'fmj', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$crews->owner', '$username', '<a href=\'profile.php?viewing=$username\'>$username</a> sent your gang ".makecomma($send_amount)." FMJ.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}



elseif ($type == "jhp"){ 

if ($send_amount > $fetch2->jhp){ 

echo "You do not have that much JHP to send.";

}elseif ($send_amount <= $fetch2->jhp){

mysqli_query( $connection, "UPDATE accounts SET jhp=jhp-$send_amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE crews SET jhp=jhp+$send_amount WHERE name='$to_person'");

echo "You sent ".makecomma($send_amount)." JHP to $to_person."; 

mysqli_query( $connection, "INSERT INTO `transfers` ( `id` , `to` , `from` , `amount` , `date`, `crew`, `ip`, `type`, `ip2`) 

VALUES ('', '$to_person', '$username', '$send_amount', '$gmt_time', '1', '$ip' ,'jhp', '$to_user->l_ip');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)

VALUES ('', '$crews->owner', '$username', '<a href=\'profile.php?viewing=$username\'>$username</a> sent your gang ".makecomma($send_amount)." JHP.', 'Bank Statement', '$gmt_time', '0');") or die (mysqli_error()); }}

}

}}}}}}  

?>
</table>
<br>
</form>

<?php

}elseif($page == "deposit"){







$place = mysqli_query( $connection, "SELECT money, bank, banktime, username, intrest, collect, days FROM accounts WHERE username='$username'");

while($success = mysqli_fetch_row($place)){

	$money = $success[0];

	$bank = $success[1];

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

$nmoney =  $initr * $bank / 100;

$moneyinbanke = $bank + ($nmoney * $days);

$moneyinbanke= round($moneyinbanke); 





	mysqli_query( $connection, "UPDATE accounts SET bank = '$moneyinbanke' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET banktime = '0', collect='1' WHERE username='$username'");





}

	if($_POST['withdraw']){

	mysqli_query( $connection, "UPDATE accounts SET money=money+bank WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET bank='0', collect='0', days='0' WHERE username='$username'");

    echo "You successfully withdrew &pound;".makecomma($bank)."";

    echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php?page=3\">";

}

$dep = $_POST['dep'];

$das = $_POST['das'];

if($_POST['deposit']){

	if (!$dep){

	echo "You did not choose an ammount to be deposited.";

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



	$ha = (3600*24) * $das;

		

			$timewait=time()+ $ha;

	mysqli_query( $connection, "UPDATE accounts SET money = '$samoney' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET bank = '$bmoney' WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET intrest = '$intrest' WHERE username='$username'");

	mysqli_query( $connection, "UPDATE accounts SET banktime = '$timewait', days='$das' WHERE username='$username'");

echo "Money deposited.";

echo "<meta http-equiv=\"refresh\" content=\"0;URL=bank.php?page=deposit\">";

}}}}}

?>

<form action="" method="post">



<center>

<table width=45% border=0 cellpadding=2 cellspacing=0 bordercolor=black  class=thinline>

<tr>

  <td height="22" colspan=2 align=center  class="topic"><font color=#FFFFFF><b>Bank Account/Balance</b></font></td>

</tr>

  

<tr><td width="42%" class="tableborder">Bank Account:</td><td width="58%"><?php echo "&pound;".makecomma($bank).""; ?></td></tr>

<tr>

  <td class="tableborder">Interest Gained:</td>

  <td class="tableborder"><?php if($collect == "1"){ echo"Collect Money"; }else{

  $nmoney =  ($initr) * ($bank / 100) * ($days);

  $nmoney = round($nmoney);

echo "&pound;".makecomma($nmoney)."";  }

  ?></td>

</tr>

<tr>

  <td class="tableborder">Time Left:</td>

  <td class="tableborder"><?php if($bank == "0"){ echo"None"; }else{ if ($last <= 0){ echo "None"; }else{ echo "".maketime($last).""; }} ?></td>

</tr>

<tr>

<td align=center>&nbsp;</td>

<td align=center>&nbsp;</td>

</tr>

<tr>

  <td class="tableborder" colspan="2" align=center><?php if ($bank > 0){ echo "<input type=\"submit\" class=custombutton name=withdraw value=\"Withdraw\">"; }else{ echo "

  <select name=\"das\" id=\"select\" class=\"textbox\">

      <option value=\"1\" selected=selected>1 Day</option>

           <option value=\"2\">2 Days</option>

           <option value=\"3\">3 Days</option>

		              <option value=\"4\">4 Days</option>

           <option value=\"5\">5 Days</option>           <option value=\"6\">6 Days</option>

           <option value=\"7\">7 Days</option>

     </select><br>

  <br>&pound;<input maxlength='11' name=dep size=10 type=text class=\"textbox\">  &nbsp; <input type=submit class=custombutton name=deposit value='Deposit'>"; } ?>    </td>

  </tr>

</table>     

</center>

</form>

<p>

</td>&nbsp;&nbsp;&nbsp;<td width=10>&nbsp;</td>

<td width=100%>



<table width=51% border=0 align="center" cellpadding=2 cellspacing=0 bordercolor=black  class=thinline>

  <tr>

<td height="22" colspan=3 align=center   class="topic"><font color=#FFFFFF><b>Intrest Table</b></font></td>

  </tr>

<tr class="topic">

<td width=26% height="22" align=center><u>Intrest</u></td>

<td width=41% height="22" align=center><u>From</u></td>

<td width=33% height="22" align=center><u>To</u></td>

</tr>	



<tr>

  <td align="center" class="tableborder">2%</a></td> 

  <td align="center" class="tableborder">&pound;1</td> 

<td align="center" class="tableborder">&pound;50,000,000</td>

</tr>

<tr>

  <td align="center" class="tableborder">1.5%</a></td> 

  <td align="center" class="tableborder">&pound;50,000,000</td> 

<td align="center" class="tableborder">&pound;124,999,999</td>

</tr>

<tr>

  <td align="center" class="tableborder">1%</a></td> 

<td align="center" class="tableborder">&pound;250,000,000</td> 

<td align="center" class="tableborder">&pound;499,999,999</td>

</tr>

<tr>

  <td align="center" class="tableborder">0.5%</a></td> 

<td align="center" class="tableborder">&pound;500,000,000</td> 

<td align="center" class="tableborder">&pound;1,000,000,000</td>

</tr>

</table>

<p>















<?php } ?>

<tr><br>
<br>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="tableborder"><div align="center" class="style1">      <p align="center">This is the banks page. You can make a lot of transactions, deposits and transfers through this page. Instead of going all the way through the deal page, you can send money straight from your bank account. You can also send money to your gangs stash, by checking the "Gang" checkbox when sending money.</p>

      <p align="center"><font color="#FF0000"><b>On each transaction made, whether it be to a player or gang, you will be charged <?php echo"$tax"; ?>% tax.</b></font> </p>

      <p align="center">To enter a page, you need to use the little navigation bar at the bottom of the page, this shall navigate through each page. Transferring items and money shall help to transact your account, whilst your bank balance and account is to help keep track of your money payments and anything of that sort.</p></div></td></tr></table></td></tr></table></td></tr></table>
   
    </td>



  </tr>

</table>



<?php echo ""; include_once"incfiles/foot.php"; ?></body>

</html>