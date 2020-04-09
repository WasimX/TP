<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 


?>

<p><tr><td height="324" width="42%" valign="middle"><br><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>Witness page will be backup in a few days!<br><br>
<span class="warning">Page Closed!</span></p></p></div></td></tr></table></td></tr></table></td></tr></table></p>
<?php include_once "incfiles/foot.php"; ?>