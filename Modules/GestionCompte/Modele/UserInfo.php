<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class UserInfo extends DBMapper {

    static function getUserInfos() {
	$rqt = self::$database->prepare("SELECT pseudo, email FROM Compte WHERE idCompte = ?");
	$rqt->execute(array(User::$idCompte));
	$res = $rqt->fetch();
	return array($res['pseudo'], $res['email']);
    }

    static function correctMDP($MDP) {
	$rqt = self::$database->prepare("SELECT motdepasse FROM Compte WHERE idCompte = ?");
	$rqt->execute(array(User::$idCompte));
	if ($MDP == $rqt->fetch()['motdepasse'])
	    return 1;
	else
	    return 0;
    }

    static function changeMDP($MDP) {
	$rqt = self::$database->prepare("UPDATE Compte SET motdepasse = ? WHERE idCompte = ?");
	$rqt->execute(array($MDP, User::$idCompte));
    }

}
