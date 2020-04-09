<?php 
session_start(); 
include_once"incfiles/connectdb.php"; 
include_once"incfiles/func.php"; 
logincheck(); 
$username=$_SESSION['username'];

$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch2= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$gmt_time = gmdate('Y-m-d h:i:s');
if(!$_GET['page']){ $page="1"; }

if ($info->rewardtime  > time()){

$left = $info->rewardtime - time();

echo "<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=\"errorMsg\" class=\"repeatable\">You Have Claimed For Today's Reward Please Wait ".maketime($info->rewardtime )." Thanks!</div><br/><br/>";

exit();

}

?>

<?php
if($_POST['buttonx']){
$Chance = rand(1,3);
$time= time() + (60*180);

if($Chance == "1"){
mysqli_query( $connection, "UPDATE accounts SET credits=credits+15 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET reward=reward+1 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET rewardtime='$time' WHERE username='$username'");
$message = "You were rewarded with 15 credits";
}

if($Chance == "2"){
mysqli_query( $connection, "UPDATE accounts SET money=money+25000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET reward=reward+1 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET rewardtime='$time' WHERE username='$username'");
$message = "You were rewarded with £25,000,000";
}

if($Chance == "3"){
mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+500 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET reward=reward+1 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET rewardtime='$time' WHERE username='$username'");
$message = "You were rewarded with 500 rankpoints";
}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thug Paradise :: Rewards</title></head>
<link href="style.css" rel="stylesheet" type="text/css" /><div align="center">

<body>

 <body>
<div align="center">
<table border="0" align="center" cellpadding="10" cellspacing="0" bordercolor="black">
<tr>
<td valign="top" align="center">
<table height="175" width="400" border="0" align="center" cellpadding="3" class="table1px" bgcolor='#000000' cellspacing="0" bordercolor="black">
    <tr>
      <td class="gradient" height="22">
        Daily Rewards
      </center></td>
    </tr>
    <tr>
      <td align="center" style="padding: 10px;" class="table1px">Rewards have been set up for new players that have joined TP and the rewards will only last a week then the rewards system will be removed, but until then the prizes are:<br>
<ul><li>15 Credits</li> <li>£25,000,000</li> <li>500 Rankpoints</li></td>
    </tr>
  </table>
  <center>
  <br><br><h1><font size="4"><?php echo"$message"; ?></font></h1>  </td>
  <td valign="top">

  <table width="30%" border="0" align="center" cellpadding="3" class="table1px" cellspacing="0" bordercolor="black">
    <tr>
      <td height="22" class="gradient">
       Rewards!
      </td>
    </tr>
    <tr>
      <td align="center" class="tableborder"><p><img src=../images/moneycase.png><br>Lets see what you get for playing Thug Paradise!</p>
        <form id="form1" name="form1" method="post" action="">
          <label>
          <input name="buttonx" type="submit" class="custombutton" id="buttonx" value="Claim Reward!" />
          </label>
          
        </form>        </td>
    </tr>
  </table>
  </td></tr></table>
</div>
</body>
</html>
<?php require_once "incfiles/foot.php"; ?>