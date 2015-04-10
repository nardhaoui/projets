<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Aside extends ModuleGenerique {

    function __construct() {

	include_once 'Modules/Aside/Controleur/ControleurAside.php';
	$this->controleur = new ControleurAside();
	$this->controleur->defaultFunc();
    }

}
