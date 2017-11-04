<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('template/header', isset($data_header) ? $data_header : ""); ?>
<?php $this->load->view('template/menu', isset($data_menu) ? $data_menu : ""); ?>
<?php $this->load->view($modul); ?>
<?php $this->load->view('template/footer',isset($data_footer) ? $data_footer : ""); ?>
