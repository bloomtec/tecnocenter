<?php
class AppController extends Controller {
	
	var $uses=array("Category","Service","Product","Audit","Survey","Role");
	var $components=array("Acl","Session", "Auth");
	private $tiposIdentificacion=array("C.C"=>"C.C","T.I"=>"T.I","C.E"=>"C.E");
	
	function beforeFilter()
	{
	$this->Auth->fields = array(
	'username' => 'email',
	'password' => 'password'
	);
	$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
	$this->Auth->loginRedirect= array('controller'=>'users','action'=>'menu');
	$this->Auth->logoutRedirect= array('controller'=>'products','action'=>'index',"admin"=>false);
	$this->Auth->loginError = "Usuario o Password no válido";
	$this->Auth->authError = "No tiene permiso para ingresar a la cuenta.";
	$this->Auth->allow('login',"logout");
	$this->categorias();
	}
	function beforeRender(){
		//$this->Session->delete("shopCart");
		//debug($this->Session->read("shopCart"));
		if(isset($this->params["prefix"])&&$this->params["prefix"]=="admin"){
			if($this->layout!="pdf"&&$this->layout!="excel"&&$this->layout!="graficapdf") $this->layout="admin";
			$this->set("rolesLogin",$this->Role->find("list"));
			//PERMISOSA PARA VISATA
			if($this->action!="admin_login"&&$this->action!="login"){
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'actualiza')){
				$actualiza=true;
				$this->set(compact("actualiza"));
				}
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'inventarios')){
					$inventarios=true;
					$this->set(compact("inventarios"));
				}
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'ventas')){
					$ventas=true;
					$this->set(compact("ventas"));
				}
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'reportes')){
					$reportes=true;
					$this->set(compact("reportes"));
				}
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'auditoria')){
					$auditoria=true;
					$this->set(compact("auditoria"));
				}
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), 'encuestas')){
					$encuestas=true;
					$this->set(compact("encuestas"));
				}
			} 
		}
		$this->set("tiposIdentificacion",	$this->tiposIdentificacion);
		
		$encuesta=$this->Survey->find("first",array(
			"conditions"=>array(
				"Survey.estado"=>true
			)
		));
		$surveyOptions=$this->Survey->SurveyOption->find("list",array(
			"conditions"=>array(
				"SurveyOption.survey_id"=>$encuesta["Survey"]["id"]
				)
		));
		$this->set(compact("encuesta","surveyOptions"));
		
	}
	
	function categorias()
	{
		 $menuCategories=$otherCategories=$otherServices=$menuServices=array();
		$categories=$this->Category->find("all",array("order"=>array("order ASC")));
		$count=0;
		foreach($categories as $category){
			if($count<8){
				$menuCategories[]=$category;
			}else{
				$otherCategories[]=$category;
			}
			$count++;
		}
		$count=0;	
		$services=$this->Service->find("all",array("order"=>array("order ASC")));
		foreach($services as $service){
			if($count<3){
				$menuServices[]=$service;
			}else{
				$otherServices[]=$service;
			}
			$count++;
		}

		$productosDestacados=$this->Product->productosDestacados();
		//debug($productosPromocionados);
		//	debug($productosDestacados);
		$this->set(compact("menuCategories","otherCategories","menuServices","otherServices","productosPromocionados","productosDestacados"));
	}
	
	function saveAudit($model, $accion, $foreingKey, $alias=null, $rol=null)
	{		
		/*if ($rol!=null)
		{
			$roles = array("1"=>"superadministrador",
						   "2"=>"administrador",
						   "3"=>"vendedor",
						   "4"=>"web",
						   "5"=>"clientes");	
						      
			foreach($roles as $key => $value)
			{
				if($rol==$key)
				{
					$alias = $value;
				}
			}
		}*/
		
		
		$userId=$this->Session->read("Auth.User.id");
		
	     $audit["Audit"]["user_id"]=$userId;
         $audit["Audit"]["foreing_key"]=$foreingKey;
         $audit["Audit"]["model"]=$model;
         $audit["Audit"]["alias"]=$alias;
         $audit["Audit"]["action"]=$accion;
		 $this->Audit->save($audit);
	}
	function checkPermiso($modulo){
		if(!$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Session->read("Auth.User.id")), $modulo)){
			$this->Session->setFlash(__('No tiene privilegios para ingresar a esta seccion.', true));
			$this->redirect(array("controller"=>"users","action"=>"menu"));
		};
	}
	function layoutReporte($titulo){
		if(isset($this->data["Report"]["tipo"])){
			switch($this->data["Report"]["tipo"]){
				case "pdf":
					$this->layout="pdf";
					$this->set("titulo",$titulo);
					break;
				case "excel":
					$this->layout="excel";
					$this->set("titulo",$titulo);
					$this->set("layout","excel");
					break;
				default:
				
			}
		}

	}
}