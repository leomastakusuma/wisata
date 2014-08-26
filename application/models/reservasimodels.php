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
       
        $data = array(':tgl' => $tanggal,
                      ':tujuan'        => $tujuan,
                      ':harga'         => $harga,
                      ':include_paket' => $paket,
                      ':image'         => $gambar
                      );

        $sql  = "INSERT INTO {$this->table}";
        $sql .= " (tgl_reservasi , tujuan, harga, include_paket, image)";
        $sql .= " VALUES ( :tgl, :tujuan, :harga, :include_paket, :image )";
        $query = $this->db->prepare($sql);
      
        $query->execute($data);      
       
        
    }
    
    public function searchreservasi($id){
        $sql    = "SELECT * from {$this->table} WHERE id_reservasi= {$id}";
        $query  = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();  
    }

    public function updatereservasiall($tgl,$tujuan,$paket,$harga,$gambar,$id){
        $data  = array(':tgl'       =>$tgl,
                       ':tujuan'    =>$tujuan,
                       ':harga'     =>$harga,
                       ':paket'     =>$paket,
                       ':gambar'    =>$gambar
                      );
        
        $sql   = "UPDATE {$this->table}";
        $sql  .= " SET tgl_reservasi = :tgl, tujuan = :tujuan, harga = :harga, include_paket = :paket, image = :image)";
        $sql  .= " WHERE id_reservasi = {$id} ";
        $query = $this->db->prepare($sql);
//        echo '<pre>';
//        print_r($data);die;
        
        $query->execute($data);
//        print_r($query);
                
    }

    
    public function deletereservasi($id){
        $sql     = "DELETE FROM {$this->table} ";
        $sql    .= " WHERE id_reservasi = {$id}";
        $query   = $this->db->prepare($sql);
        $query->execute(array(":id_reservasi" => $id));
    }
}