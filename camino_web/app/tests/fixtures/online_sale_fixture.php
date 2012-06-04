<?php
/* OnlineSale Fixture generated on: 2011-03-11 05:03:39 : 1299816099 */
class OnlineSaleFixture extends CakeTestFixture {
	var $name = 'OnlineSale';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 12, 'key' => 'primary'),
		'id_cuenta' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 15, 'key' => 'index'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'porcentaje_iva' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'valor_unit' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'subtotal' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'valor_iva' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'valor_total' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'online_sales_product' => array('column' => 'product_id', 'unique' => 0), 'online_sales_user' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'id_cuenta' => 1,
			'user_id' => 1,
			'product_id' => 1,
			'cantidad' => 1,
			'porcentaje_iva' => 1,
			'valor_unit' => 1,
			'subtotal' => 1,
			'valor_iva' => 1,
			'valor_total' => 1,
			'created' => '2011-03-11 05:01:39',
			'updated' => '2011-03-11 05:01:39'
		),
	);
}
?>