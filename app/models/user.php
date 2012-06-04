<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
	var $validate = array(
		'tipo_identificacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'numero_identificacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Este campo es requerido'
			
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números'
			
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique'=>array(
			 'rule' => 'isUnique', 
			 'message' => 'El valor ya se encuentra registrado.',
			 'on' => 'create'
			)
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),'message' => 'Formato de email no valido'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique'=>array(
			 'rule' => 'isUnique', 
			 'message' => 'El valor ya se encuentra registrado.',
			 'on' => 'create'
			)
		),
		'telefono' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'celular' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'username' => array(
			'notempty' => array(
			'rule' => array('notempty'),'message' => 'Campo requerido'
			
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			"alphaNumeric"=>array(
				"rule"=>array("alphaNumeric","message"=>"Uno de los caracteres no es valido")
			),
			'isUnique'=>array(
			 'rule' => 'isUnique', 
			 'message' => 'El nombre de usuario ya se encuentra registrado.',
			 'on' => 'create'
			)
		),*/
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'primer_nombre' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'segundo_nombre' => array(
			
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'primer_apellido' => array(
			'notempty' => array(
				'rule' => array('notempty'),'message' => 'Campo requerido'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Sólo se permiten letras'
				
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'segundo_apellido' => array(
			'onlyLetter' => array(
				'rule' => array('onlyLetter'),'message' => 'Solo se permiten letras',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'telefono_adicional' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números',
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
		/*'foto' => array(
        	'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),  
        	'allowEmpty' => true, 'required' => true,
        	'message' => 'Debes ingresar una imagen, solo se permiten imagenes .gif, .jpeg, .png, .jpg')*/
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Audit' => array(
			'className' => 'Audit',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'OnlineSale' => array(
			'className' => 'OnlineSale',
			'foreignKey' => 'user_id',
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
	if(isset($this->data["User"]["email"]))$this->data["User"]["email"]=strtolower($this->data["User"]["email"]);//CONVIERTE A MINUSCULA EL EMAIL
	if(isset($this->data["User"]["primer_nombre"]))$this->data["User"]["primer_nombre"]=strtoupper($this->data["User"]["primer_nombre"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	if(isset($this->data["User"]["segundo_nombre"]))$this->data["User"]["segundo_nombre"]=strtoupper($this->data["User"]["segundo_nombre"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	
	if(isset($this->data["User"]["primer_apellido"])) $this->data["User"]["primer_apellido"]=strtoupper($this->data["User"]["primer_apellido"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	if(isset($this->data["User"]["segundo_apellido"])) $this->data["User"]["segundo_apellido"]=strtoupper($this->data["User"]["segundo_apellido"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	if(isset($this->data["User"]["pais"])) $this->data["User"]["pais"]=strtoupper($this->data["User"]["pais"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	if(isset($this->data["User"]["departamento"])) $this->data["User"]["departamento"]=strtoupper($this->data["User"]["departamento"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	if(isset($this->data["User"]["ciudad"])) $this->data["User"]["ciudad"]=strtoupper($this->data["User"]["ciudad"]);//CONVIERTE EL NOMBRE A MAYUSCULA
	return true;
	}
}
?>