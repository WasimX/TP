<?php

session_start();

include "../incfiles/connectdb.php";

include "../incfiles/func.php";

logincheck();

$username=$_SESSION['username'];

$timenow=time();

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' AND status = 'Alive' ORDER by username");
$num = mysqli_num_rows($select);

function rankcheck(){
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1");
$fetch = mysqli_fetch_object($query);
$date = gmdate('Y-m-d H:i:s');

if (($fetch->rank == "Chav") && ($fetch->rankpoints >= "50")){ $newrank="Pickpocket"; $done="1"; $credits="1"; }
elseif (($fetch->rank == "Pickpocket") && ($fetch->rankpoints >= "100")){ $newrank="Vandal"; $done="1"; $credits="2"; }
elseif (($fetch->rank == "Vandal") && ($fetch->rankpoints >= "250")){ $newrank="Thief"; $done="1"; $credits="3"; }
elseif (($fetch->rank == "Thief") && ($fetch->rankpoints >= "500")){ $newrank="Criminal"; $done="1"; $credits="4"; }
elseif (($fetch->rank == "Criminal") && ($fetch->rankpoints >= "1000")){ $newrank="Gangster"; $done="1"; $credits="5"; }
elseif (($fetch->rank == "Gangster") && ($fetch->rankpoints >= "2000")){ $newrank="Hitman"; $done="1"; $credits="6"; }
elseif (($fetch->rank == "Hitman") && ($fetch->rankpoints >= "5000")){ $newrank="Knuckle Breaker"; $done="1"; $credits="7"; }
elseif (($fetch->rank == "Knuckle Breaker") && ($fetch->rankpoints >= "10000")){ $newrank="Boss"; $done="1"; $credits="8"; }
elseif (($fetch->rank == "Boss") && ($fetch->rankpoints >= "20000")){ $newrank="Assassin"; $done="1"; $credits="9"; }
elseif (($fetch->rank == "Assassin") && ($fetch->rankpoints >= "35000")){ $newrank="Don"; $done="1"; $credits="10"; }
elseif (($fetch->rank == "Don") && ($fetch->rankpoints >= "50000")){ $newrank="Godfather"; $done="1"; $credits="11"; }
elseif (($fetch->rank == "Godfather") && ($fetch->rankpoints >= "70000")){ $newrank="Global Terror"; $done="1"; $credits="12"; }
elseif (($fetch->rank == "Global Terror") && ($fetch->rankpoints >= "90000")){ $newrank="Global Dominator"; $done="1"; $credits="13"; }
elseif (($fetch->rank == "Global Dominator") && ($fetch->rankpoints >= "145000")){ $newrank="Untouchable Godfather"; $done="1"; $credits="14"; }
elseif (($fetch->rank == "Untouchable Godfather") && ($fetch->rankpoints >= "175000")){ $newrank="Legend"; $done="1"; $credits="15"; }
elseif (($fetch->rank == "Legend") && ($fetch->rankpoints >= "225000")){ $newrank="Official TP Legend"; $done="1"; $credits="16"; }


if (!$done){ $done="0"; }
if ($done == "1"){
mysqli_query( $connection, "UPDATE accounts SET rank='$newrank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET credits=credits+$credits WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `date` , `read` , `saved` , `event_id` ) 
VALUES ('', '$username', '$username', '<b><center>Congratulations! You have been promoted to $newrank!
Keep it up!</b><br></br><i>You have received $credits Credits for this achievement.</i></center>', '$date', '0', '0', '0')");
}}

rankcheck();

?>

<?php $check = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `read`='0' AND `to`='$username'");
$inbox=mysqli_num_rows($check);

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$query1=mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'");
$info=mysqli_fetch_object($query1);

if($inbox > "0"){
$isnbox = "../images/newmsg.gif";
}elseif($inbox == "0"){
$isnbox = "../images/tile_cat2.gif";
}


$currank=$fetch->rank;
$rankp = $fetch->rankpoints;


if ($currank == "Chav"){
$max = "50";
$old="0";
}elseif ($currank == "Pickpocket"){
$max = '100';
$old="50";
}elseif ($currank == "Vandal"){
$max = '250';
$old="100";
}elseif ($currank == "Thief"){
$max = '500';
$old="250";
}elseif ($currank == "Criminal"){
$max = '1000';
$old="500";
}elseif ($currank == "Gangster"){
$max = '2000';
$old="1000";
}elseif ($currank == "Hitman"){
$max = '5000';
$old="2000";
}elseif ($currank == "Knuckle Breaker"){
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
$max = '99999999999999';
$old="225000";

}
$percent = round((($rankp-$old)/($max-$old))*100);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>

<meta name="viewport" content="width=1024, initial-scale=0.75, maximum-scale=1.0, user-scalable=1"/>
<link rel="stylesheet" href="style.css?ver=1.01"/>
<link rel="stylesheet" type="text/css" href="../css/jquery.tipsy.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.nyromodal.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
<script type="text/javascript" src="../js/jquery.nyromodal.js"></script>
<script src="style.js?ver=1.02"></script>
<script>
user = '<?php echo "$fetch->username"; ?>';
checkOpen = true;
timesetter = new Date(2014,10-1,17,01,17,28);
</script>
<script type="text/javascript">
		if ( window.self !== window.top ) { window.top.location=window.self.location; }
var new_load=1;
var username="<?php echo "$fetch->username"; ?>";
$(document).ready(function (){
$("#username").val(username);
$("#notice").hide();
$("#notice").fadeIn(5000);

$("#widgetBackground").click(function (){
    $("#widget").toggle();
});
$('.modal_box').nyroModal();

});
function pageLoaded(location){
	location=location.split("/");
	location=location[3];
	location=location.replace("?", "!!");
	location=location.replace("&", "!");
	location=location.replace("/", "");
	if(typeof parent.history.replaceState == 'function'){
		parent.history.replaceState({location: ''+location+''}, "thug-paradise.com", "?page="+location);
	}
	window.frames['mainFrame'].$(document).ready(function (){
	window.frames['mainFrame'].$('.modal_box').tipsy({gravity: 'se', live: true, html: true});
	window.frames['mainFrame'].$('.hover_info').tipsy({gravity: 'se', live: true, html: true});
	window.frames['mainFrame'].$('.modal_box').click(function(){
	parent.$.nmManual($(this).attr("href"));
	return false;
	});
	parent.$(window).resize(function (){
		if($.nmTop()){
			clearTimeout(timer);
			var timer=setTimeout("parent.$.nmTop().resize()", 500);
		}
	});
	});
}
function loadModal(){
	window.frames['mainFrame'].$('.modal_box').click(function(){
		parent.$.nmManual($(this).attr("href"));
		return false;
	});

}
$('.hover').tipsy({gravity: 'se', live: true});
function widgetLoaded(){
    if(new_load == 1){
        new_load=0;
    } else {
        $("#widget").toggle();
    }
}


</script>
<script type="text/javascript">
$('.refresh-this-frame').click(function() {
    var thisIframe = $(this).attr('rel');
    var currentState = $(thisIframe).attr('src');
    function removeSrc() {
        $(thisIframe).attr('src', '');
    }
    setTimeout (removeSrc, 100);
    function replaceSrc() {
        $(thisIframe).attr('src', currentState);
    }
    setTimeout (replaceSrc, 200);
});
</script>
<style type="text/css">
iframe {
	border: 0;
}
.nyroModalBg{
	z-index:4;
}
table {
	border:0;
}

#notice {
	position: absolute;
	right: 5px;
	bottom: 5px;
	width: 270px;
	height: 112px;
	background-color: #171717;
	border: 1px solid #333333;
}
#notice_title { 
	font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	line-height: 47px;
	padding-left: 15px;
	width: 120px;
	float: left;
}
#notice_subnotice { 
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #515151;
	line-height: 47px;
	padding-right: 15px;
	float: right;
	font-style: italic;
}
.notice_row {
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #515151;
	padding: 3px 10px 3px 10px;
	border-top: 1px solid #333333; 
	border-bottom: 1px solid #333333; 
	background-color: #0E0E0E;
	margin-bottom: 1px;
}
.notice_blue_row {
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #919191;
	padding: 3px 10px 3px 10px;
	border-top: 1px solid #333333; 
	border-bottom: 1px solid #333333; 
	background-color: #17233E;
	margin-bottom: 1px;
}
#widget{
	display:none;
}
#widgetFrame {
	position: absolute;
	top: 24px;
	left: 90px;
	z-index: 99;
	background-color: #1b1b1b;
	border: 1px solid #333333;
}
#widgetBackground {
    position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
    background-color: #000;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}
#reconnectBackground {
    position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
    background-color: #000;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}
#reconnectContainer {
    position: absolute;
    top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
}
#reconnectBox {
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 200px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#reconnectedBox{
    display: none;
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 200px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#sessionLostBox {
	display: none;
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 350px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#blanktable {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px; 
	font-style: normal;
	border: 0px;
	border-collapse: collapse;
	padding: 5px;
}
#sessionLostBox td {
	color: #888;
	font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
.textinput {
	background-color: #111;
	color: #888;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	height: 22px;
	border: 1px solid #333;
	padding:1px;
	padding-left:3px;
	padding-right: 3px;
}
.button {
	background: url(../images/design/subhead.png) repeat-x;
	border: 1px solid #505050;
	font: 10px Arial, Helvetica, sans-serif;
	font-weight: bold;
	height: 24px;
	display: block;
	width: 100px;
	color: #cccccc;
	text-align: center;
	padding-top: 0;
	border: 0;
	cursor: pointer;
}
#reconnect {
    display: none;
}
#mailBlend {
	background-image: url(images/mail_blend.png);
	position: absolute;
	top: 2px;
	left: 65px;
	width: 25px;
	height: 27px;
	z-index: 100;
}
.interface_layer {
	position:absolute;
	top:0;
	left:0;
	padding:0;
	margin:0;
	width:100%;
	height:100%;
}
#user_interface {
	z-index: 2;
}
#loading { 
	z-index: 1;
}
#mainFrame, #leftFrame {
	background-color: transparent;
}
#body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	}
</style>
</head>
<link rel="shortcut icon" href="../images/lolo.png">
<body>
<header id="header">
<h1>Thug Paradise</h1>
<img src="se.png" alt="TP logo"/>
</header>
<menu id="notifications" class="controlMenu" type="list">
</menu>
<menu id="people" class="controlMenu" type="list">
</menu>
<menu id="inbox" class="controlMenu">
<li><a href="../sendmessage.php" target="mainFrame">Send Message</a></li>
<li><a href="../clear_inbox.php" target="mainFrame">Clear Inbox</a></li>
</menu>
<menu id="options" class="controlMenu">
<li><a href="../inbox.php" target="mainFrame">Blocked players</a></li> 
<li><a href="../editprofile.php" target="mainFrame">Edit Profile</a></li>
<li><a href="../casinoban.php" target="mainFrame">Gamblers Anonymous</a></li>
</menu>
<section id="top">
<ul class="controls left">
<li id="msgs"><a href="../inbox.php" target="mainFrame"></a></li>
<li id="friends"><a href="../friends.php" target="mainFrame"></a></li>
<li id="notis"><a href="../noti.php" target="mainFrame"></a></li>
</ul>
<div id="stats" class="colours high">
<table cellpadding="0" cellspacing="0" height="22">
<tr>
<th>User:</th>
<td id="user" data-title="User"><a href="../profile.php?viewing=<?php echo "$fetch->username"; ?>" target="mainFrame"><?php echo "$fetch->username"; ?></a></td>
<th>Rank:</th>
<td id="rank" data-title="Rank&nbsp;-&nbsp;<?php echo "".makecomma($percent).""; ?>%<br /><div class='progress'><div class='width' style='width: <?php echo "$percent"; ?>%'></div></div>"><a href="../tutorial.php#ranks" target="mainFrame"><?php echo "$fetch->rank"; ?></a></td>
<th>Health:</th>
<td id="health" data-title="Health"><a href="../hospital.php" target="mainFrame"><?php echo "$fetch->health"; ?>%</a></td>
<th>Gang:</th>
<td id="gang" data-title="Gang"><a href="../gangs.php" target="mainFrame"><font color='99CCFF'><?php
if($fetch->crew == "0") { echo "<b><font color='#99CCFF'>None</font>"; }
elseif($fetch->crew != "0") { echo "<b><font color='99CCFF'>$fetch->crew</font>"; } ?> 
</font></td>
<th>Cash:</th>
<td id="cash" data-title="Cash"><a href="../bank.php" target="mainFrame"><?php echo "&pound;".makecomma($fetch->money).""; ?></a></td>
<th>Credits:</th>
<td id="credits" data-title="Credits"><a href="../creditsNew.php" target="mainFrame"><?php echo "".makecomma($fetch->credits).""; ?><span class="c">C</span></a></td>
<th>Country:</th>
<td id="country" data-title="Country"><a href="../travel.php" target="mainFrame"><?php echo "$fetch->location"; ?></a></td>
<td id="refresh" data-title="Instant stats update">Refresh</td>
</tr></iframe>
</table>
</div>
<ul class="controls right">
<li id="radio" data-title="TP&nbsp;Radio&nbsp;(TPR)"><a href="../radio.php"></a></li>
<li id="settings"><a href="../editprofile.php" target="mainFrame"></a></li>
<li id="logout" data-title="Logout"><a href="../index.php?logout=yes"></a></li>
</ul>
</section>
<nav id="topNav">
<ul>
<li>
<ul id="players">
<li><a href="../online.php" target="mainFrame"><?php echo"$num"; ?> Online</a></li>
<li><a href="../search.php" target="mainFrame">Find Player</a></li>
</ul>
</li>
<li>
<ul id="statistics">
<li><a href="../statistics.php" target="mainFrame">World Stats</a></li>
<li><a href="../properties.php" target="mainFrame">Domination</a></li>
<li><a href="../celebs1.php" target="mainFrame">Leaderboard</a></li>
<li><a href="../mystats.php" target="mainFrame">My Stats</a></li>
</ul>
</li>
<li>
<ul id="community">
<li><a href="../forum.php?forum=main" target="mainFrame">The Forum</a></li>
<li><a href="../soon.php" target="mainFrame">TP Chat</a></li>
<li><a href="../forum.php?forum=oc" target="mainFrame">OC Forum</a></li>
<li><a href="../forumbm.php?forum=sale" target="mainFrame">Black Market</a></li>
<li><a href="../forum.php?forum=crew" target="mainFrame">Gang Forum</a></li>
</ul>
</li>
<li>
<ul id="profile">
<li><a href="../profile.php?viewing=<?php echo "$fetch->username"; ?>" target="mainFrame">My Profile</a></li>
<li><a href="../editprofile.php" target="mainFrame">Edit Profile</a></li>
<li id="notepad"><a href="../notepad.php">Notepad</a></li>
</ul>
</li>
<li>
<ul id="help">
<li><a href="../helpc.php" target="mainFrame">Help Centre</a></li>
<li><a href="../sendmessage.php?page=send&fromper=Kartel" target="mainFrame" data-title="Any questions on playing the game">Help Desk</a></li>
<li><a href="../support.php" target="mainFrame" data-title="Complex support queries, such as purchase problems, reporting cheats, website problems, staff problems etc">TP Support</a></li>
</ul>
</li>
<li>
<ul id="creds">
<li><a href="../creditsNew.php" target="mainFrame">Use Credits</a></li>
<li><a href="../buycredits.php" target="mainFrame">Buy Credits</a></li>
</ul>
</li>
</ul>
</nav>
<nav id="sideNav">
<ul>
<li id="information">
<h2>Information</h2>
<ul>
<li><a href="../news.php" target="mainFrame">News</a></li>
<li><a href="../hitlist.php" target="mainFrame">Hitlist</a></li>
<li><a href="../witness.php" target="mainFrame">Witnesses</a></li>
<li><a href="../missions.php" target="mainFrame">Missions</a></li>
<li><a href="../fugi.php" target="mainFrame">Fugitives</a></li>
<li><a href="../rewards.php" target="mainFrame">Daily Rewards</a></li>
<li><a href="../graft.php" target="mainFrame">Grafting</a></li>
</ul>
</li>
<li id="crimes">
<h2>Crimes</h2>
<ul>
<li><a href="../crime2.php" target="mainFrame">Commit Crime</a></li>
<li><a href="../gta2.php" target="mainFrame">GTA</a></li>
<li><a href="../boatcrime.php" target="mainFrame">Boat Hi-Jacking</a></li>
<li><a href="../drugs.php" target="mainFrame">Drug Cartel</a></li>
<li><a href="../garage.php" target="mainFrame">Garage</a></li>
<li><a href="../jail.php" target="mainFrame">Jail</a></li>
 
 
<li><a href="../hospital.php" target="mainFrame">Hospital</a></li>
<li><a href="../test.php" target="mainFrame">Organised Crime</a></li>
<li><a href="../safe.php" target="mainFrame">Safehouse</a></li>
<li><a href="../graveyard.php" target="mainFrame">Graveyard</a></li>
<li><a href="../Muscle.php" target="mainFrame">Muscle</a></li>
<li><a href="../kill2.php" target="mainFrame">Search &amp; kill</a></li>
<li><a href="../riots.php3" target="mainFrame">Riots</a></li>
</ul>
</li>
<li id="business">
<h2>Business</h2>
<ul>
<li><a href="../gangs.php" target="mainFrame">Gangs</a></li>
<li><a href="../shop.php" target="mainFrame">Shopping</a></li>
<li><a href="../inventory.php" target="mainFrame">Inventory</a></li>
<li><a href="../travel.php" target="mainFrame">Travel</a></li>
<li><a href="../soon.php" target="mainFrame">Stock Exchange</a></li>
<li><a href="../bank.php" target="mainFrame">Bank</a></li>
<li><a href="../deal.php" target="mainFrame">Deal</a></li>
</ul>
</li>
<li id="gambling">
<h2>Gambling</h2>
<ul>
<li><a href="../soon.php" target="mainFrame">Premier League</a>&nbsp;<span style="color:red">*</span></li>
<li><a href="../bshop.php" target="mainFrame">Betshop</a></li>
<li><a href="../blackjack.php" target="mainFrame">BlackJack</a></li>
<li><a href="../rps.php" target="mainFrame">RPS</a></li>
<li><a href="../racetrack.php" target="mainFrame">Racetrack</a></li>
<li><a href="../abc.php" target="mainFrame">50/50</a></li>
<li><a href="../roulette.php" target="mainFrame">Roulette</a></li>
<li><a href="../slots.php" target="mainFrame">Slots</a></li>
</ul>
</li>
</ul>
</nav>
<time id="clock"></time>
<article id="main">
<noscript><p><a href="http://www.boutell.com/newfaq/definitions/javascript.html">JavaScript</a> MUST be enabled for TP to work. <a href="../index.php">You can always use our old layout?</a></p></noscript>
<iframe src="../news.php" style="width:100%; height:100%;" frameBorder="0" name="mainFrame" id="mainFrame" allowtransparency="true"></iframe>
</article>
</body>
</html>