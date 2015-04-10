<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ControleurListBat extends ControleurGenerique {

    function defaultFunc() {
	require_once ("Modules/AmeliorationBatiment/Vue/VueListeBatiments.php");
	$this->constructView("VueListeBatiments", "display_idVilleSelector", array(NULL));
    }

    function display_BatList() {
	require_once 'utils/utilisateur.php';

	$idVille = User::$idVille;

	if (empty($idVille)) {
	    Error::postError("idVille");
	} else {
	    require_once ("Modules/AmeliorationBatiment/Vue/VueListeBatiments.php");
	    $this->constructView("VueListeBatiments", "display_BatList", array($idVille));
	}
    }

    function ameliorerBat() {
	require_once ("Modules/AmeliorationBatiment/Vue/VueListeBatiments.php");
	require_once "Modules/AmeliorationBatiment/Modele/Batiment.php";
	$idVille = User::$idVille;

	if (empty($_GET['idbat'])) {
	    Error::postError("idbat");
	    $this->constructView("VueListeBatiments", "display_BatList", array($idVille));
	} else {
	    $idBat = $_GET['idbat'];
	    if (Batiment::ameliorerBatiment($idBat))
		Confirm::display("Amélioration effectuée");
	    else
		Error::erreur("Echec de l'amélioration");
	    $idBat = isset($_GET['idbat']) ? $_GET['idbat'] : 0;

	    if ($idBat <= 0)
		$this->constructView("VueListeBatiments", "display_BatList", array($idVille));
	    else
		$this->infosBat();
	}
    }

    function demoBat() {
	require_once ("Modules/AmeliorationBatiment/Vue/VueListeBatiments.php");
	require_once ("Modules/AmeliorationBatiment/Modele/Batiment.php");

	$idVille = User::$idVille;

	if (empty($_GET['idbat'])) {
	    Error::postError("idbat");
	    $this->constructView("VueListeBatiments", "display_BatList", array($idVille));
	} else {
	    $idBat = $_GET['idbat'];
	    if (Batiment::detruireBat($idBat))
		Confirm::display("Votre batiment a été démoli. Et vous venez de vous rendre que compte que vous avez payé pour perdre un batiment...");
	    else
		Error::erreur("Echec de la démolition, vous n'avez pas assez d'argent");
	    $this->constructView("VueListeBatiments", "display_BatList", array($idVille));
	}
    }

    function infosBat() {
	require_once "Modules/AmeliorationBatiment/Vue/VueInfosBat.php";
	require_once "Modules/AmeliorationBatiment/Modele/Batiment.php";

	$idBat = isset($_GET['idbat']) ? $_GET['idbat'] : 0;

	if ($idBat <= 0)
	    Error::postError("idbat");
	else {
	    $bat = Batiment::getBat($idBat);
	    $prodBat = Batiment::getProdBatiment($bat);
	    $prixAction = array(Batiment::getPrix($idBat), Batiment::getPrixDemo($idBat));
	    $this->constructView("VueInfosBat", "display_infosBat", array($bat, $prodBat, $prixAction));
	}
    }

}
