<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Enchere;
use App\Models\Timbre;
use App\Models\Image;
use App\Models\Pays;
use App\Models\Mise;
use App\Models\Couleur;
use App\Models\Condition;
use App\Models\User;

class FicheController{
    public function create(){
        
        $image = new Image;
        $timbre = new Timbre;
        $pays = new Pays;
        $enchere = new Enchere;
        $mise = new Mise;
        $utilisateur = new User;
        $couleur = new Couleur;
        $condition = new Condition;        
        $tmb = $timbre->selectAll($_GET['id'], 'id')['0'];
        $paysNom = $pays->selectAll($tmb['pays_id'], 'id', 'nom');
        $tmb += ['pays'=>$paysNom['0']['nom']];
        $tmb['certifie'] = $tmb['certifie'] == 49 ? "Oui" : "Non";
        $tmb += ['couleur'=>$couleur->selectAll($tmb['couleur_id'], 'id', 'nom')['0']['nom']];
        $tmb += ['condition'=>$condition->selectAll($tmb['condition_id'], 'id', 'nom')['0']['nom']];
        $tmb += ['utilisateur'=>$utilisateur->selectAll($tmb['utilisateur_id'], 'id', 'nom')['0']['nom']];
        $pays_utilisateur = $utilisateur->selectAll($tmb['utilisateur_id'], 'id', 'pays_id')['0']['pays_id'];
        $tmb += ['pays_utilisateur'=>$pays->selectAll($pays_utilisateur, 'id', 'nom')['0']['nom']];
        $enchereArray = $enchere->selectAll($_GET['id'], 'timbre_id')['0'];
        $tmb += ['estimation'=> $enchereArray['valeur_estimee']];
        $dataMise = ['valeur'=>$enchereArray['prix_plancher']];
        $dataMise += ['enchere_id'=>$enchereArray['id']];            
        if(isset($_SESSION['user_id'])) $dataMise += ['utilisateur_id'=>$_SESSION['user_id']];
        
        $tmb += ['enchere_id'=>$enchereArray['id']];
        $images = $image->selectAll($_GET['id'], 'timbre_id');    
        $cartes = [];        
        foreach($images as $key=>$image){
            $imgs["$key"] = $image['nom'];            
        }
        $valeurArray = $mise->selectAll($enchereArray['id'], 'enchere_id', 'valeur');
        $lengthArray = (string)count($valeurArray);
        if(!isset($_GET['index'])){
           $_SESSION['imgs'] = $imgs;          
        } 

        if(isset($_GET['index'])){  
            if( $_SESSION['index'] !== $_GET['index']) {
                $element = array_splice($_SESSION['imgs'], $_GET['index'], 1);             
                array_splice($_SESSION['imgs'], 0, 0, $element);
            }         
        
            $_SESSION['index'] = $_GET['index'];
        }
        if($lengthArray && $lengthArray !== 0){
           $miseValeur = $mise->selectAll($enchereArray['id'], 'enchere_id', 'valeur')[$lengthArray-1];
            $tmb += ['offre'=> $miseValeur['valeur']]; 
        }
        
        $enchere->initDates();
        $enchere->setDateDebut($enchereArray['debut']);
        $temps = ['jours'=>$enchere->tempsRestant()->days];
        $temps += ['heurs'=>$enchere->tempsRestant()->h];
        $temps += ['minute'=>$enchere->tempsRestant()->i];
        $temps += ['seconde'=>$enchere->tempsRestant()->s];
        return View::render("timbre/fiche", ['id'=>$_GET['id'], 'images'=>$_SESSION['imgs'], 'timbre' => $tmb, 'temps'=>$temps]); 
    }
    
    public function store($data){
        if(!isset($_SESSION['user_id'])) return View::redirect('login');
        $data = $_POST;
        $timbreId = $_POST['utilisateur_id'];
        $data['utilisateur_id'] = $_SESSION['user_id'];
        $validator = new Validator;
        $mise = new Mise;
        
        $validator->field('valeur', $data['valeur'])->required()->int();         
        if($validator->isSuccess()){
            $insert = $mise->insert($data);
            if($insert){
                return view::redirect('fiche-enchere?id='.$timbreId);
            }else{
                return view::render('error');
            }
        }else{
            $errors = $validator->getErrors(); 
            return view::redirect('fiche-enchere?id='.$timbreId, ['errors'=>123]);      
        }

    }
    
}