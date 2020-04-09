<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

$mysqli=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($mysqli);

 ?>
<div id="back"><a href="black_market.php" target="replies">Go Back!</a></div><div id="dhtmltooltip"></div>
<table width="700" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="7">Last 10 Hustles <a href="blacklogs.php"><img src="images/refresh.png" title="Refresh" height="15" border="0" width="15"></a></td></tr>
<tr>
<td class="tableborder" align="center"><u>ID</u></td>
<td class="tableborder" align="center"><u>Seller</u></td>
<td class="tableborder" align="center"><u>Buyer</u></td>
<td class="tableborder" align="center"><u>Amount</u></td>
<td class="tableborder" align="center"><u>Price</u></td>
<td class="tableborder" align="center"><u>Type</u></td>
<td class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $ccc=mysqli_query( $connection, "SELECT * FROM blackmarket_logs WHERE type='credits' OR type='fmj' OR type='jhp' ORDER BY id DESC LIMIT 10");
while($ddd=mysqli_fetch_object($ccc)){
echo "<tr>
	  <td class='tableborder'><center>$ddd->id</center></b></a></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->seller'><b><center>$ddd->seller</center></b></a></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->buyer'><b><center>$ddd->buyer</center></b></a></td>
	  <td class='tableborder'><center>".makecomma($ddd->amount)."</center></td>
	  <td class='tableborder'><center>&pound;".makecomma($ddd->price)."</center></td>
	  <td class='tableborder'><center>$ddd->type</center></td>
	  <td class='tableborder'><center>$ddd->date</center></td>
	</tr>"; } ?>
</table>

<br>
<center>Notice anything suspicious? Post a ticket to <a href="support.php" target="middle">TP Support</a> along with the ID(s) involved.</center>
			
<?php include_once "incfiles/foot.php"; ?>