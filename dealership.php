<?php

session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

include_once"incfiles/alt.php";

logincheck();

$username=$_SESSION['username'];



$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");

$fetch=mysqli_fetch_object($query);



$location=$fetch->location;

$buycar = strip_tags($_POST['op']);


if ($buycar == "0"){

echo "Error"; die(); } 

if ($buycar > "13"){

echo "Error";

}elseif ($buycar <= "13"){





if ($buycar == "1"){

$worth="5000";

$price="10000";

$car="Renault Clio Sport";

}elseif ($buycar == "2"){

$worth="6000";

$price="12000";

$car="Audi A3";

}elseif ($buycar == "3"){

$worth="15000";

$price="30000";

$car="BMW M3";

}elseif ($buycar == "4"){

$worth="30000";

$price="60000";

$car="Cadilac Escelade";

}elseif ($buycar == "5"){

$worth="40000";

$price="80000";

$car="Nissan Skyline";

}elseif ($buycar == "6"){

$worth="55000";

$price="110000";

$car="Porsche 911";

}elseif ($buycar == "7"){

$worth="80000";

$price="160000";

$car="GT 40";

}elseif ($buycar == "8"){

$worth="110000";

$price="220000";

$car="Lamborghini Murcielago";

}elseif ($buycar == "9"){

$worth="170000";

$price="340000";

$car="Ferrari Enzo";

}elseif ($buycar == "10"){

$worth="210000";

$price="420000";

$car="TVR Speed 12";

}elseif ($buycar == "11"){

$worth="250000";

$price="500000";

$car="Mclaren F1";

}elseif ($buycar == "12"){

$worth="500000";

$price="1000000";

$car="Bugatti Veyron";

}elseif ($buycar == "13"){

$worth="1000000";

$price="2000000";

$car="Mercedes SLK Mclaren";

}



if ($price > $fetch->money){

echo "You do not have enough money!<br>";

}elseif ($price <= $fetch->money && $buycar != ""){



$newmoney=$fetch->money-$price;



mysqli_query( $connection, "UPDATE accounts SET money='$newmoney' WHERE username='$username'");

mysqli_query( $connection, "INSERT INTO `garage` ( `id` , `owner` , `car` , `damage`,`origion`,`location`,`worth`)

VALUES (

'', '$username', '$car', '0','$fetch->location','$fetch->location','$worth'

)");



echo "You successfully bought a $car <br>";

}}





?>



<html>

<head>

<link rel="shortcut icon" href="favicon.ico.png">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel=stylesheet href=style.css type=text/css>
<link rel=stylesheet href=library/wtm.css type=text/css>

<script type="text/javascript" src="library/select.js"></script>

<style type="text/css">

td {

padding: 2px;

</style>



</head>



<body>

<form action="" name="" method="post">

<input type="hidden" name="op" id="select" value="0">

<table width="40%" align="center" border="0" cellpadding="0" cellspacing="0" class="table1px">



<tr class="gradient">

  

<td colspan=2>

      Car Dealership</td>

    </tr>

<tr>

  

<td class=gradient>

      Car</td>

<td class=gradient>

      Cost</td>

    </tr>





<tr class="select" id="1" onClick="SelectOption(this.id);" align="center">

<td>Renault Clio Sport</td>

<td>&pound;10,000</td>

</tr>

<tr class="select" id="2" onClick="SelectOption(this.id);" align="center">

<td>Audi A3</td>

<td>&pound;12,000</td>

</tr>

<tr class="select" id="3" onClick="SelectOption(this.id);" align="center">

<td>BMW M3</td>

<td>&pound;30,000</td>

</tr>

<tr class="select" id="4" onClick="SelectOption(this.id);" align="center">

<td>Cadilac Escelade</td>

<td>&pound;60,000</td>

</tr>

<tr class="select" id="5" onClick="SelectOption(this.id);" align="center">

<td>Nissan Skyline</td>

<td>&pound;80,000</td>

</tr>

<tr class="select" id="6" onClick="SelectOption(this.id);" align="center">

<td>Porsche 911</td>

<td>&pound;110,000</td>

</tr>

<tr class="select" id="7" onClick="SelectOption(this.id);" align="center">

<td>GT 40</td>

<td>&pound;160,000</td>

</tr>

<tr class="select" id="8" onClick="SelectOption(this.id);" align="center">

<td>Lamborghini Murcielago</td>

<td>&pound;220,000</td>

</tr>

<tr class="select" id="9" onClick="SelectOption(this.id);" align="center">

<td>Ferrari Enzo</td>

<td>&pound;340,000</td>

</tr>

<tr class="select" id="10" onClick="SelectOption(this.id);" align="center">

<td>TVR Speed 12</td>

<td>&pound;420,000</td>

</tr>

<tr class="select" id="11" onClick="SelectOption(this.id);" align="center">

<td>McLaren F1</td>

<td>&pound;500,000</td>

</tr>

<tr class="select" id="12" onClick="SelectOption(this.id);" align="center">

<td>Bugatti Veyron</td>

<td>&pound;1,000,000</td>

</tr>

<tr class="select" id="13" onClick="SelectOption(this.id);" align="center">

<td>Mercedes SLK Mclaren</td>

<td>&pound;2,000,000</td>

</tr>



<tr>

<td colspan=2 align=center>

<input type="submit" name="car_button" id="car_button" class=custombutton value="Buy Car!"></td></tr></table></form>

</body>

</html>

<?php include_once"incfiles/foot.php"; ?>

