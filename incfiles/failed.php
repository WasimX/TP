<link href="style.css" rel="stylesheet" type="text/css" />
<?php
session_start();
$username=$_SESSION['username'];
include_once "connectdb.php";
include_once "func.php";
logincheck();


$fetch_info=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));





if(rand(1,30) > "15" && $fetch->steroids <= "0" && $fetch->userlevel != "4"){



if ($reason == "crime"){

$length=rand(30,60) + time();

$quote = "Crime";

}elseif ($reason == "Rob"){

$length=rand(30,60) + time();

$quote = "Robbing";

}elseif ($reason == "CompCrime"){

$length=rand(30,60) + time();

$quote = "Computer Crime";

}elseif ($reason ==  "GTA"){

$length=rand(60,120) + time();

$quote="Gta";

}elseif ($reason == "Jail busting"){

$length=rand(3,10) + time();

$quote="Jail busting";

}elseif ($reason == "Food crime"){

$length=rand(120,140) + time();

$quote="Food crime";

}elseif ($reason == "Chase"){

$length=rand(120,140) + time();

$quote="Police Chase";

}elseif ($reason == "Drug Smuggling"){

$length=rand(120,140) + time();

$quote="Drug Smuggling";

}





if ($reason == ""){

exit();

}









		$crimes = mysqli_query( $connection, "SELECT location FROM accounts WHERE username='$username'");

$check = mysqli_fetch_object($crimes);



mysqli_query( $connection, "INSERT INTO `jail` (`id`,`username`, `time_left`, `breward`) VALUES ('', '$username', '$length', '$fetch->breward');") or die (mysqli_error());



		 if ($reason == "Jail busting"){

echo "  <p><center><font color=white>You got caught jail busting your in jail for ".maketime($length)."</font></center></p>
  <p><center></center> </p>";

}else{

		 echo "<br />
  <center><img src='../images/crimes/busted.jpg'></center>
</div>
";

		 exit();

	}}


?>