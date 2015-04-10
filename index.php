<?php
error_reporting(0);
ini_set("display_errors", 1);

define('SECURE', NULL);

require_once ("include_generique.php");
require_once 'utils/include.php';

session_start();

/*Debug::init();
*/
//Connexion à la BD
try {
    $connexion = new PDO($dns, $user, $password);
    DBMapper::init($connexion);
} catch (Exception $e) {
    echo "La connexion à la base de données a échouée<br/>" . $e->getMessage();
}

//Protection $_GET pour module
$module = isset($_GET['module']) ? $_GET['module'] : 'DEFAULT';
//Cas de deconnexion
if ($module == 'deconnexion') {
    User::deconnexion();
    Confirm::display("Vous êtes maintenant déconnecté");
} else
    User::init();
//Cas ban
if (User::isBanned())
    User::deconnexion();

$userConnected = User::isConnected();

//Affiche elements de connexion/inscription si l'utilisateur n'est pas connecté.
if (!$userConnected && $module != 'inscription' && $module != 'connexion')
    $module = 'connexion';

//Test Admin
/*if ($module == 'adminpan' && !User::isAdmin())
    $module = 'DEFAULT';*/

switch ($module) {
    case "creabatiment":
	require_once ("Modules/CreaBatiment/CreaBatiment.php");
	$moduleObjet = new CreaBatiment();
	break;
    case "amelbat" :
	require_once 'Modules/AmeliorationBatiment/AmeliorationBatiment.php';
	$moduleObjet = new AmeliorationBatiment();
	break;
    case "inscription":
	require_once ("Modules/Inscription/inscription.php");
	$moduleObjet = new Inscription();
	break;
    case "connexion":
	require_once ("Modules/Connexion/connexion.php");
	$moduleObjet = new Connexion();
	break;
    case "resumebat":
	require_once "Modules/ResumeBatiments/ResumeBatiments.php";
	$moduleObjet = new ResumeBatiments();
	break;
    case "gestcompte":
	require_once "Modules/GestionCompte/GestionCompte.php";
	$moduleObjet = new GestionCompte();
	break;
    case "adminpan":
	require_once "Modules/AdminPanel/AdminPanel.php";
	$moduleObjet = new AdminPanel();
	break;
    case "shop":
	require_once "Modules/Shop/Shop.php";
	$moduleObjet = new Shop();
	break;
    case "echange":
	require_once "Modules/Echanges/Echange.php";
	$moduleObjet = new Echange();
	break;
    case "DEFAULT":
	require_once ("Modules/Accueil/Accueil.php");
	$moduleObjet = new Accueil();
	break;
    default:
	require_once ("Modules/Accueil/Accueil.php");
	$moduleObjet = new Accueil();
	break;
}
$titre = $moduleObjet->isTitreSet() ? $moduleObjet->getTitre() : 'Accueil';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8"/> 
		<link rel="icon" type="img/png" href="images/iconOcity.png" />

		<link href="Styles/style.css" rel="stylesheet" type="text/css">
		<link href="Styles/form.css" rel="stylesheet" type="text/css">
		<link href="Styles/autre.css" rel="stylesheet" type="text/css">
		<link href="Styles/ads.css" rel="stylesheet" type="text/css">
		
		<script src='script.js' type="text/javascript"></script>

		<title>OCity :: <?php echo $titre ?></title>
    </head>

    <body onscroll="snowScroll();">
        <div id='background'>
            <div id="snow">
                <div id="snowBig">
		    <?php
		    //HEADER
		    require_once 'Modules/Header/Header.php';
		    $headerModule = new Header();
		    $headerModule->display();
		    ?>

                    <!--CONTENT-->
                    <div id='content'>

			<?php if (!$userConnected || !User::isAdmin()) { ?>
    			<div class="pupub">
    			    <div class="Pub PartieSite">
    				<h2>Pub du swagg</h2>	
    				<div class='ContenuSite'>
    				    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    				    <!-- Pub #SWAGG -->
    				    <ins class="adsbygoogle"
    					 style="display:inline-block;width:728px;height:90px"
    					 data-ad-client="ca-pub-9789886110773654"
    					 data-ad-slot="4639812122"></ins>
    				    <script>
    					(adsbygoogle = window.adsbygoogle || []).push({});
    				    </script>
    				    <div class="adblock">
    					<p>
    					    Si vous voyez ce texte, cela veut dire que vous utilisez un bloqueur de publicité (AdBlock, ...).<br/>
    					    <br/>
    					    L'accès à ce jeu sur navigateur ainsi que son contenu sont entièrement gratuits, le joueur n'est jamais solicité pour une quelconque participation financière.<br/>
    					    <br/>
    					    Nous sommes une équipe de développement étudiante. Les publicités de ce site web sont actuellement notre seule et unique source de revenu.<br/>
    					    Les publicités sont affichées de sorte à ne pas être intrusives et sont correctement intégrées au design du site.<br/>
    					    Si vous trouvez nos publicités gênantes, contactez-nous via les liens de bas de page.<br/>
    					    <br/>
    					    Alors s'il vous plaît, au nom de l'ensemble de l'équipe de développement de OCity, <b>désactivez votre bloqueur de publicité pour OCity !</b><br/>
    					    Un petit geste pour un grand merci ;)
    					</p>
    				    </div>
    				</div>
    			    </div>
    			</div>
			<?php } ?>

			<?php
			$moduleObjet->display();

			//Afiche l'aside que si l'utilisateur est connecté.
			if ($userConnected && $module != "connexion" && $module != "gestcompte" && $module != "adminpan") {
			    require_once 'Modules/Aside/Aside.php';
			    $asideObjet = new Aside();
			    $asideObjet->display();
			    if ($module == 'DEFAULT') {
				require_once 'Modules/ResumeBatiments/ResumeBatiments.php';
				$resumeObjet = new ResumeBatiments();
				$resumeObjet->display();
			    }
			}
			?>

			<?php if (!$userConnected || !User::isAdmin()) { ?>
    			<div class="pupub">
    			    <div class="Pub PartieSite">
    				<h2>Pub du swagg</h2>	
    				<div class='ContenuSite'>
    				    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    				    <!-- Pub #SWAGG -->
    				    <ins class="adsbygoogle"
    					 style="display:inline-block;width:728px;height:90px"
    					 data-ad-client="ca-pub-9789886110773654"
    					 data-ad-slot="4639812122"></ins>
    				    <script>
    					(adsbygoogle = window.adsbygoogle || []).push({});
    				    </script>
    				    <div class="adblock">
    					<p>
    					    Si vous voyez ce texte, cela veut dire que vous utilisez un bloqueur de publicité (AdBlock, ...).<br/>
    					    <br/>
    					    L'accès à ce jeu sur navigateur ainsi que son contenu sont entièrement gratuits, le joueur n'est jamais solicité pour une quelconque participation financière.<br/>
    					    <br/>
    					    Nous sommes une équipe de développement étudiante. Les publicités de ce site web sont actuellement notre seule et unique source de revenu.<br/>
    					    Les publicités sont affichées de sorte à ne pas être intrusives et sont correctement intégrées au design du site.<br/>
    					    Si vous trouvez nos publicités gênantes, contactez-nous via les liens de bas de page.<br/>
    					    <br/>
    					    Alors s'il vous plaît, au nom de l'ensemble de l'équipe de développement de OCity, <b>désactivez votre bloqueur de publicité pour OCity !</b><br/>
    					    Un petit geste pour un grand merci ;)
    					</p>
    				    </div>
    				</div>
    			    </div>
    			</div>
			<?php } ?>

                    </div>
                    <!--END CONTENT-->

                    <!--FOOTER-->
                    <footer>
                        <div id='footer' class='PartieSite'>
                            <h2>A propos</h2>	
                            <div class='ContenuSite'>
                                <p>&copy; <a href="mailto:nardhaoui@iut.univ-paris8.fr" title="nardhaoui@iut.univ-paris8.fr">Ardhaoui Nidhal</a> - <a href="mailto:agaspardcilia@iut.univ-paris8.fr" title="agaspardcilia@iut.univ-paris8.fr">Alexandre GASPARD CILIA</a> - <a href="mailto:rhaddad@iut.univ-paris8.fr" title="rhaddad@iut.univ-paris8.fr">Richard HADDAD</a></p><br/>
                                <p>2014</p><br/>
                                <br/>
                                <p>Ce site a été conçu pour le navigateur Mozilla Firefox. <b>L'emploi d'un autre navigateur risque de rendre la navigation du site désagréable.</b></p><br/>
                                <br/>
                                <p>Ce site a été conçu pour un projet étudiant (DUT 2<sup>nd</sup> année)</p><br/>
                                <br/>
                                <p>Vous souhaitez donner votre avis, ou simplement laisser un mot ? <b>Contactez-nous en cliquant sur nos noms !</b></p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>




