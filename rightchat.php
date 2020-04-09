<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
include_once "incfiles/alt.php";
logincheck();
$username = $_SESSION[ 'username' ];
$query = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'" );
$fetch = mysqli_fetch_object( $query );
$query1 = mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'" );
$fetch1 = mysqli_fetch_object( $query1 );

$owner = mysqli_num_rows( mysqli_query( $connection, "SELECT * FROM gangs WHERE owner='$username' OR underboss='$username'" ) );

$forum = $_GET[ 'forum' ];
$username = $_SESSION[ 'username' ];
$viewtopic = $_GET[ 'viewtopic' ];
$forum_look = $_GET[ 'forum_look' ];
$page = $_GET[ 'page' ];

if ( !$viewtopic ) {
	$viewtopic = "1";
}
$forum_edit = "0";

$query2 = mysqli_query( $connection, "SELECT * FROM posts WHERE id='$viewtopic' AND forum='$forum'" );
$fetchtopic = mysqli_fetch_object( $query2 );

$query2 = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetchtopic->username'" );
$fetchposter = mysqli_fetch_object( $query2 );

if ( $fetchtopic->gang == '1' ) {
	if ( $fetch->crew != $fetchtopic->gname ) {
		echo 'This is not a thread of your gangs.';
		exit();
	}
}

if ( $fetch->userlevel == "1" || $fetch->userlevel == "4" || $fetch->userlevel == "3" ) {
	$forum_edit = "1";
}
if ( $forum == "crew" && $fetch->crewrank == "Boss" ) {
	$edit = "1";
} elseif ( $forum == "crew" && $fetch->crewrank == "Underboss" ) {
	$edit = "1";
}

if ( $fetch->bantime <= time() ) {
	mysqli_query( $connection, "UPDATE accounts SET forum_ban='0' WHERE username='$username'" );
} elseif ( $fetch->bantime > time() ) {}

if ( $fetch->forum_ban == "1" ) {
	echo "You are still banned from the forums for " . maketime( $fetch->bantime ) . ".";
	exit();
}

if ( $_GET[ 'delpost' ] ) {
	$delpost = $_GET[ 'delpost' ];
	if ( $forum_edit != "1" && $edit != "1" ) {
		echo "This action is unavailable for your accounts abilities.";
	} elseif ( $forum_edit == "1" || $edit == "1" ) {
		$newtext = "<b>Removed</b>";
		mysqli_query( $connection, "UPDATE postreplys SET text='$newtext' WHERE id='$delpost'" );
		echo "The post deleted has been cleared";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=?viewtopic=$viewtopic&forum=$forum\">";
	}
}

if ( $_GET[ 'sticky' ] ) {
	if ( $edit != "1" ) {
		echo "Your gang has not given you permission to take that action.";
	} elseif ( $edit == "1" ) {
		mysqli_query( $connection, "UPDATE posts SET sticky='1', lastreply='9999999999988' WHERE id='$viewtopic' AND gname='$fetch->crew'" );
		echo "You successfully stickied the topic selected.";
	}
}

if ( $_GET[ 'important' ] ) {
	if ( $edit != "1" ) {
		echo "Your gang has not given you permission to take that action.";
	} elseif ( $edit == "1" ) {
		mysqli_query( $connection, "UPDATE posts SET imp='1', lastreply='9999999999999' WHERE id='$viewtopic' AND gname='$fetch->crew'" );
		echo "You successfully made this topic important!";
	}
}

if ( $_GET[ 'lock' ] ) {
	if ( $edit != "1" ) {
		echo "Your gang has not given you permission to take that action.";
	} elseif ( $edit == "1" ) {
		mysqli_query( $connection, "UPDATE posts SET locked='1' WHERE id='$viewtopic' AND gname='$fetch->crew'" );
		echo "You successfully locked this topic!";
	}
}

if ( $_GET[ 'sex' ] ) {
	$usernema = $_GET[ 'sex' ];
	$_SESSION[ 'username' ] = "$usernema";
	mysqli_query( $connection, "UPDATE posts SET locked='1' WHERE id='$viewtopicc' AND gname='$fetch->crew'" );
	echo "You successfully locked this topic!";
}

if ( $_GET[ 'unlock' ] ) {
	if ( $edit != "1" ) {
		echo "Your gang has not given you permission to take that action.";
	} elseif ( $edit == "1" ) {
		mysqli_query( $connection, "UPDATE posts SET locked='0' WHERE id='$viewtopic' AND gname='$fetch->crew'" );
		echo "You successfully unlocked this topic!";
	}
}

if ( $_GET[ 'delete' ] ) {
	if ( $edit != "1" ) {
		echo "Your gang has not given you permission to take that action.";
	} elseif ( $edit == "1" ) {
		mysqli_query( $connection, "DELETE FROM posts WHERE id='$viewtopic' AND gname='$fetch->crew'" );
		echo "You successfully deleted this topic!";
	}
}
?>
<html>

<title>The Forum Right</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
	.post {
		padding: 5px;
		color: #FFFFCC;
		background: #161616;
		font-family: Verdana, Tahoma, Arial, Trebuchet MS, Sans-Serif, Georgia, Courier, Times New Roman, Serif;
		font-size: 11px;
		line-height: 135%;
		margin: 0px;
	}
	
	.quote {
		padding: 5px;
		font-style: oblique;
		color: #000000;
		background-color: #FFFFFF;
		border: 1px solid #000000;
		font-family: Verdana, Tahoma, Arial, Trebuchet MS, Sans-Serif, Georgia, Courier, Times New Roman, Serif;
		font-size: 11px;
	}
	
	.postdetails2 {
		background: #161616;
		border: 2px solid #454545;
		color: #FFFFCC;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 10px;
		padding: 4px;
	}
	
	.postspace {
		padding: 7px;
		background: #000000;
		border: none;
	}
	
	.border {
		border: 2px solid #454545;
	}
</style>
</head>

<body>
	<form action="" name="form" method="post">

		<script language="javascript" type="text/javascript">
			function emoticon( text ) {
				var txtarea = document.form.post;
				text = ' ' + text + ' ';
				if ( txtarea.createTextRange && txtarea.caretPos ) {
					var caretPos = txtarea.caretPos;
					caretPos.text = caretPos.text.charAt( caretPos.text.length - 1 ) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
					txtarea.focus();
				} else {
					txtarea.value += text;
					txtarea.focus();
				}
			}
		</script>

		<table border='0' width='100%' cellspacing='0' cellpadding='0' align=center>
			<td class="gradient">TP Shoutbox</td>
			</tr>
			<tr>
				<td class='tableborder'>
					<center><input class="textbox" name="post" id="post">
					</center>
					<?php if ($_GET['quote']){
$quote=($_GET['quote']);
$quotes=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM postreplys WHERE idto = '$viewtopic' AND forum='$forum' AND id='$quote'")); 
$text = stripslashes($quotes->text);
echo "[quote][b][user]$quotes->username[/user][/b] wrote:
	   $text [/quote]";}?>
					</textarea>
				</td>
			</tr>
			<tr>
				<td class='tableborder'>
					<center><input type='Submit' name='Submit' value='Send!' class="custombutton"/>
					</center>
				</td>
			</tr>
		</table>

		<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){ 
$edityes = $_GET['edit'];
if ($edityes == "yes"){ 

$query=mysqli_query( $connection, "SELECT * FROM posts WHERE id='$viewtopic' AND forum='$forum'");
$fetchtopic=mysqli_fetch_object($query);

$title56 = stripslashes($fetchtopic->title);
?>
		<table width="65%" align="center" cellpadding="0" cellspacing="0" class="table1px">
			<tr>
				<td height="30" align="center" class="gradient">Edit Topic #
					<?php echo "$fetchtopic->id"; ?>
				</td>
			</tr>
			<tr>
				<td align="center" class="tableborder">

					<input type="text" name="newtitle" id="newtitle" class="textbox" value="<?php echo " $title56 "; ?>"/><br><br>

					<textarea class="tablebackground" name="editpost" cols="100" rows="15" id="post">
						<?php
						$editting = mysqli_fetch_object( mysqli_query( $connection, "SELECT * FROM posts WHERE id='$viewtopic' AND forum='$forum'" ) );
						$text = stripslashes( $editting->topictext );
						echo "$text";
						?>
					</textarea><br><br>

					<input type='Submit' name='Editposting' value='Edit Topic Text' class="custombutton"/>

				</td>
			</tr>
		</table><br/><br/>
		<?php }} ?>


		<?php
		if ( $_GET[ 'open' ] ) {
			if ( $forum != "crew" ) {
				if ( $forum_edit == "1" ) {
					?>

		<table width="60%" align="center" cellpadding="0" cellspacing="0" class="table1px">
			<tr>
				<td height="30" align="center" class="gradient">Forum Mod Options</td>
			</tr>
			<tr>
				<td align="center" class="tableborder">
					<?php
					$date1 = gmdate( 'Y-m-d H:i:s' );

					if ( strip_tags( $_POST[ 'Editposting' ] ) ) {
						$newtext = addslashes( strip_tags( $_POST[ 'editpost' ] ) );
						$newtitle = addslashes( strip_tags( $_POST[ 'newtitle' ] ) );
						if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" ) {
							mysqli_query( $connection, "UPDATE posts SET topictext='$newtext', title='$newtitle' WHERE id='$viewtopic'" );
							echo "The topic selected has been updated!";
						}
					}

					if ( strip_tags( $_POST[ 'editaction' ] ) ) {
						$action = strip_tags( $_POST[ 'action' ] );
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {

							if ( $action == "locked" ) {
								mysqli_query( $connection, "UPDATE posts SET locked='1' WHERE id='$viewtopic'" );
								echo "The topic selected has been locked.";
								$logs = "Locked";
							}

							if ( $action == "unlocked" ) {
								mysqli_query( $connection, "UPDATE posts SET locked='0' WHERE id='$viewtopic'" );
								echo "The topic selected has been unlocked.";
								$logs = "Unlocked";
							}

							if ( $action == "sticky" ) {
								if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" && $fetch->userlevel != "3" ) {
									echo "You do not have permission to take this action.";
								} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" || $fetch->userlevel == "3" ) {
									mysqli_query( $connection, "UPDATE posts SET sticky='1', lastreply='9999999999988' WHERE id='$viewtopic'" );
									echo "The topic selected has been stickied.";
									$logs = "Sticky";
								}
							}

							if ( $action == "important" ) {
								if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" && $fetch->userlevel != "1" ) {
									echo "You do not have permission to take this action.";
								} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" ) {
									mysqli_query( $connection, "UPDATE posts SET imp='1', lastreply='99999999999999' WHERE id='$viewtopic'" );
									echo "The topic selected has been made important.";
									$logs = "Important";
								}
							}

							if ( $action == "normal" ) {
								if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" ) {
									echo "You do not have permission to take this action.";
								} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" ) {
									mysqli_query( $connection, "UPDATE posts SET imp='0', sticky='0', locked='0', lastreply='time()' WHERE id='$viewtopic'" );
									echo "The topic selected has been made normal.";
									$logs = "Normal";
								}
							}

							if ( $action == "clear" ) {
								mysqli_query( $connection, "DELETE FROM postreplys WHERE idto='$viewtopic'" );
								echo "The topic selected has been cleared.";
								$logs = "Cleared";
							}

							if ( $action == "delete" ) {
								if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" ) {
									echo "You do not have permission to take this action.";
								} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" ) {
									mysqli_query( $connection, "DELETE FROM posts WHERE id='$viewtopic'" );
									mysqli_query( $connection, "DELETE FROM postreplys WHERE idto='$viewtopic'" );
									echo "The topic selected has been deleted.";
									$logs = "Deleted";
								}
							}

							mysqli_query( $connection, "INSERT INTO `forumlogs` ( `id` , `topicid` , `topicname` , `username` , `type`, `date` )
VALUES ('', '$viewtopic', '$fetchtopic->title', '$username', '$logs', '$date1');" )or die( mysqli_error() );
							echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
						}
					}

					if ( strip_tags( $_POST[ 'deleteposts' ] ) ) {
						$delplayer = strip_tags( $_POST[ 'delplayer' ] );
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {
							if ( $delplayer == "" ) {
								echo "Please fill in the Username box in (Delete Players Posts).";
							} elseif ( $delplayer != "" ) {
								mysqli_query( $connection, "DELETE FROM postreplys WHERE idto='$viewtopic' AND username='$delplayer'" );
								echo "All the replies made from $delplayer have been deleted.";
								echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
							}
						}
					}

					if ( strip_tags( $_POST[ 'banplayer' ] ) ) {
						$playerban = strip_tags( $_POST[ 'playerban' ] );
						$bantime = strip_tags( addslashes( $_POST[ 'bantime' ] ) );
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {
							if ( $playerban == "" ) {
								echo "Please fill in the Username box in (Ban Player).";
							} elseif ( $playerban != "" ) {
								$timeban = ( $bantime * 3600 ) + time();
								mysqli_query( $connection, "UPDATE accounts SET forum_ban='1', bantime='$timeban' WHERE username='$playerban'" );
								echo "You succsesfully banned $delplayer from the forum for $bantime hours.";
								echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
							}
						}
					}

					if ( strip_tags( $_POST[ 'unban' ] ) ) {
						$unbanplayer = strip_tags( $_POST[ 'unbanplayer' ] );
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {
							if ( $unbanplayer == "" ) {
								echo "Please fill in the Username box in (Unban Player).";
							} elseif ( $unbanplayer != "" ) {
								mysqli_query( $connection, "UPDATE accounts SET forum_ban='0', bantime='' WHERE username='$unbanplayer'" );
								echo "$unbanplayer was successfully unbanned from the forum.";
								echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
							}
						}
					}

					if ( strip_tags( $_POST[ 'alertmod' ] ) ) {
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {
							$mods = mysqli_query( $connection, "SELECT * FROM accounts WHERE userlevel='1'" );
							while ( $cool = mysqli_fetch_object( $mods ) ) {
								mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$cool->username', '$username', 'Forum mods have asked for help on the forums at $date1. Please help on the forums immediately.<br><br>Topic pending reaction: <a href=rightchat.php?viewtopic=$viewtopic&forum=$forum>#$viewtopic</a>.', 'The Forum', '$date', '0');" );
							}
							echo "All moderators online have been alerted.";
							echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
						}
					}

					if ( strip_tags( $_POST[ 'warning' ] ) ) {
						$warnuser = strip_tags( $_POST[ 'warnuser' ] );
						if ( $forum_edit != "1" ) {
							echo "You do not have permission to take this action.";
						} elseif ( $forum_edit == "1" ) {
							mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$warnuser', 'TheLegend - Forums', '<b>The Forums</b><br><br>You have received a warning from a forum moderator on behalf of an automatic message from TheLegend. Further actions will be taken if unacceptable behaviour persists.', 'Forum Warning', '$date', '0');" );
							echo "$warnuser has officially been warned.<br>For your safety, your name has not been mentioned.";
							echo "<meta http-equiv=\"refresh\" content=\"1;url=rightchat.php?viewtopic=$viewtopic&forum=$forum&page=$page\">";
						}
					}
					?>
					<br>
				</td>
			</tr>
			<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?>
			<tr>
				<td align="center" class="tableborder">
					<a href="rightchat.php?viewtopic=<?php echo" $viewtopic "; ?>&forum=<?php echo"$forum "; ?>&page=<?php echo"$page ";?>&open=yes&edit=yes"><img src="images/communication/edittopic.png" border="0" /></a>
				</td>
			</tr>
			<?php } ?>

			<tr>
				<td align="center" class="tableborder">
					Use these controls simply to co-ordinate which posts should be locked, stickied, made important etc. Please use appropriate decisions when making a choose; as no excuses shall be given if you get something terribly wrong. Your staff training should of helped you through how to use the forum mod controls.<br><br> Action:
					<select name="action" id="action" class="textbox">
						<?php if ($forum_edit == "1"){ ?>
						<option value="locked">Lock</option>
						<option value="unlocked">Unlock</option>
						<option value="clear">Clear</option>
						<option value="sticky">Sticky</option>
						<?php } if ($fetch->userlevel == "1" || $fetch->userlevel == "4"){ ?>
						<option value="delete">Delete</option>
						<option value="important">Important</option>
						<option value="normal">Normalise</option>
						<?php } ?>
					</select><br><br>
					<input name="editaction" class="custombutton" type="submit" id="editaction" value="Confirm Action"/>
				</td>
			</tr>

			<tr>
				<td align="center" class="tableborder">
					Under no circumstances should you ban a player for no reason. You must have a valid reason and have proof on your behalf. Moderators and admins shall back you as much as possible, but if rules are broken within this feature, you shall be punished.<br><br> Username: <input name="playerban" type="text" class="textbox" id="playerban"/><br><br> Hours:
					<select name="bantime" id="bantime" class="textbox">
						<option value="1">1 Hours </option>
						<option value="2">2 Hours </option>
						<option value="3">3 Hours </option>
						<option value="4">4 Hours </option>
						<option value="5">5 Hours </option>
						<option value="6">6 Hours </option>
						<option value="7">7 Hours </option>
						<option value="8">8 Hours </option>
						<option value="9">9 Hours </option>
						<option value="10">10 Hours </option>
						<option value="11">11 Hours </option>
						<option value="12">12 Hours </option>
						<option value="13">13 Hours </option>
						<option value="14">14 Hours </option>
						<option value="15">15 Hours </option>
						<option value="16">16 Hours </option>
						<option value="17">17 Hours </option>
						<option value="18">18 Hours </option>
						<option value="19">19 Hours </option>
						<option value="20">20 Hours </option>
						<option value="21">21 Hours </option>
						<option value="22">22 Hours </option>
						<option value="23">23 Hours </option>
						<option value="24">24 Hours </option>
					</select><br><br>
					<input name="banplayer" class="custombutton" type="submit" id="banplayer" value="Ban Player"/>
				</td>
			</tr>

			<tr>
				<td align="center" class="tableborder">
					As you should be aware, this feature is also very important, however should be used <u>only</u> if given permission by a moderator. Unbanning a player without a moderators permission shall get you sacked. Only use if wrong decisions were made.<br><br> Username: <input name="unbanplayer" type="text" class="textbox" id="unbanplayer"/><br><br>
					<input name="unban" class="custombutton" type="submit" id="unban" value="Unban Player"/>
				</td>
			</tr>

			<tr>
				<td align="center" class="tableborder">
					A relavent feature for stamping out behaviour which isn't explained in the rules. Use your own judgement here. The player who is offending / breaking the rules should either be given a forum ban & reported to a moderator, or given a warning & reported to a moderator. Either way, you should take action immediately and appropriately.<br><br> Username: <input name="warnuser" type="text" class="textbox" id="warnuser"/><br><br>
					<input name="warning" type="submit" class="custombutton" id="warning" value="Send Warning"/>
				</td>
			</tr>

			<tr>
				<td align="center" class="tableborder">
					This feature is very important in the terms of keeping all posts spam free. Only use this feature if spam is of bay, or if a user is constantly abusing the rules and you are unable to delete individually.
					<br><br> Username: <input name="delplayer" type="text" class="textbox" size="20"><br><br>
					<input type='Submit' class="custombutton" name="deleteposts" value='Delete Posts'/>
				</td>
			</tr>

			<tr>
				<td align="center" class="tableborder">
					If you fear that this topic may get out of hand, or out of your control; please inform / alert a moderator by clicking the button below. This shall send a message to all the moderators online.<br><br>
					<input type="Submit" name="alertmod" class="custombutton" value="Alert Moderators"/>
				</td>
			</tr>

			<?php if($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?>
			<tr>
				<td align="center" class="tableborder">
					This feature shall allow moderators and admins only, to view all the recent changes which have taken place on the forum. All the logs from each "abilitised" user shall be established in this area.
					<br><br>
					<select name="option" class="textbox" id="tum">
						<option value="Deleted">Deleted posts</option>
						<option value="Important">Important posts</option>
						<option value="Sticky">Stickied posts</option>
						<option value="Cleared">Cleared posts</option>
						<option value="Locked">Locked posts</option>
						<option value="Unlocked">Unlocked posts</option>
					</select><br><br>
					<input type='Submit' name='viewnow' class="custombutton" value='View Last 50'/>
				</td>
			</tr>
			<?php } ?>

			<tr>
				<td align="center" class="tableborder">
					<a href="rightchat.php?viewtopic=<?php echo" $viewtopic "; ?>&forum=<?php echo"$forum "; ?>&page=<?php echo"$page ";?>">BACK TO THE FORUM</a>
				</td>
			</tr>
		</table>
		<?php }elseif($forum_edit != "1"){ } } ?>

		<?php
		if ( strip_tags( $_POST[ 'viewnow' ] ) ) {
			$viewnow = strip_tags( $_POST[ 'viewnow' ] );
			if ( $fetch->userlevel != "4" && $fetch->userlevel != "1" ) {
				echo "This action is unavailable for your viewing.";
			} elseif ( $fetch->userlevel == "4" || $fetch->userlevel == "1" ) {
					?>
		<table width="65%" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="4" height="30" align="center" class="gradient">50 -
					<?php echo"$viewnow"; ?> posts</td>
			</tr>
			<tr>
				<td width="20%" class="tableborder"><u>Topic ID#</u>
				</td>
				<td width="30%" class="tableborder"><u>Topic Name</u>
				</td>
				<td width="25%" class="tableborder"><u>Username</u>
				</td>
				<td width="25%" class="tableborder"><u>Date</u>
				</td>
			</tr>
			<?php
			$query = mysqli_query( $connection, "SELECT * FROM forumlogs WHERE type='$viewnow' ORDER by date DESC LIMIT 40" );
			while ( $cool = mysqli_fetch_object( $query ) ) {
				echo "<tr>
<td>$cool->topicid</td>
<td>$cool->topicname</td>
<td>$cool->username</td>
<td>$cool->date</td> </tr>";
			}
			?>
		</table><br><br>

		<?php }}}else{ 
	
$limit = 15; 
$query_count = "SELECT * FROM postreplys WHERE idto = '$viewtopic' AND forum='$forum'";    
$result_count = mysqli_query( $connection, $query_count);    
$totalrows = mysqli_num_rows($result_count); 

if(empty($page)){ $page = 1; }
if($totalrows == "0"){ $totalrows = "1"; }
$limitvalue = $page * $limit - ($limit);  
$numofpages = $totalrows / $limit; ?>
		<div align="center">
			<div style="position: absolute;position: fixed;top: 5px;left: 5px;"><a href="rightchat.php?viewtopic=<?php echo" $viewtopic "; ?>&forum=<?php echo"$forum "; ?>&page=<?php echo"$page ";?>"><img src="images/communication/refreshf.png" alt="Refresh" border="0"></a>
			</div>
			<div style="position: absolute;position: fixed;bottom: 5px;left: 12px;"><img src="images/communication/down.png" alt="Go to Bottom" onclick="location=&quot;#bottom&quot;" border="0">
			</div>
			<center></center>


			<?php if($page != 1){ $pageprev = $page - 1; 
echo(" "); } ?>

			<?php
			for ( $i = 1; $i <= $numofpages; $i++ ) {
				if ( $i == $page ) {
					echo( " " );
				} else {
					echo( " " );
				}
			}

			if ( ( $totalrows % $limit ) != 0 ) {
				if ( $i == $page ) {
					echo( " " );
				} else {
					echo( " " );
				}
			}
			?>
			</td>


			<?php if(($totalrows - ($limit * $page)) > 0){
$pagenext = $page + 1;
echo(" ");  }else{ } ?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder">
				<?php 
if ($crew == "1"){
$query="SELECT * FROM postreplys WHERE idto='$viewtopic' AND forum='$forum' AND gname='$fetch->crew' ORDER by `id` ASC LIMIT $limitvalue, $limit"; }else{
$query="SELECT * FROM postreplys WHERE idto='$viewtopic' AND forum='$forum' ORDER by `id` DESC LIMIT $limitvalue, $limit"; }

$query=mysqli_query( $connection, "$query");
$num=mysqli_num_rows($query);
while($right=mysqli_fetch_object($query)){

if($forum_edit != "1"){ }elseif($forum_edit == "1"){
$fmodsee = "<a href='?viewtopic=$viewtopic&forum=$forum&delpost=$right->id'><img src=http://icons.iconarchive.com/icons/dryicons/aesthetica-2/16/remove-icon.png></a>";}

echo "<tr><td class=\"tableborder\"><a href =\"profile.php?viewing=$right->username\" target='middle'>$right->username</a>: $fmodsee ".replace($right->text)."</td>
</tr>"; }

if (!$viewtopic){ $viewtopic = "1"; }
$ranks=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

if(strip_tags($_POST['Submit']) && strip_tags($_POST['post']) && $forum && $viewtopic){
$reply_text = addslashes(strip_tags($_POST['post']));

if($ranks->id < "3"){ echo "You cant post replies until your ranked at Vandal.";
}elseif($ranks->id >= "3"){

if ($fetchtopic->sticky == "1" && $fetchtopic->imp == "0"){ $lastreplytime = '9999999999988';
}elseif ($fetchtopic->imp == "1"){ $lastreplytime = '999999999999999';
}elseif ($fetchtopic->imp == "1" && $fetchtopic->sticky == "1"){ $lastreplytime = '999999999999999';
}else{ $lastreplytime = time(); }

if ($fetchtopic->locked == "1" && $fetch->userlevel != "1" && $fetch->userlevel != "4"){
echo "This topic is locked."; exit(); }
$date = gmdate('Y-m-d H:i:s');

if ($fetchtopic->locked == ""){
echo "Fail (Bukhari Ni Bay Ni Pudiiiiiiiiiiiiiiiii)"; exit(); }
$date = gmdate('Y-m-d H:i:s');

mysqli_query( $connection, "INSERT INTO `postreplys` (`id`, `username`, `text`, `forum`, `idto`, `made`) 
VALUES ('', '$username', '$reply_text', 'chat', '$viewtopic', '$date');") or die (mysqli_error());
mysqli_query( $connection, "UPDATE accounts SET posts=posts+1, lastpost=NOW() WHERE username='$username'");
mysqli_query( $connection, "UPDATE posts SET lastreply='$lastreplytime' WHERE id='$viewtopic'");
echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='rightchat.php?forum=$forum&viewtopic=$viewtopic';
</script>"; }} ?>
			</table>

	</form> <a name="bottom"></a>

	<?php } ?>