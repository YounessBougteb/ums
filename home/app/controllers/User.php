<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('url','security','form','email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');
	}

	public function index()
	{
        if(!$this->session->userdata('is_logged_in'))
		{
            $this->alert('You need to login to add data!','warning');
			redirect('user/login');
			exit;
		}
        $data['users'] = $this->user_model->get_all_users();
		$data['title'] = 'Client Area';
		$data['public_view'] = 'users/index';
        $this->load->view('layouts/user_layout',$data);
	}

	public function register()
	{
        $data['title'] = 'Sign Up';
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_email_exists');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_exists');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]|callback_valid_password_expression');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		if($this->form_validation->run() === FALSE)
		{
			$data['public_view'] = 'users/register';
            $this->load->view('layouts/user_layout',$data);
		}
		else
		{
			$password = $this->hashit($this->input->post('password'));
            $this->user_model->register_user($password);
            $this->alert('You may log in now','success');
			redirect('user/login');
		}
    }
    
    /*
     * Editing a user
     */
    public function edit($id)
    {   
        $data['title'] = 'Update User';
        // check if the user exists before trying to edit it
        $data['user'] = $this->user_model->get_user($id);
        
        if(isset($data['user']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
                );

                $this->user_model->update_user($id,$params);            
                redirect('user/index');
            }
            else
            {
                $data['public_view'] = 'users/edit';
                $this->load->view('layouts/user_layout',$data);
            }
        }
        else {
            $this->alert('The user you are trying to edit does not exist.', 'danger');
            redirect('user/index');
        }
    } 
    
    /*
     * Deleting user
     */
    function delete($id)
    {
        $user = $this->user_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']))
        {
            $this->user_model->delete_user($id);
            $this->alert($user['username']. ' has been deleted!' , 'danger');
            redirect('user/index');
        }
        else {
            $this->alert('The user you are trying to delete does not exist.', 'danger');
            redirect('user/index');
        }
    }

	public function login()
	{
        $data['title'] = 'Sign in';
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$data['public_view'] = 'users/login';
            $this->load->view('layouts/user_layout',$data);
		}
		else
		{
			$username = $this->input->post('username');
            $password = $this->input->post('password');
			$user_id = $this->user_model->login_user($username, $password);
			if($user_id)
			{
				$user_data['user_id'] = $user_id;
				$user_data['username'] = $username;
				$user_data['is_logged_in'] = true;
				$this->session->set_userdata($user_data);
                $this->alert('You are logged in now','success');
				redirect('user/index');
			}
			else
			{
				$this->alert('Login is invalid', 'danger');
				redirect('user/login');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('is_logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
        $this->alert('Successful logout!', 'info');
		redirect('user/login');
	}

	// is username taken
	public function username_exists($username)
	{
		$this->form_validation->set_message('username_exists', 'The username exists, please choose another username!');
		if($this->user_model->username_exists($username))
		{ return true; } else { return false; }
	}

	// is email used before
	public function email_exists($email)
	{
		$this->form_validation->set_message('email_exists', 'The email was used before, please login or use another email!');
		if($this->user_model->email_exists($email))
		{ return true; } else { return false; }
	}
    public function valid_password_expression($password_expression)
    {

        if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password_expression))
        {
        $this->form_validation->set_message('valid_password_expression', '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit');
        return FALSE;
        }
        else
        {
        return TRUE;
        }
    }
    // message = text message and alert is bootstrap class (e.g., success)
    public function alert($message, $alert){
        $flash = array(
            'message' => $message,
            'class' => $alert
        );
        
        return $this->session->set_flashdata($flash);
    }
    
    // hashing password after determining the appropriate cost 
    private function hashit($password){
        $options = ['cost' => 10];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}
