<?php
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username = $_SESSION['username'];
logincheck();
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$date = gmdate('Y-m-d H:i:S');
$rank=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

?>
<link href="style.css" rel="stylesheet" type="text/css">
<div align="center">
  <p>
    <?php if($_GET['claim'] == "r1"){
if($rank->id < 3){
echo "<font color=#990000>Incomplete!</b></font>";
}elseif($rank->id >= 3){
if($fetch->r1 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$r1=$fetch->money+10000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$r1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET r1='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "r2"){
if($rank->id < 6){
echo "<font color=#990000>Incomplete!</b></font>";
}elseif($rank->id >= 6){
if($fetch->r2 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$r2=$fetch->money+25000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$r2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET r2='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "r3"){
 if($rank->id < 9){
echo "<font color=#990000>Incomplete!</b></font>";
}elseif($rank->id >= 9){
if($fetch->r3 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$r3=$fetch->money+50000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$r3' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET r3='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "r4"){
 if($rank->id < 12){
echo "<font color=#990000>Incomplete!</b></font>";
}elseif($rank->id >= 12){
if($fetch->r4 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$r4=$fetch->money+75000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$r4' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET r4='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "r5"){
 if($rank->id != 17){
echo "<font color=#990000>Incomplete!</b></font>";
}elseif($rank->id == 17){
if($fetch->r5 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$r5=$fetch->money+125000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$r5' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET r5='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "c1"){
if($fetch2->crimes < 300){
echo "You have not done 300 crimes yet!";
}else{
if($fetch->c1 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$c1=$fetch->money+25000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$c1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET c1='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "c2"){
if($fetch2->gtas < 300){
echo "You have not done 300 Grand Theft Auto's yet!";
}else{
if($fetch->c2 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$c2=$fetch->money+25000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$c2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET c2='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "c3"){
if($fetch2->crimes < 700){
echo "You have not done 700 crimes yet!";
}else{
if($fetch->c3 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$c3=$fetch->money+50000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$c3' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET c3='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "c4"){
if($fetch2->gtas < 700){
echo "You have not done 700 Grand Theft Auto's yet!";
}else{
if($fetch->c4 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$c4=$fetch->money+50000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$c4' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET c4='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "c5"){
if($fetch2->crimes < 1500){
echo "You have not done 1,500 crimes yet!";
}else{
if($fetch->c5 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$c5=$fetch->money+100000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$c5' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET c5='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "j1"){
if($fetch2->busts < 500){
echo "You have not done 500 jail busts yet!";
}else{
if($fetch->j1 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$j1=$fetch->money+30000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$j1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET j1='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "j2"){
if($fetch2->busts < 2500){
echo "You have not done 2,500 jail busts yet!";
}else{
if($fetch->j2 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$j2=$fetch->money+125000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$j2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET j2='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "j3"){
if($fetch2->busts < 5000){
echo "You have not done 5,000 jail busts yet!";
}else{
if($fetch->j3 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$j3=$fetch->money+250000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$j3' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET j3='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "j4"){
if($fetch2->busts < 10000){
echo "You have not done 10,000 jail busts yet!";
}else{
if($fetch->j4 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$j4=$fetch->money+500000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$j4' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET j4='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "j5"){
if($fetch2->busts < 15000){
echo "You have not done 15,000 jail busts yet!";
}else{
if($fetch->j5 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$j5=$fetch->money+750000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$j5' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET j5='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "k1"){
if($fetch2->kill_skill < 1){
echo "You have not done 1 kill yet!";
}else{
if($fetch->k1 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$k1=$fetch->jhp+5000; 

mysqli_query( $connection, "UPDATE accounts SET jhp='$k1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET k1='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "k2"){
if($fetch2->kill_skill < 1){
echo "You have not done 5 kills yet!";
}else{
if($fetch->k2 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$k2=$fetch->jhp+25000; 

mysqli_query( $connection, "UPDATE accounts SET jhp='$k2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET k2='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "k3"){
if($fetch2->kill_skill < 10){
echo "You have not done 10 kills yet!";
}else{
if($fetch->k3 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$k3=$fetch->jhp+50000; 

mysqli_query( $connection, "UPDATE accounts SET jhp='$k3' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET k3='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "k4"){
if($fetch2->kill_skill < 50){
echo "You have not done 50 kills yet!";
}else{
if($fetch->k4 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$k4=$fetch->jhp+250000; 

mysqli_query( $connection, "UPDATE accounts SET jhp='$k4' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET k4='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}

 if($_GET['claim'] == "k5"){
if($fetch2->kill_skill < 100){
echo "You have not done 100 kills yet!";
}else{
if($fetch->k5 == '0'){
echo "<font color=white><b>You have already claimed this reward!</b></font>";
}else{
$k5=$fetch->fmj+500000; 

mysqli_query( $connection, "UPDATE accounts SET fmj='$k5' WHERE username='$username'");
$k6=$fetch->money+150000000; 

mysqli_query( $connection, "UPDATE accounts SET money='$k6' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET k5='0' WHERE username='$username'");
echo "<font color=white><b>Congratulations $username. Your reward has been added to your account.</b></font>";
}}}?>
  </p>
</div>
