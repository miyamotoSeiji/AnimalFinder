<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DonoFixture extends CakeTestFixture {
    
    public $name = 'Dono';
    public $import = array('model' => 'Dono', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'nome' => 'Dono do Cachorro',
                'email' => 'teste@teste.com.br',
                'telefone' => '(14) 99633-0891',
                'password' => md5('1234'),
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s'),
                'deleted' => null,
            ),
        );
        parent::init();
    }
}
?>