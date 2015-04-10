<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class Joueurs extends DBMapper {

    /**
     * Retourne la liste des joueurs.
     * 	$premierJoueur et $dernierJoueur sont les limites (sql : LIMIT $premierJoueur).
     */
    static function getListeJoueurs() {
	$rqt = self::$database->prepare("SELECT * from Compte AS c INNER JOIN Grade AS g ON c.idGrade = g.idGrade ORDER BY pseudo");
	$rqt->execute();
	return $rqt;
    }

    static function getJoueur($id) {
	$rqt = self::$database->prepare("SELECT * from Compte AS c INNER JOIN Grade AS g ON c.idGrade = g.idGrade WHERE idCompte = ?");
	$rqt->execute(array($id));
	return $rqt->fetch();
    }

    static function setGrade($idJoueur, $idGrade) {
	$rqt = self::$database->prepare("UPDATE Compte SET idGrade = ? WHERE idCompte = ? ");
	$rqt->execute(array($idGrade, $idJoueur));
    }

    static function getListeBans() {
	$rqt = self::$database->prepare("SELECT * from Bans INNER JOIN Compte ON Bans.compte = Compte.idCompte");
	$rqt->execute();
	return $rqt;
    }

    static function bannirTempo($id, $dateFin, $motif) {
	$rqt = self::$database->prepare("INSERT INTO Bans (id, compte, type, dateDebut, dateFin, motif) VALUES(default, ?, 0, ?, ?, ?)");
	$rqt->execute(array($id, date("Y-m-d H:i:s", time()), $dateFin, $motif));
    }

    static function unban($id) {
	$rqt = self::$database->prepare("DELETE FROM Bans WHERE id = ?");
	$rqt->execute(array($id));
    }

    static function getListeGrades() {
	$rqt = self::$database->prepare("SELECT * FROM Grade");
	$rqt->execute();
	return $rqt;
    }

    static function getVille($idVille) {
	$rqt = self::$database->prepare("SELECT * FROM Ville  WHERE idVille = ?");
	$rqt->execute(array($idVille));
	return $rqt->fetch();
    }

    static function getListeBats($idVille) {
	$rqt = self::$database->prepare("SELECT * FROM Batiments AS b INNER JOIN TypoBatiments AS t ON b.typoBat = t.idType WHERE b.idVille = ? ORDER BY lvlBat DESC");
	$rqt->execute(array($idVille));
	return $rqt;
    }

    static function getHistorique($id) {
	$rqt = self::$database->prepare("SELECT * FROM HistoriqueShop WHERE idCompte = ?");
	$rqt->execute(array($id));
	return $rqt;
    }

}

?>
