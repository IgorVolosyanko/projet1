<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Enchere;

class EnchereController{

    public function create(){
        return View::render("timbre/placer"); 
    }

    public function store($data){
        $validator = new Validator;
       
        $validator->field('prix_plancher', $data['prix_plancher'])->required()->double();         
        $validator->field('valeur_estimee', $data['valeur_estimee'])->required()->double();
        if($validator->isSuccess()){
            $enchere = new Enchere;
            $enchere->initDates();
            $data += ['coups'=>1];
            $data += ['debut'=>$enchere->getDateDebut()->format('Y/m/d H:i:s')];
            $data += ['fin'=>$enchere->getDateFin()->format('Y/m/d H:i:s')];
            $data += ['timbre_id'=>$_GET['id']];            
            
            $insert = $enchere->insert($data);           
            
            if($insert){
                return view::redirect('');
            }else{
                return view::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            return view::render('timbre/image', ['errors'=>$errors, 'timbre' =>$data]);        
        }
    }
}

?>