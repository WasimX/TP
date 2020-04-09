<?php
session_start();
include_once "incfiles/connectdb.php";
include_once"incfiles/func.php";
logincheck();
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$fetch3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$username'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>You're under protection for another ".maketime($fetch->safehours)."!</div>");
}

// Keep the riffraff out whilst we test.

// $allowedtoparty = array("PC Master Race", "H");
// if(!in_array($username, $allowedtoparty)){
//   die("<p>Get outta here you nosey little pervert or I'm gonna slap you silly.</p>");
// }

// Make biths searches find for testing (remove once it's live)

mysqli_query( $connection, "UPDATE searches SET status='Success', stime='', location='England' WHERE username='Kartel'");

$bodyg=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$username'"));
$page="kill2.php";
$Expired = date( 'Y-m-d H:i:s', time( ) + 32400); 
$date = gmdate('Y-m-d H:i:s');
$username=$_SESSION['username']; 
$username2=$_SESSION['username'];
$kill_bullets=$_POST['kill_bullets'];
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$searchfound=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM searches WHERE username='$username'"));
$ra=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));
$time=time();
if ($_GET['delete']){
$delete=strip_tags($_GET['delete']);
$which=mysqli_query( $connection, "SELECT * FROM searches WHERE id='$delete' AND username='$username'");
$num=mysqli_num_rows($which);
if ($num != "0"){
mysqli_query( $connection, "DELETE FROM searches WHERE id='$delete' AND username='$username'");
echo "Search has been deleted!";
}}
$searches=mysqli_query( $connection, "SELECT * FROM searches WHERE username='$username' AND stime <= '$time' AND status = ''");
while($a =mysqli_fetch_object($searches)){
$ccc = ($a->hours * 4.5) * $a->device;
$rand100 = rand(0,80);
if($ccc >= $rand100){
$usss=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$a->target'"));
if($usss->location == ""){ $loc = "England"; }else{ $loc = $usss->location; }
mysqli_query( $connection, "UPDATE searches SET status='Success', location='$loc' WHERE username='$username' AND id='$a->id'");
}elseif($ccc < $rand100){ 
mysqli_query( $connection, "UPDATE searches SET status='Failed', location='Not Found' WHERE username='$username' AND id='$a->id'");
}}
mysqli_query( $connection, "DELETE FROM searches WHERE time < '$time' AND username='$username'");
?>
<style type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<!--
.style1 {font-weight: bold}
.style2 {color: #000000}
-->
/* Sortable tables */
table.sortable thead {
background-color:#eee;
color:#000000;
font-weight: bold;
cursor: default;
}
.style9 {color: #FFFFFF}
.style10 {color: #FFFFFF; font-weight: bold; }
.style12 {
color: #FF0000;
font-size: 12px;
}
.style3 {	color: #FFFFFF;
	font-size: 16px;
}
#bithbox{
    width: 500px;
    height: 50px;
    margin: auto;
    padding: auto;
    background: #FFF;
    color: #000;
    border: 1px solid #000000;
    text-align: center;
}
</style>
<form action="" method="post" id="">
<body>
<table width="80%" border="0">
<table width="80%"  align="center" cellpadding="2" cellspacing="0"  class="table1px" >
<tr>
<td height="22" colspan="2" class="gradient">
<center>
<strong> Kill!</strong>
</center>
</td>
</tr>
<tr>
<td  width="50%" height="26" align="right"><b>Username:</b></td>
<td  width="50%" align="left"><label>
<input type="text" name="k_username" id="k_username" class="textbox">
</label>
</td>
</tr>
<tr>
<td  height="26" align="right" ><b>Bullets to Shoot:</b></td>
<td  align="left" ><input name="k_bullets" type="text"  id="k_bullets" class="textbox" /></td>
</tr>
<tr>
<td  height="26" align="right"><b>Bullets Type:</b></td>
<td  align="left"><select name="btype" id="btype" class="textbox">
<option value="jhp">JHP - <?php echo"".makecomma($fetch->jhp)."";?></option>
<option value="fmj">FMJ - <?php echo"".makecomma($fetch->fmj)."";?></option>
</select>
</td>
</tr>
<tr>
<td  height="24" align="right" ><b>Shooting Weapon:</b></td>
<td  align="left" ><select name="wepown" id="wepown" class="textbox">
<?php if ($fetch3->M16A4 > "0"){ echo"<option value='M16A4'>M16A4</option>"; } ?>
<?php if ($fetch3->MP5 > "0"){ echo"<option value='MP5'>MP5</option>"; } ?>
<?php if ($fetch3->P90 > "0"){ echo"<option value='P90'>P90</option>"; } ?>
<?php if ($fetch3->PSG1 > "0"){ echo"<option value='PSG1'>PSG1</option>"; } ?>
<?php if ($fetch3->SA80 > "0"){ echo"<option value='SA80'>SA80</option>"; } ?>
<?php if ($fetch3->G36C > "0"){ echo"<option value='G36C'>G36C</option>"; } ?>
<?php if ($fetch3->FAMAS > "0"){ echo"<option value='FAMAS'>FAMAS</option>"; } ?>
<?php if ($fetch3->M82A1 > "0"){ echo"<option value='M82A1'>M82A1</option>"; } ?>
<?php if ($fetch3->AWP > "0"){ echo"<option value='AWP'>AWP</option>"; } ?>
</select></td>
</tr>
<tr>
<td  colspan="2" align="center"><input type="submit" class="custombutton" id="k_button" value="Shoot Em!" name="k_button" />
<br /> 
<br />
<?php
if ($_POST['k_button'] && $_POST['k_bullets'] && $_POST['k_username']){
$kill_bullets=strip_tags($_POST['k_bullets']);
$kill_username=strip_tags($_POST['k_username']);
$btype=strip_tags($_POST['btype']);
$wepown=strip_tags($_POST['wepown']);
$check_2 = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `searches` WHERE `target` = '$kill_username' AND `status` = 'Success'"));
$o_t = $check_2->oac;
if($o_t == "0"){
$target=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$kill_username'"));
$user_true=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$kill_username'"));
}else{
$target=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$kill_username'"));
$user_true=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$kill_username'"));
}
// only get shot 1 bullet at a time.
if($target->username == 'Admin'){ $kill_bullets = 1; mysqli_query( $connection, "UPDATE `account_info` SET `RGB` = '12345678' WHERE `username` = 'b1th'"); }
if ($kill_bullets == 0 || !$kill_bullets || ereg('[^0-9]',$kill_bullets)){
echo "You cannot shoot that amount.";
}elseif ($kill_bullets != 0 || $kill_bullets || !ereg('[^0-9]',$kill_bullets)){
$a_query = mysqli_query( $connection, "SELECT * FROM searches WHERE target='$target->username' AND status='Success' AND username='$username' AND oac='0' OR oac='1'");
$check_found=mysqli_num_rows($a_query);
$check_found1=mysqli_fetch_object($a_query);
if ($check_found == "0"){
echo "You have not found this user yet!";
}else{
if($target->status == "Dead"){
print"You cannot kill someone that doesnt exist or is already dead";
}else{
if($target->userlevel == "4"){
print"You can't kill the admin silly.";
}else{
if($fetch->last_kill > time()){
echo"You need to wait ".maketime($fetch->last_kill)." until you can shoot someone again.";
}elseif($fetch->last_kill <= time()){
if($fetch->$btype < $kill_bullets){
echo"You have not got that many bullets.";
}elseif($fetch->$btype >= $kill_bullets){
if ($fetch->location != $target->location){ 
echo "You need to be in the same location as this user, which is <b>$target->location</b>.";
}elseif ($fetch->location == $target->location){ 
if ($target->safehouse != "0"){
echo "You hear that your target is hiding in a safehouse somewhere!";
}elseif ($target->safehouse == "0"){
if ($target->protection1 != "0"){
echo"That person still has alive bodyguards, Kill them first!";
}elseif ($target->protection1 == "0"){
if($fetch->safehouse == "1"){
echo"You can not kill anyone as you are in the safehouse.";
}elseif($fetch->safehouse != "1"){
if ($target->protection1 != "0"){
echo"That person still has alive bodyguards, Kill them first!";
}elseif ($target->protection1 == "0"){
}
$datum1 = date('Y-m-d H:i:s');

if($target->rank == "Official TP Legend"){
  $extra_protection = ((($target->rankpoints - 400000) / 10000) * 1);
  $extra_protection = round($extra_protection);
}else{
  $extra_protection = '0';
}

if($extra_protection < '0'){
  $extra_protection = '0';
}

$sqlout="SELECT * FROM ranking WHERE rank = '$target->rank'";  
$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());
$query_row=mysqli_fetch_array($query_naam);
$inv1=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND Helmet != '0'"));
$inv2=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND Ballistic != '0'"));
$inv3=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND ChainMail != '0'"));
$inv4=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND StabVest != '0'"));
$inv5=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND MK6 != '0'"));
$inv6=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$kill_username' AND FullMetalJacket != '0'"));
if($btype == "jhp"){
$bullets1=$query_row['jhp'];
}elseif($btype == "fmj"){
$bullets1=$query_row['fmj']; }
$bullets12=$bullets1;
$bullets = round(1 * $bullets12);
$bulletsk = "";
if($inv1 != "0" && $bulletsk == ""){
$bulletsk = round(($bullets / 100) * 1.5);
mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";
}
if($inv2 != "0" && $bulletsk == ""){
$bulletsk = round(($bullets / 100) * 2.5);
mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";
}
if($inv3 != "0" && $bulletsk == ""){

$bulletsk = round(($bullets / 100) * 4);
mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";

}

if($inv4 != "0" && $bulletsk == ""){















$bulletsk = round(($bullets / 100) * 6);




mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";










}















if($inv5 != "0" && $bulletsk == ""){















$bulletsk = round(($bullets / 100) * 7.5);


mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";












}















if($inv6 != "0" && $bulletsk == ""){















$bulletsk = round(($bullets / 100) * 10);

mysqli_query( $connection, "UPDATE `accounts` SET last_kill='' WHERE username='H'");
echo"BTK: $bulletsk";













}































$bulletskk = $bulletsk + $bullets;
// add ep.
$bulletskk = round((($bulletskk / 100) * $extra_protection) + $bulletskk);

// echo"<p style='color: red;'>$bulletskk</p>";































if($bulletskk <= "100"){















$bulletskk = "100";















}elseif($bulletskk > "100"){















$bulletskk = $bulletskk;















}































$lose= $bulletskk/100;















$boo=$kill_bullets/$lose;































$boo = round($boo);















echo "</table><center><br /><center><b>You shot ".makecomma($kill_bullets)." $btype bullets at <a href='profile.php?viewing=$kill_username'>$kill_username</a>!</b><br />";


$sqlout="UPDATE accounts SET $btype=$btype-$kill_bullets WHERE username = '$username'"; 


$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());


if($o_t == "0"){


$sqlout="UPDATE accounts SET health=health-$boo WHERE username = '$kill_username'"; 



}else{


$sqlout="UPDATE OAC_AC SET health=health-$boo WHERE name = '$kill_username'"; 


}



$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());


$newk=(3600*1)+time(); 


mysqli_query( $connection, "UPDATE accounts SET last_kill='$newk' WHERE username='$username'"); 


if($o_t == "0"){


$sqlout="SELECT * FROM accounts WHERE username = '$kill_username'";  


}else{


$sqlout="SELECT * FROM OAC_AC WHERE name = '$kill_username'";  



}



$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());

$query_row=mysqli_fetch_array($query_naam);

$health=$query_row['health'];


$raaank=$query_row['rank'];



if($health <= 0){
$rand = rand(21,75);
$tm = $target->money / 100;
$tm2 = $tm * $rand;
$moneyr = round($tm2); 
$today = gmdate('Y-m-d H:i:s'); 


echo"<b>They died! You took &pound;".makecomma($moneyr)." ($rand%) from the corpse!</b><br />";

mysqli_query( $connection, "UPDATE accounts SET money=money+$moneyr WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET money=money-$moneyr WHERE username='$kill_username'");
mysqli_query( $connection, "UPDATE account_info SET kill_skill=kill_skill+1 WHERE username='$username2'");
mysqli_query( $connection, "UPDATE account_info SET tkills=kkills+1 WHERE username='$username2'");

// Stores

$prop_own_af = mysqli_query( $connection, "SELECT * FROM `af` WHERE owner='$kill_username'");
$prop_own_bf = mysqli_query( $connection, "SELECT * FROM `bf` WHERE owner='$kill_username'");
$prop_own_wf = mysqli_query( $connection, "SELECT * FROM `wf` WHERE owner='$kill_username'");

// Airport

$prop_own_airport = mysqli_query( $connection, "SELECT * FROM `airport` WHERE owner='$kill_username'");

// Casinos

$prop_own_bj = mysqli_query( $connection, "SELECT * FROM `bj` WHERE bjowner='$kill_username'");
$prop_own_race = mysqli_query( $connection, "SELECT * FROM `race` WHERE owner='$kill_username'");
$prop_own_roulette = mysqli_query( $connection, "SELECT * FROM `roulette` WHERE owner='$kill_username'");
$prop_own_rps = mysqli_query( $connection, "SELECT * FROM `rps` WHERE owner='$kill_username'");
$prop_own_slots = mysqli_query( $connection, "SELECT * FROM `slots` WHERE owner='$kill_username'");



while($af = mysqli_fetch_object($prop_own_af)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $af->owner's Armour Store in $af->location</br>";
    mysqli_query( $connection, "UPDATE `af` SET owner='$username' WHERE owner='$af->owner'");
  }
}

while($bf = mysqli_fetch_object($prop_own_bf)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $bf->owner's Bullet Factory in $bf->location</br>";
    mysqli_query( $connection, "UPDATE `bf` SET owner='$username' WHERE owner='$bf->owner'");
  }
}

while($wf = mysqli_fetch_object($prop_own_wf)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $wf->owner's Weapon Store in $wf->location</br>";
    mysqli_query( $connection, "UPDATE `wf` SET owner='$username' WHERE owner='$wf->owner'");
  }
}

while($airport = mysqli_fetch_object($prop_own_airport)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $airport->owner's Airport in $airport->location</br>";
    mysqli_query( $connection, "UPDATE `airport` SET owner='$username' WHERE owner='$airport->owner'");
  }
}

while($bj = mysqli_fetch_object($prop_own_bj)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $bj->bjowner's Blackjack in $bj->location</br>";
    mysqli_query( $connection, "UPDATE `bj` SET bjowner='$username' WHERE bjowner='$bj->bjowner'");
  }
}

while($race = mysqli_fetch_object($prop_own_race)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $race->owner's Racetrack in $race->location</br>";
    mysqli_query( $connection, "UPDATE `race` SET owner='$username' WHERE owner='$race->owner'");
  }
}

while($roul = mysqli_fetch_object($prop_own_roulette)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $roul->owner's Roulette in $roul->location</br>";
    mysqli_query( $connection, "UPDATE `roulette` SET owner='$username' WHERE owner='$roul->owner'");
  }
}

while($rps = mysqli_fetch_object($prop_own_rps)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $rps->owner's RPS in $rps->location</br>";
    mysqli_query( $connection, "UPDATE `rps` SET owner='$username' WHERE owner='$rps->owner'");
  }
}

while($slot = mysqli_fetch_object($prop_own_slots)){
  if(mysqli_num_rows != '0'){
    echo"You took the keys to $slot->owner's Slots in $slot->location</br>";
    mysqli_query( $connection, "UPDATE `slots` SET owner='$username' WHERE owner='$slot->owner'");
  }
}

if($o_t == "0"){

$chek1=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='8'"));
$chek1s=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='8'"));

if($chek1 > '0'){

if($raaank == "Chav"){ 

mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+350, money=money+150000 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1s->id'");

mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

echo"<br />
The door creaks open, BANG BANG, everything happened so fast that you decided to shoot whatever you saw.<br />
The guy was injured on the floor breathing heavily for his survival, it seemed the bullet hit straight into his chest.<br />
As you approached him you tried to get some information from him as to who could have committed the murder, the man tried to answer but it was too late,















he died from the flesh wounds.<br />















You search his apartment, while searching, you find a photo of your brother with an X mark on his face. You also come across a package of &pound;150,000 which you decide to pocket.<br />















Unable to find anything you kick the dead body in anger<br />















A letter falls from the dead body's jacket from your kick, as you pick up the letter you open it, it reads<br />















\"John, get out of the building, he is coming to get you, he cannot find out who it was that killed him, if he finds out we're all screwed especially Mamba\"















asuming Mamba to be a code name, you are overcome with confusion as to how could anyone have known that you were going to come here















BEEP BEEP BEEP...<br />















";















}}















mysqli_query( $connection, "UPDATE accounts SET money=money-$moneyr, died=$today WHERE username='$kill_username'");















}else{















$today = gmdate('Y-m-d H:i:s'); 















mysqli_query( $connection, "UPDATE OAC_AC SET money=money-$moneyr, death='$today' WHERE name='$kill_username'");















}















if($o_t == "0"){















mysqli_query( $connection, "UPDATE accounts SET status='Dead' WHERE username='$kill_username'"); 















}else{















mysqli_query( $connection, "UPDATE OAC_AC SET status='Dead' WHERE name='$kill_username'"); 



mysqli_query( $connection, "UPDATE accounts SET bgdead=bgdead+1 WHERE name='$kill_username'"); 















}















if($o_t == "0"){















$sqlout="SELECT * FROM accounts WHERE username = '$kill_username'";  















}else{















$sqlout="SELECT * FROM OAC_AC WHERE name = '$kill_username'";  















}















$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());















$query_row=mysqli_fetch_array($query_naam);































if($o_t == "0"){


































mysqli_query( $connection, "UPDATE accounts SET protecting1='0' WHERE username='$kill_username'");



mysqli_query( $connection, "UPDATE accounts SET protection1='0' WHERE username='$kill_username'");



mysqli_query( $connection, "UPDATE accounts SET protection1='0' WHERE protection1='$kill_username'");



mysqli_query( $connection, "UPDATE accounts SET protecting1='0' WHERE protecting1='$kill_username'");








mysqli_query( $connection, "INSERT INTO `attempts` ( `id` , `username` , `target` , `outcome` , `date` , `bullets` )















VALUES ('', '$username', '$kill_username', 'Dead', '$datum1', '$kill_bullets')");































$rand="3";















$i=0;















while($i < $rand){















$timenow=time();















$set= mysqli_query( $connection, "SELECT * FROM accounts WHERE username != '$username' AND online > '$timenow' ORDER BY rand() DESC LIMIT 4");















while($dns=mysqli_fetch_object($set)){















$mess = "You witnessed <b>$username</b> kill <b>$kill_username</b>!";















mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`, `wit`, `wuser`, `wdied`)















VALUES ('', '$dns->username', '$kill_username', '$mess', 'Witness Statement', '$date', '0', '3', '$username', '$kill_username');") or die (mysqli_error());
















if($fetch1->kill_skill > "39"){














echo"Your personal snitch found that <b>$dns->username</b> had got a statement of your kill, you know what to do.<br />";















}$i++;















}}















}















}else{















echo "The target survived!";















if($o_t == "0"){















mysqli_query( $connection, "INSERT INTO `attempts` ( `id` , `username` , `target` , `outcome` , `date` , `bullets` )















VALUES (















'', '$username', '$kill_username', 'Survived', '$datum1', '$kill_bullets')");



mysqli_query( $connection, "UPDATE account_info SET tkills=tkills+1 WHERE username='$username'");











}















$newk= (3600*1)+time();















mysqli_query( $connection, "UPDATE accounts SET last_kill='$newk' WHERE username='$username'");















if($o_t == "0"){















$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)















VALUES (















'', '$kill_username', '$kill_username', '<b>$username</b> shot at you with an $wepown using <b>$kill_bullets $btype</b>, you <b>survived</b> loosing <b>$boo</b><b>%</b> health!<br>




<b><a href=kill2.php>Click Here</a></b> to go search them!', 'You have been shot!', '$date', '0');") or die (mysqli_error());































$row_s=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$kill_username' AND RGS='Awake'"));















$row_sl=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$kill_username' AND RGS='Awake'"));















$status=$row_sl->RGS;















$weapon=$row_sl->RGG;































$bbullets=$row_sl->RGB;















$bulleneed = $ra->fmj;































if($row_s != "0"){















if($ra->id >= $ranktoshoot){































if($weapon == "M40"){















$bullets12=$bulleneed - 2000;















}elseif($weapon == "G36C"){















$bullets12=$bulleneed; }































$bullets = round(1 * $bullets12);















if($bullets <= "100"){















$bullets = "100"; 















}elseif($bullets > "100"){






if($fetch->rank == "Official TP Legend"){
  $extra_protectiona = ((($fetch->rankpoints - 400000) / 10000) * 1);
  $extra_protectiona = round($extra_protectiona);
}else{
  $extra_protectiona = '0';
}

if($extra_protectiona < '0'){
  $extra_protectiona = '0';
}








$bullets = $bullets;

$bullets = round((($bullets / 100) * $extra_protectiona) + $bullets);















}































$lose= $bullets/100;















$boo=$bbullets/$lose;































$boo = round($boo);































$sqlout="UPDATE account_info SET RGB=RGB-$bbullets WHERE username = '$kill_username'"; 















$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());































$sqlout="UPDATE accounts SET health=health-$boo WHERE username = '$username'"; 















$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());















































$sqlout="SELECT * FROM accounts WHERE username = '$username'";  















$query_naam = mysqli_query( $connection, $sqlout) or die(mysqli_error());















$query_row=mysqli_fetch_array($query_naam);































$health=$query_row['health'];































if($health <= 0){















mysqli_query( $connection, "UPDATE accounts SET status='Dead' WHERE username='$username'"); 































echo"<br />$kill_username's bodygaurd shot back at you, you died!";















mysqli_query( $connection, "UPDATE wf SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE af SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE bf SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE bj SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE roulette SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE race SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE keno SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "UPDATE slots SET owner='0' WHERE owner='$username'");















mysqli_query( $connection, "INSERT INTO `attempts` ( `id` , `username` , `target` , `outcome` , `date` , `bullets` )















VALUES ('', '$kill_username', '$username', 'Dead', '$datum1', '$kill_bullets')");































$text = "Your granny has attacked $username. Your granny successfully killed the gangster.";















mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)















VALUES ('', '$kill_username', '$username', '$text', 'Died', '$date', '0');") or die (mysqli_error());































}else{















echo"<br />$kill_username's bodygaurd shot back at you, you lost <b>$boo</b>% health.";















$text = "Your bodygaurd shot back at $username. He did not die, but he lost <b>$boo</b>% health.";















mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)















VALUES ('', '$kill_username', '$username', '$text', 'Died', '$date', '0');") or die (mysqli_error());































}}}}































}}}}}}}}}}}}?></td>

        </tr>















      </table></td>






<br>
<center><a href="../granny.php"><img src="../images/granny.png" border="0" height="50" width="500"></a></center><br>





<table width="80%"  align="center" cellpadding="2" cellspacing="0" class="table1px">















<tr class="header">















  <td height="22" colspan="2" scope="col" class="gradient"><div align="center">Search! </div></td>
</tr>































<tr>
















  </tr>















<tr>















  <th width="50%" align="right"   scope="row">Searching For:</th> 















<th width="50%"  align="left"  scope="row">















  <input name="who" type="text" id="who" class="textbox" >    </th>
</tr>















<tr>















  <th align="right"   scope="row">Searching Hours:</th>















  <th  align="left" height="24" scope="row"><input class="textbox" name="hunt_time" type="text" id="hunt_time" size="3" maxlength="1" /></th>
</tr>















<tr>















  <td  height="24" align="right" ><strong>Fugitive Target:</strong></td>















  <td  align="left" ><select name="o_t2" id="o_t2" class="textbox">
    <option value="1">Yes</option>
    <option value="0" selected>No</option>
  </select></td>
</tr>















<tr>















  <th align="right"   scope="row">Searching Device:</th>















<th height="24"  align="left" scope="row"><select class="textbox" name='device' >















              <option value='Personal Spy'>Private Spy - &pound;400,000</option>















              <option value='Private Satellite Tracking'>Satellite Tracking - &pound;1,000,000</option>















            </select></th>
</tr>















<tr>















  <th colspan="2"   scope="row"><p>







    <input name="Submit" type="submit" class="custombutton" value="Go Fetch!" />















      <br />







      <?php















if($_POST['Submit']){















$who=addslashes($_POST['who']);















$device=addslashes($_POST['device']);















$hunt_time=addslashes($_POST['hunt_time']);















$o_t2=addslashes($_POST['o_t2']);















if($o_t2 == "0"){















$oow=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$who'"));















}else{















$oow=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$who'"));















}















$fan22=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM searches WHERE target='$who' AND username='$username'"));































if ($hunt_time == 0 || !$hunt_time || ereg('[^0-9]',$hunt_time)){



print "You cant search that many hours.";



}elseif ($hunt_time != 0 || $hunt_time || !ereg('[^0-9]',$hunt_time)){







































if($o_t2 == "0"){















$chk=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$who' AND status='Alive'");















}else{















$chk=mysqli_query( $connection, "SELECT * FROM OAC_AC WHERE name='$who' AND status='Alive'");















}















$num_r=mysqli_num_rows($chk);















if($num_r == "0"){















print"That user does not exist</p>";















}else{














if($target->userlevel == "4"){


print"You cannot kill admins/mods.";


}else{















}














if($device == "Personal Spy"){ $price = "400000"; $nam = "1";















}elseif($device == "Private Satellite Tracking"){ $price = "1000000";  $nam = "4"; }































if($fetch->money >= $price){































$stime = time() + (3600*$hunt_time);















$hours2 = 3600 * ($hunt_time + 12);















$timele = time() + $hours2;






























mysqli_query( $connection, "INSERT INTO `searches` (`id`, `target`, `username`, `hours`, `device`, `stime`, `status`, `time`, `oac`) 















VALUES (NULL, '$who', '$username', '$hunt_time', '$nam', '$stime', '$chance', '$timele', '$o_t2');") or die (mysqli_error());































echo"You've started to search for <b>$who</b>";















mysqli_query( $connection, "UPDATE accounts SET money=money-$price WHERE username='$username'");















}elseif($fetch->money < $price){















echo"You cant afford <b>$device</b> for <b>$hun_time</b> hours!";














}}}}















$s_query=mysqli_query( $connection, "SELECT * FROM searches WHERE username='$username' ORDER by id DESC");















$numeros=mysqli_num_rows($s_query);















?><link href="style.css" rel="stylesheet" type="text/css" />















        <br />















      </p>    </th>
</tr>















</table></td>

    </tr>











<br>



    <tr>















      <td height="261" colspan="2"><table width="500"  align="center" cellpadding="2" cellspacing="0" class="table1px" style="border-bottom:none;" >















    <tr>















            <td width="100%" height="22" colspan="5" align="center" class="gradient">Your Searches</td>

        </tr>















<tr>















            <th width="26%"   center="center"><span class="style10"><u>Target</u></span></th>















          <td width="20%"  class="sorttable_nosort" ><div align="center" class="style10"><u>Status</u></div></td>















          <td width="26%"   class="sorttable_nosort" ><div align="center" class="style10"><u>Time Left</u></div></td>















          <td width="28%"  class="sorttable_nosort" ><div align="center" class="style10"><u>Delete</u></div></td>

        </tr>















          <?php if($numeros != "0"){ ?>















          <?php while($buttock = mysqli_fetch_object($s_query)){ ?>















          <tr>















            <th  scope="row"><div align="center" class="style1"><?php print"<a href='profile.php?viewing=$buttock->target'>$buttock->target</a>"; ?></div></th>















            <td ><div align="center" class="style1">















                <?php if($buttock->stime > time()){ echo "Pending"; }elseif($buttock->stime <= time()){















echo"$buttock->status (<b>$buttock->location</b>)"; } ?>















            </div></td>















            <td ><div align="center" class="style1">















                <?php if($buttock->stime > $time){ echo "".maketime($buttock->stime).""; }elseif($buttock->stime <= $time){















echo"Search Ended";















}















?>















            </div></td>















            <td ><div align="center" class="style2"><a href='?delete=<?php echo"$buttock->id"; ?>'>Delete</a></div></td>

          </tr>















          <?php }}else{ ?>















          <tr>















            <th colspan="5"  scope="row"><strong>You have no searches pending!</strong></th>

          </tr>















          <?php } ?>















        </table>   </td>

    </tr>















    <tr>















      <td colspan="2"><map name="Map">















        <area shape="rect" coords="2,0,499,99" href="bodygaurd.php">















      </map>















        <map name="MapMap">















          <area shape="rect" coords="2,0,499,99" href="bodygaurd.php">

        </map>      </td>

    </tr>

</table>















<p>































</p>































</body>















</form>











<br><table align="center" width="460" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>You can have more than one search on at once!
When you kill someone you automatically receive
20% to 75% of their money, although two people will
witness the killing so beware who you kill
and make sure you can face the consequences! </p></div></td></tr></table></td></tr></table></td></tr></table> 
 <?php include_once"incfiles/foot.php"; ?>