<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class loginmodels extends Models{
    private $_table ='user';
    
    public function loginaction($username,$password){
        $level  = 'user';
        $sql    = "select * from {$this->_table} Where user = :username and pass = :password and level = :level ";
        $query  = $this->db->prepare($sql);
        $data   = array(':username' => $username,
                        ':password' => $password,
                        ':level'    => $level);
                        
        $query->execute($data);
        return $query->fetchAll();

//        print_r($query);die;
    }
}