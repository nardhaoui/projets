<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

/**
 * 	CECI EST UN CONTROLEUR DE DEBUG
 */
class ControleurSpend extends ControleurGenerique {

    function spend() {
	require_once('Modules/Ressources/Modele/UtilisationRessources.php');

	echo UtilisationRessources::spendMoney(1, 1000);
    }

}
