<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ConnexionVue {

    static function valide($conect) {
	Debug::add($conect['pseudo'] . " " . $_SESSION['user']);
	Confirm::display("Bienvenue " . $_SESSION['user']);
    }

    static function formulaire() {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Je me connecte</h2>
		<div class='ContenuSite'>

		    <!-- Formulaire de connexion -->
		    <form method="post" action="index.php?module=connexion&action=confirm">
			<label for="pseudo">Pseudo ou email</label>
			<input type="text" name="pseudo" id="pseudo" placeholder="Pseudonyme ou email"/><br/>
			<label for="passe">Mot de passe</label>
			<input type="password" name="passe" id="passe" placeholder="Mot de passe"/><br/>
			<input type="submit" value="Je me connecte"/><br/>
			<p>Pas de compte ? <a href="index.php?module=inscription">Je m'inscris</a></p>
		    </form> 
		</div>
	    </div>
	</div>

	</div>
	<?php
    }

}
