<?php
class ProductsController extends AppController {

	var $name = 'Products';
	 var $helpers = array('Excel'); 

   function beforeFilter()
	{
		
		parent::beforeFilter();
		$this->Auth->allow('viewShopCart','view','index','shopCart','deleteOfCart','search','viewPdf',"promocionados");
	}
	function admin_prueba(){
		$this->layout="excel";
        $this->set('product', $this->Product->find("all")); 
	}
	function admin_resetFicha($id){
		$this->Product->recursive=-1;
		$product=$this->Product->read(null,$id);
		$product["Product"]["ficha_producto"]="";
		$this->Product->save($product);
		$this->redirect($this->referer());
	}
	function admin_resetDestacar($id){
		$this->Product->recursive=-1;
		$product=$this->Product->read(null,$id);
		$product["Product"]["imagen_destacar"]="";
		$product["Product"]["destacar"]=false;
		$this->Product->save($product);
		$this->redirect($this->referer());
	}
	function viewPdf()
    {
       
       // Configure::write('debug',0); // Otherwise we cannot use this method while developing      

       $this->layout = 'pdf'; //this will use the pdf.ctp layout
       $this->render();
    } 
	function admin_chart(){
		
	}
	function promocionados(){
		$promocionados=$this->Product->query("SELECT *
												FROM `products` AS Product
												WHERE promocionar =1
												AND inventario >0
												ORDER BY rand( )
												LIMIT 0 , 6");
		return  $promocionados;
	}
	function getProducts(){
		$this->Product->recursive=-1;
		echo json_encode($this->Product->find("all",array("fields"=>array("id","nombre","codigo"),"conditions"=>array("OR"=>array("Product.nombre LIKE"=>"%".$_GET["query"]."%","Product.codigo LIKE"=>"%".$_GET["query"]."%")))));
		configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	function getProductosComprados(){
		$userId=$this->Session->read("Auth.User.id");
		
		$productos=$this->Product->OnlineSale->find("all",array("conditions"=>array("user_id"=>$userId)));
		return $productos;
	}
	function index() {
		$this->Product->recursive = 0;
		$productosDestacados=$this->Product->find("all",array("conditions"=>array("destacar"=>true,"estado"=>"Activo","Product.inventario >"=>0)));
		$productosPromocionados=$this->Product->find("all",array("conditions"=>array("promocionar"=>true,"estado"=>"Activo","Product.inventario >"=>0)));
		//debug($productosDestacados);
		$this->set(compact("productosDestacados"));
		$this->set(compact("productosPromocionados"));
		$this->paginate=array("limit"=>"6","conditions"=>array("estado"=>"Activo","inventario >"=>0));
		
		$this->set('products', $this->paginate());
	}
	function search(){
		$this->Product->recursive = 0;
		$productosDestacados=$this->Product->find("all",array("conditions"=>array("destacar"=>true,"estado"=>"Activo","Product.inventario >"=>0)));
		$productosPromocionados=$this->Product->find("all",array("conditions"=>array("promocionar"=>true,"estado"=>"Activo","Product.inventario >"=>0)));
		//debug($productosDestacados);
		$this->set(compact("productosDestacados"));
		$this->set(compact("productosPromocionados"));
		$this->paginate=array("limit"=>"6","conditions"=>array("estado"=>"Activo","inventario >"=>0,"OR"=>array("Product.nombre like"=>"%".$this->data["Product"]["search"]."%","Product.descripcion like"=>"%".$this->data["Product"]["search"]."%")));
		//debug($this->Product->find("all",array("conditions"=>array("OR"=>array("Product.nombre LIKE"=>"%".$this->data["Product"]["search"]."%","Product.descripcion LIKE"=>"%".$this->data["Product"]["search"]."%")))));
		$this->set('products', $this->paginate());
	}
	function viewShopCart(){
		$this->set('shopCart', $this->Session->read("shopCart"));
	}
	function deleteOfCart(){
		$id=$_GET["id"];
		$shopCart=$this->Session->read("shopCart");
		unset($shopCart["items"][$id]);
		
		$valor=0;
			foreach($shopCart["items"] as $item){
				$valor+=$item["valor_venta"]*$item["cantidad"];
			}
		$shopCart["count_items"]=count($shopCart["items"]);
		$shopCart["total"]=$valor;	
		$this->Session->write("shopCart",$shopCart);
		echo json_encode($shopCart);
		Configure::write("debug",0);
		exit(0);
		
	}
	function shopCart(){
		$id=$_GET["id"];
		$shopCart=$this->Session->read("shopCart");
			if(isset($shopCart["items"][$id])){
				$shopCart["items"][$id]["cantidad"]+=1;
			}else{
				$this->Product->recursive=-1;
				$producto=$this->Product->read(null,$id);
					$shopCart["items"][$id]["nombre"]=$producto["Product"]["nombre"];
					$shopCart["items"][$id]["inventario"]=$producto["Product"]["inventario"];
					$shopCart["items"][$id]["id"]=$producto["Product"]["id"];
					$shopCart["items"][$id]["imagen_listado"]=$producto["Product"]["imagen_listado"];
					$shopCart["items"][$id]["valor_iva"]=$producto["Product"]["valor_iva"];
					//$shopCart["items"][$id]["valor_venta"]=$producto["Product"]["valor_venta"];
					$shopCart["items"][$id]["valor_base"]=$producto["Product"]["valor_base"];
					$shopCart["items"][$id]["valor_venta"]=$producto["Product"]["valor_venta"];
					$shopCart["items"][$id]["cantidad"]=1;
					
			}
			$valor=0;
			foreach($shopCart["items"] as $item){
						$valor+=$item["valor_venta"]*$item["cantidad"];
					}
			$shopCart["count_items"]=count($shopCart["items"]);
			$shopCart["total"]=$valor;
		$this->Session->write("shopCart",$shopCart);
		echo json_encode($shopCart);
		Configure::write("debug",0);
		exit(0);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	

	

	
	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Product->recursive = 0;		
		$this->set('products', $this->paginate());
	}
	function admin_activar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
 		$this->Product->id=$id;
    	$this->Product->saveField("estado_prod",true);
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_desactivar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->id=$id;
    	$this->Product->saveField("estado","Inativo");
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_destacar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->id=$id;
    	$this->Product->saveField("destacar",true);
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_nodestacar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->id=$id;
    	$this->Product->saveField("destacar",false);
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_promocionar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->id=$id;
    	$this->Product->saveField("promocionar",true);
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_nopromocionar($id = null){
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->id=$id;
    	$this->Product->saveField("promocionar",false);
		$this->Session->setFlash(__('La información del producto se ha modificado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_view($id = null) {
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}
	function admin_visualizar($id = null) {
	parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}
	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)){				
			//VALIDACION IMAGEN DESTACAR
			if($this->data['Product']['destacar']&&$this->data['Product']['imagen_destacar']["error"]==4){
				$this->Session->setFlash(__('Para destacar un producto debe asociarle su imagen para destacar', true));
				//debug("error");
				return;
			}
			//Imagenes
			//debug($this->data); exit;
			$fichaProducto = $this->data['Product']['ficha_producto'];
			$imgListado = $this->data['Product']['imagen_listado'];
			$imgPrincipal = $this->data['Product']['imagen_principal'];
			$imgDestacar = $this->data['Product']['imagen_destacar'];
		
		    
			//Por defecto vacios
			$this->data['Product']['ficha_producto']="";
			$this->data['Product']['imagen_ficha_tecnica']="";
			$this->data['Product']['imagen_listado']="";
			$this->data['Product']['imagen_principal']="";
			$this->data['Product']['imagen_destacar']="";
			
			//Validamos las imagenes opcionales, sino tienen errores entonces las subimos
			if($fichaProducto['error']==0)
			{
				$nombreOriginal=$fichaProducto['name'];
				$nombreRetornado = $this->uploadPicture($fichaProducto, $nombreOriginal, "archivo");
				$this->data['Product']['ficha_producto']="fotos".DS.$nombreRetornado;
			}
			
			//imagen_listado
			if($imgListado['error']==0)
			{
				$nombreOriginal=$imgListado['name'];
				$nombreRetornado = $this->uploadPicture($imgListado, $nombreOriginal);
				$this->data['Product']['imagen_listado']="fotos".DS.$nombreRetornado;
			}
			
			//imagen_principal
			if($imgPrincipal['error']==0)
			{
				$nombreOriginal=$imgPrincipal['name'];
				$nombreRetornado = $this->uploadPicture($imgPrincipal, $nombreOriginal);
				$this->data['Product']['imagen_principal']="fotos".DS.$nombreRetornado;
			}
			
			//imagen_destacar
			if($imgDestacar['error']==0)
			{
				$nombreOriginal=$imgDestacar['name'];
				$nombreRetornado = $this->uploadPicture($imgDestacar, $nombreOriginal);
				$this->data['Product']['imagen_destacar']="fotos".DS.$nombreRetornado;
			}
			
			
		
			//debug($this->data); exit;
			$this->Product->create();
			
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('Producto guardado', true));
				parent::saveAudit("Product","Add", $this->Product->id,$this->data["Product"]["codigo"]);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El producto no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		//	debug($this->data);
		}
		$categories = $this->Product->Category->find('list');
		$manufacturers = $this->Product->Manufacturer->find('list');
		$this->set(compact('categories', 'manufacturers'));
	}

	function admin_edit($id = null) 
	{
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Producto inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) 
		{
			//debug($this->data); exit;
			
			//Imagenes
			//debug($this->data); exit;
			
			$directorio = WWW_ROOT."img".DS;
			//$directorio = str_replace("\\", "/", $directorio);
			
			$fichaProducto = $this->data['Product']['ficha_producto'];
			$imgListado = $this->data['Product']['imagen_listado'];
			$imgPrincipal = $this->data['Product']['imagen_principal'];
			$imgDestacar = $this->data['Product']['imagen_destacar'];
		
			$fichaProductoOriginal = $this->data['Imagenes']['ficha_producto'];
			$imgListadoOriginal = $this->data['Imagenes']['imagen_listado'];
			$imgPrincipalOriginal = $this->data['Imagenes']['imagen_principal'];
			$imgDestacarOriginal = $this->data['Imagenes']['imagen_destacar'];
			//$imgFichaTecnicaOriginal = $this->data['Imagenes']['imagen_ficha_tecnica'];
			
			//Validamos las imagenes opcionales, sino tienen errores entonces las subimos
			
			//Ficha producto ***********************************************************
			if ($fichaProducto['error']==0) 
			{
				$nombreOriginal=$fichaProducto['name'];
				$nombreRetornado = $this->uploadPicture($fichaProducto, $nombreOriginal, "archivo");
				$this->data['Product']['ficha_producto']="fotos".DS.$nombreRetornado;
				
			} else if ($fichaProducto['error']==4) {
				
			   //Para que omita la validación
				unset($this->data['Product']['ficha_producto']);
				
			   if (!empty($this->data['Imagenes']['ficha_producto']))
				{
					$imagen = $this->data['Imagenes']['ficha_producto'];
					$this->data['Product']['ficha_producto']=$imagen;
				}
				else 
				{
					$this->data['Product']['ficha_producto']="";
				}

			}
			
						
			//imagen_listado *******************************************************************
			if ($imgListado['error']==0)
			{
				$nombreOriginal=$imgListado['name'];
				$nombreRetornado = $this->uploadPicture($imgListado, $nombreOriginal);
				$this->data['Product']['imagen_listado']="fotos".DS.$nombreRetornado;
			
				
			} else if($imgListado['error']==4) {
							
				//Para que omita la validación
				unset($this->data['Product']['imagen_listado']);
				
				if (!empty($this->data['Imagenes']['imagen_listado']))
				{
					$imagen = $this->data['Imagenes']['imagen_listado'];
					$this->data['Product']['imagen_listado']=$imagen;
				}
				else 
				{
					$this->data['Product']['imagen_listado']="";
				}
	
			}
			
			//imagen_principal
			if($imgPrincipal['error']==0)
			{
				$nombreOriginal=$imgPrincipal['name'];
				$nombreRetornado = $this->uploadPicture($imgPrincipal, $nombreOriginal);
				$this->data['Product']['imagen_principal']="fotos".DS.$nombreRetornado;
				
				
			} else if($imgPrincipal['error']==4) {
					//Para que omita las validaciones
				//$this->Product->validate = array('validate' => false);
				
				unset($this->data['Product']['imagen_principal']);
				
				if (!empty($this->data['Imagenes']['imagen_principal']))
				{
					$imagen = $this->data['Imagenes']['imagen_principal'];
					$this->data['Product']['imagen_principal']=$imagen;
				}
				else 
				{
					$this->data['Product']['imagen_principal']="";
				}
				
			}
			
			//imagen_destacar
			if ($imgDestacar['error']==0) {
				$nombreOriginal=$imgDestacar['name'];
				$nombreRetornado = $this->uploadPicture($imgDestacar, $nombreOriginal);
				$this->data['Product']['imagen_destacar']="fotos".DS.$nombreRetornado;
			

			} else if($imgDestacar['error']==4)
			{
				//Para que omita la validación
				unset($this->data['Product']['imagen_destacar']);
				
				if (!empty($this->data['Imagenes']['imagen_principal']))
				{
					$imagen = $this->data['Imagenes']['imagen_destacar'];
					$this->data['Product']['imagen_destacar']=$imagen;
				}
				else 
				{
					$this->data['Product']['imagen_destacar']="";
				}
				
			}

            //$this->Product->validate = array('validate' => false);
			
			//debug($this->data['Product']); exit;
			//VALIDACION IMAGEN DESTACAR

			if($this->data['Product']['destacar']&&($this->data['Product']['imagen_destacar']==""||$this->data['Product']['imagen_destacar']["error"]==4)){
				$this->Session->setFlash(__('Para destacar un producto debe asociarle su imagen para destacar', true));
				//debug("error");
				return;
			}
		//debug($this->data);
			if ($this->Product->save($this->data) ) 
			{
				
				
				if ($fichaProducto['error']==0) 
				{
					//Removemos la antigua imagen
					if (!empty($this->data['Imagenes']['ficha_producto']))
					{
						$imagen = $this->data['Imagenes']['ficha_producto'];
						//echo $imagen;
						unlink($directorio.$imagen);
					}
					
				}
			    
				if ($imgListado['error']==0)
				{
					//Removemos la antigua imagen
					if (!empty($this->data['Imagenes']['imagen_listado']))
					{
						$imagen = $this->data['Imagenes']['imagen_listado'];
						//echo $imagen;
						unlink($directorio.$imagen);
					}
					
				}
			
				//imagen_principal
				if($imgPrincipal['error']==0)
				{					
					//Removemos la antigua imagen
					if (!empty($this->data['Imagenes']['imagen_principal']))
					{
						$imagen = $this->data['Imagenes']['imagen_principal'];
						//echo $imagen;
						unlink($directorio.$imagen);
					}
					
				}
				
				//imagen_destacar
				if ($imgDestacar['error']==0) {
									
					//Removemos la antigua imagen
					if (!empty($this->data['Imagenes']['imagen_destacar']))
					{
						$imagen = $this->data['Imagenes']['imagen_destacar'];
						//echo $imagen;
						unlink($directorio.$imagen);
					}
	
				}
			
				
					
				$this->Session->setFlash(__('Producto modificado.', true));
				parent::saveAudit("Product","Edit", $this->Product->id,$this->data["Product"]["codigo"]);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El producto no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
   
		if (empty($this->data)) {
			
			$this->data = $this->Product->read(null, $id);
			//echo "Hola mundo"; exit;
			
		}
		$categories = $this->Product->Category->find('list');
		$manufacturers = $this->Product->Manufacturer->find('list');
		$this->set(compact('categories', 'manufacturers'));
	}

	function admin_delete($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el producto', true));
			$this->redirect(array('action'=>'index'));
		}
		$producto=$this->Product->read(null,$id);
		if ($this->Product->delete($id)) {
			
			$this->Session->setFlash(__('Producto eliminado', true));
			parent::saveAudit("Product","Delete", $id,$producto["Product"]["codigo"]);
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El producto no fue eliminado', true));
		$this->redirect(array('action' => 'index'));
	}
	

	function admin_product_report()
	{
		parent::checkPermiso('reportes');
		if(empty($this->data))
		{	
			$categorias = $this->Product->Category->find('list');
			$this->set(compact('categorias'));
		}
		else if($this->data)
		{
			//Parametros del reporte
			$categoria=$this->data['Reporte']['categoria'];
			$estado=$this->data['Reporte']['estado'];
			$rotacion=$this->data['Reporte']['rotacion'];
			//Fecha 1	
		    $fecha1=$this->data['Reporte']['fecha_inicial'];
			//Fecha 2
		    $fecha2=$this->data['Reporte']['fecha_final'];					   
		    //Campos a mostrar en el reporte
		    $fields=array();
			
			foreach($this->data['Product'] as $indice =>$valor)
			{
				if($valor==1)
				{
					$fields[] = $indice;
				}
			}
			//Filtros de la condición
			$reportes=array();
			$reportes=array('Product.category_id'=>$categoria, 
							'Product.estado'=>$estado,
							'Product.rotacion'=>$rotacion);	
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
				list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia);
					
				list($ano, $mes, $dia) = explode("-",$fecha2);
					$fecha2 = $ano."-".$mes."-".($dia+1);
						
				$fechas = array('Product.created between ? and ?'=>array($fecha1, $fecha2));	
				
				//$fecha1=strtotime($fecha1);
				//$fecha2=strtotime($fecha2);
			
				if($fecha1 > $fecha2)
				{
					$this->Session->setFlash(__('La fecha inicial debe ser menor a la fecha final', true));
					$categorias = $this->Product->Category->find('list');
					$this->set(compact('categorias'));
					return;
				}
				
				array_push($condiciones,$fechas);
			}else {
				$fechaActual=getdate();
				$fechaActual=$fechaActual["year"]."-".$fechaActual["mon"]."-".$fechaActual["mday"]=$fechaActual["mday"]+1;
				$fechas = array("Product.created <="=>$fechaActual);
				array_push($condiciones, $fechas);
			}

		    if ( count($fields)==0 ) {
				$fields=array_keys($this->data['Product']);			
			}
			
			$this->Product->recursive=-1;
			$reporte = $this->Product->find('all', array('fields'=>$fields,
											'conditions'=>$condiciones));	
			$rpt=array();
			for($i=0;$i<=count($reporte)-1; $i++)
			{
				$j=1;
				foreach($reporte[$i]["Product"] as $key => $value ){
					if($key=="category_id"){
						$this->Product->Category->recursive=-1;
						$valor=$this->Product->Category->find("first",array("fields"=>array("nombre"),
																"conditions"=>array("Category.id"=>$value)));
						$rpt[$i][$j]=$valor["Category"]["nombre"];
					}else if($key=="manufacturer_id"){
						$this->Product->Manufacturer->recursive=-1;
						$valor=$this->Product->Manufacturer->find("first",array("fields"=>array("nombre"),
																"conditions"=>array("Manufacturer.id"=>$value)));
						$rpt[$i][$j]=$valor["Manufacturer"]["nombre"];
					}else {
						$rpt[$i][$j]=$key=$value;
					}
					$j++;
				}
			}
			$categorias = $this->Product->Category->find('list');
			//$this->set(compact('categorias'));
			$this->set(compact('rpt','fields',"categorias"));
			$this->layoutReporte("Reportes de productos");
		}
	}

	//$foto array del archivo
    //nombre_foto es igual al username ya que sera unico
	function uploadPicture($foto, $nombre_foto, $tipo=null)
	{		
		//Caracteristicas de la imagen
		$nombre = $foto['name'];
		$tipo = $foto['type'];
		$tamano = $foto['size'];
		$nombre_foto=md5(sha1($nombre_foto.rand(1,1000)));		
		
		if($tipo==null) {
			//Comprobamos la extensión de la  imagen
			if(strpos($tipo, "gif")) {
				$nombre_foto=$nombre_foto.".gif";
			} else if(strpos($tipo, "jpeg")) {
			    $nombre_foto=$nombre_foto.".jpg";
			}else if(strpos($tipo, "png")) {
				$nombre_foto=$nombre_foto.".png";
			}else {
				return false;
			}
		}else {
			if(strpos($tipo, "pdf")) {
				$nombre_foto=$nombre_foto.".pdf";
				
			} else if(strpos($tipo, "xlsx")) {
			    $nombre_foto=$nombre_foto.".xlsx";
				
			}else if(strpos($tipo, "xls")) {
				$nombre_foto=$nombre_foto.".xls";
				
			}else if(strpos($tipo, "doc")) {
			    $nombre_foto=$nombre_foto.".doc";
				
			}else if(strpos($tipo, "docx")) {
				$nombre_foto=$nombre_foto.".docx";
				
			}else if(strpos($tipo, "txt")) {
				$nombre_foto=$nombre_foto.".txt";
				
			}else if(strpos($tipo, "gif")) {
				$nombre_foto=$nombre_foto.".gif";
				
			} else if(strpos($tipo, "jpeg")) {
			    $nombre_foto=$nombre_foto.".jpg";
				
			}else if(strpos($tipo, "png")) {
				$nombre_foto=$nombre_foto.".png";
			} else {
				return false;
			}
		}
		//Directorio donde sera guardada la imagen
		$directorio = WWW_ROOT."img".DS."fotos".DS.$nombre_foto;
		
			//Copiamos la imagen al directorio, especificado
	   		if (copy($foto["tmp_name"], $directorio))
	   		{
	   			//$this->directorioFoto=$directorio;
			   return $nombre_foto;  
	   		}
	   		else
	   		{ 
			   return 2; 
	   		}
	}
	
	function titulos($array)
	{
		$titles=array();		
		$titles=array("id"=>"Id",
						"category_id"=>"Categorias",
						"manufacturer_id"=>"Manufacturador",
						"nombre"=>"Nombre",
						"descripcion"=>"Descripción",
						"codigo"=>"Código",
						"cod_barras"=>"Código de barras",
						"promocionar"=>"Promocionar",
						"destacar"=>"Destacar",
						"ficha_producto"=>"Ficha producto",
						"inventario"=>"Inventario",
						"stock_minimo"=>"Stock minimo",
						"stock_maximo"=>"Stock maximo",
						"costo"=>"Costo",
						"costo_promedio"=>"Costo promedio",
						"tarifa_iva"=>"Tarifa IVA",
						"valor_iva"=>"Valor IVA",
						"porc_utilidad"=>"Porcentaje utildiad",
						"valor_venta"=>"Valor venta",
						"estado"=>"Estado",
						"rotacion"=>"Rotación",
						"tiempo_reposicion"=>"Tiempo reposición",
						"created"=>"Fecha creación",
						"updated"=>"Fecha actualización");
		
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
						if($k=="category_id") {
							$valor = $this->Product->Category->find("list", 
													array('recursive' => 0 ,'fields'=>array('nombre'),
													'conditions'=>array('Category.id'=>$v)));						
							foreach($valor as $key=>$value) {
								$rpt[$i][$j++]=$value;
							}
						} else if($k=="manufacturer_id") {
							$valor = $this->Product->Manufacturer->find("list", 
													array('recursive' => 0 ,'fields'=>array('nombre'),
													'conditions'=>array('Manufacturer.id'=>$v)));						
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