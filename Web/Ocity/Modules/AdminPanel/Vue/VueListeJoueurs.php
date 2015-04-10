<?php
if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class VueListeJoueurs {

    static function display_menu() {
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Menu d'administration</h2>
		<div class='ContenuSite'>
		    <h3 align="center"><a href="index.php?module=adminpan">Afficher joueurs</a> - <a href="index.php?module=adminpan&action=listebans">Afficher les bans</a></h3>
		</div>
	    </div>
	</div>
	<?php
    }

    static function display_listeJoueurs($joueurs) {
	self::display_menu();
	$i = 0;
	?>
	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
		<h2>Joueurs</h2>
		<div class='ContenuSite'>
		    <table border="solid" align="center">
			<tr>
			    <th>ID</th>
			    <th>PSEUDO</th>
			    <th>EMAIL</th>
			    <th>GRADE</th>
			    <th>ACTION</th>
			</tr>
			<?php
			while ($res = $joueurs->fetch()) {
			    ?>
	    		<tr <?php if ($i % 2 == 0) echo "class=PariteTableau"; ?>>
	    		    <td><?php echo $res['idCompte']; ?></td>
	    		    <td><?php echo $res['pseudo']; ?></td>
	    		    <td><?php echo $res['email']; ?></td>
	    		    <td style="color:#<?php echo $res['couleur']; ?>"><?php echo $res['nom']; ?></td>
	    		    <td>
	    			<a href="index.php?module=adminpan&action=ban&id=<?php echo $res['idCompte']; ?>">Bannir</a>
	    			/
	    			<a href="index.php?module=adminpan&action=grade&id=<?php echo $res['idCompte']; ?>" >Mod. grade</a>
	    			/
	    			<a href="index.php?module=adminpan&action=ville&id=<?php echo $res['idVille']; ?>">Voir ville</a>	
	    			/
	    			<a href="index.php?module=adminpan&action=achats&id=<?php echo $res['idCompte']; ?>">Historique d'achat</a>	
	    		    </td>
	    		</tr>
			    <?php
			    $i++;
			}
			?>
		    </table>
		</div>
	    </div>
	</div>
	<?php
    }

}
