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
    
    //public function isUploadFile($check) {
//        $isUpload = false;
//        $files = array_values($check);    
//        $fieldNames = array_keys($check);
//        if (!empty($files[0])) {
//            $isUpload = true;
//            if (is_array($files[0])) {
//                $fileName = $this->getUploadedFile($files[0]);
//                CakeLog::notice(json_encode($fileName));
//                $isUpload = !empty($fileName);
//                if ($isUpload) {
//                    $this->data[$this->name][$fieldNames[0]] = $fileName;
//                }
//            }
//        }
//        
//        return $isUpload;
//    }
//        
//    public function getUploadedFile($file) {
//        $uploaded = '';
//        clearstatcache();
//        if ((isset($file['error']) && $file['error'] == 0) || (!empty($file['tmp_name']) && $file['tmp_name'] != 'none')) {
//            $uploadedFileTemp = $file['tmp_name'];
//            if (is_uploaded_file($uploadedFileTemp)) {
//                $nomeArquivoDestino = $this->getNomeArquivoDestino($file['name']);  
//                if (file_exists($nomeArquivoDestino)) {
//                    unlink($nomeArquivoDestino);
//                }
//                if (move_uploaded_file($uploadedFileTemp, $nomeArquivoDestino)) { 
//                    $uploaded = basename($file['name']);
//                }                
//            }
//        } 
//        
//        return $uploaded;   
//    }
        
}