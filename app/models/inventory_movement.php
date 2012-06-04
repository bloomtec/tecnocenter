<?php
class InventoryMovement extends AppModel {
	var $name = 'InventoryMovement';
	var $displayField = 'detalle';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'numero_documento' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		
	);
	var $belongsTo = array(
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'inventory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TipoDocumento' => array(
			'className' => 'TipoDocumento',
			'foreignKey' => 'tipo_documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>