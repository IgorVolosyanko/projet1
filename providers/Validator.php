<?php
namespace App\Providers;

class Validator {
    private $errors = Array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    //regles                                         
    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key]="$this->name est requis.";
        }
        return $this;
    }

    public function max($length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key]="$this->name doit être moins de $length characters.";
        }
        return $this;
    }

    public function min($length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key]="$this->name doit être plus que $length characters.";
        }
        return $this;
    }

    public function int(){
        if(!filter_var($this->value, FILTER_VALIDATE_INT)){
            $this->errors[$this->key]="$this->name doit être interger";
        }
        return $this;
    }

    public function boolean(){
        if((int)$this->value !== 1 && (int)$this->value !== 2){
            $this->errors[$this->key]="$this->name doit être 1 ou 2";
        }
        return $this;
    }

    public function double(){
        if(!filter_var($this->value, FILTER_VALIDATE_FLOAT)){
            $this->errors[$this->key]="$this->name doit être double";
        }
        return $this;
    }

    public function contain(){
        if($this->value == null || !str_contains($this->value, '.jpg')){
            $this->errors[$this->key]="$this->name du fichier doit contenir un fichier .jpg";
        }
        return $this;
    }

    public function email() {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key]="Invalid $this->name format.";
        }
        return $this;
    }

    public function unique($model){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if($unique){
            $this->errors[$this->key]="$this->name doit être unique.";
        }
        return $this;
    }

    // public function exist() {
    //     $this->errors[$this->key]="Veillez remplir les champs à nouveau.";  
    //     return $this;
    // }

    //regles fin

    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){        
        if(!$this->isSuccess()) return $this->errors;
    }
}

?>

