<?php
class Controller_Defi extends Controller_Template{
	
	//---CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Defi();
		
	}

	//--- Page d'accueil de Defi : liste des défis
	public function home(){
		$title 		= "Défis";
		$defiSolo 	= $this->selfModel->getAllSolo();
		$defiMulti 	= $this->selfModel->getAllMulti();
		$params		= array($title,$defiSolo,$defiMulti);
		
		$this->requireView("defi","home",$params);
		
	}
	
	//--- Formulaire d'ajout d'un défi
	public function ajouter(){
		if ($_GET['nbj']!=1) {
			$title = "Créer un défi multi";
		}
		else {
			$title = "Créer un défi solo";
		}
		$params = array($title);
		
		$this->requireView("defi","addDefi",$params);
	}
	
	//--- Validateur du formulaire
	public function valider(){
		
		$design		=	$_POST['dsgn'];
		$niveau		=	$_POST['lvl'];
		$listDefi 	= array();
		//---Déclaration des paramètres pour le cas Multi
		if ($_GET['nbj']!=1) {
			$title 		= "Créer un défi multi";
			$nbjoueur	= $_POST['nbj'];
			$listSolo = $this->selfModel->getAllSolo();
			foreach ($listSolo as $solo) {
				array_push($listDefi,strtolower($solo['designation']));	
			}	
		}
		//---Déclaration des paramètres pour le cas Solo
		else {
			$title 		= "Créer un défi solo";
			$nbjoueur	= $_GET['nbj'];
			$listMulti = $this->selfModel->getAllMulti();
			foreach ($listMulti as $multi) {
				array_push($listDefi,strtolower($multi['designation']));	
			}	
		}
		//--- Champs non renseignés
		$params=array($title);
		if (empty($design) || empty ($niveau) || (empty($nbjoueur) && $_GET['nbj']!=1)){
			$error	= "L'un des champs n'est pas rempli";
			array_push($params,$error);
			
			$this->requireView("defi","addDefi",$params);
		}
		else {
			//--- Champ non numérique
			if (!is_numeric($nbjoueur) && !is_numeric($niveau)){
				$error	= "Entrez des chiffres entiers.";
				array_push($params,$error);
				
				$this->requireView("defi","addDefi",$params);

			}
			//--- Champ nombres non valides
			else if (((	$_POST['nbj']<2 || $_POST['nbj']>4) && $_GET['nbj'] !=1 ) || $niveau > 9 || $niveau < 0) {
				$error	= "Champs nombre joueurs ou niveau non valide";	
				array_push($params,$error);
				
				$this->requireView("defi","addDefi",$params);

			}
			//--- Tous les champs sont corrects
			else{
				if (!in_array(strtolower($design),$listDefi)) {
					//------ Appel à l'insertion du modèle
					$this->selfModel->insert($design, $nbjoueur, $niveau);
					$msg	= "Création du défi réussie";	
					array_pop($params);
					array_push($params,$msg);
				
					$this->requireView("defi","redirect",$params);
				}
				else {
					$error	= "Désignation déjà existante.";	
					array_push($params,$error);
				
					$this->requireView("defi","addDefi",$params);
				}
			}
		}		
	}
}
?>
