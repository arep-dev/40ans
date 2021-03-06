<?php 

	class Profil extends Bdd {

		public function __construct() {

		}

		public function getAllProfil() {
			$request = Bdd::$bdd->query('SELECT * FROM PROFIL ORDER BY PAX_NOM');
			$profils = $request->fetchAll();
			return $profils;
		}

		public function getProfilById($id) {
			$request = Bdd::$bdd->query('SELECT * FROM PROFIL WHERE PAX_NUM_FICHE = "'.$id.'" ORDER BY PAX_NOM');
			$profils = $request->fetchAll();
			return $profils;
		}

		public function getProfilByArrival() {
			$request = Bdd::$bdd->query('SELECT COUNT(*) FROM PROFIL WHERE PAX_CHECKIN = 1');
			$arrival = $request->fetch();
			return $arrival;
		}

		public function setCheckIn($id, $statut) {
				$request = 'UPDATE PROFIL SET PAX_CHECKIN = ?, PAX_HEURE_ARRIVEE = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE PAX_NUM_FICHE = ?';
				$prepare = Bdd::$bdd->prepare($request);
				$prepare->execute(array($statut, $id));
		}

		public function getProfilBySearch($search) {
			$request = Bdd::$bdd->query('SELECT * FROM PROFIL 
			WHERE PAX_NOM LIKE "%'.$search.'%" OR PAX_PRENOM LIKE "%'.$search.'%" OR PAX_SOCIETE LIKE "%'.$search.'%" OR PAX_DIRECTEUR_CLIENTELE LIKE "%'.$search.'%"');
			$search = $request->fetchAll();
			return $search;
		}
	}


?>