<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('col-md-4 offset-md-4',
        $this->Form->create('Dono') .
        $this->Html->tag('fieldset',
            $this->Html->tag('legend', 'Cadastro de dono') .
            $this->Form->input('nome', array('label' => 'Nome')) .
            $this->Form->input('email', array('label' => 'E-mail')) . 
            $this->Form->input('telefone', array('label' => 'Telefone')) . 
            $this->Form->input('password', array('label' => 'Senha')) 
        ) . 
        $this->Form->end(__('Submit', array('label' => 'Cadastrar')))     
    );
?>

