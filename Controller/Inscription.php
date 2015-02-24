<?php
class Controller_Inscription extends Controller_Template{

	//------- CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Joueur();
		
	}

	//------- Page d'accueil de Inscription : formulaire
	public function home(){
		$this->requireView("inscription","home",NULL);
	}
	
	//------- Validateur du formulaire
	public function valider(){
		//---- Déclaration/Récupération des variables
		$login	= $_POST['login'];
		$pass	= $_POST['pass'];
		$mail	= $_POST['mail'];
		
		//----Champs vides
		if (empty($login) || empty($pass) || empty($mail)) {
			$error	= "L'un des champs n'est pas rempli";
			$params = array($error);
			
			$this->requireView("inscription","home",$params);
		}
		else {
			//--- Vérificateur du format d'e-mail
			if (validEmail($mail)) {
				$this->selfModel->insert($login, $pass, $mail);
				$msg 	= "Vous êtes bien inscrit.";	
				$params = array($msg);
				
				$this->requireView("inscription","display",$params);
			}
			else {
				$error	= "Mail non valide";
				$params = array($error);
				
				$this->requireView("inscription","home",$params);
			}
		}		
	}
}
?>
