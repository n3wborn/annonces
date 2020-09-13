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

    return base64_encode($iv.$cipher_text);
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

    $cipher_text = base64_decode($cipher_text);
    $ivlen = openssl_cipher_iv_length(self::$cipher);
    $iv = substr($cipher_text, 0, $ivlen);
    $cipher_raw = substr($cipher_text, $ivlen);

    $clear_text = openssl_decrypt($cipher_raw, self::$cipher, self::$encryption_key, self::$options, $iv);

    return $clear_text;
  }



  /**
   * @method hashStr() renvoie le checksum de la concatenation de $str1 et $str2
   * @param string $str1, string $str2, string $algo = "sha256"
   * @return string
   */
  public function hashStr(string $str1 = '', string $str2 = '', string $algo = 'sha256') : string
  {
    return hash($algo, $str1 . $str2);
  }



  /**
   * @method checkHash() verifie si  sha256($str1 + $str2) est egal à $hash
   * @param string $str1, string $str2, string $hash, string $algo = 'sha256'
   * @return bool
   */
  public function checkHash(string $str1 = '', string $str2 = '', string $hash = '', string $algo = 'sha256') : bool
  {
    $this->algo  = $algo;
    $hash_ok = hash($algo, $str1 . $str2);
    echo "$algo";
    var_dump($hash_ok);
    return $hash_ok === $hash;
  }



  /**
   * @method getRandStr() retourne une chaine aleatoire de longueur $n bytes
   * @param int
   * @return string
   */
  public static function getRandStr(int $n = 18) : string
  {
    return bin2hex(random_bytes($n));
  }



  /**
   * @method explodeUrl() lit l'url et retrouve les infos sur
   * l'annonce correspondante
   * @param string $url
   * @return array
   */
  public static function explodeUrl($url)
  {
    $parts = explode('/', $url);

    $infos = [
    'action' => $parts[2],
    'ciphered_uuid' => $parts[3],
    'ciphered_mail' => $parts[4],
    'hash' => $parts[5]
    ];

    return $infos;
  }



  /**
   * @method checkIntegrity() verifie si les resultats retournes
   *  par explodeUrl() sont exacts.
   *  Si oui, on retourne un tableau avec les infos dechiffrees
   * @param array $infos
   * @return bool
   */
  public static function checkIntegrity($infos)
  {
    $action = $infos['ciphered_uuid'];
    $ciphered_uuid = $infos['ciphered_uuid'];
    $ciphered_mail = $infos['ciphered_mail'];
    $hash = $infos['hash'];

    if (checkHash($ciphered_uuid, $ciphered_mail, $hash)) {
      $uuid = decrypt($ciphered_uuid);
      return $uuid;
    } else {
      return false;
    }
  }

}