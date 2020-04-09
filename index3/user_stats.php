<?php
session_start();

include "../incfiles/connectdb.php";

include "../incfiles/func.php";

logincheck();

$username=$_SESSION['username'];


$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));



$currank=$fetch->rank;

$rankp = $fetch->rank_points;



if ($currank == "Chav"){

$max = "60";

$old="0";



}elseif ($currank == "Pickpocket"){

$max = "200";

$old="60";



}elseif ($currank == "Vandal"){

$max = '400';

$old="200";



}elseif ($currank == "Associate"){

$max = '700';

$old="400";



}elseif ($currank == "Body Guard"){

$max = '1200';

$old="700";



}elseif ($currank == "Thief"){

$max = '2000';

$old="1200";



}elseif ($currank == "Criminal"){

$max = '4000';

$old="2000";



}elseif ($currank == "Soldier"){

$max = '7500';

$old="4000";





}elseif ($currank == "Capo"){

$max = '13000';

$old="7500";



}

elseif ($currank == "Gangster"){

$max = '20000';

$old="13000";

}

elseif ($currank == "Hitman"){

$max = '28000';

$old="20000";

}

elseif ($currank == "Boss"){

$max = '39000';

$old="28000";

}

elseif ($currank == "Man of Honour"){

$max = '50000';

$old="39000";

}
elseif ($currank == "Don"){

$max = '62000';

$old="50000";

}
elseif ($currank == "Respectable Don"){

$max = '72000';

$old="62000";

}
elseif ($currank == "Godfather"){

$max = '80000';

$old="72000";

}
elseif ($currank == "Respectable Godfather"){

$max = '95000';

$old="80000";

}
elseif ($currank == "Global Terror"){

$max = '115000';

$old="95000";

}
elseif ($currank == "Legend"){

$max = '150000';

$old="115000";

}
elseif ($currank == "Official TP Legend"){

$max = '260000';

$old="150000";

}

$percent = round((($rankp-$old)/($max-$old))*100);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<title>Thug Paradise</title>
<meta name="viewport" content="width=1024, initial-scale=0.75, maximum-scale=1.0, user-scalable=1"/>
<link rel="stylesheet" href="style.css?ver=1.01"/>
<link rel="stylesheet" type="text/css" href="../css/jquery.tipsy.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.nyromodal.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
<script type="text/javascript" src="../js/jquery.nyromodal.js"></script>
<script src="loggedin.js?ver=1.02"></script>
<style type="text/css">
.widget_box {
	float: left;
	margin-left: 10px;
	width: 36px;
    height: 23px;
    line-height: 25px;
    color: #CA0300;
    background: url("images/banner_top_widget.png") repeat-x;
}

#mail_icon {
    background: url(../images/mail.gif) no-repeat center center;
    width: 36px;
    height: 23px;
	filter: alpha(opacity=20);
	opacity: 0.20;
}
#notify_icon {
    background: url(../images/notify.gif) no-repeat center center;
    width: 36px;
    height: 23px;
	filter: alpha(opacity=20);
	opacity: 0.20;
}
.divide {
	color: #AAA;
	text-shadow: 1px 0px 0px #4d4d4d;
	opacity: 0.3;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
	filter: alpha(opacity=30);
	-moz-opacity: 0.3;
	-khtml-opacity: 0.3;
}
</style>
</head>
<body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $.fn.connectionPing=function(){
        $.ajax({
              url: "stats_ajax.php",
              dataType: 'json',
    		  success: function (data){
    		    if(data['error'] == "not_logged_in"){
				  sessionLost();
    		    } else {
    			$('#user_link').html("<a href='profile.php?viewuser="+data['username']+"' target='mainFrame'>"+data['username']+"</a>")
    			$('#global_rank').html(data['global_rank']);
    			$('#rank').html(data['rank']);
    			$('#money').html(data['money']);
    			$('#health').html(data['health']);
    			$('#credits').html(data['credits']);
    			$('#location').html(data['location']);
    			$('#xp').html(data['experience']);
                if(data['new_mail'] == 1 && widgetFlash['mail_icon'] != "true"){
                    flashWidget("mail_icon");
                }
                if(data['new_mail'] == 0 && widgetFlash['mail_icon'] == "true"){
                    widgetFlash['mail_icon']="false";
                }
                if(data['new_notification'] == 1 && widgetFlash['notify_icon'] != "true"){
                    flashWidget("notify_icon");
                }
                if(data['new_notification'] == 0 && widgetFlash['notify_icon'] == "true"){
                    widgetFlash['notify_icon']="false";
                }
                eval(data['javascript']);
                setTimeout($("#connect").connectionPing, 1000);
    		    }
    		},
            error: function(){
                connectionLost();
            }
    	});
    }

    $("#connect").connectionPing();

	$("#mail_icon").click(function (){
        parent.$("#widgetIframe").attr("src", "../ajax_mail.php");
        parent.$("#widgetFrame").css("left", "175px");
        widgetFlash['mail_icon']="false";
	});
    
    $("#notify_icon").click(function (){
        parent.$("#widgetIframe").attr("src", "../ajax_notify.php");
        parent.$("#widgetFrame").css("left", "221px");
        widgetFlash['notify_icon']="false";
	});	
});

var reconnect_time=30;
var i=3;
var connectInterval;


function connectionLost(){
    parent.$("#reconnect").show();
    reconnect_time=30;
    setTimeout(reconnectTimer, 1000);
}

function sessionLost(){
	parent.$("#reconnectBox").hide();
	parent.$("#sessionLostBox").show();
	parent.$("#reconnect").show();
}

function connectionRegained(){
    parent.$("#reconnectBox").fadeOut(500,function(){
        parent.$("#reconnectedBox").fadeIn(500,function(){
            parent.$("#reconnect").fadeOut(500,function(){
                parent.$("#reconnectedBox").hide();
                parent.$("#reconnectBox").show();
                $("#connect").connectionPing();
            });
        });
    });
}

function reconnectTimer(){
    
    if(reconnect_time > 1){
        reconnect_time--;
        parent.$("#reconnect_timer").html(reconnect_time);
        setTimeout(reconnectTimer, 1000);
    } else{
        if(reconnect_time == 1){
            reconnect_time=0;
            tryReconnect();
            reconnectTimer();
            connectInterval=setInterval(reconnectTimer, 1000);
        } else {
            if(i == 3){
               parent.$("#reconnect_timer").html(".");
               i=0;
            } else {
                parent.$("#reconnect_timer").append(".");
            }
            i++;
        }
    }
}

function tryReconnect(){
    $.ajax({
          url: "stats_ajax.php",
          dataType: 'json',
    	  success: function (data){
		    connectionRegained();
            clearInterval(connectInterval);
    	  },
        error: function(){
             connectionLost();
             clearInterval(connectInterval);
        }
	});
}



var widgetFlash = new Array();

function flashWidget(widget_flash){
    widgetFlash[widget_flash]="true";
	$("#"+widget_flash).animate({
	    opacity: 1
	  }, 1000 , function(){
	  $("#"+widget_flash).animate({
		    opacity: 0.2
		  }, 1000 , function(){
              if(widgetFlash[widget_flash] == "true"){
                flashWidget(widget_flash);
              }
		  });
	  });
}

</script>
<header id="header">
<h1>Godfather Haven</h1>
<img src="logo.png" alt="GH logo"/>
</header>
<menu id="notifications" class="controlMenu" type="list">
</menu>
<menu id="people" class="controlMenu" type="list">
</menu>
<menu id="inbox" class="controlMenu">
<li><a href="../sendmessage.php" target="mainFrame">Send Message</a></li>
<li><a href="../clearinbox.php" target="mainFrame">Clear Inbox</a></li>
</menu>
<menu id="options" class="controlMenu">
<li><a href="../friends.php" target="mainFrame">Blocked players</a></li>
<li><a href="../ga.php" target="mainFrame">Gamblers Anonymous</a></li>
</menu>
<section id="top">
<ul class="controls left">
<li id="msgs"><a href="../inbox.php" target="mainFrame"></a></li>
<li id="friends"><a href="../friends.php" target="mainFrame"></a></li>
<li id="notis"><a href="../notifications.php" target="mainFrame"></a></li>
</ul>
<div id="stats" class="colours high">
<table cellpadding="0" cellspacing="0">
<tr>
<th></th>
<td id="user" data-title="User"><a href="../profile.php?viewuser=<?php echo "$fetch->username"; ?>" target="mainFrame"><?php echo "$fetch->username"; ?></a></td>
<td id="gp" data-title="Rank&nbsp;-&nbsp;0%<br /><div class='progress'><div class='width' style='width: 0%'></div></div>"><a href="../tutorial.php#ranks" target="mainFrame">#<?php echo "".makecomma($fetch->global_rank).""; ?> (<?php echo "".makecomma($fetch->global_points).""; ?>GP)</a></td>
<th>Rank:</th>
<td id="rank" data-title="Rank&nbsp;-&nbsp;0%<br /><div class='progress'><div class='width' style='width: 0%'></div></div>"><a href="../tutorial.php#ranks" target="mainFrame"><?php echo "$fetch->rank"; ?></a></td>
<th>HP:</th>
<td id="health" data-title="HP"><a href="../hospital.php" target="mainFrame"><?php echo "$fetch->health"; ?>%</a></td>
<th>Gang:</th>
<td id="gang" data-title="Gang"><a href="../gangj.php" target="mainFrame"><?php if ($fetch->gang == "0"){ echo "None"; }else{ echo "<a href='gang_profile.php?viewgang=$fetch->gang' target='mainFrame'>$fetch->gang</a>";  } ?></td>
<th>Cash:</th>
<td id="cash" data-title="Cash"><a href="../bank.php" target="mainFrame"><?php echo "&dollar;".makecomma($fetch->cash).""; ?></a></td>
<th>Credits:</th>
<td id="credits" data-title="Credits"><a href="../credits2.php" target="mainFrame">0<span class="c">C</span></a></td>
<th>Loc:</th>
<td id="country" data-title="Loc"><a href="../travel.php" target="mainFrame"><img src='../images/locations/<?php echo "$fetch->location"; ?>.png' width='10' height='7' border='0'> <?php echo "$fetch->location"; ?></a></td>
<td id="refresh" data-title="Instant stats update">Refresh</td>
</tr>
</table>
</div>
<ul class="controls right">
<li id="radio" data-title="GP&nbsp;Radio&nbsp;(GHR)"><a href="../radio/"></a></li>
<li id="settings"><a href="../pref.php" target="mainFrame"></a></li>
<li id="logout" data-title="Logout"><a href="?logout"></a></li>
</ul>
</section>
<nav id="topNav">
</nav>
</body>
</html>