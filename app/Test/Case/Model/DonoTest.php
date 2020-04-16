<?php
App::uses('AppModelTestCase', 'Test'); 

class DonoTest extends AppModelTestCase {
    
    public $fixtures = array(
        'app.dono',
    );    
    
    public $modelName = 'Dono';
    
    public function testInstance() {
        $this->assertTrueInstance();
    }

    public function testInvalidNome() {
        $this->assertEqualsInvalidField('nome', null);
        $this->assertEqualsInvalidField('nome', 'Br');
    }

    public function testInvalidEmail() {
        $this->assertEqualsInvalidField('email', null);
        $this->assertEqualsInvalidField('email', 'abcdsdsdsdsdsdsd');
        $this->assertEqualsInvalidField('email', 'teste@teste.com.br');
    }

    public function testInvalidTelefone() {
        $this->assertEqualsInvalidField('telefone', null);
    }

    public function testInvalidSenha() {
        $this->assertEqualsInvalidField('password', null);
        $this->assertEqualsInvalidField('password', '12');
    }
}