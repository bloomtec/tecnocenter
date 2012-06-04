<?php
class PagesController extends AppController {

	var $name = 'Pages';
	var $uses=array();
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view',"contactenos","empresa","ayuda");
	}
	function admin_acercade(){
		parent::checkPermiso('reportes');
	}

	function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Página inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('page', $this->Page->findBySlug($slug));
		$this->set("homeID",$slug);
	}

	function empresa(){
	$this->set("homeID","nuestra-empresa");	
	}
	function ayuda(){
	$this->set("homeID","servicios");	
	}

	function contactenos(){
		if(!empty($this->data)){
				$asunto    = 'Contacto Página Web';
				$mensaje= "nombre: ".$this->data["Page"]["nombre"]. "<br />";
				$mensaje.= "email: ".$this->data["Page"]["email"]. "<br />";
				$mensaje.= "empresa: ".$this->data["Page"]["empresa"]. "<br />";			
				$mensaje.= "ciudad: ".$this->data["Page"]["ciudad"]. "<br />";
				$mensaje.= "pais: ".$this->data["Page"]["pais"]. "<br />";
				$mensaje.= "telefono: ".$this->data["Page"]["telefono"]. "<br />";
				$mensaje.= "celular: ".$this->data["Page"]["celular"]. "<br />";
				$mensaje.= "comentarios: ".$this->data["Page"]["comentarios"]."<br />";
				
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				//$cabeceras .= "To:<ricardopandales@gmail.com>" . "\r\n";
				$para="soporte@tecnocenter.com.co";
				$cabeceras .= 'From: Tecnocenter <info@tecnocenter.com.co>' . "\r\n";

				if(mail($para, $asunto, $mensaje, $cabeceras))
				{
					$this->set("mensaje",'Datos enviados a su correo');
				}else 
				{
					$this->set("mensaje",'Datos no enviados a su correo, por favor intenta mas tarde');
				}
		}
	$this->set("homeID","contactenos");	
	}
	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Página inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->Page->create();
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(__('La página guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La página no puede ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Página inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Page->save($this->data)) {
				parent::saveAudit("Service","Modificar", $this->data["Page"]["id"]);
				$this->Session->setFlash(__('Página modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la página. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Page->read(null, $id);
		}
	}

	/*function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Page->delete($id)) {
			$this->Session->setFlash(__('Page deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}
?>