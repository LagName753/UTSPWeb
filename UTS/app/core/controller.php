<?php

class Controller {
    public function view($view, $data = []) {
        require_once '../app/config.php'; 
        
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/'."/" . $view . '.php';
        } else {
            die('View tidak ditemukan!');
        }
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        
        $modelName = implode('_', array_map('ucfirst', explode('_', $model)));
        return new $modelName();
    }
}
