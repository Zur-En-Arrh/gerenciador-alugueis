<?php

class Relatorio extends CI_Controller{
    
    
    public function _remap($method, $params = array())
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
    }
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('backup_model');
        $this->load->model('pedido_model');
        $this->load->model('modelusuario');
        $this->load->model('equipamento_model');
    }
    
    public function index() 
    {
        $this->exibir_lista();
    }
    
    public function exibir_lista() 
    {  
        $meses = array(
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        );

        //Chamo o Model
        $this->load->model('backup_model');
        $primeiro = $this->backup_model->pegar_primeiro_registro();
        $ultimo = $this->backup_model->pegar_ultimo_registro();

        //Pego a primeira e a última data
        $primeira_data = explode('-', $primeiro->data_requisicao);
        $ultima_data = explode('-', $ultimo->data_requisicao);

        //Pego o primeiro e ultimo mes
        $primeiro_mes = $primeira_data[1];
        $ultimo_mes = $ultima_data[1];

        //Pego o primeiro e ultimo ano
        $primeiro_ano = $primeira_data[0];
        $ultimo_ano = $ultima_data[0];
        
        for ($i = $primeiro_ano; $i <= $ultimo_ano; $i++)
        {
            $begin = ($i == $primeiro_ano) ? $primeiro_mes: 1;
            $end = ($i == $ultimo_ano)? $ultimo_mes: 12;

            for ($j = $begin; $j <= $end; $j++)
            {
                $array[$i][$j] = $meses[$j];
            }
        }

        $data['array'] = $array;
        $data['datas'] = array($primeira_data, $ultima_data);

        $breadcrumbs = array($this->uri->segment(1), $this->uri->segment(2)); 
        $cabecalho['breadcrumbs'] = $breadcrumbs;
        
        $this->load->view('cabecalhos/cabecalho', $cabecalho);
        $this->load->view('conteudos/relatorios', $data);
        $this->load->view('rodapes/rodape');
    }
    
    public function gerar($ano, $mes, $download)
    {
        //$equipamentos = $this->backup_model->gerar_relatorio_mes($ano, $mes);
        
        $pedidos = $this->pedido_model->ver_pedidos_periodo($ano, $mes);
        
        $i = 0;
        foreach($pedidos as $obj)
        {
            $tudo[$i]['pedido'] = $obj;
            $tudo[$i]['equipamento'] = $this->equipamento_model->get_by_id($obj->id_equipamento)[0];
            $tudo[$i]['usuario'] = $this->modelusuario->recuperarDados($obj->id_usuario)[0];
            $i++;
        }
        
        $dados_finais = $this->equipamento_model->get_equipamentos_mes($ano, $mes);
        $equipamentos = $this->equipamento_model->get_equipamentos_all();

        $html = '<h1 style="text-align: center;">Relatório Mensal de Estoque do Laboratório de Transmissão de Dados</h1>';
        
        
        
        //Tabela de Pedidos
        
        $html .= '<h3 style="text-align:center;"> Listagem de Pedidos Realizados </h3>';
        $html .= '<table border=1 style="width:100%;">';	
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Data de Requisição</th>';
        $html .= '<th>Usuário</th>';
        $html .= '<th>Equipamento</th>';
        $html .= '<th>Quantidade</th>';
        $html .= '<th>Estado do Pedido</th>';
        $html .= '<th>Data de Encerramento</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach($tudo as $um)
        {
            $html .= '<tr><td style="text-align:center;">'.$um['pedido']->data_requisicao . "</td>";
            $html .= '<td style="text-align:center;">'.$um['usuario']['nome'].' - '.$um['usuario']['sala']. "</td>";
            $html .= '<td style="text-align:center;">'.$um['equipamento']->nome.' - '.$um['equipamento']->patrimonio . "</td>";
            $html .= '<td style="text-align:center;">'.$um['pedido']->quantidade . "</td>";
            $html .= '<td style="text-align:center;">'.$um['pedido']->progresso . "</td>";
            $html .= '<td style="text-align:center;">'.$um['pedido']->data_fim . "</td>";
            $html .= '</tr>';		
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<br>';
        $html .= '<h3 style="text-align:center;"> Listagem de Produtos Alugados </h3>';
        $html .= '<table border=1 style="width:100%;">';	
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Produto</th>';
        $html .= '<th>Patrimônio</th>';
        $html .= '<th>Vezes</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach($dados_finais as $um)
        {
            $html .= '<tr><td style="text-align:center;">'.$um->nome . "</td>";
            $html .= '<td style="text-align:center;">'.$um->patrimonio . "</td>";
            $html .= '<td style="text-align:center;">'.$um->soma . "</td>";
            $html .= '</tr>';		
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<br>';

        $html .= '<h3 style="text-align:center;"> Estoque </h3>';
        $html .= '<table border=1 style="width:100%;">';	
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Produto</th>';
        $html .= '<th>Patrimônio</th>';
        $html .= '<th>Quantidade</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach($equipamentos as $um)
        {
            $html .= '<tr><td style="text-align:center;">'.$um->nome . "</td>";
            $html .= '<td style="text-align:center;">'.$um->patrimonio . "</td>";
            $html .= '<td style="text-align:center;">'.$um->estoque . "</td>";
            $html .= '</tr>';		
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<br>';

        $date = date('d/m/Y - H:i');
        $html .= '<h5 style="text-align:right;"> Relatório gerado dia '.$date.'</h5>';

        $this->pdf->load_html($html);

        //Renderizar o html
        $this->pdf->render();

        $pdf = $this->pdf->output();

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        $file_name = 'relatorio-'.$mes.'-'.$ano;
        $file_path = $_SERVER['DOCUMENT_ROOT'].'/gerenciadordealugueis/back-up/'.$file_name.'.pdf';

        file_put_contents($file_path, $pdf);
        //Fazer download
        $this->pdf->stream($file_name, array("Attachment" => $download));
    }
}
