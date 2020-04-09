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
<table align="center" width="500" cellpadding="0" cellspacing="0" class="table1px">
  <tr>
    <td width="33%" class="gradient" align="center">Name</td>
    <td width="33%" class="gradient" align="center">Type</td>
	<td width="33%" class="gradient" align="center">Quantity</td>
  </tr>
  <?php if ($fetch->fmj > "0"){ ?> 
<tr>
<td class="tableborder" align="center">FMJ</td>
<td class="tableborder" align="center">Ammo</td>
<td class="tableborder" align="center"><?php echo "".makecomma($fetch->fmj).""; ?></td>
</tr>
<?php } if ($fetch->jhp > "0"){ ?>
  <tr>
<td class="tableborder" align="center">JHP</td>
<td class="tableborder" align="center">Ammo</td>
<td class="tableborder" align="center"><?php echo "".makecomma($fetch->jhp).""; ?></td>
  </tr>
<?php } if ($stats->Heltmet > "0"){ ?>
<tr>
<td class="tableborder" align="center">Helmet</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->Helmet"; ?></td>
</tr>
<?php } if ($stats->Ballistic > "0"){ ?>
<tr>
<td class="tableborder" align="center">Ballistic</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->Ballistic"; ?></td>
</tr>
<?php } if ($stats->ChainMail > "0"){ ?>
<tr>
<td class="tableborder" align="center">ChainMail</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->ChainMail"; ?></td>
</tr>
<?php } if ($stats->StabVest > "0"){ ?>
<tr>
<td class="tableborder" align="center">StabVest</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->StabVest"; ?></td>
</tr>
<?php } if ($stats->MK6 > "0"){ ?>
<tr>
<td class="tableborder" align="center">MK6</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->MK6"; ?></td>
</tr>
<?php } if ($stats->FullMetalJacket > "0"){ ?>
<tr>
<td class="tableborder" align="center">Full Metal Jacket</td>
<td class="tableborder" align="center">Armour</td>
<td class="tableborder" align="center"><?php echo "$stats->FullMetalJacket"; ?></td>
</tr>
<?php } if ($stats->M16A4 > "0"){ ?>
<tr>
<td class="tableborder" align="center">M16A4</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->M16A4"; ?></td>
</tr>
<?php } if ($stats->MP5 > "0"){ ?>
<tr>
<td class="tableborder" align="center">MP5</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->MP5"; ?></td>
</tr>
<?php } if ($stats->P90 > "0"){ ?>
  <tr>
<td class="tableborder" align="center">P90</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->P90"; ?></td>
  </tr>
<?php } if ($stats->PSG1 > "0"){ ?>
<tr>
<td class="tableborder" align="center">PSG1</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->PSG1"; ?></td>
</tr>
<?php } if ($stats->SA80 > "0"){ ?>
<tr>
<td class="tableborder" align="center">SA80</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->SA80"; ?></td>
</tr>
<?php } if ($stats->G36C > "0"){ ?>
<tr>
<td class="tableborder" align="center">G36C</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->G36C"; ?></td>
</tr>
<?php } if ($stats->AWP > "0"){ ?>
<tr>
<td class="tableborder" align="center">AWP</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->AWP"; ?></td>
</tr>
<?php } if ($stats->FAMAS > "0"){ ?>
<tr>
<td class="tableborder" align="center">FAMAS</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->FAMAS"; ?></td>
</tr>
<?php } if ($stats->M82A1 > "0"){ ?>
<tr>
<td class="tableborder" align="center">M82A1</td>
<td class="tableborder" align="center">Weapon</td>
<td class="tableborder" align="center"><?php echo "$stats->M82A1"; ?></td>
</tr>
<?php } if ($fetch->id > "0"){ ?>
<tr bordercolor="#FFFFFF" bgcolor="#999999">
<td height="30" colspan="4" class="gradient"><div align="center">Additional Items </div></td>
</tr>
<?php } if ($info->busts > "9999"){ ?>
<tr>
<td class="tableborder" align="center">Masterminds Gold Key</td>
<td class="tableborder" align="center">Item</td>
<td class="tableborder" align="center">1</td>
</tr>
<?php } if ($info->kill_skill > "39"){ ?>
<tr>
<td class="tableborder" align="center">Personal Snitch</td>
<td class="tableborder" align="center">Item</td>
<td class="tableborder" align="center">1</td>
</tr>
<?php } if ($info->RG > "0"){ ?>
<tr>
<td class="tableborder" align="center">Ricochet Granny</td>
<td class="tableborder" align="center">Item</td>
<td class="tableborder" align="center">1</td>
</tr>
<?php } ?>

</table>
<br>
<br>
<div align="center"><a href="../granny.php"><img src="../images/granny.png" border="0" height="50" width="500"></a></div>

<?php include_once"incfiles/foot.php"; ?>
</body>
</html>
              
