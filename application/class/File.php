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
   * @method checkMimeType() verifie que le type  Mime de $input soit autorisé
   * @param string $input est le fichier temporaire uploadé sur le serveur
   * (ex : $_FILES['file']['tmp_name'])
   * @return bool true si autorisé, false sinon
   */
  public static function checkMimeType(string $file)
  {
    // type authorisés
    $mime_types = array(
      'image/png' => "png",
      'image/jpeg'=> "jpeg",
      'image/jpg'=> "jpg",
      'image/gif' => "gif",
      'image/bmp' => "bmp"
    );

    // on regarde le type mime du fichier
    $image_mime = image_type_to_mime_type(exif_imagetype($file));

    // on verifie que le type Mime fase pâsrtie de ceux autorisés
    if (!array_key_exists($image_mime, $mime_types)) {
      return false;
    } else {
      return true;
    }
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