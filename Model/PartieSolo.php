<?php
class Model_PartieSolo extends Model_Template{
		
		/* Requêtes préparées */
		
		protected $selectAll;
		protected $insert;
		protected $selectById;
		protected $update;
		protected $delete;
		protected $selectIdJoueur;
		
		public function __construct() {
			$this->selectAll = Controller_Template::$db->prepare("
				SELECT idpartiei, d.designation As designation , tempsjeuminute,acquisition,recit, p.idjoueur AS idjoueur, j.pseudo AS pseudo
				FROM partiei AS p, joueur AS j, defi AS d
					WHERE p.idjoueur=j.idjoueur
					AND d.iddefi=p.iddefi
					ORDER BY d.designation
				");
					
			$this->insert = Controller_Template::$db->prepare("
				INSERT INTO partiei (tempsjeuminute, acquisition, idjoueur, iddefi, recit) 
					VALUES 			(:tpsjeu,:acquis,:idjoueur,:iddefi,:recit) ");
					
			$this->selectById = Controller_Template::$db->prepare("
				SELECT d.designation, j.pseudo as pseudo, tempsjeuminute, acquisition, recit 
				FROM partiei p, defi d, joueur j  
					WHERE idpartiei=? 
					AND d.iddefi = p.iddefi 
					AND j.idjoueur = p.idjoueur
			");
			
			$this->update = Controller_Template::$db->prepare("
				UPDATE partiei 
				SET iddefi=?, tempsjeuminute=?, acquisition=?, recit=? 
					WHERE idpartiei=?
			");
			
			$this->delete = Controller_Template::$db->prepare("
				DELETE FROM partiei WHERE idpartiei=?");
			$this->selectIdJoueur = Controller_Template::$db->prepare("
				SELECT idjoueur FROM partiei WHERE idpartiei=?");
		}
		
		public function insert($tpsjeu, $acquis, $idjoueur, $iddefi, $recit) {
			$this->insert->execute(array(':tpsjeu' => $tpsjeu, ':acquis' => $acquis, ':idjoueur' => $idjoueur, ':iddefi' => $iddefi, ':recit' => $recit));
			return $this->insert->rowCount();
		
		}
		
		public function getById($id) {
			$this->selectById->execute(array($id));
			return $this->selectById->fetchAll();
		}
		
		public function updatePartie($iddefi, $tpsjeu, $acquis, $recit, $idpartie) {
			$this->update->execute(array($iddefi, $tpsjeu, $acquis, $recit, $idpartie));
			return $this->update->rowCount();
		}
		
		public function deletePartie($idpartie) {
			$this->delete->execute(array($idpartie));
			return $this->delete->rowCount();
		}
		
		public function getIdJoueur($idpartie) {
			$this->selectIdJoueur->execute(array($idpartie));
			return $this->selectIdJoueur->fetchColumn();
		}
}
?>
