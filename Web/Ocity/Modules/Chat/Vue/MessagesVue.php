<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class MessagesVue {

    static function display($canal, $time, $pseudo, $message, $couleurPseudo) {
	require_once ("../Vue/ChatVue.php");

	echo '<p class="' . $canal . '"><span class="chatDate">' . $time . '</span> <span class="chatPseudo" style="background: #' . $couleurPseudo . ';">' . $pseudo . '</span> : ' . ChatVue::urllink($message) . '</p>';
    }

    static function info($type, $message) {
	require_once ("../Vue/ChatVue.php");

	echo '<p class="messInfo"><span class="chatDate">' . date("Y-m-d H:i:s", time()) . '</span> <span class="chatPseudo">' . $type . '</span> : ' . ChatVue::urllink($message) . '</p>';
    }

}
