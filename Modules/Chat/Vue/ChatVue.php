<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ChatVue {

    static function urllink($content = '') {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a href="$0" target="_blank">$0</a>', $content);
// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if (preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
	    $content = preg_replace('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a href="http://www.$1" target="_blank">www.$1</a>', $content);
	}

	$content = stripslashes($content);
	return $content;
    }

    static function display($messages = '', $connectes = '', $gradeUser) {
	require_once ("Modules/Chat/Vue/ConnectesVue.php");
	?>

	<div id="Chat">

	    <h4>Chat du SWAGG</h4><span id="masqChat" onclick="chatMasq();">Afficher</span>
	    <div id="masq" class="noDisplay">
		<div id="Connectes">
		    <h5>Connectés</h5>
		    <div id="conn">
			<?php
			ConnectesVue::display($connectes, $gradeUser);
			?>
		    </div>
		    <button id="chatInfo" onclick="infoChat();">Information</button>
		    <img src="images/chat/chatLoader_reception.png" id="loaderConnectes" />
		</div>
		<div id="Messages">
		    <h5 class="canal" id="chatGeneral" onclick="canalGeneral();">Général</h5>
		    <h5 class="canal" id="chatRegion" onclick="canalRegion();">Région</h5>

		    <div id="mess">

			<script>
			    listeMessages[0] = '<p class="messInfo" style="background:#555; color:white;">Ce chat est modéré. Tout abus de langage peut être sanctionné. Vous êtes responsable de vos dires !<br/>Le chat contient actuellement <?php echo sizeof($messages); ?> messages.</p>';
	<?php
	for ($i = 0; $i < sizeof($messages); $i++) {
	    if ($messages[$i]['pseudo'] == User::getPseudo()) {
		$mess = '<p class="' . $messages[$i]['destinataire'] . ' chatMoi"><span class="chatDate">' . $messages[$i]['time'] . '</span> Moi : ' . self::urllink($messages[$i]['message']) . '</p>';
	    } else {
		$mess = '<p class="' . $messages[$i]['destinataire'] . '"><span class="chatDate">' . $messages[$i]['time'] . '</span> <span class="chatPseudo" style="background: #' . $messages[$i]['couleur'] . ';" onclick="canalPrive(\'' . $messages[$i]['pseudo'] . '\')">' . $messages[$i]['pseudo'] . '</span> : ' . self::urllink($messages[$i]['message']) . '</p>';
	    }
	    ?>
	    		    listeMessages.push("<?php echo str_replace('"', '\\"', $mess); ?>");
	    <?php
	}
	?>
			</script>

		    </div>
		    <img src="images/chat/chatLoader_reception.png" id="loaderMessages" />
		</div>
		<img src="images/chat/chatLoader_envoi.png" id="loaderEnvoi" />
		<input type="text" placeholder="Soyez courtois et ne dépassez pas 300 caractères" maxlength="300" onkeypress="chatKey(event);
		       " id="inputChat" />
	    </div>
	</div>

	<?php
    }

}
