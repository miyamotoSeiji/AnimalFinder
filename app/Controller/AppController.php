<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
 
    public $helpers = array(
        'Html', 
        'Js' => array('Jquery'), 
        'Form', 
        'Session', 
        'Flash',
        'Time',
    );  

    public $components = array(
        'RequestHandler', 
        'Session',
        'Flash',
    );
}
?>
