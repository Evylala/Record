<?php
	class Model_Joueur extends Model_Template{
		
		/* Requêtes préparées */
		
		protected $selectByNameAndPass;
		protected $insert;
		protected $selectById;
		protected $selectAll;
		protected $selectAllPseudo;
		protected $selectPseudo;
		protected $selectID;
		protected $selectDroit;
		protected $modifDroit;
		protected $ajouterPartie;
		protected $enleverPartie;
		protected $selectPseudoNbParties;
		
		/* Constructeur */
		public function __construct() {
			
			$this->selectByNameAndPass 	= Controller_Template::$db->prepare("
				SELECT COUNT(*) FROM joueur WHERE pseudo=? AND pass=?");
				
			$this->insert 				= Controller_Template::$db->prepare("
				INSERT INTO joueur (pseudo,pass,mail) VALUES (:name,:password,:mail)");
				
			$this->selectById 			= Controller_Template::$db->prepare("
				SELECT idjoueur, pseudo, mail, droit FROM joueur WHERE idjoueur = ?");
				
			$this->selectAll 			= Controller_Template::$db->prepare("
				SELECT idjoueur, pseudo, mail, nbparties FROM joueur");
				
			$this->selectAllPseudo 		= Controller_Template::$db->prepare("
				SELECT idjoueur,pseudo FROM joueur");
				
			$this->selectPseudo 		= Controller_Template::$db->prepare("
				SELECT pseudo FROM joueur WHERE idjoueur=?");
				
			$this->selectID 			= Controller_Template::$db->prepare("
				SELECT idjoueur FROM joueur WHERE pseudo=?");
				
			$this->selectDroit 			= Controller_Template::$db->prepare("
				SELECT droit FROM joueur WHERE idjoueur=?");
				
			$this->modifDroit 			= Controller_Template::$db->prepare("
				UPDATE joueur set droit=? where idjoueur=?");
				
			$this->ajouterPartie 		= Controller_Template::$db->prepare("
				UPDATE joueur set nbparties = nbparties + 1 where idjoueur=?");
				
			$this->enleverPartie 		= Controller_Template::$db->prepare("
				UPDATE joueur set nbparties = nbparties - 1 where idjoueur=?");
				
			$this->selectPseudoNbParties= Controller_Template::$db->prepare("
				SELECT pseudo, nbparties FROM joueur ORDER BY nbparties DESC");
		}
		
		public function selectByNameAndPass($name, $password) {
			$this->selectByNameAndPass->execute(array($name,md5($password)));
			return $this->selectByNameAndPass->fetchColumn();
		}
		
		public function insert($name, $password, $mail) {
			$this->insert->execute(array(':name' => $name, ':password' => md5($password), ':mail' => $mail));
			return $this->insert->rowCount();
		}
		
		public function getAllPseudo(){
			$this->selectAllPseudo->execute();
			return $this->selectAllPseudo->fetchAll();
		}

		public function getPseudo($id){
			$this->selectPseudo->execute(array($id));
			$joueur = $this->selectPseudo->fetchColumn();
			return $joueur;
		}
		
		public function getID($pseudo) {
			$this->selectID->execute(array($pseudo));
			$joueur = $this->selectID->fetchColumn();
			return $joueur;
		}
		
		public function getDroit($id) {
			$this->selectDroit->execute(array($id));
			$joueur = $this->selectDroit->fetchColumn();
			return $joueur;
		}
		
		public function modifDroit($droit, $idjoueur) {
			$this->modifDroit->execute(array($droit, $idjoueur));
			return $this->modifDroit->rowCount();
		}
		
		public function ajouterPartie($idjoueur) {
			$this->ajouterPartie->execute(array($idjoueur));
			return $this->ajouterPartie->rowCount();
		}
		
		public function enleverPartie($idjoueur) {
			$this->enleverPartie->execute(array($idjoueur));
			return $this->enleverPartie->rowCount();
		}
		
		public function getPseudoNbParties() {
			$this->selectPseudoNbParties->execute();
			return $this->selectPseudoNbParties->fetchAll();
		}
	}
?>
