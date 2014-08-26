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
     
    public function insertreservasi($tanggal,$tujuan,$harga,$paket,$gambar){
       
        $data = array(':tgl_reservasi' => $tanggal,
                      ':tujuan'        => $tujuan,
                      ':harga'         => $harga,
                      ':include_paket' => $paket,
                      ':image'         => $gambar
                      );

        $sql  = "INSERT INTO {$this->table}";
        $sql .= " (tgl_reservasi , tujuan, harga, include_paket, image)";
        $sql .= " VALUES ( :tgl_reservasi, :tujuan, :harga, :include_paket, :image )";
        $query = $this->db->prepare($sql);
      
        $query->execute($data);       
        
    }
    
    public function deletereservasi($id){
        $sql     = "DELETE FROM {$this->table} ";
        $sql    .= " WHERE id_reservasi = {$id}";
        $query   = $this->db->prepare($sql);
        $query->execute(array(":id_reservasi" => $id));
    }
}