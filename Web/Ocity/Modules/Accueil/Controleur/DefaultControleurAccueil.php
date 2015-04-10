<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class DefaultControleurAccueil extends ControleurGenerique {

    function defaultFunc() {
	require_once 'Modules/Accueil/Vue/VueAccueil.php';
	require_once 'Modules/Accueil/Modele/ModeleAcceuil.php';
	$bats = ModeleAcceuil::getBat(User::$idVille);

	$this->constructView("VueAccueil", "display_accueil", array($bats, User::getNomVille()));
    }

}
