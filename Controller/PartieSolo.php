<?php
class Controller_PartieSolo extends Controller_Template{

	//------- CONSTRUCTEUR
	protected function __construct(){
		parent::__construct();
		$this->selfModel = new Model_PartieSolo();
		$this->modelDefi = new Model_Defi();
		$this->modelJoueur = new Model_Joueur();
		$this->modelCommentaireSolo = new Model_CommentaireSolo();
		
	}
	
	//------- Page d'accueil de PartieSolo : liste des partie en solo
	public function home(){
			$title 	= "Parties en solo";
			$partie = $this->selfModel->getAll();
			$nbCom 	= array();
			
			for ($i=0; $i < count($partie);$i++) {
				array_push($nbCom, $this->modelCommentaireSolo->compter($partie[$i]['idpartiei']));
			}
			$params = array($title, $partie,$nbCom);
			
			$this->requireView("partieSolo", "home", $params);
	}
	
	//------- Formulaire d'ajout de PartieSolo
	public function ajouter(){
			$title 	= "Créer une partie solo";
			$defi 	= $this->modelDefi->getAllSolo();
			$params = array($title, $defi);
			
			$this->requireView("partieSolo", "addPartieSolo", $params);
	}
	
	//------- Validateur du formulaire
	public function validerAjout(){
			
		//------- Déclaration/Récupération des variables
		$iddefi 	= $_POST['defi'];
		$tpsjeu 	= $_POST['tpsjeu'];
		$acquis 	= $_POST['acquis'];
		$recit 		= $_POST['recit'];
		$idjoueur 	= $_SESSION['id'];
			
		$title = "Créer une partie solo";
			
		//-------------------- Gestion des cas d'erreur
		//--------- Non connecté
		if (empty($idjoueur)) {
			$error	= "Vous devez être connecté";
			$params = array($error);
				
			$this->requireView("partieSolo","redirect", $params);
		}
		//--------- Champs vides
		else if (empty($iddefi) || empty($tpsjeu) || empty($acquis) || empty($recit)) {
			$defi 	= $this->modelDefi->getAllSolo();
			$error	= "L'un des champs n'est pas rempli";
			$params = array($title,$defi,$error);
				
			$this->requireView("partieSolo","addPartieSolo", $params);
					
		} 
		//--------- Cas non numérique
		else if(!is_numeric($tpsjeu)) {
			$defi 	= $this->modelDefi->getAllSolo();
			$error	="Le temps de jeu doit être un entier";
			$params = array($title,$defi,$error);
				
			$this->requireView("partieSolo","addPartieSolo", $params);
		//------------- Cas non positif
		} else if($tpsjeu<=0) {
			$defi 	= $this->modelDefi->getAllSolo();
			$error	="Le temps de jeu ne peut être négatif";
			$params = array($title,$defi,$error);
				
			$this->requireView("partieSolo","addPartieSolo", $params);
		
		//---------------- Appel à l'insertion du modèle
		} else if ($this->selfModel->insert($tpsjeu, $acquis, $idjoueur, $iddefi, $recit) > 0 && $this->modelJoueur->ajouterPartie($idjoueur) > 0) {
			$msg 	= "Ajout réussi";
			$params = array($msg);
			
			$this->requireView("partieSolo","redirect",$params);
		}  
		else {
			$defi 	= $this->modelDefi->getAllSolo();
			$error	= "L'ajout à la base de données a échoué";
			$params = array($title,$defi,$error);
				
			$this->requireView("partieSolo","addPartieSolo", $params);
		}		
	}
	
	//------- Formulaire de modification
	public function modifier() {
		
		$title 		= "Modifier une partie solo";
		$defi 		= $this->modelDefi->getAllSolo();
		$partie 	= $this->selfModel->getById($_POST['idpartie']);
		$params 	= array($title, $defi, $partie,$error, $_POST['idpartie']);
		
		$this->requireView("partieSolo","modifPartieSolo", $params);
	}
	
	//-------- Validateur du formulaire
	public function validerModif() {
	
		$idpartie 	= $_POST['idpartie'];
		$iddefi 	= $_POST['defi'];
		$tpsjeumin 	= $_POST['tpsjeu'];
		$acquis 	= $_POST['acquis'];
		$recit 		= $_POST['recit'];
		$idjoueur 	= $_SESSION['id'];
		
		$title = "Modifier une partie";
		
		//----------------------- Gestion des cas d'erreur
		//----------- Non connecté
		if (empty($idjoueur)) {
			$error	= "Vous devez être connecté";
			$params = array($error);
			
			$this->requireView("partieSolo","redirect", $params);
		} 
		else if (empty($idpartie)) {
			$defi 	= $this->modelDefi->getAllSolo();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "Erreur sur l'id de la partie";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieSolo","modifPartieSolo", $params);
		} 
		//---------- Champs vides
		else if (empty($iddefi) || empty($tpsjeumin) || empty($acquis) || empty($recit)) {
			$defi 	= $this->modelDefi->getAllSolo();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "L'un des champs n'est pas rempli";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieSolo","modifPartieSolo", $params);
		} 
		//---------- Champs non numérique
		else if(!is_numeric($tpsjeumin)) {
			$defi 	= $this->modelDefi->getAllSolo();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "Le temps de jeu doit être un entier";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieSolo","modifPartieSolo", $params);
			
		//-------------- Cas négatif
		} else if($tpsjeumin <=0) {
			$defi 	= $this->modelDefi->getAllSolo();
			$partie = $this->selfModel->getById($idpartie);
			$error	= "Le temps de jeu ne peut être négatif";
			$params = array($title,$defi,$partie,$error,$idpartie);
			
			$this->requireView("partieSolo","modifPartieSolo", $params);
		}
		else {
			//-------- Appel à la modification du modèle
			if ($this->selfModel->updatePartie($iddefi, $tpsjeumin, $acquis, $recit, $idpartie) > 0) {
				$msg 	= "Modification réussie";
				$params = array($msg);
				
				$this->requireView("partieSolo","redirect",$params);
			} 
			else {
				$defi 	= $this->modelDefi->getAllSolo();
				$partie = $this->selfModel->getById($idpartie);
				$error	= "La modification a échoué";
				$params = array($title,$defi,$partie,$error, $idpartie);
				
				$this->requireView("partieSolo","modifPartieSolo", $params);
			}
		}
	}
	
	//--------- Demande de suppression
	public function supprimer() {
		$title 	= "Supprimer une partie solo";
		$params = array($title,$_POST['idpartie']);
		
		$this->requireView("partieSolo","supprimerPartieSolo", $params);
	}
	
	//--------- Validateur de la suppression
	public function validerSuppr() {

		$idpartie = $_POST['idpartie'];
		$idjoueur = $this->selfModel->getIdJoueur($idpartie);
		
		if (empty($idpartie)) {
			$error	= "Erreur sur l'id de la partie";	
			$params = array($error);
			
			$this->requireView("partieSolo","redirect", $params);
		} 
		else if ($this->selfModel->deletePartie($idpartie) > 0 && $this->modelJoueur->enleverPartie($idjoueur) > 0) {
			$msg	= "Suppression réussie";
			$params = array($msg);
			
			$this->requireView("partieSolo","redirect",$params);
		
		} 
		else {echo "échec";}
	}
	
	//--------- Formulaire d'ajout de commentaire
	public function commentaires() {
		
		//------- Gestion des cas d'erreur
		if (!empty($_POST['idpartie'])) {
			$idpartie = $_POST['idpartie'];
		} 
		else {
			$idpartie = $_SESSION['idpartie'];
			$_SESSION['idpartie'] = NULL;
		}
		
		//------ Déclaration des variables
		$com 	= $this->modelCommentaireSolo->getById($idpartie);
		$partie = $this->selfModel->getById($idpartie);
		
		if (!empty($com)) {
			$title 	= "Commentaires";
			$params = array($title, $partie,$idpartie, $com );
			
			$this->requireView("partieSolo","commentaires", $params);
		} 
		else {
			$title 	= "Aucun commentaire";
			$params = array($title, $partie, $idpartie);
			
			$this->requireView("partieSolo","commentaires", $params);
		}
	}
	
	//---------- Validateur du formulaire
	public function validAjoutCom() {
		
		//------ Déclaration des variables
		$texte 		= $_POST['com'];
		$idpartie 	= $_POST['idpartie'];
		$idjoueur 	= $_SESSION['id'];
		$date 		= date('Y-m-d H:i:s');
		$com 		= $this->modelCommentaireSolo->getById($idpartie);
		$partie 	= $this->selfModel->getById($idpartie);
		
		if (!empty($com)) {
			$title = "Commentaires";
		} else {
			$title = "Aucun commentaire";
		}
		
		//----------------Gestion des cas d'erreur
		//-------- Entourloupe sur l'id de la partie
		if (empty($idpartie)) {
			$msg 	= "Erreur sur l'id de la partie";
			$params = array($title, $partie, $idpartie, $com, $msg);
			
			$this->requireView("partieSolo","commentaires", $params);
		} 
		//-------- Non connecté
		else if (empty($idjoueur)) {
			$msg 	= "Vous devez être connecté";
			$params = array($title, $partie, $idpartie, $com, $msg);
			
			$this->requireView("partieSolo","commentaires", $params);
		} 
		//-------- Champs vide
		else if (empty($texte)) {	
			$msg 	= "Champ vide";
			$params = array($title, $partie, $idpartie, $com, $msg);
			
			$this->requireView("partieSolo","commentaires", $params);
		} 
		//--------- Appel à l'insertion du modèle
		else {
			if ( $this->modelCommentaireSolo->insert($idpartie, $idjoueur, $date, $texte) > 0) {
				$_SESSION['idpartie'] = $idpartie;
				header('Content-Type: text/html; charset=utf-8');
				header('Location: index.php?control=partieSolo&action=commentaires');
				require './View/header.tpl';
				require './View/footer.tpl';
			
			} 
			else {
				$msg 	= "L'ajout a échoué";
				$params = array($title, $partie, $idpartie, $com, $msg);
				
				$this->requireView("partieSolo","commentaires", $params);
			}
		}
	}
	
	//-------- Demande de suppression de commentaire
	public function supprimerComm() {
	
		$title 		= "Supprimer un commentaire";
		$idcomm 	= $_POST['idcomm'];
		$idpartie 	= $this->modelCommentaireSolo->getIdPartie($idcomm);
		$params 	= array($title, $idcomm, $idpartie);
		
		$this->requireView("partieSolo","supprimerCommentaire", $params);
	}
	
	//--------- Validateur de suppression
	public function validerSupprComm() {
	
		$idcomm = $_POST['idcomm'];
		
		if (!empty($idcomm)) {
			$_SESSION['idpartie'] = $this->modelCommentaireSolo->getIdPartie($idcomm);
			
			if ($this->modelCommentaireSolo->delete($idcomm) > 0) {
				$msg 	= "Suppression réussie";
				$params = array($msg);
				
				$this->requireView("partieSolo", "redirectCom", $params);
			}
		}	
	}
}
?>	
	

