<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class Chat extends ModuleGenerique {

    function __construct() {

	$action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';

	switch ($action) {
	    default:
		require_once 'Modules/Chat/Controleur/ChatControleur.php';
		$this->controleur = new ChatControleur();
		$this->controleur->defaultFunc();
		break;
	}
    }

}
