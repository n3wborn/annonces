<?php

namespace App;

use App\Database;

class Annonces extends Database
{

	public function __construct()
	{
		parent::connect();
	}

	private $id;
	private $description;
	private $img_url;
	private $img_nom;
	private $est_validée;
	private $date_ecriture;
	private $date_validation;
	private $id_utilisateur;
	private $id_categorie;


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

  // test parent Database->getPDO
	public function myParentSays() {
	  return $this->getPdo();
	}
}

