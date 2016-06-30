<?php

include_once 'lib/rules/Rule.php';

class Required extends Rule {

    public function succeed() {

        if (is_null($this->value) || trim($this->value) == '') {
            $this->message = $this->key . ' is required';

            return false;
        }//endif

        return true;
    }

}