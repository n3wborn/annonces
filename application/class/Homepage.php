<?php

namespace App;

class Homepage
{

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

    // Twig - variables test
    $test = "SUPPRIMER ANNONCE OK";

    // Twig - Rendu du template et des variables
    echo $template->render([
      'test' => $test,
      'basepath' => SERVER_URI
    ]);
  }

}
