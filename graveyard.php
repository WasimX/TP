<?php
session_start();
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
include "incfiles/connectdb.php";
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->

#bullet {
	position: absolute;
	width: 380px;
	height: 300px;
	top: 0;
	right: 0;
}

</style>


<div align="center"> <form id="form1" name="form1" method="post" action="">
<?php if($fetch->graveTimer > time()){ exit("You must wait ".maketime($fetch->graveTimer)." for Mr Graves and his crew to recover!"); }
 ?>
  <table width="700" height="600" border="0" cellspacing="0" cellpadding="0" class="tablegrave">
    <tr>

    </tr>
    <tr>
      <td align="center" valign="middle"><table class="tablebackground" width="370" height="250" style="background:#000000; opacity:0.7;" border="0" cellpadding="0" cellspacing="0">
<tr>    <tr>
      <td class="gradient" align="center" height="25">Graveyard</td>
    </tr>
                <td class="tablebackground" width="350" height="60" align="center">All of the  legends that have been killed. Where does their wealth end up?<br />
                    <br />
                  Their treasures are taken to the graves. Will they ever be seen again?<br />
                  <br />
                  You may gain money, but you can also loose money. This varies on the risk you choose to take.
                  </p>
                  <p align="center">There is a maximum of 1,000 credits and $1,000,000,000 you can give to <?php echo"<a href='javascript: ;' onclick=\"modal('profile.php?viewing=Mr Graves','<div class=\'header1\'>Mr Graves\'s Profile</div>','950','600');\">Mr Graves</a>"; ?> at any one time. </p>
                  <table class="table1px" width="100%" align="center">
                    <tr>
                      <td><div align="center"><span class="style1">Amount:
                        <input name="amount" class="textbox" type="text" size="25" maxlength="25" />
                      </span></div></td>
                    </tr>
                    <tr>
                      <td><div align="center">
                        <label></label>
                        <label> Type:
                          <select name="type" id="type" class="textbox" style='border:1px solid #000000; background: #ffffff;' >
                            <option value="Credits">Credits</option>
                            <option value="Money">Cash</option>
                          </select>
                          </label>
                        Risk:
                        <select name="risk" id="risk" class="textbox" style='border:1px solid #000000; background: #ffffff;' >
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td align="center">
                      <input type="submit" class="custombutton" value="Start Digging" name='submit' />
                
                      <br />
                      <?php
if($_POST['submit']){
$risk = addslashes($_POST['risk']);
$type = addslashes($_POST['type']);
$amount = addslashes($_POST['amount']);
if(!$risk){ $risk = "High"; }
if (ereg('[^0-9]',$amount)){
print "No."; 
}elseif (!ereg('[^0-9]',$amount)){
$newk= (3600*6)+time();
if($type == "Money"){ $sign = "$"; }
if($type == "Credits"){
if($fetch->credits < $amount){ exit("You can't afford this, stop kidding yourself!");}

if($amount < "5"){ exit("The minimum amount of credits is 5."); }else{
if($amount > "1000"){ exit("The maximum amount of credits is 1,000."); }else{
$add = rand(3000,19999);
if($risk == "Low"){ 
$rand2 = rand(1,10);
if($rand2 > 3){
$ra = rand(0,2);
$final = ($amount * "1.$ra") * 1000000;
}else{
$ra = rand(8,9);
$final = ($amount * "0.$ra") * 1000000;
}}elseif($risk == "Medium"){ 
$rand2 = rand(1,10);
if($rand2 > 5){
$ra = rand(0,4);
$final = ($amount * "1.$ra") * 1000000;
}else{
$ra = rand(7,9);
$final = ($amount * "0.$ra") * 1000000;
}}elseif($risk == "High"){ 
$rand2 = rand(1,10);
if($rand2 > 7){
$ra = rand(0,7);
$final = ($amount * "1.$ra") * 1000000;
}else{
$ra = rand(5,9);
$final = ($amount * "0.$ra") * 1000000;
}}
$final = round($final + $add);
if($final > ($amount * 1000000)){ $win = "profit"; }else{ $win = "loss"; }

$finalamount = ($fetch->credits-$amount);

mysqli_query( $connection, "UPDATE accounts SET credits=credits-$amount WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET graveTimer='$newk' WHERE username='$username'");


}}}



if($type == "Money"){
if($fetch->money < $amount){  exit("You can't afford this, stop kidding yourself!");}
if($amount < "100000"){ exit("The minimum amount of money is $100,000."); }else{
if($amount > "1000000000"){ exit("The maximum amount of money is $1,000,000,000."); }else{

$newk= (3600*6)+time();

$add = rand(3000,19999);
if($risk == "Low"){ 
$rand2 = rand(1,10);
if($rand2 > 3){
$ra = rand(0,2);
$final = ($amount * "1.$ra");
}else{
$ra = rand(8,9);
$final = ($amount * "0.$ra");
}}elseif($risk == "Medium"){ 
$rand2 = rand(1,10);
if($rand2 > 5){
$ra = rand(0,4);
$final = ($amount * "1.$ra");
}else{
$ra = rand(7,9);
$final = ($amount * "0.$ra");
}}elseif($risk == "High"){ 
$rand2 = rand(1,10);
if($rand2 > 7){
$ra = rand(0,7);
$final = ($amount * "1.$ra");
}else{
$ra = rand(5,9);
$final = ($amount * "0.$ra");
}}
$final = round($final + $add);
if($final > $amount){ $win = "profit"; }else{ $win = "loss"; }


mysqli_query( $connection, "UPDATE accounts SET money=money-$amount WHERE username='$username'");

}}}
if($win == "profit"){ echo"Mr Graves hands over the money and slides it into your cold heartless fingers. You gave him $sign".makecomma($amount)." $type and came back out with $".makecomma($final).".";}else{ echo"Mr Graves hands over the money and smiles at his profit. You gave him $sign".makecomma($amount)." $type and came back out with $".makecomma($final)."."; }



mysqli_query( $connection, "UPDATE accounts SET money=money+$final WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET graveTimer='$newk' WHERE username='$username'");



}}?></td>
                    </tr>
                  </table>                  </td>
  </tr>

            </table>      </td>
    </tr>
    <tr>
      <td align="center" height="40">&nbsp;</td>
    </tr>
  </table>
 
  </form>
  <p>&nbsp;</p>
</div>

<?php include_once "incfiles/foot.php"; ?>