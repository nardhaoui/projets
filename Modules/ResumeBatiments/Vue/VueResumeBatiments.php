<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueResumeBatiments {

    static function display_resumeBatiments($typoBats, $posX = '', $posY = '') {
	$typoVide = TRUE;
	?>
	<div id='SumBatiments'>
	    <!-- class SUM BATIMENTS -->
	    <div class="SumBatiments PartieSite">
		<h2>Resumé des batiments</h2>
		<div class='ContenuSite'>
		    <?php
		    while ($res = $typoBats->fetch()) {
			$typoVide = FALSE;
			?>
	    	    <div class='SumBat'>
	    		<img src='<?php echo $res['image']; ?>' alt='thumbnail <?php echo $res['nom']; ?>' title='thumbnail <?php echo $res['nom']; ?>'/>
	    		<h3> <?php echo $res['nom']; ?> </h3>
	    		<div class='batMiddle'>
	    		    <p> <?php echo $res['resume']; ?> </p>
	    		</div>
	    		<div class='batRight'>
	    		    <h4>Production</h4>
	    		    <ul>
	    			<li class='liArgent'>Argent : <span><?php echo $res['productionArgent']; ?></span></li>
	    			<li class='liEau'>Eau : <span><?php echo $res['productionEau']; ?></span></li>
	    			<li class='liElec'>Electricite : <span><?php echo $res['productionElectricite']; ?></span></li>
	    		    </ul>
	    		</div>

	    		<form method="POST" action="index.php?module=creabatiment&action=confirm" class="formResume">
	    		    <input type="hidden" name="typoBat" value="<?php echo $res['nom']; ?>"/>
	    		    <input type='number' placeholder="X" name='posX' value="<?php echo $posX; ?>" required/>
	    		    <input type='number' placeholder="Y" name='posY' value="<?php echo $posY; ?>" required/>
				<?php
				if (User::getArgent() < $res['prix'])
				    echo "<a href='#SumBatiments' onclick='alert(\"Tu es trop pauvre !\");' class='creaBat'>Créer " . $res['nom'] . "    <span class='prix pauvre";
				else
				    echo "<input type='submit' value='Créer " . $res['nom'] . "' class='creaBat'/><span class='prix riche";
				?>
	    		    '>$ <?php echo $res['prix'] ?></span></a>
	    		</form>
	    		<span class='arrangeur'></span>
	    	    </div>
			<?php
		    }
		    if ($typoVide) {
			?>
	    	    <p>Aucun type de batiments.</p>
			<?php
		    }
		    ?>
		</div>
	    </div>
	    <!-- FIN class SUM BATIMENTS -->
	</div>
	<!-- FIN id SUM BATIMENTS -->
	<?php
    }

    static function display_batiment($bat) {
	$typoVide = TRUE;
	?>
	<div id='SumBatiments'>
	    <!-- class SUM BATIMENTS -->
	    <div class="SumBatiments PartieSite">
		<h2>Resumé des batiments</h2>
		<div class='ContenuSite'>
		    <?php
		    while ($res = $bat->fetch()) {
			$typoVide = FALSE;
			echo "<div class='SumBat'>";
			echo "<img src='" . $res['image'] . "' alt='thumbnail " . $res['nom'] . "' title='thumbnail " . $res['nom'] . "'/>";
			echo "<h3>" . $res['nom'] . "</h3>";
			echo "<p>";
			echo $res['resume'];
			echo "</p>";
			echo "<h4>Production</h4>";
			echo "<ul>";
			echo "<li>Argent : " . $res['productionArgent'] . "</li>";
			echo "<li>Eau : " . $res['productionEau'] . "</li>";
			echo "<li>Electricite : " . $res['productionElectricite'] . "</li>";
			echo "</ul>";
			echo "<span class='arrangeur'></span>";
			echo "</div>";
		    }
		    if ($typoVide) {
			?>
	    	    <p>Aucun batiment de ce type.</p>
			<?php
		    }
		    ?>
		</div>
	    </div>
	    <!-- FIN class SUM BATIMENTS -->
	</div>
	<!-- FIN id SUM BATIMENTS -->


	<?php
    }

}
