<?php
    ini_set('display_errors','on');
    error_reporting(E_ALL);
    include_once('twig/lib/Twig/Autoloader.php');
    require('classes/Bdd.class.php');
    require('classes/Profil.class.php');

    Bdd::$bdd = new PDO('mysql:host=142.4.214.101;dbname=40ans', 'arep_CATB', 'arep-sa');
    Bdd::$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if($_POST['action'] == 'checkin') {
            
            $id = $_POST['id'];
            $statut = $_POST['statut'];
            $instance = new Profil();
            $instance->setCheckIn($id, $statut);
            echo $statut;    

        }else if($_POST['action'] == 'search') {

            Twig_Autoloader::register();
        
            $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
            $twig = new Twig_Environment($loader, array(
              'cache' => false
            )); 

            include('views/header.tpl');

            $search = $_POST['search'];

            $instance = new Profil();
            $countNbInvites = $instance->getAllProfil();
            $arrival = $instance->getProfilByArrival();
            $nbInvites = count($countNbInvites);
            $profils = $instance->getProfilBySearch($search);

            echo $twig->render('body.tpl', array(
                'profils' => $profils,
                'nbInvites' => $nbInvites,
                'arrival' => $arrival,
                'search' => true,
                'searchWord' => $_POST['search']
            ));


            include('views/footer.tpl');

        }
        
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