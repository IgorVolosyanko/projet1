<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Privilege;
use App\Models\User;
use App\Models\Ville;
use App\Models\Pays;
use App\Models\Image;
use App\Models\Couleur;
use App\Models\Timbre;
use App\Models\Enchere;

class ClientController{
    public function index(){
        $enchere = new Enchere;
        $timbre = new Timbre;
        $image = new Image;
        $pays = new Pays;
        $timbreInfos = $timbre->select();
        $cartes = [];
        foreach($timbreInfos as $timbreInfo){
            $id = $timbreInfo['id'];
            $cartes += ["$id" => ["image"=>$image->selectAll($timbreInfo['id'], 'timbre_id')['0']['nom']]];
            $cartes["$id"] += ["nom"=>$timbreInfo['nom']];
            $cartes["$id"] += ["tirage"=>$timbreInfo['tirage']];
            $cartes["$id"] += ["certifie"=>$timbreInfo['certifie']===49 ? 'certifié' : 'non certifié'];
            $cartes["$id"] += ["pays"=>$pays->selectValueId('nom', 'id', $timbreInfo['pays_id'])];
        }
        // print_r($cartes);
        return View::render("client/index", ['cartes'=>$cartes]); 
    }

    public function create(){
        $privilege = new Privilege;
        $privileges = $privilege->select('nom');
        return View::render('client/create', ['privileges' => $privileges]);
    }

    public function store($data){
        
        $validator = new Validator;
       
        $validator->field('nom', $data['nom'])->required()->min(2)->max(100);         
        $validator->field('nom_utilisateur', $data['nom_utilisateur'])->required()->min(2)->max(50)->unique('user');        
        $validator->field('mot_de_passe', $data['mot_de_passe'])->required()->min(6)->max(100);
        $validator->field('adresse', $data['adresse'])->required()->min(3)->max(50);
        $validator->field('code_postal', $data['code_postal'])->required()->min(6)->max(7);
        $validator->field('courriel', $data['courriel'])->required()->max(50)->email();        
        $validator->field('ville_id', $data['ville_id'])->required()->min(2);
        $validator->field('pays_id', $data['pays_id'])->required()->min(2);
        $validator->field('privilege_id', $data['privilege_id'], 'nom')->required()->int();


        if($validator->isSuccess()){
            $ville = new Ville;
            $pays = new Pays;
            $user = new User; 
            $villeArray = ['nom'=>$data['ville_id']];
            $paysArray = ['nom'=>$data['pays_id']];
            
            $data['ville_id'] = $ville->insert($villeArray);
            $data['pays_id'] = $pays->insert($paysArray);          
            $data['mot_de_passe'] = $user->hashPassword($data['mot_de_passe']);          
            $insert = $user->insert($data);
            if($insert){
                return view::redirect('login');
           }else{
                return view::render('error');
           }

         }else{
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('nom');
            return view::render('client/create', ['errors'=>$errors, 'privileges' => $privileges, 'client' =>$data]);
         }

    }
    // public function delete(){
    //     session_destroy();
    //     return View::redirect('login');
    // }
}

?>