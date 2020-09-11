<?php

namespace App;

use \App\Annonces as Annonces;
use \App\Database as Database;


class File extends Database
{

  public  function __construct()
  {
    parent::connect();
  }



  /**
   * @method uploadFile
   * @return str $nom
   *
   * uploadFile() prend va recupérer le fichier du formulaire d'ajout
   * l'uploader et retourner le nom du fichier
   */
  public static function uploadFile()
  {
    if(isset($_FILES) && ($_FILES['img_nom']['size'] < 300000 && $_FILES['img_nom']['error'] === 0)) {
      /*var_dump($_FILES['img_nom']);*/

      // si upload ok
      $tmp = $_FILES['img_nom']['tmp_name'];
      $nom = basename($_FILES['img_nom']['name']);

      // place le fichier dans le repertoire assets et renvoie le nom du fichier
      if (move_uploaded_file($tmp, "assets/$nom")) {
        return "$nom";
      } else {
        echo "Erreur dans l'envoi du fichier";
        die();
      }
    }
  }


}