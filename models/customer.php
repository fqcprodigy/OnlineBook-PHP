<?php


/**
 * Description of Customer
 *
 * @author fqcprodigy
 */
class Customer extends CI_Model {
    public $customerid;
    public $firstname;
    public $lastname;
    public $sex;
    public $email;
    public $password;
    public $address;
    public $zip;
    
    function insert_entry()
    {
        $this->firstname=$this->input->post('fname');
        $this->lastname=$this->input->post('lname');
        $this->sex=$this->input->post('sex');
        $this->email=$this->input->post('email');
        $this->password=$this->input->post('pass');
        $this->address=$this->input->post('addr');
        $this->zip=$this->input->post('zip');
        $this->db->trans_start();
        $this->db->insert('customer',$this);
        $this->db->select_max('customerid');
        $query=$this->db->get('customer');
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }
        $row=$query->row();
        $id=$this->customerid=$row->customerid;
        $this->db->query("UPDATE customer SET password=password(password) WHERE customerid=$id");
        $query2=$this->db->get_where('customer',array('customerid'=>$id));
        return $query2->row();
        
    }
    
    public function update()
    {
        $this->firstname=$this->input->post('fname');
        $this->lastname=$this->input->post('lname');
        $this->sex=$this->input->post('sex');
        $this->email=$this->input->post('email');
        $this->password=$this->input->post('pass');
        $this->address=$this->input->post('addr');
        $this->zip=$this->input->post('zip');
        $id=$this->customerid=$this->session->userdata['cuslog'];
        $data=$this->getcus();
        $this->db->update('customer',$data,array("customerid"=>$id));
        $this->db->query("UPDATE customer SET password=password(password) WHERE customerid=$id");
        $query2=$this->db->get_where('customer',array('customerid'=>$id));
        return $query2->row();
        
    }

        public function check($email,$password)
    {
            $email=  htmlspecialchars($email);
            $password=  htmlspecialchars($password);
        $sql="SELECT* FROM customer WHERE email='$email' AND password=password('$password');";
        $query=$this->db->query($sql);
        //echo $this->db->last_query();
        if($query->num_rows()==1)
        {
            $row=$query->row();
            return $row;
        }
        else
        {
            return FALSE;
        }
    }


    public function getcus()
    {
        $cus=array(
        'firstname'=>$this->firstname,
        'lastname'=>$this->lastname,
        'sex'=>$this->sex,
        'email'=>$this->email,
        'password'=>$this->password,
        'address'=>$this->address,
        'zip'=>$this->zip);
        return $cus;
    }
}
