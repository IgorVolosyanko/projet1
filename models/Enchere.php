<?php
namespace App\Models;
use App\Models\CRUD;
use DateTime;

class Enchere extends CRUD{
    protected $table = "enchere";
    protected $primaryKey = "id";
    protected $fillable = ['prix_plancher', 'valeur_estimee', 'coups', 'debut', 'fin', 'timbre_id'];

    protected DateTime $dateDebut;
    protected DateTime $dateFin;   
   
    public function initDates() {                                      
        $this->dateDebut = new \DateTime();
        $this->dateFin = $this->tempsFin();                                  
    }

    public function tempsFin(){
        $fin = clone $this->dateDebut;
        return $fin->modify('+31 days');
    }

    public function setDateDebut($dateDebut){
        $this->dateDebut = new \DateTime($dateDebut);
        $this->dateFin = $this->tempsFin();                      
    }
    
    public function getDateDebut(){
        return $this->dateDebut;                       
    }

    public function getDateFin(){
        return $this->dateFin;                       
    }
    
    public function tempsRestant(){
        $now = new DateTime();
        $diff = $now->diff($this->dateFin);
        return $diff->days; 
    }
}
?>