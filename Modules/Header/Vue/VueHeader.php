<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class VueHeader {

    static function display_connecte($pseudo = NULL, $nomVille = NULL, $header, $admin = false) {
	?>
	<!--HEADER-->
	<header>
	    <div id='header'>
		<a href='index.php'><img src="images/logoOcity.png" alt="logo" title="Logo"/></a>
		<!--NAV-->
		<nav>
		    <a <?php if ($header === 'jeu') echo "class='select'"; ?> href='index.php'>Jeu</a>
		    <?php
		    if ($pseudo == NULL) {
			?>
	    	    <a <?php if ($header === 'inscription') echo "class='select'"; ?> href="index.php?module=inscription">M'inscrire</a>
	    	    <a href="index.php?module=connexion" class="con <?php if ($header === 'connexion') echo "select"; ?>">Me connecter</a>
	    	    <p class="noCon">Je ne suis pas connecté</p>
			<?php
		    } else {
			?>
	    	    <a <?php if ($header === 'compte') echo "class='select'"; ?> href="index.php?module=gestcompte">Mon compte</a>
	    	    <a href="index.php?module=deconnexion" class="decon">Me déconnecter</a>
			<?php
			if ($admin) {
			    echo '<a href="index.php?module=adminpan" class="';
			    if ($header === 'adminpan')
				echo 'select';
			    echo ' ban">Administration</a>';
			}
			?>
	    	    <p><?php echo "<span class='pseudo'>" . $pseudo . "</span> maire de <span class='ville'>" . $nomVille . "</span>"; ?></p>
	    <?php
	}
	?>
		</nav>
	    </div>
	</header>
	<!--END HEADER-->
	<?php
    }

}
