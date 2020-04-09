<?php
session_start();
require("incfiles/connectdb.php");

$que = mysqli_query( $connection, "SELECT * FROM `accounts` WHERE `username` = '$username' LIMIT 1")or die(mysqli_error());

$arr = mysqli_fetch_array($que);
$last_script_check = $arr['last_script_check'];

if ($last_script_check <= time()){

$submit = strip_tags($_POST['submit']);
$number = strip_tags($_POST['number']);
$newtime = time() + rand(600,900);

if ($submit){

if (md5($number) != $_SESSION['image_random_value']){

echo "<br><center><b><font color=red>Incorrect script number!</font><b></center><br>";

}elseif (md5($number) == $_SESSION['image_random_value']){

mysqli_query( $connection, "UPDATE `accounts` SET `last_script_check` = '$newtime' WHERE `username` = '$username' LIMIT 1")or die(mysqli_error());

echo "";

print ("<SCRIPT LANGUAGE='JavaScript'>

content=1;history.go(-1)

</script>'>");



}



}







?>


<html>



<head>



<link rel="stylesheet" type="text/css" href="style.css" />



<title>Thug Paradise :: Scriptcheck</title>



</head>



<body>



			<form method="post">
			<table width="300" align="center" cellspacing="0" class="table1px">
			<tr class="gradient">
			<td>Script Check</td>
			</tr>
			<tr>

				<td align="center"><font color=white><img src="img.php"></font></td>
			</tr>
			<tr>
				<td align="center"><input type="text" name="number" class="textbox"></td>
			</tr>
			<tr>
				<td align="center"><input name='submit' class="custombutton" type='submit' id='submit' value='Submit'></td>
			</tr>
			</table>

			</form>



</body>



</html>



<?php exit; } ?>