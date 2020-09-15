<?php

namespace App;

use \App\Annonces as Annonces;
use \App\Database as Database;
use \App\Crypt as Crypt;


class File extends Annonces
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
    // $mime_types = array(
    //   'image/png' => "png",
    //   'image/jpeg'=> "jpeg",
    //   'image/jpg'=> "jpg",
    //   'image/gif' => "gif",
    //   'image/bmp' => "bmp"
    // );

    $mime_types = array(
      'image/png',
      'image/jpeg',
      'image/jpg',
      'image/gif',
      'image/bmp'
    );

    // on regarde le type mime du fichier
    $image_mime = image_type_to_mime_type(exif_imagetype($file));

    // on verifie que le type Mime fasse pas partie de ceux autorisés
    if (!in_array($image_mime, $mime_types)) {
      return false;
    } else {
      return true;
    }
  }



  /**
   * @method uploadFile
   * @return str $nom
   *
   * uploadFile() va recupérer le fichier du formulaire d'ajout, vérifier si le
   * type Mime est autorisé et retourner le nom du fichier, sinon on utilise
   * l'image par defaut
   */
  public static function uploadFile()
  {
    if(isset($_FILES) && ($_FILES['img_nom']['size'] < 300000 && $_FILES['img_nom']['error'] === 0)) {

      // recupere le nom du fichier temporaire
      $tmp = $_FILES['img_nom']['tmp_name'];

      // verifie si le type mime fait partie de ceux autorisés
      if (File::checkMimeType($tmp)) {

        $nom = basename($_FILES['img_nom']['name']);
        $uuid = Crypt::getRandStr(5);
        $nom = $uuid . $nom;

        // si oui, deplace le fichier temporaire en lui donnant le nouveau nom
        if (move_uploaded_file($tmp, "assets/$nom")) {
          return $nom;
        }
      }
    } else {
      $nom = 'noimage.png';
      return $nom;
    }
  }
}