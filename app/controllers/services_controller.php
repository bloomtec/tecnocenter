<?php
class ServicesController extends AppController {

	var $name = 'Services';

	var $paginate=array(
	"Service"=>array("order"=>array("order ASC"))
	);
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view');
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Servicio inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('service', $this->Service->read(null, $id));
	}

	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Service->recursive = 0;
		$this->set('services', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Servicio inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('service', $this->Service->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->Service->create();
				$this->data["Service"]["order"]=$this->Service->find("count")+1;
			if ($this->Service->save($this->data)) {
				parent::saveAudit("Service","Añadir", $this->Service->id);
				$this->Session->setFlash(__('Servicio guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar el servicio. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Servicio no válido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Service->save($this->data)) {
				parent::saveAudit("Service","Modificar", $this->data["Service"]["id"]);
				$this->Session->setFlash(__('Servicio modificado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar el servicio. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Service->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Servicio no válido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Service->delete($id)) {
			parent::saveAudit("Service","Borrar", $id);
			$this->Session->setFlash(__('Servicio eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('El servicio no fue eliminado', true));
		$this->redirect(array('action' => 'index'));
	}
	function reOrder(){
 	 /* 
   		* Ordena las categorias se une con el widget de sortable
    * */
		foreach($this->data["Item"] as $id=>$posicion){
			$this->Service->id=$id;
			$this->Service->saveField("order",$posicion);
			}
			
			echo "yes";
			Configure::write('debug', 0);   
			$this->autoRender = false;   
			exit(); 
		}
}
?>