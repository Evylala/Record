<?php
class Model_PartieMulti extends Model_Template{
		
		/* Requêtes préparées */
		
		//protected $idJoueurs;
		protected $selectAll;
		protected $listAll;
		protected $insert;
		protected $selectById;
		protected $update;

		public function __construct() {
			
			$this->selectAll = Controller_Template::$db->prepare("
				SELECT idpartieg, tempsjeuminute, acquisition, idgroupe, iddefi, recit FROM partieg");
			
			$this->listAll = Controller_Template::$db->prepare("
				SELECT p.idpartieg,d.designation, g.nom, g.idjoueur1, g.idjoueur2, g.idjoueur3, g.idjoueur4, tempsjeuminute, acquisition, recit
				FROM 	defi d, partieg p, groupe g
					WHERE 	p.idgroupe 	= g.idgroupe
					AND 	d.iddefi 	= p.iddefi
					AND 	d.nbparticipantsmax > 1
				");
			
			$this->insert = Controller_Template::$db->prepare("
				INSERT INTO partieg (tempsjeuminute,acquisition,idgroupe,iddefi,recit) 
					VALUES 			(?,?,?,?,?)
				");
				
			$this->selectById = Controller_Template::$db->prepare("
				SELECT d.designation, tempsjeuminute, acquisition, recit 
				FROM partieg p, defi d  
					WHERE p.idpartieg=? 
					AND d.iddefi = p.iddefi
				");
					
			$this->update = Controller_Template::$db->prepare("
				UPDATE partieg SET iddefi=?, tempsjeuminute=?, acquisition=?, recit=? WHERE idpartieg=?");
		}

		public function getIdJoueurs() {
				$this->idJoueurs->execute();
				return $this->idJoueurs->fetchAll();
		}
		
		public function getById($id) {
			$this->selectById->execute(array($id));
			return $this->selectById->fetchAll();
		}
		
		public function updatePartie($iddefi, $tpsjeu, $acquis, $recit, $idpartie) {
			$this->update->execute(array($iddefi, $tpsjeu, $acquis, $recit, $idpartie));
			return $this->update->rowCount();
			
		}
		
		public function getList() {
			$this->listAll->execute();
			return $this->listAll->fetchAll();
		}
		
		public function insertPartie($tempsjeu,$acquis,$idgroupe,$iddefi,$story){
			$this->insert->execute(array($tempsjeu,$acquis,$idgroupe,$iddefi,$story));
			return $this->insert->rowCount();
		}
}
?>
