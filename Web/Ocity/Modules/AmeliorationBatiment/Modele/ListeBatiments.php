<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ListeBatiments {

    static function getListeBat($idVille) {
	if (empty($idVille)) {
	    Error::postError("idVille");
	    return false;
	} else {
	    $rqt = DBMapper::$database->prepare('SELECT * FROM Batiments as b INNER JOIN TypoBatiments as t ON b.typoBat = t.idType WHERE idVille = ?');
	    $rqt->execute(array($idVille));
	    return $rqt;
	}
    }

}
