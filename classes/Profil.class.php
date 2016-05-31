<?php 
	class Profil extends Bdd {

		public function __construct() {
			
		}

		public function getAllProfil() {
			$request = Bdd::$bdd->query('SELECT * FROM PROFIL');
			$profils = $request->fetchAll();
			return $profils;
		}

		public functiuon getProfilById($id) {
			$request = Bdd::$bdd->query('SELECT * FROM PROFIL WHERE PAX_NUM_FICHE = "'.$id.'"');
			$profils = $request->fetchAll();
			return $profils;
		}
	}
?>