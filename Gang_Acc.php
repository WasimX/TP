 <?php
error_reporting(0);
session_start();
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
include "incfiles/connectdb.php";
$date = gmdate('Y-m-d H:i:s');
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$r=mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'");
$rank=mysqli_fetch_object($r);

$cquery=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew'");
$fetchc=mysqli_fetch_object($cquery);
$numroc=mysqli_num_rows($cquery);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gang Acceptance</title>
</head>
<table align="center" colspan="3" height="34" border="0" cellspacing="0" class="table1px"><tr><td width="500" class="gradient"><b>Navigation Bar</b></td></tr><tr><td class="table1px"><div align="center"><p align="center"><a href="../Gang_Acc.php"> Acceptance</a> &raquo; <a href="../Gang_Pro.php"> Gang Profile</a> &raquo; <a href="../Gang_Not.php"> Notices</a> &raquo; <a href="../Gang_Mem.php"> Member Options</a> - <a href="../gang_apply.php"> Gang Country</a> &raquo; <a href="../soon.php"> Drive-By</a><font color=red>*</font></p></div></td></tr></table><p></p>
<body>  <form method='post' id='mbpost' name="areas" enctype='multipart/form-data'>  <?php  if($fetchc->owner == $username || $fetchc->underboss == $username || $fetchc->lhm == $username || $fetchc->rhm == $username){  ?><table width="70%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
<tr>
      <td height="22" colspan="3" align="center" class="gradient">Gangs Acceptance</td>
    </tr>
    <tr>
      <td width="36%" height="27" align="center" class="table1px"><p>Username</p></td>
      <td width="36%" align="center" class="table1px">Rank</td>
      <td width="28%" align="center" class="table1px">Accept/Decline</td>
    </tr>
    <?php
  $query=mysqli_query( $connection, "SELECT * FROM accounts WHERE crewappl='$fetch->crew' ORDER by rank");
  while($cool = mysqli_fetch_object($query)){
  echo "<tr>
      <td align=\"center\" class=\"table1px\"><a href='javascript: ;' onclick=\"modal('prof2.php?viewuser=$cool->username','<div class=\'header1\'>$cool->username\'s Profile</div>','950','600');\">$cool->username</a></td>
      <td align=\"center\" class=\"table1px\">$cool->rank</td>
	        <td align=\"center\" class=\"table1px\"><a href='?acc=$cool->username'>Accept</a> / <a href='?dec=$cool->username'>Decline</a></td>
    </tr>"; 
  }
  ?>
      <tr>
      <td width="36%" height="27" align="right" class="table1px" colspan="3"><input type="submit" class="custombutton" name="decall" value="Decline All" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="table1px">&nbsp;
          <?php
  $acc=strip_tags($_GET['acc']);
    $dec=strip_tags($_GET['dec']);
if($acc){
  $sql_username_check = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$acc' AND crew='0' AND crewappl='$fetch->crew'");
 $username_check = mysqli_num_rows($sql_username_check);
 
  $cre = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch->crew' AND crewrank='Member'");
 $crero = mysqli_num_rows($cre);
 
 if($crero >= "30"){
 echo"Your gang is full.";
 }elseif($crero < "30"){

 if ($username_check == 0){ echo 'You cant accept that user as the application is not valid, therefore the user is already in a crew or he/she may not exist!'; 
 mysqli_query( $connection, "UPDATE accounts SET crewappl = '0' WHERE username='$acc'");
 }else{
 mysqli_query( $connection, "UPDATE accounts SET crewappl='0', crew='$fetch->crew', crewrank='Member' WHERE username='$acc'");
 echo"You have accepted $acc!";
   $text = "You\'ve been accepted into the crew <b>$fetch->crew</b>!";	   
		   $sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES (
'', '$acc', '$username', '$text', 'Gang Acceptance', '$date', '0');") or die (mysqli_error());
 
}}
}elseif($dec){
 mysqli_query( $connection, "UPDATE accounts SET crewappl = '0' WHERE username='$dec'");
echo"The user has been declined!"; 
}
if ($_POST['decall']){
 mysqli_query( $connection, "UPDATE accounts SET crewappl='0' WHERE crewappl='$fetch->crew'");
echo"All users have been declined."; 
}
if ($_POST['accall']){
  $testa = mysqli_query( $connection, "SELECT * FROM accounts WHERE crewappl='$fetch->crew' AND crew='0'");
  while($a = mysqli_fetch_object($testa)){
      $yourgangstuff = mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE crew='$fetch->crew'"));
        if($yourgangstuff < "30"){
      mysqli_query( $connection, "UPDATE accounts SET crew='$fetch->crew', crewappl='' WHERE username='$a->username'");
      echo"$a->username has been accepted.<br>";
    }else{
      echo"Failed to accept $a->username. Member limit has been reached.<br>";
    }
  }
}
?>
      </td>
    </tr>
  </table>
<br />
<table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <td width="51%" align="center" valign="top"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
      <tr>
        <td height="22" class="gradient"><center>
          Invite Users
        </center></td>
      </tr>
      <tr>
        <td class="table1px" height="88" align="center">Username:
          <input type="text" name="textfield4" class="textbox" id="textfield4" />
            <br />
            <br />
          Message:<br />
          <textarea style="background:#000000" name="textfield5" cols="25" rows="4" id="textfield5"></textarea>
          <br />
          <br />
          <input type="submit" class="custombutton" value="Invite Em!" name='rec3' />
          <br />
          <br />
          <?php
				  if ($_POST['rec3'] && $_POST['textfield4']){
		  $textfield4=strip_tags($_POST['textfield4']);
		  	  $textfield5=strip_tags($_POST['textfield5']);
		  $date = gmdate('Y-m-d H:i:s');
		  $querycre=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$textfield4' AND crew='0'");
$fetchcre=mysqli_num_rows($querycre);
		  if($fetchcre == "0"){
		  echo"User is not real, or in a crew!";
		}elseif($fetchcre != "0"){
		  
			$text = "<center>The crew $fetchc->name has invited you. <br><input name=accept_crew type=submit value=Yes>
<input type=\"hidden\" name=\"leader\" value=\"$fetchc->name\"></center> ";
					   $sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$textfield4', '$username', '$text<br />$textfield5', 'Crew Invite', '$date', '0');") or die (mysqli_error());
			echo "<a href=profile.php?viewuser=$textfield4>$textfield4</a> has been invited!";
			}}
			?></td>
      </tr>
      <tr> </tr>
    </table></td>
    <td width="49%" align="center" valign="top"><table width="90%" height="110" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
      <tr>
        <td height="22" align="center" class="gradient">Recruitment</td>
      </tr>
      <tr valign="top">
        <td height="50" align="center" class="table1px"><p>
            <input type="radio" name="choices" value="1" checked="checked" />
          Recruiting<br />
          <input type="radio" name="choices" value="2" />
          Not Recruiting<i><br />
            <br />
            <input type="submit" class="custombutton" value="Apply!" name='dfdf' />
            <br />
            <br />
            <?php
		   if ($_POST['dfdf']){
		  $choices=strip_tags($_POST['choices']);  
mysqli_query( $connection, "UPDATE crews SET recruiting='$choices' WHERE name='$fetch->crew'");
echo"You changed the recruitment settings!";
}
		 ?>
          </i></p></td>
      </tr>
      <tr>
        <td height="22" align="center" class="gradient">Rank </td>
      </tr>
      <tr>
        <td align="center" class="table1px"></i>
            <select class="textbox" name="arank">
              <option value="1" selected="selected" >Chav</option>
              <option value="2">Pickpocket</option>
              <option value="3">Vandal</option>
              <option value="4">Theif</option>
              <option value="5">Criminal</option>
              <option value="6">Gangster</option>
              <option value="7">Hitman</option>
              <option value="8">Knuckle Breaker</option>
              <option value="9">Boss</option>
              <option value="10">Assassin</option>
              <option value="11">Don</option>
              <option value="12">Godfather</option>
              <option value="13">Global Terror</option>
              <option value="14">Global Dominator</option>
              <option value="15">Untouchable Godfather</option>
              <option value="16">Legend</option>
              <option value="16">Offical TP Legend</option>
              
              <?php $test = mysqli_query( $connection, "SELECT * FROM ranks");

while($man = mysqli_fetch_object($test)) {

echo"<option value=\"$man->id\">$man->rank +</option>";

}
?>
                   </select>
            <br />
            <br />
            <input type="submit" class="custombutton" name="rankupdate" id="rankupdate" value="Update!" />
            <br />
            <br />
            <?php
	  if (strip_tags($_POST['rankupdate'])){
     $arank=strip_tags(addslashes($_POST['arank']));
mysqli_query( $connection, "UPDATE crews SET ranka='$arank' WHERE name ='$fetch->crew'");
	  	  echo"You have changed what rank your accepting.";
	  }
?></td>
      </tr>
      <tbody>
      </tbody>
    </table></td>
  </tr>
</table>
<br />
<?php } ?>
</form>
</body>
</html>
