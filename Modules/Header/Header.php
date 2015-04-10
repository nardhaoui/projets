<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Header extends ModuleGenerique {

    function __construct() {
	require_once 'Modules/Header/Controleur/HeaderControleur.php';
	$this->controleur = new HeaderControleur();
	$this->controleur->defaultFunc();
    }

}
