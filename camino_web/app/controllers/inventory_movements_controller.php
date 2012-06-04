<?php
class InventoryMovementsController extends AppController {

	var $name = 'InventoryMovements';

	function index() {
		$this->InventoryMovement->recursive = 0;
		$this->set('inventoryMovements', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Movimiento de inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inventoryMovement', $this->InventoryMovement->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->InventoryMovement->create();
			if ($this->InventoryMovement->save($this->data)) {
				$this->Session->setFlash(__('Movimiento de inventario guardado', true));
				parent::saveAudit("InventoryMovement","Add", $this->InventoryMovement->id);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimiento de inventario no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$inventories = $this->InventoryMovement->Inventory->find('list');
		$tipoDocumentos = $this->InventoryMovement->TipoDocumento->find('list');
		$this->set(compact('inventories', 'tipoDocumentos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Movimiento de inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InventoryMovement->save($this->data)) {
				$this->Session->setFlash(__('Movimiento de inventario modificadp', true));
				parent::saveAudit("InventoryMovement","Edit", $this->InventoryMovement->id);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimiento de inventario no pudo ser modificado. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InventoryMovement->read(null, $id);
		}
		$inventories = $this->InventoryMovement->Inventory->find('list');
		$tipoDocumentos = $this->InventoryMovement->TipoDocumento->find('list');
		$this->set(compact('inventories', 'tipoDocumentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el movimiento de inventario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InventoryMovement->delete($id)) {
			$this->Session->setFlash(__('Movimiento de inventario eliminado', true));
			parent::saveAudit("InventoryMovement","Delete", $this->InventoryMovement->id);
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Movimiento de inventario no pudo ser eliminado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->InventoryMovement->recursive = 0;
		$this->set('inventoryMovements', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Movimiento de inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inventoryMovement', $this->InventoryMovement->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->InventoryMovement->create();
			if ($this->InventoryMovement->save($this->data)) {
				$this->Session->setFlash(__('Movimiento de inventario guardado', true));
				parent::saveAudit("InventoryMovement","Add", $this->InventoryMovement->id);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimiento de inventario no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$inventories = $this->InventoryMovement->Inventory->find('list');
		$tipoDocumentos = $this->InventoryMovement->TipoDocumento->find('list');
		$this->set(compact('inventories', 'tipoDocumentos'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Movimiento de inventario inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InventoryMovement->save($this->data)) {
				$this->Session->setFlash(__('Movimiento de inventario modificado', true));
				parent::saveAudit("InventoryMovement","Edit", $this->InventoryMovement->id);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el movimiento de inventario. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InventoryMovement->read(null, $id);
		}
		$inventories = $this->InventoryMovement->Inventory->find('list');
		$tipoDocumentos = $this->InventoryMovement->TipoDocumento->find('list');
		$this->set(compact('inventories', 'tipoDocumentos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el movimiento de inventario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InventoryMovement->delete($id)) {
			$this->Session->setFlash(__('Movimiento de inventario eliminado', true));
			parent::saveAudit("InventoryMovement","Delete", $this->InventoryMovement->id);
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Movimiento de inventario no pudo ser eliminado', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_reporte_inventario()
	{
		parent::checkPermiso('reportes');
		if(!empty($this->data))
		{
			//debug($this->data);
			$fecha1=$this->data["Reporte"]["fecha_inicial"];
			$fecha2=$this->data["Reporte"]["fecha_final"];
			$documento=$this->data["Reporte"]["documento"];
			$movimiento=$this->data["Reporte"]["movimiento"];
			
			if($movimiento==0 && $movimiento!="E" && $movimiento!="S"){
				$movimiento="";
			}
			
			
			if($documento==0 or $documento==""){
				$documento="";
			}
			
			
			//Filtros de la condición
			$reportes=array();
			$reportes=array('InventoryMovement.tipo_documento_id'=>$documento, 
							'TipoDocumento.tipo_movimiento'=>$movimiento);
				
			//debug($reportes);				
			//Array de condiciones	
			$condiciones=array();
			foreach($reportes as $indice => $valor)
			{
				if($valor!="" or $valor!=0)
				{
					array_push($condiciones, array($indice=>array($valor)));
				}
			}
			
			if($fecha1!=null or $fecha2!=null) 
			{
				if($fecha1>$fecha2)
				{
					$this->Session->setFlash(__('La fecha inicial debe ser menor que la fecha final', true));
					$this->InventoryMovement->TipoDocumento->recursive=0;
					$documentos = $this->InventoryMovement->TipoDocumento->find("list", array("fields"=>array("id","nombre")));
					$this->set(compact("documentos", "movimientos"));
					return;
				}else {
					
					list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia);
					
					list($ano, $mes, $dia) = explode("-",$fecha2);
					
					if($dia==31){
						$fecha2 = $ano."-".$mes."-".($dia);
					}else {
						$fecha2 = $ano."-".$mes."-".($dia+1);
					}
					
					
					$fechas = array("InventoryMovement.created >="=>$fecha1, "InventoryMovement.created <="=>$fecha2);
					array_push($condiciones, $fechas);
				}
			}else {
				$fechaActual=getdate();
				$fechaActual=$fechaActual["year"]."-".$fechaActual["mon"]."-".$fechaActual["mday"]=$fechaActual["mday"]+1;
				$fechas = array("InventoryMovement.created <="=>$fechaActual);
				array_push($condiciones, $fechas);
			}
	  
			$this->InventoryMovement->recursive=1;
			$reporte = $this->InventoryMovement->find("all", array("conditions"=>$condiciones,"order"=>"InventoryMovement.created DESC"));
			
			$this->set(compact("reporte", "campos", "movimiento"));
		}

		$documentos = $this->InventoryMovement->TipoDocumento->find("list", array("fields"=>array("id","nombre")));
		$productosByCodigo = $this->InventoryMovement->Inventory->Product->find("list", array("fields"=>array("id","codigo")));
		$productosByNombre = $this->InventoryMovement->Inventory->Product->find("list", array("fields"=>array("id","nombre")));
		$providers=$this->InventoryMovement->Inventory->Provider->find("list");
		//debug($providers);
		$this->set(compact("documentos", "movimientos","productosByCodigo","productosByNombre","providers"));
		$this->layoutReporte("Reporte de Inventarios");
	}
}
?>