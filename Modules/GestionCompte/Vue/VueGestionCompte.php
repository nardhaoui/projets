<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueGestionCompte {

    static function display_infoUser($infos, $codeNotice = 0) {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Je gère mon compte</h2>
		<div class='ContenuSite'>
		    <form method="post" action="index.php?module=gestcompte&action=mdp">
			<label for="passe">Mon pseudo</label>
			<input type="text" name="pseudo" id="passe" placeholder="<?php echo $infos[0]; ?>" disabled /><br/>
			<label for="passe">Mon email</label>
			<input type="text" name="email" id="passe" placeholder="<?php echo $infos[1]; ?>" disabled /><br/>
			<label for="passe">Mon mot de passe actuel</label>
			<input type="password" name="passe" id="passe" placeholder="L'ancien mot de passe" /><br/>
			<label for="Newpasse">Le nouveau mot de passe</label>
			<input type="password" name="Newpasse" id="passe" placeholder="Le nouveau mot de passe" /><br/>
			<label for="Confpasse"></label>
			<input type="password" name="Confpasse" id="passe" placeholder="Encore une fois..." /><br/>
			<input type="submit" value="Je change de mot de passe" /><br/>
		    </form>
		</div>
	    </div>
	</div>
	<?php
	switch ($codeNotice) {
	    case 1:
		Error::erreur("L'ancien mot de passe n'est pas correct");
		break;
	    case 2:
		Confirm::display("Votre mot de passe a été remplacé");
		break;
	    case 3:
		Error::erreur("Les deux champs du nouveau mot de passe ne sont pas les mêmes");
		break;
	    case 4:
		Error::erreur("Tout les champs ne sont pas remplis");
		break;
	}
    }

}
