<?php
if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class VueHistorique {

    static function display_historique($hist) {
	$totalArgent = 0;
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Historique d'achat(s)</h2>
		<div class='ContenuSite'>
		    <table border="solid 1px">
			<tr>
			    <th>ID TRANSACTION</th>
			    <th>DATE</th>
			    <th>VALEUR JEU</th>
			    <th>VALEUR RÉEL</th>
			</tr>
			<?php
			while ($current = $hist->fetch()) {
			    ?>
	    		<tr>
	    		    <td><?php echo $current['idTransaction']; ?></td>
	    		    <td><?php echo $current['date']; ?></td>
	    		    <td>$<?php echo $current['valeurJeu']; ?></td>
	    		    <td><?php echo $current['valeurReel']; ?>€</td>
	    		</tr>
			    <?php
			    $totalArgent += $current['valeurReel'];
			}
			?>
		    </table>

		    <p>Total dépensé : <?php echo $totalArgent; ?>€</p>
		    <br />
		    <a href="index.php?module=adminpan">Retour</a>
		</div>
	    </div>
	</div>

	<?php
    }

}
