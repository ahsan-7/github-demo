<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Model {

    public function insertToDB($name,$email,$password)
    {
        $data = ['name'=>$name,'email'=>$email,'password'=>md5($password)];
        if($data1 = $this->db->insert('register',$data))
        {
      
           $this->db->where('email',$email);
         
         return $this -> db ->get('register')->row_array();
        }
    }
    
    public function getVerification($email,$code)
    {
        $this->db->where('email',$email);
        $this->db->where('code',$code);
        $query = $this->db->get('verification');
        if($query->num_rows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function update($email)
    {
        $this->db->where('email',base64_decode($email));
        $data = ['active'=>1];
        if($this->db->update('register',$data))
        {
            return true;
        }
    }
    public function insertToVerification($email,$code)
    {
        $data = ['email'=>base64_encode($email),'code'=>$code];
        $this->db->insert('verification',$data);
    }
    public function deleteFromDB($code)
    {
        $this->db->where('code',$code);
        $this->db->delete('verification');
    }
    public function validate($email,$password)
    {
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $this ->db ->where('active',1);
        $query = $this->db->get('register');
        if ($query->num_rows()==1) {
            return $query->row_array();     
        }
        else{
            return false;
        }
    }
    public function insertToCategory($name,$category,$description,$new_name)
    {
        $data = ['name'=>$name,'category'=>$category,'description'=>$description,'image'=>$new_name];
        if($this->db->insert('categories',$data))
        {
            return $data;
        }    
    }
    public function insertToCategory2($name,$description,$new_name)
    {
        $data = ['name'=>$name,'description'=>$description,'image'=>$new_name];
        $this->db->insert('category',$data);
    }
    public function getAllCategories()
    {
        $this->db->order_by("name", "asc");
        return $this->db->get('category')->result_array();
    }
    public function getCategory($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('category')->row_array();
    }
    public function getCategories($id)
    {
        $this->db->where('category',$id);
        return $this->db->get('categories')->result_array();
    }
    public function insertToRegister($id,$name,$email,$new_name)
    {
        $this->db->where('id',$id);
        $data = ['id'=>$id,'name'=>$name,'email'=>$email];
        if($new_name != "")
        {
            $data['image']=$new_name;
        }
        $this->db->update('register',$data);
        return $data; 
    }
    public function getFromCategories()
    {
        $this->db->order_by("name", "asc");
        return $this->db->get('categories')->result_array();
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }
    public function updateToCategories($id,$name,$category,$description,$new_name)
    {
        $this->db->where('id',$id);
        $data = ['id'=>$id,'name'=>$name,'category'=>$category,'description'=>$description];
        if($new_name != "")
        {
            $data['image']=$new_name;
        }
        $this->db->update('categories',$data);
    }
    public function getCategories_edit($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('categories')->row_array();
    }
    public function delete_category($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }
    public function getCategories_edit_category($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('category')->row_array();
    }
    public function updateToCategory($id,$name,$description,$new_name)
    {
        $this->db->where('id',$id);
        $data = ['id'=>$id,'name'=>$name,'description'=>$description];
        if($new_name != "")
        {
            $data['image']=$new_name;
        }
        $this->db->update('category',$data);
    }
    public function password_change($id,$prev_password,$new_password)
    {
        
        if(md5($prev_password) == $this->session->userdata('password'))
        {    
            $this->db->where('id',$id);
            $data = ['password'=>md5($new_password)];
            $this->db->update('register',$data);
            return $data;
        }
        else
        {
            return false;
        }
    }
}










