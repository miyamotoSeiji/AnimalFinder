<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DonoFixture extends CakeTestFixture {
    
    public $name = 'Dono';
    public $import = array('model' => 'Dono', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'dono_id' => '1',
                'foto' => 'fotoAuau.jpg',
                'nome' => 'Auau',
                'idade' => 5,
                'info' => 'Pelo caramelo focinho preto, cachorro tipico BR, foi fu�ar o lixo do vizinho e n�o voltou mais.',
                'cidade' => 'Mar�lia',
                'Estado' => 'SP',
                'status' => 'Perdido',
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s'),
                'deleted' => null,
            ),
        );
        parent::init();
    }
}
?>