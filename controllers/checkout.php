<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Checkout extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        
        $this->load->model('Orders');
    }
    public function index()
    {
        $orderid=$this->Orders->check_order();
        $cus=$this->session->userdata['customer'];
        if($orderid===FALSE)
        {
            $this->load->view('check_view',array('success'=>FALSE,'cus'=>$cus));
            exit;
        }
        $success=$this->Orders->check_detail($orderid);
        $this->cart->destroy();
        $id=$cus->customerid;
        $this->db->delete('cart',array('customerid'=>$id));
        $this->load->view('check_view',array('success'=>$success,'cus'=>$cus));
    }
}


