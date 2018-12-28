<?php

class Backup_model extends CI_Model{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function gerar_relatorio_mes($ano, $mes) 
    {
        $this->db->select('*');
        $this->db->from('pedidos');
        $this->db->where("data_requisicao BETWEEN '{$ano}-{$mes}-01' and '{$ano}-{$mes}-31'");
        
        $this->db->select('id');
        $this->db->from('pedidos');
        $this->db->where("data_requisicao BETWEEN '{$ano}-{$mes}-01' and '{$ano}-{$mes}-31'");
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select('nome, patrimonio, estoque');
        $this->db->select_sum('quantidade');
        $this->db->from('equipamentos');
        $this->db->join('equipamentos', 'id_equipamento = id');
        $this->db->where("id_equipamento in ({$where_clause})");
        $this->db->group_by('id');
        
        $query = $this->db->get();
        
        return $query->result();
        
        // return $this->db->get_compiled_select();
    }
    
    public function pegar_primeiro_registro()
    {
        $this->db->select_min('data_requisicao');
        $query = $this->db->get('pedidos');
        return $query->result()[0];
    }
    
    public function pegar_ultimo_registro()
    {
        $this->db->select_max('data_requisicao');
        $query = $this->db->get('pedidos');
        return $query->result()[0];
    }
}
