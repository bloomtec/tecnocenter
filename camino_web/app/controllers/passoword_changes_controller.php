<?php
class PassowordChangesController extends AppController {

	var $name = 'PassowordChanges';

	function index() {
		$this->PassowordChange->recursive = 0;
		$this->set('passowordChanges', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cambio de clave inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('passowordChange', $this->PassowordChange->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PassowordChange->create();
			if ($this->PassowordChange->save($this->data)) {
				$this->Session->setFlash(__('Clave guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La clave no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$users = $this->PassowordChange->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cambio de clave inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PassowordChange->save($this->data)) {
				$this->Session->setFlash(__('Clave modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la clave. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PassowordChange->read(null, $id);
		}
		$users = $this->PassowordChange->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PassowordChange->delete($id)) {
			$this->Session->setFlash(__('Clave borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La clave no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->PassowordChange->recursive = 0;
		$this->set('passowordChanges', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cambio de clave inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('passowordChange', $this->PassowordChange->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PassowordChange->create();
			if ($this->PassowordChange->save($this->data)) {
				$this->Session->setFlash(__('Clave guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La clave no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$users = $this->PassowordChange->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Clave inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PassowordChange->save($this->data)) {
				$this->Session->setFlash(__('Clave modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se puede modificar la clave. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PassowordChange->read(null, $id);
		}
		$users = $this->PassowordChange->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PassowordChange->delete($id)) {
			$this->Session->setFlash(__('Clave borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La clave no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>