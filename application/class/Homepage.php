<?php

namespace App;

use \App\Database as Database;
use \App\Annonces as Annonces;
use \App\Crypt as Crypt;


class Homepage extends Annonces
{


  public function __construct()
  {
    parent::connect();
  }

  public static function homepage()
  {
    $template = new Twig('index.html');
    // Twig - variables test
    $test = "TEST HOMEPAGE OK";

    // Twig - Rendu du template et des variables
    echo $template->render([
      'test' => $test,
      'basepath' => SERVER_URI
    ]);
  }



  public static function testpage()
  {
    $template = new Twig('test.html');
    // Twig - variables test



    // Twig - Rendu du template et des variables
    echo $template->render([
      //'test' => $resultats[0]->id,
      'test' => $resultat,
      'basepath' => SERVER_URI
    ]);
  }



  // WIP Test static routes
  public static function nouvelle_annonce()
  {
    $template = new Twig('nouvelle_annonce.html');

    // Twig - variables test
    $test = "NOUVELLE ANNONCE OK";


    // Twig - Rendu du template et des variables
    echo $template->render([
      'test' => $test,
      'basepath' => SERVER_URI
    ]);
  }



  // WIP Test static routes
  public static function modifier_annonce()
  {
    $template = new Twig('modifier_annonce.html');

    // Twig - variables test
    $test = "MODIFIER ANNONCE OK";

    // Twig - Rendu du template et des variables
    echo $template->render([
      'datas' => $test,
      'basepath' => SERVER_URI
    ]);
  }


  // WIP Test static routes
  public static function supprimer_annonce()
  {
    $template = new Twig('supprimer_annonce.html');

    // WIP url de test
    $url = 'http://supprimer-annonce/REVTc0dXS0hYRnFEdEh4WWI0TWx3dUl0QklmYlljQVc2OTJCYzRHaTZQT2MvdmpoQTVqbWd2SEJXa2JpTzIwanhFc0UwY2s3NDBqcnVoblo=/RUFoaUthaElWTkpIdUFVSGtIcmpyS1EyVmJXa3drM0ZWL2cxVUE9PQ==/7a48008c438d9f8bfac445e203029a4077d5cc6aa0eaa4fd5cb40cfd0b691903';

    // url definitive
    // $_SERVER['REQUEST_URI'];

    // Verifie l'url et genere le lien de suppression
    $infos = Crypt::explodeUrl($url);
    $uuid = Crypt::checkIntegrity($infos);


    // Twig - Rendu du template et des variables
    echo $template->render([
      'uuid' => $uuid,
      'basepath' => SERVER_URI
    ]);
  }

}
