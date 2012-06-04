<?php
class SurveyOptionsController extends AppController {

	var $name = 'SurveyOptions';

	function index() {
		$this->SurveyOption->recursive = 0;
		$this->set('surveyOptions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Opciones inválidas', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('surveyOption', $this->SurveyOption->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SurveyOption->create();
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('La opción ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La opción no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Opciones inválidas', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('La opción ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La opción no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SurveyOption->read(null, $id);
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválida para la opción', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SurveyOption->delete($id)) {
			$this->Session->setFlash(__('Opción borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La opción no fue borrada ', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->SurveyOption->recursive = 0;
		$this->set('surveyOptions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Opciones inválidas', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('surveyOption', $this->SurveyOption->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SurveyOption->create();
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('La opción ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La opción no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Opciones inválidas', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('La opción ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La opción no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SurveyOption->read(null, $id);
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id inválida para la opción', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SurveyOption->delete($id)) {
			$this->Session->setFlash(__('Opción borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La opción no fue borrada ', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>