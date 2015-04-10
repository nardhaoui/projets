<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class AmeliorationBatiment extends ModuleGenerique {

    function __construct() {

	require_once 'Modules/AmeliorationBatiment/Controleur/ControleurListBat.php';

	$this->titre = 'Amelioration de Batiments';
	$action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';

	$this->controleur = new ControleurListBat();

	switch ($action) {
	    case "d_batlist":
		$this->controleur->display_BatList();
		break;
	    case "amelioration":
		$this->controleur->ameliorerBat();
		break;
	    case "demo":
		$this->controleur->demoBat();
		break;
	    case "infosbat":
		$this->controleur->infosBat();
		break;
	    default:
		$this->controleur->display_BatList();
		break;
	}
    }

}
