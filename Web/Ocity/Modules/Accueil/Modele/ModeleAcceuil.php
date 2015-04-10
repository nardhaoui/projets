<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ModeleAcceuil extends DBMapper {

    function getBat($idVille) {
	$req = self::$database->prepare("SELECT * from Batiments INNER JOIN TypoBatiments ON Batiments.typoBat = TypoBatiments.idType WHERE idVille = ? ORDER BY positionY,positionX");
	$req->execute(array($idVille));
	return $req->fetchall();
    }

}

