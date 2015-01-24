<?php

class Orders extends CI_Model
{
    var $customerid;
    var $orderid;
    var $totalpaid=0.0;
    var $shipaddr;
    var $billaddr;
    var $date;
    var $status=1;
    public function check_order()
    {
        $this->customerid=$this->session->userdata['cuslog'];
        $this->totalpaid=floatval($this->input->post('totalpaid'));
        $this->shipaddr=$this->input->post('s_addr');
        $this->billaddr=$this->input->post('b_addr');
        date_default_timezone_set('America/Los_Angeles');
        $this->date=date("Y-m-d");
        $this->status=1;
        $this->db->trans_start();
        $this->db->insert('orders',$this);
        $this->db->select_max('orderid');
        $query=$this->db->get('orders');
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }
        $row=$query->row();
        $this->orderid=$row->orderid;
        return $this->orderid;
    }
    
    public function check_detail($orderid)
    {
        foreach($this->cart->contents() as $value)
        {
            $proid=$value['id'];
            $quantity=$value['qty'];
            $price=$value['price']*$quantity;
            $price=number_format($price,2);
            $sql="INSERT INTO orderdetail VALUES($orderid,$proid,$quantity,$price);";
            $this->db->trans_start();
            $this->db->query($sql);
            $sql="UPDATE products SET amount=amount-$quantity WHERE product_id=$proid;";
            $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE)
            {
                return FALSE;
            }
        }
        return TRUE;
    }
}

