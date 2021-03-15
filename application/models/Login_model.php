<?php
    class Login_model extends CI_Model{
        public function getData($table, $where = false){
            if($where){
                return $this->db
                            ->get_where($table,$where)
                            ->row_array();
            }
            else{
                return $this->db
                            ->get($table)
                            ->row_array();
            }
        }
    }
?>