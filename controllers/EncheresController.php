<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Enchere;
use App\Models\Timbre;
use App\Models\Image;

class EncheresController{
    public function create(){
        if(!isset($_SESSION['user_id'])) return View::redirect('login');
        $image = new Image;
        $timbre = new Timbre;
        $timbreIds = $timbre->selectAll($_SESSION['user_id'], 'utilisateur_id', 'id');
        $images = $image->selectAll($timbreIds['0']['id'], 'timbre_id');
        $cartes = [];
        foreach($timbreIds as $key=>$timbreId){
            $images = $image->selectAll($timbreId['id'], 'timbre_id');
            $cartes["$key"] = ['image'=> $images['0']['nom']];
            $cartes["$key"] += ["timbre_id"=>$timbreId['id']];
        }
        return View::render("timbre/encheres", ['cartes'=>$cartes, 'nom'=>$_SESSION['name']]); 
    }

    
    public function delete(){ 
        $enchere = new Enchere;
        $image = new Image;
        $timbre = new Timbre;
        $deleteEnchere = $enchere->deleteId($_POST['id'], 'timbre_id');
        $deleteImages = $image->deleteId($_POST['id'], 'timbre_id');
        $deleteTimbre = $timbre->deleteId($_POST['id'], 'id');
        if($deleteTimbre){
            return View::redirect('encheres');            
        }else{
            return view::render('error');
        }
         
    }
}

?>