<?php

namespace App;
use \PDO;

class Database
{

  const DB_HOST = "91a34cb0396a";
  const DB_NAME = "annonces";
  const DB_USER = "root";
  const DB_PWD = "mariadb";


  private $pdo;



  /**
   * @method __construct() va instancier Database en executer connect()
   * @return PDO object
   */
	public function __construct()
  {
  	$this->connect();
  }



  /**
   * @method connect() etablit ne connection PDO à la base de donnes
   * @return PDO object
   */

  public function connect()
  {
    $pdo = $this->pdo;

    // On se connecte uniquement si aucune connection est active
    if ($pdo === null) {
      $pdo = new PDO('mysql:host='. self::DB_HOST.';dbname='. self::DB_NAME, self::DB_USER, self::DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    $this->pdo = $pdo;
  }



  /**
   * @method MaxId() retourne l'id le plus haut dans la table $table
   * @param string $table (default = "annonces")
   * @return int
   */
  public function MaxId(string $table = "annonces") : int
  {
    $pdo = $this->connect();
    $sql = 'SELECT id FROM ' .$table. ' ORDER BY id DESC LIMIT 1';
    $sth = $this->pdo->prepare($sql);
    $sth->execute();
    $resultats = $sth->fetch(PDO::FETCH_ASSOC);
    return($resultats['id']);
  }



  /**
   * @method getPdo() retourne un objet PDO (Getter)
   * @return mixed
   */
  public function getPdo()
  {
    return $this->pdo;
  }
}
