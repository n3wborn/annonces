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
   * a partir de $offset, retourn $n resultats
   */
  public function GetByNumbers(int $offset = 0, int $n = 10) : array
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces LIMIT ' . $n .' OFFSET '. $offset .' ';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $resultats = $sth->fetchAll(PDO::FETCH_OBJ);
    var_dump($resultats);
    return($resultats);
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

