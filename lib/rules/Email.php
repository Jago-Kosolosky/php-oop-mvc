<?php
include_once 'lib/rules/Rule.php';

class Email extends Rule{
	
	public function succeed(){

		if( ! filter_var($this->value, FILTER_VALIDATE_EMAIL) ){
			$this->message =  $this->key . ' is not an email';

			return false;
		}//endif

		return true;
	}
}	