<?php 

/**
 * 
 */
class Pedido_model extends CI_Model
{
    public $id;
    public $id_usuario;
    public $id_equipamento;
    public $quantidade;
    public $progresso;
    public $data_requisicao;
    public $data_devolucao;
    public $data_fim;

    public function __construct()
    {
        parent::__construct();
    }

    public function inserir_pedido()
    {
        $this->db->insert('pedidos', $this);
    }

    public function ver_id()
    {
        $query = $this->db->get_where('pedidos', array('id' => $this->id));
        return $query->result();
    }

    public function ver_pedidos($limit, $offset)
    {
        $this->db->select("id, id_equipamento, id_usuario, quantidade, progresso, data_devolucao, data_fim, date_format(data_requisicao, '%d/%m/%Y') as 'data_requisicao'");
        $query = $this->db->get('pedidos', $offset, $limit);
        return $query->result();
    }

    public function atualizar_pedido()
    {
        $this->db->update('pedidos', $this, array('id' => $this->id));
    }

    public function ver_pedidos_usuario($limit, $offset)
    {
        $this->db->select("id, id_equipamento, id_usuario, quantidade, progresso, data_devolucao, data_fim, date_format(data_requisicao, '%d/%m/%Y') as 'data_requisicao'");
        $query = $this->db->get_where('pedidos', array('id_usuario' => $this->id_usuario), $offset, $limit);
        return $query->result();
    }

    public function ver_pedidos_notificados($array)
    {
        $this->db->select('id, data_devolucao, data_requisicao, progresso');
        $this->db->from('pedidos');
        $this->db->where_in('id', $array);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function ver_pedidos_periodo($ano, $mes)
    {
        $this->db->select("*");
        $this->db->from('pedidos');
        $this->db->where("data_requisicao BETWEEN '{$ano}-{$mes}-01' and '{$ano}-{$mes}-31'");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_tot_rows()
    {
        $query = $this->db->get('pedidos');
        return $query->num_rows();
    }
    
    public function get_user_tot_rows($id)
    {
        $query = $this->db->get_where('pedidos', array('id_usuario' => $id));
        return $query->num_rows();
    }
}


?>