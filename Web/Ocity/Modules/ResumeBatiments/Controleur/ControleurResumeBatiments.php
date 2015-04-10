<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ControleurResumeBatiments extends ControleurGenerique {

    function defaultFunc() {
	require_once ("Modules/ResumeBatiments/Vue/VueResumeBatiments.php");
	require_once ("Modules/ResumeBatiments/Modele/ListeTypoBat.php");

	$posX = null;
	$posY = null;
	if (isset($_GET['posx']) && isset($_GET['posy'])) {
	    $posX = $_GET['posx'];
	    $posY = $_GET['posy'];
	}

	$this->constructView("VueResumeBatiments", "display_resumeBatiments", array(ListeTypoBat::getListeTypo(), $posX, $posY));
    }

    //Useless
    function display_typoBat() {
	require_once ("Modules/ResumeBatiments/Vue/VueResumeBatiments.php");
	require_once ("Modules/ResumeBatiments/Modele/ListeTypoBat.php");

	$this->constructView("VueResumeBatiments", "display_batiment", array(ListeTypoBat::getTypo($_GET['idtypo'])));
    }

}
