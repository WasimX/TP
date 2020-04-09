<?php

session_start();

include "../incfiles/connectdb.php";

include "../incfiles/func.php";


logincheck();

$username=$_SESSION['username'];


$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

?>
<meta name="viewport" content="width=1024, initial-scale=0.75, maximum-scale=1.0, user-scalable=1"/>
<link rel="stylesheet" type="text/css" href="style.css?ver=1.01"/>
<link rel="stylesheet" type="text/css" href="../css/jquery.tipsy.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.nyromodal.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
<script type="text/javascript" src="../js/jquery.nyromodal.js"></script>
<script type="text/javascript">
		if ( window.self !== window.top ) { window.top.location=window.self.location; }
var new_load=1;
var username="<?php echo "$fetch->username"; ?>";
$(document).ready(function (){
$("#username").val(username);
$("#notice").hide();
$("#notice").fadeIn(5000);

$("#widgetBackground").click(function (){
    $("#widget").toggle();
});
$('.modal_box').nyroModal();

});
function pageLoaded(location){
	location=location.split("/");
	location=location[3];
	location=location.replace("?", "!!");
	location=location.replace("&", "!");
	location=location.replace("/", "");
	if(typeof parent.history.replaceState == 'function'){
		parent.history.replaceState({location: ''+location+''}, "GodfatherHaven.com", "?page="+location);
	}
	window.frames['mainFrame'].$(document).ready(function (){
	window.frames['mainFrame'].$('.modal_box').tipsy({gravity: 'se', live: true, html: true});
	window.frames['mainFrame'].$('.hover_info').tipsy({gravity: 'se', live: true, html: true});
	window.frames['mainFrame'].$('.modal_box').click(function(){
	parent.$.nmManual($(this).attr("href"));
	return false;
	});
	parent.$(window).resize(function (){
		if($.nmTop()){
			clearTimeout(timer);
			var timer=setTimeout("parent.$.nmTop().resize()", 500);
		}
	});
	});
}
function loadModal(){
	window.frames['mainFrame'].$('.modal_box').click(function(){
		parent.$.nmManual($(this).attr("href"));
		return false;
	});

}
$('.hover').tipsy({gravity: 'se', live: true});
function widgetLoaded(){
    if(new_load == 1){
        new_load=0;
    } else {
        $("#widget").toggle();
    }
}


</script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
<title>GodfatherHaven.com</title>
<link rel="shortcut icon" href="../favicon.ico">
<style type="text/css">
body {
	height: 100% !important;
	width: 100% !important;
	padding: 0 !important;
	margin: 0 !important;
	overflow: hidden;
	background-color: #272727;
}
iframe {
	border: 0;
}
.nyroModalBg{
	z-index:4;
}
table {
	border:0;
}

#notice {
	position: absolute;
	right: 5px;
	bottom: 5px;
	width: 270px;
	height: 112px;
	background-color: #171717;
	border: 1px solid #333333;
}
#notice_title { 
	font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	line-height: 47px;
	padding-left: 15px;
	width: 120px;
	float: left;
}
#notice_subnotice { 
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #515151;
	line-height: 47px;
	padding-right: 15px;
	float: right;
	font-style: italic;
}
.notice_row {
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #515151;
	padding: 3px 10px 3px 10px;
	border-top: 1px solid #333333; 
	border-bottom: 1px solid #333333; 
	background-color: #0E0E0E;
	margin-bottom: 1px;
}
.notice_blue_row {
	font: 11px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #919191;
	padding: 3px 10px 3px 10px;
	border-top: 1px solid #333333; 
	border-bottom: 1px solid #333333; 
	background-color: #17233E;
	margin-bottom: 1px;
}
#widget{
	display:none;
}
#widgetFrame {
	position: absolute;
	top: 24px;
	left: 90px;
	z-index: 99;
	background-color: #1b1b1b;
	border: 1px solid #333333;
}
#widgetBackground {
    position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
    background-color: #000;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}
#reconnectBackground {
    position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
    background-color: #000;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}
#reconnectContainer {
    position: absolute;
    top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: 98;
}
#reconnectBox {
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 200px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#reconnectedBox{
    display: none;
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 200px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#sessionLostBox {
	display: none;
    background-color: #222;
    border: 1px solid #333;
    padding: 7px;
    width: 350px;
    font: 14px Tahoma, Verdana, Arial, Helvetica, sans-serif;
    color: #888888;
}
#sessionLostBox td {
	color: #888;
	font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
}
.textinput {
	background-color: #111;
	color: #888;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	height: 22px;
	border: 1px solid #333;
	padding:1px;
	padding-left:3px;
	padding-right: 3px;
}
.button {
	background: url(../images/design/subhead.png) repeat-x;
	border: 1px solid #505050;
	font: 10px Arial, Helvetica, sans-serif;
	font-weight: bold;
	height: 24px;
	display: block;
	width: 100px;
	color: #cccccc;
	text-align: center;
	padding-top: 0;
	border: 0;
	cursor: pointer;
}
#reconnect {
    display: none;
}
#mailBlend {
	background-image: url(images/mail_blend.png);
	position: absolute;
	top: 2px;
	left: 65px;
	width: 25px;
	height: 27px;
	z-index: 100;
}
.interface_layer {
	position:absolute;
	top:0;
	left:0;
	padding:0;
	margin:0;
	width:100%;
	height:100%;
}
#user_interface {
	z-index: 2;
}
#loading { 
	z-index: 1;
}
#mainFrame, #leftFrame {
	background-color: transparent;
}
</style>
</head>
<body>
<div id="widget">
<div id="widgetBackground"></div>
<div id="widgetFrame"><iframe id="widgetIframe" style="width: 320px; height: 290px; border: 0;" frameBorder="0" src="../ajax_mail.php"></iframe></div>
</div>
<div id="user_interface" class="interface_layer">
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr>
	<td height="80" width="100%" colspan="2">
	<div style="width: 100%; height: 80px;">
		<iframe src="user_stats.php" style="width:100%; height:80px;" frameBorder="0" name="topFrame" id="topFrame"></iframe>
	</div>
	</td>
</tr>
<tr>
	<td height="100%" width="142">
	<div style="width: 142px; height: 100%;">
		<iframe src="../menu.php" style="width:100%; height:100%;" frameBorder="0" name="leftFrame" id="leftFrame" allowtransparency="true"></iframe>
	</div>
	</td>
	<td height="100%" width="100%">
	<div style="width: 100%; height: 100%;">
		<iframe src="../news.php" style="width:100%; height:100%;" frameBorder="0" name="mainFrame" id="mainFrame" allowtransparency="true"></iframe>
	</div>
	</td>
</tr>
</table>
</div>
<div id="loading" class="interface_layer">
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr>
	<td height="34" width="100%" colspan="2">
	<div style="width: 100%; height: 34px;">
	&nbsp;
	</div>
	</td>
</tr>
<tr>
	<td height="100%" width="140">
	<div style="width: 140px; height: 100%;">
		&nbsp;
	</div>
	</td>
	<td height="100%" width="100%" align="center"><img style="padding:10px;" src="../images/ajax_reconnect.gif"></td>
</tr>
</table>
</div>
</body>
</html>