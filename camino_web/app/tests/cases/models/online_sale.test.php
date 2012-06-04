<?php
/* OnlineSale Test cases generated on: 2011-03-11 05:03:39 : 1299816099*/
App::import('Model', 'OnlineSale');

class OnlineSaleTestCase extends CakeTestCase {
	var $fixtures = array('app.online_sale', 'app.user', 'app.role', 'app.audit', 'app.passoword_change', 'app.product', 'app.category', 'app.manufacturer', 'app.inventory', 'app.provider', 'app.inventory_movement', 'app.tipo_documento', 'app.photo_album', 'app.photo');

	function startTest() {
		$this->OnlineSale =& ClassRegistry::init('OnlineSale');
	}

	function endTest() {
		unset($this->OnlineSale);
		ClassRegistry::flush();
	}

}
?>