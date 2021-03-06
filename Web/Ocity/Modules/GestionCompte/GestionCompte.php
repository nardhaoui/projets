<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class GestionCompte extends ModuleGenerique {

    function __construct() {
	$this->titre = "Gestion de compte";
	$action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';

	switch ($action) {
	    case "mdp":
		require_once 'Modules/GestionCompte/Controleur/ControleurGestionCompte.php';
		$this->controleur = new ControleurGestionCompte();
		$this->controleur->changementMDP();
		break;
	    default:
		require_once 'Modules/GestionCompte/Controleur/ControleurGestionCompte.php';
		$this->controleur = new ControleurGestionCompte();
		$this->controleur->defaultFunc();
		break;
	}
    }

}
