<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class vueRessources {

    /**
     * 	Permet d'afficher les ressources displonnibles au joueur.
     * 	$res = array(Argent, Elec, Eau, Popul, PopMax)
     */
    static function display_Ressources($res) {
	$res[0] = VueRessources::reformate($res[0]);
	$res[1] = VueRessources::reformate($res[1]);
	$res[2] = VueRessources::reformate($res[2]);
	$res[3] = VueRessources::reformate($res[3]);
	$res[4] = VueRessources::reformate($res[4]);
	?>
	<!--RESSOURCES-->
	<div class="Ressources PartieSite">
	    <h2>Ressources</h2>	
	    <div class='ContenuSite'>
		<div class='MiniRess'>
		    <img src="images/ressources/argent.png" alt="Argent" title="Argent"/>
		    <p>
			<?php echo $res[0]; ?>
		    </p>
		</div>
		<div class='MiniRess'>
		    <img src="images/ressources/elec.png" alt="Electricité" title="Electricité"/>
		    <p>
			<?php echo $res[1]; ?>
		    </p>
		</div>
		<div class='MiniRess'>
		    <img src="images/ressources/eau.png" alt="Eau" title="Eau"/>
		    <p>
			<?php echo $res[2]; ?>
		    </p>
		</div>
		<div class='MiniRess'>
		    <img src="images/ressources/pop.png" alt="Population" title="Population"/>
		    <p>
			<?php echo $res[3] . '/' . $res[4]; ?>
		    </p>
		</div>
	    </div>
	</div>

	<?php
    }

    static private function reformate($value) {
	$lettre = '';
	$coef = 1;

	if ($value >= 1000) {
	    if ($value >= 1000000) {
		$lettre = 'M';
		$coef = 1000000;
	    }
	    $lettre = 'K';
	    $coef = 1000;
	}

	$value /= $coef;
	$value = (int) $value;
	return $value . $lettre;
    }

}
