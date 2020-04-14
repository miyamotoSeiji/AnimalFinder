<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('col-md-4 offset-md-4',
        $this->Flash->render('auth') . 
        $this->Form->create('Dono') .
        $this->Html->tag('fieldset',
            $this->Html->tag('legend', 'Informe seu nome e senha de acesso') .
            $this->Form->input('nome', array('label' => 'Nome')) .
            $this->Form->input('password', array('label' => 'Senha')) 
        ) . 
        $this->Form->end(__('Login'))     
    );
?>
