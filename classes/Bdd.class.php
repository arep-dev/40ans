<?php 
	class Bdd {
		public static $bdd;

		public function __construc() {}
	}

	Bdd:$bdd = new PDO('mysql:host=142.4.214.101;dbname=40ans', 'arep_CATB', 'arep-sa');
	MyModel::$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>