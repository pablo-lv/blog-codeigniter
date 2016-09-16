<?php

/**
 *
 */
class HomeController extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'Blog',
            'app'   => 'Blog',
        ];

        $this->load->view("guest/head", $data);
        $this->load->view("guest/nav", $data);
        $post = ['title' => 'New Post', 'description' => '', 'img' => 'home-bg.jpg'];
        $post = (object) $post;
        $this->load->view("guest/header", compact('post'));

        $config['base_url'] = base_url() . 'homeController/index';
        $config['total_rows'] = $this->post->numPost();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        // die(var_dump($config['per_page']));
        $query = $this->post->getPagination($config['per_page']);
        $posts = [
            'posts' => $query->result(),
            'pagination' => $this->pagination->create_links()
        ];

        $this->load->view("guest/content", $posts);
        $this->load->view("guest/footer");
        $this->load->view("home");


    }
}
