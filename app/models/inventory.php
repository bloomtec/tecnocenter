<?php
class Inventory extends AppModel {
	var $name = 'Inventory';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'stock' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo es requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
	);
	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Provider' => array(
			'className' => 'Provider',
			'foreignKey' => 'provider_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'InventoryMovement' => array(
			'className' => 'InventoryMovement',
			'foreignKey' => 'inventory_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	function afterSave(){
		//debug($this->data);
		$productId=$this->data["Inventory"]["product_id"];
		$this->Product->recursive=0;
		$product=$this->Product->read(null,$this->data["Inventory"]["product_id"]);
		$this->recursive=0;
		$inventories=$this->find("all",array("conditions"=>array("product_id"=>$productId,"stock >"=>0)));
		$stock=0;
			foreach($inventories as $inventory){
				$stock+=$inventory["Inventory"]["stock"];
			}
		$product["Product"]["inventario"]=$stock;
		$this->Product->save($product);
	}
}
?>