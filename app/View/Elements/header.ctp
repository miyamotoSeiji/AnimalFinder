<?php
    echo $this->Html->div('navbar navbar-dark bg-dark shadow-sm', 
        $this->Html->div('container d-flex justify-content-between',
            $this->Html->div('col-md-4',  
                $this->Html->tag('a', 
                    $this->Html->tag('strong', $this->Html->tag('i', '', array('class' => 'fas fa-dog fa-3x')) . 'Animal Finder'), 
                array('class' => 'navbar-brand d-flex align-items-center', 'href' => '/AnimalFinder/inicio'))
            ) .
            $this->Html->div('col-md-8 text-right',
                $this->Html->link('Cadastrar', '/cadastrar', array('class' => 'btn btn-primary', 'style' => array('margin-right:5px;'))) . 
                $this->Html->link('Entrar', '/entrar', array('class' => 'btn btn-success'))
            )
        )
    );
?>
