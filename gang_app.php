<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'"));

if($fetch->username != $fetch3->owner){
die("<link href='../style.css' rel='stylesheet' type='text/css'>				
<form name='form1' method='post' action=''>
<table width='350' border='1' align='center' class='table'>
<tr align='center' class='header'>
  <td background='Images/Grads/Error.jpg'>Error</td>
</tr>
<tr align='center'>
  <td>Your not the owner of your gang!</td>
</tr>
</table>
</form>");
}

if($fetch->crew == "0"){
die("<link href='../style.css' rel='stylesheet' type='text/css'>				
<form name='form1' method='post' action=''>
<table width='350' border='1' align='center' class='table'>
<tr align='center' class='header'>
  <td background='Images/Grads/Error.jpg'>Error</td>
</tr>
<tr align='center'>
  <td>You are not in a gang!</td>
</tr>
</table>
</form>");
}
?>
<link href='style.css' rel='stylesheet' type='text/css'>
<style type="text/css">
#tooltip {
	position: absolute;
	z-index: 3000;
	border: 1px solid #333333;
	background-color: #222222;
	color: #FFFFFF;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	padding: 5px;
	opacity: 0.85;
	max-width: 310px;
}
#tooltip h3, #tooltip div { margin: 0; }
#tooltip h3 {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: normal;
}
.bar_cont {
	display: inline-block;
	vertical-align:middle;
}
.bar {
	position: relative;
	width: 150px;
	line-height: 11px;
	border: 1px solid #000;
	color: #000000;
	background: url('images/crimebg/red.jpg');
	background-repeat: repeat-x;
}
.rg {
	position: relative;
	height: 11px;
	background-image: url('images/crimebg/green.jpg');
	background-repeat: repeat-x;
	z-index: 2;
}

.unselected_link {background: url(images/subhead.png) repeat-x; 
	                    padding: 5px 20px 5px 20px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }

.selected_link {background: url(images/selected_box.png) repeat-x;
	                    padding: 5px 20px 5px 20px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }

.menubox {
	text-align: left;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	border: 1px solid #333333;
	background-color: #111111;
	padding: 5px 5px 5px 5px;
}
.menubox a {
	color: #CCCCCC;
	text-decoration: none;
	display: block;
	width: 50px;
}
.menubox .unselected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin: 6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/subhead.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
.menubox .selected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin:	6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/selected_box.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
			
</style>
<body>
		<center><table class='menubox' align='center' style='border-radius: 20px; border: 0px;'>
			<tr>
				<td align='center'>				
                                <div style='float:left;'><a href='gang_editprofile.php?option=profile_edit' class='selected_link' style='width: 120px;'><u>Edit Profile</u></a></div>
                                <div style='float:left;'><a href='gang_app.php' class='unselected_link' style='width: 120px;'><u>Applications</u></a></div>
                                <div style='float:left;'><a href='memberscp.php' class='unselected_link' style='width: 120px;'><u>Members</u></a></div>
				<div style='float:left;'><a href='gang_editprofile.php?option=business' class='unselected_link' style='width: 120px;'><u>Business</u></a></div></div>
				<div style='float:left;'><a href='gangprof.php?viewcrew=<?php echo"$fetch->crew"; ?>' class='unselected_link' style='width: 120px;'><u>View Profile</u></a></div>
				</td>
            </tr>
		</table></center><br>

<form method='post' id='mbpost' name="areas" enctype='multipart/form-data'>
<table width="600" border="1" align="center" cellpadding="2" cellspacing="0" class="table1px">
<tr>
      <td height="22" colspan="3" align="center" class="gradient">Gangs Acceptance</td>
    </tr>
    <tr>
      <td width="36%" height="27" align="center" class="subhead"><p>&nbsp;&nbsp;Username</p></td>
      <td width="36%" align="center" class="subhead">&nbsp;&nbsp;Rank</td>
      <td width="28%" align="center" class="subhead">&nbsp;&nbsp;Accept/Decline</td>
    </tr>
    <?php
  $query=mysqli_query( $connection, "SELECT * FROM accounts WHERE crewappl='$fetch->crew' ORDER by rank");
  while($cool = mysqli_fetch_object($query)){
  echo "<tr>
      <td align=\"center\" class=\"tableborder\"><a href='javascript: ;' onclick=\"modal('profile.php?viewing=$cool->username','<div class=\'header1\'>$cool->username\'s Profile</div>','950','600');\">$cool->username</a></td>
      <td align=\"center\" class=\"tableborder\">$cool->rank</td>
	        <td align=\"center\" class=\"tableborder\"><form name=\"form1\" method=\"post\" action=\"\"><a href='?acc=$cool->username' border=0>Accept</a></form> / <a href='?dec=$cool->username'>Decline</a></td>
    </tr>"; 
  }
  ?>
      <tr>
      <td width="36%" height="27" align="center" class="tableborder" colspan="3"><input type="submit" class="custombutton" name="accall" value="Accept All" /> - <input type="submit" class="custombutton" name="decall" value="Decline All" /></td>
    </tr>
          <?php

  $acceptuserpage=strip_tags($_GET['option']);
  $acc=strip_tags($_GET['acc']);
    $dec=strip_tags($_GET['dec']);
if ($acc){
  $sql_username_check = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$acc' AND crew='0'");
 $username_check = mysqli_num_rows($sql_username_check);
 
  $cre = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew'");
 $crero = mysqli_num_rows($cre);

 if ($username_check == 0){ echo '<font color=red><br>That user is already in a crew or he/she is dead!'; 
 mysqli_query( $connection, "UPDATE accounts SET crewappl = '0' WHERE username='$acc'");
 }else{
 mysqli_query( $connection, "UPDATE accounts SET crewappl='0', crew='$fetch->crew' WHERE username='$acc'");
 echo"<div class=success>You have accepted $acc!";
   $text = "You\'ve been accepted into the crew <b>$fetch->crew</b>!";	   
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES (
'', '$acc', '$username', '$text', 'Gang Acceptance', '$date', '0');") or die (mysqli_error());
 
}
if($dec){
 mysqli_query( $connection, "UPDATE accounts SET crewappl = '0' WHERE username='$dec'");
echo"<font color=red><b>The user has been declined!"; 
}
if ($_POST['decall']){
 mysqli_query( $connection, "UPDATE accounts SET crewappl='0' WHERE crewappl='$fetch->crew'");
echo"<font color=red><b>All users have been declined."; 
}

if (strip_tags($_POST['go'])){

  $sql_username_check = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$cool->username' AND crew='0'");
 $username_check = mysqli_num_rows($sql_username_check);
 
  $cre = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew'");
 $crero = mysqli_num_rows($cre);

 if ($username_check == 0){ echo '<font color=red><br>You cant accept that user as the application is not valid, therefore the user is already in a crew or he/she may not exist!'; 
 mysqli_query( $connection, "UPDATE accounts SET crewappl = '0' WHERE username='$cool->username'");
 }else{
 mysqli_query( $connection, "UPDATE accounts SET crewappl='0', crew='$fetch->crew' WHERE username='$$cool->username'");
 echo"<div class=success>You have accepted $cool->username!";
   $text = "Youve been accepted into the crew <b>$fetch->crew</b>!";	   
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$cool->username', '$username', '$text', 'Gang Acceptance', '$date', '0');") or die (mysqli_error());
}}}

if ($_POST['accall']){
 mysqli_query( $connection, "UPDATE accounts SET crew='$fetch->crew' WHERE crewappl='$fetch->crew'");
 mysqli_query( $connection, "UPDATE accounts SET crewappl='' WHERE crewappl='$fetch->crew'");
echo"<font color=red><b>All users have been accepted."; 
}
?>
  </table></form>
</body>