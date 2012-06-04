<?php
class ProvidersController extends AppController {

	var $name = 'Providers';


	
	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Provider->recursive = 0;
		$this->set('providers', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Proveedor no válido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('provider', $this->Provider->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->Provider->create();
			if ($this->Provider->save($this->data)) {
				$this->Session->setFlash(__('Proveedor guardado', true));
				parent::saveAudit("Provider","Add", $this->Provider->id,$this->data["Provider"]["nit_proveedor"]);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar el proveedor. Por favor, inténtelo de nuevo', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Proveedor inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Provider->save($this->data)) {
				$this->Session->setFlash(__('Proveedor modificado', true));
				parent::saveAudit("Provider","Edit", $this->Provider->id,$this->data["Provider"]["nit_proveedor"]);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el proveedor. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Provider->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Proveedor no válido', true));
			$this->redirect(array('action'=>'index'));
		}
		$proveedor=$this->Provider->read(null,$id);
		if ($this->Provider->delete($id)) {
			
			$this->Session->setFlash(__('Proveedor eliminado', true));
			parent::saveAudit("Provider","Delete", $id,$proveedor["Provider"]["nit_proveedor"]);
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el proveedor', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>