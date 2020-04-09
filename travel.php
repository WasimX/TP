<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

if($fetch->safehouse != "0"){
die("Where do you think your going? You're meant to be in the safehouse!");
}

$a1 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='England'"));
$a2 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Pakistan'"));
$a3 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Jamaica'"));
$a4 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='America'"));
$a5 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Japan'"));
$a6 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='Germany'"));
$a7 = mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM accounts WHERE location='China'"));

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$fetch=mysqli_fetch_object($query);
$query2=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");
$fly_skill=mysqli_fetch_object($query2);

$query1=mysqli_query( $connection, "SELECT * FROM airport WHERE location='$fetch->location' LIMIT 1");
$fetch_air=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM airport WHERE location='$fetch->location' LIMIT 1"));
$fetch1=mysqli_fetch_object($query1);
$price=explode("-", $fetch1->travel_prices);
$prof=explode("-",$fetch1->profit);

if (strtolower($fetch1->owner) == strtolower($fetch->username)){
$cpanel=$_GET['cpanel'];
include_once"travelcontrols.php";

}
 

if ($fetch->lasttravel > time() && $fetch->userlevel != "4"){
echo "<font color=white>You have recently traveled you must wait ".maketime($fetch->lasttravel)." seconds";
exit();
}

if ($_POST['radio']){
$radio=strip_tags($_POST['radio']);

if (!ereg('[^0-9]',$radio)){

  if($radio <= '0' || $radio > '7'){
    echo"I don't think so, smartypants.";
    exit();
  }

if ($radio == "1"){
$costs = $price[0];
$to = "England";
$new0=$prof[0]+$costs;
$update="$new0-$prof[1]-$prof[2]-$prof[3]-$prof[4]-$prof[5]-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "2"){
$costs = $price[1];
$to = "Pakistan";
$new1=$prof[1]+$costs;
$update="$prof[0]-$new1-$prof[2]-$prof[3]-$prof[4]-$prof[5]-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "3"){
$costs = $price[2];
$to = "Jamaica";
$new2=$prof[2]+$costs;
$update="$prof[0]-$prof[1]-$new2-$prof[3]-$prof[4]-$prof[5]-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "4"){
$costs = $price[3];
$to = "America";
$new3=$prof[3]+$costs;
$update="$prof[0]-$prof[1]-$prof[2]-$new3-$prof[4]-$prof[5]-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "5"){
$costs = $price[4];
$to = "Japan";
$new4=$prof[4]+$costs;
$update="$prof[0]-$prof[1]-$prof[2]-$prof[3]-$new4-$prof[5]-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "6"){
$costs = $price[5];
$to = "Germany";
$new5=$prof[5]+$costs;
$update="$prof[0]-$prof[1]-$prof[2]-$prof[3]-$prof[4]-$new5-$prof[6]-$prof[7]-$prof[8]-$prof[9]";

}elseif ($radio == "7"){
$costs = $price[6];
$to = "China";
$new6=$prof[6]+$costs; 
$update="$prof[0]-$prof[1]-$prof[2]-$prof[3]-$prof[4]-$prof[5]-$new6-$prof[7]-$prof[8]-$prof[9]";
}

if ($fetch->lasttravel > time() && $fetch->userlevel != "4"){
echo "<font color=white>You have recently traveled you must wait ".maketime($fetch->lasttravel)." seconds";
exit();
}
if ($costs > $fetch->money){
echo "<center><b>You do not have the £".makecomma($costs)." in order to travel..</b></center>"; 
}elseif ($costs <= $fetch->money){
if ($to == $fetch->location){
echo "<center><b>Your location is already $to. Please select a different country.</b></center>";
}elseif ($to != $fetch->location){
$nmoney = $fetch->money - $costs;
$now=time() + 3600;
mysqli_query( $connection, "UPDATE accounts SET money='$nmoney', location='$to', lasttravel='$now', bjtime='0' WHERE username='$username'");
unset($_SESSION['bet']);
unset($_SESSION['show']);
echo "<center><b>You have arrived in $to successfully.</b></br>Any bets in progress have been removed and your stake has been forfeited.</center><br>"; 
mysqli_query( $connection, "UPDATE airport SET profit='$update' WHERE location='$fetch->location'");
}}}}


?>


<html>
<link href="style.css" rel="stylesheet" type="text/css">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Thug Paradise 2 :: Travel</title>

</head>

<form name="form1" method="post" action="">
    <?php if($fetch_air->owner == "0" || $fetch_air->owner == ""){ ?></p>
  <table width="40%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
    <tr><td height="30" align="center" class="gradient">Airport: Unowned</td></tr>
    <tr >
      <td align="center" class="tableborder">This airport located in <b><?php echo "$fetch->location"; ?></b> is unowned. If you would like to become the owner, you must pay &pound;10,000,000. Click purchase to do so.<br />
        <br />
        <input name="buyaf" id="buyaf" type="submit" class="custombutton" value="Purchase" />
        <br />
        <br />
        <br />
        <?php
	  if($_POST['buyaf']){
	  if($fetch->money < 10000000){
echo "You have not got &pound;10,000,000 to pay for the airport.";
}elseif($fetch->money > 10000000){
$moneyless = $sitestats->factoryprice;
mysqli_query( $connection, "UPDATE accounts SET money=money-10000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE airport SET owner='$username' WHERE location='$fetch->location'");
echo "You now own the airport located in $fetch->location.";	 
	  }}
	  ?>
      </td>
    </tr>
  </table>
  <?php } ?>
<link rel=stylesheet href=../style.css type=text/css>

<script type="text/javascript" src="library/select.js"></script>

  <table width="45%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
    <tr><td height="30" colspan="4" class="gradient">Travel Around Thug Paradise</td></tr>
<tr>
<td height="28" colspan="4" class="tableborder" align="center"><b>Welcome To The International Airport Of <?php echo "$fetch->location"; ?> <?php if ($fetch1->owner == "0"){ echo "<font color=white><b>Which Is Not Owned.</font></b>"; }else{ echo "<font color=white><b>, Owned By <a href='profile.php?viewing=$fetch1->owner'><b>$fetch1->owner</b></a>.</font></b>"; } ?></b><br></br><img src=../images/travel.png></center></td>
</tr>
    <tr> 
      <td width="25%" align="center" class="gradient">Country</td>
      <td width="25%" align="center" class="gradient">Attendance</td>
      <td width="25%" align="center" class="gradient">Price</td>
	  <td width="25%" align="center" class="gradient">Travel</td>
    </tr>
    <tr> 
      <td align="center">London, England</td>
      <td align="center"><?php echo "$a1"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[0]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="1" id="radio10" /></td>
    </tr>
	<tr> 
      <td class="tableborder" align="center">Lahore, Pakistan</td>
      <td class="tableborder" align="center"><?php echo "$a2"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[1]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="2" id="radio9" /></td>
    </tr>
	<tr> 
      <td class="tableborder" align="center">Kingston, Jamaica</td>
      <td class="tableborder" align="center"><?php echo "$a3"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[2]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="3" id="radio8"></td>
    </tr>
		<tr> 
      <td class="tableborder" align="center">New York, America</td>
      <td class="tableborder" align="center"><?php echo "$a4"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[3]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="4" id="radio7"></td>
    </tr>
		<tr> 
      <td class="tableborder" align="center">Tokyo, Japan</td>
      <td class="tableborder" align="center"><?php echo "$a5"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[4]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="5" id="radio6"></td>
    </tr>
		<tr> 
      <td class="tableborder" align="center">Berlin, Germany</td>
      <td class="tableborder" align="center"><?php echo "$a6"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[5]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="6" id="radio5"></td>
    </tr>
			<tr> 
      <td class="tableborder" align="center">Beijing, China</td>
      <td class="tableborder" align="center"><?php echo "$a7"; ?></td>
      <td class="tableborder" align="center"><?php echo "&pound;".makecomma($price[6]).""; ?></td>
	  <td class="tableborder" align="center"><input name="radio" type="radio" value="7" id="radio4"></td>
    </tr>
    
<tr> 
<td colspan="4" class="tableborder" align="center">
<input name="travel_button" type="submit" id="travel_button" value="Travel!" class="custombutton" /></td>
</tr>
  
  </table>
</form>


<p align="center">
<?php require_once "incfiles/foot.php"; ?>
</p>

</html>
