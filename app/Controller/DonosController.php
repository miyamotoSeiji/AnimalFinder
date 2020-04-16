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
                $this->Flash->error(__('Nome ou senha inválidos! Tente novamente!'));
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
                $this->Flash->success(__('O cadastro foi salvo com sucesso!'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('Não foi possível completar o cadastro!')
            );
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
                $this->Flash->success(__('Dados Alterados.'));
                $this->redirect('/animals/index');
            }
            $this->Flash->error(__('Não foi possível alterar.'));
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