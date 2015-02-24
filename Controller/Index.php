<?php
class Controller_Index extends Controller_Template{
	
	//------ CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->modelJoueur = new Model_Joueur();
	}

	//------ Page d'accueil du site
	public function index(){
		$joueur = $this->modelJoueur->getPseudoNbParties();
		$params = array($joueur);
		
		$this->requireView("index","index",$params);
	}
}
?>
