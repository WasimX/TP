<h2>Extra Protection - Formula testing</h2>

<p>Numbers from this may or may not be the ones that go live. This is just a testing formula to see what it'll output at certain values.</p>
<font color='red'>
<p><b>Basic Formula</b>: (((XP - 225,000) / 5000) * 0.72)</br>
<i>This means that for every 5000 XP above 225k you will receive 0.72% extra protection.</i></p>
</font>
<p>-------------------------</p>
<form method='post'>
XP: <input type='text' name='xp' id='xp'>
Armour: <select name='armour'>
	<option value='1.00'>None (0%)</option>
	<option value='1.02'>Helmet (2%)</option>
	<option value='1.04'>Ballistic (4%)</option>
	<option value='1.06'>ChainMail (6%)</option>
	<option value='1.08'>StabVest (8%)</option>
	<option value='1.10'>Tactical Shield (10%)</option>
	<option value='1.15'>Full Metal Jacket (15%)</option>

</select>
<input type='submit' name='Submit' id='Submit'>
<p>-------------------------</p>
<h2>Health Exchange</h2>
<p>Numbers from this may or may not be the ones that go live.</p>
Health: <input type='text' name='hp' id='hp'>
Exchange For: <select name='exchange_for'>
	<option value='xp'>65% Health = 2,500 XP</option>
	<option value='credits'>4% Health = 1 Credit</option>
	<option value='fmj'>4% Health = 500 FMJ</option>
	<option value='jhp'>2% Health = 800 JHP</option>
	<option value='money'>1% Health = 300K Money</option>
</select>
<input type='submit' name='Exchange' id='Exchange'>
<p>-------------------------</p>
<h2>FMJ Exchange</h2>
<p>Numbers from this may or may not be the ones that go live.</p>
FMJ: <input type='text' name='fmj' id='fmj'>
Exchange For: <select name='exchange_for_fmj'>
	<option value='fmj'>5,000 FMJ (Old) = 750 FMJ Bullets (New)</option>
	<option value='credits'>3,000 FMJ (Old) = 1 Credit</option>
</select>
<input type='submit' name='ExchangeFMJ' id='ExchangeFMJ'>
</form>
<p>-------------------------</p>
<?php

	if($_POST['Submit']){
		$xp = $_POST['xp'];
		$armour = $_POST['armour'];

		
		$bullets_to_kill = '160000';

		$extra_protection = ((($xp - 225000) / 5000) * 0.72);
		$extra_protection = round($extra_protection);

		$b_armour = ($bullets_to_kill * $armour);

		$extra_bullets = (($b_armour / 100) * $extra_protection);

		$complete_bullets = $b_armour + $extra_bullets;

		echo"<p><b>XP:</b> ".number_format($xp)."</p>";
		echo"<p><b>Armour Rating:</b> $armour</p>";
		echo"<p><b>Extra Pro:</b> $extra_protection%</p>";
		echo"<p><b>Bullets with 0% Ep:</b> ".number_format($b_armour)."</p>";
		echo"<p><b>Extra Bullets Needed:</b> ".number_format($extra_bullets)."</p>";
		echo"<p><b>Total:</b> ".number_format($complete_bullets)."</p>";


	}

	if($_POST['Exchange']){
		$hp = $_POST['hp'];
		$exchange_for = $_POST['exchange_for'];

		if($exchange_for == 'credits'){
			$receive = (($hp - 100) / 4);
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." credits.";
		}elseif($exchange_for == 'fmj'){
			$receive = (($hp - 100) / 4);
			$receive = $receive * 500;
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." FMJ bullets.";
		}elseif($exchange_for == 'jhp'){
			$receive = (($hp - 100) / 2);
			$receive = $receive * 800;
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." JHP bullets.";
		}elseif($exchange_for == 'money'){
			$receive = (($hp - 100) / 1);
			$receive = $receive * 300000;
			$receive = round($receive);
			echo"You will receive &pound;".number_format($receive)." money.";
		}elseif($exchange_for == 'xp'){
			$receive = (($hp - 100) / 100);
			$receive = $receive * 2500;
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." rankpoints.";
		}
	}

	if($_POST['ExchangeFMJ']){
		$fmj = $_POST['fmj'];
		$exchange_for_fmj = $_POST['exchange_for_fmj'];

		if($exchange_for_fmj == 'credits'){
			$receive = ($fmj / 3000);
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." credits.";
		}elseif($exchange_for_fmj == 'fmj'){
			$receive = ($fmj / 5000);
			$receive = $receive * 750;
			$receive = round($receive);
			echo"You will receive ".number_format($receive)." FMJ bullets.";
		}
	}

?>