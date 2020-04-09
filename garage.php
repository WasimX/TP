<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$page=$_GET['page'];

if($_POST['sell']) {
if(is_array($_POST['car'])) {
$cars = count($_POST[car]);
$i = 0;
$totalmoney = 0;
foreach($_POST['car'] as $car) {
$query = mysqli_query( $connection, "SELECT * FROM garage WHERE id='$car'");
$array = mysqli_fetch_array($query);

if($array['owner'] == $username) {
$totalmoney = $totalmoney + $array['worth'];
mysqli_query( $connection, "UPDATE accounts SET money=money+$array[worth] WHERE username='$username'");
mysqli_query( $connection, "DELETE FROM garage WHERE id='$car'");

if(($i + 1) == $cars) {
if($cars == "1") { echo "You sold the car for &pound;".makecomma($array[worth]).""; } 
else{ echo "You sold $cars cars for &pound;".makecomma($totalmoney)."."; }}} 

else{ if(($i + 1) == $cars){
if($cars == "1"){ echo "You do not own this car.\n"; }
else{ echo "You do not own these cars.\n"; }}}
$i++; }}}







if($_POST['remove']) {
if(is_array($_POST['car'])) {
$cars = count($_POST['car']);
$i = 0;
$totalmoney = 0;
$cars2 = 0;
foreach($_POST['car'] as $car) {
$query = mysqli_query( $connection, "SELECT * FROM garage WHERE id='$car'");
$array = mysqli_fetch_array($query);

if($array['owner'] != $username){ $error = 1; } //3

if(!$error){
mysqli_query( $connection, "DELETE FROM garage WHERE id='$car'");
				
if(($i + 1) == $cars){
if($cars2 == "1"){ echo "The car selected has been ditched.\n"; }
else{ echo "The cars selected have been ditched.\n"; }}
}else{
if(($i + 1) == $cars){
if($cars == "1"){ echo "You do not own this car.\n";} 
else{ echo "You do not own these cars.\n"; }}} 
$i++; }}}

$limit = 15;               
$query_count = "SELECT * FROM garage WHERE owner='$username'";    
$result_count = mysqli_query( $connection, $query_count);    
$totalrows = mysqli_num_rows($result_count); 

if(empty($page)){ $page = 1; }

if($totalrows == "0"){$totalrows = "1";}
$limitvalue = $page * $limit - ($limit);  
$numofpages = $totalrows / $limit; 

?>
<?php $mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");



$fetch=mysqli_fetch_object($mysqli);







$id = $_GET['repair'];



$repthis=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM garage WHERE owner='$username' AND id='$id'"));







if ($id != "") { 







if($repthis->car == "Renault Clio Sport")



{ $repcost = $repthis->damage * 50;



  $sellfor = "2500"; }



elseif($repthis->car == "Audi A3")



{ $repcost = $repthis->damage * 60;



  $sellfor = "3000"; }



elseif($repthis->car == "BMW M3")



{ $repcost = $repthis->damage * 150;



  $sellfor = "7500"; }



elseif($repthis->car == "Cadilac Escelade")



{ $repcost = $repthis->damage * 300;



  $sellfor = "15000"; }



  elseif($repthis->car == "Nissan Skyline")



{ $repcost = $repthis->damage * 400;



  $sellfor = "20000"; }



elseif($repthis->car == "Porsche 911")



{ $repcost = $repthis->damage * 550;



  $sellfor = "27500"; }



elseif($repthis->car == "GT 40")



{ $repcost = $repthis->damage * 800;



  $sellfor = "40000"; }



elseif($repthis->car == "Lamborghini Murcielago")



{ $repcost = $repthis->damage * 1100;



  $sellfor = "55000"; }



elseif($repthis->car == "Ferrari Enzo")



{ $repcost = $repthis->damage * 1700;



  $sellfor = "85000"; }



elseif($repthis->car == "TVR Speed 12")



{ $repcost = $repthis->damage * 2100;



  $sellfor = "105000"; }



elseif($repthis->car == "Mclaren F1")



{ $repcost = $repthis->damage * 2500;



  $sellfor = "125000"; }



elseif($repthis->car == "Bugatti Veyron")



{ $repcost = $repthis->damage * 3000;



  $sellfor = "150000"; }



elseif($repthis->car == "Mercedes SLK Mclaren")



{ $repcost = $repthis->damage * 3300;



  $sellfor = "160000"; }



  



$repround=round($repcost);



  



if ($fetch->money >= $repround) {



$newrepmoney = $fetch->money - $repround; 



mysqli_query( $connection, "UPDATE accounts SET money='$newrepmoney' WHERE username='$username'");



mysqli_query( $connection, "UPDATE garage SET damage='0' WHERE owner='$username' AND id='$id'"); 



mysqli_query( $connection, "UPDATE garage SET worth='$sellfor' WHERE owner='$username' AND id='$id'"); }



else { echo "Not enough money"; }



}







?>
<?php if($_POST[regid] && $_POST[send]) {
$shipto = $_POST['shipto'];
$query = mysqli_query( $connection, "SELECT * FROM garage WHERE id='$_POST[regid]'");
$car = mysqli_fetch_array($query);

if ($car[manufacturing] == "1"){ echo "Unable to take action due to car in manufacturing status."; }
elseif ($car[manufacturing] != "1"){

if ($shipto == "player"){
if($car[owner] == $username){ 
$query = mysqli_query( $connection, "SELECT username, status FROM accounts WHERE username='$_POST[username]'");
$array = mysqli_fetch_array($query);
if($fetch->location != $car[location]){ echo "You have to be in the same location as the car to send it to another player."; }else{
if($array[status] == "Alive") {
mysqli_query( $connection, "UPDATE garage SET owner='$array[username]' WHERE id='$_POST[regid]'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$array[username]', '$username', '$username sent you a car. Check your inbox for any new additions.', 'The Garage Hideout', '$date', '0');");
echo "The car ($_POST[regid]) has been sent to $_POST[username]."; }else{ echo "You cannot send a car to a dead player."; }}
}else{ echo "You do not own that car."; }}

if ($shipto != "player"){ 
if ($shipto == "1"){ $country = "England"; }
elseif ($shipto == "2"){ $country = "Pakistan"; }
elseif ($shipto == "3"){ $country = "Jamaica"; }
elseif ($shipto == "4"){ $country = "America"; }
elseif ($shipto == "5"){ $country = "Japan"; }
elseif ($shipto == "6"){ $country = "Germany"; }
elseif ($shipto == "7"){ $country = "China"; }
if($car[owner] == $username){
if($fetch->location != $car[location]){ echo "You have to be in the same location as the car to send it to another country."; }else{
mysqli_query( $connection, "UPDATE garage SET location='$country' WHERE id='$_POST[regid]'");
echo "The car ($_POST[regid]) has been sent to $country successfully."; }
}else{ echo "You do not own that car."; }}
}}
?>

<script type='text/javascript'>
function checkAll(FormName, FieldName, CheckValue){
if(!document.forms[FormName])
return;
var objCheckBoxes = document.forms[FormName].elements[FieldName];

if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;

if(!countCheckBoxes) {
objCheckBoxes.checked = CheckValue;
}else{
for(var i = 0; i < countCheckBoxes; i++) {
objCheckBoxes[i].checked = CheckValue; }
}}
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Thug Paradise :: Garage</title>
<link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
<form method="post" name="form" action="">
<table width="45%" border="0"  align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="3" align="center" class="gradient">Page Selection</td></tr>
<tr><td width="20%"  align="left" class="tableborder">
<?php if($page != "1"){ 
$pageprev = $page - 1;
echo("<a href=\"garage.php?page=$pageprev\">Previous Page</a> "); }?></td>

<td width="60%" align="center" class="tableborder">
<?php
for($i = 1; $i <= $numofpages; $i++){
if($i == $page){ echo($i." "); }
else{ echo("<a href=\"garage.php?page=$i\">$i</a> "); }}

if(($totalrows % $limit) != 0){
if($i == $page){ echo($i." "); }
else{ echo("<a href=\"garage.php?page=$i\">$i</a> "); }} ?></td>

<td width="20%"  align="right" class="tableborder">
<?php if(($totalrows - ($limit * $page)) > 0){
$pagenext = $page + 1;
echo(" <a href=\"garage.php?page=$pagenext\">Next Page</a>"); }else{ } ?></td>
</tr>
</table>
<br><br>
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td class="gradient" height="30" colspan="8" align="center">Your Car Garage - Holding <?php echo "$totalrows"; ?> Cars</td></tr>

<tr>
<td class="tableborder" width="5%" align="center"><u>CTRL</u></td>
<td width="9%" class="tableborder" align="center"><u>ID</u></td>
<td width="18%" class="tableborder" align="center"><u>Name</u></td>
<td width="14%" class="tableborder" align="center"><u>Value (Repair)</u></td>
<td width="14%" class="tableborder" align="center"><u>Damage</u></td>
<td width="16%" class="tableborder" align="center"><u>1st Location</u></td>
<td width="17%" class="tableborder" align="center"><u>Current Location</u></td>
<td width="8%" class="tableborder" align="center"><u>Upgrade</u></td>
</tr>

<?php $limit = 15;               
$query_count = "SELECT * FROM garage WHERE owner='$username'";    
$result_count = mysqli_query( $connection, $query_count);    
$totalrows = mysqli_num_rows($result_count); 

if(empty($page)){ $page = 1; }

if($totalrows == "0"){$totalrows = "1";}
$limitvalue = $page * $limit - ($limit);  
$numofpages = $totalrows / $limit; 

$query = mysqli_query( $connection, "SELECT * FROM garage WHERE owner='$username' ORDER BY `id` DESC LIMIT $limitvalue, $limit"); 
$rows = mysqli_num_rows($query);

$totalvalue = 0;
$totalrepair = 0;

for($i = 0; $i < $rows; $i++) {
$array = mysqli_fetch_array($query);
$type = $array['car'];
$name = $carname['$type'];
$value = $carvalue['$type'];
$repaircost = $value - $array['worth'];
$totalvalue += $array[worth];
$totalrepair += $repaircost;
if ($array[manufacturing] == "1"){ $added = " disabled=\"disabled\""; }else{ $added = ""; }

echo "<tr>
<td align=\"center\" class=\"tableborder\"><input type=\"checkbox\" name=\"car[]\" value=\"$array[id]\"$added></td>
<td align=\"center\" class=\"tableborder\">$array[id]</td>
<td align=\"center\" class=\"tableborder\">$array[car]</td>
<td align=\"center\" class=\"tableborder\">&pound;".makecomma($array[worth])." / <a href='garage.php?repair=$array[id]'><img src='http://mafia-pride.com/images/fix.png' title='Repair!' height='23' width='30'></a></td>
<td align=\"center\" class=\"tableborder\">$array[damage]%</td>
<td align=\"center\" class=\"tableborder\">$array[origion]</td>
<td align=\"center\" class=\"tableborder\">$array[location]</td>
<td align=\"center\" class=\"tableborder\"><a href=upgrade.php?car=$array[id]><img src='http://vignette3.wikia.nocookie.net/nfs/images/3/3d/NFSMW2012NitrousIcon.png/revision/latest?cb=20121207051129&path-prefix=en' title='Upgrade' height='20' width='32'></a>
</tr></td>
"; 
}
?>

<tr><td class='sub' colspan='7'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
  <td width="34%" class="tableborder">
    
      <div align="center">
        <input type="submit" name="sell" value="Sell Selected" class="custombutton">
		<input type="submit" name="remove" value="Ditch Selected" class="custombutton">
          </div></td><td class="tableborder" width="30%"><div align="center"></div></td>
<td class="tableborder" width="36%" align="right"><b>This Page's Value : <?php echo "&pound;".makecomma($totalvalue).""; ?></b></td>
</tr></table></td></tr>

</table>
<br /><br />
        <table width="40%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
        <tr><td colspan="2" class="gradient" height="30">Ship Car</td></tr>
        <tr>
            <td class="tableborder" align="right">Car Reg #:</td>
            <td class="tableborder" align="left"><input name="regid" type="text" class="textbox" size="31" maxlength="7"></td>
        </tr>
        <tr>
          <td class="tableborder" align="right">Ship to:</td>

          <td class="tableborder" align="left"><select name="shipto" class="textbox" id="shipto">
            <option value="player" selected>Player</option>
            <option value='1'>England</option>
			<option value='2'>Pakistan</option>
			<option value='3'>Jamaica</option>
			<option value='4'>America</option>
			<option value='5'>Japan</option>
			<option value='6'>Germany</option>
			<option value='7'>China</option></select></td>
        </tr>
<tr>
<td class="tableborder" align="right">Username (if selected player):</td>
<td class="tableborder" align="left"><input name="username" type="text" class="textbox" id="username" size="31" maxlength="30"></td>
</tr><tr>
<td colspan="2" class="tableborder" align="center"><input name="send" type="submit" class="custombutton" id="send" value="Ship Car"></td>
</tr>
</table>
<?php if ($fetch->factory != "0" && $fetch->factory != ""){ ?>
<br><br>
<div align="center"> 
<a href="carfactory.php" style="border: none;"><img src="images/others/YourCarsFactory.png" border="0" /></a>
</div><?php } ?>

<?php include_once "incfiles/foot.php"; ?>