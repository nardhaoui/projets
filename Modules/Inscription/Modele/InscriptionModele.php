<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class InscriptionModel extends DBMapper {

    function allPostIsCorrect() {
	if (empty($_POST['pseudo'])) {
	    Error::postError("Veuillez entrer un pseudo correct dans le champ adapté");
	    return false;
	}
	if (!ereg("^[0-z]{1,125}$", $_POST['pseudo'])) {
	    Error::regex("des caractères alphanumériques (a-z,A-Z,0-9)", "e pseudo");
	    return false;
	}
	if (empty($_POST['email'])) {
	    Error::postError("Veuillez entrer un mail correct dans le champ adapté");
	    return false;
	}
	if (!ereg("^[0-z._]{1,125}@[0-z]{1,125}\.[0-z]{1,5}$", $_POST['email'])) {
	    Error::erreur("l'email doit être sous forme: nom@host.domain");
	    return false;
	}
	if (empty($_POST['passe1'])) {
	    Error::postError("Veuillez entrer un mot de passe correct dans le champ adapté");
	    return false;
	}
	if (!ereg("^[0-z]{6,125}$", $_POST['passe1'])) {
	    Error::regex("des caractères alphanumériques (a-z,A-Z,0-9) et faire plus de 6 caractères", "e mot de passe");
	    return false;
	}
	if ($_POST['passe1'] != $_POST['passe2']) {
	    Error::erreur("Les deux mots de passe doivent être identiques");
	    return false;
	}
	if (empty($_POST['nomville'])) {
	    Error::postError("Veuillez entrer un nom de ville correct dans le champ adapté");
	    return false;
	}
	if (!ereg("^[0-zÜ-ü\-]{1,125}$", $_POST['nomville'])) {
	    Error::regex("des caractères alphanumériques (a-z,A-Z,0-9,-)", "e nom de la ville");
	    return false;
	}
	if (empty($_POST['pays'])) {
	    Error::postError("Veuillez choisir un pays dans la liste déroulante");
	    return false;
	}
	if (empty($_POST['type'])) {
	    Error::postError("Veuillez créer ou sélectionner une région");
	    return false;
	}
	if ($_POST['type'] == 1) {
	    if (empty($_POST['regionC'])) {
		Error::postError("Veuillez entrer un nom de région correct dans le champ adapté");
		return false;
	    }
	    if (!ereg("^[0-zÜ-ü\-]{1,125}$", $_POST['regionC'])) {
		Error::regex("des caractères alphanumériques (a-z,A-Z,0-9,-)", "e nom de la région");
		return false;
	    }

	    $select = self::$database->prepare("SELECT id from Region where upper(nom) = upper(?)");
	    $select->execute(array($_POST['regionC']));
	    Debug::add("l 60" . implode(", ", $select->errorInfo()));
	    if ($res = $select->fetch()) {
		Error::erreur("Le nom de région '" . $_POST['regionC'] . "' est déjà utilisé");
		return false;
	    }
	    $region = $_POST['regionC'];
	} else {
	    if (empty($_POST['regionS'])) {
		Error::postError("Veuillez sélectionner une région");
		return false;
	    }
	    $region = $_POST['regionS'];
	}

	$select = self::$database->prepare("SELECT idCompte from Compte where upper(pseudo) = upper(?)");
	$select->execute(array($_POST['pseudo']));
	Debug::add("l 76" . implode(", ", $select->errorInfo()));
	if ($res = $select->fetch()) {
	    Error::erreur("Le pseudo '" . $_POST['pseudo'] . "' est déjà utilisé");
	    return false;
	}

	$select = self::$database->prepare("SELECT idVille from Ville where upper(nom) = upper(?)");
	$select->execute(array($_POST['nomville']));
	Debug::add("l 84" . implode(", ", $select->errorInfo()));
	if ($res = $select->fetch()) {
	    Error::erreur("La ville '" . $_POST['nomville'] . "' existe déjà");
	    return false;
	}

	$select = self::$database->prepare("SELECT idCompte from Compte where upper(email) = upper(?)");
	$select->execute(array($_POST['email']));
	Debug::add("l 92 " . implode(", ", $select->errorInfo()));
	if ($res = $select->fetch()) {
	    Error::erreur("Le mail '" . $_POST['email'] . "' est déjà utilisé");
	    return false;
	}
	return array(
	    "pseudo" => $_POST['pseudo'],
	    "email" => $_POST['email'],
	    "passe" => $_POST['passe1'],
	    "ville" => $_POST['nomville'],
	    "pays" => $_POST['pays'],
	    "region" => $region,
	    "type" => $_POST['type']
	);
    }

    function getRegions($pays) {
	$select = self::$database->prepare("SELECT id,nom from Region WHERE pays = ?");
	$select->execute(array($pays));
	Debug::add("l 110 " . implode(", ", $select->errorInfo()));
	return $select->fetchall();
    }

    function getPays() {
	$select = self::$database->query("SELECT id,nom_fr_fr,nom_en_gb from Pays");
	Debug::add("l 115 " . implode(", ", $select->errorInfo()));
	return $select->fetchall();
    }

    function CreateCompte($Compte) {
	if ($Compte['type'] == 1) {
	    try {
		$insert = self::$database->prepare("INSERT INTO Region(nom,createur,depute,pays) VALUES(?,0,0,?)");
		$insert->execute(array($Compte['region'], $Compte['pays']));
		Debug::add("l 124" . implode(", ", $insert->errorInfo()));

		$select = self::$database->prepare("SELECT id FROM Region WHERE nom = ?");
		$select->execute(array($Compte['region']));
		if (!($idRegion = $select->fetch())) {
		    Error::erreur("Erreur lors de la création de la région");
		    return false;
		}
		$idReg = $idRegion['id'];
	    } catch (exception $e) {
		Error::erreur("Erreur lors de la création de la région");
		return false;
	    }
	} else {
	    $idReg = $Compte['region'];
	}
	try {
	    $insert = self::$database->prepare("INSERT INTO Ville(nom,region,typePrincipale,dateCreation,dernierRefresh) VALUES(?,?,1,NOW(),NOW())");
	    Debug::add("l 142 " . $Compte['ville'] . " " . $idReg);
	    $insert->execute(array($Compte['ville'], $idReg));
	    Debug::add("l 144 " . implode(", ", $insert->errorInfo()));

	    $select = self::$database->prepare("SELECT idVille FROM Ville WHERE nom = ?");
	    $select->execute(array($Compte['ville']));
	    if (!($idVille = $select->fetch())) {
		Error::erreur("Erreur lors de la création de la ville");
		return false;
	    }
	} catch (exception $e) {
	    Error::erreur("Erreur lors de la création de la ville");
	    return false;
	}

	try {
	    $insert = self::$database->prepare("INSERT INTO Compte(pseudo,email,motdepasse,idVille) VALUES(?,?,?,?)");
	    $insert->execute(array(
		$Compte['pseudo'],
		$Compte['email'],
		$Compte['passe'],
		$idVille['idVille']
	    ));
	    Debug::add("l 165" . implode(", ", $insert->errorInfo()));

	    $select = self::$database->prepare("SELECT idCompte FROM Compte WHERE pseudo = ?");
	    $select->execute(array($Compte['pseudo']));
	    if (!($idCompte = $select->fetch())) {
		Error::erreur("Erreur lors de la création du compte");
		return false;
	    }
	} catch (exception $e) {
	    Error::erreur("Erreur lors de la création de la ville");
	    return false;
	}
	try {
	    $update = self::$database->prepare("UPDATE Region SET createur = ?, depute = ? WHERE id = ?");
	    $update->execute(array(
		$idCompte['idCompte'],
		$idCompte['idCompte'],
		$idReg
	    ));
	    Debug::add($idCompte['idCompte'] . " " . $idReg . " l 184" . implode(", ", $insert->errorInfo()));
	    return true;
	} catch (exception $e) {
	    Error::erreur("Erreur lors de la création de la ville");
	    return false;
	}
    }

}

?>
