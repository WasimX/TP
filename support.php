<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$forum=$_GET['forum'];

if ($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){
if ($fetch->lasttop > time()){
echo "You need to wait for ".maketime($lasttopic)." until you can make another support ticket.<br>"; }}

if (($fetch->userlevel == "4" || $fetch->userlevel == "1") || (time() >= $lasttopic)){

$timer = gmdate('Y-m-d h:i:s');

if(strip_tags($_POST['addticket'])){
$time = time()+ (60 * 5);
$subject = addslashes(strip_tags($_POST['subject']));
$problem = addslashes(strip_tags($_POST['problem']));
$category = strip_tags($_POST['category']);
$inbox = strip_tags($_POST['inbox']);

if ($subject == ""){ echo "Please include a subject for your ticket."; }
elseif ($subject != ""){

if ($category == ""){ echo "Please select a category for your ticket."; }
elseif ($category != ""){

if ($problem == ""){ echo "Please enter a problem for your ticket."; }
elseif ($problem != ""){

if ($inbox == ""){ echo "Please provide us with information about your inbox."; }
elseif ($inbox != ""){

$date = gmdate('H:i:s, l (jS)-M-y ');

mysqli_query( $connection, "INSERT INTO `support` (`id`, `username`, `subject`, `category`, `problem`, `date`, `inbox`, `status`) VALUES 
('', '$username', '$subject', '$category', '$problem', '$date', '$inbox', '<font color=darkgreen>Open</font>');") or die (mysqli_error());

echo "<b><center>Your problem has been sent and will be answered shortly!</center></b><br /><br />"; }}}}}}

if($_POST['delete']) {
foreach($_POST as $id) {
mysqli_query( $connection, "DELETE FROM `support` WHERE `id` ='$id' LIMIT 1"); 
mysqli_query( $connection, "DELETE FROM `supportreplys` WHERE `idto` ='$id' LIMIT 1"); }
echo "Selected tickets have been deleted.<br /><br />"; } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thug Paradise 2 :: Support</title>
<script type="text/javascript">
var readHelp;
<!--
function setvisibility (idname) {
	block = document.getElementById(idname);
	block.style.display = 'inline';
}
// --> 
</script> 
<style type="text/css">
.tablebg {    
    font-family: Arial Rounded MT Bold;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	color: #666666;
	background-color: #FFFFFF;
	border: 1px solid;
	padding: 4px; 
}
</style>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body>

<form action="" method="post" name="form">

<div align="center">
Please be patient when waiting for a reply. Your ticket will usually be answered within 2 hours, if it involves credit purchases it may be quicker.<br>
All tickets are answered but there are about 50 sent in everyday!
<br>
<br>
<tr><td width="63%">

<table border="0" width="99%">
<tr><td>

<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td align="center" class="gradient" height="30" colspan="7">My Tickets</td></tr>
<tr>
<td class="gradient" width="10%" height="30"><em>Ticket ID</em></td>
<td class="gradient" width="24%" height="30"><em>Subject</em></td>
<td class="gradient" width="27%" height="30"><em>Category</em></td>
<td class="gradient" width="21%" height="30"><em>Time Posted</em></td>
<td class="gradient" width="9%" height="30"><em>Replies</em></td>
<td class="gradient" width="9%" height="30"><em>Status</em></td>
</tr>

<?php
$test = mysqli_query( $connection, "SELECT * FROM support WHERE username='$username' ORDER BY id DESC LIMIT 5") or die(mysqli_error());
while($info = mysqli_fetch_object($test)) {

$lol = mysqli_query( $connection, "SELECT * FROM support WHERE username='$username'") or die(mysqli_error());
$rows = mysqli_num_rows($lol);

if($rows == "0"){ 
echo "<tr><td align=\"center\" colspan=\"6\" height=\"30\" class=\"table1px\">No matched tickets available.</td></tr>"; 
}elseif($rows > "0"){ 

$hehe=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM supportreplys WHERE idto='$info->id'"));

if ($info->username == "$username"){ 

echo "<tr>
<td align=\"center\" width=\"10%\" height=\"30\" class=\"tableborder\"><b>$info->id</td>
<td align=\"center\" width=\"15%\" height=\"30\" class=\"tableborder\"><b>
<a href=\"support_r.php?id=$info->id\"><b>$info->subject</b></a></td>
<td align=\"center\" width=\"15%\" class=\"tableborder\"><b>$info->category</td>
<td align=\"center\" width=\"15%\" height=\"30\" class=\"tableborder\"><b>$info->date</td>
<td align=\"center\" width=\"5%\" height=\"30\" class=\"tableborder\"><b>$hehe</td>
<td align=\"center\" width=\"5%\" height=\"30\" class=\"tableborder\"><b>$info->status</td>
</tr>"; }}} ?>
<tr>
<td colspan="6" class="tableborder" align="center"><div align="center"></div></td>
</tr>
</table>

</td></tr>


</td></tr>
<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?>
<tr><td colspan="2" style="padding: 25px;">

<table width="38%" border="0" align="center" cellpadding="0" cellspacing="0" class="tablebg">
<tr><td align="left" style="font-size: 20px; padding: 4px; font-family: Arial Rounded MT Bold; color: #660000; font-variant: small-caps;">
<u>Options As Standard</u></td></tr>
<tr><td align="left" style="padding: 5px;">
<input name="delete" type="submit" class="custombutton" id="delete" value="Delete Selected" />&nbsp;&nbsp;&nbsp;
<?php if (!$_POST['closed']){ ?>
<input name="closed" type="submit" id="closed" class="custombutton" value="View All Closed Tickets" /><?php } ?>
<?php if ($_POST['closed']){ ?><input name="open" type="submit" id="open" class="custombutton" value="View All Open Tickets" /><?php } ?>
<br /><br />
Only delete the tickets which are in the "Closed Tickets" section, due to pending tickets being open.</td>
  </tr>
</table>
<br /><br />
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" colspan="8" align="center" class="gradient">
Support Desk (Staff View) - <?php if ($_POST['closed']){ echo "CLOSED"; }else{ echo "OPEN"; } ?> TICKETS</td>
  </tr>
  <tr>
    <td align="center" width="7%" class="tableborder"><u>ID</u></td>
    <td align="center" width="18%" class="tableborder"><u>Username</u></td>
    <td align="center" width="16%" class="tableborder"><u>Subject</u></td>
    <td align="center" width="18%" class="tableborder"><u>Category</u></td>
    <td align="center" width="21%" class="tableborder"><u>Date</u></td>
    <td align="center" width="9%" class="tableborder"><u>Replies</u></td>
    <td align="center" width="11%" class="tableborder"><u>Delete</u></td>
  </tr>
  <?php

if($_POST['closed']){ $stas = "<font color=red>Closed</font>"; }else{ $stas = "<font color=darkgreen>Open</font>"; }

$test = mysqli_query( $connection, "SELECT * FROM support WHERE status='$stas' ORDER BY id DESC");
while($info = mysqli_fetch_object($test)) {
 
$lol = mysqli_query( $connection, "SELECT * FROM support");
$rows = mysqli_num_rows($lol);
 
if($rows > "0") { 

$hehe=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM supportreplys WHERE idto='$info->id'"));

if ($info->admin == "1"){ $admin = "<font color=white>**</font>"; }else{ $admin = ""; }

echo "<tr>
<td align=\"center\" width=\"8%\" class=\"tableborder\"><b>$info->id</b></td>
<td align=\"center\" width=\"15%\" class=\"tableborder\"><b><a href=\"profile.php?viewing=$info->username\">$info->username</a></b></td>
<td align=\"center\" width=\"14%\" class=\"tableborder\"><b><a href=\"support_r.php?id=$info->id\">$info->subject</a><b>$admin</b></td>
<td align=\"center\" width=\"14%\" class=\"tableborder\"><b>$info->category</b></td>
<td align=\"center\" width=\"14%\" class=\"tableborder\"><b>$info->date</b></td>
<td align=\"center\" width=\"10%\" class=\"tableborder\"><b>$hehe</b></td>
<td align=\"center\" width=\"15%\" class=\"tableborder\"><b><input type='checkbox' name='$info->id' id='$info->id' value='$info->id'></b></td>
</tr>"; }}
?>
</table>

</td></tr>
<?php } ?>
</table>

</td></tr>
</table>
<br>

<?php if ($fetch->userlevel == "0" || $fetch->userlevel == "2" || $fetch->userlevel == "3"){ ?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td class="gradient">TP Support</td></tr>
<tr>
  <td <td class="tablebackground" align="center" style="padding: 10px;">
If you need gameplay advice, mission help, bullets to kill, rank points or help with ordering credits...anything to do with how you play the game, then please use the Helpdesk. This page is to be used when more complex help is required.
<br><br>
<u>Category</u><br> <select name="category" id="category" class="textbox">
<option value="" selected>Please Choose...</option>
<option value="Credit Purchase Problem">Credit Purchase Problem</option>
<option value="Report Someone">Report Someone</option>
<option value="Report a Bug">Report a Bug</option>
<option value="Report a Staff Problem">Report a Staff Problem</option>
<option value="Report a TOS Violation">Report a TOS Violation</option>
<option value="Request a Modkill">Request a Modkill</option>
<option value="Other TP Problem">Other TP Problem</option>
           </select><br /><br />
<u>Problem subject</u><br> <input name="subject" type="text" class="textbox" id="subject" value="" size="50" maxlength="18"><br /><br />
<u>Allow Mods to view your inbox?</u><br>
If you are reporting a incident contained in your inbox, you can give the <br>
mod who answers your ticket permission to view your inbox to see for themselves.<br>
<br>
Recommended for reporting advertisers, abusers, people admitting to cheating etc.<br>
<br>
Give permission to browse (for duration of ticket only):<select name="inbox" id="inbox" class="textbox">
                             <option value="Yes" selected="selected">Yes</option>
                             <option value="No">No</option>
                            </select><br /><br />
<u>Problem</u><br>
<textarea name="problem" class="textbox" cols="100" rows="15" id="problem" onclick="if(readHelp == null) { this.value=''; readHelp = true; }">Have you included all the information you can, including account information, any credit passwords, usernames, previous ticket numbers etc, that will help with your problem?</textarea>
<br /><br />
<input type="submit" class="custombutton" name="addticket" id="addticket" value="Add Ticket!"><br>
<br>
You will receive a message once your problem is answered by an Administrator or Moderator. </p>
</td></tr>
</table>
<?php } ?>

</form>
<?php require_once "incfiles/foot.php"; ?>

</body>
</html>