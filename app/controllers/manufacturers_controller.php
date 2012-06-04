<?php
class ManufacturersController extends AppController {

	var $name = 'Manufacturers';

	function index() {
		$this->Manufacturer->recursive = 0;
		$this->set('manufacturers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Fabricante inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('manufacturer', $this->Manufacturer->read(null, $id));
	}


	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Manufacturer->recursive = 0;
		$this->set('manufacturers', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Fabricante inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('manufacturer', $this->Manufacturer->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->Manufacturer->create();
			if ($this->Manufacturer->save($this->data)) {
				$this->Session->setFlash(__('Fabricante guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El fabricante no se pudo guardar. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Fabricante no válido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Manufacturer->save($this->data)) {
				$this->Session->setFlash(__('Fabricante modificado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el fabricante. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Manufacturer->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Id de fabricante no válido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Manufacturer->delete($id)) {
			$this->Session->setFlash(__('Fabricante eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('No se pudo eliminar el fabricante', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>