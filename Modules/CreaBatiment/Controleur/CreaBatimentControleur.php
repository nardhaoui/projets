<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class CreaBatimentControleur extends ControleurGenerique {

    function afficherDemande() {

	require_once("Modules/CreaBatiment/Vue/CreaBatimentVue.php");
	require_once("Modules/CreaBatiment/Modele/CreaBatimentModele.php");

	$listeTypoBat = CreaBatimentModele::getListeTypoBat();
	$bat = null;
	$posX = null;
	$posY = null;

	//Sécurisation des GET non nécessaire, seule la vue est affectée (les input)
	if (isset($_GET['bat'])) {
	    $bat = $_GET['bat'];
	}

	if (isset($_GET['posx']) && isset($_GET['posy'])) {
	    $posX = $_GET['posx'];
	    $posY = $_GET['posy'];
	}

	$this->constructView("CreaBatimentVue", "affDemande", array($listeTypoBat, $bat, $posX, $posY));
    }

    function afficherConfirm() {
	require_once('utils/utilisateur.php');
	require_once("Modules/CreaBatiment/Vue/CreaBatimentVue.php");
	require_once("Modules/CreaBatiment/Modele/CreaBatimentModele.php");

	Debug::active();

	if (isset($_POST['typoBat']) && isset($_POST['posX']) && isset($_POST['posY']) && CreaBatimentModele::secure($_POST['typoBat'], $_POST['posX'] - 1, $_POST['posY'] - 1)) {
	    require_once("Modules/Ressources/Modele/UtilisationRessources.php");
	    $typo = $_POST['typoBat'];
	    $posX = $_POST['posX'] - 1;
	    $posY = $_POST['posY'] - 1;

	    //Payement et Insertion du nouveau batiment
	    $batIdPrix = CreaBatimentModele::getTypoBatIdPrix($typo);
	    if (UtilisationRessources::spendMoney(User::$idVille, $batIdPrix[1])) {
		CreaBatimentModele::insertBatiment($batIdPrix[0], $posX, $posY);
		Confirm::display("Le batiment " . $typo . " a été créé à la position (" . ($posX + 1) . ":" . ($posY + 1) . ")");
		self::afficherDemande();
	    } else {
		Error::erreur("Vous n'avez pas l'argent nécessaire à cet achat !");
	    }
	} else {
	    self::afficherDemande();
	}
    }

}
