<?php 

class Administrador extends CI_Controller
{
    
    public function _remap($method, $params = array())
    {
        if (isset($_SESSION['admin']) || $method == 'entrar') 
        {
            return call_user_func_array(array($this, $method), $params);
        }else
        {
            $this->load->view('cabecalhos/cabecalho', array('breadcrumbs' => array('Acesso Negado')));
            $this->load->view('conteudos/acesso_negado');
            $this->load->view('rodapes/rodape');
        }
    }
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrador_model');
    }
    
    public function entrar()
    {
        $this->administrador_model->username = $this->input->post("username");
        $this->administrador_model->senha = $this->input->post("senha");

        $obj = $this->administrador_model->ver_admin()[0];
        
        if(isset($_SESSION['id'])) unset($_SESSION['id']);
        $_SESSION["admin"] = $obj;

        header("Location: ".base_url());
    }
}