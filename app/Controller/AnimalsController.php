<?php
class AnimalsController extends AppController {
   
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'login');
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Animal->create();
            if ($this->Animal->save($this->request->data)) {
                $this->Flash->success(__('Registro Salvo com Sucesso!'));
                
                return $this->redirect(array('action' => 'loginRedirect'));
            }
            $this->Flash->error(
                ('The user could not be saved. Please, try again.')
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