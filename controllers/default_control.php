<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Default_control extends CI_Controller
{
    function __construct() {
        parent::__construct();
        ob_start();
        $this->load->model('Products');
    }
    public function index()
    {
        
        $result=$this->Products->get_all();
        if(isset($this->session->userdata['cuslog']))
        {
            $this->load->model('Customer');
        }
        $data=array('result'=>$result);
        $this->load->view('default_view',$data);
    }
}
