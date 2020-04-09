<?php session_start(); 

include_once"incfiles/connectdb.php"; include_once"incfiles/func.php"; logincheck();



$username=$_SESSION['username'];

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$fetch=mysqli_fetch_object($query);

$query2=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");

$fetch2=mysqli_fetch_object($query2);



$fetch_bf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bf WHERE location='$fetch->location'"));

$fetch_af=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM af WHERE location='$fetch->location'"));

$fetch_wf=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM wf WHERE location='$fetch->location'"));

$sitestats = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));

?>

<?php ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<title>Factorys</title>


<link href="style.css" rel="stylesheet" type="text/css"/>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



</head>


<body>

   <form action="" method="post" id=""> 



    <table width="96%" border="0" align="center">

      <tr>

        <td width="33%" valign="top">

        <?php if($fetch_wf->owner == "0" || $fetch_wf->owner == ""){ ?>

 <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>

  <tr class="topic">

    <td height="22" align="center" bordercolor="#FFFFFF" class="gradient"><b><font color="white">Weapon Factory</font></b>: Unowned</td>

  </tr>

  <tr >

    <td align="center" class="tableborder">So you can't purchase any stock from it.<br />

      The only thing you can do is purchase the factory for £50,000,000.<br><br>

  <input name="button" type="submit" class="custombutton" id="button" value="Purchase">

      <br /><br>

      <br>

      <?php

	  if ($_POST['button']){

	  if($fetch->money < 50000000){

echo"You have not got £50,000,000.";

}elseif($fetch->money > 50000000){

	  if($fetch->rankpoints < '90000'){

echo"You need to be ranked at Global Dominator before thinking about running an illegal business!";

}elseif($fetch->rankpoints > '90000'){

mysqli_query( $connection, "UPDATE accounts SET money=money-50000000 WHERE username='$username'");

mysqli_query( $connection, "UPDATE wf SET owner='$username' WHERE location='$fetch->location'");

mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='wf'");

echo"You bought the weapon factory in $fetch->location. All previous stock has been dropped.";	  

	  }}}

	  ?></td>

  </tr>

</table>

         <?php }elseif($fetch_wf->owner != "0"){ ?>
        <table width="300" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>

          <tr class="gradient">

            <td height="22" bordercolor="#FFFFFF" colspan="3" class="gradient"><div align="center"><b>Weapon 

              Factory</font></b>: Owned By 

              <?php if ($fetch1->owner == "0"){ echo "WF unowned."; }else{ echo "$fetch_wf->owner"; } ?>

              <label></label>

            </div></td>

          </tr>

	   <tr> <td width=43% align="center" class="tableborder"><u>Name</u></td>

            <td width="26%" align="center" class="tableborder"><u>Price</u></td> 

            <td width="31%" align="center" class="tableborder"><u>Stock</u></td> 

        </tr>

          <?php $ka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='wf'");

       while($pa=mysqli_fetch_object($ka)){

 	 if($pa->quantity  > '0'){

	   echo "<tr>

 <td align=\"center\" class=\"tableborder\"><a href=?buy=$pa->id><b>$pa->name</b></a></td>

            <td align=\"center\" class=\"tableborder\"><b>&pound;".makecomma($pa->price)."</b></td><td align=\"center\" class=\"tableborder\">".makecomma($pa->quantity)."</td>

        </tr>";

		}}

		?>

        </table>

        

          <?php } ?>

        </td>

        <td width="30%" valign="top">

               <?php if($fetch_bf->owner == "0" || $fetch_bf->owner == ""){ ?>

 <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>

  <tr class="topic">

    <td height="22" align="center" bordercolor="#FFFFFF" class="gradient"><b><font color="white">Bullet Factory</font></b>: Unowned</td>

  </tr>

  <tr >

    <td align="center" class="tableborder">So you can't purchase any stock from it.<br />

      The only thing you can do is purchase the factory for £50,000,000.<br>

      <br><input name="buybf" id="buybf" type="submit" class="custombutton" value="Purchase" />

      <br />

      <br><br><?php

	  if($_POST['buybf']){

	  if($fetch->money < 50000000){

echo"You have not got £50,000,000.";

}elseif($fetch->money > 50000000){

	  if($fetch->rankpoints < '90000'){

echo"You need to be ranked at Global Dominator before thinking about running an illegal business!";

}elseif($fetch->rankpoints > '90000'){

mysqli_query( $connection, "UPDATE accounts SET money=money-50000000 WHERE username='$username'");

mysqli_query( $connection, "UPDATE bf SET owner='$username' WHERE location='$fetch->location'");

mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='bf'");

echo"You bought the bullet factory in $fetch->location. All previous stock has been dropped.";	    

	  }}}

	  ?>  </td>

  </tr>

</table>

         <?php }elseif($fetch_bf->owner != "0"){ ?>

        

        

        <table width="300" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>



    <tr class="topic">

              <td height="22" bordercolor="#FFFFFF" colspan="3" class="gradient"><div align="center"><b>Bullet 

                Factory</font></b>: Owned By

          <label></label>

                      <span class="style5">

                      <?php if ($fetch1->owner == "0"){ echo "BF unowned."; }else{ echo "$fetch_bf->owner"; } ?>

            </span></div></td>

          </tr>          <tr>

            <td width=36% align="center" class="tableborder"><u>Name</u></td>

            <td width="33%" align="center" class="tableborder"><u>Price</u></td> 

            <td width="31%" align="center" class="tableborder"><u>Stock</u></td> 

          </tr>

            <?php $bka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='bf'");

       while($bpa=mysqli_fetch_object($bka)){

	 	 if($bpa->quantity  > '0'){

	   echo "

	   <tr>

 <td align=\"center\" class=\"tableborder\"><a href=?buy=$bpa->id><b>$bpa->name</b></a></td>

            <td align=\"center\" class=\"tableborder\"><b>&pound;".makecomma($bpa->price)."</b></td><td align=\"center\" class=\"tableborder\">".makecomma($bpa->quantity)."</td>

        </tr>";

		}}

		?>

          </table>

          <?php } ?>

        </td>

      <td width="36%" valign="top">

        <?php if($fetch_af->owner == "0" || $fetch_af->owner == ""){ ?>

 <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>

  <tr class="topic">

    <td height="22" align="center" bordercolor="#FFFFFF" class="gradient"><b><font color="white">Armour Factory</font></b>: Unowned</td>

  </tr>

  <tr >

    <td align="center" class="tableborder">So you can't purchase any stock from it.<br />

      The only thing you can do is purchase the factory for £50,000,000.<br>

      <br><input name="buyaf" id="buyaf" type="submit" class="custombutton" value="Purchase" />

      <br /><br /><br />

      <?php

	  if($_POST['buyaf']){

	  if($fetch->rankpoints < '90000'){

echo"You need to be ranked at Global Dominator before thinking about running an illegal business!";

}elseif($fetch->rankpoints > '90000'){

	  if($fetch->money < 50000000){

echo"You have not got £50,000,000.";

}elseif($fetch->money > 50000000){

$moneyless = $sitestats->factoryprice;

mysqli_query( $connection, "UPDATE accounts SET money=money-50000000 WHERE username='$username'");

mysqli_query( $connection, "UPDATE af SET owner='$username' WHERE location='$fetch->location'");

mysqli_query( $connection, "UPDATE stocks SET quantity='0' WHERE location='$fetch->location' AND type='af'");

echo"You bought the armour factory in $fetch->location. All previous stock has been dropped.";	 

	  }}}

	  ?>  </td>

  </tr>

</table>

        <?php }elseif($fetch_af->owner != "0"){ ?>

      

      <table width="300" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="black"  class=thinline>



    <tr class="topic">

              <td height="22" bordercolor="#FFFFFF" colspan="3" class="gradient"><div align="center"><b>Armour 

                Factory</font></b>: Owned By

          <label></label>

                      <span class="style5">

                      <?php if ($fetch1->owner == "0"){ echo "AF unowned."; }else{ echo "$fetch_af->owner"; } ?>

              </span></div></td>

          </tr>          <tr>

            <td width=49% align="center" class="tableborder"><u>Name</u></td>

            <td width="26%" align="center" class="tableborder"><u>Price</u></td> 

            <td width="25%" align="center" class="tableborder"><u>Stock</u></td> 

          </tr>

            <?php $aka=mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `location`='$fetch->location' AND `type`='af'");

       while($apa=mysqli_fetch_object($aka)){

	 	 if($apa->quantity  > '0'){

	   echo "

	   <tr>

 <td align=\"center\" class=\"tableborder\"><a href=?buy=$apa->id><B>$apa->name</b></a></td>

            <td align=\"center\" class=\"tableborder\"><b>&pound;".makecomma($apa->price)."</b></td><td align=\"center\" class=\"tableborder\">".makecomma($apa->quantity)."</td>

        </tr>";

		}}

		?>

        </table>

          

        <?php } ?>

        </td>

      </tr>

    </table>

    <div align="center"><br> 

      <a href="cpshop.php"><em><strong>Go to your properties?</strong></em></a></div>

    <p>

    <?php

	if ($_GET['buy']){

$buy=$_GET['buy'];

$checker = mysqli_query( $connection, "SELECT * FROM `stocks` WHERE `id` ='$buy' AND `location` ='$fetch->location' ");

$rows=mysqli_num_rows($checker);

$check=mysqli_fetch_object($checker);	

$fetchstocky = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM $check->type WHERE location='$check->location'"));

if($rows == "0"){

echo"No such stock!";

}elseif($rows != "0"){

       
function display($content) {

$content = str_replace(" ", "", $content);

return $content;

} 



$nameu = strtolower(display($check->name));
		 ?>

        

    <br>

    <br>

    </p>

    <table width="23%" border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="black"  class=table1px>

      <tr class="topic">

        <td height="22" bordercolor="#FFFFFF" colspan="2" class="gradient"><div align="center"><b>Buy <?php echo"$check->name";?></font></b></div></td>
      </tr>


      <tr>

        <td  align="right" width=46%>Quantity:</td>

        <td width="54%" ><label>

          <input name="amount" type="text" id="amount" class="textbox" value="1" size="10" maxlength="10">

        </label></td>
      </tr>

      <tr>

        <td colspan="2" class="tableborder" align="center" >

          <input type="submit" class="custombutton" name="buyth" id="buyth" value="Buy">

  

                   <br>

          <?php

		   if($_POST['buyth']){

		   



 $amount=intval(strip_tags($_POST['amount']));


$name = display($check->name);
if ($amount == 0 || !$amount || ereg('[^0-9]',$amount)){

print "You cant buy that amount.";

}elseif ($amount != 0 || $amount || !ereg('[^0-9]',$amount)){



$costs = $check->price * $amount;

if($check->type == "bf"){

if ($costs > $fetch->money){

echo "You do not have enough money";

}elseif ($costs <= $fetch->money){



if ($check->quantity < $amount){

echo "There isn't enough bullets in stock for you to buy that amount.";

}elseif ($amount <= $check->quantity){





if($check->name == "FMJ"){ $newammount = $amount + $fetch2->FMJ;

}elseif($check->name == "JHP"){ $newammount = $amount + $fetch2->JHP;

}$nstock = $check->quantity - $amount;

$oldbullets=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$viewing'"));



mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");

mysqli_query( $connection, "UPDATE accounts SET $check->name=$check->name+$newammount WHERE username='$username'");

mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");

mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchstocky->owner'");

echo"You've bought $amount of $check->name for &pound;".makecomma($costs)."."; }}





}elseif($check->type == "af"){

if ($costs > $fetch->money){

echo "You do not have enough money.";

}elseif ($costs <= $fetch->money){



if ($check->quantity < $amount){

echo "There isn't enough stock for you to buy that amount.";

}elseif ($amount <= $check->quantity){







$nmoney = $fetch->money - $costs;

$nstock = $check->quantity - $amount;



mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");

mysqli_query( $connection, "UPDATE inventory SET $name=$name+$amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");

mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchstocky->owner'");

echo"You've bought $amount of $name for &pound;".makecomma($costs).".";



 }}





}elseif($check->type == "wf"){ 

if ($costs > $fetch->money){

echo "You do not have enough money";

}elseif ($costs <= $fetch->money){

if ($check->quantity  < $amount){

echo "Not that much weapons in that store.";

}elseif ($amount <= $check->quantity){



$nmoney=$fetch->money - $costs;

$nstock = $check->quantity - $amount;



mysqli_query( $connection, "UPDATE accounts SET money=money-$costs WHERE username='$username'");

mysqli_query( $connection, "UPDATE inventory SET $name=$name+$amount WHERE username='$username'");

mysqli_query( $connection, "UPDATE stocks SET quantity='$nstock' WHERE location='$fetch->location' AND name='$check->name' AND type='$check->type'");

mysqli_query( $connection, "UPDATE accounts SET money=money+$costs WHERE username='$fetchstocky->owner'");

echo"You've bought $amount of $check->name for &pound;".makecomma($costs)."."; }}



}}}  ?></td>
      </tr>
    </table>

<p><br>

      

      <?php }}?>

    </p>

</form>

<p>&nbsp;</p> 

</body>

</html>

<?php require_once"incfiles/foot.php"; ?>
