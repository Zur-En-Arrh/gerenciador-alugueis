<?php 

class Equipamento extends CI_Controller
{
    
    public function _remap($method, $params = array())
    {
        if ($method == 'pesquisa' || $method == 'ver' || $method == 'index') 
        {
            return call_user_func_array(array($this, $method), $params);
        }elseif($method == 'deletar_item' || $method == 'colocar_wishlist')
        {
            if (isset($_SESSION['id'])) 
            {
                return call_user_func_array(array($this, $method), $params);
            }else
            {
                // redirecionar para uma página de acesso negado!
                $this->load->view('cabecalhos/cabecalho', array('breadcrumbs' => array('Acesso Negado')));
                $this->load->view('conteudos/acesso_negado');
                $this->load->view('rodapes/rodape');
            }
        }else
        {
            if(isset($_SESSION['admin']))
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
    
    public function index()
    {
        $this->ver(array('Equipamentos'));
    }
    

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('equipamento_model');
        $this->load->model('wishlist_model');
    }

    public function inserir_equipamento()
    {
        $this->load->model('equipamento_model');

        $nome = $this->input->post('nome');
        $patrm = $this->input->post('patrm');
        $qtde = $this->input->post('qtde');
        $status = $this->input->post('status');
        $obs = $this->input->post('obs');
        $desc = $this->input->post('desc');
        $id_admin = $this->input->post('id_admin');
        $id = $this->input->post('id');

        $this->equipamento_model->nome = $nome;
        $this->equipamento_model->patrimonio = $patrm;
        $this->equipamento_model->estoque = $qtde;
        $this->equipamento_model->especificacao = $desc;
        $this->equipamento_model->status = $status;
        $this->equipamento_model->observacoes = $obs;
        $this->equipamento_model->id = 'default';
        $resultado = $this->equipamento_model->criar_equipamento();

        if ($resultado) 
        {
            header("Location: ".base_url());
        }else
        {
            header("Location: ".base_url()."equipamento/criacao");
        }

    }

    public function colocar_wishlist($equip)
    {
        $this->wishlist_model->id_usuario = $_SESSION["id"]["id"];
        $this->wishlist_model->id_equipamento = $equip;
        $this->wishlist_model->insert_wishlist();

        header("Location: ".base_url());

    }

    public function gerar_form_criar()
    {
        $data['nome'] = array(
        'type'      => 'text',
        'name'      => 'nome',
        'class'     => 'form-control',
        'id' => 'txtNome',
        'required' => 'required'
        );

        $data['patrimonio'] = array(
            'type'      => 'text',
            'name'      => 'patrm',
            'id' => 'txtPatr',
            'class'     => 'form-control',
        'required' => 'required'
        );

        $data['descricao'] = array(
            'type'      => 'text',
            'name'      => 'desc',
            'id' => 'txtDesc',
            'class'     => 'form-control',
        'required' => 'required'
        );

        $data['quantidade'] = array(
            'type'      => 'number',
            'name'      => 'qtde',
            'id' => 'txtQtde',
            'class'     => 'form-control',
        'required' => 'required'
        );

        $data['opcoes'] = array(
            'disponível'    => 'Disponível',
            'emprestado'    => 'Emprestado',
            'esgotado'      => 'Esgotado',
            'em manutenção' => 'Em Manutenção',
            'avariado'      => 'Avariado',
            'alienado'      => 'Alienado'
        );

        $data['observacoes'] = array(
            'name'      => 'obs',
            'class'     => 'form-control',
            'id' => 'txtObs',
            'rows' => '3',
            'cols' => '5',
        'required' => 'required'
        );

        $data['botao'] = array(
            'value' => 'Criar',
            'class' => 'btn btn-success'
        );

        $breadcrumbs = array($this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)); 
        $cabecalho['breadcrumbs'] = $breadcrumbs;

        $this->load->view('cabecalhos/cabecalho', $cabecalho);
        $this->load->view('conteudos/cadastro_equipamento', $data);
        $this->load->view('rodapes/rodape');
    }

    public function ver($rastro = array())
    {
        if ($this->uri->segment(3) !== FALSE) 
        {
            $equip['equipamentos'] = $this->equipamento_model->get_equipamentos_offset($this->uri->segment(3), 3);
        }else
        {
            $equip['equipamentos'] = $this->equipamento_model->get_equipamentos_offset(0, 3);
        }
        
        $config['attributes'] = array('class' => 'page-link');
        
        $config['base_url'] = base_url('equipamento/ver');
        $config['total_rows'] = $this->equipamento_model->get_tot_rows();
        $config['per_page'] = 3;
        
        
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
        
        $data['breadcrumbs'] = array($this->uri->segment(1));

        $this->load->view('cabecalhos/cabecalho', $data);
        $this->load->view('conteudos/equipamentos', $equip);
        $this->load->view('rodapes/rodape');
    }

    public function alterar_equipamento()
    {

        $nome = $this->input->post('nome');
        $patrm = $this->input->post('patrm');
        $qtde = $this->input->post('qtde');
        $status = $this->input->post('status');
        $obs = $this->input->post('obs');
        $desc = $this->input->post('desc');
        $id_admin = $this->input->post('id_admin');
        $id = $this->input->post('id');

        $this->equipamento_model->nome = $nome;
        $this->equipamento_model->patrimonio = $patrm;
        $this->equipamento_model->estoque = $qtde;
        $this->equipamento_model->especificacao = $desc;
        $this->equipamento_model->status = $status;
        $this->equipamento_model->observacoes = $obs;
        $this->equipamento_model->id = $id;
        $this->equipamento_model->atualizar_equipamento();

        header("Location: ".base_url());
    }

    public function deletar_item($equip)
    {
        if (isset($_SESSION['id'])) 
        {
            $this->wishlist_model->delete_item($_SESSION['id']['id'], $equip);
            header("Location: ".base_url()."usuario/ver_wishlist");
        }else
        {
            header("Location: ".base_url());

        }
    }

    public function gerar_form_atualizar($id)
    {
        $obj = $this->equipamento_model->get_by_id($id)[0];

        $data['obj'] = $obj;

        $data['hidden'] = array('id' => $obj->id);

        $data['nome'] = array(
            'type'      => 'text',
            'name'      => 'nome',
            'value'     => $obj->nome,
            'class'     => 'form-control',
            'id' => 'txtNome',
            'required' => 'required'
        );

        $data['patrimonio'] = array(
            'type'      => 'text',
            'name'      => 'patrm',
            'value'     => $obj->patrimonio,
            'id' => 'txtPatr',
            'class'     => 'form-control',
            'required' => 'required'
        );

        $data['descricao'] = array(
                'type'      => 'text',
                'name'      => 'desc',
                'value'     => $obj->especificacao,
            'id' => 'txtDesc',
            'class'     => 'form-control',
        'required' => 'required'
        );

        $data['quantidade'] = array(
                'type'      => 'number',
                'name'      => 'qtde',
                'value'     => $obj->estoque,
            'id' => 'txtQtde',
            'class'     => 'form-control',
        'required' => 'required'
        );

        $data['opcoes'] = array(
                'disponível'    => 'Disponível',
                'emprestado'    => 'Emprestado',
                'esgotado'      => 'Esgotado',
                'em manutenção' => 'Em Manutenção',
                'avariado'      => 'Avariado',
                'alienado'      => 'Alienado'
        );

        $data['observacoes'] = array(
                'name'      => 'obs',
                'value'     => $obj->observacoes,
                'class'     => 'form-control',
                'id' => 'txtObs',
                'rows' => '3',
                'cols' => '5',
        'required' => 'required'
        );

        $data['botao'] = array(
                'value' => 'Enviar',
                'class' => 'btn btn-success'
        );

        $breadcrumbs = array($this->uri->segment(1), $obj->nome); 
        $cabecalho['breadcrumbs'] = $breadcrumbs;

        $this->load->view('cabecalhos/cabecalho', $cabecalho);
        $this->load->view('conteudos/form_equipamento_atualizacao', $data);
        $this->load->view('rodapes/rodape');
    }

    public function pesquisa() 
    {
        $this->load->model('equipamento_model');
        $nome = $this->input->get('nome');
        $ordem = explode('/', $this->input->get('ordem'));
        $status = ($this->input->get('status') == 'qualquer')? null: $this->input->get('status');
        $this->equipamento_model->nome = $nome;
        $equip['equipamentos'] = $this->equipamento_model->find_equipamento($ordem[1], $ordem[0], $status, 0, 5);
        $breadcrumbs = array($this->uri->segment(1), '"'.$nome.'"'); 
        $data['breadcrumbs'] = $breadcrumbs;

        $this->load->view('cabecalhos/cabecalho', $data);
        $this->load->view('conteudos/equipamentos', $equip);
        $this->load->view('rodapes/rodape');
    }
}

?>