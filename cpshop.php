<?php session_start(); 
include_once"incfiles/connectdb.php"; 
include_once"incfiles/func.php"; 
logincheck(); 
$username=$_SESSION['username'];


$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);




$type=$_GET['type']; $bu=$_GET['bu'];
if($bu){
  if($bu == "FMJ" && $type == "bf"){
  }elseif($bu == "JHP" && $type == "bf"){
  }elseif($bu == "Helmet" && $type == "af"){
  }elseif($bu == "Ballistic" && $type == "af"){
  }elseif($bu == "ChainMail" && $type == "af"){
  }elseif($bu == "StabVest" && $type == "af"){
  }elseif($bu == "FullMetalJacket" && $type == "af"){
  }elseif($bu == "M16A4" && $type == "wf"){
  }elseif($bu == "MP5" && $type == "wf"){
  }elseif($bu == "P90" && $type == "wf"){
  }elseif($bu == "PSG1" && $type == "wf"){
  }elseif($bu == "SA80" && $type == "wf"){
  }elseif($bu == "G36C" && $type == "wf"){
  }elseif($bu == "FAMAS" && $type == "wf"){
  }elseif($bu == "M82A1" && $type == "wf"){

	
	}else{
	exit('Not a real type of product');
	}}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title></head>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<form action="" method="post">
<?php
if (!$_GET['cp']){
?>
<table width="283" border="1" align="center" cellpadding="3" cellspacing="0"  class="table1px">
  <tr>
    <td height="22" align="center" class="gradient">
	<b>Your Properties</b></td>
  </tr>
 <tr>
    <td height="22" align="center" class="gradient">
	Type and Location</td>
  </tr>

  
    <?php $ka=mysqli_query( $connection, "SELECT * FROM `bf` WHERE `owner`='$username'");
       while($pa=mysqli_fetch_object($ka)){
	   echo "  <tr>
    <td align=\"center\" class=\"tableborder\">Bullet Factory in $pa->location [<b><a href=?cp=$pa->id&type=bf>ENTER</a></b>]</a></td>
  </tr>";
		}
		?>
        
          <?php $aka=mysqli_query( $connection, "SELECT * FROM `af` WHERE `owner`='$username'");
       while($apa=mysqli_fetch_object($aka)){
	   echo "  <tr>
    <td align=\"center\" class=\"tableborder\">Armour Factory in $apa->location [<a href=?cp=$apa->id&type=af><b>ENTER</a></b>]</td>
  </tr>";
		}
		?>  
                  <?php $wka=mysqli_query( $connection, "SELECT * FROM `wf` WHERE `owner`='$username'");
       while($wpa=mysqli_fetch_object($wka)){
	   echo "  <tr>
    <td align=\"center\" class=\"tableborder\">Weapon Factory in $wpa->location [<a href=?cp=$wpa->id&type=wf><b>ENTER</a></b>]</td>
  </tr>";
		}
		?>  
		
		

</table>
</div>
<br />
<br />
<?php
}elseif ($_GET['cp']){
$cp=$_GET['cp'];
$checker = mysqli_query( $connection, "SELECT * FROM `$type` WHERE `id` ='$cp' AND `owner` ='$username' ");
$rows=mysqli_num_rows($checker);
$check=mysqli_fetch_object($checker);	
$jhp = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE name = 'JSP' AND `type` ='$type' AND location='$check->location'"));
$fmj = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE name = 'FMJ' AND `type` ='$type' AND location='$check->location'"));
$rnl = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `stocks` WHERE name = 'JHP' AND `type` ='$type' AND location='$check->location'"));

if($rows == "0"){
echo"No such store, or you dont own this store!";
}elseif($rows != "0"){

if ($type == "bf") { $shoptype="Bullet Factory"; }
elseif ($type == "wf") { $shoptype="Weapon Store"; }
elseif ($type == "af") { $shoptype="Armour Store"; }
	?>
      <br>
    <br>
    </p>
    <table width="88%" height="41" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="black" class=table1px>
      <tr class="topic">
        <td height="22" colspan="3" align="center" bordercolor="#FFFFFF" class="gradient"><div align="center"><b><?php echo"$shoptype in $check->location";?></font></b></div></td>
      </tr>
      <tr>
        <td width="40%" height="21" align="center" ><u>Name</u></td>
      <td width="24%" align="center" ><u>Stock</u></td>
      <td width="36%" align="center" ><u>Price</u></td>
      </tr>
      <?php $ka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `type` ='$type' AND location='$check->location'");
       while($pa=mysqli_fetch_object($ka)){
	   echo "        <tr>
        <td height=\"21\" align=center><b>$pa->name [<a href=\"?cp=$cp&type=$type&bu=$pa->name\">Buy Some $pa->name</a>]</font></b></td>
        <td align=center><b>".makecomma($pa->quantity)."</font></b></td>
        <td align=center><b>&pound;".makecomma($pa->price)." -  <a href=\"?cp=$cp&type=$type&change=$pa->name\">Change Price</a></font></b></td>
      </tr>";
		} 
		?>
    
</table>
<br />
    <table width="18%" height="64" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="black" class="table1px">
      <tr class="topic">
        <td height="22" bordercolor="#FFFFFF" colspan="4" class="gradient"><div align="center"><strong>Options</font></strong></div></td>
      </tr>
      <tr>
        <td width="44%" height="21" align="center" >Give</td>

      <td width="56%" align="center" ><label>
          <input name="users" type="text" id="users" class="textbox" size="15" />
        </label></td>
      </tr>
      <tr>
        <td height="21" align="center" >Password</td>
        <td align="center" ><input name="users2" class="textbox" type="password" id="users2" size="15" /></td>
      </tr>
      <tr>

        <td colspan="2" align="center" class="tableborder">
          <div align="center">
            <input type="submit" name="give" class="custombutton" id="give" value="Give" />
            <br /><br />
            <?php
if($_POST[give]) {	
$users=strip_tags($_POST['users']);
$users2=strip_tags($_POST['users2']);
if($users2 != $fetch->password){
echo"Wrong password!";
}elseif($users2 == $fetch->password){
$find=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$users'"));
$fetchto=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$users'"));
if ($find == "0"){
echo "No such user.";
}elseif ($find != "0"){
if($fetchto->rankpoints < '90000'){
print"$users is not ranked Global Dom+ yet.";
}else{
mysqli_query( $connection, "UPDATE $type SET owner='$users' WHERE location='$check->location'");
echo"You gave it to $users!";
}}}}?>         
          </div>
        </label></td>
      </tr>
  </table>
  <p>&nbsp;</p>
  <p><?php
  if ($_GET['bu']){
   ?>
<table width="38%" height="85" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="black" class="table1px">
  <tr class="topic">
    <td height="22" colspan="3" align="center" bordercolor="#FFFFFF" class="gradient"><div align="center"><b><?php echo"$shoptype in $check->location";?></font></b></div></td>
  </tr>
  <tr>
    <td width="41%" height="21" align="center" ><u>Name</u></td>
    <td width="30%" align="center" ><u>Price</u></td>
    <td width="29%" align="center" ><u>Amount</u></td>
  </tr>
  <tr>
    <td height="21" align="center" ><?php echo"$bu"; ?></td>
    <td align="center" >&pound;<?php
  if($bu == "FMJ"){
  $price="1800";
  }elseif($bu == "JHP"){
  $price="1400";
  }elseif($bu == "Helmet"){
  $price="700000";
  }elseif($bu == "Ballistic"){
  $price="1000000";
  }elseif($bu == "ChainMail"){
  $price="2000000";
  }elseif($bu == "StabVest"){
  $price="4000000";
  }elseif($bu == "FullMetalJacket"){
  $price="8000000";
  }elseif($bu == "M16A4"){
  $price="30000";
  }elseif($bu == "MP5"){
  $price="50000";
  }elseif($bu == "P90"){
  $price="75000";
  }elseif($bu == "PSG1"){
  $price="100000";
  }elseif($bu == "SA80"){
  $price="125000";
  }elseif($bu == "G36C"){
  $price="150000";
  }elseif($bu == "FAMAS"){
  $price="175000";
  }elseif($bu == "M82A1"){
  $price="200000";
}
	echo"".makecomma($price)."";
	?>    </td>
    <td align="center" ><label>
      <input name="amount" type="text" id="amount" class="textbox" size="10" maxlength="15"/>
    </label></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="center" class="tableborder">
      <div align="center">        <br />
        <input type="submit" name="buyt" class="custombutton" id="buyt" value="Buy Stock" />
        <br />
        <?php
if($_POST['buyt']){ 
$amount = intval(strip_tags($_POST['amount']));
  if($bu == "FMJ"){
  $price="1800";
  }elseif($bu == "JHP"){
  $price="1400";
  }elseif($bu == "Helmet"){
  $price="700000";
  }elseif($bu == "Ballistic"){
  $price="1000000";
  }elseif($bu == "ChainMail"){
  $price="2000000";
  }elseif($bu == "StabVest"){
  $price="4000000";
  }elseif($bu == "FullMetalJacket"){
  $price="8000000";
  }elseif($bu == "M16A4"){
  $price="30000";
  }elseif($bu == "MP5"){
  $price="50000";
  }elseif($bu == "P90"){
  $price="75000";
  }elseif($bu == "PSG1"){
  $price="100000";
  }elseif($bu == "SA80"){
  $price="125000";
  }elseif($bu == "G36C"){
  $price="150000";
  }elseif($bu == "FAMAS"){
  $price="175000";
  }elseif($bu == "M82A1"){
  $price="200000";
	
		}else{
		exit('Not a real type of product');
		}
if ($amount == 0 || !$amount || ereg('[^0-9]',$amount)){
print "You cant buy that amount.";
}elseif ($amount != 0 || $amount || !ereg('[^0-9]',$amount)){

$endprice = $price * $amount;

if($endprice > $fetch->money){
echo"You dont have enough money to buy this stock!"; 
}elseif($endprice <= $fetch->money){	 

mysqli_query( $connection, "UPDATE accounts SET money=money-$endprice WHERE username='$username'"); 	  
mysqli_query( $connection, "UPDATE stocks SET quantity=quantity+$amount WHERE location='$check->location' AND type='$type' AND name='$bu'");
echo "You bought ".makecomma($amount)." $bu for &pound;".makecomma($endprice).""; }}}
		?>
      </div>
</td>
  </tr>

</table><?php
}elseif ($_GET['change']){
  $change=$_GET['change'];
  
  $chaaaa=mysqli_query( $connection, "SELECT * FROM stocks WHERE location='$check->location' AND type='$type' AND name='$change'");
$chaaaa1=mysqli_fetch_object($chaaaa);
  
?>
  <table width="38%" height="85" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="black" class="table1px">
    <tr class="topic">
      <td height="22" bordercolor="#FFFFFF" colspan="3" class="gradient"><div align="center"><b><?php echo"$shoptype in $check->location";?></font></b></div></td>
    </tr>
    <tr>
      <td width="42%" height="21" align="center" ><u>Name</u></td>
      <td width="30%" align="center" ><u>Price</u></td>
      <td width="28%" align="center" ><u>New Price</u></td>
    </tr>
    <tr>
      <td height="21" align="center" ><?php echo"$change"; ?></td>
      <td align="center" ><?php echo"&pound;".makecomma($chaaaa1->price)."";
	?>      </td>
      <td align="center" ><label>
        <input name="amm2" type="text" id="amm2" size="15" class="textbox" maxlength="15"/>
      </label></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="tableborder"><div align="center">        <br />
          <input type="submit" name="buyt2" id="buyt2" class="custombutton" value="Change price" />
          <br />
        <?php
if($_POST[buyt2]) {	
$amm2 = addslashes($_POST[amm2]);
if ($amm2 < 0 || !$amm2 || ereg('[^0-9]',$amm2)){
print "You can't change it to that.";
}elseif ($amm2 > 0 || $amm2 || !ereg('[^0-9]',$amm2)){

				
	  		mysqli_query( $connection, "UPDATE stocks SET price='$amm2' WHERE location='$check->location' AND type='$type' AND name='$change'");
			echo"You changed the price to &pound;".makecomma($amm2)."!"; 
		}}
		?>
      </div></td>
    </tr>
  </table>
<p><br />      
          <?php
	  
	  }}}?>
          <br />    
<div align="center"><br>
      <a href="cpshop.php"><em><strong>View All Properties</strong></em></a></div>
      
      
</form>
</body>
</html>