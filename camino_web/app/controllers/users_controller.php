<?php
class UsersController extends AppController {

	var $name = 'Users';
  	private $foto="";
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('delete','edit',
							'register', 
							'rememberPassword',"init","checkEmail","login");
	}
 	 function menu($id=null)
 	 {
		//debug($this->Session->read("Auth.User.role"));
		$this->redirect(array('action' => 'view',$this->Session->read("Auth.User.id")));
	 }
	 
	function admin_menu()
	{
		//Redirecciones segun el role
		switch($this->Session->read("Auth.User.role_id")){
			case 1:
			//$this->redirect(array('action' => 'index',$this->Session->read("Auth.User.id")));
			break;
			//$this->redirect(array("controller"=>"",'action' => 'index',$this->Session->read("Auth.User.id")));
			case 2:
			break;
			case 3:
				break;
			case 4:
			case 5:
				$this->Session->setFlash(__('No tiene privilegios para ingresar a esta seccion.', true));
			$this->redirect(array("controller"=>"users","action"=>"login"));
			break;
		}
	//	$this->redirect(array('action' => 'view',$this->Session->read("Auth.User.id")));
	}
	
	
	function index() {
		$this->redirect(array('action' => 'view',$this->Session->read("Auth.User.id")));
	}
	function modificarDatos(){
		$id=$this->Auth->user("id");
		if (!empty($this->data)){
			$this->data["User"]["actualizado"]=true;
			$this->data["User"]["id"]=$id;
			if ($this->User->save($this->data,array("validate"=>false))) {
				$this->Session->setFlash(__('Usuario modificado', true));
				$rol=$this->Session->read("Auth.User.role_id");
				parent::saveAudit("User","Edit", $this->User->id,null,$rol);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser modificado. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	function checkPassword(){
		$this->User->recursive=0;
		$user=$this->User->read(null,$this->Auth->user("id"));
		if($user["User"]["password"]==$this->Auth->password($_GET["data"]["User"]["actualPassword"])){
			$user["User"]["password"]=$this->Auth->password($_GET["data"]["User"]["password"]);
			$this->User->save($user,array("validate"=>false));
			$this->Session->setFlash(__('Se ha modificado su contraseña', true));
			echo json_encode(true);
		}else{
			echo json_encode(array("data[User][actualPassword]"=>"Contraseña Actual no valida"));
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
  	function cambiarContrasena(){
  		if(!empty($this->data)){
  			
  		}
  	}
	function checkEmail(){
		$checkMail=$this->User->findByEmail($_GET["data"]["User"]["email"]);
			if($checkMail){
				echo json_encode(array("data[User][email]"=>"el email se encuentra registrado"));
				Configure::write("debug",0);
				$this->autoRender=false;
				exit(0);

			}else{
				echo json_encode(true);
				Configure::write("debug",0);
				$this->autoRender=false;
				exit(0);
			}
			Configure::write("debug",0);
				$this->autorender=false;
				exit(0);
	}
	function register(){
	  //debug($this->data); exit;
		if (!empty($this->data)) 
		{//debug($this->data);
			
		  	$this->User->recursive = 0;		  
			$this->User->create();
			$this->data["User"]["role_id"]=4;// Is set as a Basic user for default
		  if ($this->User->save($this->data,array("validate"=>false))) 
			{				
				$aro =& $this->Acl->Aro;
				$newAro=array(
					"alias"=>$this->data["User"]["email"],
					"parent_id"=>4,
					"foreign_key"=>$this->User->id,
					"model"=>"User",
				);
				$aro->create();
				$aro->save($newAro);												
		        $para      = $this->data['User']['email'];
				$asunto    = 'Bienvenido a Tecnocenter';
				$mensaje   = 'Bienvenido, sus datos de ingreso al portal Tecnocenter son los siguientes:<br> Nombre de usuario (email) :'.$this->data['User']['email'].
							 '<br>Contraseña: '.$this->data['User']['password2'];
				 
				$cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				$cabeceras .= 'From: Tecnocenter <info@tecnocenter.com.co>' . "\r\n";

				/*if(mail($para, $asunto, $mensaje, $cabeceras))
				{
					$this->Session->setFlash(__('Bienvenido', true));
				}else 
				{
						$this->Session->setFlash(__('Bienvenido', true));
					//$this->Session->setFlash(__('Datos de logueo no enviados a su correo, por favor intenta mas tarde', true));
				}*/
			
				//$rol=$this->Session->read("Auth.User.role_id");
				parent::saveAudit("User","Register", $this->User->id,$this->data["User"]["email"]);
				$this->Session->setFlash(__('Su registro ha sido éxitoso', true));
				$this->Auth->login($this->data);
				$this->redirect(array("controller"=>"users",'action' => 'view', $this->User->id));
			} else {
				$this->Session->setFlash(__('No se pudo completar el registro. Por favor, intente de nuevo', true));
			}
		}
		
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Usuario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$id=$this->Auth->user("id");
		$user=$this->User->read(null, $id);
		$onlineSales = $this->User->OnlineSale->find('all', array("order"=>"OnlineSale.id DESC",'conditions'=>array('OnlineSale.user_id'=>$id)));
			if(isset($_GET["usuario_id"])){
				$this->Session->delete("shopCart");
				$this->Session->setFlash($_GET["mensaje"]);
			}
		$this->set('user', $user);
		$this->set('onlineSales',$onlineSales);
	}

	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			
			$this->Session->setFlash(__('Usuario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('Usuario modificado', true));
				$rol=$this->Session->read("Auth.User.role_id");
				parent::saveAudit("User","Edit", $this->User->id,null,$rol);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser modificado. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

	
	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->User->recursive = 0;
		if($this->Auth->user("role_id")!=1){
			$this->set('users', $this->paginate(array("role_id >"=>1)));
		}else{
			$this->set('users', $this->paginate());
		}
	}

	function admin_view($id = null) {
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Usuario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
	parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->User->create();
			
			//debug($this->data); exit;
		/*	if($this->data["User"]["foto"]["error"]==4){
				$roles = $this->User->Role->find('list',array("conditions"=>array("id >"=>"0")));
				$this->set(compact('roles'));
				$this->Session->setFlash(__('Debes seleccionar una foto', true));
				return;
			}
			*/
			if($this->data["User"]["foto"]["error"]!=4&&$this->uploadPicture($this->data["User"]["foto"])==false){
				$roles = $this->User->Role->find('list',array("conditions"=>array("id >"=>"0")));
				$this->set(compact('roles'));
				$this->Session->setFlash(__('Error al subir la foto.', true));
				return;
			}
			
			$this->data["User"]["foto"]=$this->foto;
			
			if ($this->User->save($this->data)) {
				$aro =& $this->Acl->Aro;
				 $elaro=$aro->find("first",array("conditions"=>array("Model"=>"Role","foreign_key"=>$this->data["User"]["role_id"])));
				$newAro=array(
					"alias"=>$this->data["User"]["email"],
					"parent_id"=>$elaro["Aro"]["id"],
					"foreign_key"=>$this->User->id,
					"model"=>"User",
				);
				$aro->create();
				$aro->save($newAro);
				$this->Session->setFlash(__('Usuario guardado', true));
				$rol=$this->Session->read("Auth.User.role_id");
				parent::saveAudit("User","Add", $this->User->id,$this->data["User"]["email"],$rol);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$roles = $this->User->Role->find('list',array("conditions"=>array("id >"=>"1")));
		$this->set(compact('roles'));
	}

	function admin_edit($id = null) 
	{
		parent::checkPermiso('actualiza');
		
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Usuario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) 
		{
			if($this->data["User"]["foto"]["error"]==4){
			        $this->data["User"]["foto"]=$this->data["Opcional"]["fotoOriginal"];
				
			}else if($this->data["User"]["foto"]["error"]==0) {
				if($this->uploadPicture($this->data["User"]["foto"])==false){
					$roles = $this->User->Role->find('list',array("conditions"=>array("id >"=>"0")));
					$this->set(compact('roles'));
					$this->data = $this->User->read(null, $id);
					$this->Session->setFlash(__('Error al subir la foto, solo se admiten los siguientes formatos: .jpg, .gif y .png', true));
					return;
				}else {
					$this->data["User"]["foto"]=$this->foto;
				}
			}
			
			if(!empty($this->data["Opcional"]["password2"])){
				$this->data["User"]["password"]=$this->Auth->password($this->data["Opcional"]["password2"]);
			}
			
			//debug($this->data); exit;
			//debug($this->User);
			if ($this->User->save($this->data["User"])) {
				
				$rol=$this->Session->read("Auth.User.role_id");
				parent::saveAudit("User","Edit", $this->User->id,$this->data["User"]["email"],$rol);
				$this->Session->setFlash(__('Usuario modificado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser modificado. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		
		$roles = $this->User->Role->find('list',array("conditions"=>array("id >"=>"1")));
		$this->set(compact('roles'));
	}

	function admin_delete($id = null) 
	{
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el usuario', true));
			$this->redirect(array('action'=>'index'));
		}
		$usuario=$this->User->read(null,$id);
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('Usuario eliminado', true));
			$rol=$this->Session->read("Auth.User.role_id");
			parent::saveAudit("User","Delete", $id,$usuario["User"]["email"],$rol);
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El usuario no pudo ser eliminado', true));
		$this->redirect(array('action' => 'index'));
	}
	
	//LOGIN USER
	function login()
	{
			//debug($this->data);
		$this->set("login",true);
		
	}
	function admin_login(){
		$this->set("login",true);
	}
	
	//LOGOUT USER
	function logout() 
	{
	   $this->redirect($this->Auth->logout());    
	}
	
	function admin_logout() 
	{
	   $this->redirect($this->Auth->logout());    
	}
	
	//Configurar el reporte
	function admin_selectReport()
	{
		parent::checkPermiso('reportes');
		$roles=$this->User->Role->find('list');
		$roles[0]="Todos";
	
		$this->set(compact('roles'));
	}

	//Reporte por tipos de usuario
	function admin_userReports()
	{
		
		$this->User->recursive = 0;
		
		$array=array("id");
		foreach($this->data['User'] as $indice =>$valor)
		{
			if($valor==1 && $indice!="role_id")
			{
				$array[] = $indice;
			}
		}
		
		$rol = $this->data['User']['role_id'];	
		if(count($array)==1){
			$array=array();
			$titulos=$this->titulos($array);
		}else {
			$titulos=$array;
		}
		//debug($titulos);
		if($rol){
			$reporte = $this->User->find('all', array('fields'=>$titulos,'conditions'=>array('User.role_id'=>$rol)));
		}else{
			$reporte = $this->User->find('all', array('fields'=>$titulos));
		}
		
		
		$titulos=$this->titulos($titulos);		
		$reporte=$this->remplazo($reporte);
		//debug($reporte); exit;
		$this->set(compact("reporte", "titulos"));
			
		$this->layoutReporte("Reportes de usuarios");
		
		
	}
	
	function titulos($array)
	{
		$titles=array();		
		$titles=array("id"=>"Id",
						"role_id"=>"Rol",
						"tipo_identificacion"=>"Tipo identificación",
						"numero_identificacion"=>"Identificación",
						"primer_nombre"=>"Primer nombre",
						"segundo_nombre"=>"Segundo nombre",
						"primer_apellido"=>"Primer apellido",
						"segundo_apellido"=>"Segundo apellido",
						"email"=>"Email",
						"direccion"=>"Dirección",
						"pais"=>"Pais",
						"departamento"=>"Departamento",
						"ciudad"=>"Ciudad",
						"telefono"=>"Teléfono",
						"telefono_adicional"=>"Teléfono adicional",
						"celular"=>"Celular",
						"celular_adicional"=>"Celular adicional",
						);
		
		if( count($array)==0 ) {
			foreach($titles as $key=>$value) {
						$array[]=$key;
				}
		} else {
			for($i=0;$i<=count($array)-1; $i++) {
					foreach($titles as $key=>$value) {
						if($key==$array[$i]) {
							$array[$i]=$value;
						}
					}
				}
		}
		
		//debug($array); exit;
		return $array;
	}
	
	//Remplaza las llaves foraneas del reporte por un nombre
	function remplazo($reporte)
	{
		
		$i=0;
			$rpt=array();
			for($i;$i<=count($reporte)-1;$i++) {
				foreach($reporte[$i] as $key => $value) {
					$j=0;
					foreach($value as $k=>$v) {
						if($k=="role_id") {
							$valor = $this->User->Role->find("list", 
													array('recursive' => 0 ,'fields'=>array('name'),
													'conditions'=>array('Role.id'=>$v)));						
							foreach($valor as $key=>$value) {
								$rpt[$i][$j++]=$value;
							}
						}
						
						else {
							$rpt[$i][$j++]=$v;
						}
					}
				}
			}
			
			return $rpt;
	}
	
	//$foto array del archivo
    //nombre_foto es igual al username ya que sera unico
	function uploadPicture($foto)
	{
		//Caracteristicas de la imagen
		$nombre = $foto['name'];
		$tipo = $foto['type'];
		$tamano = $foto['size'];
		
		//Comprobamos la extensión de la  imagen
		if(strpos($tipo, "gif")) {
			$nombre_foto=md5(sha1(rand(1,1000))).".gif";
		} else if(strpos($tipo, "jpg")) {
			$nombre_foto=md5(sha1(rand(1,1000))).".jpg";
		}else if(strpos($tipo, "png")) {
			$nombre_foto=md5(sha1(rand(1,1000))).".png";
		}else if(strpos($tipo, "jpeg")) {
			$nombre_foto=md5(sha1(rand(1,1000))).".jpg";
		}
		else {
			return false;
		}
		
		//Directorio donde sera guardada la imagen
		$directorio = WWW_ROOT."img".DS."fotos".DS.$nombre_foto;
		
	
			//Copiamos la imagen al directorio, especificado
	   		if (copy($foto["tmp_name"], $directorio))
	   		{
	   		   $this->foto="fotos/".$nombre_foto;
			   return true;  
	   		}
	   		else
	   		{ 
			   return false; 
	   		}
		
		
	}

    //Recordar email
	function generarPassword(){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<8;$i++) {
	$cad .= substr($str,rand(0,62),1);
	}
	return $cad;
	}
	function rememberPassword()
	{
		if (!empty($this->data)) 
		{
			$this->User->recursive=0;
			$datos=$this->User->find("first", array( 
									'conditions'=>array('User.email'=>trim($this->data['User']['email']))));
									
			$newPassword=$this->generarPassword();
			$datos["User"]["password"]=$this->Auth->password($newPassword);
			//debug($datos);
			if($datos['User']['email'])
			{				
				$para      = $datos['User']['email'];
				$asunto    = 'Recuperacion de contraseña';
				$mensaje   = 'Sus datos para ingresar al portal tecnocenter.com.co son los siguientes: <br /> Nombre de usuario: '.$datos['User']['email'].
							 ' <br /> Contraseña: '.$newPassword;
						 
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				$cabeceras .= "To:< ".$datos['User']['email'].">" . "\r\n";
				$cabeceras .= 'From: Tecnocenter <info@tecnocenter.com.co>' . "\r\n";

				if(mail($para, $asunto, $mensaje, $cabeceras))
				{
					$this->User->save($datos,array("validate"=>false));
					$this->set("mensaje",'Datos enviados a su correo');
				}else 
				{
					$this->set("mensaje",'Datos no enviados a su correo, por favor intenta mas tarde');
				}
				return;
			}
			else 
			{
				$this->set("mensaje",'No existe ningun usuario registrado con ese email');
				return;
			}
		}	
	}

	
	function init()
	{
		$aro =& $this->Acl->Aro;
		$aco =& $this->Acl->Aco;

		$firstAroId=$aro->id;
		$roles=array("Super_Administrador","Administrador", "Vendedor", "Web", "Clientes");
		
		foreach($roles as $theRole){
			$role["Role"]["name"]=$theRole;
			$this->User->Role->create();
			if($this->User->Role->save($role)){
				$newAro=array(
					"alias"=>$role["Role"]["name"],
					"model"=>"Role",
					"foreign_key"=>$this->User->Role->id,
					);
				$aro->create();
				$aro->save($newAro);
			}
			$this->User->Role->id=0;
		}
		
		$firsAcos=array(
			0=>array(
				"alias"=>"admin_menu"				
			),
			1=>array(
				"alias"=>"menu"	
			),	
			2=>array(
				"alias"=>"actualiza",
			),
			3=>array(
				"alias"=>"inventarios",	
			),
			4=>array(
				"alias"=>"ventas",
			),
			5=>array(
				"alias"=>"reportes",
			),
			6=>array(
				"alias"=>"auditoria",
			),
			7=>array(
				"alias"=>"encuestas",
			),	
		);
		foreach($firsAcos as $newAro){
			$aco->create();
			$aco->save($newAro);
			$aco->id=0;
		}
		$this->Acl->allow('Super_Administrador', 'admin_menu');
		$this->Acl->allow('Administrador', 'admin_menu');
		$this->Acl->allow('Vendedor', 'admin_menu');
		$this->Acl->allow('Web', 'menu');
		$this->Acl->allow('Clientes', 'menu');
		//$this->User->query("INSERT INTO `users` (`id`, `role_id`, `tipo_identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `email`, `direccion`, `pais`, `departamento`, `ciudad`, `telefono`, `telefono_adicional`, `celular`, `celular_adicional`, `foto`, `username`, `password`) VALUES(1, 1, 'C. ', 'Super', '', 'Administrador', '', 'superadministrador@tecnocenter.com', '', '', '', '', 5555555, 55555555, 2147483647, 2147483647, '', 'superadmistrador', 'cdc097124bc6e6637abefa0f584fe8720b729bbe'),(2, 2, 'C. ', 'administrador', '', 'Administrador', '', 'administrador@tecnocenter.com', '', '', '', '', 5555555, 55555555, 2147483647, 2147483647, '', 'administrador', '681e76a4bb4926746ed071cdae432aa2702d3af4'),(3, 3, 'C. ', 'vendedor', '', 'vendedor', '', 'vendedor@tecnocenter.com', '', '', '', '', 5555555, 55555555, 2147483647, 2147483647, '', 'vendedor', 'e7f8fdafa72a45dea5369fcf90dc1eac45c7fb58');");		
	}
	function acos(){
		$aco =& $this->Acl->Aco;
			$firsAcos=array(
			0=>array(
				"alias"=>"admin_menu"				
			),
			1=>array(
				"alias"=>"menu"	
			),	
			2=>array(
				"alias"=>"actualiza",
			),
			3=>array(
				"alias"=>"inventarios",	
			),
			4=>array(
				"alias"=>"ventas",
			),
			5=>array(
				"alias"=>"reportes",
			),
			6=>array(
				"alias"=>"auditoria",
			),
			7=>array(
				"alias"=>"encuestas",
			),	
		);
		foreach($firsAcos as $newAro){
			$aco->create();
			$aco->save($newAro);
			//$aco->id=0;
			}
		}
		function permisos(){
			$aro =& $this->Acl->Aro;
			$aco =& $this->Acl->Aco;

			/**
			 * Permisos para super administrador
			 */
			 $this->Acl->allow('Super_Administrador', 'actualiza');
			 $this->Acl->allow('Super_Administrador', 'inventarios');
			 $this->Acl->allow('Super_Administrador', 'ventas');
			 $this->Acl->allow('Super_Administrador', 'reportes');
			 $this->Acl->allow('Super_Administrador', 'auditoria');
			 $this->Acl->allow('Super_Administrador', 'encuestas');
			 $this->Acl->allow('Super_Administrador', 'admin_menu');
			$this->Acl->allow('Super_Administrador', 'acercade');
			 /**
			  * Permisos para el administrador
			  */
			$this->Acl->allow('Administrador', 'actualiza');
			$this->Acl->allow('Administrador', 'inventarios');
			$this->Acl->allow('Administrador', 'ventas');
			$this->Acl->allow('Administrador', 'reportes');
		//	$this->Acl->allow('Administrador', 'auditoria');
			$this->Acl->allow('Administrador', 'encuestas');
			$this->Acl->allow('Administrador', 'admin_menu');
			$this->Acl->allow('Administrador', 'admin_menu');
			$this->Acl->allow('Administrador', 'acercade');
			 /**
			  * Permisos para el vendedor
			  */
			//$this->Acl->allow('Vendedor', 'actualiza');
			//$this->Acl->allow('Vendedor', 'inventarios');
			$this->Acl->allow('Vendedor', 'ventas');
			$this->Acl->allow('Vendedor', 'reportes');
			//$this->Acl->allow('Vendedor', 'auditoria');
			//$this->Acl->allow('Vendedor', 'encuestas');
			$this->Acl->allow('Vendedor', 'admin_menu');
			$this->Acl->allow('Vendedor', 'acercade');

		}
		function reset(){
			$this->User->query("TRUNCATE TABLE `users`");
			$this->User->query("TRUNCATE TABLE `roles`");
			$this->User->query("TRUNCATE TABLE `aros_acos`");
			$this->User->query("TRUNCATE TABLE `aros`");
			$this->User->query("TRUNCATE TABLE `acos`");
			$this->init();
			$this->redirect($this->referer());
		}
	
	
}
?>