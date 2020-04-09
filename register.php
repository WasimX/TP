<?php
session_start();
include_once "incfiles/connectdb.php";

$rand1 = rand( 0, 10 );
$rand2 = rand( 0, 10 );
$answer = $rand1 + $rand2;

if (isset($_POST[ 'SubmitReg' ] )) {
	$additional08989 = addslashes( $_POST[ 'additional' ] );
	$ref = addslashes( strip_tags( $_POST[ 'ref' ] ) );
	$ref = addslashes( $_POST[ 'ref' ] );
	$ref = addslashes( trim( $ref ) );
	$ref = addslashes( stripslashes( $ref ) );
	$answer = addslashes( $_POST[ 'equals' ] );
	$register_user = addslashes( $_POST[ 'register_user' ] );
	$register_pass = addslashes( $_POST[ 'register_pass' ] );
	$register_pass2 = addslashes( $_POST[ 'register_pass2' ] );
	$register_gender = addslashes( $_POST[ 'register_gender' ] );
	$register_email = addslashes( $_POST[ 'register_email' ] );
	$register_email2 = addslashes( $_POST[ 'register_email2' ] );
	$register_location = addslashes( strip_tags( $_POST[ 'register_location' ] ) );
	$register_user = addslashes( trim( $register_user ) );
	$register_pass = addslashes( trim( $register_pass ) );
	$today = gmdate( 'Y-m-d H:i:s' );
	$register_user = addslashes( stripslashes( $register_user ) );
	$register_email = addslashes( stripslashes( $register_email ) );
//	$quote = addslashes( stripslashes( $quote ) );
	$register_user = addslashes( strip_tags( $register_user ) );
	$register_email = addslashes( strip_tags( $register_email ) );

	$number = $_POST[ 'equals' ];
	$allowed_gens = array( 'Unknown', 'Male', 'Female' );

	if ( $register_gender == '' ) {
		$register_gender = 'Unknown';
	}

	if ( !in_array( $register_gender, $allowed_gens ) ) {
		echo "invalid gender.";
		exit();
	}

	$allowed_locs = array( 'England', 'Pakistan', 'Jamaica', 'America', 'Japan', 'Germany', 'China' );

	if ( !in_array( $register_location, $allowed_locs ) ) {
		echo "invalid location.";
		exit();
	}


	//WTF IS THIS
	if ( $additional08989 != "GANCY78" ) {
		echo "Use your head mate.";
	} elseif ( $additional08989 == "GANCY78" ) {

		if ( ( !$register_user ) || ( !$register_email ) || ( !$register_location ) || ( !$register_pass ) ) {
			$message =  "Please fill in all of the fields.";
		} else {

			if ( $number != "$answers" ) {
				$message =   "The sum does not equal $number.";
			} elseif ( $number == "$answers" ) {

				if ( $register_pass != $register_pass2 ) {
					$message =   "The passwords you entered do not match.";
				} elseif ( $register_pass == $register_pass2 ) {

					if ( $register_email != $register_email2 ) {
						$message =   "The emails you entered do not match.";
					} elseif ( $register_email == $register_email2 ) {

						if ( $register_user == "0" ) {
							$message =   "Unacceptable username.";
						} elseif ( $register_user != "0" ) {

							if ( preg_match( '[^A-Za-z0-9_]', $register_user ) ) {
								$message =   "Your username includes some symbols which are not allowed.";
							} elseif ( !preg_match( '[^A-Za-z0-9 _]', $register_user ) ) {

								if ( strlen( $register_user ) <= 3 || strlen( $register_user ) >= 20 ) {
									$message =   "The username you entered is too big or too small.";
								} elseif ( strlen( $register_user ) > 3 || strlen( $register_user ) < 20 ) {

									$email_check = mysqli_query( $connection, "SELECT email FROM accounts WHERE email='$register_email' AND status='Alive'" );
									$username_check = mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$register_user'" );

									$register_email_check = mysqli_num_rows( $email_check );
									$username_check = mysqli_num_rows( $username_check );

									if ( ( $register_email_check > 0 ) || ( $username_check > 0 ) ) {
										if ( $register_email_check > 0 ) {

											$message =   "The email entered has been recognised in our data, therefore cannot be used.";
											unset( $register_email );
										}

										if ( $username_check > 0 ) {
											$message =   "User already exists";
											unset( $register_user );
										}

									} else {
										$ip = $_SERVER[ 'REMOTE_ADDR' ];

										mysqli_query( $connection, "INSERT INTO `account_info` ( `id` , `username`)
VALUES ('', '$register_user')" )or die( mysqli_error() );

										$time = time();
										$dehour = '43200';
										$protime = time() + ( 3600 * 24 );

										mysqli_query( $connection, "INSERT INTO accounts (`id` , `username` , `password` , `regged`, `gender`, `Refferer`, `email`, `location`, `r_ip`) 

VALUES ('', '$register_user', '$register_pass', '$today', '$register_gender', '$ref', '$register_email', '$register_location', '$ip')" )or die( mysqli_error() );

										mysqli_query( $connection, "INSERT INTO inventory (`id` , `username`) VALUES ('', '$register_user')" )or die( mysqli_error() );

										//header("Location: registerdone.php"); 
										echo "<META http-equiv='refresh' content='0;URL=registerdone.php'>";

									}
								}
							}
						}
					}
				}
			}
		}
	}
}
?>

<?php
$timenow = time();
$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' ORDER by id" );
$num = mysqli_num_rows( $select );
while ( $i = mysqli_fetch_object( $select ) )



//$ud=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts"));
	$dead = mysqli_num_rows( mysqli_query( $connection, "SELECT username FROM accounts WHERE status = 'Dead'" ) );
$alive = mysqli_num_rows( mysqli_query( $connection, "SELECT username FROM accounts WHERE status != 'Dead'" ) );

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Thug Paradise 2 | Register</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="style.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
		}
		
		table {
			margin-left: auto;
			margin-right: auto;
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
		
		.table {
			background-color: #000000;
		}
		
		label {
			float: left;
			width: 48%;
			text-align: right;
			padding-top: 5px;
			font-weight: bold;
			margin-right: 10px;
			clear: both;
		}
		
		select.textbox {
			height: 25px;
		}
		
		.row {
			text-align: left;
		}
		
		.row .text {
			padding-top: 5px;
			padding-bottom: 10px;
		}
		
		.available {
			color: lawngreen;
		}
		
		.notAvailable {
			color: yellow;
		}
		
		#top {
			font-size: 14px;
			font-weight: bold;
			margin: 8px 0;
			text-align: center;
			padding: 8px 0;
			border-top: red 1px solid;
			border-bottom: red 1px solid;
		}
	</style>
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
		}
		
		table {
			margin-left: auto;
			margin-right: auto;
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
		
		#mcafee {
			padding: 0px;
			margin: 0px;
			position: absolute;
			width: 94px;
			height: 54px;
			left: 20px;
			top: 40px;
		}
		
		label {
			float: left;
			width: 48%;
			text-align: right;
			padding-top: 5px;
			font-weight: bold;
			margin-right: 10px;
			clear: both;
		}
		
		.textbox {
			margin-bottom: 5px;
			height: 15px;
			padding: 3px;
			font-size: 11px;
			border: 1px solid #666;
		}
		
		select.textbox {
			height: 25px;
		}
		
		.row {
			text-align: left;
		}
		
		.row .text {
			padding-top: 5px;
			padding-bottom: 10px;
		}
		
		.available {
			color: lawngreen;
		}
		
		.notAvailable {
			color: yellow;
		}
		
		#top {
			font-size: 14px;
			font-weight: bold;
			margin: 8px 0;
			text-align: center;
			padding: 8px 0;
			border-top: red 1px solid;
			border-bottom: red 1px solid;
		}
	</style>

	<script language="javascript" type="text/javascript">
		<!--
		function popitup( url ) {
			newwindow = window.open( url, 'name', 'height=600,width=600' );
			if ( window.focus ) {
				newwindow.focus()
			}
			return false;
		}
		// -->
		function checkAge() {
			/* the minumum age you want to allow in */
			var min_age = 18;

			/* change "age_form" to whatever your form has for a name="..." */
			var year = parseInt( document.forms[ "form1" ][ "year" ].value );
			var month = parseInt( document.forms[ "form1" ][ "month" ].value ) - 1;
			var day = parseInt( document.forms[ "form1" ][ "day" ].value );

			var theirDate = new Date( ( year + min_age ), month, day );
			var today = new Date;

			if ( ( today.getTime() - theirDate.getTime() ) < 0 ) {
				alert( "You are too young to register to this site!" );
			} else {
				document.form1.submit();
			}
		}
		
		// not working
		 function availability () {
			$( "#register_user" ).blur( function () {
				check = $( this ).val();

				if ( check.length < 3 )
					$( "#availability" ).text( '-' ).removeClass( 'notAvailable available' );
				else {
					$.get( 'register.php', {
						check: check
					}, function ( available ) {
						if ( available )
							$( "#availability" ).text( 'Available!' ).removeClass( 'notAvailable' ).addClass( 'available' );
						else
							$( "#availability" ).text( 'Not available!' ).removeClass( 'available' ).addClass( 'notAvailable' );
					} );
				}
			} );
			$( "#register_user" ).keypress( function () {
				check = $( this ).val();

				if ( check.length < 3 )
					$( "#availability" ).text( '-' ).removeClass( 'notAvailable available' );
			} );

			if ( $( "#register_user" ).val() )
				$( "#register_user" ).blur();
		};
	</script>
</head>

<body onload="document.form1.username.focus()">
	</div>
	<div align="center">
		<div id="what"><a href="http://www.dmca.com/Protection/Status.aspx?ID=98b98291-dd85-467f-a2cb-6a535bf24133" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="//images.dmca.com/Badges/DMCA_badge_trn_100w.png?ID=98b98291-dd85-467f-a2cb-6a535bf24133"  alt="DMCA.com Protection Status" /></a>
			<!--
			DOESNT WORK
			<script src="https://streamtest.github.io/badges/streamtest.js" type="text/javascript"></script>-->
		</div>
		<table width="220" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><img src="images/tpbanner.png" width="1009" height="100">
				</td>
			</tr>

		</table>
		<table>
			<tr>
			<td colspan="2" height="30"align="center"
				<?php echo "<span class=style5> $message</span>"; ?></br></t>
			</tr>
</table>
			<table width="912" height="30" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #FFFFFF;">
				<td colspan="2" class="gradient" height="30">
					<div align="center"><b>Please enter all the information needed below</b>
					</div>
				</td>
			</tr>
			<tr>					
				<td width="456" valign="top" background-color="#000000" class="table1px">
					<form id="form1" name="form1" method="post" action="">
						<div class="row">
							<label for="username">Username:</label>
							<input name="register_user" type="text" class="textbox" id="register_user"/>
						</div>
						<div class="row">
							<label for="availability">Username Availability</label>
							<div id="availability" class="text">-</div>
						</div>
						<div class="row">
							<label for="password">Date Of Birth:</label>
							<select name="day" size="1" class="textbox">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
							<select name="month" size="1" class="textbox">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
							<select name="year" size="1" class="textbox">
								<option value="2020">2020</option>
								<option value="2019">2019</option>
								<option value="2018">2018</option>
								<option value="2017">2017</option>
								<option value="2016">2016</option>
								<option value="2015">2015</option>
								<option value="2014">2014</option>
								<option value="2013">2013</option>
								<option value="2012">2012</option>
								<option value="2011">2011</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
								<option value="2008">2008</option>
								<option value="2007">2007</option>
								<option value="2006">2006</option>
								<option value="2005">2005</option>
								<option value="2004">2004</option>
								<option value="2003">2003</option>
								<option value="2002">2002</option>
								<option value="2001">2001</option>
								<option value="2000">2000</option>
								<option value="1999">1999</option>
								<option value="1998">1998</option>
								<option value="1997">1997</option>
								<option value="1996">1996</option>
								<option value="1995">1995</option>
								<option value="1994">1994</option>
								<option value="1993">1993</option>
								<option value="1992">1992</option>
								<option value="1991">1991</option>
								<option value="1990">1990</option>
								<option value="1989">1989</option>
								<option value="1988">1988</option>
								<option value="1987">1987</option>
								<option value="1986">1986</option>
								<option value="1985">1985</option>
								<option value="1984">1984</option>
								<option value="1983">1983</option>
								<option value="1982">1982</option>
								<option value="1981">1981</option>
								<option value="1980">1980</option>
								<option value="1979">1979</option>
								<option value="1978">1978</option>
								<option value="1977">1977</option>
								<option value="1976">1976</option>
								<option value="1975">1975</option>
								<option value="1974">1974</option>
								<option value="1973">1973</option>
								<option value="1972">1972</option>
								<option value="1971">1971</option>
								<option value="1970">1970</option>
								<option value="1969">1969</option>
								<option value="1968">1968</option>
								<option value="1967">1967</option>
								<option value="1966">1966</option>
								<option value="1965">1965</option>
								<option value="1964">1964</option>
								<option value="1963">1963</option>
								<option value="1962">1962</option>
								<option value="1961">1961</option>
								<option value="1960">1960</option>

							</select>
						</div>
						<div class="row">
							<label for="password">Password:</label>
							<input name="register_pass" type="password" class="textbox" id="register_pass"/>
						</div>
						<div class="row">
							<label for="password2">Verify Password:</label>
							<input name="register_pass2" type="password" class="textbox" id="register_pass2"/>
						</div>
						<div class="row">
							<label for="username">Email:</label>
							<input name="register_email" class="textbox" type="text" id="register_email" value="" size="20">
						</div>
						<div class="row">
							<label for="email2">Verify Email:</label>
							<input name="register_email2" class="textbox" type="text" id="register_email2" value="" size="20">
						</div>
						<div class="row">
							<label for="gender">Gender:</label>
							<select style="border: none;" name="register_gender" id="register_gender" class="textbox">
								<option value="Unknown">Unknown</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="row">
							<label for="country">Country:</label>
							<select name="register_location" class="textbox" id="register_location" style="border: none;" class="custombutton">
								<option value="England">England</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Jamaica">Jamaica</option>
								<option value="China">China</option>
								<option value="America">America</option>
								<option value="Japan">Japan</option>
								<option value="Germany">Germany</option>
							</select>
						</div>
						<input name="ref" type="hidden" class="textbox" id="ref" value='<?php print $_GET[' referral ']; ?>' onKeyUp="goReg(this.value, this.name); return true;"/>
						<div class="row">
							<label for="country">
								<?php echo "$rand1 + $rand2"; ?> = </label>
							<input name="equals" class="textbox" type="text" id="equals" value="" size="10">
						</div>


						<p align="center">
							You must have read the <a href="tos.php">TERMS OF SERVICE</a><br/> We'll drop you an email every now and again to keep you updated.
							<br/>
							<br/>
							<input name="SubmitReg" type="submit" class="custombutton" id="button" value="Register"/>
							<input type="hidden" name="additional" value="GANCY78">
							<input type="hidden" name="answers" value="<?php echo " $answer "; ?>">
						</p>
					</form>
				</td>
				<td width="456" valign="top" class="tablebackground">
					<div align="left" class="tableborder2">
						<p>Just want to contact us without registering? Email: support@thug-paradise.com
							<p>Please do<strong> not include any explicit usernames, </strong>this will result in your account being &quot;killed&quot;, removed from the game.</p>
							<p>Please use a <strong>complicated password</strong> including letters (uppercase and lowercase) and numbers.</p>
							<p>The Country you choose to start in is <strong>not permanent</strong>, you can always travel somewhere else after you login and earn some money.</p>
							<p>Please enter your correct email address, as this may be needed if you forget your password. Try to avoid <strong>MSN email addresses</strong> if possible, as these are the least secure.</p>
							<p>TP is entirely free to play. There are no hidden costs, advertisements, viruses, adware or spyware.<br></p>
						<p align="center"><img src="images/16.png" alt="18+" width="150" height="92"> </p>
					</div>
				</td>
			</tr>
		</table>
		<p>Game admin is Cartel Palmer AKA Kartel (in-game)</p>
		<p><strong>Please do not make more than one account. You are ONLY allowed to make another account if you die!<br>
  We can tell if you have made more than one! </strong>
		</p>
	</div>
</body>

</html>


<script language=JavaScript>
	<!--
	//Disable right mouse click Script
	//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
	//For full source code, visit http://www.dynamicdrive.com

	var message = "You cant Right Click On This Page.";

	function clickIE4() {
		if ( event.button == 2 ) {
			alert( message );
			return false;
		}
	}

	function clickNS4( e ) {
		if ( document.layers || document.getElementById && !document.all ) {
			if ( e.which == 2 || e.which == 3 ) {
				alert( message );
				return false;
			}
		}
	}


	if ( document.layers ) {
		document.captureEvents( Event.MOUSEDOWN );
		document.onmousedown = clickNS4;
	} else if ( document.all && !document.getElementById ) {
		document.onmousedown = clickIE4;
	}
	document.oncontextmenu = new Function( "alert(message);return false" )
</script>