<?php

session_start();

include "incfiles/connectdb.php";

include "incfiles/func.php";

$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetchid=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM proinv WHERE username='$username'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

?>
<?php if (strip_tags($_POST['makeOffer']) && strip_tags($_POST['offer']) && strip_tags($_POST['wage'])){

$offerusername=strip_tags($_POST['offer']);

$wage=strip_tags($_POST['wage']);

$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$offerusername'"));

$check = mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$offerusername'"));

$checkself = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$offerusername'");

$abcdef=mysqli_fetch_object($checkself);

$newera = mysqli_query( $connection, "SELECT * FROM proinv WHERE username='$username' AND invite='$offerusername'");

$checka=mysqli_num_rows($newera);

$ranks=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

if($ranks->id < "6"){ echo "<center><b><font size=2>You must be ranked at least Gangster to hire bodyguards.</font></b></center><br>";
}elseif($ranks->id >= "6"){

if ($check == "0") {

echo "<center><b><font size=2>No such user!</font></b></center>";

}elseif ($check != "0") {

if ($abcdef->username == $fetch->username){ echo "<center><b><font size=2>You can't protect yourself!</font></b></center>"; }elseif ($abcdef->username != $fetch->username){

if ($fetch->protection1 != "0"){ echo "<center><b><font size=2>You already have protection!</font></b></center>"; }elseif ($fetch->protection1 == "0"){

if ($fetch->protecting1 != "0"){ echo "<center><b><font size=2>You are protecting someone!</font></b></center>"; }elseif ($fetch->protecting1 == "0"){

if ($fetch2->protection1 != "0"){ echo "<center><b><font size=2>This user is protected by someone!</font></b></center>"; }elseif ($fetch2->protection1 == "0"){

if ($fetch2->status != "Alive"){ echo "<center><b><font size=2>This user is dead or banned!</font></b></center>"; }elseif ($fetch2->status == "Alive"){

if ($fetch2->protecting1 != "0"){ echo "<center><b><font size=2>This user is protecting someone!</font></b></center>"; }elseif ($fetch2->protecting1 == "0"){

if ($fetch2->protectiontime > time()){

echo "<center><b><font size=2>This user still has ".maketime($fetch2->protectiontime)." of their protection time remaining!</font></b></center>";

}elseif ($fetch2->protectiontime < time()){

if ($wage > "1000000000" || $wage < 5000000){

echo "<center><b><font size=2>You must pay between &pound;5,000,000 and &pound;1,000,000,000!</font></b></center>";

}elseif ($wage <= "50000000" || $wage >= 100000){

if ($wage > $fetch->money){ echo "<center><b><font size=2>You can't afford to hire someone for that much!</font></b></center>"; }elseif ($wage <= $fetch->money){

mysqli_query( $connection, "INSERT INTO `proinv` (`id`, `username`, `invite`, `offer`)

VALUES ('', '$username', '$offerusername', '$wage')");

$text = "<b><font size=2>$username is offering you a job as their bodyguard for &pound;".makecomma($wage)." a day.</font></b>

You will recieve &pound;".makecomma($wage)." if you accept their job offer as an initial down payment.

<a href=\'inbox.php?protectac=accept&protect=$username\'><b>Click here to accept the position as bodyguard.</b></a> | <a href=\'inbox.php?protectacc=decline&protectc=$username\'><b>Decline</b></a></center>

You cannot quit for at least 24 hours if you accept the job.";

$datenow = gmdate('Y-m-d H:i:s');

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `subject`, `from`, `message`, `date`, `read`)

VALUES ('', '$offerusername', 'Job Offer', '$username', '$text', '$datenow', '0')");

echo "<center><b><font size=2>Your offer has been sent to <a href=\"profile.php?viewing=$offerusername\">$offerusername</a>!</font></b></center>";

}}}}}}}}}}}}

if (strip_tags($_POST['sack'])){

if ($fetch->protection1 == "0"){ echo "<center><b><font size=2>You don't have protection!</font></b></center>"; }elseif ($fetch->protection1 != "0"){

if ($fetch->pstime > time()){ echo "<center><b><font size=2>You can't sack this user for ".maketime($fetch->pstime)."!</font></b></center>"; }elseif ($fetch->pstime < time()){

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `message`, `date`, `read`)

VALUES ('', '$fetch->protection1', '$fetch->protection1', '<b>$username</b> has sacked you from protecting them!', '$datenow', '0')");

mysqli_query( $connection, "UPDATE accounts SET protecting1='0', pqtime='0' WHERE username='$fetch->protection1'");

mysqli_query( $connection, "UPDATE accounts SET protection1='0', pstime='0', ptime='0', ppayment='0' WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM protect WHERE protection='$username'");

echo"<center><b><font size=2>Sacked!</font></b></center>";

}}}

$bging=mysqli_query( $connection, "SELECT * FROM accounts WHERE protection1!='0'");

$bfetch=mysqli_fetch_object($bging);

$bgs=mysqli_num_rows($bging);

$bgf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$bfetch->protection1'"));

if($bgs > "0"){

if($bfetch->ptime < time()){
 $pay=$bgf->ppayment;

if($bfetch->money >= $pay){
 $timee=time() + (3600*24);
 $moneyp=$bfetch->money-$pay;
 $moneybg=$bgf->money+$pay;
mysqli_query( $connection, "UPDATE accounts SET money='$moneyp', ptime='$timee' WHERE username='$bfetch->username'");
mysqli_query( $connection, "UPDATE accounts SET money='$moneybg' WHERE username='$bfetch->protection1'");

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->username', '$bfetch->username', 'Bodyguard Payed', '<b>$bfetch->protection1</b> has been payed for protecting you!', '$date', '0')");

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->protection1', '$bfetch->protection1', 'Payed', 'You have been payed for protecting <b>$bfetch->username</b>!', '$date', '0')");
}elseif($bfetch->money < $pay){
mysqli_query( $connection, "UPDATE accounts SET protecting1='0', ppayment='0', pstime='0' WHERE username='$bfetch->protectedBy1'");
mysqli_query( $connection, "UPDATE accounts SET protection1='0', ptime='0' WHERE username='$bfetch->username'");

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->username', '$bfetch->username', 'Bodyguard Fired!', '<b>$bfetch->protection1</b> has been fired because your too poor!', '$date', '0')");

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->protection1', '$bfetch->protection1', 'Sacked!', 'You have been sacked because your employer couldnt afford the wage!', '$date', '0')");
}}}

if (strip_tags($_POST['quit'])){

if ($fetch->protecting1 == "0"){ echo "<center><b><font size=2>You are not protecting anyone!</font></b></center>"; }elseif ($fetch->protecting1 != "0"){

if ($fetch->pqtime > time()){ echo "<center><b><font size=2>You can't quit for ".maketime($fetch->pqtime)."!</font></b></center>"; }elseif ($fetch->pqtime < time()){

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `message`, `date`, `read`)

VALUES ('', '$fetch->protecting1', '$fetch->protecting1', '<b>$username</b> has quit from protecting you!', '$datenow', '0')");

mysqli_query( $connection, "UPDATE accounts SET protection1='0', pstime='0', ptime='0', ppayment='0' WHERE username='$fetch->protecting1'");

mysqli_query( $connection, "UPDATE accounts SET protecting1='0', pqtime='0' WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM protect WHERE protecting='$username'");

echo"<center><b><font size=2>You have quit your protection job!</font></b></center>";

}}}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Thug Paradise :: Muscle</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">.progress{display:-moz-inline-stack;display:inline-block;zoom:1;*display:inline;background-color:#666666;width:100%;text-align:left;}.width{width:<?php if ($fetch->protection1 == "0"){ echo "0"; }else{ echo "85"; }?><?php if ($fetch->protecting1 == "0"){ echo ""; }else{ echo "85"; }?>%;background-image:url(images/5pix.gif);background-repeat:repeat;background-color:#FF0000;height:10px;}#pic{background-image:url(images/muscleguy.png);background-position:bottom right;background-repeat:no-repeat;height:161px;padding-right:150px;}form{padding:0;margin:0;}</style>
</head>
<body>
<form action="" method="post">

<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" class="gradient"><div align="center">Manage your muscle</div></td>
</tr><tr>
<td width='50%' class='tableborder' style='vertical-align: top;'>
<div align="center">

<?php if(($fetch->protecting1 == "0") AND ($fetch->protection1 == "0")){ echo "
<b>Bodyguard #1</b><br/>
<br/>
<font size=2>
None</font> <br/><br/>
Offer job to: <input name=offer type=text size=20 class=textbox><br/><br/>
Job wage p/d: <input name=wage type=text class=textbox size=20><br/><br/>
          <input name=makeOffer type=submit value='Make Offer' class=custombutton onclick=\"javascript:return confirm('Are you sure?')\">
</div>
</td>"; }?>
<?php if ($fetch->protection1 == "0"){ echo " "; }else{ echo "

<form action='' method='post'>
<tr class=table1px>    <td align=center><b>Bodyguard #1</b><br><br>
<font size=2><a href=\"profile.php?viewing=$fetch->protection1\">$fetch->protection1</a></font>
<br><br>You are currently being protected by $fetch->protection1 and you are paying them &pound;".makecomma($fetch->ppayment)." per day.<br>
<br>$fetch->protection1 will be payed in ".maketime($fetch->ptime)."<br><br>

<input name=sack type=submit value=Sack class=custombutton></td></tr>

</form>
"; } ?>

<?php

$fetchcu=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetch->protecting1'"));

if ($fetch->protecting1 == "0"){ echo ""; }else{ echo "

<form action='' method='post'><tr class=table1px><td align=center><font size=2>Protecting: <a href=\"profile.php?viewing=$fetch->protecting1\">$fetch->protecting1</a></font><br><br>
You are currently protecting $fetch->protecting1 and you are being payed &pound;".makecomma($fetchcu->ppayment)." per day.<br><br>

You will be payed in ".maketime($fetchcu->ptime)."<br><br>

<input name=quit type=submit value=Quit class=custombutton></td></tr>

</form><br>"; } ?>
</td>
<tr>
<td colspan="2" class="gradient"><div align="center">Protection rating</div></td>
</tr>
<tr>
<td class="tableborder" colspan="2" style="padding: 10px;"><div class="progress" title="<?php if ($fetch->protection1 == "0"){ echo ""; }else{ echo "85"; }?><?php if ($fetch->protecting1 == "0"){ echo ""; }else{ echo "85"; }?>%"><div class="width"></div></div></td>
</tr>
</table>
</form>
<br/>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="50" height="62" class="tableborder"><div align="left"><img src="images/questionmark.jpg" alt="Question" width="49" height="46"/></div></td>
<td width="450" valign="middle" class="tableborder" id="pic">Need protection? Hire a bodyguard.<br/>Make them an offer they can't refuse.<br/>Need money? Become a bodyguard.<br/>You can't do both, one or the other!<br/>
<br/>
Bodyguards protect you from death. While they're alive, you're safe and you can't be shot. The employer pays the bodyguard a down payment when they accept the job, they're then paid the wage at midnight everyday. 7.5% tax is taken on all payments.<br/>
<br/>
If an employer cannot afford to pay the next days wages, or the bodyguard joins a different gang to the employer (being in no gang is fine for the guard) then the bodyguard will be automatically sacked. A bodyguard can only be sacked or quit after 24 hours employment, and cannot be sacked within 6 hours before their wages are transferred.</td>
</tr>
</table>
</div>
<br/>


  <?php include_once"incfiles/foot.php"; ?>