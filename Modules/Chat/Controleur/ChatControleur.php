<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ChatControleur extends ControleurGenerique {

    function defaultFunc() {
	require_once ("Modules/Chat/Vue/ChatVue.php");
	require_once ("Modules/Chat/Modele/ChatModele.php");

	ChatModele::setDernierActu();

	$connectes = ChatModele::getConnectes();
	$messages = ChatModele::getMessages();

	$this->constructView("ChatVue", "display", array($messages, $connectes, User::getGrade()));
    }

}
