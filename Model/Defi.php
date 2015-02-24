<?php
	class Model_Defi extends Model_Template{
		
		/* Requêtes préparées */
		protected $selectAll;
		protected $insert;
		protected $selectAllSolo;
		protected $selectAllMulti;
		protected $selectMultiSpec;
		protected $nbjoueurmax;
		
		/* Constructeur */
		public function __construct() {
			$this->selectAll 		= Controller_Template::$db->prepare("
				SELECT iddefi, designation, nbparticipantsmax, niveau
				FROM defi
			");
				
			$this->selectAllSolo 	= Controller_Template::$db->prepare("
				SELECT iddefi, designation, nbparticipantsmax , niveau
				FROM defi 
					WHERE nbparticipantsmax = 1
					ORDER BY designation
			");
			
			$this->selectAllMulti 	= Controller_Template::$db->prepare("
				SELECT iddefi, designation, nbparticipantsmax, niveau
				FROM defi 
					WHERE nbparticipantsmax > 1
					ORDER BY designation
			");
				
			$this->selectMultiSpec 	= Controller_Template::$db->prepare("
				SELECT iddefi, designation, nbparticipantsmax, niveau
				FROM defi 
					WHERE nbparticipantsmax >= ?
			");	
				
			$this->insert 			= Controller_Template::$db->prepare("
				INSERT INTO defi 	(designation,nbparticipantsmax,niveau) 
					VALUES 			(?,?,?)
			");
				
			$this->nbjoueurmax 		= Controller_Template::$db->prepare("
				SELECT nbparticipantsmax
				FROM defi 
					WHERE iddefi=?
			");
		}
		
		public function insert($dsgn,$nbj,$lvl){
			$this->insert->execute(array($dsgn,$nbj,$lvl));
			return $this->insert->rowCount();
		}
		
		public function getAllSolo() {
			$this->selectAllSolo->execute();
			return $this->selectAllSolo->fetchAll();
		}	

		public function getAllMulti() {
			$this->selectAllMulti->execute();
			return $this->selectAllMulti->fetchAll();
		}	
		
		public function getMultiSpec($nbParticipants){
			$this->selectMultiSpec->execute(array($nbParticipants));
			return $this->selectMultiSpec->fetchAll();
		}
			
		public function getNbJoueursMax($iddefi) {
			$this->nbjoueurmax->execute(array($iddefi));
			return $this->nbjoueurmax->fetchAll();
		}
		
		
	}
?>
