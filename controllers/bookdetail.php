<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Bookdetail extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Products');
    }
    
    public function index($id)
    {
        $product=$this->Products->get_By_id($id);
        $data=array('product'=>$product);
        $this->load->view('book_view',$data);
    }
    
}

