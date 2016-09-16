<?php

/**
 *
 */
class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function post($year, $title)
    {
        // $post = $this->post->getPostById($id);
        $post = $this->post->getPostByYearTitle($year, $title);

        if ($post == null) {
            echo 'ERROR';
            return;
        }
        // die(var_dump($post->img));
        if (!isset($post->img) || $post->img == '') {
            $post->img = "home-bg.jpg";
        }

        $data = [
            'title'     => 'Blog',
            'app'       => $post->title,
            'content'   => $post->content
        ];


        $this->load->view("guest/head", $data);
        $this->load->view("guest/nav", $data);
        $this->load->view("guest/header", compact('post'));
        $this->load->view("guest/post", compact('post'));
        $this->load->view("guest/footer");
    }

    public function create()
    {
        if (!$this->session->userdata('login')) {
            header("Location: " . base_url());
        }
        $data = [
            'title' => 'Blog',
            'app'   => 'Blog',
        ];

        $this->load->view("guest/head", $data);
        $this->load->view("guest/nav", $data);
        $post = [
            'title' => 'New Post',
            'description' => '',
            'img' => 'home-bg.jpg'
        ];
        $post = (object) $post;
        $this->load->view("guest/header", compact('post'));
        $this->load->helper('bootstrap');
        $this->load->view("users/create");
        $this->load->view("guest/footer");
    }

    public function store()
    {
        if (!$this->session->userdata('login')) {
            header("Location: " . base_url());
        }
        $post = $this->input->post();
        $this->load->model('file');
        $file_name = $this->file->UploadImage('./public/img/', 'Dont posible to upload the image');
        $post['file_name'] = $file_name;
        $bool = $this->post->save($post);

        if ($bool) {
            header('Location: ' . base_url() . 'profile/');
        } else {
            header('Location: ' . base_url() . 'article/create');
        }
    }

    public function edit($id)
    {
        if (!$this->session->userdata('login')) {
            header("Location: " . base_url());
        }
        $post = $this->post->getPostById($id);
        // die(var_dump($post->img));
        if (!isset($post->img) || $post->img == '') {
            $post->img = "home-bg.jpg";
        }
        $data = [
            'title' => 'Blog',
            'app'   => 'Blog',
        ];

        $this->load->view("guest/head", $data);
        $this->load->view("guest/nav", $data);

        $this->load->view("guest/header", compact('post'));
        $this->load->helper('bootstrap');
        $this->load->view("users/edit", compact('post'));
        $this->load->view("guest/footer");
    }

    public function update($id)
    {
        $post = $this->input->post();
        if ($this->post->update($id, $post))
        {
            header("Location: " . base_url('profile'));            
        }

    }

    public function delete()
    {
        $post = $this->input->post();

        $id = $post['id'];

        if ($this->post->destroy($id)) {
            echo  $id;
        }
    }
}
