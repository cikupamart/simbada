<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  /*
   * @author zulyantara <zulyantara@gmail.com>
   * @copyright copyright 2016 zulyantara
   */

  var $table = "users";

  function __construct()
  {
      parent::__construct();
  }

  function validate($username, $userpassword)
  {
    // $hashAndSalt = $this->get_password($username);
    // $password_hash = password_hash($userpassword, PASSWORD_BCRYPT, array("cost" => 12));

    $this->db->select("u.user_id, u.user_username, u.user_password, u.user_nama, u.user_nip, u.user_email, u.user_ur, u.user_lokasi, ur.ur_ket");
    $this->db->join('users_role ur','u.user_ur=ur.ur_id','left');
    $this->db->where('u.user_username', $username);
    $this->db->where("u.user_active", 1);
    $query = $this->db->get($this->table.' u');
    // echo $this->db->last_query();exit;
    $row_user = $query->num_rows() > 0 ? $query->row() : FALSE;
    if ($row_user !== FALSE)
    {
      if (password_verify($userpassword,$row_user->user_password))
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
