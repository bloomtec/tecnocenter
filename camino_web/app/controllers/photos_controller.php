<?php
class PhotosController extends AppController {

	var $name = 'Photos';

	function index() {
		$this->Photo->recursive = 0;
		$this->set('photos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Foto inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('photo', $this->Photo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Photo->create();
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('La foto ha sido guardada', true));
				parent::saveAudit("Photo","Add", $this->Photo->id);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La foto no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$photoAlbums = $this->Photo->PhotoAlbum->find('list');
		$this->set(compact('photoAlbums'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Foto inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('La foto ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La foto no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Photo->read(null, $id);
		}
		$photoAlbums = $this->Photo->PhotoAlbum->find('list');
		$this->set(compact('photoAlbums'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválida para la foto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Photo->delete($id)) {
			$this->Session->setFlash(__('Foto borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La foto no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Photo->recursive = 0;
		$this->set('photos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Foto inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('photo', $this->Photo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Photo->create();
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('La foto ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La foto no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$photoAlbums = $this->Photo->PhotoAlbum->find('list');
		$this->set(compact('photoAlbums'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Foto inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Photo->save($this->data)) {
				$this->Session->setFlash(__('Foto modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la foto. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Photo->read(null, $id);
		}
		$photoAlbums = $this->Photo->PhotoAlbum->find('list');
		$this->set(compact('photoAlbums'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválida para la foto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Photo->delete($id)) {
			$this->Session->setFlash(__('Foto borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La foto no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>