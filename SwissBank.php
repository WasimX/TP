<?php
session_start();
$username=$_SESSION['username'];
include_once"incfiles/connectdb.php";
include_once"incfiles/func.php"; 
logincheck();
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$check2=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM Swiss WHERE username='$username' AND type='Money'"));
$bank=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM Swiss WHERE username='$username' AND type='Money'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

if((($fetch->oacn * 1000) >= 20) && $check2 == "0") { 

if($_POST['create']){
if((($fetch->oacn * 1000) >= 20) && $check2 == "0") { 


mysqli_query( $connection, "INSERT INTO `Swiss` ( `id` , `username` , `type` )

VALUES ('', '$username', 'Money')");
echo"You now own one!";
}}
?>
<link href="style.css" rel="stylesheet" type="text/css"> 
<form id="form1" name="form1" method="post" action="">
    <table width="30%" border="1" cellpadding='2' align="center" cellspacing='0' class='table1px'>
      <tr>
        <td class='gradient' height='22'><div align="center">Create a Swiss</div></td>
      </tr>
      <tr>
        <td align='center' class='content'>
          <p>
              <input type='submit' name='create' class='custombutton' value='Submit' />
            </p>
          <p> </p></td>
      </tr>
    </table>
    </form>
<?php exit(); } 
if($check2 == "0"){ exit('<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>You Need To Kill 20+ Fugitives To Unlock This Feature!</div>'); }
?>


<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css"> 
<title>Thug Paradise :: Swiss Bank</title>

  <style type="text/css">

<!--

.style1 {color: #000000}
.style2 {color: #000000; font-weight: bold; }
.style3 {font-size: 12px}
.style4 {color: #FF0000}

-->

  </style>

</head>



<body>



<div align="center">
  <table width="500">
    <tr>
      <td height="100" background="images/Swiss.png"><p align="center" class="style2 style3"><br></br>You currently have &pound;<?php echo"".makecomma($bank->money)."";?> deposited in your Swiss Bank account.</p>
          <p align="center" class="style1">&nbsp;</p>
</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <table width="30%" border="1" cellpadding='2' cellspacing='0' class='table1px'>
      <tr>
        <td class='gradient'><div align="center">Account Options</div></td>
      </tr>
      <tr>
        <td align='center' class='content'><p> Amount:
          <input id='valu' type='text' name='valu' class='text' style="border:1px solid #000000; background:#FFFFFF;" />
          </p>
            <p>Alter Type:
              <select name='atype' class='text' style="border:1px solid #000000; background:#FFFFFF;">
                  <option value="Withdraw">Withdraw</option>
                  <option value='Deposit'>Deposit</option>
                </select>
          </p>
          <p>
              <input type='submit' name='asub' class='custombutton' value='Submit' />
            </p>
          <p><?php 
         if($_POST['asub']){ 

		
				   $val = addslashes($_POST['valu']);


				  	  $atype = addslashes($_POST['atype']);
$checkk = "Money";
				

			  

			$chekkky=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM Swiss WHERE username='$username' AND type='Money'"));

$chekkky2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM Swiss WHERE username='$username' AND type='Money'"));

$feAliv=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$chekkky2->username'"));

if($chekkky == "0"){ echo"No such account, or details are false!"; }else{	  

if($atype == "Withdraw"){ 

		

if ($val <= 0 || !$val || ereg('[^0-9]',$val)){

print "You cant withdraw that amount."; 

}elseif ($val != 0 || $val || !ereg('[^0-9]',$val)){



$val2 = (round($val * 0.000) + $val);


		if($chekkky2->money < $val2){ echo"There is not that much in the Bank, don't forget the 0% tax which makes it &pound;".makecomma($val2).".";		}elseif($chekkky2->money >= $val2){

		mysqli_query( $connection, "UPDATE `Swiss` SET money=money-$val2 WHERE username='$username'");

		mysqli_query( $connection, "UPDATE `accounts` SET money=money+$val WHERE username='$username'");

		$new = $chekkky2->money - $val2;

        echo"You've withdrew &pound;".makecomma($val)." you now have &pound;".makecomma($new)." left.";

		}}}elseif($atype == "Deposit"){  	  

			  

        

if ($val <= 0 || !$val || ereg('[^0-9]',$val)){

print "You cant withdraw that amount."; 

}elseif ($val != 0 || $val || !ereg('[^0-9]',$val)){



		$new = $chekkky2->money + $val;

		

		if($new > "20000000000"){ echo"You can't deposit that much."; }else{

		
		if($fetch->money < $val){ echo"You have not got that much to deposit.";		}elseif($fetch->money >= $val){

		

		mysqli_query( $connection, "UPDATE `Swiss` SET money=money+$val  WHERE username='$username'");

		mysqli_query( $connection, "UPDATE `accounts` SET money=money-$val WHERE username='$username'");

			

        echo"You've deposited &pound;".makecomma($val)." the bank now has &pound;".makecomma($new).".";

		

		}}}}}}?>
             
          </p></td>
      </tr>
    </table>
    </form>
  <p>&nbsp;</p>
<table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center"><p>Swiss Banks are not to be sold, swapped or given to anyone under any circumstances. You cannot deposit more than £20,000,000,000.
<br>
<font color=red>WARNING:</font> All withdrawals and deposits are logged along with moving the Swiss Bank to your new account.</p></div></td></tr></table></td></tr></table></td></tr></table>

<?php include_once"incfiles/foot.php"; ?>
  <p>&nbsp;</p>
</div>
</body>