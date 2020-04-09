<script type='javascript'>
var old = "0";


var oldClass = "select";


var current = "0";


function SelectOption(id, currentClass) {


	if(id != current){


		if(current != "0"){


			old=current;


		}


		if(old != "0"){


			document.getElementById(old).className = oldClass;


		}


		currentClass=(currentClass == undefined) ? "select" : currentClass;


		oldClass=currentClass;


		document.getElementById(id).className = "selected";


		document.getElementById("select").value = id;


		current=id;


	}}
	</script>