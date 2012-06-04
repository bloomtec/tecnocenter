<?php
class OnlineSale extends AppModel {
	var $name = 'OnlineSale';
	var $displayField = 'id';
	var $validate = array(
		'id_cuenta' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'codigo_venta' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'porcentaje_iva' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor_unit' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subtotal' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor_iva' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor_total' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	function afterSave($created){
		if($created){
			$this->actualizarInventario($this->data,$this->data["OnlineSale"]["cantidad"]);
		}
			
		return true;
	}
	function actualizarInventario($onlineSale,$cantidad){
		App::import('Model', 'Inventory');
		$Inventory=new Inventory();
		App::import('Model', 'InventoryMovement');
		$InventoryMovement=new InventoryMovement();
		$productId=$onlineSale["OnlineSale"]["product_id"];
		$inventory=$Inventory->find("first",array(
			"conditions"=>array(
				"stock >"=>"0","product_id"=>$productId
				)
			)
		);
		if($inventory["Inventory"]["stock"]>=$cantidad){
			//Hay cantidad suficiente de un solo inventario
			$inventory["Inventory"]["stock"]-=$cantidad;
			$Inventory->save($inventory);
			$this->data["InventoryMovement"]["inventory_id"]=$inventory["Inventory"]["id"];
			$this->data["InventoryMovement"]["proveedor_id"]=$inventory["Inventory"]["provider_id"];
			$this->data["InventoryMovement"]["tipo_documento_id"]=2;
			$this->data["InventoryMovement"]["numero_documento"]=$cantidad;
							$InventoryMovement->create();
							$InventoryMovement->save($this->data);
							$InventoryMovement->id=0;
			return true;
		}else{
			// No hay cantidad suficiente de un solo inventario para cumplir con la venta
			$cantidadFaltante=$cantidad-$inventory["Inventory"]["stock"];// se le resta a la cantidad de la venta lo que se va a vender de ese stock
			$inventory["Inventory"]["stock"]=0;
			$Inventory->save($inventory);
			$this->data["InventoryMovement"]["inventory_id"]=$inventory["Inventory"]["id"];
			$this->data["InventoryMovement"]["proveedor_id"]=$inventory["Inventory"]["provider_id"];
			$this->data["InventoryMovement"]["tipo_documento_id"]=2;
			$this->data["InventoryMovement"]["numero_documento"]=$cantidad;
							$InventoryMovement->create();
							$InventoryMovement->save($this->data);
							$InventoryMovement->id=0;
			$this->actualizarInventario($onlineSale,$cantidadFaltante);
		}
		
	}
}
?>