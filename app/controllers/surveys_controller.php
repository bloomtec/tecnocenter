<?php
class SurveysController extends AppController {

	var $name = 'Surveys';
function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view','voting');
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Encuesta inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('survey', $this->Survey->read(null, $id));
	}
	
	function voting(){
		$this->Survey->SurveyOption->recursive=-1;
		$surveyOption=$this->Survey->SurveyOption->read(null,$_POST["optionId"]);
		$surveyOption["SurveyOption"]["votos"]+=1;
		//debug($surveyOption);
		if($this->Survey->SurveyOption->save($surveyOption)){
			$this->Session->write("voto",true);	
			echo true;
		}else{
			echo false;
		}
		configure::write("debug",0);
		$this->autorender=false;
		exit(0);
		
	}

	function admin_index() {
		parent::checkPermiso('encuestas');
		$this->Survey->recursive = 0;
		$this->set('surveys', $this->paginate());
	}

	function admin_view($id = null) {
		parent::checkPermiso('encuestas');
		if (!$id) {
			$this->Session->setFlash(__('Encuesta inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('survey', $this->Survey->read(null, $id));
	}

	function admin_add() {
		parent::checkPermiso('encuestas');
		if (!empty($this->data)) {
			$this->Survey->create();
			if ($this->Survey->save($this->data)) {
				$surveyId=$this->Survey->id;
				if($this->data["Survey"]["estado"]){
					$oldActiva=$this->Survey->find("first",array(
						"conditions"=>array(
							"Survey.estado"=>true,
							"Survey.id <>"=>$surveyId
						)
					));
					$oldActiva["Survey"]["estado"]=false;
					if(isset($oldActiva["Survey"]["id"])&&$surveyId!=$oldActiva["Survey"]["id"])$this->Survey->save($oldActiva);
				}
				foreach($this->data["Options"] as $option){
					$surveyOption["SurveyOption"]["survey_id"]=$surveyId;
					$surveyOption["SurveyOption"]["name"]=$option["name"];
					$this->Survey->SurveyOption->save($surveyOption);
					$this->Survey->SurveyOption->id=0;
				}
			$this->Session->setFlash(__('Encuesta guardada', true));
			$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar la encuesta. Por favor, inténtelo de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		parent::checkPermiso('encuestas');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Encuesta inválida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Survey->save($this->data)) {
			//	debug($this->data);
				//$surveyId=$this->Survey->id;
				if($this->data["Survey"]["estado"]){
					$oldActiva=$this->Survey->find("first",array(
						"conditions"=>array(
							"Survey.estado"=>true,
							"Survey.id <>"=>$this->data["Survey"]["id"]
						)
					));
					$oldActiva["Survey"]["estado"]=false;
					//debug($oldActiva);
					if(isset($oldActiva["Survey"]["id"])) $this->Survey->save($oldActiva);
				}
				if(isset($this->data["Options"] )){
					foreach($this->data["Options"] as $option){
					$surveyOption=null;
					$surveyOption["SurveyOption"]["survey_id"]=$this->data["Survey"]["id"];
					//debug($option);
					if(isset($option["id"])){
						$surveyOption["SurveyOption"]["id"]=$option["id"];
						if(!empty($option["name"])){
							$surveyOption["SurveyOption"]["name"]=$option["name"];
							$this->Survey->SurveyOption->save($surveyOption);
						}else{
							$this->Survey->SurveyOption->delete($option["id"]);
						}
						
						
					}else{
						$surveyOption["SurveyOption"]["name"]=$option["name"];
						$this->Survey->SurveyOption->save($surveyOption);
					}					
					$this->Survey->SurveyOption->id=0;
					}
				}
				
				$this->Session->setFlash(__('Encuesta modificada', true));
				$this->redirect(array('action' => 'index'));
			} else {
	$this->Session->setFlash(__('No se pudo modificar la encuesta. Por favor, inténtelo de nuevo.', true));

			}
		}
		if (empty($this->data)) {
			$this->data = $this->Survey->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		parent::checkPermiso('encuestas');
		if (!$id) {
			$this->Session->setFlash(__('Id inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Survey->delete($id)) {
			$this->Session->setFlash(__('Encuesta borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Encuesta no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>