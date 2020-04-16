<?php
    if (!$this->request->is('ajax')) {
       echo $this->element('header');    
    }
    
    $animaisPerdidos = null; 
    
    if (!empty($animals)) {
        $statusColor = array('Perdido' => 'text-danger', 'Comunicado' => 'text-warning', 'Encontrado' => 'text-success');
        foreach ($animals as $animal) {
            $botaoAlterar = null;
            $botaoStatus = $this->Html->link('ENCONTREI!!!', '/animals/encontrei/' . $animal['Animal']['id'], array('class' => 'btn btn-outline-primary btn-sm'));    
            if (!empty($donoLogado)) {
                $botaoAlterar = $this->Html->link('Alterar dados', '/animals/edit/' . $animal['Animal']['id'], array('class' => 'btn btn-outline-primary btn-sm'));
                $botaoStatus = $this->Html->link('Alterar status', '/animals/statusUpdate/' . $animal['Animal']['id'], array('class' => 'btn btn-outline-primary btn-sm'));    
            } 
            $animaisPerdidos .= $this->Html->div('col-md-4', 
                $this->Html->div('card shadow-sm',
                    $this->Html->tag('title', $animal['Animal']['nome']) .
                    $this->Html->image('../app/webroot/img/perdidos/' . $animal['Animal']['dono_id'] . '/' . $animal['Animal']['foto'], array('alt' => $animal['Animal']['nome'] , 'style' => 'margin-bottom:10px;', 'width'=>'100%', 'height'=>'100%')) .
                    $this->Html->div('card-body',
                        $this->Html->tag('h6', 'Meu nome é ' . $animal['Animal']['nome'] . ' tenho ' . $animal['Animal']['idade'] . ' anos.') .
                        $this->Html->tag('h6', 'Me perdi em ' . $animal['Animal']['cidade'] . ' / ' . $animal['Animal']['estado']) .
                        $this->Html->tag('h6', 'Status: ' . $animal['Animal']['status'], array('class' => $statusColor[$animal['Animal']['status']])) .
                        $this->Html->tag('p', $animal['Animal']['info']) .
                        $this->Html->div('d-flex justify-content-between align-items-center',
                            $this->Html->div('btn-group',
                                $botaoAlterar .
                                $botaoStatus
                            )
                        )
                    )
                )
            , array('style' => 'margin-bottom:20px;'));
        }
    } else {
        $animaisPerdidos = $this->Html->div('col-md-10 offset-md-1',
            $this->Html->div('card',
                $this->Html->div('card-body text-center',
                    $this->Html->tag('i', '', array('class' => 'fas fa-dog')) . " Olá! Não encontramos nenhum registro de animais perdidos! Caso queira cadastrar um, Clique no botão abaixo! " . $this->Html->tag('i', '', array('class' => 'fas fa-cat')) .
                    $this->Html->link('Cadastrar animal perdido', '/animals/add', array('class' => 'btn btn-large btn-outline-primary', 'style' => 'margin-top:10px'))
                )
            , array('style' => 'height: 7rem;'))
        );
    }
    
    $apresentacao = $this->Html->tag('section',
        $this->Html->div('container', 
            $this->Html->tag('h1', 'ANUNCIE SEU PET PERDIDO') .
            $this->Html->tag('p', 'Se você  está sofrendo porque perdeu seu animalzinho, não se desespere, estamos aqui para ajudar você! Cadastre-se e informe os dados do seu bixinho, ele ficará exposto para todas as pessoas apaixonadas por pets, como você e como nós, permitindo que você seja notificado assim que alguem encontrar o seu querido amiguinho!') .
            $this->Html->tag('p', 
                $this->Html->link('Cadastrar', '/cadastrar', array('class' => 'btn btn-outline-primary btn-large'))
            ) .
            $this->Html->tag('p', 'Visualize todos os  animaizinhos que estão perdidos e ajude-os a voltar para casa, clique em "Encontrei" e comunique o dono. Ajude os a viverem felizes para sempre com seus donos o quanto antes.')
        )
    , array('class' => 'jumbotron text-center'));
    
    $cadastrarAnimalPerdido = null;
    if (!empty($donoLogado)) {
        $apresentacao = null;
        $cadastrarAnimalPerdido = $this->Html->div('col-md-12 text-center', 
            $this->Html->tag('i', '', array('class' => 'fas fa-paw fa-5x', 'style' => 'margin-right:10px;')) . $this->Html->link('Cadastrar animal perdido', '/animals/add', array('class' => 'btn btn-large btn-outline-primary', 'style' => 'margin-bottom:50px')) . $this->Html->tag('i', '', array('class' => 'fas fa-paw fa-5x px-10', 'style' => 'margin-left:10px;'))
        );
    }
    echo $apresentacao .
        $this->Html->div('py-5 bg-light',
            $this->Html->div('container',
                $this->Html->div('row',
                    $cadastrarAnimalPerdido .
                    $animaisPerdidos .
                    $this->Html->div('col-md-12',
                        $this->Paginator->numbers()
                    )  
                )
            )
        ) .
        $this->element('footer');

?>
