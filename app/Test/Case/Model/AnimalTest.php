<?php
App::uses('AppModelTestCase', 'Test'); 

class AnimalTest extends AppModelTestCase {
    
    public $fixtures = array(
        'app.animal',
    );    
    
    public $modelName = 'Dono';
    
    public function testInstance() {
        $this->assertTrueInstance();
    }

    public function testInvalidNome() {
        $this->assertEqualsInvalidField('nome', null);
        $this->assertEqualsInvalidField('nome', 'Br');
    }

    public function testInvalidIdade() {
        $this->assertEqualsInvalidField('idade', null);
        $this->assertEqualsInvalidField('idade', 'abc');
    }

    public function testInvalidInfo() {
        $this->assertEqualsInvalidField('info', null);
        $this->assertEqualsInvalidField('info', 'abcdefghi');
    }

    public function testInvalidCidade() {
        $this->assertEqualsInvalidField('cidade', null);
        $this->assertEqualsInvalidField('cidade', 'Ma');
    }
    
    public function testInvalidEstado() {
        $this->assertEqualsInvalidField('estado', null);
    }
    
    public function testInvalidAnjoNome() {
        $this->assertEqualsInvalidField('anjo_nome', null);
        $this->assertEqualsInvalidField('anjo_nome', 'Br');
    }
    
    public function testInvalidAnjoTelefone() {
        $this->assertEqualsInvalidField('anjo_telefone', null);
    }
    
}