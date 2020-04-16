<?php
class UploadBehavior extends ModelBehavior {
    
    public function imageUpload(Model $model, $image, $donoId) {
        $upload = false;
        if (!empty($image) && is_array($image)) {
            clearstatcache();
            if ((isset($image['error']) && $image['error'] == 0) || (!empty($image['tmp_name']) && $image['tmp_name'] != 'none')) {
                $uploadedFileTemp = $image['tmp_name'];
                if (is_uploaded_file($uploadedFileTemp)) {
                    $path = IMAGES . $donoId;
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                        chmod($path, 0777);
                    }
                    $pathFile = $path . DS . $image['name'];
                    if (file_exists($pathFile)) {
                        list($fileName, $ext) = explode('.', $pathFile);
                        $pathFile = $fileName . date('Ymd-His') . '.' . $ext;
                        $image['name'] = basename($pathFile);
                    }
                    if (move_uploaded_file($uploadedFileTemp, $pathFile)) { 
                        $upload = Router::url('/img/' . $donoId . '/' . $image['name']);                                
                    }                
                }
            } 
        }
        
        return $upload;
    }  
            
}
