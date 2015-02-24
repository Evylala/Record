<?php
class Controller_Joueur extends Controller_Template{

	//------ CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Joueur();
		
	}

	//------- Page d'accueil de Joueur : liste des joueurs
	public function home(){
		$title 	= "Joueurs";
		$joueur = $this->selfModel->getAll();
		$params	= array($title,$joueur);
		
		$this->requireView("joueur","home",$params);
	}
	
	//------- Outil administrateur : changement de droits
	public function modifierDroit() {
		
		$title 		= "Modification du statut de ";
		$pseudo 	= $this->selfModel->getPseudo($_POST['idjoueur']);
		$droit 		= $this->selfModel->getDroit($_POST['idjoueur']);
		$params 	= array($title, $_POST['idjoueur'], $pseudo, $droit);
		
		$this->requireView("joueur","modifierDroit",$params);
	}
	
	//------- Validateur du changement de droits
	public function validerModifDroit() {
		
		if (isset($_POST['idjoueur']) && isset($_POST['droit'])) {
			if ($this->selfModel->modifDroit($_POST['droit'], $_POST['idjoueur']) > 0) {
				$msg 	= "Modification réussie";
				$params = array($msg);
				
				$this->requireView("joueur", "redirect", $params);
			}
		}
	}
}
?>
