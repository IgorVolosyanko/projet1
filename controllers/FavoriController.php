<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Image;
use App\Models\Favori;

class FavoriController{
    public function create(){
        if(!isset($_SESSION['user_id'])) return View::redirect('login');
        $favori = new Favori;
        $image = new Image;
        if(isset($_GET['id'])){
            $data = ['timbre_id'=>$_GET['id']];
            $data += ['utilisateur_id'=>$_SESSION['user_id']];
            $favoriExiste = $favori->selectValueId('id', 'timbre_id', $_GET['id']);           
            if(!$favoriExiste){               
                $insert = $favori->insert($data);
            }
        }
        
        $timbreIds = $favori->selectAll($_SESSION['user_id'], 'utilisateur_id', 'timbre_id');
        if($timbreIds != []){
            foreach($timbreIds as $key=>$timbreId){
                $images = $image->selectAll($timbreId['timbre_id'], 'timbre_id');
                $cartes["$key"] = ['image'=> $images['0']['nom']];
                $cartes["$key"] += ["timbre_id"=>$timbreId['timbre_id']];
            }
        }else $cartes = '';         
        
        return View::render("client/favori", ['cartes'=>$cartes, 'nom'=>$_SESSION['name']]); 
    }

    public function delete(){ 
        $favori = new Favori;
        $favoriId = $favori->selectValueId('id', 'timbre_id', $_POST['id']);
        $delete = $favori->deleteId($favoriId, 'id');
        if($delete){
            return View::redirect('favori');            
        }else{
            return view::render('error');
        }         
    }

}

?>