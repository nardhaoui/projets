<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class EnvoiVue {

    static function display($message, $canal, $pseudo = '') {
	require_once ("../Vue/ChatVue.php");

	if ($pseudo != '') {
	    $pseudo = ' à ' . $pseudo;
	}
	echo '<p class="' . $canal . ' chatMoi"><span class="chatDate">' . date("Y-m-d H:i:s", time()) . '</span> Moi' . $pseudo . ' : ' . ChatVue::urllink($message) . '</p>
			    ';
    }

    static function info($type, $message) {
	require_once ("../Vue/ChatVue.php");

	echo '<p class="messInfo"><span class="chatDate">' . date("Y-m-d H:i:s", time()) . '</span> <span class="chatPseudo" style="background: #C82020">' . $type . '</span> :<br/>' . ChatVue::urllink($message) . '</p>
			    ';
    }

}
