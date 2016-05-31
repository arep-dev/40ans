<?php
    include_once('twig/lib/Twig/Autoloader.php');
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    )); 

    require('classes/Bdd.class.php');
    require('classes/Profil.class.php');

    Bdd::$bdd = new PDO('mysql:host=142.4.214.101;dbname=40ans', 'arep_CATB', 'arep-sa');
	Bdd::$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    include('views/header.tpl');

    $instance = new Profil();
    $profils = $instance->getAllProfil();


    echo $twig->render('body.tpl', array(
    	'profils' => $profils
    ));



    include('view/footer.tpl');

?> 