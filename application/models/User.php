<?php

/**
 *
 */
class User extends CI_Model
{

    public function getUser($email = '')
    {
        $query = $this->db->query("SELECT * FROM user WHERE email = '$email' LIMIT 1");

        if($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }
}
