<?php
//error_reporting(0);

$mysqli_server = "localhost";
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_database = "3109234_thug";
 
/*
$connection = mysqli_connect($mysqli_server","$mysqli_user","$mysqli_password) 
	or die ("Unable to connect to MySQL server.");
$db = mysqli_select_db("$mysqli_database") or die ("Unable to select requested database.");
*/


$message = ""; //error message

$connection = mysqli_connect( $mysqli_server,$mysqli_user,$mysqli_password );
if ( !$connection ) {
	die( "Unable to connect to MySQL server." . mysqli_error( $connection ) );
}
$db = mysqli_select_db( $connection, $mysqli_database );
if ( !$db ) {
	die( "Unable to select requested database." . mysqli_error( $connection ) );
}

ini_set("short_open_tag", 1);

?>


