<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
include "incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];
$viewcrew=$_GET['viewcrew'];

$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM crews WHERE name='$viewcrew'"));
$fetchboss=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$viewcrew' AND crewrank='Boss'"));

echo "$style"; 

if (!$fetch2){

echo "No Such Gang.";

exit();

}


if (strip_tags($_POST['leave'])){

if ($username == $fetch2->owner){

mysqli_query( $connection, "UPDATE crews SET owner='0' WHERE owner='$username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");

echo"<center><font color=green><b>You successfully left your gang!</b></font></center><br>";

}elseif ($username == $fetch2->underboss){

mysqli_query( $connection, "UPDATE crews SET underboss='0' WHERE owner='$username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");

echo"<center><font color=green><b>You successfully left your gang!</b></font></center><br>";

}elseif ($username == $fetch2->rhm){

mysqli_query( $connection, "UPDATE crews SET rhm='0' WHERE owner='$username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");

echo"<center><font color=green><b>You successfully left your gang!</b></font></center><br>"; 

}elseif ($username == $fetch2->lhm){

mysqli_query( $connection, "UPDATE crews SET lhm='0' WHERE owner='$username'");

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");

echo"<center><font color=green><b>You successfully left your gang!</b></font></center><br>"; 

}elseif ($username != $fetch2->lhm || $username != $fetch2->rhm || $username != $fetch2->underboss){

mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE username='$username'");

echo"<center><font color=green><b>You successfully left your gang!</b></font></center><br>"; 
}}
if($fetch2->owner == "0" && $fetch2->underboss == "0"){
mysqli_query( $connection, "DELETE FROM crews WHERE name='$viewcrew'");
mysqli_query( $connection, "DELETE FROM topics WHERE crew='$viewcrew' AND gang='1' AND gname='$viewcrew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE crew='$viewcrew'");
mysqli_query( $connection, "UPDATE gangCountry SET gang='0' WHERE gang='$viewcrew'");
echo"This gang has been destroyed!";
}

if($fetchboss->status != "Alive" && $fetchunderboss->status != "Alive" && $fetchlhm->status != "Alive" && $fetchrhm->status != "Alive"){
mysqli_query( $connection, "DELETE FROM crews WHERE name='$viewcrew'");
mysqli_query( $connection, "DELETE FROM topics WHERE crew='$viewcrew' AND gang='1' AND gname='$viewcrew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE crew='$viewcrew'");
mysqli_query( $connection, "UPDATE gangCountry SET gang='0' WHERE gang='$viewcrew'");
echo"This gang has been destroyed!";
}

?>
<?php if($fetch2->owner == "0" && $fetch2->underboss == "0"){
mysqli_query( $connection, "DELETE FROM crews WHERE name='$viewcrew'");
mysqli_query( $connection, "DELETE FROM topics WHERE crew='$viewcrew' AND gang='1' AND gname='$viewcrew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE crew='$viewcrew'");
echo"This gang has been deleted as there was not a Boss and an Underboss.";
}

if($fetch2->owner == "0" && $fetch2->underboss != "0"){
mysqli_query( $connection, "UPDATE crews SET owner='$fetch2->underboss', underboss='$fetch2->rhm', rhm='$fetch2->lhm', lhm='0' WHERE name='$viewcrew'");
echo"LaLaLa!";
}

if($fetch2->owner == "0" && $fetch2->underboss == "0"){
mysqli_query( $connection, "DELETE FROM crews WHERE name='$viewcrew'");
mysqli_query( $connection, "UPDATE accounts SET crew='0' WHERE crew='$viewcrew'");
mysqli_query( $connection, "UPDATE gangCountry SET gang='0', lastedit='0', profit='0', tax='2' WHERE gang='$viewcrew'");
echo"This gang has been destroyed!";
}



?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thug Paradise :: Gang Profile</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--
function ResizeThem()
{
  var maxheight = 9999;
  var maxwidth = 900;
  var imgs = document.getElementsByTagName("img");
  for ( var p = 0; p < imgs.length; p++ )
  {
    if ( imgs[p].getAttribute("alt") == "user posted image" )
    {
      var w = parseInt( imgs[p].width );
      var h = parseInt( imgs[p].height );
      if ( w > maxwidth )
      {
        imgs[p].style.cursor = "pointer";
        imgs[p].onclick = function( )
        {
          var iw = window.open (this.src);
          iw.focus();
        };
        h = ( maxwidth / w ) * h;
        w = maxwidth;
        imgs[p].height = h;
        imgs[p].width = w;
      }
      if ( h > maxheight )
      {
        imgs[p].style.cursor="pointer";
        imgs[p].onclick = function( )
        { 
          var iw = window.open (this.src);
          iw.focus( );
        };
        imgs[p].width = ( maxheight / h ) * w;
        imgs[p].height = maxheight;
      }
    }
  }
}
// --> 
</script>
</head>
<body>
<script language="JavaScript" type="text/javascript">
<!--
function emoticon(myValue) 
{
    var myField = document.getElementById('content');
    //IE support
	if (document.selection) {
		var temp;
		myField.focus();
		sel = document.selection.createRange();
		temp = sel.text.lenght;
		sel.text = myValue;
		if (myValue.length == 0) {
			sel.moveStart('character', myValue.length);
			sel.moveEnd('character', myValue.length);
		} 
		else
		{
			sel.moveStart('character', -myValue.length + temp);
		}
		sel.select();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0')
	{
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
	}
	else 
	{
		myField.value += myValue;
		myField.focus();
	}
}
//-->
</script>
<?php if($fetch->crew == $fetch2->name || $username == $fetch2->owner || $username == $fetch2->underboss || $username == $fetch2->rhm || $username == $fetch2->lhm){ ?>
<br>
<form method="post">
<table align="center" cellspacing="0" class="table">
<tr><td align="center"><a href="gangs.php"><font size="2">Go to your Gang CP!</a></center></td></tr>
</table></form>

        <?php } ?>


<br/>
<div align="center">
  <table width="70%" border="0" cellpadding="0" cellspacing="0" class="table1px">
    <tr><td height="30" class="gradient" colspan="8">Gang Profile</td></tr>
<tr> 
<td class="tableborder"><div align="center">&nbsp;</td>
<td>&nbsp;</td>
<td rowspan="8" class="tableborder" style="padding: 0 20px;"><div align="center">
<span style="font-size: 14px; font-weight: bold;">Members:</span><br>
<br>
<?php 
	$people = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$fetch2->name' AND crewrank='Member'");
	while($iss =mysqli_fetch_object($people)){
		echo "<b><a href='profile.php?viewing=$iss->username'>$iss->username</a>,</b> ";   
	}
	
	?>
       </div></td>
      </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Gang Name:</div></td>
        <td class="tableborder"><div align="left"><span style="font-size: 11px; font-weight: bold;"><?php echo "$fetch2->name"; ?></span></div></td>
        </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Boss:</div></td>
        <td class="tableborder"><div align="left"><span style="font-size: 11px; font-weight: bold;"><?php if($fetch2->owner == "0"){echo"None";
	}else{echo "<b><a href='profile.php?viewing=$fetch2->owner'>$fetch2->owner</a></b>";
	} ?></a></span></div></td>
        </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Underboss:</div></td>
        <td class="tableborder"><div align="left"><span style="font-size: 11px; font-weight: bold;"><?php if($fetch2->underboss == "0"){echo"None";
	}else{echo "<b><a href='profile.php?viewing=$fetch2->underboss'>$fetch2->underboss</a></b>";
	} ?></span></div></td>
        </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Left Hand Man:</div></td>
        <td class="tableborder"><div align="left"><?php if($fetch2->lhm == "0"){echo"<b>None</b>";
	}else{ echo "<b><a href='profile.php?viewing=$fetch2->lhm'>$fetch2->lhm</a></b>";
	}?></a></div></td>
        </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Right Hand Man:</div></td>
        <td class="tableborder"><div align="left"><?php if($fetch2->rhm == "0"){echo"<b>None</b>";
	}else{echo "<b><a href='profile.php?viewing=$fetch2->rhm'>$fetch2->rhm</a></b>";
	} ?></a></div></td>
        </tr>
      <tr>
        <td width="15%" bordercolor="#000000" bgcolor="#000000" class="tableborder"><div align="right">Highest Ranked Member:</div></td>
        <td class="tableborder"><div align="left"><?php 
		  $test = mysqli_query( $connection, "SELECT * FROM accounts WHERE crew='$viewcrew' ORDER BY rankpoints DESC LIMIT 1");





while($man = mysqli_fetch_object($test)) {



$query2=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$man->username'");

$fetch3=mysqli_fetch_object($query2);
echo"<b><a href='profile.php?viewing=$man->username'>$man->username</a></b>"; }
?></div></td>
        </tr>
<tr bgcolor="#000000">
        <td width="15%" bordercolor="#000000" class="tableborder"><div align="right"></div></td>
        <td bordercolor="#000000" class="tableborder"><div align="left"><a href="profile.php?user="></a> <a href="profile.php?user="></a></div></td>
        </tr>

       <tr bgcolor="#000000">
        </tr>
      
      <tr bgcolor="#000000">
        <td colspan="3" bordercolor="#000000" class="tableborder"><div align="center">
          <center><?php if (!$fetch2->quote){ echo "<center><b>No Information On File!</b>"; }else{ echo "".replace($fetch2->quote).""; } ?>
      </tr>
    </table>      </td>
  </tr>
</table>


<br /></body>
</html>



<?php include_once "incfiles/foot.php"; ?>