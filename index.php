<?php
    include_once('twig/lib/Twig/Autoloader.php');
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));

    require('classes/Bdd.class.php');
    require('classes/Profil.class.php');

    include('views/header.tpl');

    $instance = new Profil();
    $profils = $instance->getAllProfil();


    echo $twig->render('body.tpl', array(
    	'profils' => $profils
    ));



    include('view/footer.tpl');

?> 