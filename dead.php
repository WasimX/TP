<?php
session_start();
include "incfiles/connectdb.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />

<title>You've Died!</title>
<div align="center">
  <p>&nbsp;</p>
<img src='../images/dead.png' width='250'></br></br>
   <?php if($_SESSION['dead'] == ""){ ?>
    <meta http-equiv="refresh" content="0; url=error.php" />
    <?php } ?>
  <?php if($_SESSION['dead'] != ""){
  
    $dead = $_SESSION['dead'];

    $info = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$dead'"));
    $rezCodeQ = mysqli_query( $connection, "SELECT * FROM `rezcodes` WHERE username='$dead' ORDER BY `id` DESC LIMIT 1");
    $rezCodeR = mysqli_num_rows($rezCodeQ);
    $rez = mysqli_fetch_object($rezCodeQ);


    if($rezCodeR != '0'){
      if($rez->expire < time()){
        mysqli_query( $connection, "DELETE FROM `rezcodes` WHERE username='$dead'");
        $code = 'Code expired. Generate a new one!';
      }elseif($rez->expire > time()){
        $code = $rez->code;
      }else{
        $code = 'Generate one below.';
      }
    }

    if($rezCodeR == '0'){
      $code = 'Generate one below.';
    }

    if($info->status != 'Dead'){
      echo'Error: Account is not dead.';
      exit();
    }

    if($_POST['revive']){
        $c = rand(11111,99999);
        $e = time() + (3600 * 3);
        mysqli_query( $connection, "DELETE FROM `rezcodes` WHERE username='$dead'");
        mysqli_query( $connection, "INSERT INTO `rezcodes` (`id`, `username`, `code`, `expire`) VALUES ('', '$dead', '$c', '$e')");
        $code = $c;
    }

    ?>
<form method='post'>
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  rules="none" class="table1px">
    
    <tr>
      <td class=gradient><div align="center">You have been killed!</span></div></td></tr>
<tr>
      <td >
      <p align="center" class="style3">Sorry <?php echo $dead; ?>, you have been killed.</br>
        To continue playing, you will need to make a new account and start again.</br>
        Alternatively, you may revive this account using your credits to do so you will need the code below (valid for 3hrs).</p>
        <p align='center'>It will cost <?php $cost = 250 + ($info->revive_times * 100); echo $cost; ?> credits to revive.</p>       
      <p align="center" class="style3"><b>Revival Code:</b> <?php echo $code; ?></p>
      <p align="center"><input type='submit' name='revive' id='revive' value='Generate Code' class='custombutton'></p>
      </td>
    </tr>
  </table>
  <p></p>
        <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  rules="none" class="table1px">
    
    <tr>
      <td class=gradient><div align="center">Account Stats/Info</span></div></td></tr>
<tr>
      <td >
      <p align="center" class="style3"><b>Rank:</b> <?php echo $info->rank; ?> <font color='grey'>-</font> <b>Money:</b> &pound;<?php echo number_format($info->money); ?> <font color='grey'>-</font> <b>Credits:</b> <?php echo number_format($info->credits); ?> <font color='grey'>-</font> <b>Bank:</b> &pound;<?php echo number_format($info->bankmoney); ?>  <font color='grey'>-</font> <b>Express Money:</b> &pound;<?php echo number_format($info->expressmoney); ?> </br>
        <b>FMJ:</b> <?php echo number_format($info->fmj); ?> <font color='grey'>-</font> <b>JHP:</b> <?php echo number_format($info->jhp); ?> 
      </p>
      </td>
    </tr>
  </table>
  <p></p>
          <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  rules="none" class="table1px">
    
    <tr>
      <td class=gradient><div align="center">Profile</span></div></td></tr>
<tr>
      <td >
      <p align="center" class="style3"><textarea rows='5' cols='50'><?php echo $info->quote; ?></textarea></p>
      </td>
    </tr>
  </table>
<p></p>
            <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  rules="none" class="table1px">
    
    <tr>
      <td class=gradient><div align="center">Notepad</span></div></td></tr>
<tr>
      <td >
      <p align="center" class="style3"><textarea rows='5' cols='50'><?php echo $info->notes; ?></textarea></p>
      </td>
    </tr>
  </table>

</form>
  <?php } ?>
 
</div>

<?php include_once "incfiles/foot.php"; ?>
<br><br>
