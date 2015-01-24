<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Myaccount extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('orders');
    }
    public function index()
    {
        $cuslog=$this->session->userdata['cuslog'];
        $where=array('customerid'=>$cuslog);
        $query=$this->db->get_where('orders',$where,50,0);
        $this->load->view('profile',array('result'=>$query));
    }
    public function order_detail($id)
    {
         $sql="SELECT name,quantity,O.price,billaddr,shipaddr FROM products P,orderdetail O,orders WHERE P.product_id=O.product_id AND O.orderid=$id group by name";
         $query=$this->db->query($sql);
         foreach ($query->result_array() as $row)
         {
             foreach ($row as $key => $value) {
                          echo "$key:$value&nbsp&nbsp";
                       }
                       echo "<br><br>";
         }
    }
}