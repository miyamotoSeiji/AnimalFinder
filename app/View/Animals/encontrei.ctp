<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }

    echo $this->Html->div('py-5 bg-light', 
        $this->Html->div('container',
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Comunicar o dono do animal!', array('class' => 'text-center')) .
                $this->Html->div('col-md-12 jumbotron text-center', 
                    $this->Html->image('../app/webroot/img/perdidos/' . $this->request->data['Animal']['dono_id'] . '/foto' . $this->request->data['Animal']['nome'] . '.jpg', array('alt' => $this->request->data['Animal']['nome'] , 'style' => 'margin-bottom:10px;')) .
                    $this->Html->tag('h5', 'Olá! meu nome é ' . $this->request->data['Animal']['nome'] . ' tenho ' . $this->request->data['Animal']['idade'] . ' anos.') .
                    $this->Html->tag('h5', 'Me perdi em ' . $this->request->data['Animal']['cidade'] . ' / ' . $this->request->data['Animal']['estado']) .
                    $this->Html->tag('h5', $this->request->data['Animal']['info']) . 
                    $this->Html->tag('h5', 'Você me encontrou? Avise meu dono, ele deve estar muito preocupados! Preencha as informações abaixo clique no botão "Comunicar achado" e pronto! Em breve ele deve entrar em contato com você.') .
                    $this->Html->tag('h5', 'Ou se preferir, entre em contato diretamente com meu dono através do telefone: ' . $this->request->data['Dono']['telefone'])
                ) .
                $this->Form->create('Animal') .
                $this->Html->div('row',
                    $this->Html->div('col', $this->Form->input('anjo_nome', array('label' => 'Qual o seu nome?', 'class' => 'form-control'))) . 
                    $this->Html->div('col', $this->Form->input('anjo_telefone', array('label' => 'Qual seu telefone?', 'class' => 'form-control')))
                ) .
                $this->Form->input('status', array('type' => 'hidden', 'value' => 'Comunicado')) 
            ) . 
            $this->Html->tag('span',
                $this->Form->button('Comunicar achado', array('type' => 'submit', 'class' => 'btn btn-outline-success btn-lg')) . $this->Html->link('Voltar', '/animals/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-left:5px;')))
            , array('style' => 'margin-left:15px;'))
        )
    ) .
    $this->element('footer');
    
?>