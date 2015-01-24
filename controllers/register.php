<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Register extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Customer');
    }
    
    public function index()
    {
        $this->load->view('register_view');
    }

        public function add_new()
    {
        $cus=$this->Customer->insert_entry();
        if($cus!=FALSE)
        {
            $this->session->set_userdata('cuslog',$cus->customerid);
            $this->session->set_userdata('customer',$cus);
            if(!isset($this->session->userdata['checkout']))
            {
                redirect('default_control');
            }
            else
            {
                redirect('cart_ctl');
            }
        }
        else
        {
            $this->load->view('register_view',array('fail'=>TRUE));
        }
    }
     public function update_now()
     {
         $new_cus=$this->Customer->update();
         $this->session->set_userdata('customer',$new_cus);
         redirect("/myaccount");
     }
}

