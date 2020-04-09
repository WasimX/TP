<?php

session_start();

include "incfiles/func.php";

logincheck();

$username=$_SESSION['username'];

include "incfiles/connectdb.php";

$date = gmdate('Y-m-d H:i:s');

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$fetch=mysqli_fetch_object($query);

$query2=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");

$fetch2=mysqli_fetch_object($query2);









?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Bullet Calculator - TP</title>



<link href="style.css" rel="stylesheet" type="text/css" />

<style type="text/css">

<!--

.style1 {color: #FFFFFF}

-->

</style>

<style>



.style3 {color: #000000}



.style4 {color: #FFFFFF; }



#dhtmltooltip{



position: absolute;



width: 250px;



border: 2px solid #333333;



padding: 5px;



background-color: #666666;



visibility: hidden;



z-index: 100;



text-align: center;



filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);



}



.cells {



	font-family: Verdana, Arial, Helvetica, sans-serif;



	font-size: 10px; 



	font-style: normal;



	background-color: #000000;



	border: 1px solid #333333;



	padding: 8px;


}



a:link, a:visited, a:active, a:hover {



	color: #33CCFF;



	font-weight: bold;



	text-decoration: bold;



}



.style1 {color: #FFFFFF;



	font-weight: bold;



}



.style8 {

	color: white;

	font-weight: bold;

}

</style>




<style>.style3{color:#000000}.style4{color:#FFFFFF;}.style5{font-size:18px}#dhtmltooltip{position:absolute;width:250px;border:2px solid #333333;padding:5px;background-color:#666666;visibility:hidden;z-index:100;text-align:center;filter:progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);}.cells{background-color:#000000;border:1px solid #CCCCCC;padding:8px;font-family:Verdana;font-size:10px;font-style:normal;}.style6{color:#0000FF}.style8{color:#0000FF;font-size:12px;}#bullet{position:absolute;width:200px;height:200px;top:0;left:0;}</style>
</head>
<a href="../creditsNew.php">Go Back!</a>
<form method='POST' name="form1" action=''>
<div align="center"><b><span class="style5">You currently have <?php echo "".makecomma($fetch->credits).""; ?> credits!</span><br></div><br>

<table width="43%" border="1" align="center" cellpadding="3" cellspacing="0" rules="none" class="table1px">

  <tr>

    <td width="100%" height="22" align="center" class="gradient">Bullet Calculator</td>

  </tr>

  <tr>

    <td align="center" class="tablebackground">

    <?php

	

	

if (strip_tags($_POST['Submit'])){

$vrank=strip_tags($_POST['rank']);

if ($fetch->credits < "3"){ echo "Sorry but you do not have enough credits.<br>"; }

elseif ($fetch->credits >= "3"){

$ranks=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE id='$vrank'"));

echo "<b>Killing a user ranked $ranks->rank you will need <b>".makecomma($ranks->jhp)." JHP</b> bullets, or <b>".makecomma($ranks->fmj)." FMJ</b> bullets.</b><br />

<br />

";

mysqli_query( $connection, "UPDATE accounts SET credits=credits-3 WHERE username='$username'");

}}

	 ?>

        Victim's Rank: <select name="rank" class="textbox">

               

              <?php $test = mysqli_query( $connection, "SELECT * FROM ranking");



while($man = mysqli_fetch_object($test)) {



echo" <option value=\"$man->id\">$man->rank</option> ";



}

?>

        </select>

<br /><br />This tool is used to tell you how many bullets it will take to kill a certain rank, at your capability. This does not includes the armour, or power of the gun you are using, therefore you must judge your shot carefully.<br /><br />The calculator shall tell you how many of each FMJ and JHP you need.<br /><br />

Each use of this bullet calculator costs you <b>3 credits</b>.<br />

<br />

        <input type="submit" class="custombutton" value="Reveal Amounts!" name='Submit' />



</td>

  </tr>

</table>
<div align="center"><br>
<span class="warning">Any bullets to kill lists found from this data will be removed from the game!</span></div>
</form>



</html>
    <?php include_once"incfiles/foot.php"; ?>
