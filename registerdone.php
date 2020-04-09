<?php 

session_start(); 

include_once "incfiles/connectdb.php"; 



$rand1 = rand(0,9);

$rand2 = rand(10,99);

$answer = $rand1 + $rand2;



if ($_POST['SubmitReg']){

$additional08989 = addslashes($_POST['additional']); 

$answers = addslashes($_POST['answers']); 

$register_user = addslashes($_POST['register_user']); 

$register_pass = addslashes($_POST['register_pass']); 

$register_pass2 = addslashes($_POST['register_pass2']); 

$register_gender = addslashes($_POST['register_gender']); 

$register_email = addslashes($_POST['register_email']);

$register_email2 = addslashes($_POST['register_email2']); 

$register_location=addslashes(strip_tags($_POST['register_location'])); 

$register_user=addslashes(trim($register_user));

$register_pass=addslashes(trim($register_pass)); 



$today = gmdate('Y-m-d H:i:s');



$register_user = addslashes(stripslashes($register_user)); 

$register_email = addslashes(stripslashes($register_email)); 

$quote = addslashes(stripslashes($quote)); 

$register_user = addslashes(strip_tags($register_user)); 

$register_email = addslashes(strip_tags($register_email)); 

$number = addslashes($_POST['equals']);



if ($additional08989 != "GANCY78"){ echo "Use your head mate."; }

elseif ($additional08989 == "GANCY78"){



if((!$register_user) || (!$register_email) || (!$register_location) || (!$register_pass)){ 

echo "Please fill in all of the fields."; }else{



if ($number != "$answers"){ echo "The sum does not equal $number."; }

elseif ($number == "$answers"){



if ($register_pass != $register_pass2){

echo "The passwords you entered do not match.";

}elseif ($register_pass == $register_pass2){



if ($register_email != $register_email2){

echo "The emails you entered do not match.";

}elseif ($register_email == $register_email2){



if ($register_user == "0"){ echo "Unacceptable username."; }

elseif ($register_user != "0"){ 



if (ereg('[^a-zA-Z0-9_-]', $register_user)) {  

echo "Your username includes some symbols which are not allowed.";

}elseif (!ereg('[^A-Za-z0-9_-]', $register_user)) { 



if (strlen($register_user) <= 3 || strlen($register_user) >= 20){

echo  "The username you entered is too big or too small.";

}elseif (strlen($register_user) > 3 || strlen($register_user) < 20){



$email_check = mysqli_query( $connection, "SELECT email FROM accounts WHERE email='$register_email' AND status='Alive'"); 

$username_check = mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$register_user'"); 



$register_email_check = mysqli_num_rows($email_check); 

$username_check = mysqli_num_rows($username_check); 



if(($register_email_check > 0) || ($username_check > 0)){  



if($register_email_check > 0){ 

echo  "The email entered has been recognised in our data, therefore cannot be used."; unset($register_email); } 

if($username_check > 0){ 

echo "The username which was entered is already being used by another user."; unset($register_user); } 

   

}else{ 



$ip = $_SERVER['REMOTE_ADDR'];



mysqli_query( $connection, "INSERT INTO `account_info` ( `id` , `username`)

VALUES ('', '$register_user')") or die (mysqli_error());



mysqli_query( $connection, "INSERT INTO accounts (`id` , `username` , `password` , `regged`, `gender`, `email`, `location`, `r_ip`) 

VALUES ('', '$register_user', '$register_pass', '$today', '$register_gender', '$register_email', '$register_location', '$ip')") or die (mysqli_error());



mysqli_query( $connection, "INSERT INTO inventory (`id` , `username`) VALUES ('', '$register_user')") or die (mysqli_error());



        header("Location: registerdone.php"); }}}}}}}}}} ?>

 

<?php $timenow=time();

$select = mysqli_query( $connection, "SELECT * FROM accounts WHERE online > '$timenow' ORDER by id");

$num = mysqli_num_rows($select);

while ($i = mysqli_fetch_object($select)) 



$ud=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts"));

$dead= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status = 'Dead'"));
$alive= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status != 'Dead'"));

?>
<link href="../style.css" rel="stylesheet" type="text/css">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><title>Thug Paradise 2 | Registration Successful!</title> <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css" />
</head><body><div align="center"><form action="index.php" method="post" name="form1" id="form1"><table width="700" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="5"><img src="../images/tpbanner.png" alt="Banner" width="912" height="97" /></td></tr><tr><td colspan="5" class="gradient"><div align="center">Thank you for registering. Please login for help on how to play!</div></td></tr><tr><td width="50" class="table1px">&nbsp;</td><td width="135" height="175" class="tableborder"><div align="center"><img src="../images/lock.gif" alt="Lock" width="75" height="99"></div></td><td width="94" class="tableborder"><div style="font-size: 24px; font-family: Arial, Helvetica, sans-serif;"><?php echo "$rand1$rand2"; ?><div align="center"></div></div></td><td width="471" class="tablebackground"><div align="left">The three digit code here is your <b>Personal Security Code</b>.<br><br>Please try to remember this code or keep it somewhere safe.<br><br>Think of this as a PIN code, it will help you prove your account is yours.</div></td><td width="50" class="tableborder">&nbsp;</td></tr></table><p><input name="Submit" type="submit" class="custombutton" value="Login!"></p></form></div><p align="center">Please do not make more than one account. You are ONLY allowed to make another account if you die!</p></body></html><script language="javascript"><!--
bmi_SafeAddOnload(bmi_load,"bmi_orig_img",0);//-->
</script>