<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class EchangeControleur extends ControleurGenerique {

    function affFormulaire() {
		require_once ("Modules/Echanges/Vue/EchangeVue.php");
		require_once ("Modules/Echanges/Modele/EchangeModele.php");
		$users = EchangeModel::getUsers();
		$echange = EchangeModel::getEchange(User::$idCompte);
		$this->constructView("EchangeVue", "affFormulaire", array($users,$echange));
    }
	function confirm() {
		if(empty($_POST['pseudo_dest'])){
			Error::erreur("Veuillez entrer un pseudo correct dans le champ adapté");
			return false;
		}
		if(empty($_POST['type'])){
			Error::erreur("Veuillez choisir entre l'achat ou la ventes de ressources");
			return false;
		}
		if(empty($_POST['ressources'])){
			Error::erreur("Veuillez choisir la ressource à échanger");
			return false;
		}
		if(empty($_POST['qte'])){
			Error::erreur("Veuillez entrer une quantitée de ressource à échanger");
			return false;
		}		
		require_once ("Modules/Echanges/Modele/EchangeModele.php");
		if(!EchangeModel::isPseudo(htmlentities($_POST['pseudo_dest']))){
			Error::erreur("Le nom de ce joueur n'existe pas");
			return false;
		}
		$dest = EchangeModel::getDest(htmlentities($_POST['pseudo_dest']));
		if($dest === FALSE){
			Error::erreur("Plus d'une personne porte un nom similaire veuillez entrer le nom entier");
			return false;
		}
		EchangeModel::newEchange($dest,User::$idCompte,$_POST['type'],$_POST['ressources'],$_POST['qte']);
		Confirm::display("Vôtre échange à bien été pris en compte, en attente de la réponse du destinataire.");
		require_once ("Modules/Echanges/Vue/EchangeVue.php");
		$this->affFormulaire();
		return true;

			
	}
	function choose(){
		require_once ("Modules/Echanges/Modele/EchangeModele.php");
		if(!EchangeModel::isEchangeOf($_POST['idEchange'],User::$idCompte)){
			Error::erreur("Cet échange ne vous appartiens pas ou n'existe plus");
			return false;
		}
		if($_POST['choose']=="Accepter"){
			Confirm::display("Module en cours de création :/");
		}else{
			Confirm::display("Vous avez Reffusé l'échange");
			EchangeModel::deleteEchange($_POST['idEchange']);
		}
		require_once ("Modules/Echanges/Vue/EchangeVue.php");
		$this->affFormulaire();
		return true;
	}

}
