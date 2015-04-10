<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ListeTypoBat extends DBMapper {

    static function getListeTypo() {
	$rqt = self::$database->prepare("SELECT * FROM TypoBatiments ORDER BY idType LIMIT 3");
	$rqt->execute(array(NULL));

	return $rqt;
    }

    static function getTypo($idTypo) {
	$rqt = self::$database->prepare("SELECT * FROM TypoBatiments WHERE idType = ?");
	$rqt->execute(array($idTypo));

	return $rqt;
    }

}

?>
