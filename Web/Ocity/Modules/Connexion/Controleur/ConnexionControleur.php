<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ConnexionControleur extends ControleurGenerique {

    function formulaire() {
	require_once ("Modules/Connexion/Vue/ConnexionVue.php");
	$this->constructView("ConnexionVue", "formulaire", array());
    }

    function confirm() {
	Debug::active();
	require_once ("Modules/Connexion/Vue/ConnexionVue.php");
	require_once ("Modules/Connexion/Modele/ConnexionModele.php");
	$result = ConnexionModele::correctPost();
	if ($result !== false) {
	    ConnexionModele::connect($result);
	    $this->constructView("ConnexionVue", "valide", array($result));
	    header('Location: index.php');
	} else {
	    $this->constructView("ConnexionVue", "formulaire", array());
	}
    }

}
