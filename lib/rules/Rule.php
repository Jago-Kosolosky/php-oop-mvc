<?php

abstract class Rule{
	protected $rule = '';
	protected $value = null;
	protected $key = '';
	protected $message = '';

	public function __construct($rule, $value, $key){
		$this->rule = $rule;
		$this->value = $value;
		$this->key = $key;
	}

	public function getMessage(){
		return $this->message;
	}

	public abstract function succeed();
}