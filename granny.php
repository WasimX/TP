<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
 
logincheck();

$username=$_SESSION['username'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM account_info WHERE username='$username'"));
$fetch1=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$type=$_GET['type'];

if (strip_tags($_POST['Submit']) && strip_tags($_POST['status'])){
$status=addslashes($_POST['status']);
mysqli_query( $connection, "UPDATE account_info SET RGS='$status' WHERE username='$username'");
echo"Status Is Now Set";
echo "<meta http-equiv=\"refresh\" content=\"3;URL=granny.php\">";
}
if (strip_tags($_POST['Submit2']) && strip_tags($_POST['bullets'])&& strip_tags($_POST['bt'])){
$bullets=$_POST['bullets'];
$bt=$_POST['bt'];
mysqli_query( $connection, "UPDATE account_info SET RGB='$bullets',RGBT='$bt' WHERE username='$username'");
echo"Bullets Is Now Set";
echo "<meta http-equiv=\"refresh\" content=\"3;URL=granny.php\">";
}
if (strip_tags($_POST['Submit3']) && strip_tags($_POST['weapon'])){
$weapon=$_POST['weapon'];
mysqli_query( $connection, "UPDATE account_info SET RGG='$weapon' WHERE username='$username'");
echo"Weapon Is Now Set";
echo "<meta http-equiv=\"refresh\" content=\"3;URL=granny.php\">";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Thug Paradise 2 :: Granny</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FF0000}
-->
</style>
</head>

<body>
<form method="post" name="granny_form" id="granny_form">
<div align="center">
  
<div align="center">
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr class="gradient">
          
      <td height="30"><div align="center" class="style1">Talk to your Ricochet Granny </div></td>
    </tr>
    <tr>
      <td bgcolor="#000000" class="table1px"><div align="center" class="style1">What is it dear? Talk to me. <br />
          <br />
          <a href="granny.php?type=status"><img src="../images/status.png" width="75" height="75" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="granny.php?type=bullets"><img src="../images/bullets.png" width="75" height="75" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="granny.php?type=weapon"><img src="../images/weapon.png" width="75" height="75" border="0" /></a><br />
      <br /></div></td>
    </tr>
    </table>
  </div>
  <form name="form1" method="post" action="">
    <div align="center">
      <div align="center">
        <?php if($type==status && $fetch->RG=="1"){ ?>
<br>
<br>
        <table width="304" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="gradient">
            <td height="30"><div align="center">Grannys Status </div></td>
        </tr>
          <tr>
            <td bgcolor="#000000"><div align="center"><span class="style1">Status:
              <b><?php echo"$fetch->RGS"; ?></b>
              <br />  
              <select class="textbox" name="status" id="status">
                <option value='Awake'>Wake Up</option>
                <option value='Sleeping'>Give Her Sleeping Pills</option>
            </select>
              <br />  
              </span></div>        
              <span class="style1">
              <label>
              <div align="center">
                <span class="style1">
                <input type="submit" class="custombutton" name="Submit" value="Submit" />
                </span></div>
              <span class="style1">
              </label>
              </span></td>
        </tr>
            </table>
        <br />
          <?php } ?>
      </div>
</form>
	    <form name="form1" method="post" action="">
    <div align="center">
      <div align="center">
        <?php if($type==bullets && $fetch->RG=="1"){ ?>
<br>
<br>
        <table width="304" border="0" align="center" class="table1px" cellpadding="0" cellspacing="0">
          <tr class="gradient">
            <td height="30"><div align="center">Grannys Bullets </div></td>
        </tr>
          <tr>
            <td bgcolor="#000000"><div align="center">
              <p class="style1">Your granny has <b><?php echo "".number_format($fetch->RGB).""; ?> FMJ</b>.<br />
              <input id="buyb" class="textbox" type="text" name="buyb" onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off">
               
	<br>
	<br>
	<em>Please note when you have added the bullet(s), you can't get them back!</em><br>
	<br>
	<input type="submit" class="custombutton" name="buys" id="buys" value="Add FMJ" />
	<?php
		  
		  
		   if (strip_tags($_POST['buys'])){
		   $buyb=strip_tags($_POST['buyb']);
		   $status=strip_tags($_POST['status']); 
       if($buyb <= '0'){ $buyb = '1'; }
		   if($fetch1->fmj < $buyb){ 
		   echo"You have not got that many FMJ.";
		   }elseif($fetch1->fmj >= $buyb){
mysqli_query( $connection, "UPDATE account_info SET RGB=RGB+$buyb WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET fmj=fmj-$buyb WHERE username='$username'");
echo "<br>You successfully added <b>".makecomma($buyb)."</b> FMJ for your granny!";
}}

?>

        </tr>
        </table>
      </div>
      <p align="center">
	    <?php } ?>
	  </p>
	    </form>
	  <form name="form1" method="post" action="">
    <div align="center">
      <div align="center">
        <?php if($type==weapon && $fetch->RG=="1"){ ?>
        <br>
<br>
<table width="304" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr class="gradient">
            <td height="30"><div align="center">Grannys Weapon </div></td>
        </tr>
          <tr>
            <td bgcolor="#000000"><div align="center">
              <p class="style1">Gun: <b><?php  if($fetch->RGG=="0"){echo"None";}else{echo"$fetch->RGG";} ?></b>
<br>
                <label><span class="tableborder">
                <select name="weapon" id="weapon" class="textbox">
                  <?php if($fetch->FiveSeven!=="0"){?>
                  <option value="FiveSeven">FiveSeven</option>
                  <?php }?>
                  <?php if($fetch->AutoShotgun!=="0"){?>
                  <option value="AutoShotgun">AutoShotgun</option>
                  <?php }?>
                  <?php if($fetch->PSG1!=="0"){?>
                  <option value="PSG1">PSG1</option>
                  <?php }?>
                  <?php if($fetch->M82A1!=="0"){?>
                  <option value="M82A1">M82A1</option>
                  <?php }?>
                  <?php if($fetch->AK47!=="0"){?>
                  <option value="AK47">AK47</option>
                  <?php }?>
                  <?php if($fetch->M4A1!=="0"){?>
                  <option value="M4A1">M4A1</option>
                  <?php }?>
                  <?php if($fetch->MP5!=="0"){?>
                  <option value="MP5">MP5</option>
                  <?php }?>
                  <?php if($fetch->HKG36k!=="0"){?>
                  <option value="HKG36k">HKG36k</option>
                  <?php }?>
                  <?php if($fetch->DesertEagle!=="0"){?>
                  <option value="DesertEagle">DesertEagle</option>
                  <?php }?>
                  <?php if($fetch->AWP!=="0"){?>
                  <option value="AWP">AWP Sniper Rifle</option>
                  <?php }?>
                </select>
                </span> </label>
                <br />
                <br />  
              </p>
              </div>        
              <span class="style1">
              <label>
              <div align="center">
                <span class="style1">
                <input name="Submit3" type="submit" class="custombutton" id="Submit3" value="Submit" />
                </span></div>
              <span class="style1">
              </label>
              </span></td>
        </tr>
        </table>
      </div>
      <p align="center">
	    <?php } ?>
	  </p>
	  </form>
	  <div align="center">
	    <?php if($fetch->RG=="0"){ ?>
	    <br />
	    <b>You do not have a Ricochet Granny! You can purchase one on the Credits Page.</b><br />  
	    <?php } ?>
	    <br />
	    <table width="500" border="0" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="50" height="62" bgcolor="#000000" class="tableborder"><div align="left" class="style1"><img src="../images/questionmark.jpg" width="49" height="46" /></div></td>
          <td width="450" valign="middle" bgcolor="#000000" class="tableborder style1">Granny is always here to help. Here you can talk to Granny.<br />
            
            <br />
            Granny is very protective of you and is only looking to look after your best interests. Someone comes after you, she's gonna be angry!!<br />
            <br />
            On this page you can talk to Granny and tell her how she can help.<br />
            <br />
            If someone shoots at you but they don't kill you then Granny will follow your instructions and fire back at them, straight away!<br />
            <br />
            
            Granny will only notice if a thousand or more bullets are fired at you.<br />
            <br />
            However, if they manage to kill you, poor old Granny will be too sad to fire.<br />
            <br />
            It is said that a Granny without a weapon is half as powerful as an AWP!<br />
            <ol>
              <li class="style2" >Your Ricochet Granny lasts forever!</li>
    
      <li class="style2" >Your Granny uses your bullets, if you ask her to fire more than you have then she will fire what you do have instead. </li>
          <li class="style2">Your Granny will bring you back money if she kills someone.</li>
          <li class="style2">Witness statements from kills she makes will be sent &amp; you can view them from your &quot;My Stats&quot; page. </li>
          <li class="style2">If your granny attacks someone, you will receive a message.</li>
        </ol>        </td>
        </tr>
        </table>
	    </div>
	      </div>
        </form>
      </div>
</body>
</html>
<?php include_once "incfiles/foot.php"; ?>
