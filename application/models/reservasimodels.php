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

    //update dengan gambar
    public function updatereservasiall($tgl,$tujuan,$paket,$harga,$gambar,$id){
        // echo $tgl .'<br>'.$tujuan .'<br>'.$paket.'<br>'. $harga .'<br>'. $gambar.'<br>' . $id;die ;
        $sql    = "UPDATE {$this->table} SET tgl_reservasi = ? , tujuan = ? , harga = ? ,include_paket = ? , image = ? WHERE id_reservasi = ?";
        $query  = $this->db->prepare($sql);
        $query->execute(array($tgl , $tujuan , $harga , $paket ,$gambar , $id));
                     
    }

    //update tampa gambar
    public function updatereservasi($tgl,$tujuan,$paket,$harga,$id)
    {
       $sql     = "UPDATE {$this->table} SET tgl_reservasi = ? , tujuan = ? , harga = ? ,include_paket = ?  WHERE id_reservasi = ?";
       $query   = $this->db->prepare($sql);
       $query->execute(array($tgl, $tujuan ,  $harga ,$paket ,$id));
    }
    
    public function deletereservasi($id){
        $sql     = "DELETE FROM {$this->table} ";
        $sql    .= " WHERE id_reservasi = {$id}";
        $query   = $this->db->prepare($sql);
        $query->execute(array(":id_reservasi" => $id));
    }
}