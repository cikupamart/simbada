<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}

	function chk_auth()
	{
		$this->CI =& get_instance();

		if ($this->CI->session->userdata('is_logged_in') !== TRUE)
		{
			redirect("auth", "refresh");
		}
	}

	function chk_view($modul)
	{
		$this->CI =& get_instance();

		$this->CI->load->model('auth_model', 'am');
		$arr_where["ha_ur"] = $this->CI->session->userdata("userLevel");
		$arr_where["menu_url"] = $modul;

		$result = $this->CI->am->get_ha("ha_view", $arr_where)->row();
		// var_dump($result);

		if ($result->ha_view === "0" OR $result === FALSE)
		{
			redirect("auth");
		}
	}

	function chk_insert($modul)
	{
		$this->CI =& get_instance();

		$this->CI->load->model('auth_model', 'am');
		$arr_where["ha_ur"] = $this->CI->session->userdata("userLevel");
		$arr_where["menu_url"] = $modul;

		$result = $this->CI->am->get_ha("ha.ha_insert", $arr_where)->row();
		// var_dump($result);echo $result;exit;
		if ($result->ha_insert === "0" OR $result === FALSE)
		{
			redirect($modul);
		}
	}

	function chk_update($modul)
	{
		$this->CI =& get_instance();

		$this->CI->load->model('auth_model', 'am');
		$arr_where["ha_ur"] = $this->CI->session->userdata("userLevel");
		$arr_where["menu_url"] = $modul;

		$result = $this->CI->am->get_ha("ha_update", $arr_where)->row();
		// var_dump($result);echo $result;exit;
		if ($result->ha_update === "0" OR $result === FALSE)
		{
			redirect($modul);
		}
	}

	function chk_delete($modul)
	{
		$this->CI =& get_instance();

		$this->CI->load->model('auth_model', 'am');
		$arr_where["ha_ur"] = $this->CI->session->userdata("userLevel")->row();
		$arr_where["menu_url"] = $modul;

		$result = $this->CI->am->get_ha("ha_delete", $arr_where);
		// var_dump($result);echo $result;exit;
		if ($result->ha_delete === "0" OR $result === FALSE)
		{
				redirect($modul);
		}
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */
