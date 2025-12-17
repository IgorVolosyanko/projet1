<?php
namespace App\Models;
use App\Models\CRUD;

class Mise extends CRUD{
    protected $table = "mise";
    protected $primaryKey = "id";
    protected $fillable = ['valeur', 'enchere_id', 'utilisateur_id'];
}

?>