<?php
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Cart_ctl extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if(!isset($this->cart))
        {
            $this->load->library('cart');
        }
        if(isset($this->session->userdata['cuslog']))
        {
            $this->load->model('Mycart');
            $this->load->model('Customer');
        }
    }
    
    public function index()
    {
        
        if(isset($this->session->userdata['cuslog'])&&$this->cart->total()==0)
        {
            
            $this->Mycart->get_from_db();            
        }
        if($this->cart->total()>0)
        {
             $item=end($this->cart->contents());
             $oldid=$item['id'];
             $result=$this->recmmd($oldid);
             $this->load->view('cart_view',array('rec'=>$result));
        }
        else
        {
            $this->load->view('cart_view');
        }
    }
    
    public function add_item()
    {
        $row=array();
        $oldid=$this->input->post('proid');
        $row['id']=$oldid;
        $row['qty']=intval($this->input->post('num'));
        $price=floatval($this->input->post('cost'));
        $row['price']=number_format($price,2);
        $row['name']=$this->input->post('proname');
        
        $same=FALSE;
        foreach($this->cart->contents() as $items)
        {
            if($items['id']==$oldid)
            {
                $rowid=$items['rowid'];
                $data=array(
                    'rowid'=>$rowid,
                    'qty'=>$items['qty']+$row['qty'],
                    'price'=>$items['price']+$row['price']
                );
                $same=TRUE;
                break;
            }
        }
        if(!$same)
        {
            $this->cart->insert($row);
        }
        if(isset($this->session->userdata['cuslog']))
        {
            $cusid=$this->session->userdata['cuslog'];
            if(!$same)
            {
             $sql="INSERT INTO cart VALUES($cusid,$oldid,".$row['qty'].",".$row['price'].")";   
            }
            else
            {
                $sql="UPDATE cart SET quantity=quantity+".$row['qty'].",price=price+".$row['price']." WHERE customerid=$cusid AND productid=$oldid;";
            }
            $this->db->query($sql);
        }
        redirect("cart_ctl");
    }
    
    public function update()
    {
        $pname=$this->input->post('pname');
        $amount=intval($this->input->post('amount'));
        if($amount<=0)
        {
            redirect("logout");
            exit;
        }
        foreach($this->cart->contents() as $value)
        {
            if($value['name']==$pname)
            {
                $rowid=$value['rowid'];
                $data=array('rowid'=>$rowid,'qty'=>$amount);
                $pid=$value['id'];
                
                break;
            }
        }
        $this->cart->update($data);
        //echo $rowid;
        if(isset($this->session->userdata['cuslog']))
        {
            $this->Mycart->update($pid,$amount);
        }
    }
    
    public function del()
    {
        $name=$this->input->post('name');
        foreach($this->cart->contents() as $value)
        {
            if($value['name']==$name)
            {
                $rowid=$value['rowid'];
                $pid=$value['id'];
                $this->cart->update(array('rowid'=>$rowid,'qty'=>0));
                break;
            }
        }
        if(isset($this->session->userdata['cuslog']))
        {
            $this->Mycart->empty_cart($pid);
        }
    }

    public function check()
    {
        $this->session->set_userdata('checkout',TRUE);
    }


    public function empty_all()
    {
        $this->cart->destroy();
        if(isset($this->session->userdata['cuslog']))
        {
            $this->Mycart->empty_cart();
        }
    }
    public function recmmd($oldid)
    {
        $sql="SELECT O.product_id,P.img FROM orderdetail O,products P WHERE O.product_id!=$oldid AND O.orderid IN (SELECT orderid FROM orderdetail WHERE product_id=$oldid) AND O.product_id=P.product_id GROUP BY O.product_id;";
        $query=$this->db->query($sql);
        if($query->num_rows>0)
        {
            return $query->result();  
        }
        else
        {
            return FALSE;
        }
        
    }
}



