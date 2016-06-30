<?php

include_once 'lib/rules/Rule.php';

class Url extends Rule {

    public function succeed() {
        if (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            $this->message = $this->key . ' is not an url';

            return false;
        }//endif

        return true;
    }

}

?>
