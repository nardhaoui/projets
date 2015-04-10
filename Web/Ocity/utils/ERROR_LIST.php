<?php

class Error {

    private static function debut() {
	echo "<div class='erreur' onclick=\"this.style='display:none;'\"><div class='erreurBox' onclick=\"this.style='display:none;'\"><span><p>- Erreur -<br/>";
    }

    private static function fin() {
	echo "</p><br/>Cliquez sur la pop-up pour la faire disparaitre</span></div></div>";
    }

    function AlreadyConnected() {
	self::debut();
	echo "Vous êtes déjà connecté !";
	self::fin();
    }

    function postError($nom) {
	self::debut();
	echo "Veuillez renseignez un " . $nom . " correct";
	self::fin();
    }

    function connexion() {
	self::debut();
	echo "Erreur lors de la connexion";
	self::fin();
    }

    function noPermission($action = "effectuer cette action", $grade = "none") {
	self::debut();
	if ($grade === "none")
	    echo "Vous n'avez pas la permission pour " . $action . ".";
	else
	    echo "Vous devez être " . $grade . " pour " . $action . ".";
	self::fin();
    }

    function noGet($val) {
	self::debut();
	echo "ERREUR: " . $val;
	self::fin();
    }

    function erreur($erreur) {
	self::debut();
	echo $erreur;
	self::fin();
    }

    function regex($regex, $nom) {
	self::debut();
	echo "l" . $nom . " doit comporter: " . $regex;
	self::fin();
    }

    //Redondance avec erreur()
    function notice($str) {
	self::debut();
	echo $str;
	self::fin();
    }

}
