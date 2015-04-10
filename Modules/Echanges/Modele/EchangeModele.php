<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class EchangeModel extends DBMapper {

    function getUsers() {
	$req = self::$database->query("SELECT idCompte,pseudo FROM Compte");
	return $req->fetchall();
    }
	
	function getEchange($idCompte){
		try{
			$req = self::$database->prepare("SELECT * FROM Echange e INNER JOIN Compte c ON e.client = c.idCompte WHERE e.client=?");
			$req->execute(array($idCompte));
			return $req->fetchall();
		}catch(exeption $e){
			return false;
		}
	}
	
	function isPseudo($pseudo){
		try{
			$req = self::$database->prepare("SELECT idCompte FROM Compte WHERE pseudo=?");
			$req->execute(array($pseudo));
			if($res = $req->fetch()){
				return true;
			}
			return false;
		}catch(exeption $e){
			return false;
		}
		
	}
	
	function getDest($pseudo){
		try{
			$req = self::$database->prepare("SELECT idCompte,count(pseudo) as nb FROM Compte WHERE pseudo=?");
			$req->execute(array($pseudo));
			if($res = $req->fetch()){
				if($res['nb']!=1){
					return false;
				}
				return $res['idCompte'];
			}
			return false;
		}catch(exeption $e){
			return false;
		}
	}	
	
	function newEchange($dest,$env,$type,$res,$qte){
		try{
			$req = self::$database->prepare("INSERT INTO Echange VALUES(default,?,?,?,?,?)");
			$req->execute(array($env,$dest,$res,$type,$qte));
			return true;
		}catch(exeption $e){
			return false;
		}
	}
	
	function isEchangeOf($id,$idCompte){
		try{
			$req = self::$database->prepare("SELECT * FROM Echange WHERE id = ? AND client = ?");
			$req->execute(array($id,$idCompte));
			if($res = $req->fetch()){
				return true;
			}
			return false;
		}catch(exeption $e){
			return false;
		}
	}
	
	function deleteEchange($id){
		try{
			$req = self::$database->prepare("DELETE FROM Echange WHERE id = ?");
			$req->execute(array($id));
			return true;
		}catch(exeption $e){
			return false;
		}
	}
	 
	

}

?>