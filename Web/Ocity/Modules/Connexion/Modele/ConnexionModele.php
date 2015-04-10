<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ConnexionModele extends DBMapper {

    function correctPost() {
	if (empty($_POST['pseudo'])) {
	    Error::postError("pseudo");
	    return false;
	}
	if (empty($_POST['passe'])) {
	    Error::postError("mot de passe");
	    return false;
	}
	$select = self::$database->prepare("SELECT idCompte,motdepasse FROM Compte WHERE pseudo = ? OR email = ?");
	$select->execute(array($_POST['pseudo'], $_POST['pseudo']));
	Debug::active();
	Debug::add(implode(", ", $select->errorinfo()));
	Debug::desactive();
	if ($result = $select->fetch()) {
	    if (sha1($_POST['passe']) == $result['motdepasse']) {
		return array(
		    "pseudo" => $_POST['pseudo'],
		    "idCompte" => $result['idCompte'],
		    "passe" => $result['motdepasse']
		);
	    } else {
		Error::erreur("Nom de compte ou mot de passe incorrecte");
		return false;
	    }
	} else {
	    Error::erreur("Nom de compte ou mot de passe incorrecte");
	    return false;
	}
    }

    function connect($compte) {
	$_SESSION['user'] = $compte['idCompte'] . "--" . sha1($compte['pseudo'] . $compte['passe'] . $_SERVER['REMOTE_ADDR']);
    }

}

?>