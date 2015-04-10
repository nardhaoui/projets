<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ControleurAside extends ControleurGenerique {

    function defaultFunc() {
	require_once 'Modules/Aside/Vue/VueAside.php';
	require_once 'Modules/Ressources/Ressources.php';

	$this->constructView("VueAside", "display_aside", array(new Ressources()));
    }

}
