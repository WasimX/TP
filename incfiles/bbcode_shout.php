<?php

class bbCode {
	
	function generate($string) {
	 
	 $text = $string;
		
		$bbcode = array(
		
		    '|\[b\](.*?)\[/b\]|s',
		    '|\[i\](.*?)\[/i\]|s',
		    '|\[u\](.*?)\[/u\]|s',
		    '|\[url=(.*?)\](.*?)\[/url\]|s',
		    '|\[colour=(.*?)\](.*?)\[/colour\]|s',
		    '|\[blink\](.*?)\[/blink\]|s',
		
		);
		
		$html = array(
		
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<a href="$1">$2</a>',
			'<span style="color:$1">$2</span>',
                   '<blink>$1</blink>',

			
		);
		
		$output = preg_replace($bbcode, $html, $text);
		
		$output = nl2br($output);
		
			return $output;
		
	}
	
}

$bbcode = new bbCode;

?>