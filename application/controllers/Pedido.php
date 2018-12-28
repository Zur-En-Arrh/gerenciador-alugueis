<?php

/**
 * 
 */
class Pedido extends CI_Controller
{
	
    public function _remap($method, $params = array())
    {
        if ($method == 'ver_pedidos') 
        {
            if (isset($_SESSION['id']) || isset($_SESSION['admin'])) 
            {
                return call_user_func_array(array($this, $method), $params);
            }else
            {
                $this->load->view('cabecalhos/cabecalho', array('breadcrumbs' => array('Acesso Negado')));
                $this->load->view('conteudos/acesso_negado');
                $this->load->view('rodapes/rodape');
            }
        }elseif($method == 'finalizar_pedido')
        {
            if (isset($_SESSION['admin'])) 
            {
                return call_user_func_array(array($this, $method), $params);
            }else
            {
                $this->load->view('cabecalhos/cabecalho', array('breadcrumbs' => array('Acesso Negado')));
                $this->load->view('conteudos/acesso_negado');
                $this->load->view('rodapes/rodape');
            }
        }else
        {
            if (isset($_SESSION['id'])) 
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
    
	public function __construct()
	{
            parent::__construct();
            $this->load->model('equipamento_model');
            $this->load->model('pedido_model');
            $this->load->model('modelusuario');
            $this->load->library('pagination');
	}

        public function ver_pedidos()
        {
            if (isset($_SESSION['id'])) 
            {
                // ver pedidos usuário
                if ($this->uri->segment(3) === FALSE) 
                {
                    $conteudo = $this->ver_pedidos_usuario(0, 5);
                }else
                {
                    $conteudo = $this->ver_pedidos_usuario($this->uri->segment(3), 5);
                }
                
                $data['breadcrumbs'][] = $_SESSION['id']['nome'];
                
                $config['total_rows'] = $this->pedido_model->get_user_tot_rows($_SESSION['id']['id']);
            }else
            {
                if ($this->uri->segment(3) === FALSE) 
                {
                    $conteudo = $this->ver_pedidos_admin(0, 5);
                }else
                {
                    $conteudo = $this->ver_pedidos_admin($this->uri->segment(3), 5);
                }
                
                $data['breadcrumbs'][] = $_SESSION["admin"]->username;
                
                $config['total_rows'] = $this->pedido_model->get_tot_rows();
            }
            
            
            
            $config['attributes'] = array('class' => 'page-link');
        
            $config['base_url'] = base_url('pedido/ver_pedidos');
            
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
            
            $data['breadcrumbs'][] = $this->uri->segment(1);
            $this->load->view('cabecalhos/cabecalho', $data);
            $this->load->view('conteudos/pedidos', $conteudo);
            $this->load->view('rodapes/rodape');
        }
        
	private function ver_pedidos_usuario($limit, $offset)
	{
            
            $this->pedido_model->id_usuario = $_SESSION['id']['id'];
            
            $conteudo['pedidos'] = $this->pedido_model->ver_pedidos_usuario($limit, $offset);
            foreach($conteudo['pedidos'] as $obj)
            {
                $equipamentos[$obj->id] = $this->equipamento_model->get_by_id($obj->id_equipamento)[0];
                $usuarios[$obj->id] = $this->modelusuario->recuperarDados($obj->id_usuario)[0];
            }
            
            $conteudo['equipamentos'] = isset($equipamentos)?$equipamentos:null;
            $conteudo['usuarios'] = isset($usuarios)?$usuarios:null;
            
            return $conteudo;
            /* $data['breadcrumbs'] = array($this->uri->segment(1), $_SESSION['id']['nome']);
            $this->load->view('cabecalhos/cabecalho', $data);
            $this->load->view('conteudos/pedidos_usuario', $conteudo);
            $this->load->view('rodapes/rodape'); */
	}

	private function ver_pedidos_admin($limit, $offset)
	{

            $conteudo['pedidos'] = $this->pedido_model->ver_pedidos($limit, $offset);
            
            foreach($conteudo['pedidos'] as $obj)
            {
                $equipamentos[$obj->id] = $this->equipamento_model->get_by_id($obj->id_equipamento)[0];
                $usuarios[$obj->id] = $this->modelusuario->recuperarDados($obj->id_usuario)[0];
            }
            
            $conteudo['equipamentos'] = $equipamentos;
            $conteudo['usuarios'] = $usuarios;

            return $conteudo;
            
            //$this->load->view('pedidos_pendentes', $data);
	}
        
        public function alugar_equipamento()
        {

            $this->pedido_model->id = 'default';
            $this->pedido_model->id_usuario = $_SESSION['id']['id'];
            $this->pedido_model->id_equipamento = $this->input->post('equip');
            $this->pedido_model->quantidade = $this->input->post('qtde');
            $this->pedido_model->progresso = 'Aberto';
            $this->pedido_model->data_requisicao = date('Y-m-d');
            $this->pedido_model->data_devolucao = $this->input->post('devolucao');
            $this->pedido_model->data_fim = null;


            $this->pedido_model->inserir_pedido();

            header("Location: ".base_url());
        }

	public function cancelar()
	{
            $id = $this->input->post('id');

            $this->pedido_model->id = $id;

            $pedido = $this->pedido_model->ver_id()[0];

            $this->pedido_model->id_usuario = $pedido->id_usuario;
            $this->pedido_model->progresso = 'Cancelado';
            $this->pedido_model->data_requisicao = $pedido->data_requisicao;
            $this->pedido_model->data_devolucao = $pedido->data_devolucao;
            $this->pedido_model->data_fim = $pedido->data_fim;
            $this->pedido_model->id_equipamento = $pedido->id_equipamento;
            $this->pedido_model->quantidade = $pedido->quantidade;
            $this->pedido_model->atualizar_pedido();

            header("Location: ".base_url()."pedido/usuario");
	}

	public function finalizar_pedido($id)
	{            
            $this->pedido_model->id = $id;

            $pedido = $this->pedido_model->ver_id()[0];

            $this->pedido_model->id_usuario = $pedido->id_usuario;
            $this->pedido_model->id_equipamento = $pedido->id_equipamento;
            $this->pedido_model->progresso = 'Concluído';
            $this->pedido_model->data_requisicao = $pedido->data_requisicao;
            $this->pedido_model->data_devolucao = $pedido->data_devolucao;
            $this->pedido_model->data_fim = date('Y-m-d');
            $this->pedido_model->quantidade = $pedido->quantidade;
            $this->pedido_model->atualizar_pedido();

            header("Location: ".base_url()."pedido/ver_pedidos");
	}
}