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

// Chargement de la page /test
$router->map( 'GET|POST', '/test', function() {\App\Homepage::testpage();});

// Chargement de la page /nouvelle-annonce
$router->map( 'GET', '/nouvelle-annonce', function() {\App\Homepage::nouvelle_annonce();});

// Chargement de la page qui va gerer le formulaire d'ajout
$router->map( 'POST', '/formulaire-ajout', function() {
  $annonce = new \App\Annonces;
  if ($id = $annonce->handleForm()) {
    $infos = $annonce->sendInfo($id);
    $courriel = $infos['courriel'];
    $uuid = $infos['uuid'];
    $mail = new \App\Mail($courriel, $uuid);
    echo "Mail généré";
    header('Location: ' . SERVER_URI . '/');
  } else {
    echo "Erreur de l ajout. Vous allez etre redirigé vers la page d accueil";
    sleep(2);
    header('Location: ' . SERVER_URI . '/');
  }

});

// Chargement de la page de modification
$router->map( 'GET', '/modifier-annonce/[*:uuid]/[*:courriel]/[*:hash]', function($uuid_chiffre, $courriel_chiffre, $hash) {
  \App\Homepage::modifier_annonce($uuid_chiffre, $courriel_chiffre, $hash);
});


// Chargement de la page de suppression
$router->map( 'GET', '/supprimer-annonce/[*:uuid]/[*:courriel]/[*:hash]', function($uuid) {
  \App\Homepage::supprimer_annonce($uuid);
});


// Chargement de la page de suppression une fois confirmee
$router->map( 'GET', '/delete/[*:uuid]', function($uuid) {
  \App\Homepage::suppression($uuid);
});


// Chargement de la page de confirmation
$router->map( 'GET', '/confirmer-annonce[*:uuid]/[*:courriel]/[*:hash]', function() {\App\Homepage::confirmer_annonce();});


// On verifie si ça match
$match = $router->match();


// Action si match est true/false
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
