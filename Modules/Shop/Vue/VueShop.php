<?php
class VueShop {
	
	static function display_menu(){
		?>
		<div id='SumBatiments'>
			<div class="SumBatiments PartieSite">
			<h2>Shop</h2>
				<div class='ContenuSite'>
					<h3>Acheter de l'argent</h3>
					<ul>
						<li>
							<a href="index.php?module=shop&action=buy">$5000000 -> 15€</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
	
	static function display_confirmation(){
		?>
		<div id='SumBatiments'>
			<div class="SumBatiments PartieSite">
			<h2>Shop</h2>
				<div class='ContenuSite'>
					<h3>Êtes-vous sur de vouloir acheter $5 000 000 pour 15€ ?</h3>
					<p>
						<a href="index.php?module=shop&action=buy&conf=1">Oui</a>
						-
						<a href="index.html" >Retour à l'accueil</a>
					</p>
				</div>
			</div>
		</div>
		<?php
	
	}

} 
