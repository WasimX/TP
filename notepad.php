<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$query1=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");
$user=mysqli_fetch_object($query1);

if (($_POST['change_notes']) && ($_POST['notes'])){
$notes=addslashes(strip_tags($_POST['notes']));

$strip = "/^[<>,'\"^-]+$/";

if(preg_match($strip,$notes)){ 
echo "The notes you have entered contain invalid characters.<br><br>This may involve: /^,'\"-";
}else{

mysqli_query( $connection, "UPDATE accounts SET notes='$notes' WHERE username='$username'");
echo "<font color=white><b>Your notes have been updated"; 
}}
?>
<html>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 10px;
}
-->
</style>
<title>Note Pad</title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<form action="" method="POST" name="form">
  <table width="575" border="0" cellpadding="0" cellspacing="0" class="table1px" align="center">
    <tr><td width="575" height="30" class="gradient">Note Pad</td></tr>
    <tr><td class="tableborder" align="center">
The notepad is a unique page, where you can store any data. However, if an admin or mod has a reason to think that you are breaking the rules, or TOS, then you shall be punished.
<br /><br />
<textarea name="notes" cols="125" rows="25" class="tablebackground" id="notes"><?php echo "$fetch->notes"; ?></textarea><br /><br />
<input class="custombutton" name="change_notes" type="submit" id="change_notes" value="Update Notes">
</td></tr>
</table>

<?php require_once "incfiles/foot.php"; ?></center>
</body>
</html>