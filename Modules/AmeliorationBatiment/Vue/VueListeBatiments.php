<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueListeBatiments {

    static function display_BatList($idVille) {
	require_once ("Modules/AmeliorationBatiment/Modele/ListeBatiments.php");
	require_once ("Modules/Ressources/Modele/AccesRessources.php");
	require_once ("Modules/AmeliorationBatiment/Modele/Batiment.php");

	$list = ListeBatiments::getListeBat($idVille);
	$argent = AccesRessources::getArgentPop($idVille)[0];
	$aUnResultat = FALSE;
	?>

	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Amélioration d'un batiment - vue des batiments</h2>
		<div class='ContenuSite'>
		    <table align="center">
			<tr>
			    <th>TYPE</th>
			    <th>NIVEAU</th>
			    <th>PRIX AMEL.</th>
			</tr>
			<?php
			while ($current = $list->fetch()) {
			    if (!$aUnResultat)
				$aUnResultat = TRUE;
			    $prix = Batiment::getPrix($current['idBat']);
			    $prixDemo = Batiment::getPrixDemo($prix);
			    echo "<tr>";

			    echo '<td>' . $current['nom'] . "</td>";
			    echo "<td>" . $current['lvlBat'] . "</td>";
			    echo "<td>$$prix</td>";

			    //Affiche lien si le joueur a assez d'argent
			    if ($prix < $argent)
				echo '<td> <a href="index.php?module=amelbat&action=amelioration&idbat=' . $current['idBat'] . '">Ameliorer</a></td>';
			    else
				echo '<td> Pas assez d\'argent pour amelioration ($' . $prix . '). </td>';
			    if ($prixDemo < $argent)
				echo '<td><a href="index.php?module=amelbat&action=demo&idbat=' . $current['idBat'] . '" >Démolir($' . $prixDemo . ')</td>';
			    else
				echo "<td>Vous n'avez pas les moyens pour démolir ce batiment</td>";
			    echo '</tr>';
			}

			if (!$aUnResultat)
			    echo "<td>Pas de Batiment.</td>";
			?>
		    </table>
		</div>
	    </div>
	</div>
	<?php
    }

}
