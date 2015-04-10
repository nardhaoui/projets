<?php

class Confirm {
    
    private static function debut() {
        echo "<div class='correct'><div id='correctBox' onclick=\"this.style='display:none;'\"><p>";
    }

    private static function fin() {
        echo "</p></div></div>";
    }
    
    function display($message) {
        self::debut();
        echo $message;
        self::fin();
    }


}
