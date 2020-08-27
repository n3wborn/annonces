<?php


// test
//echo "dans public/index.php !";






/* TWIG */
/* Variables */

$test1 = "TEST 1 OK";
$test2 = "TEST 2 OK";

/* Conf */
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../application/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* Templates */
$template = $twig->load('index.html');
echo $template->render([
	'test1' => $test1,
	'test2' => $test2
]);

/**
	* place {{ test1 }} et {{ test2 }}
	* dans ton template index.html
	* pour vérifier que c'est ok
	* Là tu as tout ce qu'il faut pour appeler tes templates
	* et recupérer des variables php dans tes templates
	*/