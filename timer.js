function display(count,str) {
	document.getElementById(count).innerHTML = str;
}
function toMinuteAndSecond(x) {
	var hours = Math.floor(x/3600);
	var minutes = Math.floor(x/60) % 60;
	var seconds = x % 60;
	if(hours == "0"){
		return AddZero(minutes) + ":" + AddZero(seconds);
	}else{
		return AddZero(hours) + ":" + AddZero(minutes) + ":" + AddZero(seconds);
	}
}
function setTimer(cont,remain,actions) {
	(function countdown() {
		display(cont, toMinuteAndSecond(remain));		
		actions[remain] && actions[remain]();
		(remain -= 1) >= 0 && setTimeout(arguments.callee, 1000);
	})();
}
function AddZero(num) {
	return ((num >= 0)&&(num < 10))?"0"+num:num+"";
}