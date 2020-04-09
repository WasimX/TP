<?php

session_start();

include_once "incfiles/func.php"; include "incfiles/connectdb.php";  include "incfiles/alt.php"; logincheck();

$username=$_SESSION['username'];

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$query2=mysqli_query( $connection, "SELECT * FROM gangCountry WHERE gang='$fetch->crew' LIMIT 1");
$query3=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew' LIMIT 1");


$fetch=mysqli_fetch_object($query);
$fetch2=mysqli_fetch_object($query2);
$fetch2num=mysqli_num_rows($query2);
$gang=mysqli_fetch_object($query3);


$time = time() + (3600 * 4);


?>
<link href="style.css" rel="stylesheet" type="text/css" /><style type="text/css">
<style type="text/css">
<!--
.style1 {color: red}
-->
</style><form action="" method="post">
<?php if($fetch2num != "0"){ ?><?php if($gang->owner != $username){ ?><table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" align="center" valign="middle" class="gradient"><strong>The Statistics</strong></td>
  </tr>
  <tr>
    <td height="40" align="center" class="table1px"><p>
      <label></label>
      Here you can view all of the statistics for your country. </p>
        <table width="70%">
          <tr>
            <td class="table1px"><div align="center">You have made <?php echo "&#163;".makecomma($fetch2->profit).""; ?> profit since buying this country. </div></td>
          </tr>
          <tr>
            <td class="table1px"><div align="center">There are # gangsters living in your country. # of which are alive, leaving # dead.</div></td>
          </tr>
          <tr>
            <td class="table1px"><div align="center">There has also been # gambled in the casinos of your country and # spent in the go shopping page</div></td>
          </tr>
          <tr>
            <td class="table1px"><div align="center">Click <a href="?page=stockRep">here</a> for a stock report on the stores.</div></td>
          </tr>
        </table>

<?php }else{ ?>
<table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" align="center" valign="middle" class="gradient"><strong>The Controls</strong></td>
  </tr>
  <tr>
    <td height="40" align="center"><p>Now you own a country, you can start to control it from this simple control panel.</p>
      <p>Click <a href="gangCountry.php">here</a> to go back to the main Gang County page.</p>
      <p>
    </p></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" align="center" valign="middle" class="gradient"><strong>Tax</strong></td>
  </tr>
  <tr>
    <td height="40" align="center"><p>Here you can change the tax rate of your country.</p>
        <p>
          <label></label>
          <label>New Rate: 
          <input name="rate" type="text" class="textbox" id="rate" size="3" />
          </label>
        </p>
        <p>Your Password: 
          <input name="password_r" type="password" class="textbox" id="password_r" />
        </p>
        <p>
          <input type="submit" name="button2" id="button2" value="Change rate!" class="custombutton" />
      </p><?php
	  if($_POST['button2']){
	  $password_r = addslashes($_POST['password_r']);
	  $rate = addslashes($_POST['rate']);
	  if($fetch2->lastedit > time()){ echo"You can't for another ".maketime($fetch2->lastedit)."."; }else{	 
      if($gang->owner != $username){ echo"Your not the boss."; }else{	  
	  if($password_r != $fetch->password){ echo"Wrong password."; }else{ 
	  if($rate > 10){ echo"Can't be more than 10%."; }else{ 
	  if($rate < 3){ echo"Can't be less than 3%."; }else{ 
      if (ereg('[^0-9]',$rate)){ echo"No."; }else{
	mysqli_query( $connection, "UPDATE gangCountry SET tax='$rate', lastedit='$time' WHERE gang='$fetch->crew'");
	  echo"You have updated the tax rate in your country to $rate.";
	   }}}}}}}
	   ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" align="center" valign="middle" class="gradient"><strong>Travel Costs</strong></td>
  </tr>
  <tr>
    <td height="40" align="center"><p>Coming soon to your control!
</p>
      <p>

      </p><?php
	  if($_POST['button3']){
	
	  $l = addslashes($_POST['l']);
	  $m = addslashes($_POST['m']);
	  $h = addslashes($_POST['h']);
	  $s = addslashes($_POST['s']);
      $a = addslashes($_POST['a']);
      $t = addslashes($_POST['t']);
	  $password_a = addslashes($_POST['password_a']);
      if($gang->owner != $username){ echo"Your not the boss."; }else{	  
	  if($password_a != $fetch->password){ echo"Wrong password."; }else{ 
	  	  if($fetch2->lastedit > time()){ echo"You can't for another ".maketime($fetch2->lastedit)."."; }else{	 
	  
	  if($l < "0"){ exit("Can't be minus money."); }
if($m < "0"){ exit("Can't be minus money."); }
if($h < "0"){ exit("Can't be minus money."); }
if($s < "0"){ exit("Can't be minus money."); }
if($a < "0"){ exit("Can't be minus money."); }
if($t < "0"){ exit("Can't be minus money."); }
	  
	  	  if($l > 10000){ exit("Can't be more than &pound;10,000 "); }
if($m > 10000){ exit("Can't be more than &pound;10,000 "); }
if($h > 10000){ exit("Can't be more than &pound;10,000 "); }
if($s > 10000){ exit("Can't be more than &pound;10,000 "); }
if($a > 10000){ exit("Can't be more than &pound;10,000 "); }
if($t > 10000){ exit("Can't be more than &pound;10,000 "); }
	  
	 if (ereg('[^0-9]',$l)){
print "No."; 
}elseif (!ereg('[^0-9]',$l)){

if (ereg('[^0-9]',$m)){
print "No."; 
}elseif (!ereg('[^0-9]',$m)){

if (ereg('[^0-9]',$h)){
print "No."; 
}elseif (!ereg('[^0-9]',$h)){

if (ereg('[^0-9]',$s)){
print "No."; 
}elseif (!ereg('[^0-9]',$s)){

if ( ereg('[^0-9]',$a)){
print "No."; 
}elseif (!ereg('[^0-9]',$a)){

if ( ereg('[^0-9]',$t)){
print "No."; 
}elseif (!ereg('[^0-9]',$t)){
	  
	if(($l + $m + $h + $s + $a + $a + $t) > 30000){ echo"The total has to be less than £30,000."; }else{
	
	
	
	mysqli_query( $connection, "UPDATE gangCountry SET locLondon='$l', locMoscow='$m', locSicily='$s', locAmsterdam='$a', locHavana='$h', locTokyo='$t', lastedit='$time' WHERE gang='$fetch->crew'");
	  echo"You have updated the airport rates in your country.";
	
	  
}}}}}}}}}}}
	   ?></td>
       
  </tr>
</table>
<p>&nbsp;</p>
<table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" align="center" valign="middle" class="gradient"><strong>Drop Country</strong></td>
  </tr>
  <tr>
    <td height="40" align="center"><p>If you no longer want to keep your country - you can drop it.</p>
      <p>Your Password:
        <input name="password_d" type="password" class="textbox" id="password_d" />
</p>
      <p>
          <label></label>
          <input type="submit" name="button4" id="button4" value="Drop country!" class="custombutton" />
      </p><?php
	  if($_POST['button4']){
	  		  $password_d = addslashes($_POST['password_d']);
	        if($gang->owner != $username){ echo"Your not the boss."; }else{	  
	  if($password_a != $fetch->password){ echo"Wrong password."; }else{ 
	  	mysqli_query( $connection, "UPDATE gangCountry SET gang='0' WHERE gang='$fetch->crew'");
		
echo"You dropped the location.";
	  
	  }}}
	   ?></td>
  </tr>
</table><?php }} ?></form>