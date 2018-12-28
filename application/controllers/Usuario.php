<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller 
{
    
    public function _remap($method, $params = array())
    {
        if ($method == 'paginaCadastro' || $method == 'index' || $method == 'verificarCpf') 
        {
            return call_user_func_array(array($this, $method), $params);
        }else
        {
            if ((isset($_SESSION['id'])) || $method == 'logoff') 
            {
                return call_user_func_array(array($this, $method), $params);
            }elseif((isset($_SESSION['id']) || isset($_SESSION['admin'])) && $method=='ver_wishlist')
            {
                return call_user_func_array(array($this, $method), $params);
            }else
            {
                $this->load->view('cabecalhos/cabecalho', array('breadcrumbs' => array('Acesso Negado')));
                $this->load->view('conteudos/acesso_negado');
                $this->load->view('rodapes/rodape');
            }
        }
    }
    
        public function __construct() {
            parent::__construct();
            $this->load->model('wishlist_model');
            $this->load->model('equipamento_model');
            $this->load->model('modelusuario');
            $this->load->library('pagination');
        }

	public function index() // função carregada ao abrir url principal(localhost://gerenciadordealugueis)
	{
            $breadcrumbs = array($this->uri->segment(1), 'Cadastro'); 
            $data['breadcrumbs'] = $breadcrumbs;
            $this->load->view('cabecalhos/cabecalho', $data);
            $this->load->view('conteudos/cadastrousuario'); // carrega view de cadastro
            $this->load->view('rodapes/rodape');
	}
        
        public function ver_wishlist()
        {
            if (isset($_SESSION['id'])) 
            {
                
                if ($this->uri->segment(3) !== FALSE) 
                {
                    $conteudo['equipamentos'] = $this->ver_minha_wishlist(0, 5);
                }else
                {
                    $conteudo['equipamentos'] = $this->ver_minha_wishlist($this->uri->segment(3), 5);
                }
                
                // Paginação


                $config['attributes'] = array('class' => 'page-link');

                $config['base_url'] = base_url('usuario/ver_wishlist');
                $config['total_rows'] = $this->equipamento_model->get_tot_rows();
                $config['per_page'] = 5;

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['first_tag_open'] = '<li class="page-item">';
                $config['last_tag_open'] = '<li class="page-item">';

                $config['next_tag_open'] = '<li class="page-item">';
                $config['prev_tag_open'] = '<li class="page-item">';

                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';

                $config['first_tag_close'] = '</li>';
                $config['last_tag_close'] = '</li>';

                $config['prev_tag_close'] = '</li>';
                $config['next_tag_close'] = '</li>';

                $config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link active disabled">';
                $config['cur_tag_close'] = '</a> </li>';

                $this->pagination->initialize($config);
                // Fim Paginação
                
                               
                $data['breadcrumbs'] = array('Wishlist', $_SESSION['id']['nome']);
                $this->load->view('cabecalhos/cabecalho', $data);
                $this->load->view('conteudos/equipamentos', $conteudo);
                $this->load->view('rodapes/rodape');
            }else if(isset($_SESSION['admin']))
            {
                $conteudo = $this->ver_todas_wishlists();
                $data['breadcrumbs'] = array('Wishlist', 'Todas');
                $this->load->view('cabecalhos/cabecalho', $data);
                $this->load->view('conteudos/wishlists', $conteudo);
                $this->load->view('rodapes/rodape');
            }
            
            
        }
        
        
        private function ver_minha_wishlist($limit, $offset)
        {
            $wishlist = $this->wishlist_model->get_user_wishlist($_SESSION['id']['id'], $limit, $offset);
            
            foreach($wishlist as $obj)
            {
                $equipamentos[] = $this->equipamento_model->get_by_id($obj->id_equipamento)[0];
            }
            
            return isset($equipamentos)?$equipamentos:null;
            
        }
        
        private function ver_todas_wishlists()
        {
            $conteudo['wishlists'] = $this->wishlist_model->get_wishlists();

            $x = 0;
            
            foreach($conteudo['wishlists'] as $obj)
            {
                $equipamentos[$x] = $this->equipamento_model->get_by_id($obj->id_equipamento)[0];
                $usuarios[$x] = $this->modelusuario->recuperarDados($obj->id_usuario)[0];
                $x++;
            }

            $conteudo['equipamentos'] = isset($equipamentos)?$equipamentos:null;
            $conteudo['usuarios'] = isset($usuarios)?$usuarios:null;
            return $conteudo;
        }

	public function verificarCpf()
	{
		$result = $this->modelusuario->validarCpf($this->input->post('cpf')); //variavel com resultado da validação
		if($result != false) //metodo do model usuario
		{			
			$_SESSION['id'] = $result;
                        if(isset($_SESSION['admin']))
                        {
                            unset($_SESSION['admin']);
                        }
                        
			/*echo "<script> alert('CPF encontrado!');
        	  	window.location.href='".base_url()."usuario/exibirUsuario'</script>";*/    
                        echo "<script> window.location.href='".base_url()."'</script>";
		}
		else
		{
			echo "<script> alert('CPF não encontrado. Realize seu cadastro');
        	  	window.location.href='".base_url()."usuario/paginaCadastro' </script>";
		}
	}
	public function paginaCadastro()
	{
            $breadcrumbs = array($this->uri->segment(1), 'Cadastro'); 
            $data['breadcrumbs'] = $breadcrumbs;
            $this->load->view('cabecalhos/cabecalho', $data);
            $this->load->view('conteudos/cadastrousuario'); // carrega view de cadastro
            $this->load->view('rodapes/rodape');
	}
	public function cadastrarUsuario()
	{
            if($this->modelusuario->cadastrar($this->input->post('nome'),$this->input->post('cpf'),$this->input->post('matricula'),$this->input->post('email'),$this->input->post('sala'),$this->input->post('telefone')) == true)
            {
                $result = $this->modelusuario->validarCpf($this->input->post('cpf'));
                $_SESSION['id'] = $result;
                echo "<script> alert('Cadastrado com sucesso!');
                window.location.href='".base_url()."equipamento/todos' </script>";
            }
            else
            {
                echo "<script> alert('Erro! CPF, Matrícula ou E-mail já presente no Banco de Dados');
                window.location.href='".base_url()."usuario/paginaCadastro' </script>";
            }
	}
	public function exibirUsuario()
	{
            $data['dadosusuario'] = $this->modelusuario->recuperarDados($_SESSION['id']);
            $this->load->view('menuusuario', $data) ;
	}
	public function paginaEditarPerfil()
	{
            $usu['dadosusuario'] = $this->modelusuario->recuperarDados($_SESSION['id']['id']); //salvando dados para passagem para view
            $breadcrumbs = array($this->uri->segment(1), 'Usuário'); 
            $data['breadcrumbs'] = $breadcrumbs;
            $this->load->view('cabecalhos/cabecalho', $data);
            $this->load->view('conteudos/editarperfil', $usu) ; //carregamento da view com os dados
            $this->load->view('rodapes/rodape');
	}
	public function atualizarUsuario()
	{
            if($this->modelusuario->atualizar($_SESSION['id']['id'], $this->input->post('nome'),$this->input->post('cpf'),$this->input->post('matricula'),$this->input->post('email'),$this->input->post('sala'),$this->input->post('telefone')) == true)
            {
                echo "<script> alert('Informações atualizadas com sucesso!');
                window.location.href='".base_url()."equipamento/todos' </script>";
                
                $_SESSION['id'] = $this->modelusuario->recuperarDados($_SESSION['id']['id'])[0];
            }
            else
            {
                echo "<script> alert('Erro! CPF, Matrícula ou E-mail já presente no Banco de Dados');
                window.location.href='".base_url()."usuario/paginaEditarPerfil' </script>";
            }
	}

	public function logoff()
	{
		if (isset($_SESSION["admin"])) 
		{
                    unset($_SESSION["admin"]);
		}

		if(isset($_SESSION['id']))
		{
                    unset($_SESSION["id"]);
		}

		header("Location: ".base_url());
	}
}

?>