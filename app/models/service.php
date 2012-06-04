<?php
class Service extends AppModel {
	var $name = 'Service';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		'isUnique'=>array(
			'rule' => 'isUnique', 
			'message' => 'El servicio ya existe',
			'on' => 'create'
		)
		),
	);
}
?>