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
    $annonce = new Annonces();
    $results = $annonce->GetConfirmed();
    $users=[];
    foreach($results as $key=>$value){
      if($key= 'id_user'){
        array_push($users, $value['id_utilisateur']);
      }
    }
    var_dump($users);
    foreach($users as $id){
      $userDatas = $annonce->FromAnnonces_GetUserInfos($id);
    }
var_dump($userDatas);
    echo $template->render([
      'results' => $results,
      'userDatas' => $userDatas,
      'basepath' => SERVER_URI
    ]);
  }



  public static function testpage()
  {
    $template = new Twig('test.html');
    $annonce = new Annonces();
    $results = $annonce->GetConfirmed();



    // Twig - Rendu du template et des variables
    echo $template->render([
      //'test' => $resultats[0]->id,
      'results' => $results,
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

    // URL
    $url = $_SERVER['REQUEST_URI'];

    // Verifie l'url et genere le lien de suppression
    $infos = Crypt::explodeUrl($url);
    $uuid = Crypt::checkIntegrity($infos);


    // Twig - Rendu du template et des variables
    echo $template->render([
      'uuid' => $uuid,
      'basepath' => SERVER_URI
    ]);
  }


  /**
   * @method suppression() supprime une annonce une fois sa suppression confirmee
   * @return void si ok (redirige a la page d'accueil), false sinon
   */
	public static function suppression($uuid)
  {
		// on recupere notre pdo
		$dbh = new Database();
		$uuid = self::$uuid;

		// prepare et execute la suppression
		$sql = 'DELETE FROM `annonces` WHERE `uuid` = :uuid';
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':uuid', $uuid, PDO::PARAM_STR);

		// si l'execution se passe bien, on affiche le message de confirmation
		if ($sth->execute()) {
			header('Location: ' . SERVER_URI . '/');
		} else {
		  return false;
		}
  }

}
