<?php
/* OnlineSale Test cases generated on: 2011-03-11 04:03:30 : 1299815970*/
App::import('Model', 'OnlineSale');

class OnlineSaleTestCase extends CakeTestCase {
	var $fixtures = array('app.online_sale');

	function startTest() {
		$this->OnlineSale =& ClassRegistry::init('OnlineSale');
	}

	function endTest() {
		unset($this->OnlineSale);
		ClassRegistry::flush();
	}

}
?>