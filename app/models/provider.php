<?php
class Provider extends AppModel {
	var $name = 'Provider';
	var $displayField = 'nit_proveedor';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'tipo_iden_pro' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
	
		),
		'e_mail' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Formato de email no valido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
	
		),
		'nit_proveedor' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique'=>array(
				'rule' => 'isUnique', 
				'message' => 'El Proveedor ya existe',
				'on' => 'create'
			)
		),
		'digito_ver' => array(
			
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'representante_legal' => array(
			
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'pais' => array(
			
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'departamento' => array(
			
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'ciudad' => array(
			
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'clasificacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'p_nom_prov' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'direccion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'telefono_1' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'telefono_2' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'celular' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'estado_proveedor' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		'tipo_regimen' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
		),
		
	);
	var $hasMany = array(
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'provider_id',
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
	function beforeSave(){
		$this->data["Provider"]["representante_legal"]=strtoupper($this->data["Provider"]["representante_legal"]);//CONVIERTE A MINUSCULA EL EMAIL
		$this->data["Provider"]["pais"]=strtoupper($this->data["Provider"]["pais"]);
		$this->data["Provider"]["departamento"]=strtoupper($this->data["Provider"]["departamento"]);
		$this->data["Provider"]["ciudad"]=strtoupper($this->data["Provider"]["ciudad"]);
		$this->data["Provider"]["e_mail"]=strtolower($this->data["Provider"]["e_mail"]);
		return true;
	}
}
?>