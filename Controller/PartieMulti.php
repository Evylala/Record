<?php
class Controller_PartieMulti extends Controller_Template{

	//------ CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		//----- 4 modèles
		$this->selfModel = new Model_PartieMulti();
		$this->modelDefi = new Model_Defi();
		$this->modelJoueur = new Model_Joueur();
		$this->modelGroupe = new Model_Groupe();
		
	}
	
	//------- Page d'accueil de PartieMulti : liste de Partie en multi
	public function home(){
			$title 	= "Les parties en multi";
			$partie = $this->selfModel->getList();
			$params	= array($title,$partie);
			
			$this->requireView("partieMulti","home",$params);
	}
	
	//------- Formulaire d'ajout de PartieMulti
	public function ajouter(){
			
			$title 			= "Créer une partie Multi";
			$nbparticipants = $this->modelGroupe->getNombreParticipants($_GET['idgroupe']);
			$count			= 0;
			
			foreach ($nbparticipants as $idj => $val) {
				if (!is_null($val['idjoueur1'])){
					$count=$count+1;
				}
				if (!is_null($val['idjoueur2'])){
					$count=$count+1;
				}
				if (!is_null($val['idjoueur3'])){
					$count=$count+1;
				}
				if (!is_null($val['idjoueur4'])){
					$count=$count+1;
				}
			}
			
			$defi 			= $this->modelDefi->getMultiSpec($count);
			$params 		= array($title, $defi);
			
			$this->requireView("partieMulti","addPartieMulti",$params);
	}

	//------- Validateur du formulaire
	public function validerAjout(){
			
		//----- Déclaration/Récupération des variables
		$iddefi 	= $_POST['defi'];
		$temps 		= $_POST['temps'];
		$acquis 	= $_POST['acquis'];
		$recit 		= $_POST['recit'];
		$idgroupe	= $_GET['idgroupe'];
		$idjoueur 	= $_SESSION['id'];
			
		$title = "Créer une partie multi";
			
		//----------------- Gestion des cas d'erreurs
		//--------- Non connecté
		if (empty($idjoueur)) {
			$defi 	= $this->modelDefi->getAllMulti();
			$error	= "Vous devez être connecté";
			$params = array($title, $defi, $error);
				
			$this->requireView("partieMulti","redirect", $params);	
		} 
		//--------- Champs vides
		else if (empty($iddefi) || empty($temps) || empty($acquis) || empty($recit)) {
			$defi 	= $this->modelDefi->getAllMulti();
			$error	= "L'un des champs n'est pas rempli";
			$params = array($title,$defi,$error);
				
			$this->requireView("partieMulti","addPartieMulti", $params);
					
		} 
		//----- Champs numérique
		else if(is_numeric($temps)) {
					
			// ----Appel à l'insertion du modèle
			if ($this->selfModel->insertPartie($temps, $acquis, $idgroupe, $iddefi, $recit) > 0) {
				$msg 	= "Ajout réussi";
				$params = array($msg);
						
				$this->requireView("partieMulti","redirect",$params);
			} 
			else {
				$defi 	= $this->modelDefi->getAllMulti();
				$error	= "L'ajout à la base de données a échoué";
				$params = array($title,$defi,$error);
					
				$this->requireView("groupe","home&ajout=true", $params);
			}				
		} 
		//----- Champs non numérique
		else {
			$defi 	= $this->modelDefi->getAllMulti();
			$error	= "Le temps de jeu doit être un entier";
			$params = array($title,$defi,$error);
					
			$this->requireView("groupe","home&ajout=true", $params);
		}
	}
	
	//-------- Formulaire de modification
	public function modifier() {
		
		$title 	= "Modifier une partie multi";
		$defi 	= $this->modelDefi->getAllMulti();
		$partie = $this->selfModel->getById($_POST['idpartie']);
		$params = array($title,$defi,$partie, $error,$_POST['idpartie']);
		
		$this->requireView("partieMulti","modifPartieMulti", $params);
	}
	
	//--------- Validateur du formulaire
	public function validerModif() {
		
		//----- Déclaration/Récupération des variables
		$idpartie 	= $_POST['idpartie'];
		$iddefi 	= $_POST['defi'];
		$tpsjeumin 	= $_POST['tpsjeu'];
		$acquis 	= $_POST['acquis'];
		$recit 		= $_POST['recit'];
		$idjoueur 	= $_SESSION['id'];
		
		$title = "Modifier une partie";
			
		//------------------ Gestion des cas d'erreurs
		//-------- Non connecté
		if (empty($_SESSION['id'])) {
			$error	= "Vous devez être connecté";	
			$params = array($error);
			
			$this->requireView("partieMulti","redirect",$params);
		}
		else if (empty($idpartie)) {
			$defi 	= $this->modelDefi->getAllMulti();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "Erreur sur l'id de la partie";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieMulti","modifPartieMulti", $params);
			
		} 
		//--------- Champs vides
		else if (empty($iddefi) || empty($tpsjeumin) || empty($acquis) || empty($recit)) {
			$defi 	= $this->modelDefi->getAllMulti();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "L'un des champs n'est pas rempli";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieMulti","modifPartieMulti", $params);
					
		} 
		
		//--------- Champs non numérique
		else if(!is_numeric($tpsjeumin)) {
			$defi 	= $this->modelDefi->getAllMulti();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "Le temps de jeu doit être un entier";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieMulti","modifPartieMulti", $params);		
		} 
		else {
			//----- Appel à la modification du modèle
			if ($this->selfModel->updatePartie($iddefi, $tpsjeumin, $acquis, $recit, $idpartie) > 0) {
				$msg 	= "Modification réussie";
				$params = array($msg);
				
				$this->requireView("partieMulti","redirect",$params);
			} else {
				$defi 	= $this->modelDefi->getAllMulti();
				$partie = $this->selfModel->getById($idpartie);
				$error	= "La modification a échoué";
				$params = array($title,$defi,$partie,$error,$idpartie);
				
				$this->requireView("partieMulti","modifPartieMulti", $params);
			}
		}
	}
}
?>
