<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueInfosBat {
    /* Affiche les informations d'un batiment ainsi que les liens vers les amélioration et destruction
     * 	$bat
     * 		Batiment a afficher en objet pdo fetché
     * 	$prod
     * 		La production du batiment sous forme d'un tableau array(argent, eau, elec)
     * 	$prixAction
     * 		Prix des differentes actions
     */

    static function display_infosBat($bat, $prod, $prixAction) {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Résumé du batiment</h2>
		<div class='ContenuSite'>
		    <div class='SumBat'>
			<img src='<?php echo $bat['image']; ?>' alt='thumbnail <?php echo $bat['nom']; ?>' title='thumbnail <?php echo $bat['nom']; ?>'/>
			<h3> <?php echo $bat['nom']; ?> niveau <?php echo $bat['lvlBat']; ?></h3>
			<div class='batMiddle'>
			    <p> <?php echo $bat['resume']; ?> </p>
			</div>
			<div class='batRight'>
			    <h4>Production</h4>
			    <ul>
				<li class='liArgent'>Argent : <span><?php echo $prod[0]; ?></span></li>
				<li class='liEau'>Eau : <span><?php echo $prod[1]; ?></span></li>
				<li class='liElec'>Electricite : <span><?php echo $prod[2]; ?></span></li>
			    </ul>
			</div>
			<div class="modifBat">
			    <a href="index.php?module=amelbat&action=amelioration&idbat=<?php echo $bat['idBat']; ?>&ret=infos">Ameliorer<?php echo "($" . $prixAction[0] . ")"; ?></a>
			    <a href="index.php?module=amelbat&action=demo&idbat=<?php echo $bat['idBat']; ?>" id="detruire">Detruire<?php echo "($" . $prixAction[1] . ")"; ?></a>
			</div>
			<span class='arrangeur'></span>
		    </div>
		</div>
	    </div>
	</div>
	<?php
    }

}
