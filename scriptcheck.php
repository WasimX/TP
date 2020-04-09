<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query); 

$page = $_GET['page'];

$rand1 = rand(0,20);
$rand2 = rand(0,20);
$answer = $rand1 + $rand2;

if (strip_tags($_POST['scriptcheck'])){
$answers = strip_tags($_POST['answers']); 
$number = strip_tags($_POST['equals']);

if ($number != "$answers"){ echo "The sum does not equal $number."; }
elseif ($number == "$answers"){

if (ereg('[^0-9]', $number)) {  
echo "$number is an invalid numeric figure.";
}elseif (!ereg('[^0-9]', $number)) {  

mysqli_query( $connection, "UPDATE accounts SET scriptcheck='0' WHERE username='$username'");
echo "Script check valid and complete.";
echo "<meta http-equiv=\"refresh\" content=\"0;url=$page.php\" />"; }}}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Script Check :: TP2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

<form method="POST" action="" name="form">

<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="table1px">
<tr><td height="30" class="gradient">Script Check Evaluation</td></tr> 
<tr><td align="center" class="tableborder">
<img height="50" width="55" src="images/logout.png" /><br /><br />
Please answer the maths sum below to advance to the page you wish to view.<br /><br />
<?php echo "$rand1 + $rand2"; ?>:&nbsp; <input name="equals" class="textbox" type="text" id="equals" value="" maxlength="3" size="10">
<input type="hidden" name="answers" value="<?php echo "$answer"; ?>">
<input type="Submit" class="custombutton" name="scriptcheck" value="Submit Answer" /></td>
</tr></table>

</form>

<?php include_once "incfiles/foot.php"; ?>

</body>
</html>
