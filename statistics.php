<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

///////MONEY IN GANGS

$result111111 = mysqli_query( $connection, "SELECT money FROM crews WHERE rnl='0'");
	$moneytotx = 0;
	while($row=mysqli_fetch_array($result111111)){
		$moneytotx+=$row[0]+$row[1];
	}
		$nums=mysqli_num_rows($result111111); 
	$per_user = round($moneytotx / $nums);
$moneytotx = round($moneytotx);
$ud=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM crews")); 


///////MONEY IN GAME AND PER USER

$result11111 = mysqli_query( $connection, "SELECT money FROM accounts WHERE status='Alive'");
	$moneytot = 0;
	while($row=mysqli_fetch_array($result11111)){
		$moneytot+=$row[0]+$row[1];
	}
		$nums=mysqli_num_rows($result11111); 
	$per_user = round($moneytot / $nums);
$moneytot = round($moneytot);
$ud=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts")); 

$site=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));
$dead= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status = 'Dead'"));
$alive= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status != 'Dead'"));
/////TOTAL ATTEMPTS
$attempts= mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM attempts WHERE outcome = 'Survived'"));
///?END
	
$page = strip_tags($_GET['page']);

$gangEngland=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='England'")); 
$gangPakistan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Pakistan'")); 
$gangJamaica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Jamaica'")); 
$gangAmerica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='America'")); 
$gangJapan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Japan'")); 
$gangGermany=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Germany'"));
$gangChina=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='China'"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>World Stats</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>



<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" class="gradient"><div align="center">World Stats</div></td>
</tr>
<tr class="tableborder">
<td width="100" valign="middle"><div align="center"><a href="?page=signup">Last 10 sign ups</a><br>
<br>
<a href="?page=deaths">Last 10 deaths</a><br>
<br>
<a href="#">Last 10 drive-bys</a><br>
<br>
<a href="?page=stats">Gangster Stats</a><br>
<br>
<a href="?page=eco">World Economy</a><br>
<br>
<a href="?page=gangs">Gangs</a></div></td>

  <?php if ($page == "" || $page == "signup") { ?>
<td width="600" valign="top" class="tableborder"><div align="center">
<p></p>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #FFFFFF;" class="tabledbl">
<tr>
<td colspan="3" class="gradient"><div align="center">Last 10 Sign Ups</div></td>
</tr>
<tr>
<td class="tableborder"><div align="center">Username</div></td>
<td width="33%" class="tableborder"><div align="center">Rank </div></td>
<td width="33%" class="tableborder"><div align="center">Date Registered </div></td>
</tr>
<tr><?php $c=mysqli_query( $connection, "SELECT * FROM accounts ORDER BY regged DESC LIMIT 10");
while($d=mysqli_fetch_object($c)){
echo "<tr><td class=\"tableborder\" valign=\"top\"><a href='profile.php?viewing=$d->username'><b><center>$d->username</center></b></a></td> 
	  <td class=\"tableborder\"><center>$d->rank</center></td>
	  	  <td class=\"tableborder\"><center>$d->regged</center></td>
"; } ?>

</table>
<p></p>
</div></td>
</tr>
</table>
</body>
</html>




<?php }elseif ($page == "deaths"){ ?>
<td width="600" valign="top" class="tableborder"><div align="center">
<p></p>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #FFFFFF;" class="tabledbl">
<tr><tr><td height="30" class="gradient" colspan="3"><b>Last 10 Deaths</b></td></tr>
<tr>
<td width="33%" class="tableborder" align="center"><u>Username</u></td>
<td width="33%" class="tableborder" align="center"><u>Date Died</u></td>
</tr>
<?php $daet=mysqli_query( $connection, "SELECT * FROM attempts WHERE outcome='Dead' ORDER BY date DESC LIMIT 10");
	while($dae=mysqli_fetch_object($daet)){
echo "<tr><td class=\"tableborder\"><a href='profile.php?viewing=$dae->target'><center>$dae->target</b></center></a></td> 
      <td class=\"tableborder\"><center>$dae->date</cneter></a></td>"; } ?>
</table></td>
<?php }elseif ($page == "stats"){ ?>
<td width="600" valign="top" class="tableborder"><div align="center">
<p></p>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" class="tabledbl">
<tr>
<table width="308" style="border: 1px solid #FFFFFF;" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="3"><b>Gangster Statistics</b></td></tr>
          <tr>
            <td width="33%" class="tableborder" align="center">Accounts Alive</td>
            <td width="33%" class="tableborder" align="center"><?php echo "$alive"; ?></td>
          </tr>
          <tr>
            <td width="33%" class="tableborder" align="center">Accounts Dead</td>
            <td width="33%" class="tableborder" align="center"><?php echo "$dead"; ?></td>

          </tr>
          <tr>
            <td width="33%" class="tableborder" align="center">Total Accounts </td>
            <td width="33%" class="tableborder" align="center"><?php echo "".makecomma($ud).""; ?></td>
          </tr>
</table></td>
<?php }elseif ($page == "eco"){ ?>
<td width="600" valign="top" class="tableborder"><div align="center">
<p></p>
<table width="359" class="table1px" style="border: 1px solid #FFFFFF;" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="3"><b>World Economy</b></td></tr>
<tr>
<td width="33%" class="tableborder" align="center">Gang Stash Money</td>
<td width="33%" class="tableborder" align="center"><?php echo "$".makecomma($moneytotx).""; ?></td>
</tr>
<tr>
<td width="33%" class="tableborder" align="center">Alive Players Money</td>
<td width="33%" class="tableborder" align="center"><?php echo "$".makecomma($moneytot).""; ?></td>
</tr>
<tr>
<td width="33%" class="tableborder" align="center">Money Average (Per User)</td>
<td width="33%" class="tableborder" align="center"><?php echo "$".makecomma($per_user).""; ?></td>
</tr>
</table></td>
<?php }elseif ($page == "gangs"){ ?> 
<td width="600" valign="top" class="tableborder"><div align="center">
<p></p>
<table width="639" class="table1px" style="border: 1px solid #FFFFFF;" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="5"><b>Gangs Stats</b></td></tr>
<tr>
<td width="25%" class="tableborder" align="center">Gang Name</td>
<td width="25%" class="tableborder" align="center">Boss</td>
<td width="25%" class="tableborder" align="center">Underboss</td>
<td width="25%" class="tableborder" align="center">Rank Acceptance</td>
<td width="25%" class="tableborder" align="center">Business</td>
</tr>
<?php $biatch = mysqli_query( $connection, "SELECT * FROM crews ORDER BY id ASC");
while($fucktard = mysqli_fetch_object($biatch)){

echo "<td class='tableborder'><a href='crewprofile.php?viewcrew=$fucktard->name'><b><center>$fucktard->name</center></b></a></td>";
echo "<td class='tableborder'><a href='profile.php?viewing=$fucktard->owner'><b><center>$fucktard->owner</b></cneter></a></td>";

if($fucktard->underboss == "0") { echo "<td class='tableborder'><b><center></b></center></td>"; 
}elseif($fucktard->underboss !== "0") { 
echo "<td class='tableborder'><a href='profile.php?viewing=$fucktard->underboss'><b><center>$fucktard->underboss</b></center></a></td>"; }

if($fucktard->ranka == "") { $arank = "Chav"; }
elseif($fucktard->ranka == "1") { $arank = "Chav"; }
elseif($fucktard->ranka == "2") { $arank = "Pickpocket"; }
elseif($fucktard->ranka == "3") { $arank = "Vandal"; }
elseif($fucktard->ranka == "4") { $arank = "Thief"; }
elseif($fucktard->ranka == "5") { $arank = "Criminal"; }
elseif($fucktard->ranka == "6") { $arank = "Gangster"; }
elseif($fucktard->ranka == "7") { $arank = "Hitman"; }
elseif($fucktard->ranka == "8") { $arank = "Knuckle Breaker"; }
elseif($fucktard->ranka == "9") { $arank = "Boss"; }
elseif($fucktard->ranka == "10") { $arank = "Assassin"; }
elseif($fucktard->ranka == "11") { $arank = "Don"; }
elseif($fucktard->ranka == "12") { $arank = "Godfather"; }
elseif($fucktard->ranka == "13") { $arank = "Global Terror"; }
elseif($fucktard->ranka == "14") { $arank = "Global Dominator"; }
elseif($fucktard->ranka == "15") { $arank = "Legend"; }
elseif($fucktard->ranka == "16") { $arank = "Official TP Legend"; }
echo "<td class='tableborder'><center>$arank</center></td></tr>"; } ?>


</table>
      <p></p>
    </div></td>
  </tr> 
</table></td>
<?php } ?>
</body>

</html>
<?php require_once "incfiles/foot.php"; ?>


