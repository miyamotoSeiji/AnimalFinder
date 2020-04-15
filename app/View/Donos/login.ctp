<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('jumbotron',
        $this->Html->div('col-md-4 offset-md-4',
            $this->Flash->render('auth') . 
            $this->Form->create('Dono') .
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Informe seu E-mail e Senha', array('class' => 'text-center')) .
                $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control')) .
                $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control')) 
            ) . 
            $this->Html->tag('span',
                $this->Form->button('Entrar', array('type' => 'submit', 'class' => 'btn btn-success btn-lg'))
            , array('style' => 'margin-left:8px;'))
        )
    );
?>
