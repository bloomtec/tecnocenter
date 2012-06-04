<?php
class PhotoAlbumsController extends AppController {

	var $name = 'PhotoAlbums';

	function index() {
		$this->PhotoAlbum->recursive = 0;
		$this->set('photoAlbums', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Album inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('photoAlbum', $this->PhotoAlbum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PhotoAlbum->create();
			if ($this->PhotoAlbum->save($this->data)) {
				$this->Session->setFlash(__('El album ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El album no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$products = $this->PhotoAlbum->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Album inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PhotoAlbum->save($this->data)) {
				$this->Session->setFlash(__('El album ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El album no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PhotoAlbum->read(null, $id);
		}
		$products = $this->PhotoAlbum->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el album', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PhotoAlbum->delete($id)) {
			$this->Session->setFlash(__('Album borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El album no fue borrado', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->PhotoAlbum->recursive = 0;
		$this->set('photoAlbums', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Album inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('photoAlbum', $this->PhotoAlbum->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PhotoAlbum->create();
			if ($this->PhotoAlbum->save($this->data)) {
				$this->Session->setFlash(__('El album ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El album no pudo ser guardado. Por favor, inténtelo de nuevo.', true));
			}
		}
		$products = $this->PhotoAlbum->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Album inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PhotoAlbum->save($this->data)) {
				$this->Session->setFlash(__('Album modificado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el album. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PhotoAlbum->read(null, $id);
		}
		$products = $this->PhotoAlbum->Product->find('list');
		$this->set(compact('products'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválido para el album', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PhotoAlbum->delete($id)) {
			$this->Session->setFlash(__('Album borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El album no fue borrado', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>