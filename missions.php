<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

logincheck();





$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));



////Jail Check////

$jail=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='$username'"));

if($jail != "0"){ echo"<SCRIPT LANGUAGE='JavaScript'>window.location='jail.php';</script>";}

////Jail Check////

echo "<link href='style.css' rel='stylesheet' type='text/css'>";


$query1=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");

$info=mysqli_fetch_object($query1);


$chekd1=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission = 'd1'"));

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission = '$fetch->mission'"));

$chek1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username'"));

$d1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission = 'd1'"));



if($chek != "0"){

if($chek1->timeleft <= time()){

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"You failed that mission.";

}}

$mission1 = "Getting Into Character";

?>



<html>

<head>

<title>Thug Paradise :: Missions</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<style type="text/css">

<!--

.style1 {color: #000000}

-->

</style>

</head>

<style>
.missions{
background:url(../index3/images/box.png);
width:655px;
height:287px;
padding-top:38px;
padding-left:10px;
color: #FFFFFF;
float:center;
font-family: Arial, Helvetica, sans-serif;
font-size: 16px;
}
.red{
color: #FFD700;
height:30px;
font-weight: bold;
font-family: sans-serif;
font-size: 16px;
}
</style>
<body>

<form action="" method="post">

<br>


<?php

if($_GET['mission'] == "d184727272"){

?>
<table width="660" border="1" align="center" cellpadding="2" cellspacing="0"  class="missions">
  <tr>
    <td height="22" align="center" class="red">GTA Master</td>
  </tr>
  <tr>
    <td align="center" class="newCrime"><?php if($fetch->d1 <= time()){ ?>
      Can you hack it being a big crime boss?<br>
      Steal 5 cars to prove you have what it takes.<br>
     
<?php if($chekd1 == "0"){ ?><input type="submit" class="custombutton" name="start" id="acc" value="Start Mission"><?php }else{ ?> You have stolen <?php echo"$d1->unit";?>/5 cars so far.<br> <?php } ?>
      <?php
	  
if($d1->unit >= "5"){
$ntime = time() + 86400;
mysqli_query( $connection, "UPDATE accounts SET money=money+50000, rankpoints=rankpoints+50, d1='$ntime' WHERE username='$username'");
mysqli_query( $connection, "DELETE FROM missions WHERE id='$d1->id'");
exit("<br>You have proved again that you are the 'big boss'<br>
<font color=red>In a package you found &pound;50,000!</font>");
}
	  
	  
	   if (strip_tags($_POST['start'])){

if($fetch->d1 <= time()){
	 $timeleft = time() + 86400;
if($chekd1 == "0"){
	mysqli_query( $connection, "INSERT INTO `mission` ( `id` , `username` , `mission` , `unit` , `completed`, `timeleft` )

VALUES (

'', '$username', 'd1', '0', 'No', '$timeleft')");
}else{
echo"You've already done this mission.";
}
echo"You accepted the mission, you've got 24 hours left to complete it."; 

	}else{
	echo"You can't do another daily mission.";
	}}
	  
	  
	  
	   }else{ echo"You can't do this daily mission for another ".maketime($fetch->d1)."."; }?><br></td>
  </tr>
</table>


<?php
}
if($chek == "0" && $_GET['mission'] == ""){

?>

<table width="600" height="200" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">

  <tr>

    <td align="center" height="22" class="gradient"><h1>TP Missions</h1></td>

  </tr>

 <tr>

    <td  align="center">

     <span class="style1">    </span>

     <table width="95%" border="0" style="border:1px solid #000000;" cellpadding="2" cellspacing="0" class="table1px">

       <tr>

         <td align="center">

           <?php

    if($fetch->mission == "1"){

    echo"Welcome $username,  A good mate has referred you to 'The Don' of the streets, but before he will even speak to you, you need to prove you have the balls to take care of his business! Commit 10 crimes successfully and he will get in contact with you......";

    }elseif($fetch->mission == "2"){

	    echo"Welcome $username, You ready to rob some cars? Bare in mind pal you got 48hours as soon as you accept the mission!";

	}elseif($fetch->mission == "3"){

	echo"Welcome $username, You ready to hit the roulette?";	

}elseif($fetch->mission == "4"){

	echo"Welcome $username, You ready to get involved into gangs?";	

	}elseif($fetch->mission == "5"){

		echo"Welcome $username, You ready to transport drugs?";

	}elseif($fetch->mission == "6"){

	echo"Welcome $username, You ready to tear up the jail?!";

		}elseif($fetch->mission == "7"){

			echo"Welcome $username, You ready to hustle?";

	}elseif($fetch->mission == "8"){

	echo"Welcome $username, to the missions center here you will be able to complete missions within the game and gain money,exp,bullets there will be hard missions and then there will be easy missions click accept to start the mission!";
	}elseif($fetch->mission == "9"){
	echo"Hello, I'm your brothers kidnapper, my name is Leovezzi. I see you brought the drugs. Just one problem, I want £1,000,000,000 by tonight, or he dies. You have 48 hours to get that money together. 

<u><b>Technical Info:</b></u> Raise £1,000,000,000 or kill the kidnapper. ";

	}else{
	echo"All of the missions have been completed. Please come back later and there maybe a few more added for you to enjoy!";

	exit();

	}

	if($fetch->mission != ""){

    ?>

         </span></td>

       </tr>

     </table>

     <span class="style1"><br>

    <br>



    <input type="submit" class="custombutton" name="acc" id="acc" value="Accept Mission!">

    &nbsp;

      <input type="submit" class="custombutton" hidden="hidden" name="rej" id="rej" value="Reject">

      <br>

      <?php } ?>

      <?php

	 if (strip_tags($_POST['acc'])){

	 $timeleft = time() + 172800;

	mysqli_query( $connection, "INSERT INTO `mission` ( `id` , `username` , `mission` , `unit` , `completed`, `timeleft` )

VALUES (

'', '$username', '$fetch->mission', '0', 'No', '$timeleft')");

echo"<font color=white>You accepted that mission you've got 48 hours left to complete it.</font>"; 

	 }elseif (strip_tags($_POST['rej'])){

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

echo"You rejected that mission you was'nt payed for this!"; 

	 }

	 ?>    

      </span><br></td>

  </tr>

  

</table>




<p>&nbsp;</p>

<p>

  <?php

}elseif($chek == "1" && $_GET['mission'] == ""){

?>

  </p>

<table width="660" border="0" align="center" cellpadding="2" cellspacing="0"  class="table1px">

  <tr>

    <td height="22" align="center" class="gradient"><h1><font color=white>Mission <?php echo"$chek1->mission";?></font></h1></td>

  </tr>

  <tr>

    <td height="117" align="center" class="newCrime"><?php

    if($chek1->mission == "1"){

    echo"The Boss, wants you to prove your worthy of being associated with him. He wants you to commit 10 crimes succesfully for him. You've got 48 hours to do it, so hurry!

	<br>

<u><b>Technical Info:</b></u> Commit 10 crimes only and do it in 48 hours.

<br><br>

You've committed ".makecomma($chek1->unit)."/10 crimes successfully so far.<br><br>

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.";  

if($chek1->unit >= "10"){



mysqli_query( $connection, "UPDATE accounts SET money=money+5000000, rankpoints=rankpoints+500 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"<br>

You have proved yourself to the boss he's accepted you, welcome to the Thugs Paradise. He left a package on the table for you.<br>

<font color=red>In the package was &pound;5,000,000!</font>";

exit();

}

}elseif($chek1->mission == "2"){

    echo"You are walking to your home one stormy evening, it is raining heavily. As you are walking you see a black Audi RS3 parked, a gun shot is heard using an M82A1 and the car speeds off. You approach

the person lying down on the floor which is your brother, as you approach you notice they dropped a showroom business card. How and why this happened you need to find out.

	<br>

<u><b>Technical Info:</b></u> Steal a car from a showroom to find out more about the incident.

<br><br>

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.";  

if($chek1->unit >= "1"){



mysqli_query( $connection, "UPDATE accounts SET money=money+10000000, rankpoints=rankpoints+500 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"<br>

The celebrity was too fast for you to keep up with, however due to the vigorous driving in the treacherous weather conditions, the celeb dropped a package.<br>

<font color=red>In the package was &pound;10,000,000!</font>";

exit();

}

}elseif($chek1->mission == "3"){

    echo"It is frustrating you as to who could have committed the murder of your brother as you have no sworn enemies. The frustration gets to you which therefore leads you drinking and gambling problems. Your Husband/Wife demands money from your for shopping

	<br>

<u><b>Technical Info:</b></u> Earn as much from gambling in the Roulette.

<br><br>

You've got ".maketime($chek1->timeleft)." left until you fail the mission.<br>

You have won ".makecomma($chek1->unit)." bet(s) out of 20 so far.";  

if($chek1->unit >= "20"){



mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+500 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"<br>

You gave your Gambling earnings to your Husband/Wife, who snatched it from your hands and hurried off to shopping.<br><br></font>";

exit();

}

}elseif($chek1->mission == "4"){

   	echo"You decided to join a local gang in the country your in as youve realised that the killer of your brother may be after you and youve noticed that you will get a rewarded by the Gang Owner of the gang you join!

<br><u><b>Technical Info:</b></u> Join A Gang.<br>

You've got ".maketime($chek1->timeleft)." left until you fail the mission.<br>

You have applied for ".makecomma($chek1->unit)." gangs so far.";  

if($chek1->unit >= "1"){



mysqli_query( $connection, "UPDATE accounts SET money=money+25000000, rankpoints=rankpoints+500 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"<br>You joined a gang and two days later one of your leaders got killed!<br>

\"Its all over\" you repeated<br>

\"I'll never find my brothers killer\"<br>

The helpful member who helped you and comforted you at the funereal heard you talking to yourself. The member by turned out to be a Billionaire who decided to give you &pound;25,000,000 as a free token in order to help you with your search.<br>

<font color=red>You gained &pound;25,000,000!</font>";

exit();

}

}elseif($chek1->mission == "5"){

if($fetch->location == "England"){

$dr = explode("-", $fetch->drugs);

if($dr[2] > "0"){

$drug = $dr[2];

$newdrugs = "$dr[0]-$dr[1]-0-$dr[3]-$dr[4]";

mysqli_query( $connection, "UPDATE mission SET `unit`=unit+$drug WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET `drugs`='$newdrugs' WHERE username='$username'");

echo"$drug units of cocaine have been added!<br>";

}}

 echo"You thought over on what to do with your money, however you were unable to come to any decision as the money amount was not enough. You therefore decided to use your money in drugs to double the amount. A man known well in England as \"Crack Head\" needs some cocaine, fast! He needs it from anywere other than England.

<br><u><b>Technical Info:</b></u> Get 100 units of cocaine from any place other than England, then get your ass to England.<br>

Just come to this page with the drugs and I'll take them off your hands!

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.<br>

You've got ".makecomma($chek1->unit)."/100 units of cocaine so far.";  

if($chek1->unit >= "100"){

mysqli_query( $connection, "UPDATE accounts SET money=money+50000000, jhp=jhp+25000, rankpoints=rankpoints+750 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"<br>The weird Crack Head took the cocaine off you and started to laugh. \"This will be put to some good use eh'\" he sniggered.

He payed you &pound;50,000,000 for the drugs and ran off laughing, you walk through the alley with a sulk and find a box with bullets.<br>

<font color=red>You gained &pound;50,000,000 & 25,000 JHP!</font>";

exit();

}

}elseif($chek1->mission == "6"){

 echo"Now that you have 25,000 JHP you decided to put your bullets into action, you used your money to find out that there is one man who could help track down your brothers killer<br>His name is De Maco, Lucious Galfariyo De Maco<br>

However after knowing his name you also learned he was placed in Jail for Robbery<br>

Unaffected in hearing this you decided to learn the art of Prison Breaking in order to Break De Maco from jail<br>

Break 200 users from jail to continue<br>

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.<br>

You've done ".makecomma($chek1->unit)."/200 jail breaks so far.";  

if($chek1->unit >= "200"){

mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+500 WHERE username='$username'");

mysqli_query( $connection, "DELETE FROM mission WHERE id='$chek1->id'");

	mysqli_query( $connection, "UPDATE accounts SET mission=mission+1 WHERE username='$username'");

	echo"Click! You've gained respect, are can now go out and bust that fool out, so he can help you.<br>

<font color=red>You gained 5 AWP Bullets and busting skills!</font>";

exit();

}

}elseif($chek1->mission == "7"){

 echo"Upon ariving at the Mexico Prison you saw that De Maco's holding area had them most security than the other areas of the prison<br>

\"Damn.....This......maybe tricker than I thought\"<br>

You decided to think like James Bond style<br>

You grabbed your grenade and threw it in the main gate of the prison which blew up and attracted much attention<br>

\"Great ..... This cover up will do me just fine\"<br>

You then went off towards De Maco's prison, upon finding it, you placed you knowledge of Prison breaking onto this one final break<br>

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.";  

}elseif($chek1->mission == "8"){

echo"Over the weeks, you and De Maco piece together a track list of people that could have been involved in your brothers killing<br>

\"It's no use, theres nothing we can piece together, theres barely any evidence\" you say<br>

\"So does that mean I can go?\"<br>

\"What do you mean you can go, i didnt pain my ass in learning how to break, then break your ass from jail for you to say can I go\"<br>

\"Then stop complaining like a silly old lady and get your ass in solving this\"<br>

After much time in unravling some evidence you solve who one of the participants of the killing through bullet recognition from the bullet shop.<br>

You decide to take your gun and hunt down the guy who helped in arranging a car for the murder.<br>

You take a trip down Benefit street and get out of your car. You approach the door while placing your hand on the door handle, your turn it....<br>

Successfully kill another player in order to continue<br>

You've got ".maketime($chek1->timeleft)." left untill you fail the mission.";  

}elseif($chek1->mission == "") {

echo"All of the missions have been completed. Please come back later and there maybe a few more added for you to enjoy."; 



}



?></td>

  </tr>

</table>



</form>

</body>

</html>
 

<tr><td height="324" width="42%" valign="middle"><br><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style360"><p>Here is the latest feature to TP where you a story line of missions to do. Each mission you accept you have 48 hours to accomplish it so be steady and also ready, any help needed with your missions feel free to seek information at the help desk page.</p></div></td></tr></table></td></tr></table></td></tr></table>
 <?php } 




include_once"incfiles/foot.php"; ?>



