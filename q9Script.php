<?php

$str=$_GET['q'];

 $con=mysqli_connect("localhost","root","","etu_info")or die(mysqli_error($con));
 
 $sql="SELECT * FROM `etudiant` WHERE id_promo=".$str;


 $query=mysqli_query($con,$sql)or die(mysqli_error($con));

echo '<table>';
echo'<tr>';

echo '<th>num_et</th>';
echo '<th>nom_et</th>';
echo '<th>prenom_et</th>';
echo '<th>adresse</th>';

echo '</tr>';
  while ($row=mysqli_fetch_array($query)){

 echo'<tr>';

echo '<th>'.$row['num_et'].'</th>';
echo '<th>'.$row['nom_et'].'</th>';
echo '<th>'.$row['prenom_et'].'</th>';
echo '<th>'.$row['adresse'].'</th>';


echo '</tr>';   

  }

  echo '</table>';


$sql="SELECT modules.nom_mod 
      FROM  modules,cours 
      WHERE cours.id_mod=modules.id_mod
      AND cours.id_promo=".$str;


  $query=mysqli_query($con,$sql)or die(mysqli_error($con));

echo '<table>';
echo'<tr>';

echo '<th>les modules </th>';


echo '</tr>';
  while ($row=mysqli_fetch_array($query)){

 echo'<tr>';

 echo '<th>'.$row['nom_mod'].'</th>';

 echo '</tr>';   

  }

  echo '</table>';

?>