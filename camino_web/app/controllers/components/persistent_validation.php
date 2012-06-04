<?php 
/*
 * Created on Oct 7, 2009
 * Created by Cosmin Cimpoi <cosmin@binarycrafts.com>
 */

class PersistentValidationComponent extends Object {
    var $components = array('Session');

    //called before Controller::beforeFilter()
    function initialize(&$controller, $settings = array()) {
        $this->controller =& $controller;
    }

    //called after Controller::beforeRender()
    function beforeRender(&$controller) {
        $validations = $this->Session->read('PersistentValidation');
        if (empty($validations)) return;
        foreach ($validations as $k=>$v) {
            if (in_array($k, $controller->modelNames)) {
                if (empty($controller->data))  $controller->data = array();
                if (array_key_exists($k, $controller->data) && array_key_exists('0', $controller->data[$k])) {
                    //    there's data for this model from an associaton query
                        $controller->data[$k. 'Records'] = $controller->data[$k];
                }
                $controller->data[$k] = $v['data'];
                $controller->$k->validationErrors = $v['errors'];
                $this->Session->delete('PersistentValidation.'. $k);
            }
        }
    }

    //called before Controller::redirect()
    function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
        foreach ($this->controller->modelNames as $mn) {
            if (count($controller->$mn->validationErrors)) {
                $this->Session->write('PersistentValidation.'. $mn. '.data', $controller->$mn->data[$mn]);
                $this->Session->write('PersistentValidation.'. $mn. '.errors', $controller->$mn->validationErrors);
            }
        }
    }
}
?>