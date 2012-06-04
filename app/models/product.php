<?php
class Product extends AppModel {
	var $name = 'Product';
	var $displayField = 'nombre';
	var $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números'
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'manufacturer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),'message' => 'Solo se permiten números'
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nombre' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => "Uno de los caracteres no es valido",
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique'=>array(
			 'rule' => 'isUnique', 
			 'message' => 'Ya existe un producto con este código.'
			)
		),
		'cod_barras' => array(
			/*'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			/*'isUnique'=>array(
			 'rule' => 'isUnique', 
			 'message' => 'Ya existe un producto con este código.'
			)*/
		),
		'costo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor_venta' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'estado_prod' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rotacion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo requerido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stock_minimo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stock_maximo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'costo_promedio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor_base' => array(
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
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'porc_utilidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tiempo_reposicion' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se permiten números',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*
		'ficha_producto' => array(
        	//'rule' => array('extension', array('doc', 'docx', 'pdf', 'xls', 'xlsx')),  
        	'rule' => array('extension', array('pdf')), 
        	'allowEmpty' => true, 
        	'message' => 'Solo se permiten archivos .doc, .docx, .pdf, .xls, .xlsx'
    	),  */
    	
	
		'imagen_listado' => array(
        	'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),  
        	'allowEmpty' => false, 'required' => true,
        	'message' => 'Debes ingresar una imagen, solo se permiten imagenes .gif, .jpeg, .png, .jpg'
    	), 
    	
		'imagen_principal' => array(
        	'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),  
        	'allowEmpty' => false, 'required' => true,
        	'message' => 'Debes ingresar una imagen, solo se permiten imagenes .gif, .jpeg, .png, .jpg'
    	), 
    	
		
    	

	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Manufacturer' => array(
			'className' => 'Manufacturer',
			'foreignKey' => 'manufacturer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'product_id',
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
			'foreignKey' => 'product_id',
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
	
	function productosPromocionados($categoriaId=null){
		if($categoriaId){
			return $this->find("all",array("conditions"=>array("Product.promocionar"=>true,"Product.category_id"=>$categoriaId,"Product.inventario >"=>0)));
		}else{
			return $this->find("all",array("conditions"=>array("Product.promocionar"=>true,"Product.inventario >"=>0)));
		}
	}
	function productosDestacados($categoriaId=null){
		if($categoriaId){
			return $this->find("all",array("conditions"=>array("Product.destacar"=>true,"Product.category_id"=>$categoriaId,"Product.inventario >"=>0)));
		}else{
			return $this->find("all",array("conditions"=>array("Product.destacar"=>true,"Product.inventario >"=>0)));
		}
	}

}
?>