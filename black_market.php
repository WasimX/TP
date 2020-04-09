<?php session_start();

include_once "incfiles/connectdb.php";

include_once "incfiles/func.php";

logincheck();

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

$username=$_SESSION['username'];

$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$info = mysqli_fetch_object($query);
$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$fetch2 = mysqli_fetch_object($query1);

$fetch=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$above = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch = mysqli_fetch_object($above);

$date = gmdate('Y-m-d h:i:s');

if (strip_tags($_POST['sellcreditssubmit']) && strip_tags($_POST['sellcreditsamount']) && strip_tags($_POST['sellcreditsprice'])){

$sellcreditsamount = strip_tags($_POST['sellcreditsamount']);

$sellcreditsprice = strip_tags($_POST['sellcreditsprice']);

if($info->credits < $sellcreditsamount){
echo "<center><b><font color=red>You haven't got enough credits to sell!<br>";
}elseif($sellcreditsamount < "1"){
echo "<center><b><font color=red>You cannot sell less than one credit!<br>";
}elseif($sellcreditsprice < "1"){
echo "<center><b><font color=red>You cannot sell credits for less than £1!<br>";

}elseif($info->credits >= $sellcreditsamount){
$newcredits=$info->credits - $sellcreditsamount;

mysqli_query( $connection, "UPDATE accounts SET credits='$newcredits' WHERE username='$username'");
 
mysqli_query( $connection, "INSERT INTO `blackmarket` ( `id` , `username` , `amount` , `cost` , `type` , `date` )

VALUES ('', '$username', '$sellcreditsamount', '$sellcreditsprice', 'credits', '$date')");

echo "<center><b>".makecomma($sellcreditsamount)." credits have been listed for &pound;".makecomma($sellcreditsprice)."!</b></font></center><br>";

}}

//////////////////////////////////////////////////

  $buysellcredits=strip_tags($_GET['option']);
  $buy=strip_tags($_GET['buy']);
  $remove=strip_tags($_GET['remove']);

if ($buy){
$buycredits=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM blackmarket WHERE id= '$buy'"));


if($buycredits->username == $username){

echo"<center><font color=red><b>You cannot buy your own ads!<br>"; }

elseif($buycredits->cost-1 >= $fetch2->money){

echo"<center><font color=red><b>You don't have enough money to buy those!<br>";

}elseif($buycredits->username != $username && $buycredits->cost <= $fetch2->money){

$buyercreditsamount=$buycredits->amount;
$dick=$buycredits->type;
$buyernewcredits=$fetch->$dick + $buyercreditsamount;
mysqli_query( $connection, "UPDATE accounts SET $dick='$buyernewcredits' WHERE username='$username'");

$buyercreditscost=$buycredits->cost;
$buyernewmoney=$fetch2->money - $buyercreditscost;
mysqli_query( $connection, "UPDATE accounts SET money='$buyernewmoney' WHERE username='$username'");


$creditsseller=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$buycredits->username'"));

$sellercreditscost=$buycredits->cost;
$sellernewmoney=$creditsseller->money+$buycredits->cost;

mysqli_query( $connection, "UPDATE accounts SET money='$sellernewmoney' WHERE username='$buycredits->username'");

mysqli_query( $connection, "DELETE FROM blackmarket WHERE id='$buy'");

mysqli_query( $connection, "INSERT INTO `blackmarket_logs` ( `id` , `seller` , `buyer` , `amount` , `type` , `price` , `date` )

VALUES ('', '$buycredits->username', '$username', '$buycredits->amount', '$buycredits->type', '$buycredits->cost', '$date')");

echo"<center><b>You successfully brought ".makecomma($buycredits->amount)." $dick for &pound;".makecomma($buycredits->cost)."!<br>";

}}


if($remove){
$removecredits=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM blackmarket WHERE id= '$remove'"));
$fetchcreditsowner=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username= '$removecredits->username'"));

if($removecredits->username == $username){

$dick=$removecredits->type;

mysqli_query( $connection, "DELETE FROM blackmarket WHERE id='$remove' AND username='$removecredits->username'");
$pluscredits=$removecredits->amount;
$newcredits=$fetch2->$dick +$pluscredits;
mysqli_query( $connection, "UPDATE accounts SET $dick='$newcredits' WHERE username='$removecredits->username'");
echo"<center><b>You successfully removed your $dick from the blackmarket!<br>"; 

}elseif($info->userlevel == "4"){

$dick=$removecredits->type;

mysqli_query( $connection, "DELETE FROM blackmarket WHERE id='$remove' AND username='$removecredits->username'");
$pluscredits=$removecredits->amount;
$newcredits=$fetchcreditsowner->$dick+$pluscredits;
mysqli_query( $connection, "UPDATE accounts SET $dick='$newcredits' WHERE username='$removecredits->username'");

mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `subject`, `to`, `from`, `message`, `date`, `read`) VALUES ('', 'Blackmarket', '$removecredits->username', 'TP Staff', 'Your $dick have been removed from the blackmarket by a member of staff. This may be because of several different reasons, usually it is because you have set the price as an un-reasonable amount.
<br></br><i>If you have a problem with this action feel free to dispute it in TP Support.</i>', '$date', '0');") or die (mysqli_error());

echo"<center><b>You successfully removed those $dick! The owner has been notified.<br>"; 

}else{ echo"<center><font color=red><b>You cannot remove those!<br>"; }}

//////////////////////////////////////////////////


if($removecredits->username == $username){ $buyremoveimage = "<a href=?remove=$coolshow->id><img src='http://icons.iconarchive.com/icons/fatcow/farm-fresh/24/cross-icon.png'></a>"; }else{ $buyremoveimage ="<a href=?buy=$coolshow->id><img src='http://icons.iconarchive.com/icons/fatcow/farm-fresh/24/cart-icon.png'></a>"; }

?>

<html>

<head>

<link href="style.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tooltip.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	tooltip('hover', 'class');
});
	function checkAll(theElement) {
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){
      if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
	  theForm[z].checked = theElement.checked;
	  }
     }
    }

</script>
<style type="text/css">
#tooltip {
	position: absolute;
	z-index: 3000;
	border: 1px solid #333333;
	background-color: #222222;
	color: #FFFFFF;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	padding: 5px;
	opacity: 0.85;
	max-width: 310px;
}
#tooltip h3, #tooltip div { margin: 0; }
#tooltip h3 {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: normal;
}

.pagenumbers {
background-color: #222222;
padding: 4px 0;
}

.bar_cont {
	display: inline-block;
	vertical-align:middle;
}
.bar {
	position: relative;
	width: 150px;
	line-height: 11px;
	border: 1px solid #000;
	color: #000000;
	background: url('images/crimebg/red.jpg');
	background-repeat: repeat-x;
}
.rg {
	position: relative;
	height: 11px;
	background-image: url('images/crimebg/green.jpg');
	background-repeat: repeat-x;
	z-index: 2;
}

.textinput{
	background-color: #222222;
	color: #999999;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	height: 22px;
	width: 150px;
	border: 1px solid #333333;
}

.menubox {
	text-align: left;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	border: 1px solid #333333;
	background-color: #111111;
	padding: 5px 5px 5px 5px;
}

.menubox a {
	color: #CCCCCC;
	text-decoration: none;
	display: block;
	width: 50px;
}
.menubox .unselected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin: 6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/subhead.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
.menubox .selected_link {
	border: 1px solid #505050;
	cursor: pointer;
	margin:	6px;
	padding: 5px 0px 5px 0px;
	vertical-align: middle;
	color: #cccccc;
	background: url(images/selected_box.png) repeat-x;
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}

.img {
	                    border: 1px solid #000000; }
			
</style>


</head>

<body>
		<center><a href="blackadd.php" target="replies">Post an advertisement?</a> / <a href="blacklogs.php" target="replies">Last 10 hustles</a>
			
		</center><br>
<div id=overDiv style="position:absolute; visibility:hidden; z-index:1000;"></div>
<form name="form" method="post" action="">
<table border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr class="gradient">
<td colspan="5" align="center">Black Market <a href="black_market.php"><img src="images/refresh.png" title="Refresh" height="15" border="0" width="15"></a></td>
</tr>
<tr class="forum">
<td width="150" class='table1px' align="center">Username</td>
<td width="150" class='table1px' align="center">Amount</td>
<td width="150" class='table1px' align="center">Cost</td>
<td width="50" class='table1px' align="center">Purchase</td>
<td width="50" class='table1px' align="center">Remove</td>
</tr>

<?php $whatpage=$_GET['page'];

$getTopics = mysqli_query( $connection, "SELECT * FROM `blackmarket`");

$totalTopics = mysqli_num_rows($getTopics);



$topics_per_page = 20;

$offset = (int)$_GET['page'] * $topics_per_page;

$pages = ceil($totalTopics / $topics_per_page);

for ($i=0;$i<$pages;$i++)

{

$n = $i+1;

if ($_GET['page'] == $i)

{

$page .= "<i>$n</i>  ";

}

else

{

$page .= "<a href='black_fmj.php?page=$i'>$n</a> ";

}}





$queryshow=mysqli_query( $connection, "SELECT * FROM blackmarket ORDER BY id DESC LIMIT $offset, $topics_per_page");


  while($coolshow = mysqli_fetch_object($queryshow)){

  

 echo "

<tr><td border='1' align='center'><a href=profile.php?viewing=$coolshow->username><b>$coolshow->username</b></a></td>

<td align=center><b>".makecomma($coolshow->amount)." $coolshow->type</b></td>

<td align=center><b>&pound;".makecomma($coolshow->cost)."</b></td>

<td align=center><a href=?buy=$coolshow->id><img src='http://icons.iconarchive.com/icons/fatcow/farm-fresh/24/cart-icon.png'></a></td>

<td align=center><a href=?remove=$coolshow->id><img src='http://icons.iconarchive.com/icons/fatcow/farm-fresh/24/cross-icon.png'></a></td>

</td>

</tr>";

 
  }

 ?>
<tr><td colspan='6' align='center' class='table1px'>
<?php echo "$page"; ?>
</td></tr>
</table>
</form>

<br />
<form method="post" action="">

<table align='center' width='50%'>
<tr align='center'>
<td width='50%'>
<table width='400' class='table1px' border='0'>
<tr>
                          <tr>
                            <td colspan="3" class="gradient"><div align="center">Quick Advertisement</div></td>
                          </tr>
                      
                          <tr>
                            <td bgcolor="" width='50%' align="center"><div align=center><table width="250" align="center" cellpadding="0" cellspacing="0" bordercolor="" class="table1px" border='0'>


<tr><td>&nbsp;</td></tr>

<tr>

<td align=right>&nbsp;&nbsp;&nbsp;&nbsp;Credits:&nbsp;&nbsp;</td>

<td><input name='sellcreditsamount' type='text' class=textbox size='20' style='height:20' onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off"></td>

</tr>



<tr><td>&nbsp;</td></tr>

<tr>

<td align=right>&nbsp;&nbsp;&nbsp;&nbsp;Price:&nbsp;&nbsp;</td>

<td><input name='sellcreditsprice' type='text' class=textbox size='20' style='height:20' onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off"></td>

</tr>

<tr><td>&nbsp;</td></tr>

<tr>

<td align=center colspan=3><input type="submit" name="sellcreditssubmit" value="Post Ad!" class="custombutton"></td>

</tr></table></div></td>
                            <td colspan="2" width='50%' align="center" bgcolor=""><div align="center">
<font color="gray">Money: <?php echo "&pound;".makecomma($fetch->money).""; ?>
<br>
Credits: <?php echo "".makecomma($fetch->credits).""; ?>
<br>
FMJ Bullets: <?php echo "".makecomma($fetch->fmj).""; ?>
<br>
JHP Bullets: <?php echo "".makecomma($fetch->jhp).""; ?></font></td>
	  </div></td>
                          </tr>
			<tr>
                            <td height="23" colspan="3" align="center" bgcolor="">
                              <table cellspacing="0" align="center" cellpadding="0" class="sub2">
                                <tr class="tblin">
                                  <td align="center" bgcolor=""><div align="center"></div></td>
                                </tr>
                                <tr class="tblin">
                                  <td align="center" bgcolor=""><div align="center">

			


                   
                                                                  <td bgcolor="">                                                                      <div align="center">
  <input type=hidden name="shag" value='Ashs Mums Fanny' class="forever">

                                                                        </div></td>
                              </table></table></table>




</form>

</body><?php require_once "incfiles/foot.php"; ?>