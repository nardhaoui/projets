<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueAccueil {

    static function display_accueil($bats, $ville) {
	require_once 'Modules/Ressources/Ressources.php';
	?>
	<!--INTERFACE DE JEU-->
	<section>
	    <!--Ecran de Jeu-->
	    <div class="EcranDeJeu PartieSite">
		<h2><?php echo $ville; ?></h2>	
		<div class='ContenuSite'>
		    <?php
		    $TAILLEX = 6;    //Nombre de tuile en X
		    $TAILLEY = 12;   //Nombre de tuile en Y

		    $espaceX = 18;
		    $espaceY = 18;

		    $tailleX = 152; // = taille réelle (126+2) + écart entre 2 (13)
		    $tailleY = 88;  // = taille réelle (64) + écart entre 2 (13)

		    $posPrises = array();
		    for ($i = 0; $i < $TAILLEY; $i++) {
			for ($j = 0; $j < $TAILLEX; $j++) {
			    $posPrises[$i][$j] = -1;
			}
		    }

		    // Tuiles batiments
		    foreach ($bats as $cle => $value) {

			// Remplissage tableau position prises, pour après
			$posPrises[$value['positionY']][$value['positionX']] = $value['positionX'];

			// Variables pour la position du batiment
			$X = $espaceX + ($value['positionX'] ) * $tailleX + ($tailleX * ($value['positionY'] % 2)) / 2;
			$Y = $espaceY + ($value['positionY'] ) * ($tailleY / 2);
			$value['positionX'] ++;
			$value['positionY'] ++;
			?>
	    	    <div class="batiments" style="left:<?php echo $X; ?>px;top:<?php echo $Y; ?>px;z-index:<?php echo $Y; ?>;">
	    		<a href="index.php?module=amelbat&action=infosbat&idbat=<?php echo $value['idBat'] ?>">
	    		    <p class="LvlBat"><?php echo $value['lvlBat']; ?></p>
	    		    <img src="<?php echo $value["image"]; ?>" title="<?php echo "batiment" . ($cle + 1) . " pos[" . $value['positionX'] . ":" . $value['positionY'] . "]"; ?>" alt="<?php echo "batiment" . ($cle + 1) . " pos[" . $value['positionX'] . ":" . $value['positionY'] . "]"; ?>"/>
	    		</a>
	    	    </div>
			<?php
		    }

		    // Tuiles vides
		    for ($i = 0; $i < $TAILLEY; $i++) {  // $i = Y
			for ($j = 0; $j < $TAILLEX; $j++) {     // $j = X
			    // Si la position [i][j] n'est pas prise => tuile vide
			    if ($posPrises[$i][$j] == -1) {
				$X = $espaceX + ($j) * $tailleX + ($tailleX * ($i % 2)) / 2;
				$Y = $espaceY + ($i ) * ($tailleY / 2);
				?>
		    	    <div class="batiments" style="left:<?php echo $X; ?>px;top:<?php echo $Y; ?>px;z-index:<?php echo $Y; ?>;">
		    		<a href="index.php?module=resumebat&posx=<?php echo ($j + 1); ?>&posy=<?php echo ($i + 1); ?>">
		    		    <img src="images/sprites/tuile.png" title="<?php echo "Créer un nouveau batiment en [" . ($j + 1) . ":" . ($i + 1) . "]"; ?>"/> 
		    		</a>
		    	    </div>
				<?php
			    }
			}
		    }
		    ?>
		</div>
	    </div>


	</section>

	<?php
    }

}
