<?php
/* OnlineSales Test cases generated on: 2011-03-11 05:03:07 : 1299816127*/
App::import('Controller', 'OnlineSales');

class TestOnlineSalesController extends OnlineSalesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OnlineSalesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.online_sale', 'app.user', 'app.role', 'app.audit', 'app.passoword_change', 'app.product', 'app.category', 'app.manufacturer', 'app.inventory', 'app.provider', 'app.inventory_movement', 'app.tipo_documento', 'app.photo_album', 'app.photo', 'app.service');

	function startTest() {
		$this->OnlineSales =& new TestOnlineSalesController();
		$this->OnlineSales->constructClasses();
	}

	function endTest() {
		unset($this->OnlineSales);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>