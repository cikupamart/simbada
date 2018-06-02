<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
  /*
   *@author Zulyantara <zulyantara@gmail.com> 2014
   */

  function __construct()
  {
    parent::__construct();
    $this->load->model("auth_model", "am");
  }

  function index()
  {
    if($this->session->userdata('is_logged_in') !== TRUE)
    {
      $this->load->view('login/home');
    }
    else
    {
      redirect('Welcome');
    }
  }

  function validate_credential()
  {
  	if($this->input->post('btn_login') === 'btn_login')
  	{
  		$query = $this->am->validate($this->input->post('txt_user_name'), $this->input->post('txt_user_password'));

  		if($query !== FALSE)
  		{
  			$data = array(
  				'userId' => $query->id_users,
  				'userName' => $query->users_name,
          'userLevel' => $query->users_ur,
          'levelDesc' => $query->ur_ket,
  				'is_logged_in' => TRUE
  			);

  			$this->session->set_userdata($data);
  			redirect("Welcome");
  		}
  		else
  		{
        $this->session->set_flashdata('msg_login', '<div >Username atau password salah!</div>');
  			redirect("Auth");
  		}
  	}
  	else
  	{
  		redirect("Auth");
  	}
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('Auth');
  }

  function form()
  {
    $this->template->set("title", "Ubah Password");
    $data["bt"] = "Form Ubah Password";

    $this->template->load("template/template", "login/form", $data);
  }

  function simpan()
  {
    $btn = $this->input->post('simpan');
    $password_old = $this->input->post('password_old');
    $password_new = $this->input->post('password_new');

    if ($btn === "ubah_password")
    {
      // check old password
      $chk_password = $this->am->check_password($password_old);

      // jika password_old = user_password maka lanjutkan gan
      if ($chk_password === TRUE)
      {
        $data_user['users_password'] = password_hash($password_new, PASSWORD_DEFAULT);
        $this->am->update_password($data_user);
        redirect('auth/form');
      }
      elseif ($chk_password === FALSE)
      {
        redirect('Welcome');
      }
      else
      {
        redirect('Welcome');
      }
    }
    else
    {
      redirect('Welcome');
    }
  }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
