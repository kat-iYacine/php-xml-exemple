<?php

 $str=$_GET['q'];

 $con=mysqli_connect("localhost","root","","etu_info")or die(mysqli_error($con));
 
 $sql="SELECT cours.jour,cours.heure_debut,cours.heure_fin,modules.nom_mod,enseignant.nom_ens,salles.nom_salle
       FROM  cours,modules,enseignant,salles,promotion,specialites
       WHERE  cours.id_mod=modules.id_mod AND
              cours.id_ens=enseignant.id_ens AND
              cours.id_salle=salles.id_salle AND
              cours.id_promo=promotion.id_promo AND
              promotion.id_speci=specialites.id_speci AND
              promotion.id_promo=".$str;


 $query=mysqli_query($con,$sql)or die(mysqli_error($con));

echo '<table>';
echo'<tr>';

echo '<th>jour</th>';
echo '<th>heure_debut</th>';
echo '<th>heure_fin</th>';
echo '<th>module</th>';
echo '<th>enseignant</th>';
echo '<th>lien</th>';

echo '</tr>';
  while ($row=mysqli_fetch_array($query)){

 echo'<tr>';

echo '<th>'.$row['jour'].'</th>';
echo '<th>'.$row['heure_debut'].'</th>';
echo '<th>'.$row['heure_fin'].'</th>';
echo '<th>'.$row['nom_mod'].'</th>';
echo '<th>'.$row['nom_ens'].'</th>';
echo '<th>'.$row['nom_salle'].'</th>';

echo '</tr>';   

  }

  echo '</table>';
?>