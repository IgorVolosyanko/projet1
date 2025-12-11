<?php
namespace App\Models;
use App\Models\CRUD;

class User extends CRUD{
    protected $table = "utilisateur";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'nom_utilisateur', 'mot_de_passe', 'adresse', 'code_postal', 'courriel', 'telephone', 'pays_id', 'ville_id', 'privilege_id']; 

    public function hashPassword($password, $cost= 10){
         $options = [ 
            'cost' => $cost
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkUser($nomUtisateur, $password){
        $user = $this->unique('nom_utilisateur', $nomUtisateur);
        if($user){
            if(password_verify($password, $user['mot_de_passe'])){
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['nom'];
                $_SESSION['user_name'] = $user['nom_utilisateur'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                return true;
            }else{
                echo false;
            }
        }else{
            echo false;
        }
    }
}

?>