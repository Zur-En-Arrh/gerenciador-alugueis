<?php 

class Equipamento_model extends CI_Model
{
    public $id;
    public $patrimonio;
    public $nome;
    public $estoque;
    public $especificacao;
    public $status;
    public $observacoes;

    public function __construct()
    {
        parent::__construct();
    }

    public function criar_equipamento()
    {
        $query = $this->db->get_where('equipamentos', array('patrimonio' => $this->patrimonio));
        if($query->num_rows() != 0)
        {
            return false;
        }
        else
        {        
            $this->db->insert('equipamentos', $this);
            return true;
        }
    }

    public function atualizar_equipamento()
    {
        $this->db->update('equipamentos', $this, array('id' => $this->id));
    }

    public function get_equipamentos_limit($limit)
    {
        $query = $this->db->get('equipamentos', $limit);
        return $query->result();
    }
    
    public function get_tot_rows()
    {
        $query = $this->db->get('equipamentos');
        return $query->num_rows();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('equipamentos', array('id' => $id));
        return $query->result();
    }
    
    public function find_equipamento($order, $by, $where, $limit, $offset)
    {
        $this->db->like('nome', $this->nome);
        $this->db->order_by($by, $order);
        if($where != null)
        {
            $this->db->where('status', $where);
        }
        $query = $this->db->get('equipamentos', $limit, $offset);
        return $query->result();
    }
    
    public function get_equipamentos_offset($limit, $offset) 
    {
        $query = $this->db->get('equipamentos', $offset, $limit);
        return $query->result();
    }
    
    public function get_equipamentos_mes($ano, $mes)
    {
        $this->db->select("nome, patrimonio, estoque, sum(quantidade) as 'soma'");
        $this->db->from('equipamentos');
        $this->db->join('pedidos', 'id_equipamento = equipamentos.id');
        $this->db->where("data_requisicao BETWEEN '{$ano}-{$mes}-01' and '{$ano}-{$mes}-31'");
        $this->db->group_by('id_equipamento');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_equipamentos_all()
    {
        $query = $this->db->get('equipamentos');
        return $query->result();
    }
}

?>