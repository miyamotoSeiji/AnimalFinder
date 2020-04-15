<?php
class AnimalsController extends AppController {
   
    var $name = 'Animals';
    
    public $uses = array('Animal', 'Dono');
    
    public $paginate = array(
        'fields' => array(
            'Animal.id',
            'Animal.dono_id',
            'Animal.foto',
            'Animal.nome',
            'Animal.idade',
            'Animal.info',
            'Animal.cidade',
            'Animal.estado',
            'Animal.status',
            'Animal.anjo_nome',
            'Animal.anjo_telefone',
        ),
        'conditions' => array('Animal.excluido' => 'N', 'Animal.status !=' => 'Encontrado'),
        'limit' => 10,
        'order' => array('Animal.created' => 'desc')
    );
      
    public function index() {
        $this->paginate['conditions'] = $this->paginateConditions();
        try {
            $records = $this->paginate(null, null, $this->paginateOrderFields);
        } catch (NotFoundException $e) {
            $this->redirect('/animals/add');
        }        
        $this->set('animals', $records);
    }

} 