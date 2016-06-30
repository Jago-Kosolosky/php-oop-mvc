<?php
include_once 'lib/rules/Rule.php';

class Numeric extends Rule{
	public function succeed(){

		if(  ! is_numeric($this->value)){
			$this->message =  $this->key . ' is not numeric';

			return false;
		}//endif

		return true;
	}
}	