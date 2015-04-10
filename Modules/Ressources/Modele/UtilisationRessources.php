<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class UtilisationRessources {

    /**
     * 	Permet de depenser de l'argent.
     * 		$idVille
     * 			Compte a debiter.
     * 		$amount
     * 			Somme à debiter.
     * 		return
     * 			1 si le compte dispose de ressources suffisantes, 0 sinon.	
     */
    static function spendMoney($idVille, $amount) {
	require_once('Modules/Ressources/Modele/AccesRessources.php');
	$argentActu = AccesRessources::getArgentPop($idVille)[0];

	if ($argentActu < $amount)
	    return 0;
	else {
	    $rqt = DBMapper::$database->prepare('UPDATE Ville SET argent = ? WHERE idVille = ?');
	    $rqt->execute(array($argentActu - $amount, $idVille));

	    return 1;
	}
    }

}
