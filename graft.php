<?php
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username = $_SESSION['username'];
logincheck();
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$date = gmdate('Y-m-d H:i:S');
$rank=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));
?>

<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: BLACK;
	font-weight: bold;
}
-->
</style>
<title>Thug Paradise :: Grafting</title><div align="center">
  <table width="80%" border="0" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td height="22" colspan="4" class="gradient">Grafting!</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">Grafting is a great way to rankup and earn lots of well earned treats! The reward you receive will match the work you have carried out. To receive your reward to the task, refresh TP, then visit this page again and your reward will be added to your account. Upon completing all of these, you shall have an option to add bullet holes to your profile! </div></td>
     </tr>
    </table>
    <br>
<table cellpadding="2" cellspacing="0">
   <tr><td>
       <table width="550" border="0" cellpadding="2" cellspacing="0" class="table1px">
   <tr>
      <td height="22" colspan="4" class="gradient"><div align="center"> RANK RELATED WORK</div></td>
    </tr>
    <tr>
      <td height="25%" bgcolor="white"><div align="center" class="style1">EMPLOYER</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">TASK</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">REWARD</div></td>
      <td bgcolor="white"><div align="center" class="style1">STATUS</div></td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>Vandal</strong>.</td>
      <td class="table1px">&pound;10,000,000</td>
      <td class="table1px"><?php if($rank->id < 3){
echo "<font color=#990000>Incomplete!</font>";
}elseif($rank->id >= 3){
if($fetch->r1 == "1"){ $col = "<a href='graftreward.php?claim=r1'>Claim Reward</a>"; }elseif($fetch->r1 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";
} ?>&nbsp;</td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>Gangster</strong>.</td>
      <td class="table1px">&pound;25,000,000</td>
      <td class="table1px"><?php if($rank->id < 6){
echo "<font color=#990000>Incomplete!</font>";
}elseif($rank->id >= 6){
if($fetch->r2 == "1"){ $col = "<a href='graftreward.php?claim=r2'>Claim Reward</a>"; }elseif($fetch->r2 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";
} ?></td>
    </tr>
    <tr>
      <td class="table1px">Buggsy Siegel<br></td>
      <td class="table1px"><strong>Boss</strong>.</td>
      <td class="table1px">&pound;50,000,000</td>
      <td class="table1px"><?php if($rank->id < 9){
echo "<font color=#990000>Incomplete!</font>";
}elseif($rank->id >= 8){
if($fetch->r3 == "1"){ $col = "<a href='graftreward.php?claim=r3'>Claim Reward</a>"; }elseif($fetch->r3 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";
} ?></td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>Godfather</strong>.</td>
      <td class="table1px">&pound;75,000,000</td>
      <td class="table1px"><?php if($rank->id < 12){
echo "<font color=#990000>Incomplete!</font>";
}elseif($rank->id >= 12){
if($fetch->r4 == "1"){ $col = "<a href='graftreward.php?claim=r4'>Claim Reward</a>"; }elseif($fetch->r4 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";
} ?></td>
    </tr>
    <tr>
      <td class="table1px">Buggsy Siegel<br></td>
      <td class="table1px"><strong>Official TP Legend</strong>.</td>
      <td class="table1px">&pound;125,000,000</td>
      <td class="table1px"><?php if($rank->id != 17){
echo "<font color=#990000>Incomplete!</font>";
}elseif($rank->id == 17){
if($fetch->r5 == "1"){ $col = "<a href='graftreward.php?claim=r5'>Claim Reward</a>"; }elseif($fetch->r5 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";
} ?></td>
        </tr>
        </table>
    <br>
   <table width="550" border="0" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td height="22" colspan="4" class="gradient"><div align="center">CRIME RELATED WORK</div></td>
    </tr>
    <tr>
      <td height="25%" bgcolor="white"><div align="center" class="style1">EMPLOYER</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">TASK</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">REWARD</div></td>
      <td bgcolor="white"><div align="center" class="style1">STATUS</div></td>
    </tr>
    <tr>
      <td class="table1px">Jimmy Hoffa</td>
      <td class="table1px"><strong>300 Crime</strong>s.</td>
      <td class="table1px">&pound;25,000,000</td>
      <td class="table1px"><?php if($fetch2->crimes < 300){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->crimes >= 300){
	  if($fetch->c1 == "1"){ $col = "<a href='graftreward.php?claim=c1'>Claim Reward</a>"; }elseif($fetch->c1 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";

} ?></td>
    </tr>
    <tr>
      <td class="table1px">Buggsy Siegel</td>
      <td class="table1px"><strong>300 Grand Theft Auto's</strong>.</td>
      <td class="table1px">&pound;25,000,000</td>
      <td class="table1px"><?php if($fetch2->gtas < 300){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->gtas >= 300){
if($fetch->c2 == "1"){ $col = "<a href='graftreward.php?claim=c2'>Claim Reward</a>"; }elseif($fetch->c2 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Jimmy Hoffa</td>
      <td class="table1px"><strong>700 Crimes</strong>.</td>
      <td class="table1px">&pound;50,000,000</td>
      <td class="table1px"><?php if($fetch2->crimes < 700){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->crimes >= 700){
if($fetch->c3 == "1"){ $col = "<a href='graftreward.php?claim=c3'>Claim Reward</a>"; }elseif($fetch->c3 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Jimmy Hoffa</td>
      <td class="table1px"><strong>700 Grand Theft Auto's</strong>.</td>
      <td class="table1px">&pound;50,000,000</td>
      <td class="table1px"><?php if($fetch2->gtas < 700){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->gtas >= 700){
if($fetch->c4 == "1"){ $col = "<a href='graftreward.php?claim=c4'>Claim Reward</a>"; }elseif($fetch->c4 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Freddy Puterino</td>
      <td class="table1px"><strong>1,500 Crimes</strong>.</td>
      <td class="table1px">&pound;100,000,000</td>
      <td class="table1px"><?php if($fetch2->crimes < 1500){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->crimes >= 1500){
if($fetch->c5 == "1"){ $col = "<a href='graftreward.php?claim=c5'>Claim Reward</a>"; }elseif($fetch->c5 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
   </tr>
        </table>
        </td>
<td valign=top>
    
    <table width="550" border="0" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td height="22" colspan="4" class="gradient"><div align="center">JAIL RELATED WORK</div></td>
    </tr>
    <tr>
      <td height="25%" bgcolor="white"><div align="center" class="style1">EMPLOYER</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">TASK</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">REWARD</div></td>
      <td bgcolor="white"><div align="center" class="style1">STATUS</div></td>
    </tr>
    <tr>
      <td class="table1px">Freddy Puterino</td>
      <td class="table1px"><strong>500</strong> Jail Bust.</td>
      <td class="table1px">&pound;30,000,000</td>
      <td class="table1px"><?php if($fetch2->busts < 500){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->busts >= 500){
if($fetch->j1 == "1"){ $col = "<a href='graftreward.php?claim=j1'>Claim Reward</a>"; }elseif($fetch->j1 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>2,500</strong> Jail Busts.</td>
      <td class="table1px">&pound;125,000,000</td>
      <td class="table1px"><?php if($fetch2->busts < 2500){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->busts >= 2500){
if($fetch->j2 == "1"){ $col = "<a href='graftreward.php?claim=j2'>Claim Reward</a>"; }elseif($fetch->j2 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Buggsy Siegel</td>
      <td class="table1px"><strong>5,000</strong> Jail Busts.</td>
      <td class="table1px">&pound;250,000,000</td>
      <td class="table1px"><?php if($fetch2->busts < 5000){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->busts >= 5000){
if($fetch->j3 == "1"){ $col = "<a href='graftreward.php?claim=j3'>Claim Reward</a>"; }elseif($fetch->j3 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Teddy Leyatto</td>
      <td class="table1px"><strong>10,000</strong> Jail Busts.</td>
      <td class="table1px">&pound;500,000,000</td>
      <td class="table1px"><?php if($fetch2->busts < 10000){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->busts >= 10000){
if($fetch->j4 == "1"){ $col = "<a href='graftreward.php?claim=j4'>Claim Reward</a>"; }elseif($fetch->j4 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>15,000</strong> Jail Busts.</td>
      <td class="table1px">&pound;750,000,000</td>
      <td class="table1px"><?php if($fetch2->busts < 15000){
echo "<font color=#990000>Incomplete!</font>";
} ?>
      <?php if($fetch2->busts >= 15000){
if($fetch->j5 == "1"){ $col = "<a href='graftreward.php?claim=j5'>Claim Reward</a>"; }elseif($fetch->j5 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
        </table>
    <br>
    <table width="550" border="0" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td height="22" colspan="4" class="gradient"><div align="center">KILL RELATED WORK</div></td>
    </tr>
    <tr>
      <td height="25%" bgcolor="white"><div align="center" class="style1">EMPLOYER</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">TASK</div></td>
      <td height="25%" bgcolor="white"><div align="center" class="style1">REWARD</div></td>
      <td bgcolor="white"><div align="center" class="style1">STATUS</div></td>
    </tr>
    <tr>
      <td class="table1px">Teddy Leyatto</td>
      <td class="table1px"><strong>1</strong> Kill.</td>
      <td class="table1px">5,000 JHP Bullets</td>
      <td class="table1px"><?php if($fetch2->kill_skill < 1){
echo "<font color=#990000>Incomplete!</font>";
} ?>
        <?php if($fetch2->kill_skill >= 1){
if($fetch->k1 == "1"){ $col = "<a href='graftreward.php?claim=k1'>Claim Reward</a>"; }elseif($fetch->k1 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Tio Gremiari</td>
      <td class="table1px"><strong> 5 </strong>Kills.</td>
      <td class="table1px">25,000 JHP Bullets</td>
      <td class="table1px"><?php if($fetch2->kill_skill < 5){
echo "<font color=#990000>Incomplete!</font>";
} ?>
        <?php if($fetch2->kill_skill >= 5){
if($fetch->k2 == "1"){ $col = "<a href='graftreward.php?claim=k2'>Claim Reward</a>"; }elseif($fetch->k2 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Peter Milano</td>
      <td class="table1px"><strong>10</strong> Kills.</td>
      <td class="table1px">50,000 JHP Bullets</td>
      <td class="table1px"><?php if($fetch2->kill_skill < 10){
echo "<font color=#990000>Incomplete!</font>";
} ?>
        <?php if($fetch2->kill_skill >= 10){
if($fetch->k3 == "1"){ $col = "<a href='graftreward.php?claim=k3'>Claim Reward</a>"; }elseif($fetch->k3 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Buggsy Siegel</td>
      <td class="table1px"><strong> 50 </strong>Kills.</td>
      <td class="table1px">250,000 JHP Bullets</td>
      <td class="table1px"><?php if($fetch2->kill_skill < 50){
echo "<font color=#990000>Incomplete!</font>";
} ?>
        <?php if($fetch2->kill_skill >= 50){
if($fetch->k4 == "1"){ $col = "<a href='graftreward.php?claim=k4'>Claim Reward</a>"; }elseif($fetch->k4 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
    <tr>
      <td class="table1px">Teddy Leyatto</td>
      <td class="table1px"><strong>100 </strong> Kills.</td>
      <td class="table1px">500,000 FMJ Bullets &pound;150,000,000</td>
      <td class="table1px"><?php if($fetch2->kill_skill < 100){
echo "<font color=#990000>Incomplete!</font>";
} ?>
        <?php if($fetch2->kill_skill >= 99){
if($fetch->k5 == "1"){ $col = "<a href='graftreward.php?claim=k5'>Claim Reward</a>"; }elseif($fetch->k5 == "0"){ $col = ""; }
echo "<font color=#009900>Completed! $col</font>";} ?></td>
    </tr>
  </table>
</div>