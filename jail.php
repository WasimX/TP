<?php 

session_start(); 

include_once "incfiles/connectdb.php"; 

include_once "incfiles/func.php"; 

logincheck();



$username=$_SESSION['username'];



$jailssss=mysqli_query( $connection, "SELECT * FROM jail WHERE username='$username'");



while($jailsssss=mysqli_fetch_object($jailssss)){



$lolR=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='$jailsssss->username'"));







if (time() > $jailsssss->time_left){



mysqli_query( $connection, "DELETE FROM jail WHERE username='$jailsssss->username'");



}



}











$ttime = time() + 0;







$chek1=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='7'"));



	   	   $chek1s=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='7'"));











$find=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");



$fetch=mysqli_fetch_object($find);



$find1=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");



$fetch1=mysqli_fetch_object($find1);



$jail=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='$username'"));



$site=mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'");



$sitestats=mysqli_fetch_object($site);









if ($fetch->scriptcheck >= "150"){ echo "<meta http-equiv=\"refresh\" content=\"1;url=scriptcheck.php?page=jail\" />"; }
elseif ($fetch->scriptcheck < "150"){





if(strip_tags($_POST['chuckem'])){



if($fetch->userlevel == "1" || $fetch->userlevel == "4"){



$chuck = strip_tags($_POST['jail']);



$length11 = time() + 1000;	



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`) VALUES ('', '$chuck', '$length11');") or die (mysqli_error());



mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `date` , `read` , `saved` , `event_id` ) 



VALUES ('', '$chuck', '$username', '<b>$username</b> has chucked you in jail! - (Mod / Admin Option)', '$date', '0', '0', '0')"); 



echo "You chucked <b>$chuck</b> into jail!";







}}}









?>




<style>

div.bust{

color:#666666;

font-weight:bold;

}

</style>





<link href="../style.css" rel="stylesheet" type="text/css" />







<style type="text/css">

<!--

.style1 {color: #000000}

.style2 {

	color: #FF0000;

	font-size: 12px;

}

-->

</style>

<form method="post" action="">



<div align="center" class="bust">



  <p class="style2">

    <?php $bust=strip_tags($_GET['bust']);



if($bust){



if($bust == ""){

exit("You can't.");

}elseif($bust != "1"){

 }

if ($jail != "0"){



echo "You cannot bust people whilst in jail.";



}elseif ($jail == "0"){



$jailinfo=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM jail WHERE id='$bust'"));



$jailnums=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE id='$bust'"));



$find2=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$jailinfo->username'");



$fetch22=mysqli_fetch_object($find2);



if($jailinfo->username == $username){



echo "Busting yourself would be cheating!";



}elseif($jailinfo->username != $username){



if($jailnums == "0"){



echo "That user is no longer in jail.";



}elseif($jailnums != "0"){



if($fetch->jailwait > time()){



echo"You cant bust for another ".maketime($fetch->jailwait).".";



}elseif($fetch->jailwait <= time()){



if($bust == "1" || $bust == "2"){ 



$jailnums = "1";



}



if($bust == "2"){



$rand = "1";



}else{



$rand = rand(0,200);



}



if ($rand < "90"){



if($fetch->steroids > "0"){ mysqli_query( $connection, "UPDATE accounts SET steroids=steroids-1 WHERE username='$username'"); }



echo"You failed busting this user.";



mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+5, jailwait='$ttime', scriptcheck=scriptcheck+1 WHERE username='$username'");



$reason = "Jail busting";



require_once"incfiles/failed.php";



}



if ($rand > "90"){ 



if($jailinfo->username != "Crackhead Cell" && $fetch22->jailm == "off"){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '360', '10000');") or die (mysqli_error());



}



if($chek1 > '0'){



mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+400 WHERE username='$username'");



mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1s->id'");



	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");



	echo"Success!<br>



You broke De Maco out of jail and successfully made it back to your car.";



}else{



echo"<font color=white>You successfully busted <a href=profile.php?viewing=$jailinfo->username>$jailinfo->username</a> out of jail!</font><br>
<font size=1 color=white>You received </font><font size=1 color=#FFCC33>&pound;".makecomma($jailinfo->breward)."</font><font size=1 color=white> for the bust!</font>";

if($fetch->steroids > "0"){ mysqli_query( $connection, "UPDATE accounts SET steroids=steroids-1 WHERE username='$username'"); 

}}



$chek222=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='6'"));



if($chek222 > '0'){



mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'");



}



if ($sitestats->extra == "On"){



$random="$sitestats->jail"; 



}elseif ($sitestats->extra == "Off"){



$random="0"; }



$nrank=$fetch->rankpoints + 10 + $random;


$info_jail=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM jail WHERE id='$bust'"));

$findr = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$info_jail->username'");
$fetchr=mysqli_fetch_object($findr);

if($fetchr->money >= $fetchr->breward){
mysqli_query( $connection, "UPDATE accounts SET money=money+$jailinfo->breward WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET money=money-$fetchr->breward WHERE username='$fetchr->username'"); }


mysqli_query( $connection, "UPDATE accounts SET rankpoints='$nrank', jailwait='$ttime' WHERE username='$username'");



mysqli_query( $connection, "UPDATE account_info SET busts=busts+1 WHERE username='$username'");



mysqli_query( $connection, "DELETE FROM jail WHERE id='$bust'");



if($fetch->steriods > "0"){ mysqli_query( $connection, "UPDATE accounts SET steriods=steriods-1 WHERE username='$username'"); }



}}}}}}



?>

  </p>

  </div>




<table width="400" border="0"  align="center" cellpadding="2" cellspacing="0" class="table1px">

  <tr>

    <td colspan=12 class="gradient"><center>

      <b>TP Jail</b>

    </center></td>

  </tr>

  <tr class="gradient">

    <td width=50%  align=center>Username</td>

    <td align=center width=25%>Time Left</td>

    <td align=center width=25%>Break</td>

  </tr>

  <?php



if($chek1 > '0'){



if($fetch->location == "England"){



echo"<tr><td  align=\"center\"><font color='#33CCFF'><b>Lucious Galfariyo De Maco</b></font></td>



		        <td align=\"center\"><a href='?bust=1'>Bust User</a></td>



     </tr>";}}



		



		



 $query=mysqli_query( $connection, "SELECT * FROM jail LIMIT 40");



      $num=mysqli_num_rows($query);



while($inf=mysqli_fetch_object($query)){




if ($inf->time_left == ""){



$inf->time_left="-"; }

$per_in = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$inf->username'");



$per = mysqli_fetch_object($per_in);

$jj=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$inf->username'"));



if($jj->crew == $fetch->crew){ $col = "red"; }else{ $col = ""; }




echo "<tr><td align=center>$it<a href='profile.php?viewing=$inf->username'><b>$inf->username</b></a><img src='images/currency.png' title='Reward: &pound;".makecomma($per->breward)."".makecomma($inf->breward)."' border='0'></td><td align=center>";

if ($inf->time_left > time()){
$left = $inf->time_left - time();
echo "$left seconds";
}
echo"</td><td align=center><a href='jail.php?bust=$inf->id'><b>Break</b></a></td></tr>";


	  }



 ?>

</table>

<p>






       <?php



if ($nums < "4"){



$length11 = time() + 360;	



  



$numf1=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf1 == 0){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf2=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf2 == 1){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf3=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf3 == 2){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



$numf4=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf4 == 3){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf5=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf5 == 4){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf6=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf6 == 5){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf7=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf7 == 6){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



$numf8=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='Crackhead Cell'"));



if($numf8 == 7){



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', 'Crackhead Cell', '$length11', '10000');") or die (mysqli_error());



}



}}



?></form>

<?php if (($_POST['changereward'])){

$reward=strip_tags($_POST['rewarder']);

		if (ereg('[^0-9]',$reward)){

	print "Error";

}elseif (!ereg('[^0-9]',$reward)){

mysqli_query( $connection, "UPDATE accounts SET breward=$reward WHERE username='$username'");

echo "<center>Jail Bust Reward updated!</center>";
}
}

?>



<form method="POST" action="">



<table width=400 align=center border=0 cellpadding=0 cellspacing=0 class=table1px>
<tr>
<td colspan=1 align=center class=gradient>Jail Bust Reward</td></tr>
<tr>
<td align=center>Reward (&pound;): <input name="rewarder" id="reward" class="textbox" value="<?php echo "$fetch->breward"; ?>" onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off">

<input name=changereward class=custombutton type=submit id=breward value=Submit></td>
</tr></table></form>














</html>
<tr><td height="324" width="42%" valign="middle"><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center">This page is the jail. When you fail a Crime/GTA and you're caught by the pigs you're sent to jail along with any other lowlife already in there. You stay in jail until someone busts you or you've time. Whilst in jail there is a chance some kind gangsta seeking respect might bust you, or you can do the same. Busting earns rank and you'll gradually get better at it!  </p></div></td></tr></table></td></tr></table></td></tr></table>

<?php include_once"incfiles/foot.php"; ?>











