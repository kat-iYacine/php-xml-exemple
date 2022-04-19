<?php

$s=$_POST['spec'];
$n=$_POST['niv'];

 $con=  new mysqli("localhost","root","","etu_info")or die(mysqli_error($con));

 $sql="SELECT cours.jour,cours.heure_debut,cours.heure_fin,modules.nom_mod,enseignant.nom_ens,salles.nom_salle
       FROM  cours,modules,enseignant,salles,promotion,specialites
       WHERE cours.id_mod=modules.id_mod AND
              cours.id_ens=enseignant.id_ens AND
              cours.id_salle=salles.id_salle AND
              cours.id_promo=promotion.id_promo AND
              promotion.id_speci=specialites.id_speci AND
              promotion.niveau='$n' AND
              specialites.nom_speci='$s'";

  
   $result = mysqli_query($con,$sql);	

	$victor = array();

	if (mysqli_num_rows($result)> 0) {
		while($row = $result->fetch_assoc()){			
			array_push($victor, $row);			
		}
			
		createXMLfile($victor);
	}

	//$result->free();
	$con->close();


function createXMLfile($victor){

 $filePath = 'time.xml';

   $dom = new DOMDocument('1.0', 'utf-8'); 

   $root = $dom->createElement('emploi'); 	

   for($i=0; $i<count($victor); $i++) {
    
   	$jour= htmlspecialchars($victor[$i]['jour']);   	
    $hd=   htmlspecialchars($victor[$i]['heure_debut']);
    $hf=   htmlspecialchars($victor[$i]['heure_fin']);
    $mod=  htmlspecialchars($victor[$i]['nom_mod']);
    $ens=  htmlspecialchars($victor[$i]['nom_ens']);
    $salle=htmlspecialchars($victor[$i]['nom_salle']);

  	$seance = $dom->createElement('seance');

    $j= $dom->createAttribute('jour');
    $j->value = $jour;    
    $h_d=$dom->createAttribute('heure_debut');
    $h_d->value = $hd;
    $h_f=$dom->createAttribute('heure_fin');
    $h_f->value = $hf;
    $m=$dom->createAttribute('module');
    $m->value = $mod;
    $e=$dom->createAttribute('enseignant');
    $e->value = $ens;
    $se=$dom->createAttribute('salle');
    $se->value = $salle;

    $seance->appendChild($j); 
      $seance->appendChild($h_d); 
       $seance->appendChild($h_f); 
         $seance->appendChild($e); 
           $seance->appendChild($m); 
          $seance->appendChild($se); 

    $root->appendChild($seance);   	
   }

   $dom->appendChild($root); 

   $dom->save($filePath);

   loadXMLfile($filePath);


}

function loadXMLfile($filePath) {

	$xml=simplexml_load_file("time.xml") or die("Error: Cannot create object");

	foreach($xml->children() as $seances){
		echo $seances->jour."\n";
		echo $seances->heure_debut."\n";
		echo $seances->heure_fin."\n";
		echo $seances->enseignant."\n";
		echo $seances->module."\n";
		echo $seances->salle."\n";
		echo "\n";
	}
}

?>                                                                                                                                                                                                                                                            
