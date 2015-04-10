<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Echange extends ModuleGenerique {

    function __construct() {
	$action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';

	switch ($action) {
	    case "choose":
			require_once 'Modules/Echanges/Controleur/EchangeControleur.php';
			$this->controleur = new EchangeControleur();
			$this->controleur->choose();
			break;
	    case "confirm":
			require_once 'Modules/Echanges/Controleur/EchangeControleur.php';
			$this->controleur = new EchangeControleur();
			if(!$this->controleur->confirm()){
				$this->controleur->affFormulaire();
			}
			break;
	    case "DEFAULT":
			require_once 'Modules/Echanges/Controleur/EchangeControleur.php';
			$this->controleur = new EchangeControleur();
			$this->controleur->affFormulaire();
			break;
	    default:
			require_once 'Modules/Echanges/Controleur/EchangeControleur.php';
			$this->controleur = new EchangeControleur();
			$this->controleur->affFormulaire();
			break;
	}
    }

}
