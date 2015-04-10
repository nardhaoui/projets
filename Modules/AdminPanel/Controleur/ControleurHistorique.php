<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class ControleurHistorique extends ControleurGenerique {

    function display_historique() {
	require_once ("Modules/AdminPanel/Vue/VueHistorique.php");
	require_once ("Modules/AdminPanel/Modele/Joueurs.php");

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$histo = Joueurs::GetHistorique($id);

	$this->constructView("VueHistorique", "display_historique", array($histo));
    }

}
