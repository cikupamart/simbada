<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /*
     * @author zulyantara <zulyantara@gmail.com>
     * @copyright copyright 2016 zulyantara
     */

    function __construct()
    {
        parent::__construct();
    }

    function get_ha($select, $where)
    {
        foreach ($where as $key => $val)
        {
            $this->db->where($key, $val);
        }
        $this->db->select($select);
        $this->db->join('hak_akses ha', 'ha.ha_menu = m.id', 'left');
        // echo $this->db->get_compiled_select('menu');exit;
        $qry = $this->db->get('menu m');
        return $qry->num_rows() > 0 ? $qry->row() : FALSE;
    }

    function validate($username, $userpassword)
    {
        // $hashAndSalt = $this->get_password($username);
        // $password_hash = password_hash($userpassword, PASSWORD_BCRYPT, array("cost" => 12));

        $this->db->select("u.id AS id_users, u.users_name, u.users_password, u.users_email, u.users_ur, ur.ur_ket");
        $this->db->join('users_role ur','u.users_ur=ur.id','left');
        $this->db->where('u.users_name', $username);
        $this->db->where("u.users_active", 1);
        $query = $this->db->get('users u');
        // echo $this->db->last_query();exit;
        $row_user = $query->num_rows() > 0 ? $query->row() : FALSE;
        if ($row_user !== FALSE)
        {
            if (password_verify($userpassword,$row_user->users_password))
            {
                return $query->row();
                // return array("user_id"=>$row_user->user_id,"user_name"=>$row_user->user_name,"user_email"=>$row_user->user_email);
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function check_password($pwd)
    {
        $this->db->where('user_id', $this->session->userdata('userId'));
        $this->db->where("user_active", 1);
        $query = $this->db->get('mt_user');
        // echo $this->db->last_query();exit;
        $row_user = $query->num_rows() > 0 ? $query->row() : FALSE;
        if ($row_user !== FALSE)
        {
            if (password_verify($pwd, $row_user->user_password))
            {
                // return $query->row();
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
    function update_password($data)
    {
        $this->db->where('user_id', $this->session->userdata('userId'));
        $this->db->update("mt_user", $data);
    }
}
