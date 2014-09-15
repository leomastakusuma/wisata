<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ordermodels extends Models{
    private $_table = 'transaksi';
    private $_tablereservasi = 'reservasi';
    
    public function saveorder($id_reservasi, $id_user, $jml,$harga,$invoice){
        $tanggal = date('Y-m-d');
        $status  = 'ord';
        $bayar   = $jml * $harga;
        
        $data = array(':id_reservasi'   => $id_reservasi,
                      ':id_user'        =>$id_user,
                      ':jml_reservasi'  => $jml,
                      ':total_harga'    => $bayar,
                      ':tgl_pemesanan'  => $tanggal,
                      ':status'         => $status,
                      ':invoice'        => $invoice
                      );
                     
        $sql  = "INSERT INTO {$this->_table}";
        $sql .= " (id_reservasi , id_user ,jml_reservasi , total_harga , tgl_pemesanan , status, invoice )";
        $sql .= " VALUES ( :id_reservasi, :id_user, :jml_reservasi, :total_harga, :tgl_pemesanan, :status, :invoice )";
        $query = $this->db->prepare($sql);
        $query->execute($data);      
       
    }
    
    public function cekorder($id_reservasi, $tanggal){
        $sql     = "SELECT * from {$this->_table} , {$this->_tablereservasi}";
        $sql    .= " WHERE $this->_table.id_reservasi = $this->_tablereservasi.id_reservasi";
        $sql    .= " AND $this->_table.tgl_pemesanan LIKE '%$tanggal%'";
        $sql    .= " AND $this->_tablereservasi.id_reservasi = $id_reservasi";
//        echo $sql;die;
        $query  = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();  
    }
    
    public function getall(){
        $sql = "SELECT * FROM $this->_table";
        $sql.= " WHERE status = 'ORD' ";
        $query  = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();  
                
        
    }
}