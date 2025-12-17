<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Enchere;
use App\Models\Mise;

class EnchereController{

    public function create(){
        if(!isset($_SESSION['user_id'])) return View::redirect('login');
        return View::render("timbre/placer"); 
    }

    public function store($data){
        $validator = new Validator;
       
        $validator->field('prix_plancher', $data['prix_plancher'])->required()->double();         
        $validator->field('valeur_estimee', $data['valeur_estimee'])->required()->double();
        
        if($validator->isSuccess()){
            $enchere = new Enchere;
            $mise = new Mise;
            $enchere->initDates();
            $data += ['coups'=>1];
            $data += ['debut'=>$enchere->getDateDebut()->format('Y/m/d H:i:s')];
            $data += ['fin'=>$enchere->getDateFin()->format('Y/m/d H:i:s')];
            $data += ['timbre_id'=>$_GET['id']]; 
            $dataMise = ['valeur'=>$data['prix_plancher']];
            
            $insert = $enchere->insert($data);           
            
            if($insert){
                $dataMise += ['enchere_id'=>$insert];
                $dataMise += ['utilisateur_id'=>$_SESSION['user_id']];
                $mise->insert($dataMise);
                return view::redirect('');
            }else{
                return view::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            return view::render('timbre/placer', ['errors'=>$errors, 'timbre' =>$data]);        
        }
    }
}

?>