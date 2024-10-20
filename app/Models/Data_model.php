<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_model extends Model
{
    public function add_data($table, $data)
    {
        $db = \config\Database::connect();
        $builder = $db->table($table);
        $query = $builder->insert($data);
        return $query;
    }

    public function update_data($table, $data)
    {

        $db = \config\Database::connect();
        $builder = $db->table($table);
        $builder->set($data);
        $builder->where('email', $data['email']);
        $builder->update();
        return $this->db->affectedRows();
    }



    public function getsingleDataId($table, $email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select("*");
        $builder->where('email', $email);
        $query = $builder->get();
        $row = $query->getResultArray();
        return $row;
    }



    public function getuser($table, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select("*");
        $builder->where('id', $id);
        $query = $builder->get();
        $row = $query->getResultArray();
        return $row;
    }



    public function getAllUserData($table)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select("*");
        $query = $builder->get();
        $row = $query->getResultArray();
        return $row;
    }



    public function check_login($table, $data)
    {
        $db = \config\Database::connect();
        $builder = $db->table($table);
        $builder->where('email', $data['email']);
        $query = $builder->get();
        $row = $query->getRowArray();

        if ($row) {
            if ($data['password'] == $row['password']) {
                return $row; // Return user data if login is successful
            }
        }

        return null; // Return null if login fails
    }


    public function userUpdate($table, $data)
    {

        $db = \config\Database::connect();
        $builder = $db->table($table);
        $builder->set($data);
        $builder->where('id', $data['id']);
        $builder->update();
        return $this->db->affectedRows();
    }
}
