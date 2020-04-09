<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

logincheck();

$username=$_SESSION['username'];

$date = gmdate('Y-m-d H:i:s');

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$currank = $fetch->rank;

$newk= (3600*24)+time();

if ($_POST['Create']){
$gang=strip_tags($_POST['gang']);

$locationa = mysqli_query( $connection, "SELECT money, crew, rank FROM accounts WHERE username='$username'");
while($successa = mysqli_fetch_row($locationa)){
	$crew = $successa[1];
	$money = $successa[0];
	$rank = $successa[2];

if($fetch->money < 30000000){
echo "<center><font color=red><b>You have not got &pound;30,000,000 to make a gang.<br>";

}elseif($fetch->money >= 30000000){

$blahhh = mysqli_query( $connection, "SELECT * FROM `crews` WHERE name = '$gang'");
$madecrew = mysqli_num_rows($blahhh); 
if($madecrew != "0") { die('<center><font color=red><b>That gang name has already been used!<br>'); }
if (!$gang){
echo "<center><font color=red><b>You need to enter the name of gang you wish to create!<br>";
}elseif ($gang){
if ($crew != '0'){
echo "<center><font color=red><b>You are already in or part of a gang leave it before making a new one!<br><br>";
}elseif ($crew == '0'){

mysqli_query( $connection, "UPDATE accounts SET money=money-30000000 WHERE username='$username'") or die("Couldnt substract cash!");
mysqli_query( $connection, "INSERT INTO `crews` (`id`, `name`, `owner`, `underboss`, `rhm`, `lhm`, `bank`,`size`,`logo`) VALUES ('', '$gang', '$username', '0', '0', '0','0','100','images/de-crew.png');") or die (mysqli_error());
mysqli_query( $connection, "UPDATE accounts SET crew='$gang' WHERE username='$username'");
echo "<link href='style.css' rel='stylesheet' type='text/css' />

<table width='400' border='0' align='center' cellpadding='0' cellspacing='0' class='table'>

<tr class='header'><td align='center'>Gang Formed</td></tr>

<tr><td align='center'>Your gang $gang has been created!</td></tr></table><br>";

}}}}}

if(strip_tags($_POST['remove']) && strip_tags($_POST['checkbox'] != '')){

foreach($_POST['checkbox'] as $id){

$biatchy = mysqli_query( $connection, "SELECT * FROM crew_app WHERE id='$id' AND username='$username'");

$fucktardy = mysqli_fetch_object($biatchy);

$fucktardyy = mysqli_num_rows($biatchy);

if ($fucktardyy == "0"){ echo "<center>Error!</center>"; }elseif ($fucktardyy != "0"){



mysqli_query( $connection, "DELETE FROM `crew_app` WHERE `id` = '$id' AND `username` = '$username'");

echo "<center><font color=red><b>Application removed!</center>";

}}

}

$apply=strip_tags($_GET['apply']);

if($apply){

$biatch = mysqli_query( $connection, "SELECT * FROM crews WHERE name='$apply'");

$fucktard = mysqli_fetch_object($biatch);

$biatch9 = mysqli_query( $connection, "SELECT * FROM crew_app WHERE username='$username' AND crew='$apply'");

$fucktard9 = mysqli_num_rows($biatch9);

$chk=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

if ($fucktard9 != "0"){ echo "<center><font color=red><b>You already applied for this gang!</center>"; }elseif ($fucktard9 == "0"){



if ($chk->crew != "0" || ""){ echo "<center>You are already in a gang!</center>"; }elseif ($chk->crew == "0" || ""){
if ($fucktard->acxp > $info->rankpoints){ echo "<center>This gang is not accepting your rank!</center>"; }elseif ($fucktard->acxp <= $info->rankpoints){

if($fucktard->recruiting==1 && $fucktard->id){
mysqli_query( $connection, "UPDATE accounts SET crewappl='$apply' WHERE username='$username'") or die("Couldn't apply because of a technical error!");
print"<b><center>You've applied to join $apply!<br>";
}else{
die("<font color=red><b>Crew isn't recruiting or doesn't exist!");
}
}
}}}
?>

<?php if ($site->gupdate == "1"){
echo "<link href='style.css' rel='stylesheet' type='text/css'><center><div class='update'>$site->gupdatetext</div></center>

<br>";
}
?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"> 
<style type="text/css">

<!--

.unselected_link {background: url(images/subhead.png) repeat-x; 
	                    padding: 5px 20px 5px 20px; 
	                    border: 0px solid #000000;
                       	    width: 120px; }
.selected_link {background: url(images/selected_box.png) repeat-x;
	                    padding: 5px 20px 5px 20px; 
	                    border: 0px solid #000000;
                       	    width: 120px; }
-->

</style>
</head>
<body>

<form method="post">
<table align="center" cellspacing="0" class="table">
<tr><td align="center"><a href="gangcp.php"><font size="2">Go to your Gang CP!</a></center></td></tr>
</table></form>

<form method="post">
<table width="400" align="center" cellspacing="0" border="0" class="table1px">
<tr>
	<td colspan="2" class="gradient">Create A New Gang - &pound;30,000,000</td>
</tr>

<?php
$rankcheck=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

  if ($rankcheck->id > "10000000000000000000"){

echo "<tr><td colspan=2 align=\"center\">You cannot make a gang untill your ranked <u>Assassin</u> or above!<br>

</td></tr>";

}elseif ($rankcheck->id >= "1"){


echo"
<tr>


</tr>
<tr>
	<td align='right' width='40%'>Gang Name:</td>
	<td><input type='text' name='gang' class='textbox111111'></td>
</tr>
<tr>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td align='center' colspan='2'><input type='submit' name='Create' class='custombutton' value='Create' /></td>
</tr>";
}
?></td>
</tr>
</table>
</form><table width="600" align="center" cellspacing="0" border="0" class="table1px">
<tr>
	<td colspan="5" class="gradient">Join a gang! </td>
</tr>
<tr>


</tr>	<?php $biatch = mysqli_query( $connection, "SELECT * FROM crews ORDER BY id+1 DESC LIMIT 11");

while($fucktard = mysqli_fetch_object($biatch)){

echo "<tr><td align='center'><a href=\"gangprof.php?viewcrew=$fucktard->name\"><b>$fucktard->name</b></a></td>";

echo "<td align='center'><a href='profile.php?viewuser=$fucktard->owner'><b>$fucktard->owner</b></a></td>";

if(!$fucktard->underboss){

echo "<td align='center'><b>None</b></td>";

}else{

echo "<td align='center'><a href='profile.php?viewuser=$fucktard->underboss'><b>$fucktard->underboss</b></a></td>";

}

$boo="SELECT * FROM accounts WHERE crew='$fucktard->name'";

$size=$fucktard->size;

$he=mysqli_query( $connection, $boo);

$increw=mysqli_numrows($he);

$left = $size - $increw;



if($fucktard->recruiting==1){

if($left<1){

echo "<td align='center'><b>Reached max size!</b></td></tr>";

}else{

echo "<td align='center'><a href=\"?apply=$fucktard->name\"><b>Apply!</b></a></td></tr>";

}

}else{

echo "<td align='center'><b>Not Recruiting</b></td></tr>";

}



}









?>


</table>
</body>








</table>
 </div>
