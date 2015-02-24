<?php
session_start();
require 'functions.php';
spl_autoload_register('generic_autoload');

// on instancie la connexion à la base
Controller_Template::$db = new MyPDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=Hoai-Nam', 'Hoai-Nam', 'edyvamud');

if(empty($_GET['control'])){
	$controller = Controller_Index::getInstance('Index');
	$controller->index();
}
else{
	switch($_GET['control']){
	 	case 'joueur':
			$controller = Controller_Joueur::getInstance('Joueur');
			
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'modifierDroit':
					$controller->modifierDroit();
					break;
				case 'validerModifDroit':
					$controller->validerModifDroit();
					break;
			}
			
			break;
		case 'inscription':
			$controller = Controller_Inscription::getInstance('Inscription');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'valider':
					$controller->valider($_GET['valider']);
					break;
			}
			break;
		case 'connexion':
			$controller = Controller_Connexion::getInstance('Connexion');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'valider':
					$controller->valider($_GET['valider']);
					break;
			}
			break;
		case 'deconnexion':
			$controller = Controller_Deconnexion::getInstance('Deconnexion');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
			}
			break;
		case 'defi':
			$controller = Controller_Defi::getInstance('Defi');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'addDefi':
					$controller->ajouter();
					break;
				case 'valider':
					$controller->valider();
					break;
			}
			break;
		case 'partieSolo':
			$controller = Controller_PartieSolo::getInstance('PartieSolo');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'addPartieSolo':
					$controller->ajouter();
					break;
				case 'validerAjout':
					$controller->validerAjout();
					break;
				case 'modifPartieSolo':
					$controller->modifier();
					break;
				case 'validerModif':
					$controller->validerModif();
					break;
				case 'supprimerPartieSolo':
					$controller->supprimer();
					break;
				case 'validerSuppr':
					$controller->validerSuppr();
					break;
				case 'commentaires':
					$controller->commentaires();
					break;
				case 'validAjoutCom':
					$controller->validAjoutCom();
					break;
				case 'supprimerComm':
					$controller->supprimerComm();
					break;
				case 'validerSupprComm':
					$controller->validerSupprComm();
					break;
			}
			break;
			
		case 'partieMulti':
			$controller = Controller_PartieMulti::getInstance('PartieMulti');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'addPartieMulti':
					$controller->ajouter();
					break;
				case 'validerAjout':
					$controller->validerAjout();
					break;
				case 'modifPartieMulti':
					$controller->modifier();
					break;
				case 'validerModif':
					$controller->validerModif();
					break;
			}
			break;
		case 'groupe':
			$controller = Controller_Groupe::getInstance('Groupe');
			switch($_GET['action']) {
				case 'home':
					$controller->home();
					break;
				case 'addGroupe':
					$controller->addGroupe();
					break;
				case 'validerAjout':
					$controller->validerAjout();
					break;
			}
			break;
	}
}
?>
