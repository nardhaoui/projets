<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class InscriptionControleur extends ControleurGenerique {

    function formulaire() {
	require_once ("Modules/Inscription/Vue/InscriptionVue.php");
	require_once ("Modules/Inscription/Modele/InscriptionModele.php");
	$pays = InscriptionModel::getPays();
	$this->constructView("InscriptionVue", "affFormulaire", array($pays));
    }

    function confirm() {
	require_once ("Modules/Inscription/Modele/InscriptionModele.php");
	require_once ("Modules/Inscription/Vue/InscriptionVue.php");
	$regions = InscriptionModel::getRegions($_POST['pays']);
	$compte = array(
	    "pseudo" => $_POST['pseudo'],
	    "email" => $_POST['email'],
	    "passe1" => sha1($_POST['passe1']),
	    "passe2" => sha1($_POST['passe2']),
	    "nomville" => $_POST['nomville'],
	    "pays" => $_POST['pays']
	);
	$this->constructView("InscriptionVue", "affEtape2", array($regions, $compte));
    }

    //Fonction non utilisée !
    private function postCorrectStep2() {
	if (empty($_POST['regionC'])) {
	    Error::postError(" nom de la region");
	    return false;
	}
	if (!ereg("^[0-zÜ-ü\-]{1,125}$", $_POST['regionC'])) {
	    Error::regex("des lettre ou des chiffres", "e nom de la région");
	    return false;
	}
	return !InscriptionModel::isRegion($_POST['regionC']);
    }

    function confirm2() {
	require_once ("Modules/Inscription/Modele/InscriptionModele.php");
	require_once ("Modules/Inscription/Vue/InscriptionVue.php");
	$rep = InscriptionModel::allPostIsCorrect();
	if ($rep === false) {
	    $pays = InscriptionModel::getPays();
	    $this->constructView("InscriptionVue", "affFormulaire", array($pays));
	} else {
	    if (InscriptionModel::CreateCompte($rep)) {
		$this->constructView("InscriptionVue", "inscrOk", array());
	    } else {
		$pays = InscriptionModel::getPays();
		$this->constructView("InscriptionVue", "affFormulaire", array($pays));
	    }
	}
    }

}
