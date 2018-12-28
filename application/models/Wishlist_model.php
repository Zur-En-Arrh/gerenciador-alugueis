<?php

class Wishlist_model extends CI_Model{
    
    public $id_usuario;
    public $id_equipamento;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function get_wishlists()
    {
        $query = $this->db->get('wishlists');
        return $query->result();
    }
    
    public function get_user_wishlist($id, $limit, $offset)
    {
        $query = $this->db->get_where('wishlists', array('id_usuario' => $id), $limit, $offset);
        return $query->result();
    }
    
    public function insert_wishlist()
    {
        $this->db->insert('wishlists', $this);
    }
    
    public function delete_item($user, $equip)
    {
        $this->db->delete('wishlists', array('id_usuario' => $user, 'id_equipamento' => $equip));
    }
}
