<?php
use App\Models\Journal;
session_start();
require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';
//print_r($_SESSION);
if($_SESSION){
   $data['nom'] = $_SESSION['name']; 
}else{
    $data['nom'] = 'visiteur'; 
}

?>