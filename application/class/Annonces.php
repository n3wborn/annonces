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
    private $id_annonce;
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


	// Getter's annonce

  public function getIdAnnonce()
  {
      return $this->id_annonce;
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

  // Getter's utilisateur
  public function getIdUser()
  {
      return $this->id_user;
  }

  public function getCourriel()
  {
      return $this->courriel;
  }

  public function getNom()
  {
      return $this->nom;
  }

  public function getPrenom()
  {
      return $this->prenom;
  }

  public function getTelephone()
  {
      return $this->telephone;
  }

  // Getter's categorie
  public function getIdCategorie()
  {
      return $this->id_categorie;
  }

  public function getLibellé()
  {
      return $this->libellé;
  }

  // test parent Database->getPdo
  public function myParentSays() {
    return $this->getPdo();
  }
}

