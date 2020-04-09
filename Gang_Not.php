<?php
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
include_once "incfiles/alt.php";
logincheck();
$username = $_SESSION['username'];

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$Gang=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'"));
if($fetch->crew == "0"){ exit('<font color=red>Your not in a crew!</font>'); }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gang Notice Board</title>
</head>
<table align="center" colspan="3" height="34" border="0" cellspacing="0" class="table1px"><tr><td width="500" class="gradient"><b>Navigation Bar</b></td></tr><tr><td class="tableborder"><div align="center"><p align="center"><a href="../Gang_Acc.php"> Acceptance</a> &raquo; <a href="../Gang_Pro.php"> Gang Profile</a> &raquo; <a href="../Gang_Not.php"> Notices</a> &raquo; <a href="../Gang_Mem.php"> Member Options</a> - <a href="../gangCountry.php"> Gang Country</a> &raquo; <a href="../soon.php"> Drive-By</a><font color=red>*</font></p></div></td></tr></table><p></p>
<body><form action="" method="post" id="">
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="1" class="table1px">
  <tr>
    <td height="22" align="center" class="gradient">Gang Notice Board<?php if($Gang->owner == $username || $Gang->underboss == $username){?>  - [<a href="?edit=yes">Edit</a>]<?php } ?></td>
  </tr>
  <tr>
    <td align="center"><?php if($_GET['edit']){ if($Gang->owner == $username || $Gang->underboss == $username){?><textarea name="ed" cols="100" class="tablebackground" id="ed" rows="13"><?php echo"$Gang->Notice"; ?></textarea>
      <br />
      <input type="submit" class="custombutton" name="change" id="button" value="Change" />
    <?php
	if($_POST['change']){
	$ed = addslashes($_POST['ed']);
	 mysqli_query( $connection, "UPDATE crews SET Notice='$ed' WHERE name='$fetch->crew'");
echo"You have changed the Gang Notice.";
	}} }else{  echo"".replace($Gang->Notice).""; }?></td>
  </tr>
</table></form>
</body>
</html>
