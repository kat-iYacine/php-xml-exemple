<?php
$p =$_POST['promotion'];
$j =$_POST['jour'];
$sb=$_POST['seance_d'];
$sf=$_POST['seance_f'];
$m =$_POST['modules'];
$s =$_POST['salles'];
$e =$_POST['enseignant'];



$con= mysqli_connect("localhost","root","","etu_info")or die(mysqli_error($con));

 $sql="INSERT INTO cours(id_promo,id_ens,id_salle,id_mod,jour,heure_debut,heure_fin) 
                 VALUES ('$p','$e','$s','$m','$j','$sb','$sf')";

 mysqli_query($con,$sql);	
?>