<?php

class ControleurBuy extends ControleurGenerique {
	private $path = "Modules/Shop/";
	
	function display_request() {
		require_once ($this->path . "Vue/VueShop.php");
		$conf = isset($_GET['conf']) ? $_GET['conf'] : 0;

		if($conf == 1){
			require_once ($this->path . "Modele/ModeleShop.php");
			
			ModeleShop::addHistorique(5000000, 15);
			ModeleShop::addMoney(5000000);
			
			$this->constructView("VueShop", "display_menu", array(NULL));
			Confirm::display("Votre achat a bien été effectué.");
		}
		else
			$this->constructView("VueShop", "display_confirmation", array(NULL));
		
	}

}
