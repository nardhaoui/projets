<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ChatModele {

    function setDernierActu() {
	$time = date("Y-m-d H:i:s", time());

	$rqt = DBMapper::$database->prepare('UPDATE Compte SET dernierActu = ? WHERE idCompte = ?');
	$rqt->execute(array(
	    $time,
	    User::$idCompte
	));
    }

    static function getConnectes() {
	$rqt = DBMapper::$database->prepare('SELECT Compte.pseudo,Grade.nom,Grade.couleur FROM Compte INNER JOIN Grade WHERE Compte.idGrade=Grade.idGrade AND dernierActu > current_timestamp() - interval 30 minute AND idCompte!=?');
	$rqt->execute(array(
	    User::$idCompte
	));
	$res = $rqt->fetchAll();
	return $res;
    }

    function getMessages() {
	$rqt = DBMapper::$database->prepare('SELECT Chat.time,Compte.pseudo,Chat.message,Chat.destinataire,Grade.couleur '
		. 'FROM Chat INNER JOIN Compte INNER JOIN Grade '
		. 'WHERE Compte.idCompte=Chat.idCompte AND Compte.idGrade=Grade.idGrade AND (Chat.idCompte=? OR Chat.destinataire=? OR Chat.destinataire=? OR Chat.destinataire=?) ');
	$rqt->execute(array(
	    User::$idCompte, //Messages envoyés par l'user
	    0, //Canal général
	    '1' . User::$idRegion, //Canal région
	    '2' . User::$idCompte //Canal privé
	));
	$res = $rqt->fetchAll();
	for ($i = 0; $i < sizeof($res); $i++) {
	    if (is_array($res[$i]['destinataire'] = self::getCanal($res[$i]['destinataire'][0]))) {
		return $res[$i]['destinataire'];
	    }
	}

	return $res;
    }

    function getDernierMessage() {
	//Ne prends pas en compte les MP envoyé depuis cet user (peu importe vu que les classes Envoi s'en occupent)
	$rqt = DBMapper::$database->prepare('SELECT Chat.time,Compte.pseudo,Chat.message,Chat.destinataire,Grade.couleur '
		. 'FROM Chat INNER JOIN Compte INNER JOIN Grade '
		. 'WHERE Compte.idCompte=Chat.idCompte AND Compte.idGrade=Grade.idGrade AND (Chat.destinataire=? OR Chat.destinataire=? OR Chat.destinataire=?) '
		. 'ORDER by idMessage desc LIMIT 1');
	$rqt->execute(array(
	    0, //Canal général
	    '1' . User::$idRegion, //Canal région
	    '2' . User::$idCompte   //Canal privé
	));
	$res = $rqt->fetch();

	if ($res['pseudo'] == User::getPseudo()) {
	    return false;
	}

	if (is_array($canal = self::getCanal($res['destinataire'][0]))) {
	    return $canal;
	}

	return array($canal, $res['time'], $res['pseudo'], $res['message'], $res['couleur']);
    }

    private static function getCanal($destinataire) {
	switch ($destinataire) {
	    case 0 :
		return 'messGeneral';
	    case 1 :
		return 'messRegion';
	    case 2 :
		return 'messPrive';
	    default :
		return array('messInfo', 'PROBLEME BDD', 'Destinataire : ' . $res['destinataire'] . ' non trouvé ! ');
	}
    }

}
