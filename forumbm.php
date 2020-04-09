<?php $forum=$_GET['forum']; ?>
<html>
<head>
<title>Thug Paradise :: Forum</title>
<link rel="stylesheet" href="../style.css" type="text/css">
</head>
<frameset rows="1" cols="317,*" framespacing="2" frameborder="yes" border="2" bordercolor="#FFFFFF">
<frame src="left.php?forum=<?php echo "$forum"; ?>" name="subjects" border="0" framspacing="0" noresize>

<frame src="black_market.php?type=credits" name="replies" border="0" framespacing="0" noresize>
</frameset> 
<noframes></noframes>
</body></noframes>
</html> 

