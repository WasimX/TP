<?php
include_once "incfiles/func.php";
logincheck();
$query=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username' LIMIT 1");
$info = mysqli_fetch_object($query);
$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$fetch = mysqli_fetch_object($query1);
?>
<?php
if ($_POST['rr'] && strip_tags($_POST['oldname']) && strip_tags($_POST['oldpassword'])){
$oldname = addslashes(strip_tags($_POST['oldname']));
$oldpassword = addslashes(strip_tags($_POST['oldpassword']));


$sql = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$oldname' AND password='$oldpassword' AND status='Dead' LIMIT 1");
$login_check = mysqli_num_rows($sql);
$inf = mysqli_fetch_object($sql);

if($login_check == "0"){
echo"No such account OR the account isnt dead.";
}elseif($login_check != "0"){

if($inf->oacn == "0"){
echo"There are no fugi kills on that account.";
}elseif($inf->points != "0"){

if($inf->userban2 == "1"){
echo"You cannot move mercenary status from a userbanned account.";
}elseif($inf->userban2 != "1"){

mysqli_query( $connection, "UPDATE accounts SET oacn=oacn+$inf->oacn WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET oacn='0' WHERE username='$oldname'");
mysqli_query( $connection, "UPDATE Swiss SET username='$username' WHERE username='$oldname'");
echo"Fugitive kills moved.";
}}}}
 ?>
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<a href="../fugi.php">Go Back!</a>
<form id="form1" name="form1" method="post" action="">
  <table width="20%" cellspacing="0" cellpadding="2" border="0" class="table1px" align="center">
    <tr class="gradient">
      <td width="232" height="22" colspan="2" class="gradient"><div align="center"><strong>Move Fugitive Kills</strong></div></td>
    </tr>
    <tr>
      <td><center><br>
          <div align="center">
            <table class="table1px" width="340" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td class="table1px" width="112"><div align="right">Old Username:</div></td>
                <td class="table1px" width="218"><span class="style1">
                  <input name="oldname" type="text" class="textbox" id="oldname" />
                </span></td>
              </tr>
              <tr>
                <td class="table1px"><div align="right">Old Password:</div></td>
                <td class="table1px"><span class="style1">
                  <input name="oldpassword" type="password" class="textbox" id="oldpassword" />
                </span></td>
              </tr>
              <tr>
                <td class="table1px" colspan="2"><div align="center">
                    <input type="submit" class="custombutton" name="rr" id="rr" value="Move!" />
                </div></td>
              </tr>
            </table>
            <?php
if ($_POST['rr'] && strip_tags($_POST['oldname']) && strip_tags($_POST['oldpassword'])){
$oldname = addslashes(strip_tags($_POST['oldname']));
$oldpassword = addslashes(strip_tags($_POST['oldpassword']));


$sql = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$oldname' AND password='$oldpassword' AND status='Dead' LIMIT 1");
$login_check = mysqli_num_rows($sql);
$inf = mysqli_fetch_object($sql);


if($login_check == "0"){
echo"No such account OR the account is still alive.";
}elseif($login_check != "0"){

if($inf->oacn == "0"){
echo"There are no fugitive kills on that account.";
}elseif($inf->oacn != "0"){

if($inf->userban2 == "1"){
echo"You cannot move fugitive status from a userbanned account.";
}elseif($inf->userban2 != "1"){

mysqli_query( $connection, "UPDATE accounts SET oacn=oacn+$inf->oacn WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET oacn='0' WHERE username='$oldname'");
mysqli_query( $connection, "INSERT INTO `creditmove` ( `id`, `olduser`, `newuser`, `amount`, `ip` ) 
VALUES ('', '$oldname', '$username', '$inf->points', '$ip')");
die("$inf->oacn kills have been moved to your account.");
}}}}
 ?>
          </div>
      </center></td>
    </tr>
  </table>
</form>
<?php include_once "incfiles/foot.php"; ?>