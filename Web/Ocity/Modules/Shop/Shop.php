<?php
class Shop extends ModuleGenerique {
	private $path = "Modules/Shop/";
	
	function __construct(){
		$action = isset($_GET['action']) ? $_GET['action'] : 'DEFAULT';
		
		switch($action){
			case "buy":
				require_once $this->path . 'Controleur/ControleurBuy.php';
				$this->controleur = new ControleurBuy();
				$this->controleur->display_request();
				break;
			default:
				require_once $this->path . 'Controleur/ControleurDefault.php';
				$this->controleur = new ControleurDefault();
				$this->controleur->display_menu();
				break;
		}
	}


}
	
