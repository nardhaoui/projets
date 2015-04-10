<?php
if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class VueBans {

    static function display_listeBans($bans) {
	require_once "Modules/AdminPanel/Vue/VueListeJoueurs.php";

	VueListeJoueurs::display_menu();
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Bans</h2>
		<div class='ContenuSite'>
		    <table border="solid" align="center">
			<tr>
			    <th>ID</th>
			    <th>ID COMPTE</th>
			    <th>PSEUDO</th>
			    <th>TYPE</th>
			    <th>DATE DEBUT</th>
			    <th>DATE FIN</th>
			    <th>MOTIF</th>
			    <th>ACTION</th>
			</tr>
			<?php
			while ($res = $bans->fetch()) {
			    ?>
	    		<tr>
	    		    <td><?php echo $res['id']; ?></td>
	    		    <td><?php echo $res['idCompte']; ?></td>
	    		    <td><?php echo $res['pseudo']; ?></td>
	    		    <td><?php echo $res['type']; ?></td>
	    		    <td><?php echo $res['dateDebut']; ?></td>
	    		    <td><?php echo $res['dateFin']; ?></td>
	    		    <td><?php echo $res['motif']; ?></td>
	    		    <td><a href="index.php?module=adminpan&action=unban&id=<?php echo $res['id']; ?>">Supprimer</a></td>
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

    static function display_formBan($joueur) {
	require_once "Modules/AdminPanel/Vue/VueListeJoueurs.php";
	VueListeJoueurs::display_menu();
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Je bannis <?php echo $joueur['pseudo']; ?></h2>
		<div class='ContenuSite'>
		    <form method="post" action="index.php?module=adminpan&action=banconf">

			<label for="dateFin" >Date fin ban</label>
			<input type="date" name="dateFin" placeholder="AAAA-MM-JJ"/>

			<label for="motif" title="Si c'est un admin vite avant qu'il ne te ban!">Motif</label>
			<input type="" name="motif" placeholder="Soyez créatif"/>

			<input type="submit" value="Bannir <?php echo $joueur['pseudo']; ?>" />

			<input type="hidden" name="idCompte" value=<?php echo $joueur['idCompte']; ?> /> <br />

			<p>Vous avez changé d'avis ? <a href="index.php?module=adminpan">Je retourne à la liste des joueurs.</a></p>
		    </form>
		</div>
	    </div>
	</div>
	<?php
    }

}
