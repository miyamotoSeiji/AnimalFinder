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
        'conditions' => array('Animal.excluido' => 'N'),
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
            new Folder(ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perdidos' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'], true, 0666);
            copy($this->request->data['Animal']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perdidos' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->request->data['Animal']['nome'] . '.jpg');
            $this->request->data['Animal']['foto'] = 'foto' . $this->request->data['Animal']['nome'] . '.jpg';
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->success(__('O cadastro foi salvo com sucesso!'));
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
            copy($this->request->data['Animal']['foto']['tmp_name'], ROOT_URL . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . $this->donoLogado['Dono']['id'] . DIRECTORY_SEPARATOR . 'foto' . $this->donoLogado['Dono']['id'] . '.jpg');
            $this->request->data['Animal']['foto'] = 'foto' . $this->donoLogado['Dono']['id'] . '.jpg';
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->success(__('Dados Alterados.'));
                $this->redirect('/animals/index');
            }
            $this->Flash->error(__('Não foi possível alterar.'));
        }

        if (!$this->request->data) {
            $this->request->data = $animal;
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
                $this->Flash->success(__('Comunicado!!!'));
                $this->redirect('/animals/index');
            }
            $this->Flash->error(__('Não foi possível alterar.'));
        }

        if (!$this->request->data) {
            $this->request->data = $animal;
        }
    }
    
} 
