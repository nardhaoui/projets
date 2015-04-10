<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class ControleurVille extends ControleurGenerique {

    function display_ville() {
	require_once "Modules/AdminPanel/Vue/VueVille.php";
	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	if ($id > 0) {
	    require_once "Modules/AdminPanel/Modele/Joueurs.php";

	    $ville = Joueurs::getVille($id);
	    $bats = Joueurs::getListeBats($ville['idVille']);
	    $this->constructView("VueVille", "display_ville", array($ville, $bats));
	} else
	    $this->constructView("VueVille", "display_error", array(NULL));
    }

}
