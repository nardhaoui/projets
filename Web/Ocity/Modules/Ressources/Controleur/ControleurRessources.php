<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ControleurRessources extends ControleurGenerique {

    function display() {
	require_once('Modules/Ressources/Modele/AccesRessources.php');
	require_once('Modules/Ressources/Vue/vueRessources.php');
	require_once 'utils/utilisateur.php';

	$idVille = User::$idVille;

	AccesRessources::refreshRessources($idVille);
	vueRessources::display_Ressources(AccesRessources::getRessources($idVille));
    }

}
