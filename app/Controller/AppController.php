<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
 
    public $helpers = array(
        'Html', 
        'Js' => array('Jquery'), 
        'Form', 
        'Session', 
        'Flash',
        'Time',
    );  

    public $components = array(
        'RequestHandler', 
        'Session',
        'Flash',
    );
    
    public $donoLogado = false;
    
    public function checkLogin() {
        $this->donoLogado = $this->Session->read('donoLogado');
        if (!$this->donoLogado) {
            $this->redirect('/entrar');
        }        
    }
    
    public $paginate = array();
    public $paginateOrderFields = array();
    
    public function paginateConditions() {
        $text = null;
        $donoLogado = $this->Session->read('donoLogado');
        $conditions['Animal.status'] = 'Perdido';
        if (!empty($donoLogado)) {
            $conditions['Animal.dono_id'] = $donoLogado['Dono']['id'];
            $conditions['Animal.status'] = array('Perdido', 'Comunicado', 'Encontrado');
        }
        
        return $conditions;
    }
    
    public function paginateOrder() {
        $order = array();
        $sort = $this->Session->read($this->modelClass . 'Sort');
        $direction = $this->Session->read($this->modelClass . 'Direction');
        if (empty($direction)) {
            $direction = 'asc';            
        }        
        if (empty($sort)) {
            $order = $this->paginate['order'];
        } else {
            $order = array($sort => $direction);
        }

        return $order;        
    }
    
    public $saveMethod = 'save';
    
    public $saveOptions = array();

}
?>
