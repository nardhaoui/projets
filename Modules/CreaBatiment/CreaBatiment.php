<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class CreaBatiment extends ModuleGenerique {

    function __construct() {
	$action = isset($_GET['action']) ? $_GET['action'] : 'demande';

	switch ($action) {
	    case "confirm":
		require_once 'Modules/CreaBatiment/Controleur/CreaBatimentControleur.php';
		$this->controleur = new CreaBatimentControleur();
		$this->controleur->afficherConfirm();
		break;
	    case "demande":
		require_once 'Modules/CreaBatiment/Controleur/CreaBatimentControleur.php';
		$this->controleur = new CreaBatimentControleur();
		$this->controleur->afficherDemande();
		break;
	    default:
		require_once 'Modules/CreaBatiment/Controleur/CreaBatimentControleur.php';
		$this->controleur = new CreaBatimentControleur();
		$this->controleur->afficherDemande();
		break;
	}
    }

}
