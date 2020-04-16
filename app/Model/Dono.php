<?php
App::uses('AppModel', 'Model');

class Dono extends AppModel {
       
    public $hasMany = array(
        'Animal' => array('conditions' => array('Animal.deleted IS NULL')),
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
        'email' => array(
            'email' => array('rule' => 'email','message' => 'E-mail inválido.'),
            'isUnique' => array(
                'rule' => array('isUnique', array('email', 'deleted'), false),
                'message' => 'E-mail já cadastrado.',
                'on' => 'create'
            ),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o seu E-mail para contato'
            )
        ),
        'telefone' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe o seu Telefone para contato'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Informe uma senha'
            ),
            'minLengh' => array(
                'rule' => array('minLength', 4),
                'message' => 'A senha deve ter pelo menos 4 digitos'
            )
        ),
        
    );

    public function beforeSave($options = array()) {
        if (isset($this->data['Dono']['password'])) {
            $this->data['Dono']['password'] = md5($this->data['Dono']['password']);
        }
        
        return true;
    }
}