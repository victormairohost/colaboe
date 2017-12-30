<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author harry
 */
class Admin {

    //put your code here
    private $user = 0, $conn = 0;

    function Admin(User $user) {
        $this->user = $user;
        $this->conn = $user->conn;
    }

    function blockS(User $user) {
        if($user->admin == $this->user->admin) return;
        $v = $user->block==1?0:1;
        $query = "UPDATE accounts SET block=$v WHERE uid=$user->uid";
        mysqli_query($this->conn, $query);
    }

    function makeAdmin(User $user) {
        if($this->user->admin==1) return;
        $query = "UPDATE accounts SET admin=1 where uid=$user->uid";
        mysqli_query($this->conn, $query);
    }

    function remAdmin(User $user) {
        if($this->user->admin==1) return;
        $query = "UPDATE accounts SET admin=0 where uid=$user->uid";
        mysqli_query($this->conn, $query);
    }
    
    function getUsers() {
        $query = "SELECT * FROM persons ORDER BY uid DESC";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return;
        $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($rows) < 1)
            return;
        for ($index = 0; $index < count($rows)-1; $index++)
            $row[$index] = new User($rows[$index]['email']);
        return $row;
    }
    
    function getBlocks() {
        $query = "SELECT * FROM blist ORDER BY uid DESC";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return;
        $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($rows) < 1)
            return;
        for ($index = 0; $index < count($rows); $index++){
            $row[0] = new User($rows[$index]['uid']);
            $row[1] = new User($rows[$index]['uid2']);
            $row[2] = $rows[$index]['reason'];
            $ro[$index] = $row;
        }
        return $ro;
    }

}

