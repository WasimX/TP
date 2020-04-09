<?php



session_start();



include_once "incfiles/connectdb.php";



include_once "incfiles/func.php";



logincheck();











$page="rps.php";







$username=$_SESSION['username'];















echo "$style"; 



$input="RPS";















$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));



$RPS = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM rps WHERE location='$fetch->location' AND name='RPS'"));



$fetch_owner=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$RPS->owner'"));


if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}



if ($RPS->owner == $username){


	if ($_POST['maxbet']){ 


		$newmax = $_POST['maxbet'];


		if ($newmax < 100){


			echo "<center><font color=white><b>Max must be atleast &pound;100 or above!";


			//in


			exit();


		}elseif ($newmax > 10000000000){


			echo "<center><font color=white><b>max must be less then &pound;10,000,000,000!";


			//in


			exit();


		}elseif(ereg("[^[:digit:]]", $newmax)){


			echo "<center><font color=white><b>Max bet must only contain numbers!";


			//in


			exit();


		}else{


			mysqli_query( $connection, "UPDATE rps SET maxbet='$newmax' WHERE owner='$username' AND location='$fetch->location'");


			echo "<font color=white>Your maxbet has been updated to &pound;$newmax";


		}


	}


	


	if ($_POST['minbid']){


		$newmin = $_POST['minbid'];


		if ($newmin < 100000){


			echo "<center><font color=white><b>Minimum bet must be atleast &pound;100,000 or above!";


			//in


			exit();


		}


		if(ereg("[^[:digit:]]", $newmin)){


			echo "<font color=white>Minimum bet must only contain numbers!";


			//in


			exit();


		}elseif(!ereg("[^[:digit:]]", $newmin)){


mysqli_query( $connection, "UPDATE rps SET minbet='$newmin' WHERE owner='$username' AND location='$fetch->location'");
		
}

		echo "<center><font color=white><b>Minimum bet has been updated to &pound;$newmin!";



	}


	if ($_POST['giveto']){


		$giveto = $_POST['giveto'];


		$checkgiveto = mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$giveto'");


		$checkifexist = mysqli_num_rows($checkgiveto);


		if($checkifexist <= 0){


			echo "<center><font color=white><b>That user does not exist";


			//in


			exit();


		}else{


		while($giver = mysqli_fetch_row($checkgiveto)){


				$giveto = $giver[0];


			}
$date = gmdate('Y-m-d h:i:s');

                        mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `date` )

VALUES ('', '$giveto', 'TP Casinos', '<center>$username is sending you their rps in $RPS->location. <br><br><a href=?decision=accept&type=RPS&location=$RPS->location><b>Accept</b></a> - <a href=?decision=decline&type=RPS&location=$RPS->location><b>Decline</b></a></center>', '$date')");


mysqli_query( $connection, "INSERT INTO `propsend` ( `id` , `type` , `location` , `usernamefrom` , `usernameto` , `date` )

VALUES ('', 'RPS', '$RPS->location', '$username', '$giveto', '$date')");

			


			echo "<center><font color=white><b>The RPS will be transfered when $giveto accepts!";


		}


	}

if (strip_tags($_POST['drop']) == "Yes"){
mysqli_query( $connection, "UPDATE rps SET owner='0', profit='0' WHERE location='$fetch->location' AND owner='$username'");
echo"Dropped!";
exit();
}


		


		


		echo "<link href=style.css rel=stylesheet type=text/css><form method=post action=$self>


		


<table width=300 align=center border=0 cellpadding=0 cellspacing=0 class=table1px>





<tr height=30 class=gradient>


  


<td colspan=4>


      RPS Control Panel</td>


    </tr>


		<tr class=text>


		  <td width=130>Total Earnings: </td>


		  <td width=148 colspan=3>&pound;"; echo number_format($RPS->profit); echo "</td>


		</tr>


		<tr class=text>


		  <td>Max Bet: </td>


		  <td width=148 colspan=3><input name=maxbet type=text id=maxbet class=textbox></td>


		</tr>


		<tr class=text>


		  <td>Current Max: </td>


		  <td colspan=3>&pound;"; echo number_format($RPS->maxbet); echo "</td>


		</tr>

 <tr> 

            <td>Drop:</td>

            <td><select name=drop id=drop class=\"textbox\" style=\"width: 60px;\">

                <option value=\"No\">No</option>

                <option value=\"Yes\">Yes</option>

              </select></td>

          </tr>

		<tr class=text>


		  <td>Give to: </td>


		  <td colspan=3><input name=giveto type=text id=giveto class=textbox></td>


		</tr>


		<tr class=text>


		  <td>&nbsp;</td>


		  <td colspan=4 align=center><input type=submit name=Submit value=Update class=custombutton></td>


		</tr> 


	</table><br>


	</form>


";


	//in


	exit();


}

if ($_POST['Buy']){
if($fetch->money < "10000000"){
echo"You dont have enough money, you idiot!";
}elseif($fetch->money > "10000000"){
$n_money = $fetch->money - "10000000";
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
mysqli_query( $connection, "UPDATE rps SET owner='$username' WHERE location='$fetch->location'");
echo"You successfully bought the RPS!";
}}

if($RPS->owner == "0"){
mysqli_query( $connection, "UPDATE rps SET profit='0' WHERE location='$RPS->location' AND casino='RPS'");
echo"<form method='post'><link href=style.css rel=stylesheet type=text/css><center><b>This RPS table in $RPS->location is currently unowned! Would you like to buy it for &pound;10,000,000?</b><br><br><input name='Buy' type='submit' id=Buy class=custombutton  value='Purchase!' /><br></form>
";
die();
}











if (strip_tags(!$_POST['go']) && $_POST['bet'] == ""){



$ticked="0";



}elseif (strip_tags($_POST['go']) && $_POST['bet'] != ""){







	$bet=intval(strip_tags($_POST['bet']));



	$radiobutton=strip_tags($_POST['radiobutton']);







	if ($radiobutton == "R" || $radiobutton == "P" || $radiobutton=="S"){



		if ($bet > "0"){



		if ($bet == 0 || !$bet || ereg('[^0-9]',$bet)){



	print "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Error</td></tr><tr><td align=center>You cant bet that amount!</td></tr></table><br>";



	$ticked="0";



}elseif ($bet != 0 && $bet && !ereg('[^0-9]',$bet)){











if ($bet > $RPS->maxbet){



echo "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Error</td></tr><tr><td align=center>Your bet exceeds the max bet!</td></tr></table><br>";



$ticked="0";



}elseif ($bet <= $RPS->maxbet){



if ($bet > $fetch->money){



echo "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Error</td></tr><tr><td align=center>Your do not have enough money!</td></tr></table><br>";



$ticked="0";



}elseif ($bet <= $fetch->money){







if ($radiobutton == 'R'){



$player_number = 'R';



$img="images/rps/rock_you.png";



$pc_num = array('R','P','S','R','P','P','P','P','P');



}elseif ($radiobutton=="P"){



$player_number = 'P';



$img="images/rps/paper_you.png";



$pc_num = array('R','P','S','P','S','S','S','S','S');



}elseif ($radiobutton=="S"){



$player_number = 'S';



$img="images/rps/scis_you.png";



$pc_num = array('R','P','S','S','R','R','R','R','R');



}







$pc_guess = rand(0, 3);



$pc_number = $pc_num[$pc_guess];







//////START CHECKING



///////IF THERE ARE DRAWS



if($player_number == "R" && $pc_number == "R"){



$output = "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Tie</td></tr><tr><td align=center>It was a tie Rock V.S Rock!</td></tr></table><br>";



$win="2";



}elseif($player_number == "P" && $pc_number == "P"){



$output = "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Tie</td></tr><tr><td align=center>It was a tie Paper V.S Paper!</td></tr></table><br>";



$win="2";



}elseif($player_number == "S" && $pc_number == "S"){



$win="2";



$output = "<link href=style.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Tie</td></tr><tr><td align=center>It was a tie Scissors V.S Scissors!</td></tr></table><br>";/////END DRAWS START LOOSES



}elseif($player_number == "R" && $pc_number == "P"){



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Failed</td></tr><tr><td align=center>You Lost Your Bet Of &pound;$bet, Rock V.S Paper!</td></tr></table><br>";



$win="0";



}elseif($player_number == "P" && $pc_number == "S"){



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Failed</td></tr><tr><td align=center>You Lost Your Bet Of &pound;$bet, Paper V.S Scissors!</td></tr></table><br>";



$win="0";



}elseif($player_number == "S" && $pc_number == "R"){



$win="0";



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=300 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Failed</td></tr><tr><td align=center>You Lost Your Bet Of &pound;$bet, Scissors V.S Rock!</td></tr></table><br>";



//////END LOOSES START WINS



}elseif($player_number == "R" && $pc_number == "S"){



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Success</td></tr><tr><td align=center>You Won Your Bet Of &pound;$bet, Rock V.S Scissors!</td></tr></table><br>";



$win="1";



}elseif($player_number == "S" && $pc_number == "P"){



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Success</td></tr><tr><td align=center>You Won Your Bet Of &pound;$bet, Scissors V.S Paper!</td></tr></table><br>";



$win="1";



}elseif($player_number == "P" && $pc_number == "R"){



$output="<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Success</td></tr><tr><td align=center>You Won Your Bet Of &pound;$bet, Paper V.S Rock!</td></tr></table><br>";//////END WINS



$win="1";



}



////END CHECKING******



if ($win == "1"){



////NOW UPDATE STATS



$new_money = $bet * 1;



$n_money = $fetch->money + $new_money;







$owner_money=$fetch_owner->money - $new_money;



if ($owner_money <= "0"){

mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'RPS', '$bet', '$fetch->location', '$RPS->owner', NOW(), 'Win', '', 'Wiped previous owner.')");


echo "<link href=wmstyle.css rel=stylesheet type=text/css><center><table width=350 align=center cellpadding=0 cellspacing=0 class=table1px><tr class=gradient><td>Success</td></tr><tr><td align=center>You Won Your Bet Of &pound;$bet And Took Over The RPS Table As The Owner Ran Out Of Money!</td></tr></table><br>";







mysqli_query( $connection, "UPDATE rps SET owner='$fetch->username' WHERE name='RPS' AND location='$fetch->location'");



}elseif($owner_money > "0"){







echo "<font color=white>$output</font>";


mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'RPS', '$bet', '$fetch->location', '$RPS->owner', NOW(), 'Win', '$bet', '')");


mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");



$ear = $RPS->profit - $new_money;



mysqli_query( $connection, "UPDATE rps SET profit='$ear' WHERE location='$fetch->location' AND casino='RPS' AND owner !='0'");



mysqli_query( $connection, "UPDATE accounts SET money='$owner_money' WHERE username='$RPS->owner'");



}



}elseif ($win == "0"){



//////NOT GETTING BROKE AND IF THEY LOOOOOOOOOOOOOSE//////







$new_money2 = $fetch_owner->money + $bet;



$ear2 = $RPS->profit + $bet;



$loose_money=$fetch->money-$bet;



mysqli_query( $connection, "UPDATE rps SET profit='$ear2' WHERE location='$fetch->location' AND casino='RPS' AND owner !='0'");



mysqli_query( $connection, "UPDATE accounts SET money='$new_money2' WHERE username='$RPS->owner'");

mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'RPS', '$bet', '$fetch->location', '$RPS->owner', NOW(), 'Lose', '0', '')");


		mysqli_query( $connection, "UPDATE accounts SET money='$loose_money' WHERE username='$username'"); 



echo "$output";



}elseif ($win == "2"){



echo "$output";



}}}







if ($pc_number == "R"){



$img_pc="images/rps/rock_pc.png";



}elseif($pc_number == "P"){



$img_pc="images/rps/paper_pc.png";



}elseif($pc_number == "S"){



$img_pc="images/rps/scis_pc.png";



}







$ticked="1";







}}}}



?>

<title>Thug Paradise :: RPS</title>
<link href=style.css rel=stylesheet type=text/css>
<script language=JavaScript> 
<!--
 
//Disable right click script III- By Renigade (renigade@mediaone.net)
//For full source code, visit http://www.dynamicdrive.com
 
var message='';
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
 
document.oncontextmenu=new Function('return false')
// --> 
</script>

<script language=JavaScript>



function so(dis)



{



for (i=0;i<dis.elements.length;i++){ 



	if (dis.elements[i].type=='submit')



	   dis.elements[i].style.visibility='hidden';



	}



	if(fs==false){



		 fs=true;



		 return true;



	}else



 		return false;



	}



	function goaway()



{



for(i=0;i<document.forms.length;i++)



 document.forms[i].onsubmit = function() {return so(this);};



}



</script>

<style type="text/css"><!--
.style2 {font-size: 10px; color: #0000FF; font-family: Verdana; font-weight: bold;}
--></style>

<html>



<head>



<link rel="shortcut icon" href="favicon.ico.png">



<link href=style.css rel=stylesheet type=text/css>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



</head>











<body OnLoad="goaway()">



<form action="" method=POST>







<br>



<?php if ($ticked == "0"){ ?>



<table width="450" align="center" cellspacing="0" cellpadding="0" class="tablerps">





   <tr>

		<td width="50%"><font class="style2"><center><b>You:</b></center></font></td>

		<td width="50%"><font class="style2"><center><b>Dealer:</b></center></font></td>

	</tr>

	<tr height="150">

		<td align="center"><img src="images/rps/scis_pc.png"></td>

		<td align="center"><img src="images/rps/rock_pc.png"></td>

	</tr>



  <tr> 



    <td class="style2" height="22" align="center" colspan="2" width="50%">Choice: <select name="radiobutton" class="textbox">

			<option value="R"

			>Rock</option>

			<option value="P"

			>Paper</option>

			<option value="S"

			>Scissors</option>

		</select></td>

	</tr>




  <tr> 



    <td height="22" align="center" colspan="2" class="style2">Bet: <input name="bet" class=textbox type="text" id="bet" onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off"></td> 



  </tr>

<tr>

		<td height="22" align="center" colspan="2">        <input name="go" class=custombutton type="submit" id="go" value="Play!">
</td>

	</tr>

  <tr> 



    <td class="style2" height="35" colspan="2"> <div align="center"> 



This RPS table in <b><?php echo "$RPS->location"; ?></b> is currently owned by <?php if ($RPS->owner == "0"){ echo "Unowned"; }else{ echo "Owned By <a href='profile.php?viewing=$RPS->owner'><b>$RPS->owner</b></a>"; } ?><br>
<br>
The Maximum bet currently set by the owner of this table is <b><?php echo "&pound;".makecomma($RPS->maxbet).""; ?></b>
<br><br>

      </div></td>



  </tr>



</table></form>



<?php }elseif ($ticked =="1"){ ?>

<form action="" method=POST>



<table width="450" align="center" cellspacing="0" cellpadding="0"

	class="tablerps">

     
		






   <tr>

		<td class="style2" width="50%"><center><b>You:</b></center></font></td>

		<td class="style2" width="50%"><center><b>Dealer:</b></center></font></td>

	</tr>

	<tr height="150">

    <td align="center"><?php echo "<img src=$img>"; ?></td>



   <td align="center"><?php echo "<img src=$img_pc>"; ?></td>

	</tr>



  <tr> 



    <td class="style2" height="22" align="center" colspan="2" width="50%">Choice: <select name="radiobutton" class="textbox">

			<option value="R" <?php if ($_POST['radiobutton'] == "R"){ echo "selected"; }?>
			>Rock</option>

			<option value="P"<?php if ($_POST['radiobutton'] == "P"){ echo "selected"; }?>
			>Paper</option>

			<option value="S"<?php if ($_POST['radiobutton'] == "S"){ echo "selected"; }?> 
			>Scissors</option>

		</select></td>

	</tr>




  <tr> 



    <td height="22" align="center" colspan="2" class="style2">Bet: <input name="bet" class=textbox type="text" id="bet" onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off" value="<?php echo "$_POST[bet]"; ?>"></td> 



  </tr>

<tr>

		<td height="22" align="center" colspan="2">        <input name="go" class=custombutton type="submit" id="go" value="Play!">
</td>

	</tr>

  <tr> 



    <td class="style2" height="35" colspan="2"> <div align="center"> 



This RPS table in <b><?php echo "$RPS->location"; ?></b> is currently owned by <?php if ($RPS->owner == "0"){ echo "Unowned"; }else{ echo "Owned By <a href='profile.php?viewing=$RPS->owner'><b>$RPS->owner</b></a>"; } ?><br>
<br>
The Maximum bet currently set by the owner of this table is <b><?php echo "&pound;".makecomma($RPS->maxbet).""; ?></b>
<br><br>

      </div></td>



  </tr>



</table></form>




</p>



<?php } ?>

<br><table align="center" width="460" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p><strong>Rock, Paper, Scissors</strong>, also known in Japan as Janken, is a hand game most often played by children. It is often used as a selection method in a similar way to coin flipping, Odd or Even, throwing dice or drawing straws to randomly select a person for some purpose, though unlike truly random selections it can be played with skill if the game extends over many sessions, because one can often recognize and exploit the non-random behavior of an opponent.<br/>
<br/>
<img src="http://i15.tinypic.com/63jwbx1.jpg" width="316" height="229"/></p>
<a href="casinos.php">Gambling Policy</a> - Including information on chance &amp; fairness.</p></div></td></tr></table></td></tr></table></td></tr></table>
<?php include_once"incfiles/foot.php"; ?>

<p>