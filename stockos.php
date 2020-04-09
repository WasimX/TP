<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$money=$fetch->money;


?>



<html>
<head>
<title>Stock Market :: TP</title></head>
    	<link REL="stylesheet" TYPE="text/css" HREF="style.css">


<body>
<center> 
 <table border="0" cellspacing="0" cellpadding="0" align="center" width="95%" class="table1pxx">

	<TR>	  
    <td width="100%" valign="top">	<br>	

<?php $sql="SELECT * FROM stocksm WHERE type='Gold'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price = $rows['price'];
$type = $rows['type'];	 
$timer = $rows['timer'];
$timeleft = $timer - time();

}
$sql="SELECT * FROM stocksm WHERE type='Oil'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price1 = $rows['price'];
$type1 = $rows['type'];	 
}
$sql="SELECT * FROM stocksm WHERE type='Gas'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price2 = $rows['price'];
$type2 = $rows['type'];	 
}
$sql="SELECT * FROM stocksm WHERE type='LLoyds'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price3 = $rows['price'];
$type3 = $rows['type'];	 
}
$sql="SELECT * FROM stocksm WHERE type='Walmart'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price4 = $rows['price'];
$type4 = $rows['type'];	 
}
$sql="SELECT * FROM stocksm WHERE type='Microsoft'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$price5 = $rows['price'];
$type5 = $rows['type'];	 
}

$sql="SELECT * from accounts WHERE username='$username'";
$result=mysqli_query( $connection, $sql);

while($rows=mysqli_fetch_array($result)){ // Start looping table row 

$currentk = $rows['Gold'];
$currentk1 = $rows['Oil'];
$currentk2 = $rows['Gas'];
$currentk3 = $rows['LLoyds'];
$currentk4 = $rows['Walmart'];
$currentk5 = $rows['Microsoft'];
$pricepaid = $rows['goldprice'];
$pricepaid1 = $rows['crudeprice'];
$pricepaid2 = $rows['gasprice'];
$pricepaid3 = $rows['lloydsprice'];
$pricepaid4 = $rows['walprice'];
$pricepaid5 = $rows['microprice'];
$stockprofit = $rows['stockprofit'];

$maxk = 5000;
$maxkk = number_format($maxk);
}
$total = $currentk + $currentk1 + $currentk2 + $currentk3 + $currentk4 + $currentk5 ;

$timedel = time()+ (3600 * 1);
$timecheck = time();
mysqli_query( $connection, "UPDATE stocksm SET timer='$timedel' WHERE timer <='$timecheck'");

$chance = rand(1,50);
$sum = rand(50000,100000);
$newpriceup = $price + $sum;
$newpricedown = $price - $sum;
$random = rand(900000,1500000);
if ($newpricedown < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='Gold'");
}elseif ($chance > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup' WHERE type ='Gold'");
}else if ($chance < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown' WHERE type ='Gold'");
}
$chance1 = rand(1,50);
$sum1 = rand(50000,100000);
$newpriceup1 = $price1 + $sum1;
$newpricedown1 = $price1 - $sum1;
$random = rand(900000,1500000);
if ($newpricedown1 < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='Oil'");
}elseif ($chance1 > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup1' WHERE type ='Oil'");
}else if ($chance1 < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown1' WHERE type ='Oil'");
}
$chance2 = rand(1,50);
$sum2 = rand(50000,100000);
$newpriceup2 = $price2 + $sum2;
$newpricedown2 = $price2 - $sum2;
$random = rand(900000,1500000);
if ($newpricedown2 < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='Gas'");
}elseif ($chance2 > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup2' WHERE type ='Gas'");
}else if ($chance2 < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown2' WHERE type ='Gas'");
}
$chance3 = rand(1,50);
$sum3 = rand(50000,100000);
$newpriceup3 = $price3 + $sum3;
$newpricedown3 = $price3 - $sum3;
$random = rand(900000,1500000);
if ($newpricedown3 < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='LLoyds'");
}elseif ($chance3 > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup3' WHERE type ='LLoyds'");
}else if ($chance3 < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown3' WHERE type ='LLoyds'");
}
$chance4 = rand(1,50);
$sum4 = rand(50000,100000);
$newpriceup4 = $price4 + $sum4;
$newpricedown4 = $price4 - $sum4;
$random = rand(900000,1500000);
if ($newpricedown4 < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='Walmart'");
}elseif ($chance4 > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup4' WHERE type ='Walmart'");
}else if ($chance2 < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown4' WHERE type ='Walmart'");
}
$chance5 = rand(1,50);
$sum5 = rand(50000,100000);
$newpriceup5 = $price5 + $sum5;
$newpricedown5 = $price5 - $sum5;
$random = rand(900000,1500000);
if ($newpricedown5 < 1){
mysqli_query( $connection, "UPDATE stocksm SET price='$random' WHERE type ='Microsoft'");
}elseif ($chance5 > 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpriceup5' WHERE type ='Microsoft'");
}else if ($chance5 < 25 && $timer <= $timecheck){
mysqli_query( $connection, "UPDATE stocksm SET price='$newpricedown5' WHERE type ='Microsoft'");
}

if ($_POST['buyGold']){

$buyGold = $_POST['buyGold'];
$buyGold = strip_tags($buyGold);
$Goldstock = $_POST['Gold'];
$Goldstock = strip_tags($Goldstock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $Goldstock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($Goldstock == 0 || !$Goldstock || ereg('[^0-9]',$Goldstock)){
print "You can not buy that amount!";
    
}else{

$costs = $Goldstock * $price;

$newmoney = $money - $costs;
$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Gold=Gold+'$Goldstock', goldprice='$price' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $Goldstock stocks of gold for $pricek!', '$date', '$realip')");
echo "You bought <b>$Goldstock</b> shares of Gold!";

}}}}}

if ($_POST['sellGold']){

$sellGold = $_POST['sellGold'];
$sellGold = strip_tags($sellGold);
$Goldstock = $_POST['Gold'];
$Goldstock = strip_tags($Goldstock);



$total = $currentk - $Goldstock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($Goldstock == 0 || !$Goldstock || ereg('[^0-9]',$Goldstock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $Goldstock * $price;
$newmoney = $money + $sellfor;
$sellfork = number_format($sellfor);
$newamount = $currentk - $Goldstock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Gold='$newamount', goldprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $Goldstock stocks of gold for $sellfork!', '$date', '$realip')");
echo "You sold your <b>$Goldstock</b> shares of Gold for $sellfork!";
}}}

if ($_POST['buycrude']){

$buycrude = $_POST['buycrude'];
$buycrude = strip_tags($buycrude);
$crudestock = $_POST['crude'];
$crudestock = strip_tags($crudestock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $crudestock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($crudestock == 0 || !$crudestock || ereg('[^0-9]',$crudestock)){
print "You can not buy that amount!";
    
}else{

$costs = $crudestock * $price1;

$newmoney = $money - $costs;
$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Oil=Oil+'$crudestock', crudeprice='$price1' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $crudestock stocks of oil for $pricek!', '$date', '$realip')");
echo "You bought <b>$crudestock</b> shares of oil!";

}}}}}

if ($_POST['sellcrude']){

$sellcrude = $_POST['sellcrude'];
$sellcrude = strip_tags($sellcrude);
$crudestock = $_POST['crude'];
$crudestock = strip_tags($crudestock);



$total = $currentk1 - $crudestock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($crudestock == 0 || !$crudestock || ereg('[^0-9]',$crudestock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $crudestock * $price1;
$newmoney = $money + $sellfor;
$sellfork1 = number_format($sellfor);
$newamount = $currentk1 - $crudestock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Oil='$newamount', crudeprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $crudestock stocks of oil for $sellfork1!', '$date', '$realip')");
echo "You sold your <b>$crudestock</b> shares of oil for $sellfork1!";
}}}

if ($_POST['buygas']){

$buygas = $_POST['buygas'];
$buygas = strip_tags($buygas);
$gasstock = $_POST['gas'];
$gasstock = strip_tags($gasstock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $gasstock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($gasstock == 0 || !$gasstock || ereg('[^0-9]',$gasstock)){
print "You can not buy that amount!";
    
}else{

$costs = $gasstock * $price2;

$newmoney = $money - $costs;
$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Gas=Gas+'$gasstock', gasprice='$price2' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $gasstock stocks of gas for $pricek!', '$date', '$realip')");
echo "You bought <b>$gasstock</b> shares of gas!";

}}}}}

if ($_POST['sellgas']){

$sellgas = $_POST['sellgas'];
$sellgas = strip_tags($sellgas);
$gasstock = $_POST['gas'];
$gasstock = strip_tags($gasstock);



$total = $currentk2 - $gasstock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($gasstock == 0 || !$gasstock || ereg('[^0-9]',$gasstock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $gasstock * $price2;
$newmoney = $money + $sellfor;
$sellfork1 = number_format($sellfor);
$newamount = $currentk2 - $gasstock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Gas='$newamount', gasprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $gasstock stocks of gas for $sellfork1!', '$date', '$realip')");
echo "You sold your <b>$gasstock</b> shares of gas for $sellfork1!";
}}}

if ($_POST['buylloyds']){

$buylloyds = $_POST['buylloyds'];
$buylloyds = strip_tags($buylloyds);
$lloydsstock = $_POST['lloyds'];
$lloydsstock = strip_tags($lloydsstock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $lloydsstock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($lloydsstock == 0 || !$lloydsstock || ereg('[^0-9]',$lloydsstock)){
print "You can not buy that amount!";
    
}else{

$costs = $lloydsstock * $price3;

$newmoney = $money - $costs;
$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', LLoyds=LLoyds+'$lloydsstock', lloydsprice='$price3' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $lloydsstock stocks of lloyds for $pricek!', '$date', '$realip')");
echo "You bought <b>$lloydsstock</b> shares of lloyds!";

}}}}}

if ($_POST['selllloyds']){

$selllloyds = $_POST['selllloyds'];
$selllloyds = strip_tags($selllloyds);
$lloydsstock = $_POST['lloyds'];
$lloydsstock = strip_tags($lloydsstock);



$total = $currentk3 - $lloydsstock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($lloydsstock == 0 || !$lloydsstock || ereg('[^0-9]',$lloydsstock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $lloydsstock * $price3;
$newmoney = $money + $sellfor;
$sellfork1 = number_format($sellfor);
$newamount = $currentk3 - $lloydsstock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', LLoyds='$newamount', lloydsprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $lloydsstock stocks of lloyds for $sellfork1!', '$date', '$realip')");
echo "You sold your <b>$lloydsstock</b> shares of lloyds for $sellfork1!";
}}}


if ($_POST['buywal']){

$buywal = $_POST['buywal'];
$buywal = strip_tags($buywal);
$walstock = $_POST['wal'];
$walstock = strip_tags($walstock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $walstock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($walstock == 0 || !$walstock || ereg('[^0-9]',$walstock)){
print "You can not buy that amount!";
    
}else{

$costs = $walstock * $price4;

$newmoney = $money - $costs;

$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Walmart=Walmart+'$walstock', walprice='$price4' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $walstock stocks of walmart for $pricek!', '$date', '$realip')");
echo "You bought <b>$walstock</b> shares of Walmart!";

}}}}}


if ($_POST['sellwal']){

$sellwal= $_POST['sellwal'];
$sellwal = strip_tags($sellwal);
$walstock = $_POST['wal'];
$walstock = strip_tags($walstock);



$total = $currentk4 - $walstock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($walstock == 0 || !$walstock || ereg('[^0-9]',$walstock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $walstock * $price4;
$newmoney = $money + $sellfor;
$sellfork1 = number_format($sellfor);
$newamount = $currentk4 - $walstock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Walmart='$newamount', walprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $walstock stocks of walmart for $sellfork1!', '$date', '$realip')");
echo "You sold your <b>$walstock</b> shares of Walmart for $sellfork1!";
}}}

if ($_POST['buymicro']){

$buymicro = $_POST['buymicro'];
$buymicro = strip_tags($buywal);
$microstock = $_POST['micro'];
$microstock = strip_tags($microstock);

if ($total >= $maxk) {
echo "You can not buy anymore stock!";
}else{

$total = $total + $microstock;
if ($total > $maxk){

echo "You can only buy a max of $maxkk stocks altogether!";
}else{

if ($microstock == 0 || !$microstock || ereg('[^0-9]',$microstock)){
print "You can not buy that amount!";
    
}else{

$costs = $microstock * $price5;

$newmoney = $money - $costs;
$pricek = number_format($costs);
if ($newmoney < 0){

echo "You do not have enough to buy this!";
}else{


mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Microsoft=Microsoft+'$microstock', microprice='$price5' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`-'$costs' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Bought $microstock stocks of microsoft for $pricek!', '$date', '$realip')");
echo "You bought <b>$microstock</b> shares of Microsoft!";

}}}}}

if ($_POST['sellmicro']){

$sellmicro = $_POST['sellmicro'];
$sellmicro = strip_tags($sellmicro);
$microstock = $_POST['micro'];
$microstock = strip_tags($microstock);


$total = $currentk5 - $microstock;
if ($total < 0){

echo "You dont have that much stock!";
}else{

if ($microstock == 0 || !$microstock || ereg('[^0-9]',$microstock)){
print "You can not sell that amount!";
	
}else{

$sellfor = $microstock * $price5;
$newmoney = $money + $sellfor;
$sellfork1 = number_format($sellfor);
$newamount = $currentk5 - $microstock;

mysqli_query( $connection, "UPDATE accounts SET money='$newmoney', Microsoft='$newamount', microprice='0' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET `stockprofit`=`stockprofit`+'$sellfor' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `logs` ( `id` , `who` , `action` , `date` , `ip` ) VALUES ('', '$username', 'Sold $microstock stocks of microsoft for $sellfork1!', '$date', '$realip')");
echo "You sold your <b>$microstock</b> shares of Microsoft for $sellfork1!";
}}}
?>
<form action="StockMarket.php" method="post">
<table border="0" cellspacing="0" cellpadding="2" bordercolor="black" align="center" width="88%" class="table1px">
<tr>
<td class="gradient" colspan="7" align="center">Stock Market</td>
</tr>
<tr>
<td class="table1px" align="center" colspan="3"><b>Price Updates In <font color=red><?php echo maketime($timer); ?></font></b></td><td class="table1px" align="center" colspan="4"><b>The max stocks you can buy altogether is 5,000</b></td></tr>
<tr>
<td align="center" colspan="1"><b>Sellers</b></td><td align="center" colspan="1"><b>Price</b></td><td align="center" colspan="1"><b>Price Paid</b></td><td align="center" colspan="1"><b>Your stocks</b></td><td align="center" colspan="1"><b>Amount</b></td><td align="center" colspan="1"><b>&nbsp;</b></td><td align="center" colspan="1"><b>&nbsp;</b></td>
</tr>
<td align="center" colspan="1"><b><?php echo $type; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price); ?></td><td align="center" colspan="1"><?php if ($pricepaid < $price){ ?><font color=lime>$<?php echo number_format($pricepaid); ?></font> <?php }elseif ($pricepaid >= $price){ ?><font color=red>$<?php echo number_format($pricepaid);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" id="Gold" name="Gold"></td><td align="center" colspan="1"><input type="submit" name="buyGold" id="buyGold" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=sellGold class=custombutton value=Sell!></td></tr>
<td align="center" colspan="1"><b><?php echo $type1; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price1); ?></td><td align="center" colspan="1"><?php if ($pricepaid1 < $price1){ ?><font color=lime>$<?php echo number_format($pricepaid1); ?></font> <?php }elseif ($pricepaid1 >= $price1){ ?><font color=red>$<?php echo number_format($pricepaid1);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk1); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" name="crude"></td><td align="center" colspan="1"><input type="submit" name="buycrude" id="buycrude" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=sellcrude class=custombutton value=Sell!></td></tr>
<td align="center" colspan="1"><b><?php echo $type2; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price2); ?></td><td align="center" colspan="1"><?php if ($pricepaid2 < $price2){ ?><font color=lime>$<?php echo number_format($pricepaid2); ?></font> <?php }elseif ($pricepaid2 >= $price2){ ?><font color=red>$<?php echo number_format($pricepaid2);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk2); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" name="gas"></td><td align="center" colspan="1"><input type="submit" name="buygas" id="buygas" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=sellgas class=custombutton value=Sell!></td></tr>
<td align="center" colspan="1"><b><?php echo $type3; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price3); ?></td><td align="center" colspan="1"><?php if ($pricepaid3 < $price3){ ?><font color=lime>$<?php echo number_format($pricepaid3); ?></font> <?php }elseif ($pricepaid3 >= $price3){ ?><font color=red>$<?php echo number_format($pricepaid3);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk3); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" name="lloyds"></td><td align="center" colspan="1"><input type="submit" name="buylloyds" id="buylloyds" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=selllloyds class=custombutton value=Sell!></td></tr>
<td align="center" colspan="1"><b><?php echo $type4; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price4); ?></td><td align="center" colspan="1"><?php if ($pricepaid4 < $price4){ ?><font color=lime>$<?php echo number_format($pricepaid4); ?></font> <?php }elseif ($pricepaid4 >= $price4){ ?><font color=red>$<?php echo number_format($pricepaid4);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk4); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" name="wal"></td><td align="center" colspan="1"><input type="submit" name="buywal" id="buywal" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=sellwal class=custombutton value=Sell!></td></tr>
<td align="center" colspan="1"><b><?php echo $type5; ?></b></td><td align="center" colspan="1">$<?php echo number_format($price5); ?></td><td align="center" colspan="1"><?php if ($pricepaid5 < $price5){ ?><font color=lime>$<?php echo number_format($pricepaid5); ?></font> <?php }elseif ($pricepaid5 >= $price5){ ?><font color=red>$<?php echo number_format($pricepaid5);} ?></font></td><td align="center" colspan="1"><?php echo number_format($currentk5); ?></td><td align="center" colspan="1"><input type="text" width="10%" value="0" class="textbox" name="micro"></td><td align="center" colspan="1"><input type="submit" name="buymicro" id="buymicro" class="custombutton" value="Buy!"></td><td align="center" colspan="1"><input type=submit name=sellmicro class=custombutton value=Sell!></td></tr>
<tr>
<td align="center" colspan="7">Your Current Profit Is $<?php echo number_format($stockprofit); ?></td>
</tr>
</table>

	</td>	
	</TR>
	

</table>
</center>
</body>
</html>
	
	</TR>
	

</table>

</center>
</body>
</html>