<!DOCTYPE html>
<html>
<header>
<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>
<script>
	
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
  xhttp.open("GET","q9Script.php?q="+str, true);
  xhttp.send();
}
</script>
</header>
<body>

<form action="#"> 
<select name="customers" onchange="showCustomer(this.value)">

<?php
$con=mysqli_connect("localhost","root","","etu_info")or die(mysqli_error($con));
$query=mysqli_query($con,"SELECT * FROM promotion");
       while ($row=mysqli_fetch_array($query)) {

           echo '<option value="'.$row['id_promo'].'">'.$row['id_promo'].'</option>';       	
       } 

?>


</select>
</form>
<br>
<div id="txtHint">students info will be listed here...</div>



</body>