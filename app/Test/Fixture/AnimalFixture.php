<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class AnimalFixture extends CakeTestFixture {
    
    public $name = 'Animal';
    public $import = array('model' => 'Animal', 'records' => false);

    public function init() {
        $this->records = array(
            array(
                'id' => 1,
                'dono_id' => '1',
                'foto' => 'fotoAuau.jpg',
                'nome' => 'Auau',
                'idade' => 5,
                'info' => 'Pelo caramelo focinho preto, cachorro tipico BR, foi fuçar o lixo do vizinho e não voltou mais.',
                'cidade' => 'Marília',
                'estado' => 'SP',
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