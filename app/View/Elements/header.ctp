<?php
    $donoLogado = $this->Session->read('donoLogado');
    $botaoCadastrar = $this->Html->link('Cadastrar', '/cadastrar', array('class' => 'btn btn-outline-warning', 'style' => array('margin-right:5px;')));
    $botaoEntrar = $this->Html->link('Entrar', '/entrar', array('class' => 'btn btn-outline-warning'));
    $botaoPerfil = null;
    if (!empty($donoLogado)) {
        $botaoCadastrar = null;
        $botaoEntrar = null;
        $botaoPerfil = $this->Html->div('btn-group',
            $this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fas fa-cat')) . ' Olá ' . $donoLogado['Dono']['nome'], array('type' => 'button', 'class' => 'btn btn-outline-warning dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false')) .
            $this->Html->div('dropdown-menu', 
                $this->Html->link('Alterar meus dados', '/donos/edit/' . $donoLogado['Dono']['id'], array('class' => 'dropdown-item')) .
                $this->Html->link('Trocar senha', '/donos/trocarSenha/' . $donoLogado['Dono']['id'], array('class' => 'dropdown-item')) .
                $this->Html->div('dropdown-divider', '') .
                $this->Html->link('Sair', '/donos/logout', array('class' => 'dropdown-item')) 
            )
        ); 
    }
    
    echo $this->Html->div('navbar navbar-dark bg-dark shadow-sm', 
        $this->Html->div('container d-flex justify-content-between',
            $this->Html->div('col-md-4',  
                $this->Html->tag('a', 
                    $this->Html->tag('strong', $this->Html->tag('i', '', array('class' => 'fas fa-dog fa-3x')) . 'Animal ' . $this->Html->tag('i', '', array('class' => 'fas fa-search')) . ' Finder'), 
                array('class' => 'navbar-brand d-flex align-items-center', 'href' => '/AnimalFinder/inicio'))
            ) .
            $this->Html->div('col-md-8 text-right',
                $botaoCadastrar . 
                $botaoEntrar .
                $botaoPerfil
            )
        )
    );
    echo $this->Flash->render();
?>
