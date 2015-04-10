<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class AccesRessources {

    const REFRESH_TIME = 3600; //3600 pour chaque heure.
    const COEF_GAIN_HABITANT = 0.2;
    const COEF_GAIN_ARGENT = 1.2;

    /**
     * 	Renvoie les ressources d'une ville sous le format array(Argent, Elec, Eau, Popul, PopMax).
     */
	function getRessources($idVille) {

		$tmp = self::getArgentPop($idVille);
		$argent = $tmp[0];
		$population = $tmp[1];
		$tmp = self::getElecEau($idVille);
		$elec = $tmp[0];
		$eau = $tmp[1];
		$popMax = self::getCapacitePopulation($idVille);

		return array($argent, $elec, $eau, $population, $popMax);
	}

    /**
     * 	Retourne array(argent, pop).
     */
	function getArgentPop($idVille) {
		$rqt = DBMapper::$database->prepare('SELECT argent, population from Ville WHERE idVille = ?');
		$rqt->execute(array($idVille));
		$res = $rqt->fetch();

		return array($res['argent'], $res['population']);
	}

	function getLastRefresh($idVille) {
		$rqt = DBMapper::$database->prepare('SELECT dernierRefresh from Ville WHERE idVille = ?');
		$rqt->execute(array($idVille));
		$res = $rqt->fetch();

		$year = substr($res['dernierRefresh'], 2, 2);
		$month = substr($res['dernierRefresh'], 5, 2);
		$day = substr($res['dernierRefresh'], 8, 2);
		$hour = substr($res['dernierRefresh'], 11, 2);
		$minute = substr($res['dernierRefresh'], 14, 2);
		$second = substr($res['dernierRefresh'], 17, 2);


		return mktime($hour, $minute, $second, $month, $day, $year);
	}

    /**
     * 	Retourne un tableau array(argent, habitant)
     */
	function getAmountOfGain($idVille, $hour) {
		if ($hour == 0)
			return array(0, 0);
			else {
				//Calcul Argent
				$rqt = self::getListeBat($idVille);
				$totalArgent = 0;

				while ($current = $rqt->fetch())
				$totalArgent += ($current['productionArgent'] * $current['lvlBat']) * self::COEF_GAIN_ARGENT * $hour;

				//Calcul Population
				$capaMax = self::getCapacitePopulation($idVille);
				$popActuel = self::getArgentPop($idVille)[1];
				$totalHabAdd = 0;

				$enNegatif = 0;
				$balanceRes = self::getElecEau($idVille);

				//Fait en sorte que l'on ne puisse pas gagner de pop en cas de valeur neg.
				if ($balanceRes[0] < 0 || $balanceRes[1] < 0) {
				if ($balanceRes[0] > 0)
				$balanceRes[0] = 0;
				if ($balanceRes[1] > 0)
				$balanceRes[1] = 0;
				$enNegatif = 1;
			}

			if ($capaMax > $popActuel || $enNegatif) {
				$totalHabAdd = (int) ($balanceRes[0] * self::COEF_GAIN_HABITANT) + ($balanceRes[1] * self::COEF_GAIN_HABITANT); //Total des habitant additionnés
			}




			return array($totalArgent, $totalHabAdd);
		}
	}

	function refreshRessources($idVille) {
		$rfshTimeLapse = (int) (abs(time() - self::getLastRefresh($idVille)) / self::REFRESH_TIME);
		$gain = self::getAmountOfGain($idVille, $rfshTimeLapse);
		$tmp = self::getArgentPop($idVille);

		$baseArgent = $tmp[0]; //Ressources deja dans la bd
		$basePop = $tmp[1];
		$argent = $gain[0];
		$popTotal = self::calculerPop($gain[1], $basePop, self::getCapacitePopulation($idVille));

		$time = date("Y-m-d H:i:s", time());

		if ($gain[0] != 0 || $gain[1] != 0 || $basePop != $popTotal) {
			$rqt = DBMapper::$database->prepare('UPDATE Ville SET argent = ?, population = ?,  dernierRefresh = ? WHERE idVille = ?');
			$rqt->execute(array(
				$argent + $baseArgent,
				$popTotal,
				$time,
				$idVille
			));
		}
	}

	private function calculerPop($newPop, $basePop, $limitePop) {

		if ($basePop + $newPop > $limitePop)
			return $limitePop;
		else if ($basePop + $newPop < 0)
			return 0;
		else
			return$basePop + $newPop;
	}

    /**
     * 	Retourne sous forme d'un tableau Array($totalElec, $totalEau) les ressources non cumulables.
     */
    function getElecEau($idVille) {
		$rqt = self::getListeBat($idVille);
		$totalElec = 0;
		$totalEau = 0;

		while ($current = $rqt->fetch()) {
			$totalElec += $current['productionElectricite'] * $current['lvlBat'];
			$totalEau += $current['productionEau'] * $current['lvlBat'];
		}

		return Array($totalElec, $totalEau);
	}

	function getCapacitePopulation($idVille) {
		$rqt = self::getListeBat($idVille);
		$total = 0;

		while ($current = $rqt->fetch())
			$total += $current['capacitePopulation'] * $current['lvlBat'] * 1.50;

		return $total;
	}

	function getListeBat($idVille) {
		$rqt = DBMapper::$database->prepare('SELECT * FROM Batiments AS b INNER JOIN TypoBatiments AS t ON b.typoBat = t.idType WHERE b.idVille = ?');
		$rqt->execute(array($idVille));
		return $rqt;
    }

}
