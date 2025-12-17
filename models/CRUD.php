<?php
namespace App\Models;

abstract class CRUD extends \PDO {

    final public function __construct(){
        parent::__construct('mysql:host=localhost; dbname=stampee; port=8889; charset=utf8', 'root', 'root');
    }

    final public function select( $field = null, $order = 'ASC'){
        if($field == null){
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";             
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    final public function selectLastId( $field = null, $order = 'ASC'){
        if($field == null){
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";             
        $stmt = $this->query($sql);
        $numRows = $stmt->rowCount()-1; 
        return $stmt->fetchAll()[$numRows]['id'];
    }

    final public function selectAll($value, $field = null, $select = '*'){        
        $sql = "SELECT $select FROM $this->table WHERE $field = :$field"; 
        $stmt = $this->prepare($sql);            
        $stmt->bindValue(":$field", $value);        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    final public function selectBetween($field, $value1, $value2){        
        $sql = "SELECT * FROM $this->table WHERE $field BETWEEN :min AND :max"; 
        $stmt = $this->prepare($sql);            
        $stmt->bindValue(':min', $value1);
        $stmt->bindValue(':max', $value2);        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    final public function selectValueId($select, $key, $value){             
        $sql = "SELECT $select FROM $this->table WHERE $key = :$this->primaryKey";
        $stmt = $this->prepare($sql);               
        $stmt->bindValue(":$this->primaryKey", $value);       
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch()[0];
        }else{
            return false;
        }    
    }

    final public function insert($data){        
        $data_keys = array_fill_keys($this->fillable, '');        
        $data = array_intersect_key($data, $data_keys); 

        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":".implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue)";
        
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();

        return $this->lastInsertId();
    }
    
    public function deleteId($value, $field){       
        $sql = "DELETE FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        if($stmt){
            return true;
        }else{
            return false;
        }
        
    }

    public function unique ($field, $value){
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        }else{
            return false;
        }
    }
}