<?php
class Model_auth extends CI_Model
{

    public function login($email, $password)
    {
        $chek =  $this->db->get_where('user', array('email_user' => $email, 'password_user' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return $chek->row();
        } else {
            return false;
        }
    }
}
