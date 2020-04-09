<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

mysqli_query( $connection, "DELETE * FROM inbox WHERE to='FakeUser1'");
mysqli_query( $connection, "DELETE * FROM inbox WHERE to='FakeUser2'");
mysqli_query( $connection, "DELETE * FROM inbox WHERE to='Crackhead Cell'");

$username = $_SESSION['username'];
$mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($mysqli);
$saved=$_GET['saved'];
if(!$_GET['saved']){ 
$saved = "0"; 
}elseif($_GET['saved']){
$saved = "1";
}
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE status != 'Alive'");
while($de=mysqli_fetch_object($query)){
mysqli_query( $connection, "DELETE FROM inbox WHERE to='$de->username'");
}

if($_GET['inv'] && $_GET['cd']){
	if($fetch->safehouse != '0'){
		die('You are safehoused.');
	}
$inv=$_GET['inv']; $id=$_GET['cd'];
if($inv == "accept"){
$invsql = mysqli_query( $connection, "SELECT * FROM boat WHERE id='$id'");
$fetchki=mysqli_fetch_object($invsql);  $fetinv=mysqli_num_rows($invsql);
if($fetinv == '0'){
echo" <br>That Boat Jack is not real!";
}elseif($fetinv != '0'){
if($fetch->boat == "1"){
echo" <br>Your already in a boat jack.";
}elseif($fetch->boat == "0"){
if($fetch->boat_last > time()){
echo" <br>You've still got to wait ".maketime($fetch->boat_last)." untill you can Boat Jack again.";
}elseif($fetch->boat_last < time()){
if($fetchki->side != ''){
echo" <br>That place is already took!";
}elseif($fetchki->side == ''){
mysqli_query( $connection, "UPDATE accounts SET boat='1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE boat SET side='$username', sidestuff='' WHERE id='$id'");
echo" <br>You are now in that Boat Jack.";
echo"<meta http-equiv=\"refresh\" content=\"1;url=boatcrime.php\">";
}}}}}elseif($inv == "decline"){
}}



if($_GET['protectac'] && $_GET['protect']){
	if($fetch->safehouse != '0'){
		die('You are safehoused.');
	}
$protectac=$_GET['protectac']; 
$usernamefrom=$_GET['protect'];
$newera = mysqli_query( $connection, "SELECT * FROM proinv WHERE username='$usernamefrom' AND invite='$username'");
$fetcha=mysqli_fetch_object($newera);        
$checka=mysqli_num_rows($newera);
$fetchnew=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$usernamefrom'"));
$datenow = gmdate('Y-m-d H:i:s');
$newp_time=time()+86400;
$newpp_time=time()+86401;
if($protectac == "accept"){
if ($fetch->protecting1 != "0"){ echo "You are already protecting someone!"; }elseif ($fetch->protecting1 == "0"){
if ($fetch->protection1 != "0"){ echo "You have protection!"; }elseif ($fetch->protection1 == "0"){
if ($checka == "0"){ echo "This user has not made you an offer!";  }elseif ($checka != "0"){
if ($fetchnew->protection1 != "0"){ echo "This user is already protected by someone!"; }elseif ($fetchnew->protection1 == "0"){
if ($fetchnew->protecting1 != "0"){ echo "This user is protecting someone!"; }elseif ($fetchnew->protecting1 == "0"){
mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `message`, `date`, `read`)
VALUES ('', '$usernamefrom', '$usernamefrom', '<b>$username</b> has accepted your offer and is now protecting you!', '$datenow', '0')");
mysqli_query( $connection, "UPDATE accounts SET protection1='$username', ppayment='$fetcha->offer',pstime='$newpp_time',pqtime='$newpp_time',ptime='$newpp_time' WHERE username='$usernamefrom'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$fetcha->offer WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET money=money-$fetcha->offer WHERE username='$usernamefrom'");
mysqli_query( $connection, "UPDATE accounts SET protecting1='$usernamefrom', pqtime='$newpp_time' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `protect` (`id`, `protection`, `protecting`, `ptime`, `ppayment`)
VALUES ('', '$usernamefrom', '$username', '$newp_time', '$fetcha->offer')");
mysqli_query( $connection, "DELETE FROM proinv WHERE username='$usernamefrom'");
echo" You are now protecting $usernamefrom!";

}}}}}}}
if($_GET['protectacc'] && $_GET['protectc']){
		if($fetch->safehouse != '0'){
		die('You are safehoused.');
	}
$protectacc=$_GET['protectacc']; 
$usernamefrom=$_GET['protectc'];
$newera = mysqli_query( $connection, "SELECT * FROM proinv WHERE username='$usernamefrom' AND invite='$username'");
$fetcha=mysqli_fetch_object($newera);        
$checka=mysqli_num_rows($newera);
$fetchnew=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$usernamefrom'"));
$datenow = gmdate('Y-m-d H:i:s');
if($protectacc == "decline"){
if ($checka == "0"){ echo "This user has not made you an offer!";  }elseif ($checka != "0"){
mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `message`, `date`, `read`)
VALUES ('', '$usernamefrom', '$usernamefrom', '<b>$username</b> has declined your offer and is not protecting you!', '$datenow', '0')");
mysqli_query( $connection, "DELETE FROM proinv WHERE username='$usernamefrom' AND invite='$username'");
echo" You declined the offer!";
}}}

if($_GET['decision'] && $_GET['type'] && $_GET['location']){

		if($fetch->safehouse != '0'){
		die('You are safehoused.');
	}

$decision=$_GET['decision']; 

$type=$_GET['type'];

$location=$_GET['location'];

$newss = mysqli_query( $connection, "SELECT * FROM propsend WHERE type='$type' AND location='$location' AND usernameto='$username'");


$fetchss=mysqli_fetch_object($newss);        


$checkss=mysqli_num_rows($newss);

if($type == "BF"){ $target_protection = mysqli_query( $connection, "UPDATE bf SET owner='$username' WHERE location='$location'"); }
elseif($type == "Blackjack"){ $target_protection = mysqli_query( $connection, "UPDATE bj SET bjowner='$username' WHERE country='$location'"); }
elseif($type == "RPS"){ $target_protection = mysqli_query( $connection, "UPDATE rps SET owner='$username' WHERE location='$location' AND name='RPS'"); }
elseif($type == "Slots"){ $target_protection = mysqli_query( $connection, "UPDATE slots SET owner='$username' WHERE location='$location' AND name='Slots'"); }
elseif($type == "Dice"){ $target_protection = mysqli_query( $connection, "UPDATE roulette SET owner='$username' WHERE location='$location' AND name='Roulette'"); }
elseif($type == "Airport"){ $target_protection = mysqli_query( $connection, "UPDATE airport SET owner='$username' WHERE location='$location'"); }




if($decision == "accept"){

if ($checkss == "0"){ echo "<link href='style.css' rel='stylesheet' type='text/css'><center>You are not being sent this $type!</center>";  }elseif ($checkss != "0"){

$target_protection;

mysqli_query( $connection, "DELETE FROM propsend WHERE type='$type' AND location='$location' AND usernameto='$username'");

echo"You now own that $type!";


}}}


if($_GET['decision'] && $_GET['type'] && $_GET['location']){

		if($fetch->safehouse != '0'){
		die('You are safehoused.');
	}

$decision=$_GET['decision']; 

$type=$_GET['type'];

$location=$_GET['location'];

$newss = mysqli_query( $connection, "SELECT * FROM propsend WHERE type='$type' AND location='$location' AND usernameto='$username'");


$fetchss=mysqli_fetch_object($newss);        


$checkss=mysqli_num_rows($newss);

if($decision == "decline"){

if ($checkss == "0"){ echo "<link href='style.css' rel='stylesheet' type='text/css'><center>You are not being sent this $type!</center>";  }elseif ($checkss != "0"){

mysqli_query( $connection, "DELETE FROM propsend WHERE type='$type' AND location='$location' AND usernameto='$username'");

echo"Declined!";


}}}

?>


<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Inbox :: Thug Paradise</title>
</head>
<body>

<center>

<form method="post" id="form" name="form">
<table width="29%" align="center" cellpadding="2" cellspacing="0" border="0" class="table1px">
<tr><td height="30" class="gradient"><div align="center">Navigation Bar</div></td></tr>
<tr>
<td align="center" class="tableborder"><?php if ($saved == "0"){ ?><b>Your Inbox</b><?php }elseif ($saved == "1"){ ?> <a href="inbox.php">Your Inbox</a><?php } ?> &raquo; <a href="sendmessage.php">Send Message</a> &raquo; <?php if ($saved == "1"){ ?><b>Saved Messages</b><?php }elseif ($saved == "0"){ ?> <a href="inbox.php?saved=1">Saved Messages</a> <?php } ?></td></tr> 
</table>
<br />
		  <input name='DeleteAll' class="custombutton" type='submit' id='DeleteAll' value='Delete All'> &nbsp; &nbsp;
		  <input name='DeleteSel' class="custombutton" type='submit' id='DeleteSel' value='Delete Selected'> &nbsp; &nbsp;
		  <input name='SaveSel' class="custombutton"  type='submit' id='SaveSel' value='Save Selected' /> <br><br>

<br />
<?php
if ($_GET['del']){
$did=$_GET['del'];
mysqli_query( $connection, "DELETE FROM inbox WHERE id='$did'");
echo"That message has been deleted successfully.<br>";
echo"<meta http-equiv=\"refresh\" content=\"4;url=inbox.php\">"; }

if (strip_tags($_POST['DeleteAll'])){
mysqli_query( $connection, "DELETE FROM `inbox` WHERE `saved`='0' AND `to`='$username'");
echo "All your messages have been deleted successfully.<br>"; }

if($_POST['DeleteSel']){
if(is_array($_POST[msg])){
$dels = count($_POST[msg]);
$i = 0;
foreach($_POST[msg] as $del){
$query = mysqli_query( $connection, "SELECT * FROM inbox WHERE id='$del'");
$array = mysqli_fetch_array($query);
if($array[to] == $username){
mysqli_query( $connection, "DELETE FROM inbox WHERE id='$del'");
echo "You have deleted $dels messages from your inbox."; 
}}}}

if($_POST['SaveSel']){ 
if(is_array($_POST[msg])) {
$savs = count($_POST[msg]);
$i = 0;
foreach($_POST[msg] as $sav) {
$query = mysqli_query( $connection, "SELECT * FROM inbox WHERE id='$sav'");
$array = mysqli_fetch_array($query);
if($array[to] == $username){
mysqli_query( $connection, "UPDATE inbox SET saved='1' WHERE id='$sav'");
echo "You have saved $savs messages. They have moved to your saved folder."; 
}}}}


if (strip_tags($_GET['deal'])){
$starter=strip_tags($_GET['deal']);
$num = mysqli_query( $connection, "SELECT * FROM deal WHERE starter='$starter'");
$numba=mysqli_num_rows($num);
$numma=mysqli_fetch_object($num); 
if ($numba == "0"){echo"That deal has been cancelled or there is not such deal.";
}elseif ($numba != "0"){ 
mysqli_query( $connection, "UPDATE accounts SET deal='3' WHERE username='$username'");
echo"You have joined the deal with <a href=\"profile.php?viewing=$starter\">$starter</a>.";
echo"<meta http-equiv=\"refresh\" content=\"1;url=deal.php\">"; }}
 
if (strip_tags($_GET['deald'])){
$starter=strip_tags($_GET['deald']);
$num = mysqli_query( $connection, "SELECT * FROM deal WHERE starter='$starter'");
$numba=mysqli_num_rows($num);
$numma=mysqli_fetch_object($num); 
if ($numba == "0"){echo"That deal has been cancelled or there is not such deal.";
}elseif ($numba != "0"){ 
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET deal='0' WHERE username='$starter'");
echo"You have cancelled the deal with <a href=\"profile.php?viewing=$starter\">$starter</a>. He has been informed.";
echo"<meta http-equiv=\"refresh\" content=\"1;url=deal.php\">";
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$starter', '$username', 'Sorry to inform you, but <a href=\"profile.php?viewing=$username\">$username</a> has refused to start dealing with you.', '<b>Deal Refused</b>', '$date', '0');") or die (mysqli_error());
mysqli_query( $connection, "DELETE FROM deal WHERE starter='$starter'");
}}

echo "<center>";
$mysqli1 = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `to`='$username' AND `saved` ='$saved' ORDER by date DESC");
$num_rows =mysqli_num_rows($mysqli1);
if ($num_rows == "0"){
}else{
while($get = mysqli_fetch_object($mysqli1)){
$t++;
$n++;
$my1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$get->from'");
$fe1=mysqli_fetch_object($my1);

?>
<table width="600" cellspacing="0" cellpadding="0" border="0" class="table1px">
	<tr>
	  <td align="center" height="30" colspan="2" class="gradient"><?php echo "$get->subject"; ?> | <a href="profile.php?viewing=<?php echo"$get->from";?>"><?php echo"$get->from";?></a> | <a href="<?php echo"sendmessage.php?reply=$get->id&fromper=$get->from";?>">Reply</a> | <a href="?del=<?php echo"$get->id";?>">Delete</a> | Sent on: <?php echo "$get->date"; ?> | 
	    <input type='checkbox' name='msg[]' id='<?php echo"$get->id";?>' value='<?php echo"$get->id";?>' ></td>
	</tr>
<tr>
		
		
		
		<td width="85%" height="38" valign="top" class="tableborder" style="padding: 10px;"><?php
		if(!$_GET['wit']){		
		if($get->wit > "0"){ echo"<a href='?wit=$get->id'>You've witnessed a kill.<br>The user <b>$get->wdied</b> has been killed recently, and you witnessed it.<br> Click here to view the killer ($get->wit/3 views left).</a>
		<br><br>
<i>If you view the statement, shall remove 1 of the 3 views away.</i>
<br><br>
<b>If you delete the message from your inbox it will delete from the Witness page, Use the save message option!
"; 
}elseif($get->wit <= "0"){
if($get->wuser != "" && $get->wit == "0"){ echo"You have no more views left on this witness statement."; 
}elseif($get->wuser == ""){ echo"".replace($get->message).""; }

}

}elseif($_GET['wit'] == $get->id){	
$wit = $_GET['wit'];
$cee = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `to`='$username' AND `id` ='$wit'");
$cee1 = mysqli_num_rows($cee);
$cee2 = mysqli_fetch_object($cee);
if($cee2->wit == "0"){ echo"You have no more views for this witness statement.";}elseif($cee2->wit != "0"){
if($cee1 == "0"){ echo"This is not your witness statement."; }elseif($cee1 != "0"){

$nowwit = $get->wit - 1;
echo"".replace($get->message)."<br><br>
<em>You now have $nowwit views out of 3 left.</em>";

if($nowwit == "0"){
mysqli_query( $connection, "DELETE FROM inbox WHERE id='$wit'");
echo"<br><br>The witness statement has been deleted, as you have not got any more views left.";
}elseif($nowwit != "0"){
mysqli_query( $connection, "UPDATE inbox SET wit=wit-1 WHERE id='$wit'");

}}}}
?>
		  </div></td>
	</tr>
</table>
<br />
<?php }}

mysqli_query( $connection, "UPDATE `inbox` SET `read`='1' WHERE `to`='$username'");
echo "</center>";
?> 
<br />
</form>


<?php if (strip_tags($_POST['blocksub']) && strip_tags($_POST['buser'])){





$blockingusername=strip_tags($_POST['buser']);








$newer = mysqli_query( $connection, "SELECT * FROM block WHERE username='$username' AND blocked='$blockingusername'");


        $abcdef=mysqli_num_rows($newer);


if ($abcdef !="0"){ echo "<link href='style.css' rel='stylesheet' type='text/css'><center><div class='fail'>You have already blocked this user!</div>"; }elseif ($abcdef == "0"){


$check = mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$blockingusername'"));





if ($check == "0") {


	echo "<link href='style.css' rel='stylesheet' type='text/css'><center>This user doesn't exist!</center>";


}elseif ($check != "0") {





mysqli_query( $connection, "INSERT INTO `block` ( `id` , `username` , `blocked` ) 


VALUES (


'', '$username', '$blockingusername'


)");





echo "<link href='style.css' rel='stylesheet' type='text/css'><center>You have successfully blocked $blockingusername!</center>";





}}}








$unblockid = strip_tags($_GET['ubuser']);


if($unblockid) {





$newer1 = mysqli_query( $connection, "SELECT * FROM block WHERE id='$unblockid' AND username='$username'");


        $abcdef1=mysqli_num_rows($newer1);


if ($abcdef1 == "0"){ echo "<link href='style.css' rel='stylesheet' type='text/css'><center>You have not blocked this user!</center>"; }elseif ($abcdef1 != "0"){





mysqli_query( $connection, "DELETE FROM block WHERE id='$unblockid'");


echo "<link href='style.css' rel='stylesheet' type='text/css'><center>This User Has Been Successfully Unblocked!</center>";


}}





?>














<table width="400" align="center" cellspacing="0" class="table1px">


    <tr height="30" class="gradient">


     <td colspan="2" align="center">Block Panel</td>





    </tr>


<form method="post">


    <tr><td align=center style="padding: 10px;" valign="top"><p>Gangster:<input type="text" name="buser" class="textbox"></p></td>


    </tr>


    <tr>


     <td colspan="2" align="center"><p><strong><u>You have blocked</u><br>
<br><?php $query321=mysqli_query( $connection, "SELECT * FROM block WHERE username='$username'");





$num=mysqli_num_rows($query321);


$inf=mysqli_fetch_object($query321);


if ($num == "0"){ echo "Nobody Yet!"; }else{ echo "$inf->blocked(<a href='inbox.php?ubuser=$inf->id'>Unblock</a>)<br>"; } 


while($inf = mysqli_fetch_object($query321)){


if ($inf->username == "$username"){


$it="*";


}else{


$it="";


}


echo "$inf->blocked(<a href='inbox.php?ubuser=$inf->id'>Unblock</a>)<br>";


}





?>


</td>





    </tr>     <tr>


     <td colspan="2" style="padding: 10px;" valign="top" align="center"><input type="submit" class="custombutton" name="blocksub" value="Block Em!"><br>
(You can block up to 5 people at once)</p>
</td>
</tr>


  </table>


</form>

<br></br>
<?php include_once "incfiles/foot.php"; ?>
</body>
</html>