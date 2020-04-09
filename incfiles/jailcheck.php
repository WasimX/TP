<?php
session_start();
include_once "connectdb.php";
include_once "func.php";
logincheck();
$username=$_SESSION['username'];

$check = mysqli_query( $connection, "SELECT * FROM jail WHERE username='$username'");
$checkifjailed = mysqli_num_rows($check);
if ($checkifjailed > '0'){

echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='jail.php';
</script>";

}
?>








