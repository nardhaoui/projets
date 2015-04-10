<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class EchangeVue {

    static function affFormulaire($users,$echanges) {
	?>

	<div id='SumBatiments'>
	    <div class="SumBatiments PartieSite">
			<h2>Echanges de ressources</h2>
			<div class='ContenuSite'>
				<form method="post" action="index.php?module=echange&action=confirm">
				<label for="pseudo">Destinataire :</label>
				<input type="text" id="pseudo" placeholder="Pseudo" name="pseudo_dest" list="listpseudo" autocomplete="off" requiered/><br/>
				<datalist id="listpseudo">
					<?php
					foreach ($users as $cle => $value) {
					echo "<option value='" . $value['pseudo'] . "'></option>";
					}
					?>
				</datalist>
				<label for="achat">Achat</label>
				<input type="radio" id="achat" name="type" value="1" />
				<label for="vente">Vente</label>
				<input type="radio" id="vente" name="type" value="2"/>
				<label for="eau">Eau</label>
				<input type="radio" id="eau" name="ressources" value="1"/>
				<label for="elec">Electricitée</label>
				<input type="radio" id="elec" name="ressources" value="2"/>
				<label for="qte">Quantitée a échanger</label>
				<input id="qte" name="qte" type="number" requiered/>
				<input type="submit" value="Echanger"/>
				</form>
			</div>
	    </div>
		</div>
		<?php
		if(count($echanges)>0){
			?>
			<div id='SumBatiments'>
				<div class="SumBatiments PartieSite">
					<h2>Proposition d'échanges</h2>
					<div class='ContenuSite'>
						<?php
							foreach($echanges as $cle => $value){
								?>
								<form method="post" action="index.php?module=echange&action=choose">
									<label><?php echo $value['type']=="1"?"Achat":"Vente"; ?> de <?php echo $value['quantite'];?> d'<?php echo $value['ressource']=="1"?"eau":"électricitée"; ?> proposé par <?php echo $value['pseudo'];?> pour un prix de <?php echo $value['quantite']*10;?>$</label>
									<input type="submit" name="choose" value="Accepter" />
									<input type="submit" name="choose" value="Reffuser" />
									<input type="hidden" name="idEchange" value="<?php echo $value['id']; ?>"/>
								</form>
								<?php
							}
						?>
					</div>
				</div>
			</div>
			<?php 
		}
		?>
	<?php
    }
	
	static function EchangeCorrect(){
		?>
		<div id='SumBatiments'>
			<div class="SumBatiments PartieSite">
				<h2>Echanges de ressources</h2>
				<div class='ContenuSite'>
					Vôtre échange à bien été pris en compte, en attente de la réponse du destinataire.
				</div>
			</div>
		</div>
		<?php
	}

}
