<?php

session_start();

include_once "incfiles/func.php"; include "incfiles/connectdb.php";  include "incfiles/alt.php"; logincheck();

$username=$_SESSION['username'];

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$query2=mysqli_query( $connection, "SELECT * FROM gangCountry WHERE gang='$fetch->crew' LIMIT 1");
$query3=mysqli_query( $connection, "SELECT * FROM crews WHERE name='$fetch->crew' LIMIT 1");

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$fetch=mysqli_fetch_object($query);
$fetch2=mysqli_fetch_object($query2);
$fetch2num=mysqli_num_rows($query2);
$gang=mysqli_fetch_object($query3);



?>
<style type="text/css">
<!--
.style2 {
	color: #000000;
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<form action="" method="post">
<div align="center">
  <table width="73%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td ><table width="661" border="0" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
        <tr>
          <td height="22" align="center" valign="middle" class="gradient"><strong>Country Control</strong></td>
        </tr>
        <tr>
          <td height="40" align="center"><p>Welcome to Country Control, here you can buy a country and have full control of it.  If you buy a country, you cannot loose it, unless your gang is wiped. Countries cannot be sold to other gangs and you can only own one at a time. You can control the tax rates on both the normal bank and swiss bank. You can also control the tax rates on the hitlist. You can only make changes once every 4 hours. There is a &pound;100,000,000 takeover fee for each country - the money you spend on a country can be earned back easily if your prices are suitable.</p>
              <p><em>Where does the money I make go? </em>The money you make will be added to the Gang Stash. This can then be withdrawn by anyone who has permission to.</p>
            <p><em>Can I share the money out? </em>The money you make can also be split between the gang members and the stash. For example - 60% of the money earned goes to the gang stash, the other 40% gets split equally between ALL gang members (including the top four). Shares can be changed using the country control panel.</p>
            <p><em>I don't want my country anymore, can I have a refund?</em> No.</p>
            <p><em>Can I give control to the country to other gang members?</em> No, a country can only be controlled by the gang boss. But, your gang members can view the statistics of your country.</p>
            <p><em>What happens if my gang gets wiped? </em>The country you owned is then up for sale.</p>
            <p><em>Are there any limits on how much tax I apply? </em>Yes, limits are applied to everything! There is a maximum of 7% tax on the banks and hitlist. There is also a &pound;1,000,000 maximum travel fee.</p>
            <p><em>Why is there a 7% tax limit? </em>The tax limit is 7% so gangs don't have a massive tax rate. There is also a 3% tax rate aswell as the maximum of 7%. This 3% is not given to anyone.</p></td>
        </tr>
      </table>
        <?php if($fetch2num == "0"){ ?>
        <?php if($gang->owner == $username){ ?>
        <table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
          <tr>
            <td height="22" align="center" valign="middle" class="gradient"><strong>The Takeover</strong></td>
          </tr>
          <tr>
            <td height="40" align="center"><p>So, you think you can control a country then? Before I hand over any contracts - let me see the money and tell me what country you want! </p>
                <p>
                  <label>
                  <select class="textbox" name="country" id="select">
                    <option value="England" selected="selected">England</option>
                    <option value="Germany">Germany</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                    <option value="America">America</option>
                  </select>
                  </label>
                </p>
              <p>Your Password:
                <input name="password_t" type="password" class="textbox" id="textfield8" />
                </p>
              <p>
                  <label>
                  <input type="submit" name="button" id="button" value="Purchase it!" class="custombutton" />
                  </label>
                </p>
              <?php
	  if($_POST['button']){
	  $password_t = addslashes($_POST['password_t']);
	  $country = addslashes($_POST['country']);
      if($gang->owner != $username){ echo"Your not the boss."; }else{	  
	  if($password_t != $fetch->password){ echo"Wrong password."; }else{ 
	  $check = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='$country'"));
if($check->gang != "0"){ echo"This country is owned by a crew already.<br> <b>$check->gang</b> own $country."; }else{
	  if($fetch->money < 100000000){ echo"Not enough money.";}else{
		mysqli_query( $connection, "UPDATE gangCountry SET gang='$fetch->crew', lastedit='0', tax='5' WHERE location='$country'");
		mysqli_query( $connection, "UPDATE accounts SET money=money-100000000 WHERE username='$username'");
echo"You have bought <b>$country</b>.";
	  
	  }}}}}
	  
	  ?></td>
          </tr>
        </table>
        <?php } ?>
        <table width="661" border="1" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
          <tr>
            <td height="22" align="center" valign="middle" class="gradient"><strong>Your Country</strong></td>
          </tr>
          <tr>
            <td height="40" align="center"><p>Your gang does not hold the deeds to a country.<a href="gangCountrycp.php"></a></p></td>
          </tr>
        </table>
        <?php }elseif($fetch2num != "0"){ ?>
        <table width="661" border="0" align="center" 

					 cellpadding="2" cellspacing="0" class="table1px">
          <tr>
            <td height="22" align="center" valign="middle" class="gradient"><strong>The Controls</strong></td>
          </tr>
          <tr>
            <td height="40" align="center"><p>To begin controlling your country, you will need to access the control panel.</p>
                <p><a href="gangCountrycp.php">Take me to the control panel</a></p></td>
          </tr>
        </table>
        <?php } ?></td>
      <td width="250" align="center" valign="top"><table width="250"  border="0" align="center"   cellpadding="0" cellspacing="0" >
        <tr>
          <td class="gradient">Dominate the world!</td>
        </tr>
        <tr>
          <td height="500" align="center" valign="top" background="images/deed.png"><div align="center"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
  </div>
</form>