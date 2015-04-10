<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class AdminPanel extends ModuleGenerique {

    private $pathCtrl = "Modules/AdminPanel/Controleur/";

    function __construct() {
	/*if (User::isAdmin()) {
*/
	    $this->titre = "Admin panel";
	    $action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';

	    switch ($action) {
		case "ban":
		    require_once $this->pathCtrl . 'ControleurBans.php';
		    $this->controleur = new ControleurBans();
		    $this->controleur->banJoueur();
		    break;
		case "banconf":
		    require_once $this->pathCtrl . 'ControleurBans.php';
		    $this->controleur = new ControleurBans();
		    $this->controleur->banConf();
		    break;
		case "listebans":
		    require_once $this->pathCtrl . 'ControleurBans.php';
		    $this->controleur = new ControleurBans();
		    $this->controleur->display_bans();
		    break;
		case "unban":
		    require_once $this->pathCtrl . 'ControleurBans.php';
		    $this->controleur = new ControleurBans();
		    $this->controleur->unban();
		    break;
		case "grade":
		    require_once $this->pathCtrl . "ControleurGrades.php";
		    $this->controleur = new ControleurGrades();
		    $this->controleur->display_formGrades();
		    break;
		case "ville":
		    require_once $this->pathCtrl . "ControleurVille.php";
		    $this->controleur = new ControleurVille();
		    $this->controleur->display_ville();
		    break;
		case "achats":
		    require_once $this->pathCtrl . "ControleurHistorique.php";
		    $this->controleur = new ControleurHistorique();
		    $this->controleur->display_historique();
		    break;
		default:
		    require_once $this->pathCtrl . "ControleurListeJoueurs.php";
		    $this->controleur = new ControleurListeJoueurs();
		    $this->controleur->display_Joueurs();
		    break;
	    /*}
	} else
	    Error::noPermission("acceder au panel administrateur", "administrateur");
    */}
}
}
