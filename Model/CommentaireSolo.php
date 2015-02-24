<?php
	class Model_CommentaireSolo extends Model_Template{
		
		/* Requêtes préparées */
		protected $selectAll;
		protected $selectById;
		protected $insert;
		protected $compter;
		protected $delete;
		protected $selectIdPartie;
		
		/* Constructeur */
		public function __construct() {
			$this->selectAll = Controller_Template::$db->prepare("
				SELECT idjoueur, idcommi, idpartiei, texte FROM commi ");
			
			$this->selectById = Controller_Template::$db->prepare("
				SELECT idcommi, j.pseudo as pseudo, date, 	DATE_FORMAT(date, '%d/%m/%Y') AS dateonly, 
															DATE_FORMAT(date, '%H:%i') as heureonly, texte 
				FROM commi c, joueur j 
					WHERE idpartiei=? 
					AND c.idjoueur = j.idjoueur 
					ORDER BY date DESC
			");
			
			$this->insert = Controller_Template::$db->prepare("
				INSERT INTO commi 	(idpartiei, idjoueur, date, texte) 
				VALUES 			(:idpartiei, :idjoueur, :date, :texte)
			");
			
			$this->compter = Controller_Template::$db->prepare("
				SELECT COUNT(*) FROM commi WHERE idpartiei = ? "); 
			
			$this->delete = Controller_Template::$db->prepare("
				DELETE FROM commi WHERE idcommi=?");
			
			$this->selectIdPartie = Controller_Template::$db->prepare("
				SELECT idpartiei from commi where idcommi =?");
		}
		
		public function getById($idpartie) {
			$this->selectById->execute(array($idpartie));
			return $this->selectById->fetchAll();
		}
		
		public function insert($idpartie, $idjoueur, $date, $texte) {
			$this->insert->execute(array(':idpartiei' => $idpartie, ':idjoueur' => $idjoueur, ':date' => $date, ':texte' => $texte));
			return $this->insert->rowCount();
		}
		
		public function compter($idpartie) {
			$this->compter->execute(array($idpartie));
			return $this->compter->fetchColumn();
		}

		public function delete($idcomm) {
			$this->delete->execute(array($idcomm));
			return $this->delete->rowCount();
		}
	
		public function getIdPartie($idcomm) {
			$this->selectIdPartie->execute(array($idcomm));
			return $this->selectIdPartie->fetchColumn();
		}
	}
?>
