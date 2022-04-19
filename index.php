<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
</head>
<body>

<fieldset style="width: 30%;">
	<label>Spécialité</label>
	<input id="spec" type="text" name="spec" ><br><br><br>
	<label>Niveau</label>
	<input id="niveau" type="text" name="niveau" ><br><br><br>
	<button onclick="getEmploi()">Emploi</button><br><br><br><br>	
	<p id="result"></p>
</fieldset>


<script>
	function getEmploi() {
		var spec = document.getElementById('spec').value;
		var niveau = document.getElementById('niveau').value;
		var request = new XMLHttpRequest();
	    request.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("result").innerHTML = this.responseText;
	      }
	    };
	    request.open("POST", "getPlanning.php", true);
  		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	    
	    request.send("spec="+spec+"&"+"niv="+niveau);		
	}

		function showCustomer(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("txtHint").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET","livre.php?q="+str, true);
  xhttp.send();
}
</script>

</body>
</html>