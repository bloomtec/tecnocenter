<?php
class OnlineSalesController extends AppController {

	var $name = 'OnlineSales';
	var $uses=array("OnlineSale","Product","User");
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('confirmacion');
	}
	function index() {
		$this->OnlineSale->recursive = 0;
		$this->set('onlineSales', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Venta online inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('onlineSale', $this->OnlineSale->read(null, $id));
	}
	function confirmacion(){
		//Extra 1 es el id del usuario y la cantidad id:cantidad
		//Extra 2 es la cadena de ids de los productos de la venta
		//debug($_POST);
		$productox=$this->Product->read(null,1);
		$pdocutox["Product"]["descripcion"]=print_r($_POST,false);
		$this->Product->save($pdocutox);
		$usuario_id=$_POST["usuario_id"];
		$estado_pol=$_POST["estado_pol"];
		$riesgo=$_POST["riesgo"];
		$codigo_respuesta_pol=$_POST["codigo_respuesta_pol"];
		$ref_venta=$_POST["ref_venta"];
		$ref_pol=$_POST["ref_pol"];
		$firma=$_POST["firma"];
		$extra1=$_POST["extra1"];
		$extra2=$_POST["extra2"];
		$medio_pago=$_POST["medio_pago"];
		$tipo_medio_pago=$_POST["tipo_medio_pago"];
		$cuotas=$_POST["cuotas"];
		$iva=$_POST["iva"];
		$valorAdicional=$_POST["valorAdicional"];
		$moneda=$_POST["moneda"];
		$fecha_transaccion=$_POST["fecha_transaccion"];
		$codigo_autorizacion=$_POST["codigo_autorizacion"];
		$cus=$_POST["cus"];
		$banco_pse=$_POST["banco_pse"];
		$email_comprador=$_POST["email_comprador"];
		$productos=explode(",",$extra2);
		$errors="";
		if($estado_pol==4){
			foreach($productos as $id_cantidad){
			$datoProducto=explode(":",$id_cantidad);
			$this->OnlineSale->create();
			$producto=null;
			$this->Product->recursive=-1;
			$producto=$this->Product->read(null,$datoProducto[0]);
			$OnlineSale=array(
				"OnlineSale"=>array(
					"user_id"=>$extra1,
					"product_id"=>$producto["Product"]["id"],
					"category_id"=>$producto["Product"]["category_id"],
					"codigo_venta"=>$ref_venta,
					"cantidad"=>$datoProducto[1],//cantidad
					"valor_unit"=>$producto["Product"]["valor_venta"],
					"subtotal"=>$producto["Product"]["valor_venta"]-$producto["Product"]["valor_iva"],
					"valor_iva"=>$producto["Product"]["valor_iva"],
					"valor_total"=>$producto["Product"]["valor_venta"]*$datoProducto[1]//cantidad
				)
			);
			$this->OnlineSale->save($OnlineSale);
			$this->OnlineSale->id=0;
			$user=$this->User->read(null, $extra1);
			if($user["User"]["role_id"]==4){
					$user["User"]["role_id"]=5;
					$this->User->save($user);
				}
			}
				
		}else{
			
		}
		$this->autoRender=false;
		exit(0);
		return;

	}
	function respuesta(){
		$ref_pol=$_GET['ref_pol'];
		$codigo_respuesta_pol=$_GET["codigo_respuesta_pol"];
		$valor=$_GET["valorPesos"];		
	}
	function checkout(){
		$shopCart=$this->Session->read("shopCart");
		$totalVenta=0;
		$totalIva=0;
		$totalBase=0;
		$extra2="";// ids de todos los productos separados pro comas
		$userId=$this->Session->read("Auth.User.id");
		$extra1=$userId;
		//$this->Session->delete("shopCart");
		//debug($shopCart);
		//debug($this->data);
		foreach($this->data["OnlineSale"] as $id=>$cantidad){
			//Actualiza el shopCar con los nuevos valores
			$shopCart["items"][$id]["cantidad"]=$cantidad["cantidad"];
			$totalVenta+=$shopCart["items"][$id]["valor_venta"]*$cantidad["cantidad"];
			$totalIva+=$shopCart["items"][$id]["valor_iva"]*$cantidad["cantidad"];
			$totalBase+=$shopCart["items"][$id]["valor_base"]*$cantidad["cantidad"];
			$extra2.="$id:".$cantidad['cantidad'].",";
		}
		$shopCart["total"]=$totalVenta;
		$this->Session->write("shopCart",$shopCart);
		//debug($shopCart);
		$extra2=substr($extra2,0,strlen($extra2)-1);
		$llave_encripcion = Configure::read("llaveEncripcion");
		$usuarioId=Configure::read("userId");
		$refVenta=$userId."-".strtotime("now");
		$valor=$totalVenta;
		$iva=$totalIva;
		$baseDevolucionIva=$totalBase;
		$moneda="COP";
		$descripcion = "Pruebas de Generacion de Firmas";
		$firma= "$llave_encripcion~$usuarioId~$refVenta~$valor~$moneda";      
		$firma_codificada = md5($firma);
		

		$this->set(compact("extra1","extra2","llave_encripcion","usuarioId","refVenta","valor","iva","baseDevolucionIva","moneda","descripcion","firma","firma_codificada"));
	} 

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para la venta online', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OnlineSale->delete($id)) {
			$this->Session->setFlash(__('Venta online eliminada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Venta online no pudo ser eliminada', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->OnlineSale->recursive = 0;
		$this->set('onlineSales', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Venta online inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('onlineSale', $this->OnlineSale->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OnlineSale->create();
			if ($this->OnlineSale->save($this->data)) {
				$this->Session->setFlash(__('Venta online guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La venta online no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$users = $this->OnlineSale->User->find('list');
		$products = $this->OnlineSale->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Venta online inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OnlineSale->save($this->data)) {
				$this->Session->setFlash(__('La venta online modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificada la venta online. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OnlineSale->read(null, $id);
		}
		$users = $this->OnlineSale->User->find('list');
		$products = $this->OnlineSale->Product->find('list');
		$this->set(compact('users', 'products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para la venta online', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OnlineSale->delete($id)) {
			$this->Session->setFlash(__('Venta online eliminada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Venta online no pudo ser eliminada', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_reporte_ventas()
	{
		
		//debug($this->data); exit;
		
		parent::checkPermiso('reportes');
		if(!empty($this->data))
		{
			//debug($this->data);
			$fecha1=$this->data['Parametro']['fecha_inicial'];
		    $fecha2=$this->data['Parametro']['fecha_final'];
			$categoria=$this->data['Parametro']['categoria'];
			$producto=$this->data['Parametro']['producto'];
		
		
		$fields=array();
			
			foreach($this->data['Reporte'] as $indice =>$valor)
			{
				if($valor==1)
				{
					$fields[] = $indice;
				}
			}
		//debug($fields);
		if(count($fields)==2){
			$fields=array_keys($this->data["Reporte"]);
			//debug($fields);
				if($key=array_search("updated", $fields, true)){
					unset($fields[$key]);
				}
		}
		
		//Filtros de la condición
			$reportes=array();
			$reportes=array('OnlineSale.category_id'=>$categoria, 
							'OnlineSale.product_id'=>$producto);	
							
		//Array de condiciones	
			$condiciones=array();
			foreach($reportes as $indice => $valor)
			{
				if($valor!="" && $valor!=0)
				{
					array_push($condiciones, array($indice=>array($valor)));
				}
			}
			
			//Si las fechas son diferentes de vacia
			if($fecha1!=null or $fecha2!=null)
			{
				if($fecha1 > $fecha2)
				{
					$this->Session->setFlash(__('La fecha inicial debe ser menor a la fecha final', true));
					$categorias = $this->OnlineSale->Category->find('list');
					$this->set(compact('categorias'));
					return;
				}
				
	
					list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia);
					
					list($ano, $mes, $dia) = explode("-",$fecha2);
					$fecha2 = $ano."-".$mes."-".($dia+1);
					
					$fechas = array('OnlineSale.created between ? and ?'=>array($fecha1, $fecha2));
				//}
				
				//debug($fechas);
				array_push($condiciones,$fechas);
				
			}else 
			
			{
				
				$fechaActual=getdate();
				$fechaActual=$fechaActual["year"]."-".$fechaActual["mon"]."-".$fechaActual["mday"]=$fechaActual["mday"]+1;
				$fechas = array("OnlineSale.created <="=>$fechaActual);
				array_push($condiciones, $fechas);
			}
			
			
			$reporte=$this->OnlineSale->recursive=-1;
			if(count($fields)>2){
				$reporte=$this->OnlineSale->find("all", array("fields"=>$fields,"conditions"=>$condiciones));
			}else {
				$reporte=$this->OnlineSale->find("all", array("conditions"=>$condiciones));
			}
		///	debug($condiciones);
			$rpt=array();
			for($i=0;$i<=count($reporte)-1; $i++)
			{
				$j=1;
				foreach($reporte[$i]["OnlineSale"] as $key => $value ){
					if($key=="user_id"){
						$this->OnlineSale->User->recursive=0;
						$valor=$this->OnlineSale->User->find("first",array("fields"=>array("numero_identificacion"),
																"conditions"=>array("User.id"=>$value)));
						$rpt[$i][$j]=$valor["User"]["numero_identificacion"];
					}else if($key=="product_id"){
						$this->OnlineSale->Product->recursive=0;
						$valor=$this->OnlineSale->Product->find("first",array("fields"=>array("codigo"),
																"conditions"=>array("Product.id"=>$value)));
						$rpt[$i][$j]=$valor["Product"]["codigo"];
					}else {
						if($key!="updated"){
							
							$rpt[$i][$j]=$key=$value;
						}
						
					}
					$j++;
				}
			}
			
			//debug($rpt); exit;
			if(isset($rpt)){
				$reporte=$rpt;
			}
			
			$this->set(compact("reporte", "fields"));
		}
		else 
		{
			$categorias = $this->OnlineSale->Category->find("list", array("fields"=>array("id", "nombre")));
			$productos = $this->OnlineSale->Product->find("list", array("fields"=>array("id", "nombre")));
			$this->set(compact("categorias","productos"));
		}
		 
		$this->layoutReporte("Reporte Ventas");
	}
	
	function admin_reporte_ventas_graficas()
	{
		//Configure::write('debug', 1);
		parent::checkPermiso('reportes');
		if(!empty($this->data))
		{
			//debug($this->data); exit;
			$fecha1=$this->data['Reporte']['fecha_inicial'];
			$fecha2=$this->data['Reporte']['fecha_final'];
			$categoria=$this->data["Parametros"]["categoria"];
			$producto=$this->data["OnlineSale"]["product_id"];
			$this->set(compact("fecha1","fecha2","categoria","producto"));
			//Filtros de la condición
			if($categoria==0)
			{
				$categoria=NULL;
			}
			if ($producto==0 or $producto=="")
			{
				$producto=NULL;
			}
			
			
			$reportes=array();
			
			$reportes=array('OnlineSale.category_id'=>$categoria, 
							'OnlineSale.product_id'=>$producto);	
							
		//Array de condiciones	
			$condiciones=array();
			foreach($reportes as $indice => $valor)
			{
				if($valor!="")
				{
					array_push($condiciones, array($indice=>array($valor)));
				}
			}
			
			if($fecha1>$fecha2)
			{
				$this->Session->setFlash(__('La fecha inicial debe ser menor a la fecha final', true));
				$categorias=$this->OnlineSale->Category->find('list', array("fields"=>array("id","nombre")));
		        $productos=$this->OnlineSale->Product->find('list', array("fields"=>array("id","nombre")));
				$this->set(compact('categorias',"productos"));
				return;
			}
			
			if($fecha1!=null && $fecha2!=null)
			{
				list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia);
					
				list($ano, $mes, $dia) = explode("-",$fecha2);
					$fecha2 = $ano."-".$mes."-".($dia+1);
					
				$fechas = array('OnlineSale.created between ? and ?'=>array($fecha1, $fecha2));	
				array_push($condiciones,$fechas);
			}else {
			
				
				$fechaActual=getdate();
				$fechaActual=$fechaActual["year"]."-".$fechaActual["mon"]."-".$fechaActual["mday"]=$fechaActual["mday"]+1;
				$fechas = array("OnlineSale.created <="=>$fechaActual);
				array_push($condiciones, $fechas);
			
			}
			
			$this->OnlineSale->recursive=-1;
			if(empty($condiciones))
			{
				$reporte=$this->OnlineSale->find("all");
				//debug($condiciones);
			}
			else 
				{
					
					$reporte=$this->OnlineSale->find("all", array("conditions"=>$condiciones));
					//debug($condiciones);
				}
			
			//debug($condiciones); exit;
			$rpt=array();
			if(!empty($reporte))
			{
				//Depuro el array para obtener solo los productos vendidos
				for($i=0;$i<=count($reporte)-1;$i++)
				{
					foreach($reporte[$i]["OnlineSale"] as $llave=>$valor)
					{
						if($llave=="product_id")
						{
							$productos[]=$valor;
						}
							
					}
				}
				
				//debug($productos);
				$cantidadTotal=count($productos);
				$i=0;
				foreach($productos as $key => $value)
				{
					$cantidad=0;
					foreach($productos as $indice => $valor)
					{
						if($valor==$value)
						{
							$cantidad++;
						}
					}
					
					$definitivo[$value]=$cantidad;
				}
				
				//debug($definitivo);
				$this->OnlineSale->Product->recursive=-1;
				foreach($definitivo as $key=>$value)
				{
					$porcentaje="";
					$porcentaje= ($value * 100) / $cantidadTotal;
					$nombre=$this->OnlineSale->Product->find("first", array("conditions"=>array("Product.id"=>$key),"fields"=>array("nombre")));
					$nombre=$nombre["Product"]["nombre"];
					$rpt[]=array("producto_id"=>$key,"nombre"=>$nombre, "cantidad_vendida"=>$value, "porcenjate"=>$porcentaje);
				}
		
		//debug($fechas);		
		//debug($rpt);
				$this->set(compact("rpt"));
				
			}else {
				$this->set(compact("rpt"));
			}
		}
		
		$categorias=$this->OnlineSale->Category->find('list', array("fields"=>array("id","nombre")));
		$productos=$this->OnlineSale->Product->find('list', array("fields"=>array("id","nombre")));
		
		
		
		$this->set(compact("categorias","productos"));
		
	$this->layoutReporte("Reporte Ventas");
	//$this->layout="graficapdf";
	}

	
	function admin_reporte_ventas_categorias()
	{
		parent::checkPermiso('reportes');
		if(!empty($this->data))
		{
			
			//$fecha1=$this->data['Reporte']['fecha_inicial'];
			//$fecha2=$this->data['Reporte']['fecha_final'];
			//$fechas = array('OnlineSale.created between ? and ?'=>array($fecha1, $fecha2));	
			//debug($this->data); exit;
			$categoria=$this->data["Parametro"]["categoria"];
			$this->OnlineSale->recursive=-1;
			$reporte=$this->OnlineSale->find("all", array("conditions"=>array("OnlineSale.category_id"=>$categoria)));
			
			//debug($reporte); exit;
			//Depuro el array para obtener solo los productos vendidos
			for($i=0;$i<=count($reporte)-1;$i++)
			{
				foreach($reporte[$i]["OnlineSale"] as $llave=>$valor)
				{
					if($llave=="product_id")
					{
						$productos[]=$valor;
					}
						
				}
			}
			
			//debug($productos);
			$cantidadTotal=count($productos);
			$i=0;
			foreach($productos as $key => $value)
			{
				$cantidad=0;
				foreach($productos as $indice => $valor)
				{
					if($valor==$value)
					{
						$cantidad++;
					}
				}
				
				$definitivo[$value]=$cantidad;
			}
			
			//debug($definitivo);
			$this->OnlineSale->Product->recursive=-1;
			foreach($definitivo as $key=>$value)
			{
				$porcentaje="";
				$porcentaje= ($value * 100) / $cantidadTotal;
				$nombre=$this->OnlineSale->Product->find("first", array("conditions"=>array("Product.id"=>$key),"fields"=>array("nombre")));
				$nombre=$nombre["Product"]["nombre"];
				$rpt[]=array("producto_id"=>$key,"nombre"=>$nombre, "cantidad_vendida"=>$value, "porcenjate"=>$porcentaje);
			}
			
	
			//debug($rpt);  exit;
			$this->set(compact("rpt"));
		}
		
		
		$categorias = $this->OnlineSale->Category->find("list", array("fields"=>array("id", "nombre")));
		
		$this->set(compact("categorias"));
		/*
		if(!empty($this->data))
		{
			$fecha1=$this->data['Parametro']['fecha_inicial'];
		    $fecha2=$this->data['Parametro']['fecha_final'];
			$categoria=$this->data['Parametro']['categoria'];
			$producto=$this->data['Parametro']['producto'];
		
		
		$fields=array("id");
			
			foreach($this->data['Reporte'] as $indice =>$valor)
			{
				if($valor==1)
				{
					$fields[] = $indice;
				}
			}
			
		//Filtros de la condición
			$reportes=array();
			$reportes=array('OnlineSale.category_id'=>$categoria, 
							'OnlineSale.product_id'=>$producto);	
							
		//Array de condiciones	
			$condiciones=array();
			foreach($reportes as $indice => $valor)
			{
				if($valor!="")
				{
					array_push($condiciones, array($indice=>array($valor)));
				}
			}
			
			//Si las fechas son diferentes de vacia
			if($fecha1!=null or $fecha2!=null)
			{	
				$fechas = array('OnlineSale.created between ? and ?'=>array($fecha1, $fecha2));	
				
				//$fecha1=strtotime($fecha1);
				//$fecha2=strtotime($fecha2);
			
				if($fecha1 > $fecha2)
				{
					$this->Session->setFlash(__('La fecha inicial debe ser menor a la fecha final', true));
					$categorias = $this->OnlineSale->Category->find('list');
					$this->set(compact('categorias'));
					return;
				}
				
				array_push($condiciones,$fechas);
			}
			
			
			if(count($fields)==2)
			{
				$fields=array();
				$fields=$this->titulos($fields);
			}
			
		
			$reporte=$this->OnlineSale->find("all", array("fields"=>$fields,"conditions"=>$condiciones));
			$titulos=$this->titulos($fields);					
			$reporte=$this->remplazo($reporte);
			$this->set(compact("reporte", "titulos"));
		}
		else 
		{
			$categorias = $this->OnlineSale->Category->find("list", array("fields"=>array("id", "nombre")));
			$productos = $this->OnlineSale->Product->find("list", array("fields"=>array("id", "nombre")));
			$this->set(compact("categorias","productos"));
		}
		 * 
		 */
		$this->layoutReporte();
	}

	function admin_reporte_ventas_usuarios()
	{
		parent::checkPermiso('reportes');
		if(!empty($this->data))
		{
			$fecha1=$this->data["Reporte"]["fecha_inicial"];
			$fecha2=$this->data["Reporte"]["fecha_final"];
			$identificacion=$this->data["Reporte"]["email"];
			
			$condiciones=array("");
			if(!empty($identificacion)) {
				$userId=$this->OnlineSale->User->recursive=-1;
				$userId=$this->OnlineSale->User->find("first", array("fields"=>array("id", "email"),
													  "conditions"=>array("User.email"=>$identificacion)));
				//debug($userId); exit;
				$condiciones=array('OnlineSale.user_id'=>$userId["User"]["id"]);
			}
			
			//Campos a mostrar
			$campos=array();
		
			foreach($this->data["Campos"] as $key => $value ) {
					if($value==1) {
						  	$campos[]=$key;
						}
					}
				
			if(empty($campos)){
				$campos=array_keys($this->data["Campos"]);
				if($key=array_search("updated", $campos, true)){
					unset($campos[$key]);
				}
				
			}
					
			if($fecha1>$fecha2){
				$this->Session->setFlash(__('La fecha inicial debe ser menor a la fecha final', true));
				return;
			}
			if($fecha1!=null && $fecha2!=null) {
				list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia);
					
				list($ano, $mes, $dia) = explode("-",$fecha2);
					$fecha2 = $ano."-".$mes."-".($dia+1);
					
				$fechas = array('OnlineSale.created between ? and ?'=>array($fecha1, $fecha2));	
				array_push($condiciones,$fechas);
			}
			else {
				
				$fechaActual=getdate();
				$fechaActual=$fechaActual["year"]."-".$fechaActual["mon"]."-".$fechaActual["mday"]=$fechaActual["mday"]+1;
				$fechas = array("OnlineSale.created <="=>$fechaActual);
				array_push($condiciones, $fechas);
			}
			
		
			//$this->OnlineSale->recursive=1;
			$reporte=$this->OnlineSale->find("all", array("fields"=>$campos, "conditions"=>$condiciones));
			
			//debug($reporte); exit;
			$rpt=array();
			for($i=0;$i<=count($reporte)-1; $i++)
			{
				$j=1;
				foreach($reporte[$i]["OnlineSale"] as $key => $value ){
					if($key=="product_id"){
						$this->OnlineSale->Product->recursive=0;
						$valor=$this->OnlineSale->Product->find("first",array("fields"=>array("nombre"),
																"conditions"=>array("Product.id"=>$value)));
						$rpt[$i][$j]=$valor["Product"]["nombre"];
					}else if($key=="category_id"){
						$this->OnlineSale->Category->recursive=0;
						$valor=$this->OnlineSale->Category->find("first",array("fields"=>array("nombre"),
																"conditions"=>array("Category.id"=>$value)));
						$rpt[$i][$j]=$valor["Category"]["nombre"];
					}else if($key=="user_id"){
						$this->OnlineSale->User->recursive=0;
						$valor=$this->OnlineSale->User->find("first",array("fields"=>array("numero_identificacion","email"),
																"conditions"=>array("User.id"=>$value)));
						$rpt[$i][$j]=$valor["User"]["email"];
					}else {
						$rpt[$i][$j]=$key=$value;
					}
					$j++;
				}
			}
			if(isset($rpt)){
				$reporte=$rpt;
			}
			
			$this->set(compact("reporte", "campos"));
		}
	$this->layoutReporte();
	}
	
	
	function titulos($array) {
		$titles=array();		
		$titles=array("id"=>"Id",
						"id_cuenta"=>"Cuenta",
						"user_id"=>"Usuario",
						"product_id"=>"Producto",
						"codigo_venta"=>"Codigo venta",
						"cantidad"=>"Cantidad",
						"porcentaje_iva"=>"Porcentaje IVA",
						"valor_unit"=>"Valor unitario",
						"subtotal"=>"Subtotal",
						"valor_iva"=>"Valor IVA",
						"valor_total"=>"Valor Total",
						"created"=>"Fecha");
		
		if( count($array)==0 ) {
			foreach($titles as $key=>$value) {
						$array[]=$key;
						//echo "Hola mundo";
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
						if($k=="product_id") {
							$valor = $this->OnlineSale->Product->find("list", 
													array('recursive' => 0 ,'fields'=>array('nombre'),
													'conditions'=>array('Product.id'=>$v)));						
							foreach($valor as $key=>$value) {
								$rpt[$i][$j++]=$value;
							}
						} else if($k=="user_id") {
							$valor = $this->OnlineSale->User->find("list", 
													array('recursive' => 0 ,'fields'=>array('primer_nombre'),
													'conditions'=>array('User.id'=>$v)));						
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

}
?>