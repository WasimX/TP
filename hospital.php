<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

include_once "incfiles/jailcheck.php";

logincheck();

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$currank = $fetch->rank;

$rankcheck=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));



$add = $rankcheck->health;

$cost = $rankcheck->cost;



?>

<?php

	  $now = time();

if ($fetch->hospital == '1'){

if ($fetch->htime > time()){

$left = $fetch->htime - time('Y-m-d h:i:s');



$timeleft1 =  round($left, 2);

echo "<center>You have still got ".maketime($fetch->htime)." left before you regain your health.</center>";

exit();

}elseif ($fetch->htime <= time()){

$new_health=$add*$fetch->hlong;

$new_health1=$fetch->health+$new_health;

if ($new_health1 >= "100"){

$new_health1="100";

}

mysqli_query( $connection, "UPDATE accounts SET health='$new_health1', hospital='0', hlong='0' WHERE username='$username'");

echo"<center>You have gained <b>".makecomma($new_health)."</b>% health and are now at <b>".makecomma($new_health1)."</b>% health!</center>";

exit();

}

}elseif ($fetch->hospital == '0'){

if (strip_tags($_POST['Submit']) && strip_tags($_POST['units'])){

$units=intval(strip_tags($_POST['units']));

		if ($units == 0 || !$units || ereg('[^0-9]',$units)){

	print "Invalid amount.";

}elseif ($units != 0 && $units && !ereg('[^0-9]',$units)){

$price = $units * $cost;

if ($price > $fetch->money){

echo "It cost's £".makecomma($cost)." for $units hour's in hospital.";

}elseif ($price <= $fetch->money){

$new_money=$fetch->money - $price;

$new_health=$fetch->health + $units;

if ($fetch->health == "100"){

echo "You dont need to go into the hosptial!";

}else{

$ime1=$units*3600;

$new_time = time('Y-m-d h:i:s') + $ime1;

mysqli_query( $connection, "UPDATE accounts SET money='$new_money', htime='$new_time', hospital='1', hlong='$units' WHERE username='$username'");

echo "You are now in the hospital for $units hours!";

echo '<meta HTTP-EQUIV="REFRESH" content="0; url=hospital.php">';

}}}}}

?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Hospital</title>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<br>

<form name="form1" method="post" action="">
  <table width="451" border="0" align="center" class="table1px" cellpadding="0" cellspacing="0">
    <tr><td height="30" colspan="2" class="gradient">Hospital</td></tr>
    <tr>
      <td width="51%" class="tableborder" align="right">Hours you wish to in:</div></td>
      <td width="49%" class="tableborder" align="left"><input name="units" type="text" class="textbox" id="units" size="7" maxlength="5"></td>
    </tr>
    <tr>
     <td colspan="2" class="tableborder" align="center"><br><input name="Submit" type="submit" class="custombutton" value="Go in Hospital"><br></td>
    </tr>
  </table>
  <br>
  <table width="451" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
    <tr>
      <td class="tablebackground" align="center"><br>Welcome to the hospital in <?php echo "$fetch->location"; ?>!<br>
        <br>
                Because your rank lays at <b><?php echo"$currank";?></b>, it will cost you <b><?php echo"&pound;".makecomma($cost).""; ?></b> per <b><?php echo"$add";?>%</b> for every hour your in hospital for.<br>
<br>The lower the rank you are, the lower the cost of health.<br><br>
Please note, you must return to this page to receive your health<br>
and you will only be healed when your time in the hospital is up.<br><br>
      </div></td>
    </tr>
  </table>
</form>
<?php include_once "incfiles/foot.php"; ?>
</body>
</html>

