<?php

// Lien vers l'autoload
require_once '../vendor/autoload.php';

// Definition de path de base
define("BASE_PATH", "");

// Definition de l'URI
define("SERVER_URI", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH) ;

// Nouvelle instance d'Altorouteur
$router = new AltoRouter();



// Chargement de la page d'accueil
$router->map( 'GET', '/', function() {\App\Homepage::homepage();});

// Chargement de la page /user (exemple pour les prochaines pages)
$router->map( 'GET', '/user', function() {\App\Homepage::user();});

// Chargement de la page /test
$router->map( 'GET|POST', '/test', function() {\App\Homepage::testpage();});

// Chargement de la page nouvelle-annonce WIP
$router->map( 'GET', '/nouvelle-annonce', function() {\App\Homepage::nouvelle_annonce();});

// Chargement de la page qui va gerer le formulaire d'ajout
$router->map( 'POST', '/formulaire-ajout', function() {
  $annonce = new \App\Annonces;
  $annonce->handleForm();
});

// Chargement de la page modifer-annonce WIP
$router->map( 'GET', '/modifier-annonce', function() {\App\Homepage::modifier_annonce();});

// Chargement de la page supprimer-annonce WIP
$router->map( 'GET', '/supprimer-annonce', function() {\App\Homepage::supprimer_annonce();});


// Chargement de la page de suppression apres confirmation
$router->map( 'GET|POST', '/suppression', function() {

  \App\Homepage::suppression();
});

// Chargement de la page supprimer-annonce WIP
$router->map( 'GET', '/confirmer-annonce', function() {\App\Homepage::confirmer_annonce();});


// On verifie si ça match
$match = $router->match();

// Action si match est true/false
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
