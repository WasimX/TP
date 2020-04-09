<link href="style.css" rel="stylesheet" type="text/css">
<?php $page = $_GET['page'];
if ($page == "" || $page == "error"){ $title = "Error Occurred"; }
if ($page == "dead"){ $title = "You're Dead!"; }
if ($page == "banned"){ $title = "You're Banned!"; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo "$title"; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head> 
<body>
<p align="center"><img src="images/banner/TP2.png"></p>
<br /><br />
<?php if ($page == "" || $page == "error"){ ?>
<table width="70%" cellpadding="0" cellspacing="0" border="0" align="center" class="table1px">
<tr><td height="30" class="gradient">An Error Has Occurred</td></tr>
<tr><td class="tablebackground" align="center">
<p>We are sorry to inform you but an error has occurred. Don't worry, nothing has been lost or edited during the error.</p>
<p>We mainly believe the error was due to your account, if owned, being logged out. This could have been done manually without notice, or automatically due to the lack of time of which you play the game, during your session peroid online with us.</p>
<p>We advise you to go <a href="index.php">BACK</a> to the homepage, and login again.</p>
<p>If you do not yet own an account, you may register by clicking <a href="register.php">HERE</a>, remember you are not allowed more than one account at a time. By doing so both of your accounts may be modkilled or deleted from the system.</p>
<p>If this error keeps occurring during your time online with Thug Paradise, please inform an Administrator as soon as possible.</p>
</td></tr>
</table>
<?php }elseif ($page == "dead"){ ?>
<div align="center"><img src="images/dead.png" border="0" /></div>
<table width="57%" cellpadding="0" cellspacing="0" border="0" align="center" class="table1px">
<tr><td height="30" class="gradient">You Have Died</td></tr>
<tr><td class="tableborder" align="center">
<p>Unfortunately, you have died on Thug Paradise. However, don't be fooled by these cruel people. Fight back; as were kind, we shall provide you with the <u>credits</u> you posses on your last account. These credits can be retained by going to the credits page (once signed up), and using the form which clearly states &quot;Move Credits&quot;.</p>
<p>This proceedure helps you to benefit the progress you made on your last account. On the other hand, all your rank, money and other details have been deleted. If you believe your account was unfairly killed, please post a support ticket on TP Support and one of the moderators shall look into your request.</p>
<p>Also, please check the Modkills thread on the main forum, to see if a moderator has killed you due to you breaking the rules / TOS. Beware, as you are always being watched, regardless of your rank.</p></td></tr>
</table>
<?php }elseif ($page == "error"){ ?>
<?php } ?>
<p align="center">&nbsp;</p> 
<p align="center">
<?php include_once "incfiles/foot.php"; ?>
</p>
</body> 
</html>
