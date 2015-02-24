<?php
class Controller_Groupe extends Controller_Template{

	//------ CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Groupe();
		$this->modelJoueur = new Model_Joueur();
	}
	
	//----- Page d'accueil de Groupe : liste de groupes
	public function home(){
		
			//--- Déclaration des variables
			$title 		= "Groupes";
			$listPseudo	= array();
			$listID		= array();
			$groupe 	= $this->selfModel->getAll();
			foreach ($groupe as $g) {
				$nbPartie = $this->selfModel->getNbPartieG($g["idgroupe"]);
				$pseudo1 = $this->modelJoueur->getPseudo($g['idjoueur1']);
				$pseudo2 = $this->modelJoueur->getPseudo($g['idjoueur2']);
				$pseudo3 = $this->modelJoueur->getPseudo($g['idjoueur3']);
				$pseudo4 = $this->modelJoueur->getPseudo($g['idjoueur4']);
				$listID  = array($g["idjoueur1"],$g["idjoueur2"],$g["idjoueur3"],$g["idjoueur4"]);
				$listPseudo[$g['idgroupe']] = array($g['nom'],$pseudo1,$pseudo2,$pseudo3,$pseudo4,$nbPartie,$listID);
			}
			$params = array($title, $listPseudo);
			
			$this->requireView("groupe", "home", $params);
	}
	
	//----- Formulaire d'ajout de groupe
	public function addGroupe(){
		$title 		= "Créer un groupe";
		$joueurs 	= $this->modelJoueur->getAllPseudo();
		$params 	= array($title,$joueurs);
		
		$this->requireView("groupe", "addGroupe", $params);
		
	}
	
	//----- Validateur du formulaire
	public function validerAjout(){
		//--- Déclaration et récupération des variables
		$name		=	$_POST['nom'];
		$nbjoueurs 	= 	$_POST['nbj'];
		$joueurs 	=	array();
		$listID 	= 	array();
		
		if (!empty($_POST['joueurs'])){
			foreach($_POST['joueurs'] as $selected){
				array_push($joueurs,$selected);
				array_push($listID,$this->modelJoueur->getID($selected));
			}
		}
		$count=count($joueurs);
		
		//---------- Gestion des cas d'erreur
		//----- Non connecté
		if (empty($_SESSION['id'])) {
			$error	="Vous devez être connecté";
			$params = array($error);
				
			$this->requireView("groupe","redirect", $params);
				
		} 
		//----- Champs vides
		else if (empty($name) || empty($nbjoueurs) || empty($_POST['joueurs'])) {
			$joueurs 	= $this->modelJoueur->getAllPseudo();
			$error		= "L'un des champs n'est pas rempli";
			$params 	= array($title,$joueurs,$error);
			
			$this->requireView("groupe","addGroupe", $params);
		}
		//----- Si tout est OK
		//----- et champ numérique
		else if(is_numeric($nbjoueurs)) {
			
			//- Mais que nombre participants différent du nombre de pseudos sélectionné
			if ($nbjoueurs!=$count) {
				$joueurs 	= $this->modelJoueur->getAllPseudo();
				$error 		= "Le nombre de joueurs entré et celui sélectionné ne sont pas égaux";
				$params 	= array($title,$joueurs,$error);
				
				$this->requireView("groupe","addGroupe", $params);
			}
			
			else {
				$listNom 	= array();
				$groupe 	= $this->selfModel->getAll();
				foreach ($groupe as $g){
					array_push($listNom,strtolower($g['nom']));	
				}
				//---- Vérification nom de groupe
				if(!in_array(strtolower($name),$listNom)) {
					//- Appel à l'insertion du modèle
					if ($this->selfModel->insertGroup($name, $_SESSION['id'],$listID[0],$listID[1],$listID[2]) > 0 ) {
					$msg 	= "Ajout réussi";
					$params = array($msg);
					
					$this->requireView("groupe","redirect",$params);
					} 
					else {
						$error	="L'ajout à la base de données a échoué";
						$params = array($title,$defi);
					
						$this->requireView("groupe","home", $params);
					}	
				}
				else {
					$joueurs 	= $this->modelJoueur->getAllPseudo();
					$error 		= "Ce nom de groupe existe déjà : trouvez-en un autre.";
					$params 	= array($title,$joueurs,$error);
				
					$this->requireView("groupe","addGroupe", $params);
				}
			} 
		}
		else {
			$joueurs 	= $this->modelJoueur->getAllPseudo();
			$error		= "Le nombre de joueur doit être un entier";
			$params 	= array($title,$joueurs,$error);
			
			$this->requireView("groupe","addGroupe", $params);
		}		
	}
}
