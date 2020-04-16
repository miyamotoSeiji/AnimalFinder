<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }

    echo $this->Html->div('py-5 bg-light', 
        $this->Html->div('container',
            $this->Html->tag('fieldset',
                $this->Html->tag('legend', 'Comunicado!', array('class' => 'text-center')) .
                $this->Html->div('col-md-12 jumbotron text-center', 
                    $this->Html->image('../app/webroot/img/perdidos/' . $animal['Animal']['dono_id'] . '/foto' . $animal['Animal']['nome'] . '.jpg', array('alt' => $animal['Animal']['nome'] , 'style' => 'margin-bottom:10px;')) .
                    $this->Html->tag('h5', 'Olá! Parece que ' . $animal['Animal']['anjo_nome'] . ' tem novidades sobre ' . $animal['Animal']['nome']) .
                    $this->Html->tag('h5', 'Ligue para ele pelo Telefone: ' . $animal['Animal']['anjo_telefone'] . ' e boa sorte!!! ESTAMOS TORCENDO POR VOCÊS!!!') .
                    $this->Html->tag('span',
                        $this->Html->link('Voltar', '/animals/', array('class' => 'btn btn-outline-primary btn-lg', 'style' => array('margin-top:5px;')))
                    )
                ) 
            ) 
        )
    ) .
    $this->element('footer');
    
?>