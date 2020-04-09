<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$date = gmdate('Y-m-d H:i:s');
$viewtopic = $_GET['id'];

$gg = mysqli_query( $connection, "SELECT * FROM support WHERE id='$viewtopic'");
while($success = mysqli_fetch_row($gg)){
$username1 = $success[1];
$subject = $success[2];
$problem = $success[3];
$made = $success[4]; 
$inbox = $success[5];
$status = $success[6];
$category = $success[7]; }

if($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){
if($username1 != $username){ echo "This support ticket was not made by you."; exit(); }}

if($_GET['clean']) { 
$clean=$_GET['clean'];
if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){
mysqli_query( $connection, "UPDATE supportreplys SET text='The reply was removed by $username.' WHERE id='$clean'");
echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='support_r.php?id=$viewtopic';
</script>"; }}

$fetchhim=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username1'"));
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Thug Paradise :: Reply</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
<!--
.style1 {font-size: 24px}
td {
    font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	padding: 2px;
}
.tablebg {    
    font-family: Arial Rounded MT Bold;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	color: #666666;
	background-color: #FFFFFF;
	border: 1px solid #000000;
	padding: 0px; 
}
.style3 {font-size: 24px
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

<form action="" id="reply" method="POST">

<?php if (strip_tags($_GET['openinbox'])){
if($inbox == "Yes"){ 
$mysqli1 = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `to`='$username1' ORDER by date DESC");
$num_rows =mysqli_num_rows($mysqli1);
if ($num_rows == "0"){ echo "No messages found in inbox."; }else{
while($get = mysqli_fetch_object($mysqli1)){
?>
<table width="600" cellspacing="0" cellpadding="0" border="0" class="table1px">
<tr><td align="center" height="30" colspan="2" class="gradient">
<?php echo "$get->subject"; ?> | <?php echo"$get->from";?> | Reply | Delete | Sent on: <?php echo "$get->date"; ?> |
<input type='checkbox' disabled="disabled" value='<?php echo"$get->id";?>' ></td></tr>
<tr><td width="85%" height="38" valign="top" class="tableborder" style="padding: 10px;">
<?php
if(!$_GET['wit']){		
if($get->wit > "0"){ echo "You've witnessed a kill.<br>The user <b>$get->wdied</b> has been killed recently, and you witnessed it.<br> Click here to view the killer ($get->wit/3 views left). <br><br>
<i>If you view the statement, it shall remove 1 of the 3 views away.</i>"; 
}elseif($get->wit <= "0"){
if($get->wuser != "" && $get->wit == "0"){ echo "You have no more views left on this witness statement."; 
}elseif($get->wuser == ""){ echo "".replace($get->message).""; }}}
?>
</td></tr>
</table>
<?php } echo "
<a href=\"support_r.php?id=$viewtopic\"><b>Go Back</b></a><br><br>"; }
}elseif($inbox == "No"){ echo "This user has not given permission to view there inbox."; }} ?>
<div align="left"><a href="support.php" target="_self">Return to Support Page</a></div>
<div align="center"><span class="style3"><b><?php echo "$subject"; ?></b></span><br>
<br>

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebg">
</tr>
<tr><td align="left" style="padding: 4px;">
<?php echo "".replace($problem)."";
if ($problem == ""){ $problem = "Unavailable problem - Delete ticket & inform user of warning."; }

if($inbox == "Yes"){
echo"<br><br><i><a href='support_r.php?id=$viewtopic&openinbox=yes'>
View ticket senders inbox values.</a>";
}elseif($inbox == "No"){ } ?></td></tr>

<tr><td class="table1px" style="padding: 4px;" align="right">
Posted at <?php echo "$made"; ?> | <a href="profile.php?viewing=<?php echo "$username1"; ?>"><?php echo "$username1"; ?></a> (Status: <?php echo $fetchhim->status; ?>)| <?php echo "$fetchhim->rank"; ?></td></tr>
</table><br /><br />

<?php
$query=mysqli_query( $connection, "SELECT * FROM supportreplys WHERE idto = '$viewtopic'  ORDER by `id` DESC");
$num=mysqli_num_rows($query);
while($right=mysqli_fetch_object($query)){
$fe1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$right->username'"));
?>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebg">
<tr><td width="75" rowspan="2" style="padding: 4px;">
<font color="black"><b><center><?php echo "$right->username"; ?></b></font><br /><br />
<?php if ($fe1->userlevel == "1"){ echo "<img src='images/communication/mod.gif'>"; }
   if ($fe1->userlevel == "4"){ echo "<img src='images/communication/admin.gif'>"; } 
   if ($fe1->userlevel != "4" && $fe1->userlevel != "1"){ echo "<img src='images/communication/user.gif'>"; } ?><br>
<i><?php echo"$right->date"; ?></i>
</center></td>
<td width="500" valign="top" style="padding: 4px;">
<?php echo "".replace($right->text)."";?><br /><br /></td></tr>
<tr><td align="right" valign="bottom" style="padding: 4px;">
<?php if ($fetch->userlevel == "1" || $fetch->userlevel == "4"){ ?><a href='support_r.php?clean=<?php echo"$right->id";?>&id=<?php echo"$viewtopic";?>'>Delete</a><i> | Posted on <?php echo"$right->date"; ?></i><?php } ?></td></tr>
</table>
<br>
<?php } ?> 


<?php if($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){ 
      if($topic->status == "<font color=red>Closed</font>"){ 
	  echo"<font color=\"red\" style=\"font-variant: small-caps;\">This Topic Is Closed</font>";
      exit(); }} ?> <br />
	  
<?php 
if(strip_tags($_POST['close'])){
$close=$_POST['close'];
if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){
mysqli_query( $connection, "UPDATE support SET status='<font color=red>Closed</font>' WHERE id='$viewtopic'");
mysqli_query( $connection, "UPDATE accounts SET tickets=tickets+1 WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET closedtick=closedtick+1 WHERE username='$username1'");
$problemreply = "<b>This support ticket has been closed by $username.</b>";
mysqli_query( $connection, "INSERT INTO `supportreplys` (`id`, `idto`, `text`, `username`, `date`, `forum`) VALUES ('', '$viewtopic', '$problemreply', '$username', '$date', 's');") or die (mysqli_error());
echo"<center><i>This support ticket has now been closed.</i></center>"; }}

if(strip_tags($_POST['admin'])){
if ($fetch->userlevel == "1" || $fetch->userlevel == "4"){
$mod=mysqli_query( $connection, "SELECT * FROM accounts WHERE userlevel='4'");
while($cool = mysqli_fetch_object($mod)){
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$cool->username', '$username', '<i>A support ticket requires help from an Admin
Click <b><a href=support_r.php?&id=$viewtopic>Here</a></b> to go to the ticket</i>', 'TP Support Help!', '$date', '0');");
mysqli_query( $connection, "UPDATE support SET admin='1' WHERE id='$viewtopic'");  } 
$problemreply = "This support ticket has been forwarded to an admin by $username.";
mysqli_query( $connection, "INSERT INTO `supportreplys` (`id`, `idto`, `text`, `username`, `date`)VALUES ('', '$viewtopic', '$problemreply', '$username', '$date');") or die (mysqli_error());

echo"<center><i>Admins will be notified</i></center>"; }}


if(strip_tags($_POST['replytext'])){

if($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){
if($username1 != $username){
echo"This is not your support ticket.";
exit(); }}

$problemreply = addslashes(strip_tags($_POST['problemreply']));
$topic_info=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM support WHERE id='$viewtopic'"));
$date = gmdate('Y-m-d H:i:s');

if ($fetch->userlevel == "1" || $fetch->userlevel == "4"){
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username1', '$username', '<i>Your support ticket has been answered by <b><a href=\"profile.php?viewing=$username\">$username</a></b>
<b>Click</b> <b><a href=support_r.php?&id=$viewtopic>here</a></b> <b>to see the ticket</b>', 'TP Support Desk', '$date', '0');") or die (mysqli_error()); }

mysqli_query( $connection, "INSERT INTO `supportreplys` (`id`, `idto`, `text`, `username`, `date`)
VALUES ('', '$viewtopic', '$problemreply', '$username', '$date');") or die (mysqli_error());

echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='support_r.php?&id=$viewtopic';
</script>"; } ?>  <br />

<table width="500" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="table1px"><div align="center">
<textarea name="problemreply" class="textbox" cols="95" rows="10" id="context"></textarea>
<br><br>
<input type="submit" value="Submit Reply" class="custombutton" name="replytext">
<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?> - <input type="submit" value="Notify Admin" class="custombutton" name="admin"> - <input type="submit" value="Enclose Ticket" class="custombutton" name="close"><br><<< <a href="support.php">Go Back</a>
<br>
</div></td>
</tr></table>

<?php } ?>

</form>