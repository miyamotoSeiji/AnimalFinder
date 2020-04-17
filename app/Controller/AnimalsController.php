<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class AnimalsController extends AppController {
   
    var $name = 'Animals';
    
    public $uses = array('Animal', 'Dono');
    
    public $paginate = array(
        'fields' => array(
            'Animal.id',
            'Animal.dono_id',
            'Animal.foto',
            'Animal.nome',
            'Animal.idade',
            'Animal.info',
            'Animal.cidade',
            'Animal.estado',
            'Animal.status',
            'Animal.anjo_nome',
            'Animal.anjo_telefone',
        ),
        'conditions' => array('Animal.deleted IS NULL'),
        'limit' => 9,
        'order' => array('Animal.id' => 'desc')
    );
      
    public function index() {
        $donoLogado = $this->Session->read('donoLogado');
        $this->set('donoLogado', $donoLogado);
        $this->paginate['conditions'] = $this->paginateConditions();
        try {
            $records = $this->paginate(null, null, $this->paginateOrderFields);
        } catch (NotFoundException $e) {
            $this->redirect('/animals/add');
        }        
        $this->set('animals', $records);
    }
    
    public function add() {
        $this->checkLogin();
        if (!empty($this->request->data[$this->modelClass])) {
            $this->{$this->modelClass}->id = false;
            $this->request->data['Animal']['dono_id'] = $this->donoLogado['Dono']['id'];
            if (!empty($this->request->data['Animal']['foto'])) {
                new Folder(ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perdidos' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'], true, 0666);
                copy($this->request->data['Animal']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perdidos' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->request->data['Animal']['nome'] . date('dmYHis') . '.jpg');
                $this->request->data['Animal']['foto'] = 'foto' . $this->request->data['Animal']['nome'] . date('dmYHis') . '.jpg';
            }
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->set('O cadastro foi salvo com sucesso!', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/animals/index');
            }
        } 
    }
    
    public function edit($id = null) {
        $this->checkLogin();
        $animal = $this->Animal->findById($id);
        if (!$animal) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Animal->id = $id;
            if (!empty($this->request->data['Animal']['foto']['tmp_name'])) {
                copy($this->request->data['Animal']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perdidos' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->request->data['Animal']['nome'] . date('dmYHis') . '.jpg');
                $this->request->data['Animal']['foto'] = 'foto' . $this->request->data['Animal']['nome'] . date('dmYHis') . '.jpg';
            } else {
                unset($this->request->data['Animal']['foto']);
            }
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->set('Dados Alterados.', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/animals/index');
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-error')));
        }

        if (!$this->request->data) {
            $this->request->data = $animal;
        }
    }
    
    public function delete($id = null) {
        $this->checkLogin();
        if (!empty($id)) {
            $this->Animal->id = $id;
            $this->Animal->saveField('deleted', date('Y-m-d H:i:s'));
            $this->Flash->set('Animal excluido com sucesso!.', array('params' => array('class' => 'alert alert-success')));
            $this->redirect('/Animals/index');
        }
    }
    
    public function encontrei($id = null) {
        $animal = $this->Animal->findById($id);
        if (!$animal) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Animal->id = $id;
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->set('Comunicado!!!', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/animals/index');
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-danger')));
        }

        if (!$this->request->data) {
            $this->request->data = $animal;
        }
    }
    
    public function statusEncontrado($id) {
        $this->checkLogin();
        if (!empty($id)) {
            $this->Animal->id = $id;
            $this->Animal->saveField('status', 'Encontrado');
            $this->redirect('/Animals/index');
        }
    }
    
    public function comunicado($id) {
        $this->checkLogin();
        if (!empty($id)) {
            $animal = $this->Animal->findById($id);
            $this->set('animal', $animal);
        }
    }
    
    public function apiConsulta() {
        $animaisPerdidos = $this->Animal->find('all', array('conditions' => array('Animal.status' => 'Perdido')));
        $this->set(array(
            'animaisPerdidos' => $animaisPerdidos,
            '_serialize' => array('animaisPerdidos')
        ));
    }
    
} 
