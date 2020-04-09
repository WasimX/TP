<?php
session_start();
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
include "incfiles/connectdb.php";



$date = gmdate('Y-m-d H:i:s');
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$r=mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'");
$rank=mysqli_fetch_object($r);

$cquery=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'");
$fetchc=mysqli_fetch_object($cquery);
$numroc=mysqli_num_rows($cquery);

$pe = explode("-", $fetchc->per);


if($fetchc->crush == "1" && $fetchc->ctime <= time()){
mysqli_query( $connection, "UPDATE crews SET crush='0', ctime='' WHERE name='$fetch->crew'");
}

if($fetchc->owner != "0"){
$owne = $fetchc->owner;
}elseif($fetchc->owner == "0"){
$owne = "None";
}
if($fetchc->underboss != "0"){
$undeer = $fetchc->underboss;
}elseif($fetchc->underboss == "0"){
$undeer = "None";
}
if($fetchc->lhm != "0"){
$lhmss = $fetchc->lhm;
}elseif($fetchc->lhm == "0"){
$lhmss = "None";
}
if($fetchc->rhm != "0"){
$rhmss = $fetchc->rhm;
}elseif($fetchc->rhm == "0"){
$rhmss = "None";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thug Paradise 2 :: Gangs</title>
<script language="JavaScript" src="../FCharts/JSClass/FusionCharts.js"></script>
<script language = "javascript">
<!--

function shouldset(passon){
if(document.areas.hexvalue.value.length == 7){setcolor(passon)}
}

function setcolor(elem){
document.areas.hexvalue.value=elem
     document.areas.selcolor.style.backgroundColor=elem
}



//-->
</script>
<style type="text/css">
<!--
body,td,th {
	font-size: 10px;
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold
}
.style1 {color: #FFFFFF}
-->
</style>
</head>
<link href="../style.css" rel="stylesheet" type="text/css">
<body>
<?php if ($fetch->crew > "1"){ ?>
<table align="center" colspan="3" height="34" border="0" cellspacing="0" class="table1px"><tr><td width="500" class="gradient"><b>Navigation Bar</b></td></tr><tr><td class="tableborder"><div align="center"><p align="center"><a href="../Gang_Acc.php"> Acceptance</a> &raquo; <a href="../Gang_Pro.php"> Gang Profile</a> &raquo; <a href="../Gang_Not.php"> Notices</a> &raquo; <a href="../Gang_Mem.php"> Member Options</a> - <a href="../gangCountry.php"> Gang Country</a> &raquo; <a href="../soon.php"> Drive-By</a><font color=red>*</font></p></div></td></tr></table><p></p>
	  <?php } ?>
<form method='post' id='mbpost' name="areas" enctype='multipart/form-data'>
  <p>
    <?php
if($fetch->crew == "0"){

if($_GET['a'] == "accept"){
$boss = $_GET['und'];
$inb=mysqli_query( $connection, "SELECT * FROM inbox WHERE `crewu`='$boss' AND `to`='$username'");
$inbox=mysqli_fetch_object($inb);
$ro=mysqli_num_rows($inb);
if($ro == "0"){
echo"There is no such underboss invite.";
}elseif($ro != "0"){
$fetb = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$boss'"));
if($fetb->status != "Alive"){
echo"That boss is now dead.";
}elseif($fetb->status == "Alive"){
if($fetb->money < "50000000"){
echo"That boss cant afford the crew.";
}elseif($fetb->money >= "50000000"){
mysqli_query( $connection, "UPDATE accounts SET money=money-50000000 WHERE username='$boss'");
mysqli_query( $connection, "INSERT INTO `crews` (`id`, `owner`, `lhm`, `underboss`, `rhm`, `name`, `recruiting`, `money`, `quote`, `bank`, `fmj`, `jhp`) 
VALUES (NULL, '$boss', '0', '$username', '0', '$inbox->crewin', '1', '0', '', '0', '0', '0')");
mysqli_query( $connection, "UPDATE accounts SET crew='$inbox->crewin', crewrank='Boss' WHERE username='$boss'"); 
mysqli_query( $connection, "UPDATE accounts SET crew='$inbox->crewin', crewrank='Underboss' WHERE username='$username'"); 
echo"The crew has been made and $boss has been charged."; 
}}}}
?>
    <?php $numb = mysqli_query( $connection, "SELECT name FROM crews");
$numroc = mysqli_num_rows($numb); 

if ($numroc <= "11") { ?>
</p>
  <table width=600 border="0" align="center" class="table1px" cellpadding="2" cellspacing="0">
    <tr>
      <td height="22" colspan=2 align=center  class="gradient"><font color=#FFFFFF><b>Create a Gang</b></font></td>
    </tr>
    <tr>
      <td colspan=2 align="center"  class="tableborder"><span class="style1">It will cost £50,000,000 to make a gang. Making a gang will give you a non stop supply of protection. When you have a gang you have many options, like message all users, make gang wars, make a strong top four, etc. Beware there are a maximum of 10 Gangs, to take-over a gang click  <a href="../Gang_Inf.php">HERE</a>.</span></td>
    </tr>
    <tr>
      <td width="37%" align="center"  class="tableborder"><span class="style1">Gang Name:</span></td>
      <td width="63%" align="left"  class="tableborder"><input name=crewname class="textbox" type=text size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td width="37%" align="center"  class="tableborder"><span class="style1">Underboss:</span></td>
      <td width="63%" align="left"  class="tableborder"><input name="underboss" class="textbox" type="text" value="" size="25" /></td>
    </tr>
    <tr>
      <td colspan=2 align="center"  class="tableborder"><center class="style1">
          <span class="style1">The Underboss needs to accept the Underboss application before the crew is fully made. Please note that the crew place could go at any time. <br />
          </span> <br />
        <input type=submit class="custombutton" value="Create Gang!" name='Create' />
          <br />
          <br />
        <?php
$wanka = mysqli_query( $connection, "SELECT * FROM crews");
$cnt = mysqli_fetch_row($wanka);
if ($_POST['Create'] && $_POST['crewname']){
$underboss=strip_tags($_POST['underboss']);
$crewname=strip_tags($_POST['crewname']);

$sql_username_check = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$underboss' AND status='Alive' AND crew='0' LIMIT 1"); 
$username_check = mysqli_num_rows($sql_username_check); 

$numb = mysqli_query( $connection, "SELECT * FROM crews");
$numroc = mysqli_num_rows($numb);

if($numroc >= '11'){
echo"There is a maximum of 10 crews in the game, this is not counting the \"Staff Crew\".";
}elseif($numroc < '11'){

if($username_check == 0){ 
   echo "That underboss is dead, or is already in a crew!";
}elseif($username_check != 0){ 

if($underboss == $username){  
   echo "You cannot invite yourself as underboss.";
}elseif($underboss != $username){ 

if (ereg('[^A-Za-z0-9 _]', $crewname)) {  echo "Gang Names can only contain letters, numbers and spaces.";
}elseif (!ereg('[^A-Za-z0-9 _]', $crewname)) { 


if (strlen($crewname) <= 4 || strlen($crewname) >= 20){
echo "Gang name too big or small.";
}elseif (strlen($crewname) > 4 || strlen($crewname) < 20){

if($fetch->money < '50000000'){
echo"You haven't got enough money!";
}else{
$text = "<center>\[user\]$username\[/user\] would like to know if you will be his Crew Underboss, for the crew named $crewname.
<a href=\"gangs.php?und=$username&&a=accept\">Accept</a>          -        <a href=\"gangs.php?und=$username&&a=decline\">Decline</a></center>";

$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read` , `crewin` , `crewu`)
VALUES (
'', '$underboss', '$username', '$text', '<b>Underboss</b>', '$date', '0', '$crewname', '$username');") or die (mysqli_error());

echo"You have sent an underboss application to <a href='javascript: ;' onclick=\"modal('prof2.php?viewuser=$underboss','<div class=\'header1\'>$underboss\'s Profile</div>','950','600');\">$underboss</a> for the crew: <b>$crewname</b>.";
}}}}}}}

		  ?>
      </center></td>
    </tr>
  </table>
  <br />
  <?php } ?>
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
    <tr>
      <td width="100%" height="22" align="center" class="gradient"><font color="#FFFFFF"><b>Join a Gang</b></font></td>
    </tr>
    <tr>
      <td align="center" class="tableborder"><br />
        <select name="apply" class="textbox">
          <?php
  $gather22 = mysqli_query( $connection, "SELECT * FROM crews WHERE recruiting='1'");
  while($object22=mysqli_fetch_object($gather22)){
  echo "<option value='$object22->name'>$object22->name</option>";
    }?>
        </select>
        <br />
        <br />
        <span class="style1">
        <input type="submit" class="custombutton" value="Apply" name='ap' />
        </span><br />
        <br />
        <?php
 
if($_POST['ap']){ 
$apply=strip_tags($_POST['apply']);
$biatch = mysqli_query( $connection, "SELECT * FROM crews WHERE name='$apply'");
$fucktard = mysqli_fetch_object($biatch);
$biatch9 = mysqli_query( $connection, "SELECT * FROM crew_app WHERE username='$username' AND crew='$apply'");
$fucktard9 = mysqli_num_rows($biatch9);
$chk=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
if($chk->crew != '0'){die("You are in a crew already!");}
if($biatch == 'TP Crew'){die("The TP Crew is for staff only.");}
if($fucktard->recruiting == "1"){ 
$no = "1";
}
if($rank->id >= $fucktard->ranka){ 
$no2 = "1"; 
}elseif($rank->id < $fucktard->ranka){
$no2 = "2"; }

if($no2 == "2"){
echo"The crew is not applying your rank.";
}else{
if ($no == "1") {
mysqli_query( $connection, "UPDATE accounts SET crewappl='$apply' WHERE username='$username'") or die("Couldn't apply because of a technical error!");
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'") or die("Couldn't apply because of a technical error!");
print"You've applied to join $apply, you can only apply for one crew at the same time!";
}}}?><br />
</td>
    </tr>
  </table>
  <br />
  <p><br />
    <br />
    <?php
 }elseif($fetch->crew != "0"){ 
  ?>
    <?php  if($fetchc->owner == $username || $fetchc->underboss == $username || $fetchc->lhm == $username || $fetchc->rhm == $username){  

	?>
</p>
  
  <?php if($fetchc->owner == $username){  ?>
  <table width="400" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
    <tr>
      <td height="22" colspan="5" class="gradient"><div align="center">Staff Permissions
      </div>        <center>
        </center></td>
    </tr>
    <tr>
      <td height="22" colspan="5" align="center"><em>Here you can change what the Underboss, LHM and RHM can control. </em></td>
    </tr>
    <tr>
      <td width="30%" align="center" class="tableborder">Control</td>
      <td width="23%" align="center" class="tableborder">Underboss</td>
      <td width="22%" align="center" class="tableborder">Left Hand Man</td>
      <td width="25%" align="center" class="tableborder">Right Hand Man</td>
    </tr>
    <tr>
      <td align="center" >Kicking Members</td>
      <td align="center" ><label>
        <input type="checkbox" name="checkbox" id="checkbox" <?php if($pe[0] == "1"){ echo"checked"; } ?> value="1" />
      </label></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[1] == "1"){ echo"checked"; } ?> name="checkbox2" id="checkbox12" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[2] == "1"){ echo"checked"; } ?>  name="checkbox3" id="checkbox13" /></td>
    </tr>
    <tr>
      <td align="center" class="tableborder">Gang Profile</td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[3] == "1"){ echo"checked"; } ?>  name="checkbox4" id="checkbox2" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[4] == "1"){ echo"checked"; } ?>  name="checkbox5" id="checkbox11" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[5] == "1"){ echo"checked"; } ?>  name="checkbox6" id="checkbox14" /></td>
    </tr>
    <tr>
      <td align="center" class="tableborder">Gang Stash</td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[6] == "1"){ echo"checked"; } ?>  name="checkbox7" id="checkbox3" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[7] == "1"){ echo"checked"; } ?>  name="checkbox8" id="checkbox10" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[8] == "1"){ echo"checked"; } ?>  name="checkbox9" id="checkbox15" /></td>
    </tr>
    <tr>
      <td align="center" class="tableborder">Mass Message</td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[9] == "1"){ echo"checked"; } ?>  name="checkbox10" id="checkbox4" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[10] == "1"){ echo"checked"; } ?>  name="checkbox11" id="checkbox9" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[11] == "1"){ echo"checked"; } ?>  name="checkbox12" id="checkbox16" /></td>
    </tr>
    <tr>
      <td align="center" class="tableborder">Gang Forum</td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[12] == "1"){ echo"checked"; } ?>  name="checkbox13" id="checkbox5" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[13] == "1"){ echo"checked"; } ?>  name="checkbox14" id="checkbox8" /></td>
      <td align="center" class="tableborder"><input type="checkbox" <?php if($pe[14] == "1"){ echo"checked"; } ?>  name="checkbox15" id="checkbox17" /></td>
    </tr>
    <tr>
      <td colspan="4" align="center" class="tableborder"><input type="submit" class="custombutton" value="Change" name='perm' />
     <br />
   <?php
				  if ($_POST['perm']){
				  
				  if($_POST['checkbox']){ $per1 = "1"; }elseif(!$_POST['checkbox']){ $per1 = "0"; }
				  if($_POST['checkbox2']){ $per2 = "1"; }elseif(!$_POST['checkbox2']){ $per2 = "0"; }
				  if($_POST['checkbox3']){ $per3 = "1"; }elseif(!$_POST['checkbox3']){ $per3 = "0"; }
				  if($_POST['checkbox4']){ $per4 = "1"; }elseif(!$_POST['checkbox4']){ $per4 = "0"; }
				  if($_POST['checkbox5']){ $per5 = "1"; }elseif(!$_POST['checkbox5']){ $per5 = "0"; }
				  if($_POST['checkbox6']){ $per6 = "1"; }elseif(!$_POST['checkbox6']){ $per6 = "0"; }
				  if($_POST['checkbox7']){ $per7 = "1"; }elseif(!$_POST['checkbox7']){ $per7 = "0"; }
				  if($_POST['checkbox8']){ $per8 = "1"; }elseif(!$_POST['checkbox8']){ $per8 = "0"; }
				  if($_POST['checkbox9']){ $per9 = "1"; }elseif(!$_POST['checkbox9']){ $per9 = "0"; }
				  if($_POST['checkbox10']){ $per10 = "1"; }elseif(!$_POST['checkbox10']){ $per10 = "0"; }
				  if($_POST['checkbox11']){ $per11 = "1"; }elseif(!$_POST['checkbox11']){ $per11 = "0"; }
				  if($_POST['checkbox12']){ $per12 = "1"; }elseif(!$_POST['checkbox12']){ $per12 = "0"; }
				  if($_POST['checkbox13']){ $per13 = "1"; }elseif(!$_POST['checkbox13']){ $per13 = "0"; }	
				  if($_POST['checkbox14']){ $per14 = "1"; }elseif(!$_POST['checkbox14']){ $per14 = "0"; }
				  if($_POST['checkbox15']){ $per15 = "1"; }elseif(!$_POST['checkbox15']){ $per15 = "0"; }		  
				  $newcbox = "$per1-$per2-$per3-$per4-$per5-$per6-$per7-$per8-$per9-$per10-$per11-$per12-$per13-$per14-$per15";
				  mysqli_query( $connection, "UPDATE crews SET per='$newcbox' WHERE name='$fetch->crew' AND owner='$username'");
                  echo"You updated the gang permissions.";

				  }
				  ?>      </td>
    </tr>
  </table>
  <?php } ?>
  <br />
  <br />
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="2"  align="center" valign="top"><?php if($fetchc->lhm == $username && $pe[7] == "1" || $fetchc->underboss == $username && $pe[6] == "1" || $fetchc->owner == $username || $fetchc->rhm == $username  && $pe[8] == "1"){  ?>
          <table width="600" border="0" align="center" cellpadding="2" cellspacing="0"  class="thinline">
            <tr>
              <td width="100%" height="22" class="gradient"><center>
                Gangs Bullet Stash
              </center></td>
            </tr>
            <tr>
              <td align="center" class="tableborder"><p>
                FMJ: <?php echo"".makecomma($fetchc->fmj)."";?><br />
                JHP: <?php echo"".makecomma($fetchc->jhp)."";?><br />
                <br />
                Withdraw:
                <input name="with2" class="textbox" type="text" id="with2" size="6" />
                &nbsp;&nbsp;&nbsp;
                <select class="textbox" name="select5" id="select">
                  <option value="fmj">FMJ</option>
                  <option value="jhp">JHP</option>
                </select>
                <br />
                <br />
                <input type="submit" class="custombutton" value="Withdraw!" name="rec5" />
                <br />
                <br />
                <?php if (strip_tags($_POST['rec5']) && strip_tags($_POST['with2'])){
				if(($fetchc->lhm == $username && $pe[7] == "1") || ($fetchc->underboss == $username && $pe[6] == "1") || ($fetchc->owner == $username) || ($fetchc->rhm == $username  && $pe[8] == "1")){
				
$with2=strip_tags($_POST['with2']);
$select5=strip_tags($_POST['select5']);

		if ($with2 == 0 || !$with2 || ereg('[^0-9]',$with2)){
	print "You can't withdraw that amount.";
}elseif ($with2 != 0 && $with2 && !ereg('[^0-9]',$with2)){

	if ($with2 > $fetchc->$select5){
	echo "The crew has not got that much $select5 in its stash.";
	}else{ 
	
	


	mysqli_query( $connection, "UPDATE account_info SET $select5 = $select5 + $with2 WHERE username='$username'");
	mysqli_query( $connection, "UPDATE crews SET $select5 = $select5 - $with2 WHERE name='$fetchc->name'");
echo "You have withdrawn ".makecomma($with2)." $select5 bullets from $fetch->crew's Gang stash.";}}
}else{ echo"Wrong cowboy!"; }}?>
                <br />
              </p></td>
            </tr>
          </table>
    <br />
          <table width="600" border="0" align="center" cellpadding="2" cellspacing="0" class="thinline">
            <tr>
              <td width="100%" height="22" class="gradient"><center>
                Gangs Money Stash
              </center></td>
            </tr>
            <tr>
              <td class="tableborder" align="center">Gangs Stash: <?php echo"&pound;".makecomma($fetchc->money)."";?><br />
                  <br />
                  <label> Withdraw:
                    <input type="text" class="textbox" name="with" id="with" />
                  </label>
                  <br />
                <br />
                  <input type="submit" class="custombutton" value="Withdraw!" name='rec4' />
                  <br />
                <br />
                  <?php if (strip_tags($_POST['rec4']) && strip_tags($_POST['with'])){
				  		if($fetchc->lhm == $username && $pe[7] == "1" || $fetchc->underboss == $username && $pe[6] == "1" || $fetchc->owner == $username || $fetchc->rhm == $username  && $pe[8] == "1"){
$with=intval(strip_tags($_POST['with']));

		if ($with == 0 || !$with || ereg('[^0-9]',$with)){
	print "You cant withdraw that amount.";
}elseif ($with != 0 && $with && !ereg('[^0-9]',$with)){

	if ($with > $fetchc->money){
	echo "The crew has not got that much in its stash.";
	}elseif ($with <= $fetch->money){

	mysqli_query( $connection, "UPDATE accounts SET money=money+$with WHERE username='$username'");
	mysqli_query( $connection, "UPDATE crews SET money=money-$with WHERE name='$fetch->crew'");
	
echo "You have withdrawn £".makecomma($with)." from $fetch->crew's Gang Stash!";

}}}}?></td>
            </tr>
          </table>
    <?php } ?>
          <br />
          <br /></td>
    </tr></table>
    <table  align="center" >
    <tr><?php if($fetchc->lhm == $username && $pe[10] == "1" || $fetchc->underboss == $username && $pe[9] == "1" || $fetchc->owner == $username || $fetchc->rhm == $username  && $pe[11] == "1"){  ?>
      <td height="109" colspan="0"  align="center" valign="top">
          <table width="600" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
            <tr>
              <td width="100%" height="22" class="gradient"><center>
                Mass Message
              </center></td>
            </tr>
            <tr>
              <td align="center" class="tableborder"><em>Note, if you use this following form for spam, you will recieve a modkill. </em><br />
                  <br />
                Subject: &nbsp;
                <input name="to2" class="textbox" type="text" id="to2" value="None" size="20" maxlength="20" />
                <br />
                <br />
                Message Content <br />
                <textarea class="textbox" name="ww" cols="75" rows="15" id="ww" onclick='storeCaret(this)' onkeyup='storeCaret(this)' onfocus='storeCaret(this)' onmouseout='storeCaret(this)'></textarea>
                <br />
                <br />
                <input type="submit" class="custombutton" value="Message Em!" name='rec42' />
                <br />
                <br />
                <?php if (strip_tags($_POST['rec42']) && strip_tags($_POST['ww'])){
$to2=strip_tags($_POST['to2']);
$ww=strip_tags($_POST['ww']);
  $querwwy=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew'");
  while($cooddl = mysqli_fetch_object($querwwy)){
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$cooddl->username', '$username', '$ww', '$to2', '$date', '0');") or die (mysqli_error());	
echo"Messages sent to all of the crew members.";	}}?></td>
            </tr>
          </table>
        </td>
		<tr>
        <?php if($fetchc->owner == $username){  ?>
      <td valign="top">
          <table width="600" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
            <tr>
              <td width="100%" height="22" class="gradient"><center>
                Change Gangs Name
              </center></td>
            </tr>
            <tr>
              <td class="tableborder" align="center"><label>Name:
                <input type="text" name="with3" class="textbox" id="with3" />
              </label></td>
            </tr>
            <tr>
              <td height="22" colspan="4" align="center" class="topic">Password</td>
            </tr>
            <tr>
              <td class="tableborder" align="center" colspan="4"><label>
                <input type="password" name="passwordss2" class="textbox" id="passwordss2" />
              </label></td>
            </tr>
            <tr>
              <td class="tableborder" align="center" colspan="4"><em>It costs &pound;10,000,000 to change the gangs name, but it makes sure that all your stuff; forum, bank money, bullets, is kept, along with users, and everthing else. </em><br />
                  <br />
                <input type="submit" class="custombutton" value="Change Name!" name='rec43' />
                  <br />
                <br />
                  <?php if (strip_tags($_POST['rec43']) && strip_tags($_POST['with3'])){
			$newname=strip_tags($_POST['with3']);
					  if ($_POST['passwordss2'] != $fetch->password){
		  echo"The password is incorrect!";
		  }elseif ($_POST['passwordss2'] == $fetch->password){
			if ($fetch->money < "10000000"){
	echo "You have not got &pound;10,000,000";
	}elseif ($fetch->money >= "10000000"){
	
if (ereg('[^A-Za-z0-9 _]', $newname)) {  echo "Gang Names can only contain letters, numbers and spaces.";
}elseif (!ereg('[^A-Za-z0-9 _]', $newname)) { 


if (strlen($newname) <= 4 || strlen($newname) >= 20){
echo "Gang name too big or small.";
}elseif (strlen($newname) > 4 || strlen($newname) < 20){

 $check = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$newname'"));

if($check != "0"){
echo"There is already a crew with that name.";
}elseif($check == "0"){
mysqli_query( $connection, "UPDATE accounts SET money=money-10000000 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crew = '$newname' WHERE crew='$fetch->crew'");
mysqli_query( $connection, "UPDATE crews SET name = '$newname' WHERE name='$fetch->crew'"); 
mysqli_query( $connection, "UPDATE topics SET gname = '$newname' WHERE gname='$fetch->crew'");
mysqli_query( $connection, "UPDATE accounts SET gang = '$newname' WHERE gang='$fetch->crew'");

echo"You changed the crews name to $newname";

 }}}}}}?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><?php }else{ ?> 
            <td align="right" valign="top">        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
            <tr>
              <td width="100%" height="22" class="topic"><center>
                Change Gangs Name
              </center></td>
            </tr>
            <tr>
              <td height="75" colspan="4" align="center" valign="top" class="tableborder">You need to get your Boss to enable this for your crew rank status.     </td>
            </tr>
      </table></td>
      <?php } ?>
		<?php } ?>
    </tr>
  </table>
  <?php  } ?>
<br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="57%" valign="bottom"><table width="73%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
        <tr>
          <td colspan="3" align="center" height="22" class="gradient">Gangs Transfers</td>
        </tr>
        <tr>
          <td width="242" align=center class="tableborder">Username</td>
          <td width="192" height="20" align="center" class="tableborder">Amount</td>
          <td width="191" align="center" class="tableborder">Date</td>
        </tr>
        <?php $k=mysqli_query( $connection, "SELECT * FROM `transfers` WHERE `to`='$fetchc->name' AND crew='1' ORDER BY date DESC LIMIT 5");
       while($p=mysqli_fetch_object($k)){
	   echo "		</tr>
        <tr>
          <td width=\"197\"  align=center><a href='profile.php?viewing=$p->from'>$p->from</a></td>
          <td width=\"256\" align=center height=\"20\">£".makecomma($p->amount)."</td>
          <td width=\"308\" align=center>$p->date</td>
        </tr>	
		";
		}
		?>
      </table>
      <br />
      <br /></td>
      <td width="43%" align="center" valign="bottom"><table width="98%" height="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
        <tr>
          <td height="22" align="center" class="gradient">Members Online</td>
        </tr>
        <tr>
          <td align="center" class="tableborder"><?php $timenow=time();
	$peopless = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND online > '$timenow'");
	while($isss =mysqli_fetch_object($peopless)){
	echo "<a href='profile.php?viewing=$isss->username'>$isss->username</a>, "; 
	}
	
	?>
            <br /><br /></td>
        </tr>
      </table>
      <br /></td>
    </tr>
    <tr>
      <td align="center" valign="top">
        <table width="41%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
        <tr>
          <td width="761" height="22" align="center" class="gradient">Gang Options </td>
        </tr>
        <tr>
          <td class="tableborder" align="center" ><p>If you leave your gang, you will not be able to join again without applying.</p>
            <p>
              <input type="submit" class="custombutton" name="leave" id="leave" value="Leave Gang" />
              <br />
              <?php
		  
		  
		   if ($_POST['leave']){
$cquery=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'");
$fetchc=mysqli_fetch_object($cquery);
$rand = rand(5,49);

if ($fetch->crewrank == "Boss"){
mysqli_query( $connection, "UPDATE crews SET owner='$fetchc->underboss', underboss='0' WHERE name='$fetch->crew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
}elseif ($fetch->crewrank == "Underboss"){
mysqli_query( $connection, "UPDATE crews SET underboss='0' WHERE name='$fetch->crew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
}elseif ($fetch->crewrank == "RHM"){
mysqli_query( $connection, "UPDATE crews SET rhm='0' WHERE name='$fetch->crew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
}elseif ($fetch->crewrank == "LHM"){
mysqli_query( $connection, "UPDATE crews SET lhm='0' WHERE name='$fetch->crew'"); 
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
}elseif ($fetch->crewrank == "Member"){
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewrank='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$rand WHERE username='$username'");
} 
echo "You left your gang! Your ex-gang members found out about your departure and performed a drive-by on you. You survived and lost $rand% health.
<img src='../images/driveby.png'>";
}
?>
            &nbsp;</p></td>
        </tr>
      </table>
      </td>
      <td align="center" valign="bottom"><table width="88%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
        <tr>
          <td width="100%" height="22" align="center" class="gradient" >Gangs Stash</td>
        </tr>
        <tr>
          <td align="center" class="tableborder">Money: <?php echo"&pound;".makecomma($fetchc->money)."";?><br /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center" valign="middle" colspan="2"><br />        <br /></td> 
    </tr>
  </table>
  <br />
  <p>&nbsp;</p>
 <p>
  
     <?php
 }
  
  ?>
    <br />
  </p>
</form></body>
</html>
<?php include_once "incfiles/foot.php"; ?>
