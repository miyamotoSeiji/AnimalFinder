<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    echo $this->Html->div('py-5 bg-light',
        $this->Html->div('container',
            $this->Html->div('col-md-8 offset-md-2',
                $this->Form->create('Dono') .
                $this->Html->tag('fieldset',
                    $this->Html->tag('legend', 'Cadastro de dono', array('class' => 'text-center')) .
                    $this->Form->input('nome', array('label' => 'Nome', 'class' => 'form-control')) .
                    $this->Form->input('email', array('label' => 'E-mail', 'class' => 'form-control')) . 
                    $this->Form->input('telefone', array('label' => 'Telefone', 'class' => 'form-control')) . 
                    $this->Form->input('password', array('label' => 'Senha', 'class' => 'form-control')) 
                ) . 
                $this->Html->tag('span',
                    $this->Form->button('Cadastrar', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) .$this->Html->link('Voltar', '/animals/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
                , array('style' => 'margin-left:8px;'))
            )
        )
    ) .
    $this->element('footer');
    
?>
