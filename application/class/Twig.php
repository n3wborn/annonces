<?php

namespace App;

class Twig
{
  private $template;

  /**
   * @method __construct va faire executer à Twig le template $template_name
   * @param string $template_name represente le template utilisé au chargement
   * de la classe
   *
   * FilesystemLoader() represente le dossier dans lequel se trouve les templates
   * Environment() va prendre $loader et un tableau associatif comme variables
   * d'environnement
   * $this->template va charger l'environnement et le template $template_name
   */
  public function __construct(string $template_name)
  {
    $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
    $twig = new \Twig\Environment($loader, ['cache' => false]);
    $this->template = $twig->load($template_name);
  }



  /**
   * @method render() effectue le rendement du template en prenant le tableau
   * $arr comment options à transmettre à Twig
   * @param array $arr
   */
  public function render($arr=[]){
    echo $this->template->render($arr);
  }
}
