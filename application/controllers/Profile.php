<?php

/**
 *
 */
class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . base_url());
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Blog',
            'app'   => 'Blog',
        ];

        $this->load->view("guest/head", $data);
        $this->load->view("guest/nav", $data);
        $post = ['title' => 'Profile', 'description' => 'It is your profile.', 'img' => 'home-bg.jpg'];
        $post = (object) $post;
        $this->load->view("guest/header", compact('post'));

        $posts = $this->post->getPost()->result();
        $this->load->view("users/content", compact('posts'));
        $this->load->view("guest/footer");
    }
}
