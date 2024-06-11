<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
	public function index()
	{
		if (isset($_SESSION['logged_in'])) {
			redirect(base_url());
		} else {
			$this->load->view('pages/login');
		}
	}

	public function registration()
	{
		$this->load->view('pages/register');
	}

	public function login()
	{
		$input = $this->input->post();
		$this->session->set_userdata('logged_in', $input);
		if ($this->session->userdata('logged_in') != null) {
			redirect(base_url());
		} else {
			redirect(base_url('authentication'));
		}
	}
}
