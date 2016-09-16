<?php

/**
 *
 */
class Login extends CI_Controller
{
    public function index()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->load->model('user');

        $user = $this->user->getUser($email);

        if ($user != null) {
            if ($user->password == $password) {
                $data = [
                    'id'       => $user->id,
                    'email'    => $email,
                    'login'    => true
                ];
                $this->session->set_userdata($data);
            } else {
                header("Location: " . base_url());
            }
        } else {
            header("Location: " . base_url());
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: " . base_url());
    }
}
