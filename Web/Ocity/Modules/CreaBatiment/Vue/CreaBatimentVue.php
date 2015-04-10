<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class CreaBatimentVue {

    static function affDemande($listeTypoBat, $bat, $posX = '', $posY = '') {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Création d'un batiment</h2>
		<div class='ContenuSite'>

		    <form method="POST" action="index.php?module=creabatiment&action=confirm">
			<label for="typoBat">Batiment</label>
			<select name='typoBat' required>
			    <?php
			    for ($i = 0; $i < count($listeTypoBat); $i++) {
				?>
	    		    <option <?php if ($bat == $listeTypoBat[$i]) echo 'selected'; ?> ><?php echo $listeTypoBat[$i] ?></option>
				<?php
			    }
			    ?>
			</select><br/>
			<label for="posX">Position X</label>
			<input type='number' placeholder="Position 1 - 6" name='posX' value="<?php echo $posX; ?>" required/><br/>
			<label for="posY">Position Y</label>
			<input type='number' placeholder="Position 1 - 12" name='posY' value="<?php echo $posY; ?>" required/><br/>
			<input type='submit' value='Je créé ce batiment' />
		    </form>

		</div>
	    </div>
	</div>

	<?php
    }

}
