<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class CreaBatimentModele extends DBMapper {

    function secure($typo, $posX, $posY) {

	if ($posX < 0 || $posX > 7 || $posY < 0 || $posY > 30) {
	    Error::erreur("Position (" . ($posX + 1) . ":" . ($posY + 1) . ") en dehors de la ville !");
	    return false;
	}

	$posXPrises = self::getListePosXPrises();
	$posYPrises = self::getListePosYPrises();

	for ($i = 0; $i < count($posXPrises); $i++) {
	    if ($posXPrises[$i] == $posX && $posYPrises[$i] == $posY) {
		Error::erreur("Position (" . ($posX + 1) . ":" . ($posY + 1) . ") déjà prise !");
		return false;
	    }
	}

	return true;
    }

    function getListeTypoBat() {

	$req = self::$database->prepare('SELECT nom FROM TypoBatiments');
	$req->execute();

	while ($temp = $req->fetch()) {
	    $liste[] = $temp[0];
	}

	return $liste;
    }

    function getListePosXPrises() {

	$req = self::$database->prepare('SELECT positionX FROM Batiments WHERE idVille=' . User::$idVille . ' ORDER BY idBat');
	$req->execute();

	$liste = array();
	while ($temp = $req->fetch()) {
	    $liste[] = $temp[0];
	}

	return $liste;
    }

    function getListePosYPrises() {

	$req = self::$database->prepare('SELECT positionY FROM Batiments WHERE idVille=' . User::$idVille . ' ORDER BY idBat');
	$req->execute();

	$liste = array();
	while ($temp = $req->fetch()) {
	    $liste[] = $temp[0];
	}

	return $liste;
    }

    function getTypoBatIdPrix($typo) {
	$req = self::$database->prepare("SELECT idType,prix FROM TypoBatiments WHERE nom='" . $typo . "'");
	$req->execute();
	$res = $req->fetch();

	return array($res['idType'], $res['prix']);
    }

    function payerBatiment($prix) {
	$update = self::$database->prepare("UPDATE Ville SET argent=" . (User::getArgent() - $prix) . " WHERE idVille=" . User::$idVille);
	$update->execute();
    }

    function insertBatiment($idTypo, $posX, $posY) {
	$insert = self::$database->prepare("INSERT INTO Batiments(positionX,positionY,typoBat,idVille) VALUES(?,?,?,?)");
	$insert->execute(array(
	    $posX,
	    $posY,
	    $idTypo,
	    User::$idVille
	));
    }

}
