<!DOCTYPE html>
<html>
<head>
	<title> Q10</title>
	<script>
	function getEmploi() {

		var promotion = document.getElementById('promotion').value;
		var jour = document.getElementById('jour').value;
		var seance_d = document.getElementById('seance_d').value;
		var seance_f = document.getElementById('seance_f').value;
		var modules = document.getElementById('modules').value;
		var salles = document.getElementById('salles').value;
		var enseignant = document.getElementById('enseignant').value;

		var request = new XMLHttpRequest();

	    request.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("result").innerHTML = this.responseText;
	      }
	    };
	    request.open("POST", "insertQ10.php", true);
  		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	    
	    request.send("promotion="+promotion+"&"+
	    	         "jour="+jour+"&"+
	    	         "seance_d="+seance_d+"&"+
	    	         "seance_f="+seance_f+"&"+
	    	         "modules="+modules+"&"+
	    	         "salles="+salles+"&"+
	    	         "enseignant="+enseignant);		
	}

		
</script>
</head>
<body>
	<table>
<?php
$con=mysqli_connect("localhost","root","","etu_info")or die(mysqli_error($con));
 $query=mysqli_query($con,"SELECT * FROM promotion");
$query1=mysqli_query($con,"SELECT * FROM modules");
$query2=mysqli_query($con,"SELECT * FROM salles");
$query3=mysqli_query($con,"SELECT * FROM enseignant");

echo'<h3>promotion</h3><select id="promotion" name="promotion">';
       while ($row=mysqli_fetch_array($query)) {

           echo '<option value="'.$row['id_promo'].'">'.$row['id_promo'].'</option>';       	
       } 

echo'</select><br>';

echo'<h3>jour</h3><select id="jour" name="jour">';
echo '<option value="dimanch">dimanch</option>';
echo '<option value="lundi">lundi</option>';
echo '<option value="mardi">mardi</option>';
echo '<option value="mercred">mercred</option>';
echo '<option value="jeudi">jeudi</option>';
echo'</select><br>';

echo '<h3>seance_d</h3><select id="seance_d" name="seance_d">';
echo '<option value="8.00">8.00</option>';
echo '<option value="9.30">9.30</option>';
echo '<option value="11.00">11.00</option>';
echo '<option value="14.00">14.00</option>';
echo '<option value="15.30">15.30</option>';
echo'</select><br>';


echo'<h3>seance_f</h3><select id="seance_f" name="seance_f">';
echo '<option value="9.30">9.30</option>';
echo '<option value="11.00">11.00</option>';
echo '<option value="12.30">12.30</option>';
echo '<option value="15.30">15.30</option>';
echo '<option value="17.00">17.00</option>';
echo'</select><br>';

echo'<h3>modules</h3><select id="modules" name="modules">';
       while ($row=mysqli_fetch_array($query1)) {

           echo '<option value="'.$row['id_mod'].'">'.$row['id_mod'].'</option>';       	
       } 

echo'</select><br>';

echo'<h3>salles</h3><select id="salles" name="salles">';
       while ($row=mysqli_fetch_array($query2)) {

           echo '<option value="'.$row['id_salle'].'">'.$row['id_salle'].'</option>';       	
       } 

echo'</select><br>';

echo'<h3>enseignant</h3><select id="enseignant" name="enseignant">';
       while ($row=mysqli_fetch_array($query3)) {

           echo '<option value="'.$row['id_ens'].'">'.$row['id_ens'].'</option>';       	
       } 

echo'</select><br>';

echo'<br>';

?>
<button onclick="getEmploi()">OK</button>
<div id="result"></div>
</table>
</body>
</html>