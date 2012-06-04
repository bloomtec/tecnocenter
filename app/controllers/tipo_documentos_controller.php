<?php
class TipoDocumentosController extends AppController {

	var $name = 'TipoDocumentos';

	function index() {
		$this->TipoDocumento->recursive = 0;
		$this->set('tipoDocumentos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Tipo de documento inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoDocumento', $this->TipoDocumento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TipoDocumento->create();
			if ($this->TipoDocumento->save($this->data)) {
				$this->Session->setFlash(__('Tipo de documento guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipo de documento no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Tipo de documento inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoDocumento->save($this->data)) {
				$this->Session->setFlash(__('Tipo de documento actualizado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se puede actualizar el tipo de documento. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoDocumento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para este tipo de documento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDocumento->delete($id)) {
			$this->Session->setFlash(__('Tipo de documento borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipo de documento no fue borrado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->TipoDocumento->recursive = 0;
		$this->set('tipoDocumentos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Tipo de documento inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoDocumento', $this->TipoDocumento->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TipoDocumento->create();
			if ($this->TipoDocumento->save($this->data)) {
				$this->Session->setFlash(__('Tipo de documento guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipo de documento no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Tipo de documento inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoDocumento->save($this->data)) {
				$this->Session->setFlash(__('Tipo de documento actualizado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se puede actualizar el tipo de documento. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoDocumento->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para este tipo de documento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDocumento->delete($id)) {
			$this->Session->setFlash(__('Tipo de documento borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipo de documento no fue borrado', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>