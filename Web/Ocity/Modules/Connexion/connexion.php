<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Connexion extends ModuleGenerique {

    function __construct() {
	$this->title = 'Connexion';

	$action = isset($_GET['action']) ? $_GET['action'] : 'formulaire';

	switch ($action) {
	    case "confirm":
		require_once 'Modules/Connexion/Controleur/ConnexionControleur.php';
		$this->controleur = new ConnexionControleur();
		$this->controleur->confirm();
		break;
	    case "formulaire":
		require_once 'Modules/Connexion/Controleur/ConnexionControleur.php';
		$this->controleur = new ConnexionControleur();
		$this->controleur->formulaire();
		break;
	    default:
		require_once 'Modules/Connexion/Controleur/ConnexionControleur.php';
		$this->controleur = new ConnexionControleur();
		$this->controleur->formulaire();
		break;
	}
    }

}
