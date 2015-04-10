<?php
if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
	    . 'Non mais oh !');
}

class VueAside {

    static function display_aside($moduleRessources) {
	require_once 'Modules/Ressources/Ressources.php';
	?>
	<aside>
	    <div id='aside'>
		<div class="NavLeft PartieSite">
		    <h2>Modifications</h2> 
		    <div class='ContenuSite' >
			<div class='Links' > 
			    <a href="index.php?module=creabatiment" class='color1'>Créer Batiment</a>   
			    <a href="index.php?module=amelbat" class='color2'>Gestion Batiments</a>
			    <br/>  
			    <a href="index.php?module=shop" class='color3'>Shop</a>
			    <a href="index.php?module=echange" class='color4'>&Eacute;changes</a>
			</div>
		    </div>
		</div>

		<?php
		$moduleRessources->display();
		?>  

	    </div>
	</aside>

	<?php
    }

}
