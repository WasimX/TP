<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php";
include_once "incfiles/jailcheck.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />
<style type=\"text/css\">

				.me {

					text-align: center;

					margin: 5px;

					padding-top: 10px;

					padding-bottom: 10px;

					width: 90px;

					height: 60px;

				}

				.large-text {

					color: #d75f51 !important;

					font-size: 16px;

				}

				img {

					padding-bottom: 10px;

				}

				</style>"; 

$jail=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM jail WHERE username='$username'"));
if($jail != "0"){
echo"<SCRIPT LANGUAGE='JavaScript'>
window.location='jail.php';
</script>"; }

$cat=$_POST['category'];
$radiobutton=$_POST['radiobutton'];

$above = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$info = mysqli_fetch_object($above);
$chance = explode("-", $info->crimechance);

if ($info->lastcrime > time()){
$left = $info->lastcrime - time();
echo "<center>You must lay low for $left seconds before you can commit another crime!<br>
<br><b> Tired of waiting to do your next crime? Steroids can be taken by using credits if you wish to be die-hard and not have to wait inbetween each crime, for plenty of money / bullets and rank!</b></center>";
exit();
}
 
if ($_POST['commit']){

if ($cat == "BankRobbery"){ 
$suc = $chance[$radiobutton]; 
$ran = rand(1,100);

if ($ran <= $suc){
	
if ($radiobutton == "1"){
  $win = rand(500,250);
  $winfmj = "0";
  $winxp = rand(10,20);
  $damage = "0";
  echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Success!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/success.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;".makecomma($win)."</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winfmj)." FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($damage)."%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "2"){
  $win = rand(100,500);
  $winfmj = "0";
  $winxp = rand(10,20);
  $damage = "0";
  echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Success!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/success.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;".makecomma($win)."</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winfmj)." FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($damage)."%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "3"){
  $win = rand(500,1000);
  $winfmj = "0";
  $winxp = rand(10,20);
  $damage = "0";
  echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Success!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/success.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;".makecomma($win)."</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winfmj)." FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($damage)."%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "4"){
  $win = rand(1000,10000);
  $winfmj = "0";
  $winxp = rand(10,20);
  $damage = "0";
  echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Success!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/success.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;".makecomma($win)."</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winfmj)." FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($damage)."%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "5"){
  $win = rand(10000,15000);
  $winfmj = rand(25,125);
  $winxp = rand(10,20);
  $damage = rand(0,1);
  echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Success!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/success.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;".makecomma($win)."</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winfmj)." FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($damage)."%</span></center></i></td>
					</tr>
					</table>";
}


$time= time() + 120;
$n_money=$info->money+$win;
$n_fmj=$info->fmj+$winfmj;
$n_hp=$info->health-$damage;
$n_xp=$info->rankpoints+$winxp;

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='1' OR mission='0'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }

mysqli_query( $connection, "UPDATE accounts SET money='$n_money', rankpoints='$n_xp', health='$n_hp', fmj='$n_fmj' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
}else{

if ($radiobutton == "1"){

  $winxp = rand(3,10);

echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Failed!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/failed.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;0</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0 FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "2"){

  $winxp = rand(3,10);
echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Failed!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/failed.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;0</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0 FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "3"){

  $winxp = rand(3,10);
echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Failed!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/failed.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;0</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0 FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "4"){
  $winxp = rand(3,10);
echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Failed!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/failed.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;0</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0 FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0%</span></center></i></td>
					</tr>
					</table>";
}elseif ($radiobutton == "5"){
  $winxp = rand(3,10);
echo "<link href=\"../stylewm.css\" rel=\"stylesheet\" type=\"text/css\"><center><table align=\"center\" width=\"500\" cellspacing=\"0\" class=\"table\">
		<tr class=\"header\"><td>Failed!</td></tr>
<tr><td align=\"center\" style=\"padding: 15px;\"><img src=\"images/action/failed.png\"></td></tr>

		</table>
<table width=\"500\" align=\"center\" cellspacing=\"10\">
					<tr>
						<td width=\"90\" align=\"center\">Money</td>
						<td width=\"90\" align=\"center\">Experience</td>

						<td width=\"90\" align=\"center\">Items Gained</td>
                                                
						<td width=\"90\" align=\"center\">Damage</td>
					<tr>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">&pound;0</span></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">".makecomma($winxp)." XP</span></center></td>
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0 FMJ</td>
						
						<td class=\"table me\"><img src=\"images/action/arrow_up.png\"><br><span class=\"large-text\">0%</span></center></i></td>
					</tr>
					</table>";
}


$new_rank = $info->rankpoints + $winxp;
mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
  
$reason = "Bank Robbery";
require_once "incfiles/failed.php"; }

}elseif ($cat == "CornerShop"){ 
$suc = $chance[$radiobutton]; 
$ran = rand(1,100);

if ($ran <= $suc){
	
if ($radiobutton == "4"){
  $win = rand(200,450);
  echo  "You slipped a few alcoholic drinks in your pocket, while taking several other items and adding them to the load in your bag. You later sold the items to kids walking by. Well done, you got away with £".makecomma($win).".";
}elseif ($radiobutton == "0"){
  $win = rand(450,600);
  echo "During the night, at 02.32am, you climbed through a smashed window and shipped all of the goods from the shop into your van. The next morning you entered an auction center and sold off all of the items for £".makecomma($win).", well done.";
}elseif ($radiobutton == "6"){
  $win = rand(600,1200);
  echo "Taking the manager hostage was hard, but you hit him down with a baseball bat. He couldn't get up before you stole all the money out of the cashier. Congratulations you got away with £".makecomma($win).".";
}elseif ($radiobutton == "7"){
  $win = rand(1200,3000);
  echo "Bang! The shopkeeper hit the floor as you shot him in the leg. He couldn't stand back up and you took his wallet. Out slipped his credit card as you ran off with it. You soon after withdrew all the money which was £".makecomma($win).". Well done.";
}


$time= time() + 130;
$n_money=$info->money+$win;
$new_rank=$info->rankpoints + rand(5,11);

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='1' OR mission='0'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }

mysqli_query( $connection, "UPDATE accounts SET money='$n_money', rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
}else{

if ($radiobutton == "4"){
echo "Oh dear, as you was grabbing the vodka, the shelves came crashing down on you. You ran off as soon as the bottles smashed! Unlucky, you didn't manage to make any money.";
}elseif ($radiobutton == "0"){
echo "Why did you smash the window!? The shopkeeper heard you from down the street and rushed out to find you breaking in. He called the police as he held you down. They came and took you away. You got away with nothing.";
}elseif ($radiobutton == "6"){
echo "You went to grab the manager by the neck, but he reacted sharply and smacked you round the head. The nextt hing you know your sat in a temporary cell. You failed and got away with nothing!";
}elseif ($radiobutton == "7"){
echo "Oh dear, that shopkeeper is tough! You shot him in the leg, however despite his injuries he still managed to hit you round the head with the bin! Unlucky, you got away with nothing!";
}


$new_rank = $info->rankpoints + rand(1,4);
mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
  
$reason = "Crime";
require_once "incfiles/failed.php"; } 


}elseif ($cat == "Factory"){ 
$suc = $chance[$radiobutton]; 
$ran = rand(1,100);

if ($ran <= $suc){
	
if ($radiobutton == "8"){
  $win = rand(300,550);
  echo  "You stole the items without being noticed. A friend of yours offered to buy them off you, so he gave you £".makecomma($win)." for them. Congratulations.";
}elseif ($radiobutton == "9"){
  $win = rand(550,700);
  echo "No-one noticed you! You kept stealing the odd peace of metal, but overall you received the mans pay at the end of the day, which was £".makecomma($win).". Well done.";
}elseif ($radiobutton == "10"){
  $win = rand(700,1400);
  echo "Everyone believe that the gun was real, therefore gave up all hope. They handed you all the brass in the factory. You later sold it on the web for £".makecomma($win)."!";
}elseif ($radiobutton == "11"){
  $win = rand(1400,4000);
  echo "The manager's wife was so scared that she handed you their properties straight away. You received £".makecomma($win)." overall. Well done.";
}


$time= time() + 130;
$n_money=$info->money+$win;
$new_rank=$info->rankpoints + rand(5,12);

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='1' OR mission='0'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }

mysqli_query( $connection, "UPDATE accounts SET money='$n_money', rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
}else{

if ($radiobutton == "8"){
echo "A customer saw you taking things from the shelves, so reported you. The police arrived and took you away. You got nothing.";
}elseif ($radiobutton == "9"){
echo "Someone noticed that they had never seen you before, so got the manager to check your work status. It came back negative, therefore you was kicked from the building and sent to the police station. Unlucky, you got away with nothing.";
}elseif ($radiobutton == "10"){
echo "Someone called your bluff, and said shoot. You refused so they carried on there duties without a flinch. You was taken away by the police shortly after!";
}elseif ($radiobutton == "11"){
echo "The manager thought back. You was about the kill him but before you could the wide slapped you round the head as hard as she could. You fell to the floor in shock, as the police arrived. You got nothing and was taken away.";
}


$new_rank = $info->rankpoints + rand(1,4);
mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
  
$reason = "Crime";
require_once "incfiles/failed.php"; } 


}elseif ($cat == "Company"){ 
$suc = $chance[$radiobutton]; 
$ran = rand(1,100);

if ($ran <= $suc){
	
if ($radiobutton == "12"){
  $win = rand(300,550);
  echo  "The fake ID worked. They charged the wrong person and you received the goods. You sold the items for £".makecomma($win).". Congratulations.";
}elseif ($radiobutton == "13"){
  $win = rand(550,700);
  echo "You succeeded in taking packages out of the company un-noticed. Your brother offered £".makecomma($win)." for all of them, so you took the money and gave him the items. Well done.";
}elseif ($radiobutton == "14"){
  $win = rand(700,1400);
  echo "The manager was afraid that you would shoot, therefore he handed over all the cash which was £".makecomma($win).". Well done, you ran away with the money!";
}elseif ($radiobutton == "15"){
  $win = rand(1400,4000);
  echo "You hacked into the web system and changed the bank details, so that all the money would flow into your bank. You ended up with £".makecomma($win).".";
}


$time= time() + 130;
$n_money=$info->money+$win;
$new_rank=$info->rankpoints + rand(5,12);

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='1' OR mission='0'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }

mysqli_query( $connection, "UPDATE accounts SET money='$n_money', rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
}else{

if ($radiobutton == "12"){
echo "Someone noticed that it wasn't you in the ID picture, therefore you failed to receive any money. The police caught up with you and took you away.";
}elseif ($radiobutton == "13"){
echo "You failed to take the packages out of the company's stash un-noticed. The co-director caught you and rang the police. The police turned up and took you to the cells. YOu got away with nothing.";
}elseif ($radiobutton == "14"){
echo "You took the manager at gun point, but he told you to shoot him. You failed to shoot with guilty consience! You really are no good! The police arrived to take you away, as the manager gave you a cheeky wink.";
}elseif ($radiobutton == "15"){
echo "You ain't no geek, you can't hack into systems! You didn't know where to start, and decided to quit. However logs were still there, so the police caught you in the act and came for you. You got nothing!";
}

$new_rank = $info->rankpoints + rand(1,4);
mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
  
$reason = "Crime";
require_once "incfiles/failed.php"; } 


}elseif ($cat == "Internet"){ 
$suc = $chance[$radiobutton]; 
$ran = rand(1,100);

if ($ran <= $suc){
	
if ($radiobutton == "16"){
  $win = rand(300,550);
  echo  "You hacked there business and came away with £".makecomma($win).". A worth-while amount to say it's only a small company.";
}elseif ($radiobutton == "17"){
  $win = rand(550,700);
  echo "PC World wern't happy, but who cares? You used them to make £".makecomma($win).". Well done.";
}elseif ($radiobutton == "18"){
  $win = rand(700,1400); 
  echo "You managed to reach there FTP Server and delete all the files on the webpage. You later sued them for inco-operative actions. You got away with £".makecomma($win)."! Congratulations.";
}elseif ($radiobutton == "19"){
  $win = rand(1400,4000);
  echo "You did it! Bill Gates tries to fight back but he couldn't match your expertees. You took all of microsoft's files and setup your own business. Well done you made £".makecomma($win)." in total.";
}


$time= time() + 130;
$n_money=$info->money+$win;
$new_rank=$info->rankpoints + rand(5,12);

$chek=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM mission WHERE username='$username' AND mission='1' OR mission='0' OR mission='0'"));
if($chek > '0'){
mysqli_query( $connection, "UPDATE mission SET unit=unit+1 WHERE username='$username'"); }

mysqli_query( $connection, "UPDATE accounts SET money='$n_money', rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
}else{

if ($radiobutton == "16"){
echo "Oh dear, there security system was too good for you. You failed and was caught by the police.";
}elseif ($radiobutton == "17"){
echo "PC World figured out what you was doing, and rang the police. The police got involved and questioned you. You failed to answer correctly and was taken away. Unlucky, you got nothing!";
}elseif ($radiobutton == "18"){
echo "You didn't know how to get into there system, therefore you gave yourself in. The police came and sent you to the cells.";
}elseif ($radiobutton == "19"){
echo "You will never be able to master Bill Gates, he is a master himself. He used his anti-virus scan to outpower you. He rang the police and they came to take you away. You got away with nothing!";
}


$new_rank = $info->rankpoints + rand(1,4);
mysqli_query( $connection, "UPDATE accounts SET rankpoints='$new_rank' WHERE username='$username'");
mysqli_query( $connection, "UPDATE account_info SET crimes=crimes+1 WHERE username='$username'");
  
$reason = "Crime";
require_once "incfiles/failed.php"; } 
}


$maybe0 = rand(0,2);
$maybe1 = rand(0,3);
$maybe2 = rand(0,4); 
$maybe3 = rand(0,5);


$chance0 = $chance[0] + $maybe0;
$chance1 = $chance[1] + $maybe1;
$chance2 = $chance[2] + $maybe2;
$chance3 = $chance[3] + $maybe3;

$chance4 = $chance[4] + $maybe0;
$chance5 = $chance[5] + $maybe1;
$chance6 = $chance[6] + $maybe2;
$chance7 = $chance[7] + $maybe3;

$chance8 = $chance[8] + $maybe0;
$chance9 = $chance[9] + $maybe1;
$chance10 = $chance[10] + $maybe2;
$chance11 = $chance[11] + $maybe3;

$chance12 = $chance[12] + $maybe0;
$chance13 = $chance[13] + $maybe1;
$chance14 = $chance[14] + $maybe2;
$chance15 = $chance[15] + $maybe3;

$chance16 = $chance[16] + $maybe0; 
$chance17 = $chance[17] + $maybe1;
$chance18 = $chance[18] + $maybe2;
$chance19 = $chance[19] + $maybe3;

if($chance0 > 85){
$chance0 = 80; }
if($chance1 > 70){
$chance1 = 65; }
if($chance2 > 60){
$chance2 = 50; }
if($chance3 > 45){
$chance3 = 30; }

if($chance4 > 85){
$chance4 = 80; }
if($chance5 > 70){
$chance5 = 65; }
if($chance6 > 60){
$chance6 = 50; }
if($chance7 > 45){
$chance7 = 30; }

if($chance8 > 85){
$chance8 = 80; }
if($chance9 > 70){
$chance9 = 65; }
if($chance10 > 60){
$chance10 = 50; }
if($chance11 > 45){
$chance11 = 30; }

if($chance12 > 85){
$chance12 = 80; }
if($chance13 > 70){
$chance13 = 65; }
if($chance14 > 60){
$chance14 = 50; }
if($chance15 > 45){
$chance15 = 30; }

if($chance16 > 85){
$chance16 = 80; }
if($chance17 > 70){
$chance17 = 65; }
if($chance18 > 60){
$chance18 = 50; }
if($chance19 > 45){
$chance19 = 30; }


$arrayrates = array($chance0, $chance1, $chance2, $chance3, $chance4, $chance5, $chance6, $chance7, $chance8, $chance9, $chance10, $chance11, $chance12, $chance13, $chance14, $chance15, $chance16, $chance17, $chance18, $chance19);
$newrates = implode("-", $arrayrates);
$timmy = '120';
	
if($fetch->steroids > "0"){
$timmy = '0';
mysqli_query( $connection, "UPDATE accounts SET steroids=steroids-1 WHERE username='$username'"); }
	
$tim = time() + $timmy;	
mysqli_query( $connection, "UPDATE accounts SET crimechance='$newrates', lastcrime='$tim' WHERE username='$username'");
exit;
}

$one1=100-$chance[0];


$one2=100-$chance[1];


$one3=100-$chance[2];


$one4=100-$chance[3];


$one5=100-$chance[4];


$one6=100-$chance[5];





?>


<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Thug Paradise 2 :: Crimes</title>

<link rel=stylesheet href=library/wtm.css type=text/css>
<link rel=stylesheet href=style.css type=text/css>

<script type="text/javascript" src="library/select.js"></script>
</head>

<body>
<form name="form1" method="post" action="">
<input type="hidden" name="radiobutton" id="select" value="0">
			  <?php if ($cat == ""){ ?>
<div align="center">
    <table width="645" class="table1px" border="0" cellpadding="0" cellspacing="0">
     <tr height="30" class="gradient2"> 
      <td colspan="5">Commit A Crime</tr>
          </div>
        </td>
      </tr>
      <tr bordercolor="#666666" bgcolor="#666666">
        <td width="135" height="153" align="center" cellpadding="2" class="select" id="5" onclick="SelectOption(this.id);"><div align="center">
            <p align="center">
            <p><img src="../images/crimes/import.jpg"><br>
    Import	Weapons	<br>
    <img src="images/g.jpg" width="<?php echo "$chance[4]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one5"; ?>" height="13"><img src="images/m.jpg">
        </div></td>
        <td width="135" valign="top" cellpadding="2" class="select" id="4" onclick="SelectOption(this.id);"><div align="center">
          <p><img src="../images/crimes/has.png"><br>
    Heist A Store<br>
          <img src="images/g.jpg" width="<?php echo "$chance[3]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one4"; ?>" height="13"><img src="images/m.jpg">
        </div></td>
        <td width="135" valign="top" cellpadding="2" class="select" id="3" onclick="SelectOption(this.id);"><div align="center">
          <p><img src="../images/crimes/gw.png"><br>
    Grow Weed	<br>
        <img src="images/g.jpg" width="<?php echo "$chance[2]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one3"; ?>" height="13"><img src="images/m.jpg"></div></td>
        <td width="135" valign="top" cellpadding="2" class="select" id="2" onclick="SelectOption(this.id);"><div align="center">
          <p><img src="../images/crimes/rah.png"><br>
    Rob A House	<br>
          <img src="images/g.jpg" width="<?php echo "$chance[1]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one2"; ?>" height="13"><img src="images/m.jpg">
        </div></td>
        <td width="135" height="153" valign="top" cellpadding="2" class="select" id="1" onclick="SelectOption(this.id);"><div align="center">
          <p><img src="../images/crimes/s.png"><br>
    Shoplifting	<br>
          <img src="images/g.jpg" width="<?php echo "$chance[0]"; ?>%" height="13"><img src="images/m.jpg"><img src="images/r.jpg" width="<?php echo"$one1"; ?>" height="13"><img src="images/m.jpg">            
        </div></td>
      </tr>
	        <tr bordercolor="#000000" bgcolor="#666666" >
        <td colspan="5" cellpadding="2"><div align="center"> 
<input name="commit" type="submit" id="submit" class="custombutton" value="Commit Crime">
<input name="category" type="hidden" value="BankRobbery">
          </div></td>
      </tr>
    </table>
<br></br>
</form>
  <table width="500" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td>
      <td width="450" valign="middle" class="tableborder"><div align="center" class="style1">This page is crimes. This is probably the page you'll visit the most! There are currently five crimes available to commit in the thugs paradise, from hardest with the most profit, to the lowest, with the less profit. When you start your percentages will be very low, but the more crimes you do, the more experience you get meaning you slowly begin to get better! You have to stay low for 2 minutes between each crime to avoid gaining attention from the pigs!</div></td>
    </tr>
  </table>
</body>
</html>
<?php }else{ 
			              if ($cat == "BankRobbery"){ ?>
<table width="53%" cellpadding="0" cellspacing="0" class="table1px" align="center">
<tr><td height="30" colspan="3" align="center" class="gradient" valign="middle">Crimes - Bank Robbery!</td></tr>	
<tr>
<td align="center" class="tableborder">
<img src="images/crimes/street.png" border="0" /><br /><br />Enter the bank with a gun, threaten to shoot if money isn't handed over.<br><br>
<?php echo "$chance[0]"; ?>% <input type="radio" name="radiobutton" value="0">
</td>
<td align="center" class="tableborder">
<img src="images/crimes/street.png" border="0" /><br /><br />Try to crack the safe inside the bank.<br><br>
<?php echo "$chance[1]"; ?>% <input type="radio" name="radiobutton" value="1">
</td>
</tr>

<tr>
<td align="center" class="tableborder">
<img src="images/crimes/street.png" border="0" /><br /><br />Take 5 hostages and take all the money from the cashier.<br><br>
<?php echo "$chance[2]"; ?>% <input type="radio" name="radiobutton" value="2">
</td>
<td align="center" class="tableborder">
<img src="images/crimes/street.png" border="0" /><br /><br />Kill the manager and take over the bank. Leave the next week with thousands!<br><br>
<?php echo "$chance[3]"; ?>% <input type="radio" name="radiobutton" value="3">
</td></tr>

<tr><td colspan="3" align="center" class="tableborder">
<input name="commit" type="submit" id="submit" class="custombutton" value="Commit Crime">
<input name="category" type="hidden" value="BankRobbery">
</td></tr>
</table>

<?php }elseif ($cat == "CornerShop"){ ?>
<table width="53%" cellpadding="0" cellspacing="0" class="table1px" align="center">
<tr><td height="30" colspan="3" align="center" class="gradient" valign="middle">Crimes - Corner Shop!</td></tr>	
<tr>
<td align="center" class="tableborder">
<img src="images/crimes/shop.png" border="0" /><br /><br />Slip some items into your pocket and sell them to kids on the street.<br><br>
<?php echo "$chance[4]"; ?>% <input type="radio" name="radiobutton" value="4">
</td>
<td align="center" class="tableborder">
<img src="images/crimes/shop.png" border="0" /><br /><br />Break in at night and steal everything. Sell it all at an auction.<br><br>
<?php echo "$chance[5]"; ?>% <input type="radio" name="radiobutton" value="5">
</td>
</tr>

<tr>
<td align="center" class="tableborder">
<img src="images/crimes/shop.png" border="0" /><br /><br />Take the owner hostage and steal all the money from the cashier.<br><br>
<?php echo "$chance[6]"; ?>% <input type="radio" name="radiobutton" value="6">
</td>
<td align="center" class="tableborder">
<img src="images/crimes/shop.png" border="0" /><br /><br />Kill the manager and take his credit card. Withdraw all the money from it.<br><br>
<?php echo "$chance[7]"; ?>% <input type="radio" name="radiobutton" value="7">
</td></tr>

<tr><td colspan="3" align="center" class="tableborder">
<input name="commit" type="submit" id="submit" class="custombutton" value="Commit Crime">
<input name="category" type="hidden" value="CornerShop">
</td></tr>
</table>
<?php }elseif ($cat == "Factory"){ ?>
<table width="53%" cellpadding="0" cellspacing="0" class="table1px" align="center">
  <tr>
    <td height="30" colspan="3" align="center" class="gradient" valign="middle">Crimes - Factories!</td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/factory.png" border="0" /><br />
        <br />
      Steal some illegal products from a steal-works factory, then sell them.<br>
      <br>
        <?php echo "$chance[8]"; ?>%
      <input type="radio" name="radiobutton" value="8">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/factory.png" border="0" /><br />
        <br />
      Take a worker hostage, take his uniform and pretend to work there. Take his pay at the end of the day.<br>
      <br>
        <?php echo "$chance[9]"; ?>%
      <input type="radio" name="radiobutton" value="9">
    </td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/factory.png" border="0" /><br />
        <br />
      Enter the factory with a gun & steal some brass. Sell it for thousands on the web.<br>
      <br>
        <?php echo "$chance[10]"; ?>%
      <input type="radio" name="radiobutton" value="10">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/factory.png" border="0" /><br />
        <br />
      Kidnap the manager and his family, then take his money & all his earnings.<br>
      <br>
        <?php echo "$chance[11]"; ?>%
      <input type="radio" name="radiobutton" value="11">
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="tableborder"><input name="commit" type="submit" id="commit" class="custombutton" value="Commit Crime">
        <input name="category" type="hidden" value="Factory">
    </td>
  </tr>
</table>
<?php }elseif ($cat == "Company"){ ?>
<table width="53%" cellpadding="0" cellspacing="0" class="table1px" align="center">
  <tr>
    <td height="30" colspan="3" align="center" class="gradient" valign="middle">Crimes - Companies!</td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/big.png" border="0" /><br />
        <br />
      Use fake ID to proccess a big order for free, then sell the order.<br>
      <br>
        <?php echo "$chance[12]"; ?>%
      <input type="radio" name="radiobutton" value="12">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/big.png" border="0" /><br />
        <br />
      Take packages out of the company, trying not to be noticed.<br>
      <br>
        <?php echo "$chance[13]"; ?>%
      <input type="radio" name="radiobutton" value="13">
    </td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/big.png" border="0" /><br />
        <br />
      Go to the warehouse and take the manager at gunpoint, then steal the cash inside.<br>
      <br>
        <?php echo "$chance[14]"; ?>%
      <input type="radio" name="radiobutton" value="14">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/big.png" border="0" /><br />
        <br />
      Hack into there web system, and transfer the money to your own bank account.<br>
      <br>
        <?php echo "$chance[15]"; ?>%
      <input type="radio" name="radiobutton" value="15"> 
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="tableborder"><input name="commit" type="submit" id="commit" class="custombutton" value="Commit Crime">
        <input name="category" type="hidden" value="Company">
    </td>
  </tr>
</table>
<?php }elseif ($cat == "Internet"){ ?>
<table width="53%" cellpadding="0" cellspacing="0" class="table1px" align="center">
  <tr>
    <td height="30" colspan="3" align="center" class="gradient" valign="middle">Crimes - The Internet!</td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/internet.png" border="0" /><br />
        <br />
      Hack into a small business and take there cash.<br>
      <br>
        <?php echo "$chance[16]"; ?>%
      <input type="radio" name="radiobutton" value="16">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/internet.png" border="0" /><br />
        <br />
      Use PC World's system to receive bank details.<br>
      <br>
        <?php echo "$chance[17]"; ?>%
      <input type="radio" name="radiobutton" value="17">
    </td>
  </tr>
  <tr>
    <td align="center" class="tableborder"><img src="images/crimes/internet.png" border="0" /><br />
        <br />
    Delete files from a website and sue them for not giving what they say.<br>
      <br>
        <?php echo "$chance[18]"; ?>%
      <input type="radio" name="radiobutton" value="18">
    </td>
    <td align="center" class="tableborder"><img src="images/crimes/internet.png" border="0" /><br />
        <br />
      Hack the ultimate Bill Gates. Copy all the microsoft files to make your own business.<br>
      <br>
        <?php echo "$chance[19]"; ?>%
      <input type="radio" name="radiobutton" value="19">
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="tableborder"><input name="commit" type="submit" id="commit" class="custombutton" value="Commit Crime">
        <input name="category" type="hidden" value="Internet">
    </td>
  </tr>
</table>
<?php } ?>
<?php } ?>
</form>

		

<?php include_once "incfiles/foot.php"; ?>
</body>
</html>