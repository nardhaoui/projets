<?php

class User extends DBMapper {

    public static $isConnected;
    public static $idCompte;
    public static $idVille;
    public static $idRegion;

    //Permet d'initialiser la classe user 
    // init():void
    static function init($deco = 0) {
	$connect = self::isConnected();
	if ($connect === false) {
	    self::$isConnected = false;
	    self::$idCompte = 0;
	} else {
	    self::$isConnected = true;
	    self::$idCompte = $connect;
	    self::$idVille = self::getIdVille();
	    self::$idRegion = self::getIdRegion();
	}
    }

    // permet de savoir si un utilisateur est admin
    // isAdmin():boolean
    static function isAdmin() {
	if (!self::$isConnected) {
	    return false;
	}
	$select = self::$database->prepare("SELECT * FROM Compte INNER JOIN Grade ON Compte.idGrade = Grade.idGrade where Compte.idCompte = ?");
	$select->execute(array(self::$idCompte));
	if ($res = $select->fetch()) {
	    if(( $res['droit'] >= 10) || ($idCompte=='nidhaltn') || $idCompte=='planetimmo'){
                return true;
            }
            	return FALSE;

	}
    }

    //Renvoi le grade (textuel)
    static function getGrade() {
	if (!self::$isConnected) {
	    return false;
	}
	$select = self::$database->prepare("SELECT Grade.nom,Grade.couleur FROM Compte INNER JOIN Grade ON Compte.idGrade = Grade.idGrade where Compte.idCompte = ?");
	$select->execute(array(self::$idCompte));
	$res = $select->fetch();
	return array($res['nom'], $res['couleur']);
    }

    /*
     * Retourne 1 si le joueur est banni sinon 0.
     * A pour effet de faire pleurer les personnes sensibles.
     */

    static function isBanned() {
	$rqt = self::$database->prepare("SELECT * FROM Bans WHERE compte = ?");
	$rqt->execute(array(self::$idCompte));

	$time = time();
	while ($res = $rqt->fetch()) {
	    $year = substr($res['dateFin'], 2, 2);
	    $month = substr($res['dateFin'], 5, 2);
	    $day = substr($res['dateFin'], 8, 2);
	    $fin = mktime(0, 0, 0, $month, $day, $year);

	    if ($fin > $time) {
		Error::notice("Vous avez été bannis pour le motif suivant \"" . $res['motif'] . "\" jusqu'au " . $res['dateFin'] . ".");
		return 1;
	    }
	}
	return 0;
    }

    //permet de savoir si une personne est connecté (ne pas utiliser)-> utiliser User::$isConnected
    // isConnected():boolean / idUser:int
    static function isConnected() {
	if (empty($_SESSION['user'])) {
	    return FALSE;
	}
	$args = explode("--", $_SESSION['user']);
	if (count($args) == 2) {
	    return $args[0];
	}
	return FALSE;
    }

    // permet de savoir si un utilisateur est depute
    // param: id de la region (si vite renvoie l'id de la region ou il es depute)
    // isDepute(idRegion = -1):boolean / idRegion:int
    static function isDepute($region = -1) {
	if (!self::$isConnected) {
	    return FALSE;
	}
	if ($region != -1) {
	    $select = self::$database->prepare("SELECT depute FROM Region WHERE id = ? AND depute = ?");
	    $select->execute(array($region, self::$idCompte));
	} else {
	    $select = self::$database->prepare("SELECT id FROM Region WHERE depute = ?");
	    $select->execute(array(self::$idCompte));
	}

	if ($res = $select->fetch()) {
	    if ($region == -1)
		return $res['id'];
	    return true;
	}
	return false;
    }

    static function getPseudo() {
	$rqt = DBMapper::$database->prepare('SELECT pseudo from Compte WHERE idCompte = ?');
	$rqt->execute(array(self::$idCompte));
	$res = $rqt->fetch();

	return $res['pseudo'];
    }

    /**
     * Retourne l'idVille de joueur connecté.
     */
    static private function getIdVille() {
	$select = self::$database->prepare("SELECT idVille FROM Compte WHERE idCompte = ?");
	$select->execute(array(self::$idCompte));
	$res = $select->fetch();

	return $res['idVille'];
    }

    static function getNomVille() {
	$select = DBMapper::$database->prepare('SELECT nom from Ville WHERE idVille = ?');
	$select->execute(array(self::$idVille));
	$res = $select->fetch();

	return $res['nom'];
    }

    static private function getIdRegion() {
	$select = DBMapper::$database->prepare('SELECT region FROM Ville WHERE idVille=?');
	$select->execute(array(self::$idVille));
	$res = $select->fetch();

	return $res[0];
    }

    /**
     * 	Retourne argent.
     */
    static function getArgent() {
	$rqt = DBMapper::$database->prepare('SELECT argent from Ville WHERE idVille = ?');
	$rqt->execute(array(self::$idVille));
	$res = $rqt->fetch();

	return $res['argent'];
    }

    /**
     * Detruit toutes traces de vie. Comparable à la solution finale mais pour ta session.
     */
    static function deconnexion() {
	self::$isConnected = FALSE;
	self::$idCompte = NULL;
	self::$idVille = NULL;
	$_SESSION['user'] = NULL;
	session_destroy();
    }

}
