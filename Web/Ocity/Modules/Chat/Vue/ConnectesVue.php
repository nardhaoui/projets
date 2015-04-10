<?php

if (!defined('SECURE')) {
    die('Acces direct interdit !<br/>'
    . 'Non mais oh !');
}

class ConnectesVue {

    static function display($connectes, $gradeUser) {

	echo '<p class="chatMoi" style="color: #' . $gradeUser[1] . ';">Moi</p><br/>
				    ';
	for ($i = 0; $i < sizeof($connectes); $i++) {
	    echo '<p onclick="canalPrive(\'' . $connectes[$i]['pseudo'] . '\')" style="background: #' . $connectes[$i]['couleur'] . ';" title="' . $connectes[$i]['pseudo'] . ' est un ' . $connectes[$i]['nom'] . '" >' . $connectes[$i]['pseudo'] . '</p><br/>
				    ';
	}
    }

}
