<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$airport = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='$fetch->location'"));
$fetch_owner=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$airport->owner'"));

$query_air=mysqli_query( $connection, "SELECT * FROM airport WHERE location='$fetch->location' LIMIT 1");
$fetch_air=mysqli_fetch_object($query_air);

$price_air=explode("-", $fetch_air->travel_prices);
$profit = explode("-",$fetch_air->profit);
$total = $profit[0] + $profit[1] + $profit[2] + $profit[3] + $profit[4] + $profit[5];
$a1 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='England'"));
$a2 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Pakistan'"));
$a3 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Jamaica'"));
$a4 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='America'"));
$a5 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Japan'"));
$a6 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Germany'"));
$a7 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='China'"));


if (strtolower($fetch_air->owner) != strtolower($fetch->username)){
exit();
}else{
if (strip_tags($_POST['submit'])){
$n1=$_POST['n1'];
$n2=$_POST['n2'];
$n3=$_POST['n3'];
$n4=$_POST['n4'];
$n5=$_POST['n5'];
$n6=$_POST['n6'];
$n7=$_POST['n7'];
///STRIP TEXT
$n1=strip_tags($n1);
$n2=strip_tags($n2);
$n3=strip_tags($n3);
$n4=strip_tags($n4);
$n5=strip_tags($n5);
$n6=strip_tags($n6);
$n7=strip_tags($n7);
if (!ereg('[^0-9]',$n1)){
if (!ereg('[^0-9]',$n2)){
if (!ereg('[^0-9]',$n3)){
if (!ereg('[^0-9]',$n4)){
if (!ereg('[^0-9]',$n5)){
if (!ereg('[^0-9]',$n6)){
if (!ereg('[^0-9]',$n7)){

if ($n1 <= "100" || $n1 > "1000000"){
echo "England's travel price needs to cost more than £100 but not as much as £1,000,000.";
}elseif ($n1 > "100" || $n1 < "1000000"){

if ($n2 <= "100" || $n2 > "1000000"){
echo "Pakistan's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n2 > "100" || $n2 < "1000000"){

if ($n3 <= "100" || $n3 > "1000000"){
echo "Jamaica's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n3 > "100" || $n3 < "1000000"){

if ($n4 <= "100" || $n4 > "1000000"){
echo "America's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n4 > "100" || $n4 < "1000000"){

if ($n5 <= "100" || $n5 > "1000000"){
echo "Japan's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n5 > "100" || $n5 < "1000000"){

if ($n6 <= "100" || $n6 > "1000000"){
echo "Germany's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n6 > "100" || $n6 < "1000000"){

if ($n7 <= "100" || $n7 > "1000000"){
echo "China's travel price needs to cost more than £100 but not as much as £1,000,000";
}elseif ($n7 > "100" || $n7 < "1000000"){


$new_array="$n1-$n2-$n3-$n4-$n5-$n6-$n7";
mysqli_query( $connection, "UPDATE airport SET travel_prices='$new_array' WHERE location='$fetch->location'");
echo "The airport prices were successfully updated.";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=../travel.php\">";


}}}}}}}}}}}}}}}

if (strip_tags($_POST['other'])){
$drop = $_POST['drop'];
$drop = strip_tags($drop);
$give_to=$_POST['give_to'];
$give_to=addslashes(strip_tags($give_to));
$reset = $_POST['reset'];
$reset=strip_tags($reset);

/////DID they choose to drop////
if ($drop == "Yes"){
mysqli_query( $connection, "UPDATE airport SET owner='0' WHERE location='$fetch->location' AND owner='$username'"); }

if (isset($give_to) && ($drop != "Yes") && ($give_to != "")){
mysqli_query( $connection, "UPDATE airport SET owner='$give_to' WHERE location='$fetch->location' AND owner='$username'"); }

if ($reset == "Yes"){
mysqli_query( $connection, "UPDATE airport SET profit='0-0-0-0-0-0' WHERE location='$fetch->location' AND owner='$username'"); }

echo "Your secondary options have been updated.";
}
?>



<link href="style.css" rel="stylesheet" type="text/css">

<form name="form1" method="post" action="">
  <table width="73%" border="0"cellpadding="0" cellspacing="0" align="center" class="table1px">
    <tr><td height="30" colspan="5" class="gradient">Airport Controls</td></tr>

    <tr> 
      <td class="tableborder" width="20%" align="center"><u>Country (To)</u></td>
      <td class="tableborder" width="20%" align="center"><u>Change Price</u></td>
      <td class="tableborder" width="20%" align="center"><u>Current Prices</u></td>
      <td class="tableborder" width="20%" align="center"><u>Country Attendance</u></td>
      <td class="tableborder" width="20%" align="center"><u>Money Made</u></td>
    </tr>
    <tr> 
<td class="tableborder" align="center">England</td>
<td class="tableborder" align="center">&pound;
             <input name="n1" type="text" class="textbox" value="<?php echo "$price_air[0]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[0]).""; ?>&nbsp;</td>
<td class="tableborder" align="center"><?php echo "".makecomma($a1).""; ?>&nbsp;</td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[0]).""; ?>&nbsp;</td>
    </tr>
     <tr> 
<td class="tableborder" align="center">Pakistan</td>
<td class="tableborder" align="center">&pound;
            <input name="n2" type="text" class="textbox" value="<?php echo "$price_air[1]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[1]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a2).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[1]).""; ?></td>
    </tr>
    <tr> 
<td class="tableborder" align="center">Jamaica</td>
<td class="tableborder" align="center">&pound;
            <input name="n3" type="text" class="textbox" value="<?php echo "$price_air[2]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[2]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a3).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[2]).""; ?></td>
    </tr>
    <tr> 
<td class="tableborder" align="center">America</td>
<td class="tableborder" align="center">&pound;
            <input name="n4" type="text" class="textbox" value="<?php echo "$price_air[3]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[3]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a4).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[3]).""; ?></td>
    </tr>
    <tr> 
<td class="tableborder" align="center">Japan</td>
<td class="tableborder" align="center">&pound;
            <input name="n5" type="text" class="textbox" value="<?php echo "$price_air[4]"; ?>" size="10" maxlength="10"></th>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[4]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a5).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[4]).""; ?></td>
    </tr>
    <tr> 
<td class="tableborder" align="center">Germany</td>
<td class="tableborder" align="center">&pound;
            <input name="n6" type="text" class="textbox" value="<?php echo "$price_air[5]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[5]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a6).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[5]).""; ?></td>
    </tr>
	    <tr> 
<td class="tableborder" align="center">China</td>
<td class="tableborder" align="center">&pound;
            <input name="n7" type="text" class="textbox" value="<?php echo "$price_air[6]"; ?>" size="10" maxlength="10"></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($price_air[6]).""; ?></td>
<td class="tableborder" align="center"><?php echo "".makecomma($a7).""; ?></td>
<td class="tableborder" align="center">&pound;<?php echo "".makecomma($profit[6]).""; ?></td>
    </tr>

    <tr> 
<td class="tableborder" align="center" colspan="2"><input type="submit" name="submit" value="Change Prices" class="custombutton"></td>
<td class="tableborder" align="center" colspan="2">&nbsp;</td>
<td class="tableborder" align="center"><b>Total: £<?php echo "".makecomma($total)."";  ?></b></td>
    </tr>

<tr><td height="30" colspan="5" class="gradient">Other Controls</td></tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="right"><b>Drop:</b></td>
<td class="tableborder" align="left"><input name="drop" type="radio" value="Yes">Yes </td>
</tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="left"><input name="drop" type="radio" value="No" checked>No </td>
</tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="right"><b>Give to:</b></td>
<td class="tableborder" align="left"><input name="give_to" class="textbox" type="text" id="give_to"></td>
</tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="right"><b>Reset Earnings:</b></td>
<td class="tableborder" align="left"><input type="radio" name="reset" value="Yes">Yes </td>
</tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="left">&nbsp;</td>
<td class="tableborder" align="left"><input name="reset" type="radio" value="No" checked>No</td>
</tr>
<tr> 
<td class="tableborder" align="center">&nbsp;</td>
<td class="tableborder" align="left">&nbsp;</td>
<td colspan="2" class="tableborder" align="center"><input type="submit" name="other" class="custombutton" value="Submit"></td>
</tr>
</table> 
</form>
<?php } ?>  
