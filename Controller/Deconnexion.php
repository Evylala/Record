<?php
class Controller_Deconnexion extends Controller_Template{
	
	//----- CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_Joueur();	
	}

	public function home(){
		if(isset($_POST['valider'])) {
			header('Content-Type: text/html; charset=utf-8');
			$this->requireView("deconnexion","home",NULL);
			session_unset();
			session_destroy();			
		}
	}
}

?>
