<?php
class TestController
{
	public function Test(){
		$test = 'test';

		$title = 'mijn test pagina';
		$v_content = 'views/test.php';

		include('views/master.php');
	}
}