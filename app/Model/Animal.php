<?php
App::uses('AppModel', 'Model');

class Animal extends AppModel {
       
    public $belongsTo = array(
        'Dono',
    );
    
    public $validate = array(
        'nome' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o seu nome'
            ),
            'minLengh' => array(
                'rule' => array('minLength', 3),
                'message' => 'O nome deve ter pelo menos 3 digitos'
            )
        ),
        'foto' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Carregue uma imagem'
            ),
            'image' => array(
                'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
                'message' => 'Carregue uma imagem válida'
            )
        ),
        'idade' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe a idade do seu animal'
            ), 
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please supply the number of cars.'
            )
        ),
        'cidade' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe a cidade em que seu animal desapareceu'
            ),
            'minLengh' => array(
                'rule' => array('minLength', 3),
                'message' => 'A cidade deve ter pelo menos 3 digitos'
            )
        ),
        'estado' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o estado da cidade em que seu animal desapareceu'
            )
        ),
        'info' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Descreva seu animal e a situação em que ele se perdeu.'
            ),
            'minLengh' => array(
                'rule' => array('minLength', 10),
                'message' => 'A informação deve ter pelo menos 10 digitos'
            )
        ),
        'anjo_nome' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Descreva seu animal e a situação em que ele se perdeu.'
            ),
            'minLengh' => array(
                'rule' => array('minLength', 3),
                'message' => 'O nome deve ter pelo menos 3 digitos'
            )
        ),
        'anjo_telefone' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Descreva seu animal e a situação em que ele se perdeu.'
            )
        ),
    );
}