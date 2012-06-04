<?php
class InventoriesController extends AppController {

	var $name = 'Inventories';
	var $uses=array("Inventory","OnlineSale");
	function getInventory($product_id){
		$inventories=$this->Inventory->find("all",array("conditions"=>array("product_id"=>$product_id)));
			
		return $inventories;
	}
	function admin_movements(){
		parent::checkPermiso('inventarios');
		if (!empty($this->data)) {
			$this->data["InventoryMovement"]["cantidad"]=$this->data["Inventory"]["stock"];
			$elProduct=$this->Inventory->Product->findByCodigo($this->data["Inventory"]["product_codigo"]);
			if($elProduct){
				$this->data["Inventory"]["product_id"]=$elProduct["Product"]["id"];
			}else{
					$this->Session->setFlash(__('Código de producto no valido', true));
					$this->redirect($this->referer());
			}
			//VALIDA LOS DATOS EL INVENTARIO Y DE MOVIMENTO INVENTARIO
			   $this->Inventory->InventoryMovement->set( $this->data );
			   $this->Inventory->set( $this->data );
				if(!$this->Inventory->InventoryMovement->validates()||!$this->Inventory->validates()){
					$this->Session->write('errors.InventoryMovement', $this->Inventory->InventoryMovement->invalidFields());
					$this->Session->write('errors.Inventory', $this->Inventory->invalidFields());
					$this->Session->write('refered', true);
					$this->redirect($this->referer());
				}else{
					//Cache::write('results', null);
				}
			///
			//Busca el tipo de de movimiento
			$this->Inventory->InventoryMovement->TipoDocumento->recursive=-1;		
			$tipoMovimiento=$this->Inventory->InventoryMovement->TipoDocumento->read(null,$this->data["InventoryMovement"]["tipo_documento_id"]);
			$inventoryId=$this->Inventory->find("first",array("conditions"=>array("product_id"=>$this->data["Inventory"]["product_id"],"provider_id"=>$this->data["Inventory"]["provider_id"])));	
				if(!empty($inventoryId)){//Existe El Inventario
					if($tipoMovimiento["TipoDocumento"]["tipo_movimiento"]=="S"){
						$this->data["Inventory"]["id"]=$inventoryId["Inventory"]["id"];									
						$inventoryId["Inventory"]["stock"]-=$this->data["Inventory"]["stock"];
						//____________________________________________________________________________________________________
/** PROBADO*/			if($inventoryId["Inventory"]["stock"]>=0){//Hay cantidad suficiente entonces se procede a guardar
							if ($this->Inventory->save($inventoryId)) {
							$this->Session->setFlash(__('El inventario ha sido actualizado', true));
							$this->data["InventoryMovement"]["inventory_id"]=$this->Inventory->id;
							$this->Inventory->InventoryMovement->create();
							$this->Inventory->InventoryMovement->save($this->data);
							parent::saveAudit("InventoryMovement",$this->data["Audit"]["action"], $this->Inventory->InventoryMovement->id,$this->data["InventoryMovement"]["numero_documento"]);
								// SI ES UNA VENTA ONLINE LO REGISTRO EN LA TABLA DE VENTAS ONLINE
								switch ($tipoMovimiento["TipoDocumento"]["nombre"]) {
										case 'VO'://VENTAS ONLINE
											$this->Inventory->Product->recursive=-1;
											$product=$this->Inventory->Product->read(null,$this->data["Inventory"]["product_id"]);
											$onlineSale["OnlineSale"]["codigo"]="venta-por-el-administrador";
											$onlineSale["OnlineSale"]["product_id"]=$this->data["Inventory"]["product_id"];
											$onlineSale["OnlineSale"]["category_id"]=$product["Product"]["category_id"];
											$onlineSale["OnlineSale"]["cantidad"]=$this->data["Inventory"]["stock"];
											$this->OnlineSale->create();
											$this->OnlineSale->save($onlineSale);
											
											break;
										
										default:
											
											break;
								}
							$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('No se pudo modificar el inventario. Por favor, inténtelo de nuevo.', true));
								$this->redirect($this->referer());
							}
/** PROBADO*/			}else{// No inventario suficiente de este producto entonces no se puede realizar la operación;
							$this->Session->setFlash(__('No hay cantidad de inventario suficiente para realizar esa transacción', true));
							$this->redirect($this->referer());
						}
						//__________________________________________________________________________________________________________
					}else{//Se Actualiza el inventario
						$inventoryId["Inventory"]["stock"]+=$this->data["Inventory"]["stock"];
						if ($this->Inventory->save($inventoryId)) {
							$this->Session->setFlash(__('El inventario ha sido actualizado', true));
							$this->data["InventoryMovement"]["inventory_id"]=$this->Inventory->id;
							$this->Inventory->InventoryMovement->create();
							$this->Inventory->InventoryMovement->save($this->data);
							parent::saveAudit("InventoryMovement",$this->data["Audit"]["action"], $this->Inventory->InventoryMovement->id,$this->data["InventoryMovement"]["numero_documento"]);
							$this->Audit->save();
							$this->redirect(array('action' => 'index'));
						} else {
							$this->Session->setFlash(__('No se pudo modificar el inventario. Por favor, inténtelo de nuevo.', true));
							$this->redirect($this->referer());
						}
					}
				}else{//No existe el Inventario 
					if($tipoMovimiento["TipoDocumento"]["tipo_movimiento"]=="S"){
						/**
						// Si no existe un invntario con proveedor se saca el producto
						// del primer inventario de ese producto sin importar el proveedor						
						$inventoryId=$this->Inventory->find("first",array("conditions"=>array("product_id"=>$this->data["Inventory"]["product_id"])));
						$this->data["Inventory"]["id"]=$inventoryId["Inventory"]["id"];									
						$inventoryId["Inventory"]["stock"]-=$this->data["Inventory"]["stock"];
						//____________________________________________________________________________________________________
						if($inventoryId["Inventory"]["stock"]>=0){//Hay cantidad suficiente entonces se procede a guardar
							if ($this->Inventory->saveAll($this->data)) {
							$this->Session->setFlash(__('El inventario ha sido actualizado', true));
							$this->data["InventoryMovement"]["inventory_id"]=$this->Inventory->id;
							$this->Inventory->InventoryMovement->create();
							$this->Inventory->InventoryMovement->save($inventoryId);
							parent::saveAudit("InventoryMovement",$this->data["Audit"]["action"], $this->Inventory->InventoryMovement->id,$this->data["InventoryMovement"]["numero_documento"]);
							$this->redirect(array('action' => 'index'));
							} else {
								$this->Session->setFlash(__('No se pudo actualizar el inventario. Por favor, intente de nuevo.', true));
							}
						}else{// No inventario suficiente de este producto entonces no se puede realizar la operación;
							$this->Session->setFlash(__('No hay cantidad de inventario suficiente para realizar esa transacción', true));
							$this->redirect($this->referer());
						}
						//__________________________________________________________________________________________________________
					
						 */
					//SI NO EXISTE EL INVENTARIO NO HACE NADA MUESTRA ERROR
						$this->Session->setFlash(__('No hay Inventario disponible, verifique la combinación proveedor/producto', true));
						$this->redirect($this->referer());
/** PROBADO*/		}else{//Se crea el inventario 
						$this->Inventory->create();
						if ($this->Inventory->save($this->data)) {
							$this->Session->setFlash(__('Inventario modificado', true));
							$this->data["InventoryMovement"]["inventory_id"]=$this->Inventory->id;
							$this->Inventory->InventoryMovement->create();
							$this->Inventory->InventoryMovement->save($this->data);
							parent::saveAudit("InventoryMovement",$this->data["Audit"]["action"], $this->Inventory->InventoryMovement->id,$this->data["InventoryMovement"]["numero_documento"]);
							$this->redirect(array('action' => 'index'));
						} else {//Si no lo guarda es por error de base de datos esto no se prueba
							$this->Session->setFlash(__('No se pudo modificar el inventario. Por favor, intente de nuevo.', true));
							$this->redirect($this->referer());
						}
					}
				}
			
		}else{
			$this->Session->delete("errors");
		}
		//$this->redirect(array('action' => 'index'));
	}	
	function admin_index() {
		parent::checkPermiso('inventarios');
		$this->Inventory->recursive = 0;
		$this->paginate = array(
		
			'limit' => 50
		);
		$this->set('inventories', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('inventarios');
		if (!$id) {
			$this->Session->setFlash(__('Inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inventory', $this->Inventory->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		if (!empty($this->data)) {
			$this->Inventory->create();
			if ($this->Inventory->save($this->data)) {
				$this->Session->setFlash(__('Inventario guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El inventario no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$products = $this->Inventory->Product->find('list');
		$productsByCodigo = $this->Inventory->Product->find('list',array("fields"=>array("id","codigo")));
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers','productsByCodigo'));
	}
	function admin_ventasonline(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_devolucionproveedor(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_devolucioncliente(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_facturaventa(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_salidasvarias(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_entradasvarias(){
		parent::checkPermiso('inventarios');
		if($this->Session->read("refered")){
			$this->Session->delete("refered");
		}else{
			$this->Session->delete("errors");
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));
	}
	function admin_edit($id = null) {/*
		parent::checkPermiso('inventarios');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Inventory->save($this->data)) {
				$this->Session->setFlash(__('Inventario modificado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el inventario. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Inventory->read(null, $id);
		}
		$products = $this->Inventory->Product->find('list');
		$providers = $this->Inventory->Provider->find('list');
		$this->set(compact('products', 'providers'));*/
	}

	function admin_delete($id = null) {/*
		parent::checkPermiso('inventarios');
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para inventario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Inventory->delete($id)) {
			$this->Session->setFlash(__('Inventario eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Inventario no pudo ser eliminado', true));
		$this->redirect(array('action' => 'index'));*/
	}
}
?>