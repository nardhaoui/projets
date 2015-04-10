<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Ressources extends ModuleGenerique {

    function __construct() {
	require_once 'Modules/Ressources/Controleur/ControleurRessources.php';
	$this->controleur = new ControleurRessources();
    }

}
