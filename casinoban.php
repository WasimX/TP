<?php session_start();

include "incfiles/connectdb.php";
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
$accpassword = $fetch->password;
$bantime=(3600*12)+time(); 

if ($fetch->casinoban > time()){
die("You need to wait ".maketime($fetch->casinoban)." before you can ban yourself again.");
}

if ($_POST['Submit'] && strip_tags($_POST['password'])){
$password = addslashes(strip_tags($_POST['password']));
$amount = addslashes(strip_tags($_POST['amount']));

$bantime=(3600*$amount)+time(); 
 
if ($password == "$accpassword") {
mysqli_query( $connection, "UPDATE accounts SET casinoban='$bantime' WHERE username='$username'"); 
echo "You are now banned from the casino for $amount hours."; 

}else{  

echo "The password you entered is incorrect."; }} ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<div align="center">
<table width="45%" height="71" border="1" align="center" cellpadding="0" cellspacing="0"  rules="none" class="table1px">
    <tr>
      <td width="69%" height="30" class="gradient"><center>
          <b>Gamblers Anonymous</b>
      </center></td>
    </tr>
    <tr bgcolor="black">
      <td height="1" colspan="3"></td>
    </tr>
    <tr>
      <td height="28" ><div align="center">
        <p>Have you got yourself addicted to the casino's and need a way to stop yourself from betting? Here you can ban yourself from the casino's for upto 48 hours. Once you have banned yourself, you cannot be un-banned. So please make sure you are 100% sure that you want to ban yourself. Once banned, you cannot un-ban yourself.</p>
        <p>Please fill in the form below to ban yourself from the casino.</p>
        <form id="form1" name="form1" method="post" action="">
          <p>
            <label>
            <select class="textbox" name="amount" id="amount">
              <option value="1">1 Hour</option>
              <option value="2">2 Hours</option>
              <option value="3">3 Hours</option>
              <option value="4">4 Hours</option>
              <option value="5">5 Hours</option>
              <option value="6">6 Hours</option>
              <option value="7">7 Hours</option>
              <option value="8">8 Hours</option>
              <option value="9">9 Hours</option>
              <option value="10">10 Hours</option>
              <option value="12">12 Hours</option>
              <option value="24">24 Hours</option>
              <option value="48">48 Hours</option>
            </select>
            </label>
          </p>
          <p>Password:
            <label>
              <input name="password" type="password" class="textbox" id="password" />
              </label>
          </p>
          <p>
            <label>
            <input name="Submit" type="submit" class="custombutton" id="Submit" value="Stop Betting!" />
            </label>
          </p>
<span class="warning">DO NOT COMPLAIN TO ADMIN OR MODS IF YOU CHANGE YOUR MIND.<br>
You will not be removed. </span>
          </form>
        </div></td>
    </tr>
  </table>
</div>
<?php include_once"incfiles/foot.php"; ?>
