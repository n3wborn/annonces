<?php

namespace App;

use App\Database;
use \PDO;

class Annonces extends Database
{

	public function __construct()
	{
		parent::connect();

	}

  /**
   * GetAll retourne toutes les annonces de la bdd
   */
  public function GetAll()
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($res);
    return($res);
  }


  /**
   *  GetByNumbers($n, $offset)
   *
   * retourne les $n premiers resultats à partir de
   * $offset
   */
  public function GetByNumbers($n, $offset)
  {

  }


  /**
   * GetConfirmed renvoie uniquement les annonces
   * qui ont été validées
   */
  public function GetConfirmed(){

  }




  // test parent Database->getPdo
  public function myParentSays() {
    return $this->getPdo();
  }
}

