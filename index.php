<?php
    ini_set('display_errors','on');
    error_reporting(E_ALL);
    include_once('twig/lib/Twig/Autoloader.php');
    require('classes/Bdd.class.php');
    require('classes/Profil.class.php');

    Bdd::$bdd = new PDO('mysql:host=142.4.214.101;dbname=40ans', 'arep_CATB', 'arep-sa');
    Bdd::$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $profils = $_POST['profil'];
        $instance = new Profil();
        $instance->setCheckIn($profils);
        echo json_encode($_POST['profil']);

    }else{

        Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
        $twig = new Twig_Environment($loader, array(
          'cache' => false
        )); 

        include('views/header.tpl');

        $instance = new Profil();
        $profils = $instance->getAllProfil();
        $arrival = $instance->getProfilByArrival();
        $nbInvites = count($profils);

        echo $twig->render('body.tpl', array(
        	'profils' => $profils,
            'nbInvites' => $nbInvites,
            'arrival' => $arrival
        ));


        include('views/footer.tpl');

    }
?> 