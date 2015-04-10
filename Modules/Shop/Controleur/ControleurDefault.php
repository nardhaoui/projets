<?php

class ControleurDefault extends ControleurGenerique {
	private $path = "Modules/Shop/";
	
	function display_menu() {
		require_once ($this->path . "Vue/VueShop.php");
		
		$this->constructView("VueShop", "display_menu", array(NULL));
	}

}
