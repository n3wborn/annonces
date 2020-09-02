<?php

namespace App;
use \PDO;

class Database
{

	const DB_HOST = "75341d3dc6f6";
	const DB_NAME = "annonces";
	const DB_USER = "root";
	const DB_PWD = "mariadb";

	private $pdo;


	/**
		* connect()
		* si une connection à la bdd existe elle est reutilisée, sinon on en créé une
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
	 *  query() va juste servir à faire des requetes sql sur la bdd
	 * 	il prend  un sql statement en entrée et retourne un objet PDO::FETCH_OBJ
	 */
	public function query($statement)
	{
		$this->statement = $statement;
		$req = $this->getPdo()->query($statement);
		$datas = $req->fetchAll(PDO::FETCH_OBJ);
		return $datas;
	}


  /**
   * @return mixed
   */
  public function getPdo()
  {
      return $this->pdo;
  }
}