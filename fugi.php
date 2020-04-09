<?php

session_start();

include "incfiles/connectdb.php";

include "incfiles/func.php";

$username=$_SESSION['username'];


$page=strip_tags($_GET['page']);

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$echo=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE username='$username' ORDER BY id DESC LIMIT 1"));

if(!$_GET['page']){ $page=""; 

$currank = $fetch->rank;

$rankcheck=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));
}

if (strip_tags($_POST['Submit'])){

if(isset($_POST['badge'])){ $badge=strip_tags($_POST['badge']);
}
if(isset($_POST['holes'])){
$holes=strip_tags($_POST['holes']);
}

if ($badge == "badge"){ $new_badge="1"; }else{ $new_badge="0"; }

if ($holes == "holes"){ $new_holes="1"; }else{ $new_holes="0"; }

mysqli_query( $connection, "UPDATE accounts SET showbadge='$new_badge' WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET showholes='$new_holes' WHERE username='$username'");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Thug Paradise :: Fugitives</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">a:link{color:#333333;text-decoration:none;}a:visited{color:#333333;text-decoration:none;}a:hover{color:#333333;text-decoration:underline;}a:active{color:#333333;text-decoration:none;}#opacity{position:absolute;width:401px;height:576px;filter:alpha(opacity=75);opacity:.75;background-color:#000000;text-align:center;}#fudge{position:absolute;width:401px;height:576px;text-align:center;}.style1{color:#666666}#mini td{background-image:url(../images/mini_wanted.png);height:202px;width:140px;text-align:center;color:#333333;font-style:italic;vertical-align:middle;}.style2{font-weight:bold color: #33CCFF}body{text-align:center;padding:0;margin:0;}form{padding:5px;margin:0;}#updateWarning{background:red;color:white;text-align:center;width:100%;font-size:14px;font-weight:bold;padding:5px 0;}</style>
</head>
<body>
<form action="" method="post" id="">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="401" valign="top" style="vertical-align: top;"><table width="401" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Fugitives</div></td>
</tr>
<tr>

<td><?php
  if ($rankcheck->id < "6"){
echo "<div id='opacity'>
<div style='margin-top: 340px;'><span style='font-size: 12px;'>You must be ranked at least Gangster<br/>to be considered worthy to kill fugitives.<br/><br/>(A previous account's fugitive progress will<br/>show when you reach the rank of Gangster.)</span></div>
</div>"; }
?>
<div id="fudge">
<div style="margin-top: 340px;">                  <?php if(!$echo){ ?> 
<?php
  if ($rankcheck->id > "5"){
echo "<input name='AshoorBukhariNiBayNiPudi' type='button' class='custombutton' value='Setup Target!' onclick=\"window.location.href='fugi_targets.php'\">"; }
?>
                    <?php }else{ ?> 
                    <?php if($echo->status == "Dead"){ ?>

                    <input type="submit" name="cla" id="button" class="custombutton" value="Claim Items!" />

                   <input name="AshoorBukhariNiBayNiPudi" type="button" class="custombutton" value="Setup Target!" onclick="window.location.href='fugi_targets.php'">

                    <?php

				if($_POST['cla']){

				if($echo->status == "Alive"){

				echo"Your target is Alive still.";

				}else{

				if($echo->claimed == "1"){

				echo"<br><font color='black'>You've already claimed you idiot.</font>";

				}else{

				$emoney = $echo->money;

				$ejhp = $echo->jhp;

				$efmj = $echo->FMJ;

				$nOac = $fetch->oacn + 1;

				mysqli_query( $connection, "UPDATE accounts SET money=money+$emoney, oacn='$nOac' WHERE username='$username'");

								mysqli_query( $connection, "UPDATE OAC_AC SET claimed='1', money='0', jhp='0', FMJ='0' WHERE name='$echo->name'");



				mysqli_query( $connection, "UPDATE accounts SET jhp=jhp+$ejhp, FMJ=FMJ+$efmj WHERE username='$username'");

echo"<br><font color='black'>You claimed for the items. You got &pound;".makecomma($emoney).", ".makecomma($efmj)." FMJ and ".makecomma($ejhp)." jhp.</font>";

				}}}}else{

				 ?><font size="+3"><a href='profile.php?viewing=<?php echo"$echo->name"; ?>&oac=yes'><?php echo"$echo->name"; ?></a></font><br>
                    <?php }} ?> </div>
</div>
<img src="../images/wanted.jpg" alt="Wanted" width="401" height="576"/></td>
</tr>

<tr>
<td>
<img src="../images/pixels.gif"/>
</td>
</tr>
</table></td>
<td width="49">&nbsp;</td>
<td width="450" valign="top" style="vertical-align: top;">
<table width="450" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gradient"><div align="center">Killed Fugitives in last 24 hours</div></td>
</tr>
<tr>
<td bgcolor="#000000">
<div style="height: 404px;overflow: auto;">
<table width="420" border="0" align="left" cellpadding="0" cellspacing="0" id="mini">

<tr>
<?php $num = 1; $mysqli1 = mysqli_query( $connection, "SELECT * FROM `OAC_AC` WHERE `status`='Dead' ORDER by death DESC");

if($num == "1"){ echo"<tr>"; }

 while($get = mysqli_fetch_object($mysqli1)){?>

<td valign='middle'><span style='font-size: 14px;font-weight: bold;'><a href="profile.php?viewing=<?php echo"$get->name"; ?>&amp;oac=yes" >  <?php echo"$get->name"; ?> </a></span><br/>

<br/><span style='font-size: 10px;'>was killed by</span><br/><span style='font-size: 13px;'>
<a href="profile.php?viewing=<?php echo"$get->username"; ?>"> <?php echo"$get->username"; ?> </a> </span><br/><br/><span style='font-size: 10px;'>on<br/>
                    <?php echo"$get->death"; ?></span></td>








<?php $num = $num + 1; if($num == "4"){ echo"</tr>"; $num = "1"; } } $percent2 = (($fetch->oacn) / 20) * 100; $percent1 = 100 - $percent2; ?>











</tr><td style="background-image: none;">&nbsp;</td></tr> </table>
</div>
</td>
</tr>
</table>
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" class="gradient"><div align="center">Earning Mercenary</div></td>
</tr>
<tr>
        <?php if(($fetch->oacn) >= 20){ ?>
<td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="<?php echo"$percent2"; ?>%" bgcolor="#990000"><img src="../images/pixels.gif"/></td>
<td width="<?php echo"$percent1"; ?>%" bgcolor="#333333"><img src="../images/pixels.gif"/></td>
</tr>
</table>
</tr>
<td colspan="2" class="tableborder"><div align="center">

Bullets on Profile? <input type="checkbox" name="holes" value="holes" <?php if($fetch->showholes == "1"){ echo"checked";}?> ><br><br>
Mercenary Badge? <input type="checkbox" name="badge" value="badge" <?php if($fetch->showbadge == "1"){ echo"checked";}?> ><br><br>
<input type="submit" name="Submit" class="custombutton" value="Update Profile" id="Submit"><br><br>

You currently have <b><?php print ($fetch->oacn); ?></b> fugitive kills.<br/>
         <br> <font size="2">You have achieved your goal of becoming a Mercenary.<br />
            Click <a href="SwissBank.php"><img src="../images/here.png"></a> to access your Swiss bank.</font></td>
</tr>
</table>

        <?php }else{ ?>
<td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="<?php echo"$percent2"; ?>%" bgcolor="#990000"><img src="../images/pixels.gif"/></td>
<td width="<?php echo"$percent1"; ?>%" bgcolor="#333333"><img src="../images/pixels.gif"/></td>
</tr>
</table>
</tr>
<td colspan="2" class="tableborder"><div align="center">You are <b><?php print ($fetch->oacn); ?> / 20</b> fugitive kills from becoming a Mercenary.<br/>
<span class="style1"><br/>
Upon becoming a Mercenary you will receive the rank on<br/>
your profile and a Swiss bank account, removing tax on <br/>
money transfers.<br/>
<br/>
Mercenary progress and Swiss bank can be transferred to<br/> 
a new account if you are murdered. Click <a href="fugi_move.php"><img src="images/here.png"></a> to move them.</span>
</div></td>
</tr>
</table><?php } ?>
</td>
</tr>
</table>
<br/>
<br/>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="50" height="62" class="tableborder"><div align="left"><img src="images/questionmark.jpg" alt="Question" width="49" height="46"/></div></td>
<td width="450" valign="middle" class="tableborder"><div align="center" class="style2">Not everyone is cut out to be a Gangster. But those who left the life behind, who thought they could just leave their responsibilities behind and forget about it, were right to leave quietly, to try and escape while they could.<br/>
<br/>
These fugitives were wrong to think they could get away with it.<br/>
<br/>
Once a day, at midnight (TP Time), the wanted posters are updated with these TP deserters, and you choose if you wish to take them out.<br/>
<br/>
It's not likely they'll be much competition, <br/>
the streets are filled with pussies, wanted <br/>
posters are rarely the same.<br/>
<br/>
After killing your target, you're free to take all they own, and we'll <br/>
thrown in a few additional bullets and a gun, to keep you firing.<br/>
<br/>
<a href="#">Fugitives Tutorial</a></div></td>
</tr>
</table>
</form>
<?php include_once "incfiles/foot.php"; ?></body>
</html>