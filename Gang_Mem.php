<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'"));

if($fetch->username != $fetch2->owner){
die("<link href='../style.css' rel='stylesheet' type='text/css'>				
<form name='form1' method='post' action=''>
<table width='350' border='0' align='center' class='table1px'>
<tr align='center' class='gradient'>
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
<table width='350' border='0' align='center' class='table1px'>
<tr align='center' class='gradient'>
  <td background='Images/Grads/Error.jpg'>Error</td>
</tr>
<tr align='center'>
  <td>You are not in a gang!</td>
</tr>
</table>
</form>");
}

if (strip_tags($_POST['drop'])){
mysqli_query( $connection, "UPDATE accounts SET gangappl='0' WHERE gangappl='$fetch->crew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE crew='$fetch->crew'");
mysqli_query( $connection, "DELETE FROM crews WHERE name='$fetch->crew'");
echo"<center><font color=green><b>Gang Successfully Dropped."; 
}

if (strip_tags($_POST['swap']) && strip_tags($_POST['swapusername'])){

$swapusername=strip_tags($_POST['swapusername']);

$swapusernamefetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$swapusername'"));
$swapusernamefetchgang=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$swapusernamefetch->crew'"));

if ($swapusername == $swapusernamefetchgang->owner){

echo"<center><font color=red><b>That user already owns a gang!";

}elseif ($swapusernamefetch->crew != $fetch->crew){

echo"<center><font color=red><b>That user is not in your gang!";

}else{

mysqli_query( $connection, "UPDATE crews SET owner='$swapusername' WHERE name='$fetch->crew'");

echo"<center><font color=green><b>You successfully gave $fetch->crew to 
$swapusername!<meta http-equiv='refresh' content='1;url=welcome.php'>"; 
}}

if (strip_tags($_POST['newunderboss']) && strip_tags($_POST['underbossusername'])){

$underbossusername=strip_tags($_POST['underbossusername']);

mysqli_query( $connection, "UPDATE crews SET underboss='$underbossusername' WHERE name='$fetch->crew'");

echo"<center><font color=green><b>You made $underbossusername your Underboss!"; 
}

if (strip_tags($_POST['newrhm']) && strip_tags($_POST['rhmusername'])){

$rhmusername=strip_tags($_POST['rhmusername']);

mysqli_query( $connection, "UPDATE crews SET rhm='$rhmusername' WHERE name='$fetch->crew'");

echo"<center><font color=green><b>You made $rhmusername your RHM!"; 
}

if (strip_tags($_POST['newlhm']) && strip_tags($_POST['lhmusername'])){

$lhmusername=strip_tags($_POST['lhmusername']);

mysqli_query( $connection, "UPDATE crews SET lhm='$lhmusername' WHERE name='$fetch->crew'");

echo"<center><font color=green><b>You made $lhmusername your LHM!"; 
}

if (strip_tags($_POST['newkick']) && strip_tags($_POST['kickusername'])){

$kickusername=strip_tags($_POST['kickusername']);

if ($kickusername == $fetch2->owner){

echo"<center><font color=red><b>You cannot kick the owner!";

}elseif ($kickusername == $fetch2->underboss){

mysqli_query( $connection, "UPDATE crews SET underboss='0' WHERE owner='$fetch->username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$fetch'");

echo"<center><font color=green><b>You kicked $kickusername!";

}elseif ($kickusername == $fetch2->rhm){

mysqli_query( $connection, "UPDATE crews SET rhm='0' WHERE owner='$fetch->username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$kickusername'");

echo"<center><font color=green><b>You kicked $kickusername!"; 

}elseif ($kickusername == $fetch2->lhm){

mysqli_query( $connection, "UPDATE crews SET lhm='0' WHERE owner='$fetch->username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$kickusername'");

echo"<center><font color=green><b>You kicked $kickusername!"; 

}elseif ($kickusername != $fetch2->lhm || $kickusername != $fetch2->rhm || $kickusername != $fetch2->underboss){

$kickusername=strip_tags($_POST['kickusername']);

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$kickusername'");

echo"<center><font color=green><b>You kicked $kickusername!"; 
}}
?>
<link href='style.css' rel='stylesheet' type='text/css'>
<style type="text/css">

.optiontable {
	font-size: 11px;
	padding: 5px;
        margin: 5px 2px 2px;
}

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
		<center><table align="center" colspan="3" height="34" border="0" cellspacing="0" class="table1px"><tr><td width="500" class="gradient"><b>Navigation Bar</b></td></tr><tr><td class="tableborder"><div align="center"><p align="center"><a href="../Gang_Acc.php"> Acceptance</a> &raquo; <a href="../Gang_Pro.php"> Gang Profile</a> &raquo; <a href="../Gang_Not.php"> Notices</a> &raquo; <a href="../Gang_Mem.php"> Member Options</a> - <a href="../gangCountry.php"> Gang Country</a> &raquo; <a href="../soon.php"> Drive-By</a><font color=red>*</font></p></div></td></tr></table><p></p>


<br>
<table width="600" cols="4" align="center">
<tr>
<td>
<form name='form1' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">

<tr><td colspan="2" class="gradient">Drop Gang</td></tr>
<tr>
	<td align="center">Drop your gang:&nbsp;&nbsp;
<br><input name="drop" type="submit" class="custombutton" value="Drop" /></td>
</tr>
</table>
</form>
<td colspan="2" valign="top">
<form name='form2' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">
<tr>
	<td colspan="2" class="gradient">Give Away</td>
</tr>

<tr>
          <td align="center">Give gang to:&nbsp;&nbsp;<select name="swapusername" id="swapuser">
              <option selected="0">None</option>
              <?php $get=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND status='Alive'");
while($it=mysqli_fetch_object($get)){

echo "<option value='$it->username'>$it->username</option>";
}
?>
            </select>&nbsp;&nbsp;<input name="swap" type="submit" class="custombutton" id="Swap" value="Update" /></td></tr>
</table></form>

</table>

<table width="600" cols="4" align="center">
<tr>
<td>
<form name='form2' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">
<tr>
	<td colspan="2" class="gradient">New Underboss</td>
</tr>

<tr>
          <td align="center">New Underboss:&nbsp;&nbsp;<select name="underbossusername" id="underbossusername">
              <option selected="0">None</option>
              <?php $get=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND status='Alive'");
while($it=mysqli_fetch_object($get)){

echo "<option value='$it->username'>$it->username</option>";
}
?>
            </select>&nbsp;&nbsp;<input name="newunderboss" type="submit" class="custombutton" id="Update" value="Update" /></td></tr>
</table></form>

<td colspan="2" valign="top">
<form name='form2' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">
<tr>
	<td colspan="2" class="gradient">New RHM</td>
</tr>

<tr>
          <td align="center">New RHM:&nbsp;&nbsp;<select name="rhmusername" id="rhmusername">
              <option selected="0">None</option>
              <?php $get=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND status='Alive'");
while($it=mysqli_fetch_object($get)){

echo "<option value='$it->username'>$it->username</option>";
}
?>
            </select>&nbsp;&nbsp;<input name="newrhm" type="submit" class="custombutton" id="Update" value="Update" /></td></tr>
</table></form>

</table>

<table width="600" cols="4" align="center">
<tr>
<td>
<form name='form' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">
<tr>
	<td colspan="2" class="gradient">New LHM</td>
</tr>

<tr>
          <td align="center">New LHM:&nbsp;&nbsp;<select name="lhmusername" id="lhmusername">
              <option selected="0">None</option>
              <?php $get=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND status='Alive'");
while($it=mysqli_fetch_object($get)){

echo "<option value='$it->username'>$it->username</option>";
}
?>
            </select>&nbsp;&nbsp;<input name="newlhm" type="submit" class="custombutton" id="Update" value="Update" /></td></tr>
</table></form>

<td colspan="2" valign="top">
<form name='form2' method='post' action=''>
<table class="table1px" border=0 width="300" align="center" cellspacing="0" cols="2">
<tr>
	<td colspan="2" class="gradient">Kick User</td>
</tr>

<tr>
          <td align="center">User:&nbsp;&nbsp;<select name="kickusername" id="kickusername">
              <option selected="0">None</option>
              <?php $get=mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND status='Alive'");
while($it=mysqli_fetch_object($get)){

echo "<option value='$it->username'>$it->username</option>";
}
?>
            </select>&nbsp;&nbsp;<input name="newkick" type="submit" class="custombutton" id="Update" value="Update" /></td></tr>
</table></form>

</table>
</body>