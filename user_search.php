<?php session_start(); 
include "incfiles/connectdb.php";
include "incfiles/func.php";
logincheck();
if(isset($_GET['q'])){
$user=addslashes(strip_tags($_GET['q']));
$query=mysqli_query( $connection, "SELECT * FROM `accounts` WHERE `username`like'%$user%'");
$result=$query;
$total=mysqli_num_rows($result);

$strip = "/^[<>,'\"^-]+$/";
?><link href="style.css" rel="stylesheet" type="text/css"><style type="text/css">
#bar {
	position: relative;
	background-image: url('images/bar/r.jpg');
	width: 150px;
	height: 11px;
	border: 1px solid #000000;
}
#per {
	position: absolute;
	top: 0px;
	z-index: 3;
	width:100%;
	height: 11px;
	left: 63px;
}
#rg {
	background-image: url('images/bar/g.jpg');
	height: 11px;
}
</style><br><br>
<style type="text/css">

.link {background: url(images/subhead.png) repeat-x; 
	                    padding: 5px 0px 5px 0px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }
.selected_link {background: url(images/selected_box.png) repeat-x;
	                    padding: 5px 0px 5px 0px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }


.dark {
	background-color: #000000;
	height: 30px;
}
.light {
	background-color: #111111;
	height: 30px;
}
.hover {
	background-color: #333333;
	height: 30px;
}
.subhead2 {
	line-height: 20px;
	font-size: 11px;
	text-align: center;
	vertical-align: middle;
	font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
	background-image: url(images/subgrad.png);
	background-repeat: repeat-x;
	color: #000000;
	border-bottom:1px solid #b0b0b0;
}
</style>
<?php $check = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `read`='0' AND `to`='$username'");
$inbox=mysqli_num_rows($check);


$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$info=mysqli_fetch_object($query1);




$currank=$fetch->rank;
$rankp = $fetch->rankpoints;

if ($currank == "Chav"){
$max = "50";
$old="0";
}elseif ($currank == "Vandal"){
$max = '100';
$old="50";
}elseif ($currank == "Criminal"){
$max = '250';
$old="100";
}elseif ($currank == "Thug"){
$max = '500';
$old="250";
}elseif ($currank == "Hustler"){
$max = '1000';
$old="500";
}elseif ($currank == "Mobster"){
$max = '2000';
$old="1000";
}elseif ($currank == "Gangster"){
$max = '5000';
$old="2000";
}elseif ($currank == "Hitman"){
$max = '10000';
$old="5000";
}elseif ($currank == "Boss"){
$max = '20000';
$old="10000";
}elseif ($currank == "Assassin"){
$max = '35000';
$old="20000";

}elseif ($currank == "Don"){
$max = '50000';
$old="35000";

}elseif ($currank == "Godfather"){
$max = '70000';
$old="50000";

}elseif ($currank == "Global Terror"){
$max = '90000';
$old="70000";

}elseif ($currank == "Global Dominator"){
$max = '145000';
$old="90000";

}elseif ($currank == "Untouchable Godfather"){
$max = '175000';
$old="145000";

}elseif ($currank == "Legend"){
$max = '225000';
$old="175000";

}elseif ($currank == "Official TP Legend"){
$max = '9999999999';
$old="225000";
} 
$percent = round((($rankp-$old)/($max-$old))*100);
?>
<table width="700" align="center" cellpadding="0" cellspacing="0" bordercolor="" class="table1px" border='0'>

<tr>
<td align="center" class='gradient'><b>Username</b></td>

<td align="center" class='gradient'><b>Health</b></td>

<td align="center" class='gradient'><b>Rank</b></td>

<td align="center" class='gradient'><b>Gang</b></td>
</tr>
<?php if($total == "0"){ ?>
<tr>
<td colspan="9" class="table1px"><center>No results found!</center></td>
</tr>
<?php }else{
	while($table = mysqli_fetch_object($result)) { 
$reg=$table->regged;
$time=time();
$sum=$time-$reg;
if($sum < 86400){
$days=1;
}else{
$days=round(($sum)/(86400));
} 
?>
<tr>
  <td align="center" class="table1px"><?php print"<a href='profile.php?viewing=$table->username'>$table->username</a>"; ?></td>

  <td align="center" class="table1px"><?php echo"$table->status"; ?></td>

  <td align="center" class="table1px"><?php echo"$table->rank"; ?></td>


  <td align="center" class="table1px"><?php echo"$table->crew"; ?></td>
</tr>
<?php } ?>
<tr>
</tr></tbody></table>
<br>
</body></html><?php } } ?>
