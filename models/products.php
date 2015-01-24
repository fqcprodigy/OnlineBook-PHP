<?php

class Products extends CI_Model
{
    var $product_id=0;
    var $name='';
    var $category='';
    var $amount=0;
    var $price=0.0;
    var $discount=1.0;
    var $date='';
    var $img='';
    
    public function __construct() {
        parent::__construct();
        //$this->db->from('products');
    }

        public function get_all()
    {
            $this->db->from('products');
            $query=$this->db->get();
            return $query->result_array();
    }
    
    public function get_By_id($id)
    {
        
        $query=$this->db->get_where('products',array('product_id'=>$id),1,0);
        if($query->num_rows()>0)
        {
            $row=$query->row_array();
            $this->product_id=$row['product_id'];
            $this->name=$row['name'];
            $this->category=$row['category'];
            $this->amount=$row['amount'];
            $this->price=$row['price'];
            $this->discount=$row['discount'];
            $this->date=$row['date'];
            $this->img=base_url()."css/".$row['img'];
            return $this;
        }
        else
        {
            return FALSE;
        }
    }
    
}
