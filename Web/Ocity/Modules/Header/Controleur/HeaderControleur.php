<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class HeaderControleur extends ControleurGenerique {

    function defaultFunc() {
	require_once ("Modules/Header/Vue/VueHeader.php");
	$module = isset($_GET['module']) ? $_GET['module'] : 'DEFAULT';

	$userConnected = User::isConnected();
	if (!$userConnected && $module != 'inscription' && $module != 'connexion') {
	    $module = 'connexion';
	}

	switch ($module) {
	    case "creabatiment":
		$header = 'jeu';
		break;
	    case "amelbat" :
		$header = 'jeu';
		break;
	    case "inscription":
		$header = 'inscription';
		break;
	    case "connexion":
		$header = 'connexion';
		break;
	    case "resumebat":
		$header = 'jeu';
		break;
	    case "gestcompte":
		$header = 'compte';
		break;
	    case "adminpan":
		$header = 'adminpan';
		break;
	    case "DEFAULT":
		$header = 'jeu';
		break;
	    default:
		$header = 'jeu';
		break;
	}

	if (!$userConnected) {
	    $this->constructView("VueHeader", "display_Connecte", array(NULL, NULL, $header));
	} else {
	    $this->constructView("VueHeader", "display_connecte", array(User::getPseudo(), User::getNomVille(), $header, User::isAdmin()));
	}
    }

}
