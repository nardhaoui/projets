<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Accueil extends ModuleGenerique {

    function __construct() {
	require_once 'Modules/Accueil/Controleur/DefaultControleurAccueil.php';

	$this->titre = 'Accueil';

	$this->controleur = new DefaultControleurAccueil();
	$this->controleur->defaultFunc();
    }

}
