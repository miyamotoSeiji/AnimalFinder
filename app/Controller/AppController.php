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
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'animals',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'donos',
                'action' => 'login',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        )
    );
    
    public $paginate = array();
    
    public $paginateOrderFields = array();     
    
    public $allowedActions = array();
    
    public $mapActions = array();
    
    public $defaultActions = array(
        'create' => array('add', 'confirmar', 'upload', 'doing', 'gerar'),
        'read' => array('index', 'view', 'report', 'autoComplete', 'imprimir', 'download'),
        'update' => array('edit', 'bloquear', 'desbloquear'),
        'delete' => array('delete', 'desfazer')
    );
    
    public $saveMethod = 'save';
    
    public $saveOptions = array();
    
    public $title = 'Registro';

    public $maleMessages = array();

    public $femaleMessages = array();
    
    public $noneCheck = true;
    
    

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }             

    public function index() {
        $this->Session->delete('indexUrl');
        $this->setFilters();        
        $this->setOrders();           
        $this->paginate['conditions'] = $this->paginateConditions();
        try {
            $records = $this->paginate(null, null, $this->paginateOrderFields);
        } catch (NotFoundException $e) {
            $this->redirect('/' . $this->controllerName());
        }        
        $this->set(Inflector::Variable($this->controllerName()), $records);
    }    
    
    public function add() {
        if (!empty($this->request->data[$this->modelClass])) {
            $this->{$this->modelClass}->id = false;
            if ($this->{$this->modelClass}->{$this->saveMethod}($this->request->data, $this->saveOptions)) {
                $this->Flash->set($this->getFlashMessage('add'));
                $this->afterAdd();
            }
        } else {
            $this->beforeAdd();
        }       
        $this->setFields();
    }

    public function edit($id = null) {
        if (!empty($this->request->data[$this->modelClass])) {
            if ($this->{$this->modelClass}->{$this->saveMethod}($this->request->data, $this->saveOptions)) {
                $this->Flash->set($this->getFlashMessage('edit'));
                $this->afterEdit();
            }
        } else {                                                     
            $this->request->data = $this->{$this->modelClass}->editData($id);
        }        
        $this->setFields();
    }

    public function delete($id = null) {
        $ids = Set::classicExtract($this->request->data, $this->modelClass . '.{n}.' . $this->{$this->modelClass}->primaryKey);
        if (!empty($id) && empty($ids)) {
            $ids = array($id);
        }
        if ($this->{$this->modelClass}->excluir($ids)) {
            $message = $this->getFlashMessage('delete');
            if (count($ids) > 1) {
                $message = count($ids) . ' exclusões realizadas com sucesso!';
            }
            $this->Flash->set($message);
        } else {
            $this->Flash->set('Não foi possível excluir ' . $this->title);
        }
        $this->afterDelete();
    }

    public function view($id = null) {
        if (!empty($id)) {
            $this->request->data = $this->{$this->modelClass}->viewData($id);            
        }
        $disabled = true;
        $this->setFields($disabled);
    }
    
    public function paginateConditions() {
        if (!empty($this->request->named['sort'])) {
            $this->Session->write($this->modelClass . 'Sort', $this->request->named['sort']);                     
        }
        if (!empty($this->request->named['direction'])) {
            $this->Session->write($this->modelClass . 'Direction', $this->request->named['direction']);                     
        }
        $paginateConditions = $this->paginate['conditions'];
        
        return $paginateConditions;
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

    public function dataCondition($fieldName) {
        $dataCondition = '';
        list($model, $field) = explode(".", $fieldName);
        if (trim($this->request->data[$model][$field]) != "") {
            $dataCondition = $this->request->data[$model][$field];                    
        }        
        $this->Session->write($fieldName, $dataCondition);
        
        return $dataCondition;
    }

    public function sessionCondition($fieldName) {
        $sessionCondition = $this->Session->read($fieldName);
        $this->request->data($fieldName, $sessionCondition);
        
        return $sessionCondition;        
    }

    public function beforeAdd() {
        $this->request->data = array();
    }
    
    public function afterAdd() {                
        $this->redirect($this->indexUrl());
    }
  
    public function afterEdit() {
        $this->redirect($this->indexUrl());
    }

    public function afterDelete() {
        $this->redirect($this->indexUrl());
    }  
           
    public function indexUrl() {
        $indexUrl = $this->Session->read('indexUrl');
        if (empty($indexUrl)) {
            $indexUrl = $this->paginateUrl($this->controllerName(), 'index');
        } else {
            $this->Session->delete('indexUrl');   
        }

        return $indexUrl;
    }   
    
    public function paginateUrl($controller, $action, $id = null) {
        $url = compact('controller', 'action');
        if (!empty($id)) {
            $url[] = $id;
        }
        if (!empty($this->request->named)) {
            $url = array_merge($url, $this->request->named);
        }                
        
        return $url;        
    }

    public function controllerName() {
        return $this->request->params['controller'];
    }
       
    public function getFlashMessage($method) {
        $message = null;
        $maleMessages = array(
            'add' => $this->title . ' gravado com sucesso!',
            'edit' => $this->title . ' alterado com sucesso!',
            'delete' => $this->title . ' excluido com sucesso!',
        );
        if (!empty($this->maleMessages)) {
            $maleMessages = array_merge($maleMessages, $this->maleMessages);
        }
        $femaleMessages = array(
            'add' => $this->title . ' gravada com sucesso!',
            'edit' => $this->title . ' alterada com sucesso!',
            'delete' => $this->title . ' excluída com sucesso!',
        );
        if (!empty($this->femaleMessages)) {
            $femaleMessages = array_merge($femaleMessages, $this->femaleMessages);
        }
        $message = $maleMessages[$method];
        list($first, ) = explode(' ', $this->title);
        if (substr($first, -1, 1) == 'a') {
            $message = $femaleMessages[$method];            
        }
        
        return $message;
    }
    
    public function setBreadcrumb() {
        $breadcrumb = $this->Session->read('breadcrumb');
        $this->Session->delete('breadcrumb');
        if (empty($breadcrumb)) {
            $breadcrumb = array();
        } else {
            if (!empty($this->breadcrumb[$this->action]) && $breadcrumb[0] == $this->breadcrumb[$this->action][0]) {
                unset($this->breadcrumb[$this->action][0]);
            }            
        }
        if (!empty($this->breadcrumb[$this->action])) {
            $breadcrumb = array_merge($breadcrumb, $this->breadcrumb[$this->action]);
        }        
        $this->set('breadcrumbItems', $breadcrumb);
    }
    
}
?>
