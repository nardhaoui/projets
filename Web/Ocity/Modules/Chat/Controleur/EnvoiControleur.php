<?php

//Fichier appelé en Ajax par le fichier chat.js

ini_set("display_errors", 1);

define('SECURE',NULL);

session_start();

//Importation manuelle nécessaire (chemin relatif car ne part pas de l'index)
require_once '../../../utils/params_connexion.php';
require_once '../../../utils/dbmapper.php';
require_once '../../../utils/Constantes.php';
require_once '../../../utils/utilisateur.php';

//Connexion à la BD
try {
    $connexion = new PDO($dns, $user, $password);
    DBMapper::init($connexion);
} catch (Exception $e) {
    echo "La connexion à la base de données a échouée<br/>" . $e->getMessage();
}

User::init();

function recupererMessages() {
    require_once ("../Modele/ChatModele.php");
    require_once ("../Vue/MessagesVue.php");
    if (($message = ChatModele::getDernierMessage()) != false) {
	if ($message[0] == 'messInfo') {
	    MessagesVue::info($message[1], $message[2]);
	} else {
	    MessagesVue::display($message[0], $message[1], $message[2], $message[3], $message[4]);
	}
    }
}

function recupererConnectes() {
    require_once ("../Modele/ChatModele.php");
    require_once ("../Vue/ConnectesVue.php");
    $message = ChatModele::getConnectes();

    ConnectesVue::display($message, User::getGrade());
}

function envoiMessage($mess) {
    require_once ("../Modele/EnvoiModele.php");
    require_once ("../Vue/EnvoiVue.php");

    if (($message = EnvoiModele::verif($mess)) != false) {
	if (isset($message[2])) {
	    EnvoiModele::sendMessage($message[0], $message[1]);
	    EnvoiVue::display($message[0], $message[2], $message[3]);
	} else {
	    EnvoiVue::info($message[0], $message[1]);
	}
    }
}

if (isset($_POST['chatMessage']) && !empty($_POST['chatMessage'])) {
    envoiMessage($_POST['chatMessage']);
} else if (isset($_POST['messages']) && $_POST['messages'] == 1) {
    recupererMessages();
} else if (isset($_POST['connectes']) && $_POST['connectes'] == 1) {
    recupererConnectes();
}
