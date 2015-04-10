<?php

class Debug {

    private static $debug;
    private static $arraytexte;

    function init() {
	self::$debug = false;
	self::$arraytexte = array();
    }

    function add($texte) {
	if (self::$debug) {
	    array_push(self::$arraytexte, $texte);
	}
    }

    function display() {
	if (count(self::$arraytexte) > 0) {
	    ?>
	    <!-- DEBUG -->
	    <div id="debug">
		<?php
		foreach (self::$arraytexte as $cle => $value) {
		    print_r($value . "<br/>");
		}
		?>
	    </div>
	    <?php
	}
    }

    function active() {
            //not for now..
	self::$debug = false;
    }

    function desactive() {
	self::$debug = false;
    }

}

class ModuleGenerique {

    protected $titre;
    protected $controleur;

    public function isTitreSet() {
	return isset($this->titre);
    }

    public function getTitre() {
	return $this->titre;
    }

    public function display() {
	$this->controleur->display();
    }

}

class ControleurGenerique {

    protected $classeVue;
    protected $fonctionVue;
    protected $paramsFonctionVue;
    protected $titre;

    public function display() {
	call_user_func_array(array($this->classeVue, $this->fonctionVue), $this->paramsFonctionVue);
    }

    public function constructView($classe, $fonction, $tableauParams) {
	$this->classeVue = $classe;
	$this->fonctionVue = $fonction;
	$this->paramsFonctionVue = $tableauParams;
    }

    public function getTitre() {
	return $this->titre;
    }

}
