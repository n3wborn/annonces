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
$router->map( 'GET', '/', function() {
	\App\Homepage::homepage();
});

// Chargement de la page /user (exemple pour les prochaines pages)
$router->map( 'GET', '/user', function( ) {
	\App\Homepage::user();
});


// On verifie si ça match
$match = $router->match();

// Action si match est true/false
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
