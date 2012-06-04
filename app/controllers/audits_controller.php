<?php
class AuditsController extends AppController {

	var $name = 'Audits';
	var $uses = array("Audit", "User");
	
	function admin_index($model=null) 
	{
		parent::checkPermiso('auditoria');
		if(empty($this->data))
		{
			$this->Audit->User->recursive = 0;
			if(isset($model) && $model=="byUser") 
			{
				$usuarios=$this->User->find("list", 
											array("fields"=>array("id","primer_nombre"), "conditions"=>
											array("OR"=>array("User.role_id"=>array(1,2,3)))));
								
		      $this->set("usuarios", $usuarios);	
			}
			
			$this->set('audits', $this->paginate());
			$this->set('model', $model);
		}
		else if(!empty($this->data)) 
		{
			 $userId=$this->Session->read("Auth.User.id");
			 $modelo=$this->data["Audit"]["modelo"];
		     $fecha1=$this->data['Audit']['fecha_inicial'];
		     $fecha2=$this->data['Audit']['fecha_final'];
			 
			 if(isset($this->data['Audit']['user']))
			 {
			 	$user=$this->data['Audit']['user'];
		     }
			
			//$userId=$this->Session->read("Auth.User.id");
			//$userId=1; PROBAR MANUAL SIN ID DE SESSION
			if($fecha1!=null or $fecha2!=null)
			{
				list($ano, $mes, $dia) = explode("-",$fecha1);
					$fecha1 = $ano."-".$mes."-".($dia-1);
					
				list($ano, $mes, $dia) = explode("-",$fecha2);
					$fecha2 = $ano."-".$mes."-".($dia+1);
					
				if($modelo=="byUser") 
				{
							
					if($user!="Todos")
					{
						$condiciones=array(
							   "Audit.user_id"=>$user, 
							   'Audit.created between ? and ?'=>array($fecha1, $fecha2));
					}else {
						$condiciones=array(
							   'Audit.created between ? and ?'=>array($fecha1, $fecha2));
					}
					
					
				}else {
					$condiciones=array("Audit.model"=>$modelo,
							  
							   'Audit.created between ? and ?'=>array($fecha1, $fecha2));
				}
					
			}else {
				if($modelo=="byUser") {
			
					if($user!="Todos")
					{
						$condiciones=array(
							   "Audit.user_id"=>$user);	
					}else {
						$condiciones=array();	
					}
					
					
				}else {
					$condiciones=array("Audit.model"=>$modelo,
							   );	
				}
			}
					
			$reporte = $this->Audit->find("all", 
							array("conditions"=>$condiciones));
			
			$model=$modelo;
			$this->set(compact('reporte', 'model'));							
		}
		$this->layoutReporte("Auditoria ".$model);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Auditoría Inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('audit', $this->Audit->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Audit->create();
			if ($this->Audit->save($this->data)) {
				$this->Session->setFlash(__('Auditoría guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La auditoría no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$users = $this->Audit->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Auditoría inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Audit->save($this->data)) {
				$this->Session->setFlash(__('Auditoría modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la auditoría. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Audit->read(null, $id);
		}
		$users = $this->Audit->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Auditoría inválida', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Audit->delete($id)) {
			$this->Session->setFlash(__('Auditoría eliminada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La auditoría no pudo ser eliminada', true));
		$this->redirect(array('action' => 'index'));
	}


	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Auditoría inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('audit', $this->Audit->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Audit->create();
			if ($this->Audit->save($this->data)) {
				$this->Session->setFlash(__('La auditoría guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La auditoría no pudo ser guardada. Por favor, inténtelo de nuevo.', true));
			}
		}
		$users = $this->Audit->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Auditoría inválida}', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Audit->save($this->data)) {
				$this->Session->setFlash(__('Auditoría modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo modificar la auditoría. Por favor, inténtelo de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Audit->read(null, $id);
		}
		$users = $this->Audit->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Auditoría inválida', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Audit->delete($id)) {
			$this->Session->setFlash(__('Auditoría eliminada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La auditoría no pudo ser eliminada', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_report_audits()
	{
		if(empty($this->data))
		{
			
			$userId=$this->Session->read("Auth.User.id");
			
			$infoUser = $this->User->Audit->find("first", 
							  array("conditions"=>array("Audit.user_id"=>$userId)));
			
			$identificacion=$infoUser["User"]["numero_identificacion"];
			$pri_nom=$infoUser["User"]["primer_nombre"];
			$pri_ape=$infoUser["User"]["primer_apellido"];
			$seg_nom=$infoUser["User"]["segundo_nombre"];
			$seg_ape=$infoUser["User"]["segundo_apellido"];
		
			$this->set(compact("identificacion","pri_nom","pri_ape",
								"seg_nom","seg_ape"));
								
		    $reports = $this->User->Audit->find("all", 
							  array("conditions"=>array("Audit.user_id"=>1)));
								
			$this->set(compact("reports"));				
			
		}
		
	}
	
	
}
?>