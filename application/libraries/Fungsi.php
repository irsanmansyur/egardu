<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fungsi
{
	protected $_ci;

	function __construct()
	{
		$this->_ci = &get_instance();
	
	}

	function template($content, $data = null)
	{
		$data['_content'] = $this->_ci->load->view($content, $data, true);
		$this->_ci->load->view('template.php', $data);
	}





	function tanggal_lap($tanggal)
	{
		$bulan = array(
			1 => 'Januari',
			2 => 'Februari',
			3 =>'Maret',
			4 => 'April',
			5 => 'Mei',
			6 =>'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		);
		$p = explode('/', $tanggal);
		return $p[2] . ' ' . $bulan[(int) $p[1]] . ' ' . $p[0];
	}

	function tanggalindo($tanggal)
	{
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$p = explode('-', $tanggal);
		return $p[2] . ' ' . $bulan[(int) $p[1]] . ' ' . $p[0];
	}

	function bulan($tanggal)
	{
		$bulan = array(
			1 => 'Januari',
			2 => 'Februari',
			3 =>'Maret',
			4 => 'April',
			5 => 'Mei',
			6 =>'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		);
		$p = explode('-', $tanggal);
		return $bulan[(int) $p[1]];
	}
}
