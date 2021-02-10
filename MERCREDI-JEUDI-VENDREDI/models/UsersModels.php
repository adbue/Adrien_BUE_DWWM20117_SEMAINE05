<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class UsersModels extends CI_Model
{
    public function Inscription()
    {
        $this->db->insert('users', $data);
    }
    function loginValid($us_login, $us_pass)
    {
        $$this->db->where('us_login', $us_login);
        $this->db->where('us_pass', $us_pass);


        if($request->num_rows() > 0)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
}