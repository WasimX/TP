<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
include_once "incfiles/jailcheck.php";
logincheck();


echo "<link href=\"library/wtm.css\" rel=\"stylesheet\" type=\"text/css\" />"; 
echo "<script type='text/javascript' src='library/timer.js'></script>"; 

$page="gta2.php";








$username=$_SESSION['username'];


$radiobutton=$_POST['radiobutton'];


$above = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");


$info = mysqli_fetch_object($above);


$chance = explode("-", $info->gtachance);








if ($info->lastgta > time()){


$left = $info->lastgta - time();


echo "<center>You must lay low for <span id='gta'></span><script type='text/javascript'>setTimer('gta','$left', { 0: function () { window.location = 'gta2.php' }});	</script> seconds before you can commit another GTA!<br>
<br><b>Tired of waiting to do your next GTA? Steroids can be taken by using credits if you wish to be die-hard and not have to wait inbetween each GTA for plenty of cars n rank!</b></center></center><br>";



exit();


}




if($radiobutton == "0"){

echo"<center>Error!</center>"; die(); }







if ($_POST['submit']){





$suc = $chance[$radiobutton];


$ran = rand(1,45);


	if ($ran <= $suc){


	





if ($radiobutton == "1"){


  $success = $chance[0];


     $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Mercedes SLK Mclaren');





 $quote="";


 ////NEXT RADIO


}elseif ($radiobutton == "2"){


  $success = $chance[1];


        $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Bugatti Veyron','Mercedes SLK Mclaren');





$quote="";


  ////NExT RADIO


}elseif ($radiobutton == "3"){


  $success = $chance[2];


         $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Bugatti Veyron','Mercedes SLK Mclaren');





  $quote="<center>The salesperson took a break.</center>";





  ////NExT RADIO


}elseif ($radiobutton == "4"){


  $success = $chance[3];


         $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Bugatti Veyron','Mercedes SLK Mclaren');





  $quote="";








  ////NExT RADIO


}elseif ($radiobutton == "5"){


  $success = $chance[4];


         $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Bugatti Veyron','Mercedes SLK Mclaren');





  $quote="";








  ////NExT RADIO


}elseif ($radiobutton == "6"){


  $success = $chance[5];


         $cars = array('Renault Clio Sport','Audi A3','BMW M3','Cadilac Escelade','Nissan Skyline','Porsche 911','GT 40','Lamborghini Murcielago','Ferrari Enzo','TVR Speed 12','Mclaren F1','Bugatti Veyron','Mercedes SLK Mclaren');





  $quote="";








}


$win=rand(0,11);


if ($cars[$win] == "Renault Clio Sport"){ $img = "images/cars/renaultcliosport.jpeg"; }


elseif ($cars[$win] == "Audi A3"){ $img = "images/cars/audia3.jpg"; }


elseif ($cars[$win] == "BMW M3"){ $img = "images/cars/bmw-m3.jpg"; }


elseif ($cars[$win] == "Cadilac Escelade"){ $img = "images/cars/esacallade.gif"; }


elseif ($cars[$win] == "Nissan Skyline"){ $img = "images/cars/nissan.jpg"; }


elseif ($cars[$win] == "Porsche 911"){ $img = "images/cars/porsche.jpg"; }


elseif ($cars[$win] == "GT 40"){ $img = "images/cars/fordgt40.jpg"; }


elseif ($cars[$win] == "Mercedes SLK Mclaren"){ $img = "images/cars/mercedes.jpg"; }


elseif ($cars[$win] == "Lamborghini Murcielago"){ $img = "images/cars/land.jpg";}




echo "<link href='style.css' rel='stylesheet' type='text/css'><br>
<table width='60%' align='center' cellspacing='0' class='table1px'>
<tr>
  <td colspan='6' class='gradient' align=center>Notice!</center></td>
</tr>
      
<tr>
  <td width='20'></td>
  <td width='165' align='center'>Nice Work You Jump In The Car A Speed Off And Get Away With A $cars[$win]!</label></td>
  <td width='20'></td>
</tr>
</div></table>";
$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='2'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }
mysqli_query( $connection, "UPDATE account_info SET gtas=gtas+1 WHERE username='$username'");
if($info->steroids > '0'){
mysqli_query( $connection, "UPDATE accounts SET steroids=steroids-1 WHERE username='$username'");
}



elseif ($cars[$win] == "Ferrari Enzo"){ $img = "images/cars/ferrarienzo.jpg"; }


elseif ($cars[$win] == "TVR Speed 12"){ $img = "images/cars/tvr12.jpg"; }


elseif ($cars[$win] == "Mclaren F1"){ $img = "images/cars/mcf1.jpg"; }


elseif ($cars[$win] == "Bugatti Veyron"){ $img = "images/cars/BuggatiVeyron.jpg"; }











echo "<br><br><center><img src=\"$img\"></center>";

mysqli_query( $connection, "UPDATE account_info SET gtas=gtas+1 WHERE username='$username'");







$time= time() + (60*5);


$newrank=rand(1,20);


$damage=rand(0,20);





 if ($cars[$win] == "Renault Clio Sport"){


  $max="5000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }





//////////////////////////////////////








 if ($cars[$win] == "Audi A3"){


  $max="6000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }





/////////////////////////////////////////











 if ($cars[$win] == "BMW M3"){


  $max="15000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }











////////////////////////////////////














 if ($cars[$win] == "Cadilac Escelade"){


  $max="30000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }





//////////////////////////////////














 if ($cars[$win] == "Nissan Skyline"){


  $max="40000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "Porsche 911"){


  $max="55000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "GT 40"){


  $max="80000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "Lamborghini Murcielago"){


  $max="110000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "Ferrari Enzo"){


  $max="170000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "TVR Speed 12"){


  $max="210000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "Mclaren F1"){


  $max="250000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








/////////////////////////////////////


if ($cars[$win] == "Bugatti Veyron"){


  $max="300000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }


/////////////////////////////////////


if ($cars[$win] == "Mercedes SLK Mclaren"){


  $max="330000";


  if ($damage == "0"){


  $for=$max;


  }elseif ($damage == "50"){


  $for = "0";


  }else{


$for = $max / $damage *2;


  }


  }








$for=round($for);


//print "$for!!";


mysqli_query( $connection, "INSERT INTO `garage` ( `id` , `owner` , `car` , `damage`,`origion`,`location`,`worth`) 


VALUES (


'', '$username', '$cars[$win]', '$damage','$info->location','$info->location','$for'


)");






$rankxp = rand(8,13);








mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+$rankxp WHERE username='$username'");


if($info->crew != '0'){


mysqli_query( $connection, "UPDATE crews SET xp=xp+$rankxp WHERE name='$info->crew'"); }
if($chek > '0'){


mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }







  }else{


  if ($radiobutton == "1"){


  $quote="<center>You failed and came back with sore feet!</center>";


}elseif ($radiobutton == "2"){


$quote="<center>You failed and came back with sore feet!</center>";


}elseif ($radiobutton == "3"){


$quote="<center>You failed and came back with sore feet!</center>";


}elseif ($radiobutton == "4"){


$quote="<center>You failed and came back with sore feet!</center>";


}elseif ($radiobutton == "5"){


$quote="<center>You failed and came back with sore feet!</center>";


}elseif ($radiobutton == "6"){


$quote="<center>You failed and came back with sore feet!</center>";


}

$new_rank = $info->rankpoints + rand(3,6);


mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET gtas=gtas+1 WHERE username='$username'");

$reason = "GTA";


require_once "incfiles/failed.php";


echo "$quote <br><center>You got away with nothing.</center>";











}


if($chance[0] == 1){$chance[1] = 1;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[0] = rand(1,$chance[0]);}


	elseif(($chance[0] >= 2) && ($chance[0] <= 10)){$chance[0] = rand(10,$chance[0]);}


	elseif(($chance[0] >= 5) && ($chance[0] <= 25)){$chance[0] = rand(25,$chance[0]);}


	elseif(($chance[0] >= 18) && ($chance[0] <= 36)){$chance[0] = rand(36,$chance[0]);}


	elseif(($chance[0] >= 25) && ($chance[0] <= 49)){$chance[0] = rand(49,$chance[0]);}


        elseif(($chance[0] >= 36) && ($chance[0] <= 58)){$chance[0] = rand(58,$chance[0]);}


        elseif(($chance[0] >= 49) && ($chance[0] <= 55)){$chance[0] = rand(55,$chance[0]);}


	elseif($chance[0] >= 55){$chance[0] = rand(55,$chance[0]);}


	





	if($chance[0] == 1){$chance[1] = 0;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[1] = rand(0,$chance[0]);}


	elseif(($chance[0] >= 3) && ($chance[0] <= 8)){$chance[1] = rand(7,$chance[0]);}


	elseif(($chance[0] >= 9) && ($chance[0] <= 15)){$chance[1] = rand(14,$chance[0]);}


	elseif(($chance[0] >= 16) && ($chance[0] <= 34)){$chance[1] = rand(33,$chance[0]);}


	elseif(($chance[0] >= 35) && ($chance[0] <= 74)){$chance[1] = rand(45,$chance[0]);}


	elseif($chance[0] >= 75){$chance[1] = rand(50,$chance[0]);}





	if($chance[0] == 1){$chance[2] = 0;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[2] = rand(0,$chance[0]);}


	elseif(($chance[0] >= 3) && ($chance[0] <= 8)){$chance[2] = rand(6,$chance[0]);}


	elseif(($chance[0] >= 9) && ($chance[0] <= 15)){$chance[2] = rand(13,$chance[0]);}


	elseif(($chance[0] >= 16) && ($chance[0] <= 34)){$chance[2] = rand(32,$chance[0]);}


	elseif(($chance[0] >= 35) && ($chance[0] <= 74)){$chance[2] = rand(60,$chance[0]);}


	elseif($chance[0] >= 75){$chance[2] = rand(85,$chance[0]);}





if($chance[0] == 1){$chance[3] = 0;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[3] = rand(0,$chance[0]);}


	elseif(($chance[0] >= 3) && ($chance[0] <= 8)){$chance[3] = rand(6,$chance[0]);}


	elseif(($chance[0] >= 9) && ($chance[0] <= 15)){$chance[3] = rand(13,$chance[0]);}


	elseif(($chance[0] >= 16) && ($chance[0] <= 34)){$chance[3] = rand(32,$chance[0]);}


	elseif(($chance[0] >= 35) && ($chance[0] <= 74)){$chance[3] = rand(60,$chance[0]);}


	elseif($chance[0] >= 75){$chance[3] = rand(85,$chance[0]);}





if($chance[0] == 1){$chance[4] = 0;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[4] = rand(0,$chance[0]);}


	elseif(($chance[0] >= 3) && ($chance[0] <= 8)){$chance[4] = rand(6,$chance[0]);}


	elseif(($chance[0] >= 9) && ($chance[0] <= 15)){$chance[4] = rand(13,$chance[0]);}


	elseif(($chance[0] >= 16) && ($chance[0] <= 34)){$chance[4] = rand(32,$chance[0]);}


	elseif(($chance[0] >= 35) && ($chance[0] <= 74)){$chance[4] = rand(60,$chance[0]);}


	elseif($chance[0] >= 75){$chance[4] = rand(85,$chance[0]);}





if($chance[0] == 1){$chance[5] = 0;}


	elseif(($chance[0] >= 1) && ($chance[0] <= 2)){$chance[5] = rand(0,$chance[0]);}


	elseif(($chance[0] >= 3) && ($chance[0] <= 8)){$chance[5] = rand(6,$chance[0]);}


	elseif(($chance[0] >= 9) && ($chance[0] <= 15)){$chance[5] = rand(13,$chance[0]);}


	elseif(($chance[0] >= 16) && ($chance[0] <= 34)){$chance[5] = rand(32,$chance[0]);}


	elseif(($chance[0] >= 35) && ($chance[0] <= 74)){$chance[5] = rand(60,$chance[0]);}


	elseif($chance[0] >= 75){$chance[5] = rand(85,$chance[0]);}





	


if($chance[0] > 50){


		$chance[0] = 40;


	}	


	if($chance[1] > 49){


		$chance[1] = 40;


	}	


	if($chance[2] > 48){


		$chance[2] = 40;


	}


                if($chance[3] > 48){


		$chance[3] = 40;


	}


                if($chance[4] > 48){


		$chance[4] = 40;


	}	


                if($chance[5] > 48){


		$chance[5] = 40;


	}








	





	


	$chance[0]++;


	if ($chance[0] > 50){


		$chance[0] = 40;


	}


$chance[1]++;


	if ($chance[1] > 50){


		$chance[1] = 40;


	}


$chance[2]++;


	if ($chance[2] > 50){


		$chance[2] = 40;


	}


$chance[3]++;


	if ($chance[3] > 50){


		$chance[3] = 40;


	}


$chance[4]++;


	if ($chance[4] > 50){


		$chance[4] = 40;


	}


$chance[5]++;


	if ($chance[5] > 50){


		$chance[5] = 40;


	}





$arrayrates = array($chance[0], $chance[1], $chance[2], $chance[3], $chance[4], $chance[5]);


	$newrates = implode("-", $arrayrates);


	$tim = time() + rand(55,90);


	mysqli_query( $connection, "UPDATE accounts SET gtachance='$newrates', lastgta='$tim'  WHERE username='$username'");

  if($info->steroids > '0'){
      mysqli_query( $connection, "UPDATE accounts SET lastgta='0' WHERE username='$username'");
      mysqli_query( $connection, "UPDATE accounts SET steroids=steroids-1 WHERE username='$username'");
  }

		exit;





}

$one1=100-$chance[0];


$one2=100-$chance[1];


$one3=100-$chance[2];


$one4=100-$chance[3];


$one5=100-$chance[4];


$one6=100-$chance[5];






?>




















<html>


<head>


<link rel="shortcut icon" href="favicon.ico.png">


<title>Thug Paradise 2 :: GTA</title>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link rel=stylesheet href=library/wtm.css type=text/css>
<link rel=stylesheet href=style.css type=text/css>

<script type="text/javascript" src="library/select.js"></script>

<style type="text/css">

td {

padding: 2px;
 }
</style>
</head>








 <body> 


<form name="form1" method="post" action="">

<input type="hidden" name="radiobutton" id="select" value="0">


<table width="595" height="229" align="center" cellpadding="0" cellspacing="0" class="table1px">





    <tr height="30" class="gradient2"> 
      <td colspan="5">Grand Theft Auto</tr>

     
<tr bordercolor="#666666" bgcolor="#666666">
  <td width="93" height="176" align="center" class="select" id="1" onclick="SelectOption(this.id);"><img src="images/gta/rmh.jpg"><br>
    Steal from rich house		<br>
    <img src="images/g.jpg" width="<?php echo "$chance[0]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one1"; ?>" height="13"><img src="images/m.jpg"></td>
  
  <td width="91" align="center" id="2" onclick="SelectOption(this.id);" class="select"><img src="images/gta/streets.jpg"><br>
    Steal from the streets			<br><img src="images/g.jpg" width="<?php echo "$chance[1]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one2"; ?>" height="13"><img src="images/m.jpg"></td>
  <td width="92" align="center" id="3" onclick="SelectOption(this.id);" class="select"><p><img src="images/gta/dealer.jpg"><br>
    Steal from Dealership<br><img src="images/g.jpg" width="<?php echo "$chance[2]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one3"; ?>" height="13"><img src="images/m.jpg"></p></td>
  <td width="98" align="center" id="4" onclick="SelectOption(this.id);" class="select"><img src="images/gta/show.jpg"><br>
    Steal from Showroom	<br>
    <img src="images/g.jpg" width="<?php echo "$chance[3]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one4"; ?>" height="13"><img src="images/m.jpg"></td>
  <td width="113" align="center" id="5" onclick="SelectOption(this.id);" class="select"><img src="images/gta/gar.jpg"><br>Break into a Garage		<br><img src="images/g.jpg" width="<?php echo "$chance[4]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one5"; ?>" height="13"><img src="images/m.jpg"></td>
  
</tr>
	        <tr bordercolor="#000000" bgcolor="#666666" >
        <td colspan="5" cellpadding="2"><div align="center"><input name="submit" type="submit" class="custombutton" id="submit" value="Commit GTA!"></div></td>
      </tr>
</table>
</form>
  <table align="center" width="500" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td>
      <td width="450" valign="middle" class="tableborder"><div align="center" class="style1">This page is the Grand Theft Auto. Here you can commit a "GTA" which is   where you try and rob a car from some unsuspecting person. When you   start your percentages are on 0 but the more practise you do the higher   the percentages go. You have to lay low for 2 minutes between each GTA   to avoid attention from the pigs. When you steal a car it may have been   damaged as you tried to get away. After you successfully steal a car it   goes into your garage. </div></td>
    </tr>
  </table>
<?php include_once"incfiles/foot.php"; ?>


</html>

