<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Timbre;
use App\Models\Image;
use App\Models\Pays;
use App\Models\Enchere;
use DateTime;

class FiltreController{

    public function filter(){
        $timbre = new Timbre;
        $image = new Image;
        $pays = new Pays;
        $enchere = new Enchere;
        $now = new DateTime();
        $enchereIds = $enchere->select();
        $timbreInfos = [];
        if($_GET['id'] == 1){
            $paysId = $pays->selectAll('Canada', 'nom', 'id')['0']['id'];            
            $timbreInfos = $timbre->selectAll($paysId, 'pays_id');                        
        }else if($_GET['id'] == 2){
            $paysId = $pays->selectAll('USA', 'nom', 'id')['0']['id'];            
            $timbreInfos = $timbre->selectAll($paysId, 'pays_id');
        }else if($_GET['id'] == 3){
            $paysId = $pays->selectAll('France', 'nom', 'id')['0']['id'];            
            $timbreInfos = $timbre->selectAll($paysId, 'pays_id');
        }else if($_GET['id'] == 4){
            $paysId = $pays->selectAll('Italie', 'nom', 'id')['0']['id'];            
            $timbreInfos = $timbre->selectAll($paysId, 'pays_id');
        }else if($_GET['id'] == 5){
            $timbreIds = $enchere->selectAll('50', 'coups', 'timbre_id');
            foreach($timbreIds as $key=>$timbreId){
                $timbreInfos += ["$key"=>$timbre->selectAll($timbreId['timbre_id'], 'id')['0']];                
            }
        }else if($_GET['id'] == 6){
            foreach($enchereIds as $enchereId){
                $date = new DateTime($enchereId['fin']);
                if($date<$now){
                    $timbreInfos += [$enchereId['timbre_id']=>$timbre->selectAll($enchereId['timbre_id'], 'id')['0']];              
                }            
            }
            
        }
           
        $cartes = [];
        foreach($timbreInfos as $timbreInfo){
            $id = $timbreInfo['id'];
            $cartes += ["$id" => ["image"=>$image->selectAll($timbreInfo['id'], 'timbre_id')['0']['nom']]];
            $cartes["$id"] += ["nom"=>$timbreInfo['nom']];
            $cartes["$id"] += ["tirage"=>$timbreInfo['tirage']];
            $cartes["$id"] += ["certifie"=>$timbreInfo['certifie']===49 ? 'certifié' : 'non certifié'];
            $cartes["$id"] += ["pays"=>$pays->selectValueId('nom', 'id', $timbreInfo['pays_id'])];
            $cartes["$id"] += ["status"=>'en vente'];
        }
       
        foreach($enchereIds as $key=>$enchereId){
            $date = new DateTime($enchereId['fin']);
            if($date<$now){                
                // $cartes[$enchereId['timbre_id']]["status"] = 'vendu';                                 
            }            
        }
        return View::render("client/filtre", ['cartes'=>$cartes]); 
    }

    public function filterPrix(){
        print_r($_POST);
        $enchere = new Enchere;
        $timbre = new Timbre;
        $image = new Image;
        $pays = new Pays;
        $now = new DateTime();
        $enchereTables = $enchere->selectBetween('prix_plancher', $_POST['prix-bas'], $_POST['prix-haut']);
        $cartes = []; 
               
        foreach($enchereTables as $key=>$enchereTable){
            $tmb = $timbre->selectAll($enchereTable['timbre_id'], 'id')['0'];          
            $id = $tmb['id'];
            $cartes += ["$id" => ["image"=>$image->selectAll($tmb['id'], 'timbre_id')['0']['nom']]];
            $cartes["$id"] += ["nom"=>$tmb['nom']];            
            $cartes["$id"] += ["tirage"=>$tmb['tirage']];
            $cartes["$id"] += ["certifie"=>$tmb['certifie']===49 ? 'certifié' : 'non certifié'];
            $cartes["$id"] += ["pays"=>$pays->selectValueId('nom', 'id', $tmb['pays_id'])];
            $cartes["$id"] += ["status"=>'en vente'];
            print_r($cartes);
        }
        $enchereIds = $enchere->select();
        foreach($enchereIds as $key=>$enchereId){
            $date = new DateTime($enchereId['fin']);
            if($date<$now){                
                // $cartes[$enchereId['timbre_id']]["status"] = 'vendu';                                 
            }            
        }
        return View::render("client/filtre", ['cartes'=>$cartes]); 
    }
}

?>