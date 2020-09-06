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
   *  @method GetAll() retourne toutes les lignes de la table "annonces"
   *  @return array
   */

  public function GetAll() : array
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    //print_r($res);
    return($res);
  }


  /**
   *  @method GetByNumbers() : a partir de $offset, retourne $n resultats
   *  @param int $offset, int $n
   *  @return array
   */

  public function GetByNumbers(int $offset = 0, int $n = 10) : array
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces LIMIT ' . $n .' OFFSET '. $offset .' ';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $resultats = $sth->fetchAll(PDO::FETCH_ASSOC);
    //print_r($resultats);
    return($resultats);
  }


  /**
   * @method GetConfirmed() renvoie les lignes si "est_validee = 1"
   * @return array
   */

  public function GetConfirmed() : array
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces WHERE est_validee = 1';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    //print_r($res);
    return($res);
  }


  /**
   * @method myParentSays() retourne l'objet PDO (Database private $pdo)
   * @return PDO Object
   */

  public function myParentSays() {
    return $this->getPdo();
  }
}

