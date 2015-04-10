<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Inscription extends ModuleGenerique {

    function __construct() {
	$action = isset($_GET['action']) ? $_GET['action'] : 'formulaire';
	switch ($action) {
	    case "confirm2":
		require_once 'Modules/Inscription/Controleur/InscriptionControleur.php';
		$this->controleur = new InscriptionControleur();
		$this->controleur->confirm2();
		break;
	    case "confirm":
		require_once 'Modules/Inscription/Controleur/InscriptionControleur.php';
		$this->controleur = new InscriptionControleur();
		$this->controleur->confirm();
		break;
	    case "formulaire":
		require_once 'Modules/Inscription/Controleur/InscriptionControleur.php';
		$this->controleur = new InscriptionControleur();
		$this->controleur->formulaire();
		break;
	    default:
		require_once 'Modules/Inscription/Controleur/InscriptionControleur.php';
		$this->controleur = new InscriptionControleur();
		$this->controleur->formulaire();
		break;
	}
    }

}
