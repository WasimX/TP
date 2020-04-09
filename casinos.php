<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$page=$_GET['page'];
?>

<title>Thug Paradise 2 :: Casinos</title> <link href=style.css rel=stylesheet type=text/css>
</style> </head><body><table align="center" width="45%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF"><tr><td class="gradient"><div align="center">Navigation Bar</div></td></tr><tr class="tableborder"><td><div align="center"><br><a href="blackjack.php">Blackjack</a> &raquo; <a href="abc.php">50/50</a><span style="color: #F00">*</span> &raquo; <a href="racetrack.php">Race Track</a> &raquo; <a href="roulette.php">Roulette</a> &raquo; <a href="higherlower.php?page=higherlower">Higher Or Lower</a> &raquo; <a href="slots.php">Slots</a> &raquo; <a href="rps.php">RPS</a><span style="color: #F00">*</span><br /><br /><a href="casinoban.php" target="_self">Gamblers Anonymous</a></p></div></td></tr></table><br /><br /></span></td></tr><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px"><tr><td height="30" class="gradient" colspan="2">How fair are the casinos? Are they biased?</td></tr><tr><td align="center" class="tablebackground">The casinos on Thug Paradise are fair, well, as fair as we can make them! Any casino game you choose to play (whether online or in a 'real' casino) will always have a build-advantage for those that host the game. That is perfectly normal and is known as the house edge. Basically this means that over the long-run a casino will make money on the game it offers.<br><br>Each casino on TP is programmed to work <i>just</i> like real casinos. The chances are the same, the computer shuffles the cards the same number of times and the same number of decks are used. It's all down to simple chance, you may get lucky, you may get unlucky. It's how <b>you</b> play that really matters. Learn to stop while you're ahead, and don't let panic affect your decisions.<br><br>The casinos are not affected by:<ul><li>The time of day.</li> <li>The country you're located in.</li> <li>The owner of the casino.</li> <li>How much previous players have won or lost.</li> <li>Any other hidden factors.</li></ul><u>Please bare in mind that any virtual money lost in the casinos is your own responsibility and the blame should NOT be placed on TP.</u></tr></table>

<?php include_once "incfiles/foot.php"; ?>