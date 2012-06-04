<?php
class CategoriesController extends AppController {

	var $name = 'Categories';
	var $paginate=array(
	"Category"=>array("order"=>array("order ASC"))
	);
   function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('view');
	}
	function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Categoría inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$productosDestacados=$this->Category->Product->find("all",array("conditions"=>array("destacar"=>true,"category_id"=>$id,"estado"=>"Activo","Product.inventario >"=>0)));
		$productosPromocionados=$this->Category->Product->find("all",array("conditions"=>array("promocionar"=>true,"category_id"=>$id,"estado"=>"Activo","Product.inventario >"=>0)));
		//debug($productosDestacados);
		$this->set(compact("productosDestacados"));
		$this->set(compact("productosPromocionados"));
		$this->paginate=array("Product"=>array("limit"=>"6","inventario >"=>0));
		$this->set("products",$this->paginate("Product",array("category_id"=>$id,"estado"=>"Activo","inventario >"=>0)));
		$this->set('category', $this->Category->read(null, $id));
	}
	function admin_index() {
		parent::checkPermiso('actualiza');
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Categoría inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('category', $this->Category->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('actualiza');
		if (!empty($this->data)) {
			$this->data["Category"]["order"]=$this->Category->find("count")+1;
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('Categoría guardada.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar la categoría. Por favor, intente de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Categoría inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('Categoría modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la categoría. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		parent::checkPermiso('actualiza');
		if (!$id) {
			$this->Session->setFlash(__('Id inválida para la categoría', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(__('Categoría eliminada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La categoría no pudo ser eliminada', true));
		$this->redirect(array('action' => 'index'));
	}
	function reOrder(){
 	 /* 
   		* Ordena las categorias se une con el widget de sortable
    * */
    foreach($this->data["Item"] as $id=>$posicion){
    $this->Category->id=$id;
    $this->Category->saveField("order",$posicion);
    }
    
    echo "yes";
    Configure::write('debug', 0);   
    $this->autoRender = false;   
    exit(); 
  }
}
?>