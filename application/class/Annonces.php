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
   */

  public function GetAll()
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_OBJ);
    var_dump($res);
    return($res);
  }


  /**
   *  @method GetByNumbers() : a partir de $offset, retourne $n resultats
   *  @param int $offset, int $n
   */

  public function GetByNumbers(int $offset = 0, int $n = 10)
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
   * @method GetConfirmed() renvoie les lignes si "est_validee = 1"
   */

  public function GetConfirmed(){
    $dbh = $this->getPdo();
    $sql = 'SELECT * FROM annonces WHERE est_validee = 1';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($res);
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

