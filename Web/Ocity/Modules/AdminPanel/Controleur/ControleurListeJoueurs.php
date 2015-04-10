<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class ControleurListeJoueurs extends ControleurGenerique {

    function display_Joueurs() {
	require_once ("Modules/AdminPanel/Modele/Joueurs.php");
	require_once "Modules/AdminPanel/Vue/VueListeJoueurs.php";
	$arg = Joueurs::getListeJoueurs();
	$this->constructView("VueListeJoueurs", "display_listeJoueurs", array($arg));
    }

}
