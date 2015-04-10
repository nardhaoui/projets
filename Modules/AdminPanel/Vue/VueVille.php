<?php
if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class VueVille {

    static function display_ville($ville, $bats) {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2><?php echo $ville['nom']; ?></h2>
		<div class='ContenuSite'>
		    <ul>
			<li>Argent : <?php echo $ville['argent']; ?></li>
			<li>Population : <?php echo $ville['population']; ?></li>
			<li>Date de création : <?php echo $ville['dateCreation']; ?></li>
			<li>Dernier refresh : <?php echo $ville['dernierRefresh']; ?></li>
		    </ul>

		    <h3>Liste des batiments</h3>

		    <table border="solid 1px" align="center">
			<th>ID</th>
			<th>TYPE</th>
			<th>LVL</th>

			<?php
			while ($current = $bats->fetch()) {
			    ?>
	    		<tr>
	    		    <td><?php echo $current['idBat']; ?></td>
	    		    <td><img src="<?php echo $current['image']; ?>" width="50px" height="25px" /></td>
	    		    <td><?php echo $current['lvlBat']; ?></td>
	    		</tr>
			    <?php
			}
			?>
		    </table>
		</div>
	    </div>
	</div>
	<?php
    }

    static function display_error() {
	?>
	<p>Problème avec l'id de la ville.</p>
	<?php
    }

}
?>
