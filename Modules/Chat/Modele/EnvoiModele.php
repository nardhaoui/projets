<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class EnvoiModele {

    function verif($mess) {

	//ATTENTION : Mettre un htmlentities SEULEMENT s'il n'y en a pas dans l'affichage !!! (et inversement)
	$message = htmlentities($mess);

	if (strlen($message) > 300 || strlen($message) == 0) {
	    return array('MODIFICATION DU CODE', 'Veuillez ne pas modifier le code javascript et html');
	}

	//Vérification du canal
	$nospaceMess = rtrim(ltrim($message, " "), " ");    //Supprime les espaces en début et en fin de chaine
	$pseudo = null;

	//Canal général
	if ($nospaceMess[0] != "/") {
	    $envoi = $nospaceMess;
	    $destinataire = 0;
	    $classCanal = 'messGeneral';
	} else {

	    if (strlen($nospaceMess) < 2 || (substr($nospaceMess, 1, 2) != "g " && substr($nospaceMess, 1, 2) != "r " && substr($nospaceMess, 1, 2) != "p " && $nospaceMess[1] != "h")) {   //Gère également le cas où aucun message suis le canal (les espaces sont supprimés)
		//Erreur syntax
		return array('CANAL INEXISTANT', 'Utilisez /h pour connaitre les commandes existantes');
	    } else {
		//Canal défini
		$envoi = substr($nospaceMess, 3);   //Message sans espaces debut/fin et sans l'indication de canal (/x )
		$canal = $nospaceMess[1];   //"g" = général, "r" = région, "p" = privé, "h" = aide
		switch ($canal) {
		    case "h" :      //De la forme : /h
			return array('AIDE COMMANDES', '[/h] = Voir cette aide<br/>'
			    . '[/g Message] ou [Message] = Canal général<br/>'
			    . '[/r Message] = Canal région<br/>'
			    . '[/p Destinataire Message] = Canal privé');
		    case "g" :      //De la forme : /g Message

			$destinataire = 0;
			$classCanal = 'messGeneral';
			break;

		    case "r" :      //De la forme : /r Message

			$idRegion = User::$idRegion;
			$destinataire = pow(10, strlen((string) $idRegion)) + $idRegion;    //On rajoute un 1 devant l'idRegion
			$classCanal = 'messRegion';
			break;

		    case "p" :      //De la forme : /p Destinataire Message

			if (($pseudo = strstr($envoi, ' ', true)) == false) {
			    //Erreur simple : Aucun message après le pseudo
			    return false;
			}

			$rqt = DBMapper::$database->prepare('SELECT idCompte FROM Compte WHERE pseudo=?');
			$rqt->execute(array(
			    $pseudo
			));
			$idCompte = $rqt->fetch()[0];
			if ($idCompte == null) {
			    //Erreur : pseudo inexistant
			    return array('PSEUDO INEXISTANT', 'Le pseudo ' . $pseudo . ' n\'existe pas. Utilisez /h pour connaitre les commandes existantes');
			}

			$destinataire = 2 * pow(10, strlen((string) $idCompte)) + $idCompte;    //On rajoute un 2 devant l'idCompte
			$envoi = substr(strstr($envoi, ' '), 1);
			$classCanal = 'messPrive';

			break;

		    default :
			return array('ERREUR CRITIQUE', 'Problème dans le code serveur, veuillez contacter un administrateur'); //Cas impossible
			break;
		}
	    }
	}

	return array($envoi, $destinataire, $classCanal, $pseudo);
    }

    function sendMessage($message, $destinataire) {
	$rqt = DBMapper::$database->prepare('INSERT INTO Chat (idCompte,message,destinataire) VALUES(?, ?, ?)');
	$rqt->execute(array(
	    User::$idCompte,
	    $message,
	    $destinataire
	));
    }

}
