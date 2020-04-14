<?php
class DonosController extends AppController {
   
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'login');
    }
    
    public function login() {
        if ($this->request->is('post')) {
            debug($this->request->data);
            exit();
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Nome ou senha inválidos! Tente novamente!'));
        }
    }
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Dono->create();
            if ($this->Dono->save($this->request->data)) {
                $this->Flash->success(__('O cadastro foi salvo com sucesso!'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('Não foi possível completar o cadastro!')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    
    

} 