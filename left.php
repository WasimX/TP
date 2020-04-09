<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

  $si=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));
  $chance = explode("-", $si->forumcolour);
  $col1 = $chance[0];   $col2 = $chance[1];   $col3 = $chance[2];
  
  
$forummod=$fetch->forummod;
$forum=$_GET['forum'];
$page=$_GET['page'];
$crewtbh = mysqli_query( $connection, "SELECT * FROM `accounts` WHERE `username` = '$username'");
$crewlol = mysqli_fetch_object($crewtbh);

////$cheee1=mysqli_query( $connection, "SELECT * FROM `replys`");
/////while($cheee=mysqli_fetch_object($cheee1)){
//////$checccck=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM posts WHERE id='$cheee->idto'"));
///////if($checccck == "0"){
//////mysqli_query( $connection, "DELETE FROM replys WHERE idto='$cheee->idto'");
///////echo"i,";
/////}}

if ($forum == "crew"){
if ($fetch->crew == "0" || $fetch->crew == ""){ 
exit("<link rel=stylesheet href=style.css type=text/css> You are not in a gang."); } }

echo "<link rel=stylesheet href=style.css type=text/css>";
  $forum_count          = 30;               
    $query_count    = "SELECT * FROM `posts` WHERE forum='$forum'";    
    $result_count   = mysqli_query( $connection, $query_count);    
    $totalrows      = mysqli_num_rows($result_count); 

if(empty($page)){
        $page = 1;
    }
        
    $forum_look = $page * $forum_count - ($forum_count);  
  
  

    $numofpages = $totalrows / $forum_count; 
  mysqli_query( $connection, "DELETE * FROM `posts` WHERE `forum`='$forum' ORDER BY `lastreply` DESC LIMIT `120`, `500`");
  ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
.style1 {
  color: #000000;
  font-weight: bold;
}
.tableborders {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 10px; 
  font-style: normal;
  line-height: normal;
  border-color: #000000;
  color: #FFFFFF;
  background-color: #565656;
  padding: 1px; 
} 
</style>

  <link href="style.css" rel="stylesheet" type="text/css" />
<form action="" method="post">

    <center><a href="newtopic.php?forum=<?php echo "$forum"; ?>" target='replies'>Create New Topic</a><a href="left.php?forum=<?php echo"$forum";?>&page=<?php echo"$page";?>" target="_self"> <img src="http://i60.tinypic.com/2ll1qhx.jpg" border="0" width="13" height="14" /></a></center><br>
    
     <center><?php if($page != 1){ 
        $pageprev = $page - 1;
        
        echo("<center><a href=\"left.php?forum=$forum&page=$pageprev\"> Prev</a> "); 
    }?>
      <td width="68%" border="0" align="center" class="blanktable"><?php

 
    
    for($i = 1; $i <= $numofpages; $i++){
        if($i == $page){
            echo($i." ");
        }else{
            echo("<a href=\"left.php?forum=$forum&page=$i\">$i</a> ");
        }
    }


    if(($totalrows % $forum_count) != 0){
        if($i == $page){
            echo($i." ");
        }else{
            echo("<a href=\"left.php?forum=$forum&page=$i\">$i</a> ");
        }
    }

    
  
?></td>
      <td width="16%"  align="right" border="1" class="blanktable"><?php if(($totalrows - ($forum_count * $page)) > 0){
        $pagenext = $page + 1;
         
        echo(" <a href=\"left.php?forum=$forum&page=$pagenext\">Next>></a>"); 
    }else{    }  ?></td>
    </tr><?php if($fetch->userlevel == "4" || $fetch->userlevel == "3" || $fetch->userlevel == "1"){ ?>
    <tr>
      <td height="30" colspan="3"  align="center" border="1" class="blanktable"><input name='perform' type='submit' id='perform' value='Delete Selected' class="custombutton" />
    </tr><?php } ?>
  </table>
</center>

 <table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr bgcolor="#FFFFFF">
      <td class="gradient" border="1" colspan="3" height="30">Topic</td>
    </tr>
  
 <?php if (isset($_POST['perform']) && $_POST['perform'] == 'Delete Selected')
{
  $id = array();
  $id = $_POST['removeid'];
  if (count($id) > 0)
  {
     foreach ($id as $removeid)
     {
        mysqli_query( $connection, "DELETE FROM posts WHERE id='$removeid'");
mysqli_query( $connection, "DELETE FROM postreplys WHERE idto='$removeid'");
     }
  }
}

if(strip_tags($_POST['search'])){
     $searchfor=strip_tags($_POST['searchfor']);
     $forum=$_GET['forum'];
     
     if($forum == "crew"){

      $query="SELECT * FROM `posts` WHERE `gname`='$fetch->gang' AND gang='1'  AND title LIKE '%$searchfor%' ORDER BY `lastreply` DESC LIMIT $forum_look, $forum_count"; 
     }else{
      $query="SELECT * FROM `posts` WHERE gang='0' AND forum='$forum' AND title LIKE '%$searchfor%' ORDER BY `lastreply` DESC LIMIT $forum_look, $forum_count"; 
      }
     $query=mysqli_query( $connection, "$query"); 
 $num=mysqli_num_rows($query);
 
 $col="0";
 
 while($fo=mysqli_fetch_object($query)){
  if($fetch->userlevel == "4" || $fetch->userlevel == "1" || $fetch->userlevel == "3"){ 
 $reddd = "<input type='checkbox' name='removeid[]' value='$fo->id'>";
 }
 
 if ($col=="0"){ $td="#000000"; $col="1"; }else{ $td="#000000"; $col="0"; }
 $hehe=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM postreplys WHERE idto='$fo->id'")); 
 echo "<td height=\"20\" colspan=2 align=\"left\" nowrap class=\"blanktable\" border=\"1\">";
  if ($fo->imp == "1" && $fo->sticky == "0" ){ echo"<font color=$col1><b><u>Important</u>:&nbsp;</b></font>"; }
   if ($fo->imp == "1" && $fo->sticky == "1" ){ echo"<font color=$col1><b><u>Important</u>:&nbsp;</b></font>"; }
    if ($fo->sticky == "1" && $fo->imp == "0" ){ echo"<font color=$col2><b>Sticky:&nbsp;</b></font>"; }
  if($fo->locked == "1"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></a><b><font color=$col3> - (LOCKED)</font></b>$reddd</td></tr>"; }
elseif($fo->locked == "0"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></a>$reddd</td></tr>"; }
 }
 }elseif(strip_tags($_POST['search2'])){
     $searchfor=strip_tags($_POST['searchfor2']);
 
    if($forum == "crew"){$query="SELECT * FROM `posts` WHERE gang='1'  AND `gname`='$fetch->gang' AND username LIKE '%$searchfor%' ORDER BY `lastreply` DESC LIMIT $forum_look, $forum_count";

  }else{
   $query="SELECT * FROM `posts` WHERE gang='0' AND forum='$forum'  AND username LIKE '%$searchfor%' ORDER BY `lastreply` DESC LIMIT $forum_look, $forum_count";
     }
     $query=mysqli_query( $connection, "$query");
 $num=mysqli_num_rows($query);
 $col="0";
 while($fo=mysqli_fetch_object($query)){
   if($fetch->userlevel == "4"){
 $reddd = "<input type='checkbox' name='removeid[]' value='$fo->id'>";
 }
 
 if ($col=="0"){ $td="#000000"; $col="1"; }else{ $td="#000000"; $col="0"; }
 $hehe=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM postreplys WHERE idto='$fo->id'"));
 echo "<td height=\"20\" colspan=2 align=\"left\" border=\"1\" nowrap class=\"blanktable\">"; if ($fo->imp == "1" && $fo->sticky == "0" ){ echo"<font color=$col1><b><u>IMPORTANT</u>:&nbsp;</b>"; } if ($fo->imp == "1" && $fo->sticky == "1" ){ echo"<font color=$col1><b><u>IMPORTANT</u>:&nbsp;</b>"; } if ($fo->sticky == "1" && $fo->imp == "0" ){ echo"<font color=$col2>Sticky:&nbsp;</font>
"; }  
 if($fo->locked == "1"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></b></a><b><font color=$col3> - (LOCKED)</font></b></td> </tr> </tr>"; }
elseif($fo->locked == "0"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></a>$reddd</td></tr>"; }
 }
 }else{
 
  
      if($forum == "crew")
{   $query="SELECT * FROM `posts` WHERE gang='1' AND `gname`='$fetch->crew' ORDER BY `lastreply` DESC LIMIT $forum_look, $forum_count";
$crewtbh = mysqli_query( $connection, "SELECT * FROM `accounts` WHERE `username` = '$username'");
$crewlol = mysqli_fetch_assoc($crewtbh);


   }else{
   $query="SELECT * FROM `posts` WHERE gang='0' AND forum='$forum' ORDER BY `imp` DESC, `sticky` DESC, `lastreply` DESC LIMIT  $forum_look, $forum_count";}
     
      $query=mysqli_query( $connection, "$query");
 $num=mysqli_num_rows($query);
  
  
 
  $col="0";
 while($fo=mysqli_fetch_object($query)){
   if($fetch->userlevel == "4" || $fetch->userlevel == "1" || $fetch->userlevel == "3"){
 $reddd = "</td><td align=right><input type='checkbox' name='removeid[]' value='$fo->id'>";
 }
 if ($col=="0"){ $td="#000000"; $col="1"; }else{ $td="#000000"; $col="0"; } 
 $hehe=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM postreplys WHERE idto='$fo->id'"));
 
 echo "<td height=\"20\" colspan=2 align=\"left\" nowrap class=\"tableborder\">"; if ($fo->imp == "1" && $fo->sticky == "0" ){ echo"<font color=$col1><b><u>Important</u>:&nbsp;</b>"; } if ($fo->imp == "1" && $fo->sticky == "1" ){ echo"<font color=$col1><b><u>Important</u>:&nbsp;</b>"; } if ($fo->sticky == "1" && $fo->imp == "0" ){ echo"<font color=$col2><b>Sticky:&nbsp;</b></font>
"; }  
 if($fo->locked == "1"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></b></a><b><font color=$col3> (locked)</font></b>$reddd</td></tr>"; }
elseif($fo->locked == "0"){echo"<a href='right.php?viewtopic=$fo->id&forum=$forum' target='replies'><b>".lang($fo->title)."</b></a>$reddd</td></tr>"; }
 } }
 

 
?>

  </table>
  

</form>
