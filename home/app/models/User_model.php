<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct()
    {
    $this->load->database();
    }
    /*
     * Get all users
     */
    function get_all_users()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('users')->result_array();
    }

    /*
     * Get user by id
     */
    function get_user($id)
    {
        return $this->db->get_where('users',array('id'=>$id))->row_array();
    } 
    
    function update_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        return $this->db->delete('users',array('id'=>$id));
    }

    public function register_user($crypt_password)
    {
    $data['first_name'] = $this->input->post('first_name');
    $data['last_name'] = $this->input->post('last_name');
    $data['email'] = $this->input->post('email');
    $data['username'] = $this->input->post('username');
    $data['password'] = $crypt_password;
    return $this->db->insert('users', $data);
    }

    public function username_exists($username)
    {
    $data['username'] = $username;
    $query = $this->db->get_where('users', $data);
    if(empty($query->row_array()))
    { return true; } else { return false; }
    }

    public function email_exists($email)
    {
    $data['email'] = $email;
    $query = $this->db->get_where('users', $data);
    if(empty($query->row_array()))
    { return true; } else { return false; }
    }

    public function login_user($username, $password)
    {
        $this->db->where('username', $username);
        $result = $this->db->get('users')->row();
        if($result != NULL)
        { 
            if(password_verify($password, $result->password))
            {
                $username = $result->username;
                echo 'Invalid login details';
                return $result->id;
            }
            
        } 
        else 
        { 
            return false;
        }
    }
}
