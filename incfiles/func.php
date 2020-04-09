<?php
//session_start();
include_once "connectdb.php";
$username = $_SESSION[ 'username' ];
$query = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1" );
$info = mysqli_fetch_object( $query );
$fetching = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1" );
$fetch = mysqli_fetch_object( $fetching );
$timenow = time();
$date = gmdate( 'Y-m-d H:i:s' );

//error_reporting(0);


if ( $info->status == "Dead" ) {
	session_destroy();
	include "dead.php";
	exit();
}

if ( $info->status == "Banned" ) {
	session_destroy();
	header( "Location: user_banned.php" );
	exit();
}

function logincheck() {
	if ( empty( $_SESSION[ 'username' ] ) ) {
		echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='error.php';
</script>";
		exit();
	}
}


$time = time() + ( 60 * 10 );
mysqli_query( $connection, "UPDATE accounts SET online='$time' WHERE username='$username'" );


function makecomma( $input ) {
	if ( strlen( $input ) <= 3 ) {
		return $input;
	}
	$length = substr( $input, 0, strlen( $input ) - 3 );
	$formatted_input = makecomma( $length ) . "," . substr( $input, -3 );
	return $formatted_input;
}



function maketime( $last ) {
	$timenow = time();
	if ( $last > $timenow ) {
		$order = $last - $timenow;
		while ( $order >= 60 ) {
			$order = $order - 60;
			$ordermleft++;
		}
		while ( $ordermleft >= 60 ) {
			$ordermleft = $ordermleft - 60;
			$orderhleft++;
		}
		if ( $ordermleft == 0 ) {
			$ordermleft = "";
		} else {
			$ordermleft = "$ordermleft minutes";
		}
		if ( $orderhleft == 0 ) {
			$orderhleft = "";
		} else {
			$orderhleft = "$orderhleft hours";
		}
		return "$orderhleft $ordermleft $order seconds";
	}
}

$shouse = mysqli_query( $connection, "SELECT safehouse FROM accounts WHERE safehouse='1'" );
$housed = mysqli_num_rows( $shouse );

if ( $shouse->num_rows > 0 ) {
	while ( $s = mysqli_fetch_object( $shouse ) ) {
		if ( $s->safehours < $timenow ) {
			mysqli_query( $connection, "UPDATE accounts SET safehours='0', safehouse='0', safetime='' WHERE username='$s->username'" );
		}
	}
}

function lang( $text ) {
	$smallwordsarray = array( 'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'if', 'then', 'else', 'when', 'at', 'from', 'by', 'on', 'off', 'for', 'in', 'out', 'over', 'to', 'into', 'with' );
	$words = explode( ' ', $text );
	foreach ( $words as $key => $word ) {
		if ( $key == 0 or!in_array( $word, $smallwordsarray ) )$words[ $key ] = ucwords( strtolower( $word ) );
	}
	$text = implode( ' ', $words );
	return $text;
}




$bging = mysqli_query( $connection, "SELECT * FROM accounts WHERE protection1!='0'" );

$bfetch = mysqli_fetch_object( $bging );

$bgs = mysqli_num_rows( $bging );

$bgf = mysqli_fetch_object( mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$bfetch->protectedBy1'" ) );

if ( $bgs > "0" ) {

	if ( $bfetch->ptime < time() ) {
		$pay = $bgf->ppayment;

		if ( $bfetch->money >= $pay ) {
			$timee = time() + ( 3600 * 24 );
			$moneyp = $bfetch->money - $pay;
			$moneybg = $bgf->money + $pay;
			mysqli_query( $connection, "UPDATE accounts SET money='$moneyp', ptime='$timee' WHERE username='$bfetch->username'" );
			mysqli_query( $connection, "UPDATE accounts SET money='$moneybg' WHERE username='$bfetch->protectiony1'" );

			mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->username', '$bfetch->username', 'Bodyguard Payed', '<b>$bfetch->protectedBy1</b> has been payed for protecting you!', '$date', '0')" );

			mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->protection1', '$bfetch->protection1', 'Payed', 'You have been payed for protecting <b>$bfetch->username</b>!', '$date', '0')" );
		} elseif ( $bfetch->money < $pay ) {
			mysqli_query( $connection, "UPDATE accounts SET protecting1='0', ppayment='0', pstime='0' WHERE username='$bfetch->protectedBy1'" );
			mysqli_query( $connection, "UPDATE accounts SET protection1='0', ptime='0' WHERE username='$bfetch->username'" );

			mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->username', '$bfetch->username', 'Bodyguard Fired!', '<b>$bfetch->protectedBy1</b> has been fired because your too poor!', '$date', '0')" );

			mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`)


VALUES ('', '$bfetch->protection1', '$bfetch->protection1', 'Sacked!', 'You have been sacked because your employer couldn\'t afford the wage!', '$date', '0')" );
		}
	}
}


$ip = $_SERVER[ 'REMOTE_ADDR' ];
$getip = mysqli_query( $connection, "SELECT * FROM `adminbans` WHERE `ip` = '$ip'" );

if ( mysqli_num_rows( $getip ) > 0 ) {
	die( "You are banned from Thug Paradise!" );
}







?>

</body>
</html>