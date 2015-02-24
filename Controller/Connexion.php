<?php
class Controller_Connexion extends Controller_Template{
	
	//----- CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Joueur();
		
	}

	//----- Page d'accueil de Connexion : formulaire de connexion
	public function home(){
		$title 	= "Connexion au site";
		$params = array($title);
		
		$this->requireView("connexion","home",$params);
	}
	
	//----- Validateur du formulaire
	public function valider() {
		
		$l=$_POST['login'];
		$p=$_POST['pass'];
		
		if ($this->selfModel->selectByNameAndPass($l, $p) > 0) {
		
			$_SESSION['login']=$l;
			$_SESSION['id']= $this->selfModel->getID($l);
			$id = $_SESSION['id'];
			$_SESSION['droit']= $this->selfModel->getDroit($id);
			
			$message = "Bienvenue ".$_SESSION['login'];
			
			$params = array($message);
			$this->requireView("connexion","display",$params);
		} else {
			
			$title = "Connexion au site";
			$error = "Login ou mot de passe incorrect";
			$params = array($title,$error);
			$this->requireView("connexion","home",$params);
		}
	}
	
}

?>
