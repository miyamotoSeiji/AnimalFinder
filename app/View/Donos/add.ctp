<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('jumbotron',
        $this->Html->div('col-md-4 offset-md-4',
            $this->Form->create('Dono') .
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Cadastro de dono', array('class' => 'text-center')) .
                $this->Form->input('nome', array('label' => 'Nome', 'class' => 'form-control')) .
                $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control')) . 
                $this->Form->input('telefone', array('label' => 'Telefone', 'class' => 'form-control')) . 
                $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control')) 
            ) . 
            $this->Html->tag('span',
                $this->Form->button('Cadastrar', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg'))
            , array('style' => 'margin-left:8px;'))
        )
    );
    
?>
