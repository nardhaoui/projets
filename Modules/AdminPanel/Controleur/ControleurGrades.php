<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class ControleurGrades extends ControleurGenerique {

    function display_formGrades() {
	require_once "Modules/AdminPanel/Modele/Joueurs.php";

	$id = isset($_POST['idCompte']) ? $_POST['idCompte'] : 0;
	if ($id == 0) {
	    $id = isset($_GET['id']) ? $_GET['id'] : 0;
	    if ($id == 0) {
		Error::notice("L'id du joueur n'a pas été transmit.");
		require_once "Modules/AdminPanel/Vue/VueListeJoueurs.php";
		$arg = Joueurs::getListeJoueurs();

		$this->constructView("VueListeJoueurs", "display_listeJoueurs", array($arg));
	    } else {
		require_once "Modules/AdminPanel/Vue/VueGrade.php";

		$joueur = Joueurs::getJoueur($id);
		$grades = Joueurs::getListeGrades();

		$this->constructView("VueGrade", "display_modifGrade", array($joueur, $grades));
	    }
	} else {
	    require_once "Modules/AdminPanel/Vue/VueListeJoueurs.php";

	    $grade = isset($_POST['grades']) ? $_POST['grades'] : 0;

	    if ($grade == 0)
		Error::notice("Problème avec l'id du grade en post");
	    else {
		Joueurs::setGrade($id, $grade);
		Confirm::display("Le changement ok.");
	    }
	    $arg = Joueurs::getListeJoueurs();

	    $this->constructView("VueListeJoueurs", "display_listeJoueurs", array($arg));
	}
    }

}
