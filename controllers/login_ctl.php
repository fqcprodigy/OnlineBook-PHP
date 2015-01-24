<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Login_ctl extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Customer');
    }
    
    public function index()
    {
        $this->load->view('login',array('error'=>FALSE));
    }
    public function check()
    {
        $email=$this->input->post('username');
        $password=$this->input->post('password');
        $result=$this->Customer->check($email,$password);
        if($result!=FALSE)
        {
            $this->session->set_userdata('customer',$result);
            $this->session->set_userdata('cuslog',$result->customerid);
            $this->load->model('Mycart');
            if(!isset($this->session->userdata['checkout']))
            {
                redirect('/default_control');
            }
            else
            {
                redirect('/cart_ctl');
            }
        }
        else
        {
            $data=array('error'=>TRUE);
            $this->load->view('login',$data);
        }
    }
}

