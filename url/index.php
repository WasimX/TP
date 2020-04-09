<?php 
session_start(); 
include_once "../incfiles/connectdb.php"; 
include_once "../incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$site=$_GET['site']; ?>

<html>
<head>
<link href="../style.css" rel="stylesheet" type="text/css">
<title>You are leaving TP...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<form action="<?php echo "$site"; ?>" target="<?php echo "$site"; ?>">
<table width="60%" border="0" align="center" class="table1px" cellpadding="0" cellspacing="0">
<tr><td height="30" class="gradient">Page Redirection - Leaving!</td></tr>
<tr><td align="center" class="tableborder">
The link which you have just clicked has not been recognised on our server.<br />
This means that the site which you have clicked shall lead you outside of Thug Paradise.<br />
If the site seems to be suspicious or un-necessary to be posted on this site, please do not continue and report back to a moderator with the details of where the site was posted and who by.<br /><br />
<font color="gold"><b><?php echo "$site"; ?></b></font><br /><br />
By clicking &quot;Continue to site...&quot; you are no longer under regulations of Thug Paradise, unless Thug Paradise is otherwise open in your web browser(s) which you run the site on.
<br><br>
<font style="font-size: 14px;"><a href="<?php echo "$site"; ?>" />Continue to site...</a></font>
</td></tr>
</table>
</form>
<?php include_once "../incfiles/foot.php"; ?>
</body> 
</html> 