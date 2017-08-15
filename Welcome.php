 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
	public function form(){
		$this->load->view('form');
	}
	public function loginform(){
		$this->load->view('loginform');
	}
	public function insertToDB(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_name_check');
		$this->form_validation->set_rules('password', 'Password', 'required|callback_password_special_check|callback_password_upper_check|callback_password_lower_check|callback_password_numeric_check|min_length[6]');
		$this->form_validation->set_rules('c_password', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[register.email]|valid_email');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('form');
                
        }
        else
        {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
            $code = md5($email.uniqid());
            $em = base64_encode($email);
            $link = base_url("welcome/verify/$em/$code");
            $this->send($email,$link);
            $this->school->insertToVerification($email,$code);
			$info = $this->school->insertToDB($name,$email,$password);
            $email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->session->set_userdata(['login'=>1]) ;
			$this->session->set_userdata($info) ;
            $this->session->set_flashdata('msg','A link has been sent to your email click the link to verify yor email.');
	        redirect("welcome/loginform");
	    }
    }
    public function verify($email,$code)
    {
        if($this->school->getVerification($email,$code))
        {
           if($this->school->update($email))
            {
                redirect("welcome/deleteCode/$code");
            } 
        }
        else
        {
            $this->session->set_flashdata('msg','some error occurs');
            redirect("welcome/loginform");
        }    
    }
    public function deleteCode($code)
    {
        $this->school->deleteFromDB($code);
        $this->session->set_flashdata('cmsg','You are registered please complete your profile first.');
        redirect("welcome/profile_manager");
    }
	public function dashboard(){
		
            if ( $this->session->userdata('login')==1) 
            {
                
                $data['category_info'] = $this->school->getAllCategories();
                
                $this->load->view('dashboard',$data);   
            }       
            else
            {
               $this->session->set_flashdata('msg','Please login first.');
               redirect("welcome/loginform");
            }
        
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("welcome/loginform");
	}
	public function validate()
	{
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]',
                array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('loginform');
                
        }
        else{
        $email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if($info = $this->school->validate($email,$password))
        {
		   
		   $info['login'] = 1;
		   $this->session->set_userdata($info);

		   //$this->session->set_userdata(['login'=>1]);


		   redirect("welcome/dashboard");
		}
		else{
           $this->session->set_flashdata('msg','Email or Password is Incorrect.');
           redirect("welcome/loginform");
		}
	 }
	}
	public function name_check($str)
        {if($str=='')
        	{
        		return true;
        	}
                if ( !preg_match ("/^[a-zA-Z][a-zA-Z ]*$/",$str))
                {
                        $this->form_validation->set_message('name_check', 'The {field} field can only contain alphabets and spaces.');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
        
    public function password_special_check($str)
        {
        	if($str=='')
        	{
        		return true;
        	}
            if ( preg_match ("/[!@#\$%\^\&*\)\(+=._-]/",$str) && preg_match ("/[A-Z]/",$str) && preg_match ("/[a-z]/",$str) && preg_match ("/[0-9]/",$str))
			{
				return true;
			}
			else
			{	
                if ( !preg_match ("/[!@#\$%\^\&*\)\(+=._-]/",$str))
                {
                        $this->form_validation->set_message('password_special_check', 'The {field} field must also contain one special character.');
                        return false;
                } 
            }
	    }
	public function password_upper_check($str)
	    {     if($str=='')
        	{
        		return true;
        	}              
            if ( preg_match ("/[!@#\$%\^\&*\)\(+=._-]/",$str) && preg_match ("/[A-Z]/",$str) && preg_match ("/[a-z]/",$str) && preg_match ("/[0-9]/",$str))
			{
				return true;
			}
			else
			{
            	if ( !preg_match ("/[A-Z]/",$str))
    			{
            		$this->form_validation->set_message('password_upper_check', 'The {field} field must also contain one uppercase character.');
            		return false;
            	}
            }	
	    }
	public function password_lower_check($str)
	    {   if($str=='')
        	{
        		return true;
        	}   
        	          	
            if ( preg_match ("/[!@#\$%\^\&*\)\(+=._-]/",$str) && preg_match ("/[A-Z]/",$str) && preg_match ("/[a-z]/",$str) && preg_match ("/[0-9]/",$str))
			{
				return true;
			}
			else
			{
            if ( !preg_match ("/[a-z]/",$str))
    			{
            		$this->form_validation->set_message('password_lower_check', 'The {field} field must also contain one lowercase character.'
	            			);
            		return false;
            	}
            }		
	    }
	public function password_numeric_check($str)
	    {     if($str=='')
        	{
        		return true;
        	}
    		if ( preg_match ("/[!@#\$%\^\&*\)\(+=._-]/",$str) && preg_match ("/[A-Z]/",$str) && preg_match ("/[a-z]/",$str) && preg_match ("/[0-9]/",$str))
			{
				return true;
			}
			else
			{
        		if ( !preg_match ("/[0-9]/",$str))
					{
	        			$this->form_validation->set_message('password_numeric_check', 'The {field} field must also contain one numeric character.');
	        			return false;
	        		}
	        }		
    	}
    public function test()
        {
            print_r($this->session->userdata());
        }
    public function profile_manager()
    {
        
            if ( $this->session->userdata('login')==1) 
            {
                
                $data['cp'] = $this->school->getAllCategories();
                $this->load->view('profile_manager',$data);   
            }       
            else
            {
               $this->session->set_flashdata('msg','Please login first.');
               redirect("welcome/loginform");
            }
        
    }
    public function add_item()
    {
        
            if ( $this->session->userdata('login')==1) 
            {
                $this->load->view('add_item');    
            }       
            else
            {
               $this->session->set_flashdata('msg','Please login first.');
               redirect("welcome/loginform");
            }
             
    }
    public function categories($id)
    {
            
            if ( $this->session->userdata('login')==1) 
            {
                
                $data['category_info'] = $this->school->getCategory($id);
                $data['cd'] = $this->school->getCategories($id);
                $data['id'] = $id;
                $data['ca'] = $this->school->getAllCategories(); 
           
                $this->load->view('categories',$data);   
            }       
            else
            {
               $this->session->set_flashdata('msg','Please login first.');
               redirect("welcome/loginform");
            }
           
    }

    
    /*Items Manager*/


    public function add_items()
    {
        if ( $this->session->userdata('login')==1) 
        { 
            $data['id_info'] = $this->school->getFromCategories();
            $data['category_info'] = $this->school->getAllCategories();
            $this->load->view('add_items',$data);   
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }
    }
    public function do_upload_items()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['min_width']            = 960;
        // $config['min_height']            = 640;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $new_name = time().$_FILES["userfile"]['name'];
        $config['file_name']            = $new_name;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $this->session->set_flashdata('file','Image is required');
            
            $data['id_info'] = $this->school->getFromCategories();
            $data['category_info'] = $this->school->getAllCategories();
            $this->load->view('add_items',$data);
        }
        else
        {
            $this->form_validation->set_rules('description', 'Description','trim|required|max_length[350]');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE)
            {
                $data['id_info'] = $this->school->getFromCategories();
                $data['category_info'] = $this->school->getAllCategories();
                $this->load->view('add_items',$data);
                    
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $id = $this->input->post('id');
                print_r($id);
                $name = $this->input->post('name');
                $category = $this->input->post('category');
                $description = $this->input->post('description');
                $this->school->insertToCategory($name,$category,$description,$new_name);
                
                redirect("welcome/categories/$category");
            }
        }
    }

    
    /*Category Manager*/
    

    public function add_category()
    {
        if ( $this->session->userdata('login')==1) 
        { 
            $this->load->view('add_category'); 
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }              
    }
    public function do_upload_category()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['min_width']            = 960;
        // $config['min_height']            = 640;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $new_name = time().$_FILES["userfile"]['name'];
        $config['file_name']            = $new_name;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $this->session->set_flashdata('file','Image is required.');
            $data['category_info'] = $this->school->getAllCategories();
            $this->load->view('add_category',$data);
        }
        else
        {
            $this->form_validation->set_rules('description', 'Description','trim|required|max_length[500]');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE)
            {
                
                $data['category_info'] = $this->school->getAllCategories();
                $this->load->view('add_category',$data);
                    
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $name = $this->input->post('name');
                
                $description = $this->input->post('description');
                $this->school->insertToCategory2($name,$description,$new_name);
                
                redirect("welcome/dashboard");
            }
        }
    }


    /*Profile Manager*/
    public function edit_profile()
    {
        $this->load->view('edit_profile');
    }

    public function do_upload_profile($id)
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 50;
            // $config['min_width']            = 960;
            // $config['min_height']            = 240;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 240;
            if($_FILES["userfile"]['name']!="")
            {
                $new_name = time().$_FILES["userfile"]['name'];
                $config['file_name']            = $new_name;
            }
            $this->load->library('upload', $config);
            if($_FILES["userfile"]['name']!="")
            {
                if ( ! $this->upload->do_upload('userfile') )
                {
                        $this->session->set_flashdata('msg','File not uploaded,your file should be of size 50.');
                        $this->load->view('edit_profile');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $name = $this->input->post('name');
                        $email = $this->input->post('email');
                        $info = $this->school->insertToregister($id,$name,$email,$new_name);
                        $this->session->set_userdata($info);
                        // $this->session->sess_destroy();
                        redirect("welcome/profile_manager");
                }
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $info = $this->school->insertToregister($id,$name,$email,$new_name);
                    $this->session->set_userdata($info);
                    // $this->session->sess_destroy();
                    redirect("welcome/profile_manager");
            }
    }
    
    public function modify_items()
    {
        if ( $this->session->userdata('login')==1) 
        {
            $data['modify_info'] = $this->school->getFromCategories();
        
            $data['category_info'] = $this->school->getAllCategories();
        
            $this->load->view('modify_items',$data);
               
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }
        
    }
    public function edit($id)
    {
        if ( $this->session->userdata('login')==1) 
        {
            
            $data['modify_info'] = $this->school->getFromCategories();
        
            $data['category_info'] = $this->school->getAllCategories();
            $data['prev_info'] = $this->school->getCategories_edit($id);
       
            $this->load->view('edit',$data);  
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }
        
    }    
    public function delete($id)
    {
        $this->school->delete($id);
        $this->session->set_flashdata('msg','Record has been deleted.');
        redirect('welcome/modify_items');
    }    
    public function modify_category()
    {
        if ( $this->session->userdata('login')==1) 
        {
            $data['category_info'] = $this->school->getAllCategories();
        
            $this->load->view('modify_category',$data);
               
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }
        
    }
    public function delete_category($id)
    {
        $this->school->delete_category($id);
        $this->session->set_flashdata('msg','Record has been deleted.');
        redirect('welcome/modify_category');
    }
    public function edit_category($id)
    {
        if ( $this->session->userdata('login')==1) 
        {
            $data['category_info'] = $this->school->getAllCategories();
            $data['prev_info'] = $this->school->getCategories_edit_category($id);
            $this->load->view('edit_category',$data);
               
        }       
        else
        {
           $this->session->set_flashdata('msg','Please login first.');
           redirect("welcome/loginform");
        }
        
    }
    public function do_upload_edit_items()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 50;
            // $config['min_width']            = 960;
            // $config['min_height']            = 240;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 240;
            if($_FILES["userfile"]['name']!="")
            {
                $new_name = time().$_FILES["userfile"]['name'];
                $config['file_name']            = $new_name;
            }
            $this->load->library('upload', $config);
            if($_FILES["userfile"]['name']!="")
            {
                if ( ! $this->upload->do_upload('userfile') )
                {
                        $this->session->set_flashdata('msg','File not uploaded,your file should be of size 50.');
                        $id = $this->input->post('id');
                        $data['modify_info'] = $this->school->getFromCategories();
        
                        $data['category_info'] = $this->school->getAllCategories();
                        $data['prev_info'] = $this->school->getCategories_edit($id);
                        $this->load->view('edit_category',$data);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $id = $this->input->post('id');
                        $name = $this->input->post('name');
                        $category = $this->input->post('category');
                        $description = $this->input->post('description');
                        $this->school->updateToCategories($id,$name,$category,$description,$new_name);
                        redirect("welcome/modify_items");
                }
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $category = $this->input->post('category');
                    $description = $this->input->post('description');
                    $this->school->updateToCategories($id,$name,$category,$description,$new_name);
                    redirect("welcome/modify_items");
            }
    }
    public function do_upload_edit_category()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 50;
            // $config['min_width']            = 960;
            // $config['min_height']            = 240;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 240;
            if($_FILES["userfile"]['name']!="")
            {
                $new_name = time().$_FILES["userfile"]['name'];
                $config['file_name']            = $new_name;
            }
            $this->load->library('upload', $config);
            if($_FILES["userfile"]['name']!="")
            {
                if ( ! $this->upload->do_upload('userfile') )
                {
                        $this->session->set_flashdata('msg','File not uploaded,your file should be of size 50.');
                        $id = $this->input->post('id');
                        $data['modify_info'] = $this->school->getFromCategories();
        
                        $data['category_info'] = $this->school->getAllCategories();
                        $data['prev_info'] = $this->school->getCategories_edit($id);
                        $this->load->view('edit',$data);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $id = $this->input->post('id');
                        $name = $this->input->post('name');
                        $description = $this->input->post('description');
                        $this->school->updateToCategory($id,$name,$description,$new_name);
                        redirect("welcome/modify_category");
                }
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $description = $this->input->post('description');
                    $this->school->updateToCategory($id,$name,$description,$new_name);
                    redirect("welcome/modify_category");
            }
    }
    public function change_password()
    {
        if($this->session->userdata('login')==1)
        {    
        $this->load->view('change_password');
        }
        else
        {
            $this->session->set_flashdata('msg','Please login first');
            redirect ("welcome/loginform");
        }
    }
    public function update_password($id)
    {
        // $password = $this->session->userdata('password');
        // $this->form_validation->set_rules('md5(prev_password)', 'Prev_Password', 'required|matches[$password]');
        $this->form_validation->set_rules('new_password', 'New_Password', 'required|callback_password_special_check|callback_password_upper_check|callback_password_lower_check|callback_password_numeric_check|min_length[6]');
        $this->form_validation->set_rules('c_new_password', 'New Password Confirmation', 'trim|required|matches[new_password]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('change_password');         
        }
        else
        {
            $prev_password = $this->input->post('prev_password');
            $new_password = $this->input->post('new_password');
            if($info = $this->school->password_change($id,$prev_password,$new_password))
            {
                
               $this->session->set_userdata(['password'=>$info['password']]);
               $this->session->set_flashdata('pass_change','Password has been changed.');
               redirect("welcome/edit_profile/$id");  
            }    
            else
            {
                $this->session->set_flashdata('pass_change','Previous password is incorrect.');
                $this->load->view('change_password');
            }
        }
    }


    public function send($email,$link)
    {
        $this->load->library('email');
        $this->email->from('ahsansaqib808@gmail.com', 'Ahsan Saqib');
        $this->email->to($email);
        $this->email->subject('Testing');
        $this->email->message('Please Click the link below to complete your verification:'."<br>".$link);
        echo "test";
        print_r($this->email->send());
        print_r($this->email->print_debugger());
    }
}























