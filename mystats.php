<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$query1=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");
$info=mysqli_fetch_object($query1);
?>

<html>
<head>
<title>Inventory</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<?php $stats = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$username'")); ?>

<table align="center" width="59%" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient"><?php echo "$fetch->username"; ?>'s Stats</td></tr>

  
<tr>
<td class="tableborder" align="right">Username:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "$fetch->username"; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Forum Posts:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "$fetch->posts"; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Cash:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "&#163;".makecomma($fetch->money).""; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Credits:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($fetch->credits).""; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Your Rank:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "$fetch->rank"; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Gang:</td>
<td class="tableborder" align="left" colspan="2"><?php if ($fetch->crew == "0" || $fetch->crew == "") { echo "No Crew"; }elseif ($fetch->crew !== "0" || $fetch->crew !== "") { echo "$fetch->crew"; } ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Experience:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($fetch->rankpoints)."xp"; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Location:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "$fetch->location"; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Number Of Kills:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($info->kill_skill).""; ?></td>
</tr>
 

<tr>
<td class="tableborder" align="right">Succesfull Jail Breaks:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($info->busts).""; ?></td>
</tr>
  
<tr>
<td class="tableborder" align="right">Number Of Crimes:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($info->crimes).""; ?></td>
</tr>

<tr>
<td class="tableborder" align="right">Number Of GTA's:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "".makecomma($info->gtas).""; ?></td>
</tr>

<tr>
<td class="tableborder" align="right">Registration Date:</td>
<td class="tableborder" align="left" colspan="2"><?php echo "$fetch->regged"; ?></td>
</tr>

</table>

<br>
<table align="center" width="59%" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient">Last 10 Attacks You Attempted</td></tr>
<tr> 
<td class="tableborder" width="33%"><div align="center">Target</div></td>
<td class="tableborder" width="34%"><div align="center">Date Attacked </div></td>
<td class="tableborder" width="33%"><div align="center">Bullets Used </div></td>
</tr>

<?php
$attempts_on_u1=mysqli_query( $connection, "SELECT * FROM attempts WHERE username='$username' ORDER BY date DESC LIMIT 10");
while($fucker1=mysqli_fetch_object($attempts_on_u1)){
echo "
<tr>
<td class=\"tableborder\" align=\"center\"><b>$fucker1->target</b></td>
<td class=\"tableborder\" align=\"center\"><b>$fucker1->date</b></td>
<td class=\"tableborder\" align=\"center\"><b>".makecomma($fucker1->bullets)."</b></td>
</tr>"; } ?>
</table><br />
<table align="center" width="59%" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" class="gradient">Last 10 attempts on your life</td></tr>
<tr> 
<td class="tableborder" width="33%"><span class="style4"><center>Username</center></span></td>
<td class="tableborder" width="33%"><span class="style4"><center>Date Attacked</center></span></td>
<td class="tableborder" width="33%"><span class="style4"><center>Bullets Used</center></span></td>
</tr>
<?php
$attempts_on_u1=mysqli_query( $connection, "SELECT * FROM attempts WHERE target='$username' ORDER BY date DESC LIMIT 10");
while($fucker1=mysqli_fetch_object($attempts_on_u1)){
echo "
<tr>
<td class=\"tableborder\" align=\"center\"><b>$fucker1->username</b></td>
<td class=\"tableborder\" align=\"center\"><b>$fucker1->date</b></td>
<td class=\"tableborder\" align=\"center\"><b>".makecomma($fucker1->bullets)."</b></td>
</tr>"; } ?>
</table>


<?php include_once"incfiles/foot.php"; ?>
</body>
</html>
              
