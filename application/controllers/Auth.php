<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */

    function index($error = "")
    {
        $this->load->helper('form');
        if($this->session->userdata('is_logged_in') !== TRUE)
        {
			$data['error'] = $error;
            $this->load->view('login/home', $data);
        }
        else
        {
            redirect('welcome');
        }
    }

    function validate_credential()
    {
		if($this->input->post('btn_login') === 'btn_login')
		{
			$this->load->model('auth_model');

			$query = $this->auth_model->validate($this->input->post('txt_user_name'), $this->input->post('txt_user_password'));

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
				redirect("welcome");
			}
			else
			{
				$this->index("<div class=\"alert alert-danger\">Username atau Password salah</div>");
			}
		}
		else
		{
			$this->index();
		}
    }

    function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

    function form()
    {
        $this->template->set("title", "Ubah Password");
        $data["bt"] = "Form Ubah Password";

        $this->template->load("template/template", "login/form", $data);
    }

    function simpan()
    {
        $this->load->model('auth_model', 'am');

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
                redirect('welcome');
            }
            else
            {
                redirect('welcome');
            }
        }
        else
        {
            redirect('welcome');
        }
    }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
