<?php

namespace App;

class Crypt
{

  // creation de notre clé et methode de chiffrement utilisé
  public static $encryption_key = "StfP_LeaZ";
  public static $cipher = "aes-128-cbc";
  public static $options = 0;



  /**
   * @method encrypt()
   * @param string
   * @return string
   *
   * encrypt() prend la chaine $clear_text en entree et retourne une
   * chaine chiffree par openssl (methode $cipher)
   *
   * $clear_text = chaine de caracteres a chiffrer
   * $characters = characteres utilisables
   * self::$cipher = methode de chiffrement utilisé
   * $self::$encryption_key = notre clé de chiffrement/dechiffrement
   * $self::options = les options propres à openssl
   * $iv =  notre vecteur d'initialisation
   */
  public static function encrypt($clear_text) : string
  {

    $ivlen = openssl_cipher_iv_length(self::$cipher);
    $iv="";
    $characters= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    // genere un iv aleatoire de taille $ivlen
    for($i = 0; $i < $ivlen; $i++) {
      $iv .= $characters[random_int(0,51)];
    }

    // genere le chiffré
    $cipher_text = openssl_encrypt($clear_text, self::$cipher, self::$encryption_key, self::$options, $iv);

    return $iv.$cipher_text;
  }



  /**
   * @method decrypt()
   * @param string
   * @return string
   *
   * decrypt() prend la chaine $cipher_text en entree et retourne une
   * chaine en clair
   *
   * $cipher_text = texte chiffré
   * $self::$cipher = methode de chiffrement utilisé
   * $self::$encryption_key = notre clé de chiffrement/dechiffrement
   * $self::$options = les options propres à openssl
   * $iv =  notre vecteur d'initialisation
   */
  public static function decrypt($cipher_text) : string
  {

    $ivlen = openssl_cipher_iv_length(self::$cipher);
    $iv = substr($cipher_text, 0, $ivlen);
    $cipher_raw = substr($cipher_text, $ivlen);

    $clear_text = openssl_decrypt($cipher_raw, self::$cipher, self::$encryption_key, self::$options, $iv);

    return $clear_text;
  }
}
