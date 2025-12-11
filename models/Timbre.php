<?php
namespace App\Models;
use App\Models\CRUD;

class Timbre extends CRUD{
    protected $table = "timbre";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'tirage', 'dimension', 'couleur_id', 'pays_id', 'certifie', 'condition_id', 'utilisateur_id']; 
}

?>