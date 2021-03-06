<?php 
class ModeleShop {

	static function addMoney($valJeu){
		$rqt = DBMapper::$database->prepare('UPDATE Ville SET argent = ? WHERE idVille = ?');
		$rqt->execute(array(self::getMoney()['argent'] + $valJeu, User::$idVille));
		
	}
	
	static function addHistorique($valJeu, $valReel){
		$rqt = DBMapper::$database->prepare("INSERT INTO HistoriqueShop (idTransaction, idCompte, date, valeurJeu, valeurReel) VALUES (default, ?, ?, ?, ?)");
		$rqt->execute(array(User::$idCompte, date("Y-m-d H:i:s", time()), $valJeu, $valReel));	
	}
	
	static function getMoney(){
		$rqt = DBMapper::$database->prepare("SELECT argent FROM Ville WHERE idVille = ?");
		$rqt->execute(array(User::$idVille));
		return $rqt->fetch();
	}
	
}

?>
