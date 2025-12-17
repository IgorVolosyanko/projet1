<?php
namespace App\Models;
use App\Models\CRUD;

class Favori extends CRUD{
    protected $table = "favori";
    protected $primaryKey = "id";
    protected $fillable = ['timbre_id', 'utilisateur_id'];
}

?>