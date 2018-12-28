<?php

class modelUsuario extends CI_Model {

        public function __construct()
        {
                parent::__construct();
        }

        public function validarCpf($cpf)
        {		
            $query = $this->db->query("select * from usuarios where cpf = '".$cpf."'");

            if($query->num_rows() == 1)
            {
                return $query->result_array()[0];
            }
            else
            {
                return false;
            } 
        }

        public function cadastrar($nome, $cpf, $matricula, $email, $sala, $telefone)
        {
            $sql = "insert into usuarios (nome, cpf, matricula, email, sala, telefone) values ('".$nome."', '".$cpf."', '".$matricula."', '".$email."', '".$sala."', '".$telefone."')";

            if($this->db->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
		
        public function recuperarDados($id)
        {
            $resultado = $this->db->query("select * from usuarios where id = ".$id);
            return $resultado->result_array();
        }
        
        public function atualizar($id, $nome, $cpf, $matricula, $email, $sala, $telefone)
        {
            $sql = "update usuarios set nome = '".$nome."', matricula = '".$matricula."', email = '".$email."', sala = '".$sala."', telefone = '".$telefone."' where id = ".$id;
            if($this->db->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>
