<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Condition;
use App\Models\Pays;
use App\Models\User;
use App\Models\Couleur;
use App\Models\Timbre;


class TimbreController{
    public function create(){
        $condition = new Condition;
        $conditions = $condition->select('nom');
        
        return View::render("timbre/create", ['conditions' => $conditions]); 
    }

    public function store($data){
        
        $validator = new Validator;
       
        $validator->field('nom', $data['nom'])->required()->min(2)->max(50);         
        $validator->field('tirage', $data['tirage'])->required()->min(1)->max(50);
        $validator->field('dimension', $data['dimension'])->required()->int();
        $validator->field('couleur_id', $data['couleur_id'])->required()->min(3);
        $validator->field('pays_id', $data['pays_id'])->required()->min(3)->max(50);        
        $validator->field('certifie', $data['certifie'])->required()->boolean();
        $validator->field('condition_id', $data['condition_id'], 'nom')->required()->int();
        

        if($validator->isSuccess()){
            $pays = new Pays;
            $user = new User;
            $couleur = new Couleur;
            $timbre = new Timbre;
            $nomClient = $_SESSION['user_name'];
            $data['utilisateur_id'] = $user->selectValueId('id', 'nom_utilisateur', $nomClient);
            $paysExiste = $pays->selectValueId('id', 'nom', $data['pays_id']);
            if($paysExiste){
                $data['pays_id'] = $paysExiste;
            }else{
                $paysArray = ['nom' => $data['pays_id']];            
                $data['pays_id'] = $pays->insert($paysArray);
            }
           
            $couleurExiste = $couleur->selectValueId('id', 'nom', $data['couleur_id']);
            if($couleurExiste){
                $data['couleur_id'] = $couleurExiste;
            }else{
                $couleurArray = ['nom' => $data['couleur_id']];            
                $data['couleur_id'] = $couleur->insert($couleurArray);
            } 
            $data['certifie'] = (int)$data['certifie'];
            $insert = $timbre->insert($data);
            
            if($insert){
                return view::redirect('image');
            }else{
                return view::render('error');
            }

         }else{
            $errors = $validator->getErrors();
            $condition = new Condition;
            $conditions = $condition->select('nom');
            return view::render('timbre/create', ['errors'=>$errors, 'conditions' => $conditions, 'timbre' =>$data]);
         }

    }
}


?>