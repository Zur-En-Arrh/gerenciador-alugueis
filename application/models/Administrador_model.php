<?php

/**
 * 
 */
class Administrador_model extends CI_Model
{
	public $username;
	public $senha;
	
	function __construct()
	{
		parent::__construct();
	}

	public function ver_admin()
	{
            $query = $this->db->get_where('administradores', array('username' => $this->username, 'senha' => $this->senha));
            return $query->result();
	}
}