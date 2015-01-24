<?php

class Mycart extends CI_Model
{
    var $customerid;
    var $productid;
    var $quantity=0;
    var $price=0.0;
    public function __construct() {
        parent::__construct();
        $this->customerid=$this->session->userdata['cuslog'];
        if(!isset($this->cart))
        {
            $this->load->library('cart');
        }
        if($this->cart->total()>0)
        {
            $this->update_to_db();
        }
    }
    
    public function update_to_db()
    {
            $this->db->trans_start();
            $this->db->delete('cart',array('customerid'=>$this->customerid));
            foreach($this->cart->contents() as $items)
            {
                $this->productid=$items['id'];
                $this->quantity=$items['qty'];
                $this->price=$items['price'];
                $this->db->insert('cart',$this);
            }
            $this->db->trans_complete();
    }
    public function update($pid,$amount)
    {
        $this->db->update('cart',array('quantity'=>$amount),array('productid'=>$pid,'customerid'=>$this->customerid));
    }
    public function empty_cart($pid="")
    {
        if($pid==="")
        {
            $this->db->delete('cart',array('customerid'=>$this->customerid));
        }
        else
        {
            $this->db->delete('cart',array('productid'=>$pid,'customerid'=>$this->customerid));
        }
    }
    
    public function get_from_db()
    {
            $query=$this->db->get_where('cart',array('customerid'=>$this->customerid));
            if($query->num_rows>0)
            {
                foreach($query->result() as $items)
                {
                    $this->db->select('name');
                    $query2=$this->db->get_where('products',array('product_id'=>$items->productid));
                    $row=$query2->row();
                    $data=array(
                        'id'=>$items->productid,
                        'name'=>$row->name,
                        'qty'=>$items->quantity,
                        'price'=>$items->price
                    );
                    $this->cart->insert($data);
                }
            }
        
    }
}
