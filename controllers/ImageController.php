<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Timbre;
use App\Models\Image;

class ImageController{
    public function create(){
        $image = new Image;
        $timbre = new Timbre;
        $timbreId = $timbre->selectLastId();
        $images = $image->selectAll($timbreId, 'timbre_id');
        return View::render("timbre/image", ['images'=>$images]); 
    }

    public function store($data){
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->required()->contain();             
        
        if($validator->isSuccess()){

            $timbre = new Timbre;
            $image = new Image;
            $timbreId = $timbre->selectLastId();
            $data += ['timbre_id' => $timbreId];
            $insert = $image->insert($data);
            $images = $image->selectAll($timbreId, 'timbre_id');
            
            if($insert){
                return View::render("timbre/image", ['images'=>$images, 'timbre_id'=>$timbreId]);
            }else{
                return view::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            return view::render('timbre/image', ['errors'=>$errors, 'timbre' =>$data]);
         }
        

    }
    public function delete(){ 
        $image = new Image;
        $delete = $image->deleteId($_POST['id'], 'id');
        if($delete){
            return View::redirect('image');            
        }         
    }

}

?>