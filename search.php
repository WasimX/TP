<?php
session_start(); 
include "incfiles/connectdb.php";
include "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];

$user=$_POST['user'];
$rank=$_POST['rank'];
$info=mysqli_fetch_object(mysqli_query( $connection, "SELECT rank FROM accounts WHERE username='$username'"));
?>

<?php if ($site->gupdate == "1"){
echo "<link href='style.css' rel='stylesheet' type='text/css'><center><div class='update'>$site->gupdatetext</div></center>

<br>";
}
?>

<style type="text/css">

<!--

.link {background: url(images/subhead.png) repeat-x; 
	                    padding: 5px 0px 5px 0px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }
.selected_link {background: url(images/selected_box.png) repeat-x;
	                    padding: 5px 0px 5px 0px; 
	                    border: 1px solid #000000;
                       	    width: 80px; }

#tooltip {
	position: absolute;
	z-index: 3000;
	border: 2px solid #000000;
	background-color: #111111;
	color: #FFFFFF;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	padding: 5px;
	opacity: 0.85;
	max-width: 310px;
}
#tooltip h3, #tooltip div { margin: 0; }
#tooltip h3 {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: normal;
}

#bar {
	position: relative;
	background-image: url('images/bar/r.jpg');
	width: 150px;
	height: 11px;
	border: 1px solid #000000;
}
#per {
	position: absolute;
	top: 0px;
	z-index: 3;
	width:100%;
	height: 11px;
	left: 63px;
}
#rg {
	background-image: url('images/bar/g.jpg');
	height: 11px;
}
-->

</style>
<?php $check = mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `read`='0' AND `to`='$username'");
$inbox=mysqli_num_rows($check);


$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

$query1=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$info=mysqli_fetch_object($query1);




$currank=$fetch->rank;
$rankp = $fetch->rankpoints;

if ($currank == "Chav"){
$max = "50";
$old="0";
}elseif ($currank == "Vandal"){
$max = '100';
$old="50";
}elseif ($currank == "Criminal"){
$max = '250';
$old="100";
}elseif ($currank == "Thug"){
$max = '500';
$old="250";
}elseif ($currank == "Hustler"){
$max = '1000';
$old="500";
}elseif ($currank == "Mobster"){
$max = '2000';
$old="1000";
}elseif ($currank == "Gangster"){
$max = '5000';
$old="2000";
}elseif ($currank == "Hitman"){
$max = '10000';
$old="5000";
}elseif ($currank == "Boss"){
$max = '20000';
$old="10000";
}elseif ($currank == "Assassin"){
$max = '35000';
$old="20000";

}elseif ($currank == "Don"){
$max = '50000';
$old="35000";

}elseif ($currank == "Godfather"){
$max = '70000';
$old="50000";

}elseif ($currank == "Global Terror"){
$max = '90000';
$old="70000";

}elseif ($currank == "Global Dominator"){
$max = '145000';
$old="90000";

}elseif ($currank == "Untouchable Godfather"){
$max = '175000';
$old="145000";

}elseif ($currank == "Legend"){
$max = '225000';
$old="175000";

}elseif ($currank == "Official TP Legend"){
$max = '9999999999';
$old="225000";
} 
$percent = round((($rankp-$old)/($max-$old))*100);
?>
<link href="style.css" rel="stylesheet" type="text/css"><style type="text/css">
#bar {
	position: relative;
	background-image: url('images/bar/r.jpg');
	width: 150px;
	height: 11px;
	border: 1px solid #000000;
}
#per {
	position: absolute;
	top: 0px;
	z-index: 3;
	width:100%;
	height: 11px;
	left: 63px;
}
#rg {
	background-image: url('images/bar/g.jpg');
	height: 11px;
}
</style>

<script type="text/javascript">
function ajax_search() {

		var theElement = document.getElementById('user');
		
		theElement.onkeyup = function(){ search_delay(this); };
}

	function search_delay(element) {
		
		var func = function() { showusers( element.value ); };

		if ( element.zid ) {
			clearTimeout(element.zid);
		}
		element.zid = setTimeout(func,1000);

}

var xmlHttp

function showusers(str)
{
if (str.length<3)
  { 
  document.getElementById("users").innerHTML="";
  return;
  }
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="user_search.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById("users").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
</script>
<body><?php include_once("analyticstracking.php") ?>
<table width="500" align="center" cellpadding="0" cellspacing="0" bordercolor="" class="table1px" border='0'>
<tr><td class="gradient">Find Player</td></tr>
<tr>
<td align="center"><br>Username:&nbsp;<input class="textbox" name="user" id="user" onKeyUp="ajax_search();"; type="text" class="input" autocomplete="off"></td>
</tr>
<tr>
<td colspan="2" align="center"><br>Type 3 characters or more!</td>
</tr>
</table>
<div id='users'></div>
<br>
</body>
</html>
 <table align="center" width="650" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td>
      <td width="450" valign="middle" class="tableborder"><div align="center" class="style1">The search page allows you to search both gangs and accounts at the same time. The search criteria, providing you have entered more than 3 letters, shall bring back your results in under 4 seconds. The results are based on a 'likely' basis. Therefore the result shall bring back any consecutive information within the query given. If the query fails to bring back results, you may want to try and be more specific on what you are searching for. </div></td>
    </tr>
  </table>

<?php  include_once"incfiles/foot.php";?>