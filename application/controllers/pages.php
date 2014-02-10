<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        redirect(base_url());
    }
    
    public function login(){
        $data = $this->layoutmodel->main("Gridphoria | Login");
        $this->load->view("layout/header", $data);
        $this->load->view("pages/login", $data);
        $this->load->view("layout/footer", $data);
    }
    public function register(){
        $data = $this->layoutmodel->main("Gridphoria | Register");
        $this->session->unset_userdata("uid");
        $this->session->unset_userdata("logged_in");
        $this->session->unset_userdata("login_time");
        $this->load->view("layout/header", $data);
        $this->load->view("pages/register", $data);
        $this->load->view("layout/footer", $data);
    }

}