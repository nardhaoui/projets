<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Batiment {

    const COEF_PRIX = 0.3; //Coef du prix de l'amelioration
    const COEF_PRIX_DEMO = 0.50; //Coef du prix de le destruction
    const BAT_TYPO_UP = 5; //Palier du passage a la typo superieur d'un batiment

	static function getBat($idBat) {
		if (empty($idBat)) {
			Error::postError("idBat");
			return false;
		}
		else {
			$rqt = DBMapper::$database->prepare('SELECT * FROM Batiments as b, TypoBatiments as t WHERE idBat = ? AND b.typoBat = t.idType');
			$rqt->execute(array($idBat));
			return $rqt->fetch();
		}
	}


    /* Retourne la production net d'un batiment
     * return 
     * 	array(argent, eau, elec)
     */

	static function getProdBatiment($bat) {
		require_once "Modules/Ressources/Modele/AccesRessources.php";

		if (empty($bat)) {
			Error::postError("Bat");
			return false;
		} 
		else {
			$argent = $bat['productionArgent'] * $bat['lvlBat'] * AccesRessources::COEF_GAIN_ARGENT;
			$eau = $bat['productionEau'] * $bat['lvlBat'];
			$elec = $bat['productionElectricite'] * $bat['lvlBat'];
			return array($argent, $eau, $elec);
		}
	}

	static function ameliorerBatiment($idBat) {
		require_once 'Modules/Ressources/Modele/UtilisationRessources.php';

		$bat = Batiment::getBat($idBat);

		if (UtilisationRessources::spendMoney($bat['idVille'], self::getPrix($idBat))) {
			if($bat['lvlBat'] >= Batiment::BAT_TYPO_UP && $bat['amelioration'] != 0){
				$rqt = DBMapper::$database->prepare('UPDATE Batiments SET lvlBat = ?, typoBat = ? WHERE idBat = ?');
				$rqt->execute(array(1, $bat['amelioration'], $idBat));
			
			}
			else {	
				$rqt = DBMapper::$database->prepare('UPDATE Batiments SET lvlBat = ? WHERE idBat = ?');
				$rqt->execute(array($bat['lvlBat'] + 1, $idBat));
			}
			return 1;
		}
		else
			return 0;
	}

	static function detruireBat($idBat) {
		require_once 'Modules/Ressources/Modele/UtilisationRessources.php';

		$bat = Batiment::getBat($idBat);
		$prixDemo = self::getPrixDemo(self::getPrix($idBat));

		if (UtilisationRessources::spendMoney($bat['idVille'], $prixDemo)) {
			$rqt = DBMapper::$database->prepare('DELETE FROM Batiments WHERE idBat = ?');
			$rqt->execute(array($idBat));

			return 1;
		}
		else
			return 0;
	}

	static function getPrix($idBat) {
		$bat = Batiment::getBat($idBat);

		return $bat['prix'] * $bat['lvlBat'] * self::COEF_PRIX;
	}

	static function getPrixDemo($prix) {
		return $prix * self::COEF_PRIX_DEMO;
	}

}
