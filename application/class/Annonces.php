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
   * @method InsertAnnonce()
   * @return int|false
   *
   * InsertAnnonce insert une nouvelle annonce dans la table annonce.
   * Elle retourne $id_annonce si true, false sinon
   *
   */

  public function InsertAnnonce()
  {
    $dbh = $this->getPdo();

  }


  /**
   * @method InsertUser()
   * @param string $courriel
   *
   * InsertUser() créé un nouvel utilisateur
   * renvoie son id si true, 0 sinon
   */
  public function InsertUser(string $courriel, string $nom, string $prenom, string $telephone) : int
  {
    //connection à la bdd
    $dbh = $this->getPdo();
    $sql = "INSERT INTO utilisateur(courriel, nom, prenom, telephone) VALUES (:courriel, :nom, :prenom, :telephone)";

    // prepare & bind parameters
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $sth->bindParam(':telephone', $telephone, PDO::PARAM_STR);

    // exec & return 1 ou 0
    if ($sth->execute()) {
      return $dbh->lastInsertId();
    } else {
      return 0;
    }
  }


  /**
   * @method IsUSer()
   * @param string $courriel
   *
   * IsUser verifie si un utilisateur existe en prenant son courriel
   * en parametre et retourne l'id utilisateur si true, 0 sinon
   */
  public function IsUser(string $courriel) : int
  {
    //connection à la bdd
    $dbh = $this->getPdo();
    $sql = "SELECT utilisateur.id FROM utilisateur WHERE utilisateur.courriel = :courriel";

    // prepare & bind parameters
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $sth->execute();

    if ($resultat = $sth->fetch()) {
      return(intval($resultat['id']));
    } else {
      return 0;
    }
  }


  /**
   * @method IsCategorie()
   * @param string $categorie
   * @return int
   *
   * IsCategorie verifie si $categorie existe dans categorie.libelle
   * Retourne l'id de la categorie correspondante si oui, 0 sinon.
   *
   */
  public function IsCategorie(string $categorie) : int
  {
    //connection à la bdd
    $dbh = $this->getPdo();
    // evite les doublons dus aux majuscules
    $categorie = strtolower($categorie);

    // prepare & bind parameters
    $sql = "SELECT categorie.id FROM categorie WHERE categorie.libelle = :categorie";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $sth->execute();

    if ($resultat = $sth->fetch()) {
      return(intval($resultat['id']));
    } else {
      return 0;
    }
  }


  /**
   * @method InsertCategorie()
   * @param string $categorie
   * @return int
   *
   * InsertCategorie() insert $categorie dans categorie.libelle
   * retourne l'id de la categorie, 0 sinon
   */
  public function InsertCategorie(string $categorie) : int
  {
    //connection à la bdd
    $dbh = $this->getPdo();
    // evite les doublons dus aux majuscules
    $categorie = strtolower($categorie);

    // prepare & bind parameters
    $sql = "INSERT INTO categorie(libelle) VALUES (:categorie)";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $sth->execute();

    if ($resultat = $sth->fetch()) {
      return(intval($resultat['id']));
    } else {
      return 0;
    }
  }


  /**
   * @method myParentSays() retourne l'objet PDO (Database private $pdo)
   * @return PDO Object
   */

  public function myParentSays() {
    return $this->getPdo();
  }
}

