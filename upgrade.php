<?php




session_start();




include_once "incfiles/connectdb.php";




include_once "incfiles/func.php";




include_once "incfiles/alt.php";




logincheck();




echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 




$username=$_SESSION['username'];




echo "$style";




$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));



















if (strip_tags($_GET['car'])){




$car=strip_tags($_GET['car']);




$check=mysqli_query( $connection, "SELECT * FROM garage WHERE id='$car' AND owner='$username'");




$true=mysqli_num_rows($check);




$stuff=mysqli_fetch_object($check);




if ($true != "0"){




$upgrades=explode("-", $stuff->upgrades);




$next_1=$upgrades[0]+1;




$next_2=$upgrades[1]+1;




$next_3=$upgrades[2]+1;




$next_4=$upgrades[3]+1;




$next_5=$upgrades[4]+1;




$next_6=$upgrades[5]+1;




$next_7=$upgrades[6]+1;




$next_8=$upgrades[7]+1;









if (strip_tags($_POST['up1'])){




$price= $next_1*3000;









if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$next_1-$upgrades[1]-$upgrades[2]-$upgrades[3]-$upgrades[4]-$upgrades[5]-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up2'])){




$price= $next_1*10000;









if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$next_2-$upgrades[2]-$upgrades[3]-$upgrades[4]-$upgrades[5]-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up3'])){




$price= $next_1*5000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$next_3-$upgrades[3]-$upgrades[4]-$upgrades[5]-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up4'])){




$price= $next_1*6000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$upgrades[2]-$next_4-$upgrades[4]-$upgrades[5]-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up5'])){




$price= $next_1*100000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$upgrades[2]-$upgrades[3]-$next_5-$upgrades[5]-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up6'])){




$price= $next_1*5000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$upgrades[2]-$upgrades[3]-$upgrades[4]-$next_6-$upgrades[6]-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!"; 




}




}elseif (strip_tags($_POST['up7'])){




$price= $next_1*12000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){









$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$upgrades[2]-$upgrades[3]-$upgrades[4]-$upgrades[5]-$next_7-$upgrades[7]";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}




}elseif (strip_tags($_POST['up8'])){




$price= $next_1*7000;




if ($fetch->money < $price){




echo "You dont have enough money to upgrade your car!";




}elseif ($fetch->money >= $price){




$new_money=$fetch->money-$price;




$new_up="$upgrades[0]-$upgrades[1]-$upgrades[2]-$upgrades[3]-$upgrades[4]-$upgrades[5]-$upgrades[6]-$next_8";




mysqli_query( $connection, "UPDATE garage SET upgrades='$new_up' WHERE id='$car' AND owner='$username'");




mysqli_query( $connection, "UPDATE accounts SET money='$new_money' WHERE username='$username'");




echo "Car upgraded!";




}}
























}









}



















?>




<script language="JavaScript" type="text/JavaScript">




<!--




function MM_jumpMenu(targ,selObj,restore){ //v3.0




  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");




  if (restore) selObj.selectedIndex=0;




}




//-->




</script>




<form name="form2" method="post" action="">




<table width="20%" align="center" border="0" cellpadding="0" cellspacing="0" class="table1px">









<tr class="gradient">




  




<td colspan=2>




      Upgrade Costs</td>




    </tr> 




<tr><td width=49% align=right>Tyres</td>




<td width=49% align=center> &pound;3,000</tr>




<tr><td width=51% align=right>Engine</td>




<td width=49% align=center>&pound;10,000</tr> 




<tr><td width=51% align=right>Interior</td>




<td width=49% align=center> &pound;5,000</tr>




<tr><td width=51% align=right>Exhaust</td>




<td width=49% align=center> &pound;6,000</tr>




<tr><td width=51% align=right>NOS</td>




<td width=49% align=center> &pound;100,000</tr> 




<tr><td width=51% align=right>Rims</td>




<td width=49% align=center> &pound;5,000</tr>




<tr><td width=51% align=right>Brakes</td>




<td width=49% align=center> &pound;12,000</tr>




<tr><td width=51% align=right>Body Kit</td>




<td width=49% align=center> &pound;7,000</tr></table><br>



















 <table width="50%" align="center" border="0" cellpadding="0" cellspacing="0" class="table1px">









<tr class="gradient">




  




<td colspan=2>




      Upgrade</td>




    </tr>




 <?php if (strip_tags($_GET['car'])){




		  ?>




          <tr> 




            <td><div align="center"><b>Tyres</b></div></td>




            <td width="45%"><div align="center"><b>Engine</b></div></td>




          </tr>




          <tr> 




            <td><div align="center"><img src="images/cars_up/tyres.jpg" width="100" height="100" border="0"></div></td>




            <td><div align="center"><img src="images/cars_up/engine.jpg" width="100" height="100" border="0"></div></td>




          </tr>




          <tr> 




            <td><div align="center"> 




                <input name="up1" type="submit" id="up1" class=custombutton value="Level <?php echo "$next_1"; ?>">




              </div></td>




            <td><div align="center"> 




                <input name="up2" type="submit" id="up2" class=custombutton value="Level <?php echo "$next_2"; ?>">




              </div></td>




          </tr>




          <tr> 




            <td><div align="center"><b>Interior</b></div></td>




            <td><div align="center"><b>Exhaust</b></div></td>




          </tr>




          <tr> 




            <td><div align="center"><img src="images/cars_up/interior.jpg" width="100" height="100" border="0"></div></td>




            <td><div align="center"><img src="images/cars_up/exhaust.jpg" width="100" height="100" border="0"></div></td>




          </tr>




          <tr> 




            <td><div align="center"> 




                <input name="up3" type="submit" id="up3" class=custombutton value="Level <?php echo "$next_3"; ?>">




              </div></td>




            <td><div align="center"> 




                <input name="up4" type="submit" id="up4" class=custombutton value="Level <?php echo "$next_4"; ?>">




              </div></td>




          </tr>




          <tr> 




            <td><div align="center"><b>NOS</b></div></td>




            <td><div align="center"><b>Rims</b></div></td>




          </tr>




          <tr> 




            <td><div align="center"><img src="images/cars_up/nos.jpg" width="100" height="100" border="0"></div></td>




            <td><div align="center"><img src="images/cars_up/rims.jpg" width="100" height="100" border="0"></div></td>




          </tr>




          <tr> 




            <td><div align="center"> 




                <input name="up5" type="submit" id="up5" class=custombutton value="Level <?php echo "$next_5"; ?>">




              </div></td>




            <td><div align="center"> 




                <input name="up6" type="submit" id="up6" class=custombutton value="Level <?php echo "$next_6"; ?>">




              </div></td>




          </tr>




          <tr> 




            <td><div align="center"><b>Brakes</b></div></td>




            <td><div align="center"><b>Body Kit</b></div></td>




          </tr>




          <tr> 




            <td><div align="center"><img src="images/cars_up/brakes.jpg" width="100" height="100" border="0"></div></td>




            <td><div align="center"><img src="images/cars_up/body kit.jpg" width="100" height="100" border="0"></div></td>




          </tr>




          <tr> 




            <td><div align="center"> 




                <input name="up7" type="submit" id="up7" class=custombutton value="Level <?php echo "$next_7"; ?>">




              </div></td>




            <td><div align="center"> 




                <input name="up8" type="submit" id="up8" class=custombutton value="Level <?php echo "$next_8"; ?>">




              </div></td>




          </tr>




          <tr> 




            <td>&nbsp;</td>




            <td>&nbsp;</td>




          </tr>




          <tr> 




            <td colspan="2">&nbsp;</td>




          </tr><?php } ?>




        </table></td>




    </tr>




  </table>




</form>




<p align="center">




  




