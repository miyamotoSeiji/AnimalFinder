<?php
class DonosController extends AppController {
   
    public function login() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $password = md5($this->request->data['Dono']['password']);
                $donoLogado = $this->Dono->find('first', array('conditions' => array('email' => $this->request->data['Dono']['email'], 'password' => $password)));
                if (!empty($donoLogado)) {
                    $this->Session->write('donoLogado', $donoLogado);
                    $this->redirect('/animals/index');
                }
                $this->Flash->set('Nome ou senha inválidos! Tente novamente!', array('params' => array('class' => 'alert alert-danger')));
            }
            
        }
    }
    
    public function logout() {
        $this->Session->delete('donoLogado');
        $this->redirect('/entrar');
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Dono->create();
            if ($this->Dono->save($this->request->data)) {
                $this->Flash->set('O cadastro foi salvo com sucesso!', array('params' => array('class' => 'alert alert-success')));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->set('Não foi possível completar o cadastro!', array('params' => array('class' => 'alert alert-danger')));
        }
    }

    public function edit($id = null) {
        $this->checkLogin();
        $dono = $this->Dono->findById($id);
        if (!$dono) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Dono->id = $id;
            if ($this->Dono->save($this->request->data)) {
                $this->Flash->set(' Dados Alterados com sucesso.', array('params' => array('class' => 'alert alert-success')));
                $this->redirect('/animals/index');
            }
            $this->Flash->set('Não foi possível alterar.', array('params' => array('class' => 'alert alert-danger')));
        }

        if (!$this->request->data) {
            $this->request->data = $dono;
        }
    }
    
    public function trocarSenha($id = null) {
        $this->checkLogin();
        $this->edit($id);
        $this->request->data['Dono']['password'] = null;
    }

} 