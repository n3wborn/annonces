<?php

namespace App;

use App\Database;

class Annonces extends Database
{

	public function __construct()
	{
		parent::connect();
	}

  // variables de l'annonce
  private $description;
  private $img_url;
  private $img_nom;
  private $est_validee;
  private $date_ecriture;
  private $date_validation;

  // l'utilisateur qui a fait l'annonce
  private $id_user;
  private $courriel;
  private $nom;
  private $prenom;
  private $telephone;


  // la categorie de l'annonce
  private $id_categorie;
  private $libellé;

  /**
    * new : ajout d'annonce
    *
    * INSERT
    *
    *   Ajouts dans la base de données -> création liens modif et delete
    *   return l'id de l'annonce, sinon false
    *
    *   table user -> courriel, nom, telephone,
    *   table categorie -> libellé
    *   table annonces -> description, img_url, im_nom, est_validee (false),
    *   date_ecriture, id_user, id_categorie
    *
    */

  public function new()
  {


  }


  /**
    * modify : modification pre validation
    *
    * SI est_validée est FALSE ET SI url de confirmation est TRUE
    *
    * MODIFIE annonce $id_annonce
    *
    * UPDATE categorie/description/image/
    *
    *
    */


  /**
    * delete : suppression d'une annonce
    *
    * DELETE annonce $id_annonce
    *
    */




	// Getter's

  public function getId()
  {
      return $this->id;
  }

  public function getDescription()
  {
      return $this->description;
  }

  public function getImgUrl()
  {
      return $this->img_url;
  }

  public function getImgNom()
  {
      return $this->img_nom;
  }

  public function getEstValidee()
  {
      return $this->est_validee;
  }

  public function getDateEcriture()
  {
      return $this->date_ecriture;
  }

  public function getDateValidation()
  {
      return $this->date_validation;
  }

  public function getIdUtilisateur()
  {
      return $this->id_utilisateur;
  }

  public function getIdCategorie()
  {
      return $this->id_categorie;
  }

  // test parent Database->getPdo
	public function myParentSays() {
	  return $this->getPdo();
	}

}

