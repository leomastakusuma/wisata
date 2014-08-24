<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class reservasimodels extends Models {
    private $table = 'reservasi';
    
    public function getall(){
        $data = $this->select('*', $this->table);
        return $data;
    }
}