<?php
session_start();
include_once "incfiles/connectdb.php";

if ( strip_tags( isset( $_GET[ 'logout' ] ) ) == "yes" ) {
	session_destroy();
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
} elseif ( isset( $_SESSION[ 'username' ] ) ) {
	echo "<meta http-equiv='refresh' content='0;url=index3.php'>";
	exit();
}

elseif ( isset( $_SESSION[ 'username' ] ) == "Dead" ) {
	echo "<meta http-equiv='refresh' content='0;url=dead.php'>";
}

$mostever = mysqli_fetch_object( mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'" ) );
$cc = explode( "-", ( isset( $mostever->onlinec ) ) );
/*$cc1 = $cc[0];
$cc2 = $cc[1];
$cc3 = $cc[2];
$cc4 = $cc[3];
$cc5 = $cc[4];*/

$cc1 = isset( $cc[ 0 ] ) ? $cc[ 0 ] : null;
$cc2 = isset( $cc[ 1 ] ) ? $cc[ 1 ] : null;
$cc3 = isset( $cc[ 2 ] ) ? $cc[ 2 ] : null;
$cc4 = isset( $cc[ 3 ] ) ? $cc[ 3 ] : null;
$cc5 = isset( $cc[ 4 ] ) ? $cc[ 4 ] : null;

$most_online = mysqli_fetch_object( mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'" ) );
$timenow = time();
$now_online = mysqli_num_rows( mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow'" ) );
if ( $now_online > $most_online->online ) {
	mysqli_query( $connection, "UPDATE stats SET online='$now_online' WHERE id='1'" );
}

if ( isset( $_POST[ 'Submit' ] ) ) {
	if ( empty( $_POST[ 'username' ] ) || empty( $_POST[ 'password' ] ) ) {
		$message = "Please fill in all of the fields.";
	} else {
		/**
if ( isset( $_POST[ 'Submit' ] ) && strip_tags( $_POST[ 'username' ] ) && strip_tags( $_POST[ 'password' ] ) ) {
*/
		$username = addslashes( strip_tags( $_POST[ 'username' ] ) );
		$password = addslashes( strip_tags( $_POST[ 'password' ] ) );
		$ip = $_SERVER[ 'REMOTE_ADDR' ];

		$sql = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' AND password='$password' AND activated='1' LIMIT 1" );
		$login_check = mysqli_num_rows( $sql );
		$inf = mysqli_fetch_object( $sql );

		if ( $login_check == "0" ) {
			$message = "<center>Incorrect username or password.</center>";
		} elseif ( $login_check != "0" ) {

			if ( $login_check > "0" ) {

				if ( $inf->status == "Dead" ) {
					$_SESSION[ 'dead' ] = $inf->username;
					header( "Location: dead.php" );
					echo "<meta http-equiv='refresh' content='0;url=dead.php'>";
					exit();
				}

				if ( $inf->status == "Banned" ) {
					$encoded = md5( strtolower( $username ) );
					echo "<meta http-equiv='refresh' content='0;url=dead.php'>";
					exit();
				}
				unset( $_SESSION[ 'dead' ] );
				session_start( 'username' );
				$_SESSION[ 'username' ] = $inf->username;

				$ip = $_SERVER[ 'REMOTE_ADDR' ];
				$timestamp = time() + 60;

				mysqli_query( $connection, "UPDATE accounts SET online='$timestamp' WHERE username='$username'" );
				mysqli_query( $connection, "UPDATE stats SET allonline=allonline+1 WHERE id='1'" );
				mysqli_query( $connection, "UPDATE accounts SET l_ip='$ip' WHERE username='$username'" );

				if ( $inf->passwordchanged == '0' ) {
					header( "Location: force_pw_change.php" );
				} else {
					if ( mysqli_real_escape_string( $_POST[ 'layout' ] ) == "new" ) {
						header( "Location: index3/" );
					} else {
						header( "Location: index3.php" );
					}
				}
			}
		}
	}
}



$ip = $_SERVER[ 'REMOTE_ADDR' ];
$getip = mysqli_query( $connection, "SELECT * FROM `adminbans` WHERE `ip` = '$ip'" );

if ( mysqli_num_rows( $getip ) > 0 ) {
	die( "<center><b>Banned From TP!</b></center>" );
}

$username = "";
$query = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'" );
$fetch = mysqli_fetch_object( $query );

$timenow = time();
$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' ORDER by id" );
$num = mysqli_num_rows( $select );
while ( $i = mysqli_fetch_object( $select ) )

	$ud = mysqli_num_rows( mysqli_query( $connection, "SELECT * FROM accounts" ) );
$dead = mysqli_num_rows( mysqli_query( $connection, "SELECT username FROM accounts WHERE status = 'Dead'" ) );
$alive = mysqli_num_rows( mysqli_query( $connection, "SELECT username FROM accounts WHERE status != 'Dead'" ) );

function makecomma( $input ) {
	if ( strlen( $input ) <= 3 ) {
		return $input;
	}
	$length = substr( $input, 0, strlen( $input ) - 3 );
	$formatted_input = makecomma( $length ) . "," . substr( $input, -3 );
	return $formatted_input;
}
?>
</center>

<html>

<head>
	<title>Thug Paradise 2 | Please Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="style.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
		}
		
		#what {
			padding: 0px;
			margin: 0px;
			position: absolute;
			width: 143px;
			height: 143px;
			right: 0;
			top: 0;
		}
		
		label {
			float: left;
			width: 48%;
			text-align: right;
			padding-top: 5px;
			font-weight: bold;
		}
		
		form {
			padding: 0;
			margin: 0;
		}
		
		#leaderboard {
			text-align: center;
			position: absolute;
			position: fixed;
			bottom: 0;
			height: 30px;
			overflow: hidden;
			width: 100%;
			background: #222;
			background: -moz-linear-gradient(top, #222 0%, #000000 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #222), color-stop(100%, #000000));
			filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#222222', endColorstr='#000000', GradientType=0);
			background: -o-linear-gradient(top, #222222 0%, #000000 100%);
		}
		
		#leaderboard .tableborder {
			font-size: 11px;
			background-color: transparent;
		}
		
		#leaderboard:hover {
			border-top: 1px solid #444;
			height: auto;
		}
		
		#leaderboard:hover h1 {
			display: none;
		}
		
		#leaderboard h1 {
			margin: 0;
			margin-top: 4px;
			margin-bottom: 8px;
			padding: 0;
			font-size: 16px;
		}
		
		#leaderboard th.tableborder {
			font-size: 13px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		
		#lbError {
			margin: 10px 0;
			color: red;
			padding: 5px;
			border: 2px solid red;
		}
		
		#leaderboard table table tr:first-child td {
			color: red;
		}
		
		#leaderboard table .tableborder {
			text-align: left;
		}
		
		.extraPadding {
			padding-left: 50px;
		}
		
		#leaderboard .custombutton {
			margin-left: 20px;
		}
	</style>
	<!--[if lte IE 6]>
<script type="text/javascript" src="png.js"></script>
<![endif]-->
	<link rel="shortcut icon" href="images/lolo.png">
	<style type="text/css">
		.style1 {
			color: #FF0000
		}
	</style>
</head>

<body>
	<div align="center">
		<table width="220" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><img src="images/tpbanner.png" width="1009" height="100">
				</td>
			</tr>
			<tr>
				<td background="#000000" class="table1px">
					<div align="center">
						<p>Welcome Thug! You can enter one of the quickest-growing games on the web right now by <a href="register.php">registering</a>. <br> If you are a returning member of Thug Paradise then please login using the lovely form below.
						</p>
					</div>
				</td>
			</tr>
		</table>
		<br>
		<?php echo "<span class=style5> $message</span>"; ?>


		<div align="center">
			<table width="1000" border="0" cellpadding="2" cellspacing="2">
				<tr valign="middle">

					<td width="285" height="381" style="border-width : 0px;">
						</br>
						<div align="center">
							<table width="400" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #FFFFFF;">
								<tr>
									<td width="436" height="30" class="gradient">
										<div align="center">Login</div>
									</td>
								</tr>
								<tr>
									<td class="tablebackground">
										<form id="form1" name="form1" method="post" action="">

											<div align="center"><br> Username:
												<input type="text" id="username" name="username" class="textbox">
											</div>
											<br>
											<div align="center">Password:
												<input type="password" name="password" class="textbox">
											</div>
											<br>
											<div align="center">
												Use new social layout? <input type="checkbox" name="layout" value="new"> <br></br>
												<input type="submit" name="Submit" class="custombutton" value="Enter TP" id="Submit">
											</div>
										</form>
										<p align="center"><a href="register.php"><br>
Register</a> | <a href="lostpass.php">I've forgotten my password!</a> | <a href="tos.php">Terms of Service </a><br>
											<br>

											<?php 
$timenow=time() - (60*15);
$select = mysqli_query( $connection,  "SELECT * FROM accounts WHERE online > '$timenow' AND ghostmode='0' AND status='Alive' ORDER by username");
$num = mysqli_num_rows($select); echo "$num"; $newnum = $most_online->online - $num; ?> gangsters are online at this moment <br>
											<br>
											<?php $mostever = mysqli_fetch_object(mysqli_query( $connection,  "SELECT * FROM stats WHERE id='1'"));
$mostever2 = mysqli_fetch_object(mysqli_query( $connection,  "SELECT * FROM stats WHERE id='3'")); ?> Most gangsters ever seen online at once was
											<?php echo "$mostever->online"; ?>.<br>
											<br> BY ENTERING THIS SITE YOU CONFIRM YOU AGREE TO THE <a href="tos.php">TOS</a>.<br> (
											<span class="style1">REVISED 17th September 2012</span>)
											<br>

											<br>
										</p>
									</td>
								</tr>
							</table>
						</div><br/>
						<div align="center"><img src="images/16.png" alt="18+" height="92" width="150">
					</td>
					<td width="299" height="381" style="border-width : 0px;">
						<table width="250" border="0" cellpadding="0" style="float: left;" cellspacing="0" class="table1px">
							<tr>
								<td height="30" class="gradient" align="left">Updates!</td>
							</tr>
							<tr>
								<td align="center" class="table1px">
									<p>I have finally decided to bring back the original TP as there are too many copys of it and people keep telling me to bring back the real one and here it is from now i will be updating every page and making multiple layouts to play with, the game will be fully completed and released officially on the 15/04/2015! - Spread the word, Kartels back!<br><br><img src=images/smilies/cool.gif>
									</p>
									<div align="right">Posted by <i>Kartel</i> on 2099-04-20.</div>
									<div align="left"></div>
								</td>
							</tr>
						</table>
						<div align="center"><img src="images/nigga.png" style="float: right;" alt="TP2" height="351" width="158">
							<img style="float: left;" src="images/radio.png">
					</td>
				</tr>
				<tr valign="middle">
					<td width="285" height="49" style="border-width : 0px;"><br/>
					</td>
					<td width="299" height="49" style="border-width : 0px;"><br/>
					</td>
				</tr>
			</table>
			</div>
			<br></br>
			</div>
			<div id="leaderboard">
				<h1>Real-time Leaderboard</h1>
				<table border="0" cellspacing="0" cellpadding="0" width="90%" align="center">
					<tr>
						<th width="25%" class="tableborder extraPadding">Top Rankers</th>
						<th width="25%" class="tableborder extraPadding">Top Earners</th>
						<th width="25%" class="tableborder extraPadding">Top Murderers</th>
						<th width="25%" class="tableborder extraPadding">Top Criminals</th>
					</tr>
					<tr>
						<td>
							<table border="0" cellspacing="0" cellpadding="0" width="100%">


								<?php
								$xp_query = mysqli_query( $connection, "SELECT * FROM accounts WHERE (`userlevel`='0') OR (`userlevel`='2') OR (`userlevel`='3') ORDER BY rankpoints DESC LIMIT 10" );

								$i = 1;

								while ( $man = mysqli_fetch_object( $xp_query ) ) {

									if ( $i == '1' ) {
										$colour1 = "<font color=red>";
										$colour2 = "</font>";
									} else {
										$colour1 = "";
										$colour2 = "";
									}

									echo "<tr><td class='tableborder extraPadding'>$colour1 $i. $man->username $colour2</td></tr>";
									$i++;
								}
								?>

							</table>
						</td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0" width="100%">
								<?php
								$money_query = mysqli_query( $connection, "SELECT * FROM accounts WHERE (`userlevel`='0') OR (`userlevel`='2') OR (`userlevel`='3') ORDER BY money DESC LIMIT 10" );

								$i = 1;

								while ( $man = mysqli_fetch_object( $money_query ) ) {

									if ( $i == '1' ) {
										$colour1 = "<font color=red>";
										$colour2 = "</font>";
									} else {
										$colour1 = "";
										$colour2 = "";
									}

									echo "<tr><td class='tableborder extraPadding'>$colour1 $i. $man->username $colour2</td></tr>";
									$i++;
								}
								?>
							</table>
						</td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0" width="100%">
								<?php
								$kill_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY kill_skill DESC LIMIT 10" );

								$i = 1;

								while ( $man = mysqli_fetch_object( $kill_query ) ) {

									if ( $i == '1' ) {
										$colour1 = "<font color=red>";
										$colour2 = "</font>";
									} else {
										$colour1 = "";
										$colour2 = "";
									}

									echo "<tr><td class='tableborder extraPadding'>$colour1 $i. $man->username $colour2</td></tr>";
									$i++;
								}
								?>
							</table>
						</td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0" width="100%">
								<?php
								$jail_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY busts DESC LIMIT 10" );

								$i = 1;

								while ( $man = mysqli_fetch_object( $jail_query ) ) {

									if ( $i == '1' ) {
										$colour1 = "<font color=red>";
										$colour2 = "</font>";
									} else {
										$colour1 = "";
										$colour2 = "";
									}

									echo "<tr><td class='tableborder extraPadding'>$colour1 $i. $man->username $colour2</td></tr>
</tr>";
									$i++;
								}
								?>
							</table>
						</td>
					</tr>
				</table>
			</div>
</body>

</html>