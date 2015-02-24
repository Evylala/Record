<?php
	class Model_Groupe extends Model_Template{
		
		/* Requêtes préparées */
		protected $selectAll;
		protected $countJoueurs;
		protected $insert;
		protected $countPartie;
		
		/* Constructeur */
		public function __construct() {
			$this->selectAll = Controller_Template::$db->prepare("
				SELECT idgroupe, nom, idjoueur1, idjoueur2, idjoueur3, idjoueur4 FROM groupe ");
			
			$this->countJoueurs = Controller_Template::$db->prepare("
				SELECT idjoueur1,idjoueur2,idjoueur3,idjoueur4
				FROM groupe
					WHERE idgroupe=?
			");
			
			$this->insert = Controller_Template::$db->prepare("
				INSERT INTO groupe 	(nom, idjoueur1, idjoueur2, idjoueur3, idjoueur4) 
					VALUES 			(?,?,?,?,?)
			");
			
			$this->countPartie = Controller_Template::$db->prepare("
				SELECT COUNT(*) 
				FROM partieg
					WHERE idgroupe = ?
			");
			
		}
		
		public function getNombreParticipants($idg){
			$this->countJoueurs->execute(array($idg));
			return $this->countJoueurs->fetchAll();
		}
		
		public function insertGroup($name,$id1,$id2,$id3,$id4){
			$this->insert->execute(array($name,$id1,$id2,$id3,$id4));
			return $this->insert->rowCount();
		}
		
		public function getNbPartieG($idgroupe){
			$this->countPartie->execute(array($idgroupe));
			return $this->countPartie->fetchColumn();
		}
	}
?>
