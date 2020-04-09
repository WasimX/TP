<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

include_once "incfiles/alt.php";

logincheck();

$username=$_SESSION['username'];



$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$query3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='$fetch->location'"));

$tax = $query3->tax + 3;


if ($_POST['Buy']){

$rad=($_POST['radio6']);

$buy=mysqli_query( $connection, "SELECT * FROM hitlist WHERE id='$rad'");

if (mysqli_num_rows($buy) != "0"){

$info=mysqli_fetch_object($buy);

$buyout = $info->amount * 3;

if ($buyout > $fetch->money){

echo "<div align='center'>You must have at least £".makecomma($buyout)." to remove that user from the hitlist.</div>"; 



}elseif ($buyout <= $fetch->money){

$new_money = $fetch->money - $buyout;

mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM hitlist WHERE id='$rad'");

echo "<div align='center'>That user was bought out of the hitlist for £".makecomma($buyout)."</div>"; }}}



if (strip_tags($_POST['Submit']) && strip_tags($_POST['target']) && strip_tags($_POST['an']) && strip_tags($_POST['amount']) && strip_tags($_POST['reason'])){

$target=strip_tags($_POST['target']);

$an=strip_tags($_POST['an']);

$amount=intval(strip_tags($_POST['amount']));

$reason=strip_tags($_POST['reason']);

$tax = round(($amount / 100) * $tax);

if ($an == "1" || $an == "2"){

if ($amount == 0 || !$amount || ereg('[^0-9]',$amount)){

 echo "<div align='center'>Invalid amount of money.</div>";



}elseif ($amount != 0 && $amount && !ereg('[^0-9]',$amount)){

if (strtolower($target) == strtolower($username)){

echo "<div align='center'>You can't hitlist yourself.</div>";



}elseif (strtolower($target) != strtolower($username)){

$check=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$target'");

$num=mysqli_num_rows($check);

if ($num == "0"){

echo "<div align='center'>There is no such user with that name.</div>";

}elseif ($num != "0"){

if ($an == "2"){

$total_cost=$amount + 1000000 + $tax;

}else{

$total_cost=$amount + $tax;

}

if ($total_cost > $fetch->money){

echo "<div align='center'>You do not have £".makecomma($total_cost)." to hitlist $target. Remember this includes £".makecomma($tax)." tax.</div>";



}elseif ($total_cost <= $fetch->money){

mysqli_query( $connection, "INSERT INTO `hitlist` ( `id` , `paid` , `target` , `reason` , `amount` , `anonymous` )

VALUES ('', '$username', '$target', '$reason', '$amount', '$an')");

$new_money = $fetch->money - $total_cost;

mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");

$tax2=round(($amount / 100) * $tax2); 
mysqli_query( $connection, "UPDATE gangCountry SET profit=profit+$tax2 WHERE location='$fetch->location'");
mysqli_query( $connection, "UPDATE crews SET money=money+$tax2 WHERE name='$query3->gang'");

echo "<div align='center'>$target was hitlisted for £".makecomma($amount)." successfully. This includes £".makecomma($tax)." from tax.</div>";

 }}}}}} 

 

  if ($_POST['Claim']){

$rad=($_POST['radio6']);

$cla=mysqli_query( $connection, "SELECT * FROM hitlist WHERE id='$rad'");  

if (mysqli_num_rows($cla) != "0"){

$info1=mysqli_fetch_object($cla);    

$attempt=mysqli_query( $connection, "SELECT * FROM attempts WHERE username='$username' AND target='$info1->target' AND outcome='Dead'");  

if (mysqli_num_rows($attempt) == "0"){

echo"<div align='center'>You have not killed this user.</div>";

}elseif (mysqli_num_rows($attempt) != "0"){

$atte=mysqli_fetch_object($attempt);

mysqli_query( $connection, "UPDATE accounts SET money=money+$info1->amount WHERE username='$username'");

echo"<div align='center'>You succesfully claimed £".makecomma($info1->amount)." for $info1->target!</div>";

mysqli_query( $connection, "DELETE FROM hitlist WHERE id='$rad'");

}}}

 

 ?>

<html>

<head>

<link href="style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style4 {color: #000000; font-weight: bold; }
-->
</style>
</head>

<form name="form1" method="post" action="">

  <?php

if ($_POST['rem']){

$rad=($_POST['radio6']);

$cla=mysqli_query( $connection, "SELECT * FROM hitlist WHERE id='$rad'");  

if (mysqli_num_rows($cla) != "0"){

$info1=mysqli_fetch_object($cla);

if($fetch->userlevel != "0" || $fetch->userlevel != "2" || $fetch->userlevel != "3"){

echo"<div align='center'>You've deleted this user from the hitlist.</div>";

mysqli_query( $connection, "DELETE FROM hitlist WHERE id='$rad'");

}elseif($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){

echo"<div align='center'>You can't do this!</div>"; }}}    ?>
    <table width="95%" border="1" align="center" cellspacing="0" bordercolor="#FFFFFF">
<tr>
<td colspan="8"><div align="center" class="gradient">The Hitlist </div></td>
</tr>
<tr>
<td width="15%" class="tableborder"><div align="center">Target</div></td>
<td width="15%" class="tableborder"><div align="center">Reward</div></td>
<td width="45%" class="tableborder"><div align="center">Reason</div></td>
<td width="15%" class="tableborder"><div align="center">Posted By</div></td>
<td width="5%" class="tableborder"><div align="center">Select</div></td>
</tr>


   <?php $query=mysqli_query( $connection, "SELECT * FROM hitlist ORDER by amount DESC");

  $nums =mysqli_num_rows($query);

  if ($nums == "0"){

echo "<tr><td colspan=\"5\" class=\"tableborder\" align=\"center\"><center>There are currently no users on the hitlist.</center></td></tr>";  }


  while($i = mysqli_fetch_object($query)){

  if ($i->anonymous == "2"){$an = "Name Hidden"; }elseif ($i->anonymous != "2"){ $an = "<a href='profile.php?viewing=$i->paid','<div class=\'header1\'>$i->paid</a>";}

  echo " <tr>

<td class='tableborder' align='center'><a href='profile.php?viewing=$i->target','<div class=\'header1\'>$i->target</a></td>

<td class='tableborder' align='center'>&pound;".makecomma($i->amount)."</td>

<td class='tableborder' align='center'>$i->reason</td>

<td class='tableborder' align='center'>$an</td>

<td class='tableborder' align='center'><input name=\"radio6\" type=\"radio\" id=\"$i->id\" value=\"$i->id\" checked=\"checked\" /></td>

  </tr>"; }  ?> </table>

    <tr>

      <td colspan="5" align="center" ><br>

<center><input type="submit" class="custombutton" name="Claim" value="Claim"> - 

<input type="submit" class="custombutton" name="Buy" value="Buy Off?">

<?php if($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?> - 

<input type="submit" name="rem" class="custombutton" value="Remove"></center>

<?php } ?></td>
  </tr>
<br><br>

<div align="center">

  <table width="31%" border="1" bordercolor="black" class="table1px" cellpadding="2" cellspacing="0">

      <tr>

<td height="22" colspan="2" class="gradient"><div align="center">Hitlist Someone</div></td>

      </tr>

    <tr>

<td width="39%" align="right" ><b>Target:</b></td>

<td width="61%"  align="center"><b><input name="target" type="text" class="textbox" id="target2" size="30"></b></td>

    </tr>

 <tr>

<td align="right" ><b>Reward:</b></td>

<td  align="center"><b><input name="amount" type="text" class="textbox" id="amount2" size="30" maxlength="9"></b></td>

    </tr>

 <tr>

<td align="right" ><b>Hide Name:</b></td>

<td  align="left"><b>

<input name="an" type="radio" value="1" checked>No

<input type="radio" name="an" value="2">Yes</b></td>

 </tr>

    <tr>

<td align="right" ><b>Reason:</b></td>

<td  align="center"><textarea name="reason" cols="30" rows="3" class="textbox" id="textarea"></textarea></td>

    </tr>

        <tr>

<td colspan="2" align="center" ><input name="Submit" type="submit" class="custombutton" value="Hitlist User"></td>

      </tr>

  </table>

  </div>

</form>


<p><tr><td height="324" width="42%" valign="middle"><br><br><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>This is the hitlist. If you wanna get revenge on your enemies or simply want to waste your money then this is the best place to come. If you kill someone on the hitlist you can claim the reward here. It costs $200,000 to hitlist someone, you must also pay for the reward you set. If you wish to hide your name you must pay and extra $150,000 and 50% of your reward! (privacy don't come cheap!)<br><br>
<span class="warning">Tax applies on the hitlist from gang countrys (same as bank transfer)</span></p></p></div></td></tr></table></td></tr></table></td></tr></table></p>

</body>

</html> 



<?php require_once "incfiles/foot.php"; ?>
<br><br>

