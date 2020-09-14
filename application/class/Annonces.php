<?php

namespace App;

use App\Database;
use App\Crypt;
use App\File;
use \PDO;


class Annonces extends Database
{

  public function __construct()
  {
    parent::connect();

  }


  /**
   * @method GetAll() retourne toutes les lignes de la table "annonces"
   * @return array
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
   * @method GetByNumbers() : a partir de $offset, retourne $n resultats
   * @param int $offset, int $n
   * @return array
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
  public function IsCategory(string $categorie) : int
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
   * @method InsertCategory()
   * @param string $categorie
   * @return int
   *
   * InsertCategory() insert $categorie dans categorie.libelle
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
   * @method FromAnnonces_GetUserInfos()
   * @param int $id_utilisateur
   * @return array
   *
   * FromAnnonces_GetUserInfos() recupere l'id de l'annonce et les infos
   * utilisateur pour un $id_utilisateur donné
   */
  public function FromAnnonces_GetUserInfos(int $id_utilisateur) : array
  {
    $dbh = $this->getPdo();
    $sql = "SELECT annonces.id AS Annonce_ID, annonces.uuid AS Annonce_UUID,  utilisateur.id AS User_Id, utilisateur.courriel, utilisateur.nom, utilisateur.prenom, utilisateur.telephone FROM utilisateur INNER JOIN annonces ON annonces.id_utilisateur = utilisateur.id WHERE annonces.id_utilisateur = :id_utilisateur";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $sth->execute();
    // fetchAll si jamais plusieurs annonces proviennent du même utilisateur
    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $resultat;
  }



  /**
   * @method uuidToMail() retourne utilisateur.courriel pour un annonce.uuid donné
   * @param string $uuid
   * @return string
   */
  public function uuidToMail(string $uuid) : string
  {
    $dbh = $this->getPdo();
    $sql = "SELECT annonces.uuid, utilisateur.courriel FROM utilisateur INNER JOIN annonces ON  annonces.id_utilisateur = utilisateur.id WHERE annonces.uuid = :uuid";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':uuid', $uuid, PDO::PARAM_STR);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_ASSOC);

    return $resultat['courriel'];
  }



  /**
   * @method confirm()
   * @param int $annonce_id
   * @return bool
   *
   * confirm() sert à confirmer une annonce.
   * Il passe le champ annonces.est_validee à 1 et insert la date de validation
   * dans annonces.date_validation.
   * Si tout se passe comme prevu, il renvoie true, false sinon
   */
  public function confirm(int $annonce_id) : bool
  {
    $dbh = $this->getPdo();
    $sql = "UPDATE annonces SET annonces.est_validee = 1, annonces.date_validation = :date_validation WHERE annonces.id = :annonce_id";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':annonce_id', $annonce_id, PDO::PARAM_INT);
    $sth->bindValue(':date_validation', date("Y-m-d"), PDO::PARAM_STR);

    if ($sth->execute()) {
      return true;
    } else {
      return false;
    }
  }



    /**
   * @method delete()
   * @param string uuid
   * @return bool
   *
   * delete() sert à supprimer une annonce.
   * Si tout se passe comme prevu, il renvoie true, false sinon
   */
  public function delete(string $uuid)
  {
    $dbh = $this->getPdo();
    $sql = "DELETE FROM `annonces` WHERE `annonces`.`id` = :uuid";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':uuid', $uuid, PDO::PARAM_STR);

    return($sth->execute());
  }



  /**
   * @method DateConfirmed() renvoie la date a laquelle l'annonce a ete confirmee
   * @param int $annonce_id
   * @return string
   */

  public function DateConfirmed(int $annonce_id) : string
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT annonces.date_validation FROM annonces WHERE annonces.id = :annonce_id';
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':annonce_id', $annonce_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetch(PDO::FETCH_ASSOC);
    return($res['date_validation']);
  }



  /**
   * @method loopRowsKeyVal()
   * @param int $rows
   *
   * loopRowsKeyVal() boucle à travers les reponse renvoyées par la base de données
   * et affiche les clés->valeur
   */
  public function loopRowsKeyVal(int $rows)
  {
    for ($i=0; $i < count($rows); $i++) {
      // boucle sur clé -> valeur
      foreach ($row[$i] as $key => $value) {
        echo "$key -> $value" . "<br>";
      }
    }
  }



  /**
   * @method handleForm() gere le formulaire d'ajout
   * @return int $id si true, false sinon
   */
  public function handleForm()
  {

    $dbh = $this->getPdo();

    // Si le formulaire est envoyé
    if (!empty($_POST)) {

      // verifications basique
      $nom = (empty($_POST['nom'])) ? die('Nom manquant') : trim($_POST['nom']);
      $prenom = (empty($_POST['prenom'])) ? die('prenom manquant') : trim($_POST['prenom']);
      $courriel = (empty($_POST['courriel'])) ? die('courriel manquant') : trim($_POST['courriel']);
      $telephone = (empty($_POST['telephone'])) ? die('telephone manquant') : trim($_POST['telephone']);
      $description = (empty($_POST['description'])) ? die('description manquant') : trim($_POST['description']);
      $categorie = (empty($_POST['categorie'])) ? die('$categorie manquante') : trim($_POST['categorie']);


      // Gestion de l'utilisateur
      // créé l'utilisateur si besoin et renvoie son id
      $user_id = 0;
      $annonce = new Annonces;
      if ($annonce->IsUSer($courriel) === 0) {
        $user_id = $annonce->InsertUser($courriel, $nom, $prenom, $telephone);
      } else {
        $user_id = $annonce->IsUSer($courriel);
      }

      // on genere l'uuid
      $uuid = Crypt::getRandStr();

      // si un fichier est transmis
      if (isset($_FILES) && !empty($_FILES)) {
        // on l'upload et recupere son nom
        $img_nom = File::uploadFile();
      }

      // construit l'url a partir du nom du fichier
      $img_url = "assets/" . $img_nom;


      // Gestion de l'annonce
      $sql = 'INSERT INTO annonces(`uuid`, `description`, `est_validee`, `date_ecriture`, `id_utilisateur`, `id_categorie`, `img_nom`, `img_url`) VALUES(:uuid, :description, 0, :date_ecriture, :id_utilisateur, :id_categorie, :img_nom, :img_url)';
      $sth = $dbh->prepare($sql);


      // bind params/values
      $sth->bindParam(':uuid', $uuid, PDO::PARAM_STR);
      $sth->bindParam(':description', $description ,PDO::PARAM_STR);
      $sth->bindValue(':date_ecriture', date("Y-m-d"), PDO::PARAM_STR);
      $sth->bindParam(':id_utilisateur', $user_id, PDO::PARAM_INT);
      $sth->bindParam(':id_categorie', $categorie, PDO::PARAM_INT);
      $sth->bindParam(':img_nom', $img_nom ,PDO::PARAM_STR);
      $sth->bindParam(':img_url', $img_url ,PDO::PARAM_STR);

      // execute la requete et retourne l'id de l'annonce
      if ($sth->execute()) {
        $id_annonce = $dbh->lastInsertId();
        // var_dump($id_annonce);
        return($id_annonce);
      } else {
        return false;
      }
    }
  }



  /**
   * @method myParentSays() retourne l'objet PDO (Database private $pdo)
   * @return PDO Object
   */

  public function myParentSays() {
    return $this->getPdo();
  }


  /**
   * @method sendInfo() renvoie l'uuid et le courriel associe à l'annonce $id
   * @param int $id annonce
   * @return array
   */
  public function sendInfo($id)
  {
    $dbh = $this->getPdo();
    $sql = 'SELECT annonces.uuid, utilisateur.courriel FROM annonces INNER JOIN utilisateur ON annonces.id_utilisateur = utilisateur.id WHERE annonces.id = :id ';
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetch(PDO::FETCH_ASSOC);
    // var_dump($res);
    return($res);
  }
}


