<?php
	
if(isset($_POST['spec']) && isset($_POST['niveau'])) {
	$niveau = $_POST['niveau'];
	$spec = $_POST['spec'];

	getStudents($spec,$niveau);
} else {
	echo "Variables Undefined";
}

function getStudents($spec,$niveau) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "etu_info";

	$conn = new mysqli($servername, $username, $password, $dbname);	

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql1 = "SELECT num_et,nom_et,prenom_et
				FROM etudiant,specialites,promotion,modules
				WHERE specialites.id_speci = promotion.id_speci
				AND promotion.id_speci = etudiant.id_speci
				AND nom_speci = '$spec'
				AND niveau = $niveau
				GROUP BY nom_et";	

	$sql2 = "SELECT nom_mod,modules.id_mod
				FROM modules,specialites,promotion,cours
				WHERE cours.id_promo = promotion.id_promo
				AND promotion.id_speci = specialites.id_speci
				AND cours.id_mod = modules.id_mod
				AND nom_speci = '$spec'
				AND niveau = $niveau
				GROUP BY nom_mod";

	$etudiantArray = array();
	$moduleArray = array();

	$result = $conn->query($sql1);	

	if(!$result){
		echo $conn->error;
	}

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){			
			array_push($etudiantArray, $row);
		}			
	}

	$result = $conn->query($sql2);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){			
			array_push($moduleArray, $row);	
		}		
	}		

	createXMLfile($etudiantArray,$moduleArray,$spec,$niveau);			
}

function createXMLfile($etudiantArray,$moduleArray,$spec,$niveau) {
   $filePath = 'etudiants_modules.xml';

   $dom = new DOMDocument('1.0', 'utf-8'); 

   $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="etudiants_modules.xsl"');

   $dom->appendChild($xslt);

   $root = $dom->createElement('promotion');	
   $root->setAttribute('option',$spec);
   $root->setAttribute('niveau',$niveau);

   $etudiants_root = $dom->createElement('etudiants');
   $modules_root = $dom->createElement('modules');

   $root->appendChild($etudiants_root);
   $root->appendChild($modules_root);

   for($i=0; $i<count($etudiantArray); $i++) {
   		$etudiant = $dom->createElement('etudiant');

		$num_et = $etudiantArray[$i]['num_et'];   		
		$nom_et = $etudiantArray[$i]['nom_et'];
		$prenom_et = $etudiantArray[$i]['prenom_et'];

		$etudiant->setAttribute('numInscription', $num_et);
		$etudiant->setAttribute('nom', $nom_et);
		$etudiant->setAttribute('prenom', $prenom_et);

		$etudiants_root->appendChild($etudiant);
   }

   for($i=0; $i<count($moduleArray); $i++) {
   		$module = $dom->createElement('module');

		$id_mod = $moduleArray[$i]['id_mod'];   		
		$nom_mod = $moduleArray[$i]['nom_mod'];

		$module->setAttribute('idModule', $id_mod);
		$module->setAttribute('nomModule', $nom_mod);

		$modules_root->appendChild($module);
   }   

   $dom->appendChild($root);
   $dom->save($filePath);
 }
?>